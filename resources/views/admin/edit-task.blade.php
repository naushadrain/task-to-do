@extends('admin.temp.layout')
@section('title', 'Edit Task')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">✏️ Edit Task</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Task Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label text-white">Task Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $task->description) }}</textarea>
                </div>

                {{-- Task Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label text-white">Change Task Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    @if ($task->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                {{-- Task Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label text-white">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                {{-- Assign to User --}}
                <div class="mb-3">
                    <label for="assigned_to" class="form-label text-white">Assign To</label>
                    <select name="assigned_to" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label for="due_date" class="form-label text-white">Due Date</label>
                    <input type="date" name="due_date" class="form-control"
                           value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">
                </div>

                {{-- Priority --}}
                <div class="mb-3">
                    <label for="priority" class="form-label text-white">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
