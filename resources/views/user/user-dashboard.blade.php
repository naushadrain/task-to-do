@extends('user.temp.layout')
@section('content')
    <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-white-50">Total Tasks</h5>
                            <h3 class="text-white">{{$totalTasks}}</h3>
                            <p class="text-muted mb-0">All assigned tasks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-white-50">Pending Tasks</h5>
                            <h3 class="text-white">{{$pendingTasks}}</h3>
                            <p class="text-muted mb-0">Still in progress</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-white-50">Completed</h5>
                            <h3 class="text-white">{{$completedTasks}}</h3>
                            <p class="text-muted mb-0">Tasks you've done</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Recent Activity</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($recentActivities as $activity)
                <li class="list-group-item d-flex align-items-center">
                    @if($activity->status === 'Done')
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Task "<strong>{{ $activity->description }}</strong>" marked as completed
                    @elseif($activity->status === 'In Progress')
                        <i class="fas fa-hourglass-half text-warning me-2"></i>
                        You're working on "<strong>{{ $activity->description }}</strong>"
                    @elseif($activity->status === 'To Do')
                        <i class="fas fa-calendar-alt text-info me-2"></i>
                        Task "<strong>{{ $activity->description }}</strong>" is pending
                    @endif
                </li>
            @empty
                <li class="list-group-item text-muted">No recent activity found.</li>
            @endforelse
        </ul>
    </div>
</div>

@endsection