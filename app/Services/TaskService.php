<?php

// app/Services/TaskService.php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks($sortingParam = null, $sortingValue = null)
    {
        $query = Task::query();

        if ($sortingParam == 'createdDate') {
            $query->orderBy('created_at', $sortingValue);
        } elseif ($sortingParam == 'priority') {
            $query->orderBy('priority', $sortingValue);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->get();
    }
}