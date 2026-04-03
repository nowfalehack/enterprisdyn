<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            padding: 25px 15px;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #111827;
        }

        .sidebar a {
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: 0.3s;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: #fff;
        }

        /* Topbar */
        .topbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2563eb;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Content */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        /* Cards */
        .card {
            border-radius: 15px;
        }

        /* Buttons */
        .btn-modern {
            border-radius: 30px;
        }

        /* Scroll */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">

        <h4>🚀 User Panel</h4>

        <a href="/dashboard" class="active">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <a href="/forms">
            <i class="fas fa-file-alt"></i> Forms
        </a>

        <a href="/my-submissions">
            <i class="fas fa-database"></i> My Submissions
        </a>

        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100 btn-modern">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>

    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Topbar -->
        <div class="topbar">

            <h5 class="mb-0 text-dark">Welcome Back 👋</h5>

            <div class="user-box">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>

        </div>

        <!-- Page Content -->
        <div class="p-4">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>