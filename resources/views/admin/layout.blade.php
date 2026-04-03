<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
            color: #1e293b;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            padding: 20px;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar h4 {
            font-weight: bold;
            color: #111827;
        }

        .sidebar a {
            color: #6b7280;
            text-decoration: none;
            padding: 10px 12px;
            display: block;
            border-radius: 10px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: #fff;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        /* NAVBAR */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        /* CARDS */
        .card {
            border-radius: 15px;
            border: none;
        }

        /* BUTTON */
        .btn {
            border-radius: 999px;
        }

        /* LOGOUT */
        .logout-btn {
            border-radius: 12px;
        }

        /* Avatar */
        .avatar {
            background: #2563eb;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

    </style>

</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h4 class="mb-4">🚀 Admin</h4>

        <a href="/admin/dashboard" class="active">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="/admin/forms">
            <i class="bi bi-ui-checks-grid me-2"></i> Forms
        </a>

        <a href="/admin/submissions">
            <i class="bi bi-database me-2"></i> Submissions
        </a>

        <a href="/admin/import">
            <i class="bi bi-upload me-2"></i> Import
        </a>

        <a href="/admin/export">
            <i class="bi bi-download me-2"></i> Export
        </a>

        <hr>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100 logout-btn mt-3">
                🔴 Logout
            </button>
        </form>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- NAVBAR -->
        <nav class="navbar px-4 py-3 d-flex justify-content-between">

            <div class="fw-bold text-dark">
                📊 Admin Dashboard
            </div>

            <div class="d-flex align-items-center gap-3">

                <span class="text-muted">
                    👤 {{ auth()->user()->name }}
                </span>

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>

            </div>

        </nav>

        <!-- CONTENT -->
        <div class="p-4">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>