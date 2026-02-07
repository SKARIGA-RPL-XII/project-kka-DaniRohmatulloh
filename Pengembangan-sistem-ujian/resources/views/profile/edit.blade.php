<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Ujian Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
    
    <!-- NAVBAR (sama dengan sebelumnya) -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <!-- ... navbar code ... -->
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-100 flex items-center justify-center">
                    <i class="fas fa-user text-purple-600"></i>
                </div>
                Profil Saya
            </h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil dan akun Anda</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profil Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Profil</h2>
                        <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-full text-xs font-semibold">
                            Murid
                        </span>
                    </div>

                    <form method="POST" action="{{ route('murid.profil.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                                       required>
                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                                       required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">ID Pengguna</label>
                            <input type="text" value="{{ $user->id }}" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500"
                                   readonly>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                            <input type="text" value="{{ $user->created_at->translatedFormat('d F Y') }}" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500"
                                   readonly>
                        </div>

                        <div class="pt-6 border-t border-gray-100">
                            <button type="submit" 
                                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:shadow-lg transition">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Profile Photo -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                    <div class="relative inline-block">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg mx-auto mb-4">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ $user->nama }}</h3>
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                    <p class="text-xs text-gray-500 mt-2">Murid aktif</p>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('murid.ubah-password') }}" 
                           class="flex items-center gap-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition group">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-200">
                                <i class="fas fa-key"></i>
                            </div>
                            <div>
                                <p class="font-medium">Ubah Password</p>
                                <p class="text-xs text-gray-500">Ganti kata sandi</p>
                            </div>
                        </a>

                        <div class="border-t border-gray-100 my-2"></div>

                        <form method="POST" action="{{ route('logout') }}" class="pt-2">
                            @csrf
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin logout?')"
                                    class="w-full flex items-center gap-3 p-3 text-red-600 hover:bg-red-50 rounded-lg transition group">
                                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-200">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Logout</p>
                                    <p class="text-xs text-gray-500">Keluar dari sistem</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Statistik</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-file-alt text-purple-600 text-sm"></i>
                                </div>
                                <span class="text-gray-700">Ujian Diikuti</span>
                            </div>
                            <span class="font-bold text-gray-900">{{ $totalUjianDiikuti ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-chart-line text-green-600 text-sm"></i>
                                </div>
                                <span class="text-gray-700">Rata-rata Nilai</span>
                            </div>
                            <span class="font-bold text-gray-900">{{ $rataRataNilai ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-200 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-3 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                        E
                    </div>
                    <span class="font-bold text-gray-800">ExamSystem</span>
                    <span class="text-xs text-gray-500">© {{ date('Y') }} All rights reserved</span>
                </div>
                <div class="flex gap-6 text-sm text-gray-600">
                    <a href="#" class="hover:text-purple-600 transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-purple-600 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-purple-600 transition">Bantuan</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>