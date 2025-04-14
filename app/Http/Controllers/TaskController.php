<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TaskService;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTasks(Request $request): JsonResponse
    {
        try {
            $status = $request->input('status');
            $response = $this->taskService->getTasks($status);
    
            return response()->json(
                $this->getResponse($response ?? [])
            );
        } catch (Exception $e) {
            Log::channel('database')->error(
                $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'message' => $e->getMessage(),
                ]
            );
    
            return response()->json(
                $this->getResponse([], false, 'Something went wrong while loading')
            );
        }
    }
    

    public function saveTask(Request $request): JsonResponse
    {
        try {
            $title = $request->input('title');
            $description = $request->input('description');
            $shouldReturnNewTask = filter_var($request->input('shouldReturnNewTask'), FILTER_VALIDATE_BOOLEAN);

            $newTask = $this->taskService->saveTask($title, $description);

            if($newTask) {
                if($shouldReturnNewTask) {
                    return response()->json(data: $this->getResponse(['newTask' => $newTask]));
                }

                return response()->json(data: $this->getResponse([]));
            }
        } catch (Exception $e) {
            Log::channel('database')->error(
                $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'message' => $e->getMessage(),
                ]
            );        
        }

        return response()->json($this->getResponse([], false, 'Something went wrong when saving a new task'));
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            $taskId = $request->input('id');

            $isSuccess = $this->taskService->deleteTask($taskId);

            if($isSuccess) {
                return response()->json(data: $this->getResponse([], $isSuccess));
            }
        } catch(Exception $e) {
            Log::channel('database')->error(
                $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'message' => $e->getMessage(),
                ]
            );        
        }

        return response()->json($this->getResponse([], false, 'Something went wrong when deleting a task'));
    }

    public function changeStatus(Request $request): JsonResponse
    {
        try {
            $taskId = $request->input('id');

            $isSuccess = $this->taskService->changeStatus($taskId);

            if($isSuccess) {
                return response()->json(data: $this->getResponse([], $isSuccess));
            }
        } catch(Exception $e) {
            Log::channel('database')->error(
                $e->getMessage(),
                [
                    'trace' => $e->getTraceAsString(),
                    'message' => $e->getMessage(),
                ]
            );
        }

        return response()->json($this->getResponse([], false, 'Something went wrong when changing the task status'));
    }

    private function getResponse(array $data, bool $isSuccess = true, string $message = ''): array
    {
        return [
            'data' => $data,
            'message' => $message,
            'isSuccess' => $isSuccess,
        ];
    }
}