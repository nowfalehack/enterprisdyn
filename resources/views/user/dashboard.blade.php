@extends('user.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">Welcome back 👋</h2>
        <p class="text-muted">Manage your forms & submissions easily</p>
    </div>

    <!-- STATS -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="stat-card p-4 shadow">
                <p class="mb-1">My Submissions</p>
                <h2 class="fw-bold">
                    {{ \App\Models\Submission::where('user_id', auth()->id())->count() }}
                </h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-glass p-4 shadow">
                <p class="text-muted mb-1">Available Forms</p>
                <h3 class="fw-bold">
                    {{ \App\Models\Form::count() }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-glass p-4 shadow">
                <p class="text-muted mb-1">Account Status</p>
                <h5 class="fw-bold text-success">Active</h5>
            </div>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="row mt-4 g-4">

        <div class="col-md-6">
            <div class="card-glass p-4 shadow">
                <h5 class="fw-bold mb-3">⚡ Quick Actions</h5>

                <a href="/forms" class="btn btn-primary rounded-pill w-100 mb-2">
                    Fill Form
                </a>

                <a href="/my-submissions" class="btn btn-outline-light rounded-pill w-100">
                    View My Submissions
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-glass p-4 shadow">
                <h5 class="fw-bold mb-3">📌 Profile</h5>

                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

                <a href="/profile" class="btn btn-warning rounded-pill w-100">
                    Edit Profile
                </a>
            </div>
        </div>

    </div>

</div>

@endsection