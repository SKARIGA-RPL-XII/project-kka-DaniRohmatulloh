<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password | Ujian Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
    
    <!-- NAVBAR (sama dengan sebelumnya) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <!-- ... navbar code ... -->
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <a href="{{ route('murid.profil') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Profil
            </a>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-100 to-cyan-100 flex items-center justify-center">
                    <i class="fas fa-key text-blue-600"></i>
                </div>
                Ubah Password
            </h1>
            <p class="text-gray-600 mt-2">Ganti kata sandi akun Anda</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-check text-green-600"></i>
            </div>
            <div class="text-green-800 font-medium">{{ session('success') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="text-red-800 font-medium">{{ session('error') }}</div>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('murid.profil.update-password') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Password Lama</label>
                    <div class="relative">
                        <input type="password" name="password_lama" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none pr-12"
                               placeholder="Masukkan password lama">
                        <button type="button" onclick="togglePassword('password_lama')" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_baru" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none pr-12"
                               placeholder="Masukkan password baru (minimal 6 karakter)"
                               id="password_baru">
                        <button type="button" onclick="togglePassword('password_baru')" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_baru')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_baru_confirmation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none pr-12"
                               placeholder="Ketik ulang password baru"
                               id="password_baru_confirmation">
                        <button type="button" onclick="togglePassword('password_baru_confirmation')" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Strength Indicator -->
                <div class="p-4 bg-gray-50 rounded-xl">
                    <p class="text-sm font-medium text-gray-700 mb-2">Ketentuan Password:</p>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2 text-xs"></i>
                            Minimal 6 karakter
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2 text-xs"></i>
                            Gunakan kombinasi huruf dan angka
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2 text-xs"></i>
                            Hindari password yang mudah ditebak
                        </li>
                    </ul>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-between">
                    <a href="{{ route('murid.profil') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-medium rounded-xl hover:shadow-lg transition">
                        <i class="fas fa-save mr-2"></i> Simpan Password
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId) || document.querySelector(`[name="${inputId}"]`);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>