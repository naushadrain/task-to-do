@extends('admin.temp.layout')
@section('content')
    <div class="row">
        <!-- Card: Total Users -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title">👥 Total Users</h5>
                    <p class="display-6 text-info">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Tasks -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-white">📝 Total Tasks</h5>
                    <p class="display-6 text-success text-white">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Pending Tasks -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-info">
                <div class="card-body text-center">
                    <h5 class="card-title text-white">⏳ Pending Tasks</h5>
                    <p class="display-6 text-warning text-white">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Navigation Buttons -->
        <div class="col-md-6">
            <a href="{{ route('all.task.index') }}" class="btn btn-outline-primary w-100 py-3">
                📋 View All Tasks
            </a>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <a href="{{route('user.manage.index')}}" class="btn btn-outline-secondary w-100 py-3">
                👤 Manage Users
            </a>
        </div>
    </div>
@endsection