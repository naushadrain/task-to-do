@extends('admin.temp.layout')
@section('title', 'All Tasks')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary fw-bold">🗂️ All Tasks</h2>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Assigned To</th>
                <th>Created Date</th>
                <th>Assigned Date</th>
                <th>Completed Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $index => $task)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if($task->image)
                            <img src="{{ asset('storage/task_images/' . $task->image) }}" width="60" height="60" class="rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($task->status === 'To Do')
                            <span class="badge bg-warning text-dark">{{ $task->status }}</span>
                        @elseif($task->status === 'In Progress')
                            <span class="badge bg-info">{{ $task->status }}</span>
                        @elseif($task->status === 'Done')
                            <span class="badge bg-success">{{ $task->status }}</span>
                        @endif
                    </td>
                    <td>{{ $task->creator->name ?? 'N/A' }}</td>
                    <td>{{ $task->assignee->name ?? 'Unassigned' }}</td>
                    <td>{{ $task->created_at->format('Y-m-d') }}</td>
                    <td>{{ $task->assigned_date ?? 'N/A' }}</td>
                    <td>{{ $task->completed_date ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
