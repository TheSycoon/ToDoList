<div class="card">
    <div class="card-header">
        <h3>PHP - Simple To Do List App</h3>
    </div>
    <div class="card-body">
       <div class="row">
        <div class="col-12">
            <form wire:submit.prevent="addTask" class="d-flex mb-3">
                <input type="text" wire:model="taskName" class="form-control me-2" placeholder="Add a task...">
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>

        </div>
        <div class="col-12">
            @error('taskName')
                <span class="text-danger mb-2">{{$message}}</span>
            @enderror
        </div>
       </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    <tr @if($task->status) class="table-success" @endif>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ $task->status ? 'Done' : 'Pending' }}</td>
                        <td>
                            @if(!$task->status)
                                <button wire:click="markAsComplete({{ $task->id }})" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            @endif
                            <button onclick="confirmDeletion({{ $task->id }})" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tasks available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDeletion(taskId) {
        if (confirm("Are you sure you want to delete this task?")) {
            @this.call('deleteTask', taskId);
        }
    }
</script>
