<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $taskName;
    public $tasks;

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::get(); // get all tasks including soft deleted
    }

    public function addTask()
    {
        $this->validate([
            'taskName' => 'required|string|max:255|unique:tasks,task_name',
        ]);

        Task::create([
            'task_name' => $this->taskName,
            'status' => 0,
        ]);

        $this->taskName = '';
        $this->loadTasks();
    }

    public function markAsComplete($taskId)
    {
        $task = Task::find($taskId);
        $task->status = 1;
        $task->save();

        $this->loadTasks();
    }

    public function deleteTask($taskId)
    {
        Task::find($taskId)->delete();
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
