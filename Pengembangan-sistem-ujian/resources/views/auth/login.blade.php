<x-guest-layout>
    <div class="max-w-md mx-auto mt-20 bg-white p-8 shadow rounded">
        <h2 class="text-2xl font-bold text-center mb-6">Login Sistem Ujian</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border rounded p-2">
            </div>

            <button class="w-full bg-blue-600 text-white py-2 rounded">
                Login
            </button>
        </form>
    </div>
</x-guest-layout>
