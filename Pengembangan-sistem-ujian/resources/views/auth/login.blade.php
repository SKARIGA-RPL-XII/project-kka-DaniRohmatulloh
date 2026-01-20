<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Ujian Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- Header -->
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Sistem Ujian Online
        </h2>
        <p class="text-center text-gray-500 mb-6">
            Login Guru & Murid
        </p>

        <!-- Error -->
        @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="email@gmail.com">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="••••••••">
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                Login
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            © {{ date('Y') }} Sistem Ujian Online
        </p>

    </div>

</body>

</html>