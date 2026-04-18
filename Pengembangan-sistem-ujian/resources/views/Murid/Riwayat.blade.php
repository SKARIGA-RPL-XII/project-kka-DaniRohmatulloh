<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Hasil Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between">
                <!-- LOGO -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-xl text-gray-800">Ujian Sistem</span>
                        <span class="text-xs text-purple-600 font-semibold bg-purple-50 px-2 py-0.5 rounded-full ml-2">MURID</span>
                    </div>
                </div>

                <!-- MENU -->
                <ul class="hidden md:flex items-center gap-1 bg-gray-50 rounded-2xl p-1">
                    <li>
                        <a href="{{ route('murid.dashboard') }}" class="flex items-center gap-2 px-5 py-2 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white transition font-medium">
                            <i class="fas fa-home text-sm"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('murid.riwayat') }}" class="flex items-center gap-2 px-5 py-2 rounded-xl bg-white shadow-sm text-purple-600 font-semibold">
                            <i class="fas fa-history text-sm"></i>
                            Riwayat
                        </a>
                    </li>
                </ul>

                <!-- PROFILE DROPDOWN -->
                <div class="relative">
                    <button id="profileDropdownBtn" 
                            class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl border border-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="relative">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow">
                                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="hidden lg:block text-left">
                            <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->nama }}</p>
                            <p class="text-xs text-gray-500">Murid</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <!-- Header -->
                        <div class="px-5 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                            <p class="text-xs opacity-90">Login sebagai</p>
                            <p class="font-bold text-lg">{{ Auth::user()->nama }}</p>
                            <p class="text-xs opacity-75 mt-1">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('murid.profil.index') }}" 
                               class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-purple-50 transition group">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-200">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Profil Saya</p>
                                    <p class="text-xs text-gray-500">Kelola data pribadi</p>
                                </div>
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <!-- Logout Button -->
                            <button type="button" 
                                    id="logoutBtn"
                                    class="w-full text-left flex items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition group">
                                <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-200">
                                    <i class="fas fa-sign-out-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Logout</p>
                                    <p class="text-xs text-gray-500">Keluar dari sistem</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Riwayat Hasil Ujian</h1>
            <p class="text-gray-600 mt-2">Lihat semua hasil ujian yang telah Anda kerjakan, termasuk nilai dan statistik performa.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Total Ujian</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalUjian }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Rata-rata Nilai</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $rataRataNilai }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Tertinggi</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $nilaiTertinggi }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <i class="fas fa-trophy text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm">Terendah</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $nilaiTerendah }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search Section -->
        <div class="bg-white rounded-xl shadow p-5 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Hasil Ujian</h2>
                    <p class="text-gray-600 text-sm">Filter berdasarkan mata pelajaran atau status</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <form method="GET" action="{{ route('murid.riwayat') }}" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ujian..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                        </div>
                        
                        <select name="mapel_id" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Exam History List -->
        @if($riwayatUjian->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($riwayatUjian as $riwayat)
            @php
                $nilai = $riwayat->nilai ?? 0;
                $statusBg = $nilai >= 75 ? 'bg-green-100' : 'bg-red-100';
                $statusTextColor = $nilai >= 75 ? 'text-green-800' : 'text-red-800';
                $statusText = $nilai >= 75 ? 'Lulus' : 'Tidak Lulus';
                $nilaiColor = $nilai >= 75 ? 'text-blue-600' : 'text-red-600';
                $progressColor = $nilai >= 75 ? 'bg-green-500' : 'bg-red-500';
$jumlahSoal = \App\Models\Soal::where('mapel_id', $riwayat->ujian?->mapel_id)->count();
            @endphp
            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusBg }} {{ $statusTextColor }}">
                                    {{ $statusText }}
                                </span>
                                <span class="text-gray-500 text-sm">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $riwayat->ujian->nama_ujian ?? '-' }}</h3>
{{ $riwayat->ujian->mataPelajaran->nama_mapel ?? 'Tidak diketahui' }}
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold {{ $nilaiColor }}">{{ $nilai }}</div>
                            <div class="text-gray-500 text-sm">Nilai</div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Progress</span>
                            <span>{{ $nilai }}/100</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full rounded-full {{ $progressColor }}" style="width: {{ $nilai }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <div class="flex items-center text-gray-600">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ $riwayat->ujian->durasi ?? 0 }} Menit</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="far fa-question-circle mr-2"></i>
                            <span>{{ $jumlahSoal }} Soal</span>
                        </div>
                        <a href="{{ route('murid.hasil.detail', $riwayat->id) }}" 
                            class="text-blue-600 font-medium hover:text-blue-800 transition-colors flex items-center">
                             Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                         </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($riwayatUjian->hasPages())
        <div class="mt-8">
            {{ $riwayatUjian->links() }}
        </div>
        @endif
        
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 mb-4">
                <i class="fas fa-clipboard-list text-blue-500 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Riwayat Ujian</h3>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">Anda belum mengerjakan ujian apapun. Silakan kunjungi halaman dashboard untuk memulai ujian pertama Anda.</p>
            <a href="{{ route('murid.dashboard') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-external-link-alt"></i>
                Lihat Daftar Ujian
            </a>
        </div>
        @endif
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

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95">
            <div class="px-6 pt-6 pb-4">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-red-100">
                    <i class="fas fa-sign-out-alt text-2xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center">Konfirmasi Logout</h3>
                <p class="text-gray-600 text-center mt-2">Anda yakin ingin keluar dari sistem?</p>
            </div>

            <div class="px-6 pb-6">
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                        <div class="text-sm text-blue-700">
                            <p class="font-medium">Anda akan logout dari:</p>
                            <p class="mt-1">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button type="button" 
                            id="cancelLogout"
                            class="py-3 px-4 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>

                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                        @csrf
                        <button type="submit"
                                class="py-3 px-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 w-full">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Ya, Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-100 px-6 py-4 bg-gray-50 rounded-b-2xl">
                <p class="text-xs text-gray-500 text-center">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Sesi Anda akan diakhiri dengan aman
                </p>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Profile Dropdown Toggle
        document.getElementById('profileDropdownBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('profileDropdown').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = document.getElementById('profileDropdownBtn');
            
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Logout Modal Logic
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const logoutForm = document.getElementById('logoutForm');

        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.remove('hidden');
            setTimeout(() => {
                logoutModal.querySelector('.scale-95').classList.remove('scale-95');
            }, 10);
        });

        cancelLogout.addEventListener('click', function() {
            logoutModal.querySelector('.scale-95').classList.add('scale-95');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 200);
        });

        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                logoutModal.querySelector('.scale-95').classList.add('scale-95');
                setTimeout(() => {
                    logoutModal.classList.add('hidden');
                }, 200);
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !logoutModal.classList.contains('hidden')) {
                logoutModal.querySelector('.scale-95').classList.add('scale-95');
                setTimeout(() => {
                    logoutModal.classList.add('hidden');
                }, 200);
            }
        });

        logoutForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            submitBtn.disabled = true;
        });

        // Animate progress bars on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.h-full.rounded-full');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const width = bar.style.width;
                        bar.style.transition = 'width 1s ease-in-out';
                        bar.style.width = '0%';
                        
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 100);
                    }
                });
            }, { threshold: 0.5 });
            
            progressBars.forEach(bar => observer.observe(bar));
        });
    </script>
</body>
</html>