@extends('admin.temp.layout')
@section('title', 'Assign Task')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">Assign Task to User</h3>

    {{-- Show Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Show Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.assign.task') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Task Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label text-white">Task Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                </div>

                {{-- Task Image (optional) --}}
                <div class="mb-3">
                    <label for="image" class="form-label text-white">Task Image (Optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- Task Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label text-white">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="To Do" {{ old('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                {{-- Assign to User --}}
                <div class="mb-3">
                    <label for="assigned_to" class="form-label text-white">Assign To</label>
                    <select name="assigned_to" class="form-select" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{--  Task Completed Date --}}
                <div class="mb-3">
                    <label for="completed_date" class="form-label text-white">Completed Date (Optional)</label>
                    <input type="date" name="completed_date" class="form-control" value="{{ old('completed_date') }}">
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Assign Task</button>
            </form>
        </div>
    </div>
</div>
@endsection
