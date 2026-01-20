<x-guest-layout>
    <div class="max-w-md mx-auto mt-20 bg-white p-8 shadow rounded">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="nama" placeholder="Nama"
                class="w-full border p-2 mb-3 rounded">

            <input type="email" name="email" placeholder="Email"
                class="w-full border p-2 mb-3 rounded">

            <input type="password" name="password" placeholder="Password"
                class="w-full border p-2 mb-3 rounded">

            <select name="role" class="w-full border p-2 mb-4 rounded">
                <option value="guru">Guru</option>
                <option value="murid">Murid</option>
            </select>

            <button class="w-full bg-green-600 text-white py-2 rounded">
                Register
            </button>
        </form>
    </div>
</x-guest-layout>
