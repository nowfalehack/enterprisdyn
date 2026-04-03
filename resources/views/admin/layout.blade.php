<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Premium Styles -->
    <style>
        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0f172a, #020617);
            color: #fff;
            position: fixed;
            padding: 20px;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar a {
            color: #cbd5f5;
            text-decoration: none;
            padding: 10px 12px;
            display: block;
            border-radius: 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }

        /* CARDS */
        .card {
            border-radius: 20px;
        }

        /* BUTTON */
        .btn {
            border-radius: 999px;
        }

        /* LOGOUT */
        .logout-btn {
            border-radius: 12px;
        }

    </style>

</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h4 class="mb-4">🚀 Admin</h4>

        <a href="/admin/dashboard">
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

            <div class="fw-bold">
                📊 Admin Dashboard
            </div>

            <div class="d-flex align-items-center gap-3">

                <span class="text-muted">
                    👤 {{ auth()->user()->name }}
                </span>

                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width:40px;height:40px;">
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