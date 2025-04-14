<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;

class TaskService 
{
    private const STATUS_ALL = "-1";
    private const STATUS_ACTIVE = "1";
    private const STATUS_COMPLETED = "0";

    public const STATUS_MAP = [
        self::STATUS_ALL => 'All',
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_COMPLETED => 'Completed',
    ];

    private TaskRepository $taskRepo;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function getTasks(string $status): ?array
    {
        $isActive = match ($status) {
            self::STATUS_ALL => null,
            self::STATUS_ACTIVE => true,
            self::STATUS_COMPLETED => false,
            default => throw new Exception("Unknown status: $status"),
        };
        
        $tasks = $this->taskRepo->getTasks($isActive);

        if ($tasks->isEmpty()) {
            return null;
        }

        $tasks->transform(function (Task $task): Task {
            $task->formatted_created_at = $task->created_at->format('d.m.Y H:i');
            return $task;
        });

        return [
            'tasks' => $tasks,
        ];
    }

    public function saveTask(string $title, ?string $description): ?Task
    {
        $task = new Task();
    
        $task->title = $title;
        $task->description = $description;
        $task->isActive = true;
    
        if ($task->save()) {
            $task->formatted_created_at = $task->created_at->format('d.m.Y H:i');
            
            return $task;
        }
    
        return null;
    }
    

    public function deleteTask(int $id): bool
    {
        $task = Task::find($id);

        if (!$task) {
            return false;
        }

        return $task->delete();    
    }

    public function changeStatus(int $id): bool
    {
        $task = Task::find($id);

        if (!$task) {
            return false;
        }
    
        $task->isActive = !$task->isActive;
        
        return $task->save();
    }
}