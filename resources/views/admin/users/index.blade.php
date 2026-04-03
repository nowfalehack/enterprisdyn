@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">👤 User Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow rounded-4 p-4">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        @if($user->role !== 'admin')
                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @else
                        Protected
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        {{ $users->links() }}

    </div>

</div>

@endsection