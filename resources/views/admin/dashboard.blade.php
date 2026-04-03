@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">🚀 Dashboard</h2>
        <p class="text-muted">Overview of your system performance</p>
    </div>

    <!-- STATS -->
    <div class="row g-4">

        <div class="col-md-4">
            <a href="/admin/forms" class="text-decoration-none">
                <div class="stat-card p-4">
                    <p>Total Forms</p>
                    <h3>{{ $forms }}</h3>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/admin/submissions" class="text-decoration-none">
                <div class="stat-card p-4">
                    <p>Submissions</p>
                    <h3>{{ $submissions }}</h3>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="stat-card p-4">
                    <p>Users</p>
                    <h3>{{ $users }}</h3>
                </div>
            </a>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card p-4 shadow rounded-4">

                <h5>⚡ Quick Actions</h5>

                <a href="/admin/forms/create" class="btn btn-primary w-100 mb-2">
                    + Create Form
                </a>

                <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 mb-2">
                    👤 Manage Users
                </a>

                <a href="/admin/import" class="btn btn-outline-dark w-100">
                    Import Data
                </a>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 shadow rounded-4">

                <h5>📈 System Status</h5>

                <p class="text-success">✔ API Connected</p>
                <p class="text-success">✔ Database Active</p>
                <p class="text-success">✔ Admin Access Granted</p>

            </div>
        </div>

    </div>

</div>

@endsection