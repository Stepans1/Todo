<?php 

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository
{
    public function getTasks(?bool $isActive): Collection
    {
        $query = Task::query();

        if (!is_null($isActive)) {
            $query->where('is_active', $isActive);
        }

        $query->orderBy('created_at', 'desc');

        return $query->get();
    }
}