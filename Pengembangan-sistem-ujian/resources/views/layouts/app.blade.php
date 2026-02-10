<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ExamSystem')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="font-bold text-xl text-gray-800">ExamSystem</span>
                        @auth
                            @if(Auth::user()->role === 'guru')
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Guru</span>
                            @elseif(Auth::user()->role === 'murid')
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Murid</span>
                            @endif
                        @endauth
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-gray-700">Hi, {{ Auth::user()->name }}</span>
                        
                        <!-- Role-based Dashboard Links -->
                        @if(Auth::user()->role === 'guru')
                            <a href="{{ route('guru.dashboard') }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Dashboard Guru
                            </a>
                        @elseif(Auth::user()->role === 'murid')
                            <a href="/dashboard" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Dashboard Murid
                            </a>
                        @endif
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-gray-900 font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</body>
</html>