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
    <button type="button"
            class="btn btn-sm toggle-status-btn {{ $user->status ? 'btn-success' : 'btn-info' }}"
            data-user-id="{{ $user->id }}"
            data-status="{{ $user->status }}">
        {{ $user->status ? 'Active' : 'Inactive' }}
    </button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.toggle-status-btn').click(function () {
            const button = $(this);
            const userId = button.data('user-id');
            const currentStatus = button.data('status');

            $.ajax({
                url: "{{ route('admin.user.toggleStatus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: userId,
                    status: currentStatus == 1 ? 0 : 1
                },
                success: function (response) {
                    if (response.success) {
                        // Update button text and style
                        button.text(response.new_status_text);
                        button.data('status', response.new_status);

                        if (response.new_status == 1) {
                            button.removeClass('btn-info btn-secondary').addClass('btn-success');
                        } else {
                            button.removeClass('btn-success btn-secondary').addClass('btn-info');
                        }
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function () {
                    alert('Request failed.');
                }
            });
        });
    });
</script>
@endsection
