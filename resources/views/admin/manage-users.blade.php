@extends('admin.temp.layout')
@section('title', 'Manage Users')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary fw-bold">👥 Manage Users</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{$user->role}}
                    </td>
                    <td>
    @if($user->status == 1)
        <button type="submit" class="btn btn-sm btn-success">Active</button>
    @elseif($user->status == 0)
        <button type="submit" class="btn btn-sm btn-info">Inactive</button>
    @else
        <!-- Optional: handle other status values -->
        <button type="submit" class="btn btn-sm btn-secondary">Unknown</button>
    @endif
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
