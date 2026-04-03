<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — FormEngine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-brand-900 to-brand-700 flex items-center justify-center p-4"
      style="--tw-gradient-from:#1e3a8a;--tw-gradient-to:#1d4ed8">

<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-white">FormEngine</h1>
       
    </div>

    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Sign in to your account</h2>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2.5 px-4 rounded-lg transition-colors text-sm">
                    Sign In
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-500 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Register</a>
        </p>

        <div class="mt-6 pt-6 border-t border-gray-100">
            <p class="text-xs text-center text-gray-400">Demo Admin: admin@test.com / password123</p>
        </div>
    </div>
</div>
</body>
</html>