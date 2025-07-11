@extends('user.temp.layout')
@section('title', 'My Tasks')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-white fw-bold">🗂️ My Assigned Tasks</h2>

    <div id="alert-box"></div> <!-- AJAX Alerts -->

    @if($tasks->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No tasks assigned yet.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($tasks as $task)
                <div class="col">
                    <div class="card h-100 text-white bg-dark border-secondary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($task->description, 50) }}</h5>

                            <p><strong>Status:</strong>
                                <span class="badge 
                                    @if($task->status === 'To Do') bg-warning text-dark
                                    @elseif($task->status === 'In Progress') bg-info
                                    @else bg-success
                                    @endif">{{ $task->status }}</span>
                            </p>

                            <p><strong>Assigned Date:</strong> {{ $task->assigned_date ?? 'N/A' }}</p>
                            <p><strong>Due Date:</strong> {{ $task->due_date ?? 'N/A' }}</p>
                            <p><strong>Priority:</strong>
                                <span class="@if($task->priority == 'High') text-danger fw-bold
                                             @elseif($task->priority == 'Medium') text-warning
                                             @else text-muted @endif">
                                    {{ $task->priority }}
                                </span>
                            </p>

                            @if($task->completed_date)
                                <p class="text-success"><i class="fas fa-check-circle"></i> Completed on {{ $task->completed_date }}</p>
                            @endif
                        </div>

                        <div class="mx-3 mb-2 d-flex justify-content-between">
                            @foreach(['To Do' => 'warning', 'In Progress' => 'info', 'Done' => 'success'] as $label => $color)
                                <button class="btn status-btn btn-sm {{ $task->status === $label ? 'btn-' . $color : 'btn-outline-light' }}"
                                        data-id="{{ $task->id }}" data-status="{{ $label }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        <div class="card-footer bg-transparent border-top-0">
                            <small class="text-muted">Created: {{ $task->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- CSRF token for JavaScript --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alertBox = document.getElementById('alert-box');

        document.querySelectorAll('.status-btn').forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-id');
                const newStatus = this.getAttribute('data-status');
                const csrf = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/user/task/update-status/${taskId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert('danger', 'Update failed!');
                    }
                })
                .catch(() => showAlert('danger', 'Something went wrong!'));
            });
        });

        function showAlert(type, message) {
            alertBox.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
                    <strong>${type === 'success' ? '✅ Success:' : '⚠️ Error:'}</strong> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
        }
    });
</script>
@endsection
