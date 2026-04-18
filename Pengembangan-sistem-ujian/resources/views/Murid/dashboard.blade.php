<!DOCTYPE html>
@php use App\Models\Soal; @endphp
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Murid | Ujian Sistem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                        <a href="{{ route('murid.dashboard') }}" class="flex items-center gap-2 px-5 py-2 rounded-xl bg-white shadow-sm text-purple-600 font-semibold">
                            <i class="fas fa-home text-sm"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('murid.riwayat') }}" class="flex items-center gap-2 px-5 py-2 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white transition font-medium">
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
        <!-- HEADER -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-user-graduate text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                                Selamat Datang, <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">{{ Auth::user()->nama }}</span>
                            </h1>
                            <p class="text-gray-600 mt-1 flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-sm"></i>
                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-3 max-w-2xl">
                        Siap untuk mengasah kemampuanmu hari ini? 
                        @if($soalPerMapel->count() > 0)
                        Ada <span class="font-semibold text-purple-600">{{ $soalPerMapel->count() }} mata pelajaran</span> yang tersedia!
                        @else
                        Saat ini belum ada soal yang tersedia.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- STATISTICS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Card 1: Total Ujian Diikuti -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Ujian Diikuti</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalUjianDiikuti ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center">
                        <i class="fas fa-file-alt text-xl text-purple-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        @if($ujianBaruMingguIni > 0)
                        <span class="text-green-600 font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            {{ $ujianBaruMingguIni ?? 0 }} baru minggu ini
                        </span>
                        @else
                        <span class="text-gray-500 font-medium">
                            Belum ada ujian baru
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card 2: Rata-rata Nilai -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Rata-rata Nilai</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $rataRataNilai ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-xl text-green-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        @if($rataRataNilai > 75)
                        <span class="text-green-600 font-medium flex items-center">
                            <i class="fas fa-trend-up mr-1 text-xs"></i>
                            Nilai baik
                        </span>
                        @elseif($rataRataNilai > 0)
                        <span class="text-yellow-600 font-medium flex items-center">
                            <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                            Perlu peningkatan
                        </span>
                        @else
                        <span class="text-gray-500 font-medium">
                            Belum ada nilai
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card 3: Ujian Tersedia -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Mapel Tersedia</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $soalPerMapel->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center">
                        <i class="fas fa-clock text-xl text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        @if($soalPerMapel->count() > 0)
                        <span class="text-orange-600 font-medium flex items-center">
                            <i class="fas fa-book-open mr-1 text-xs"></i>
                            Siap dikerjakan
                        </span>
                        @else
                        <span class="text-gray-500 font-medium">
                            Tidak ada soal
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card 4: Nilai Tertinggi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Nilai Tertinggi</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $nilaiTertinggi ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                        <i class="fas fa-trophy text-xl text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        @if($nilaiTertinggi > 0)
                        <span class="text-blue-600 font-medium flex items-center">
                            <i class="fas fa-crown mr-1 text-xs"></i>
                            Pencapaian terbaik
                        </span>
                        @else
                        <span class="text-gray-500 font-medium">
                            Belum ada nilai
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- UJIAN TERSEDIA SECTION -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-book-open text-purple-600"></i>
                        </div>
                        Ujian Tersedia
                    </h2>
                    <p class="text-gray-600 mt-2">Pilih ujian yang ingin kamu kerjakan</p>
                </div>
                
                @if($soalPerMapel->count() > 0 && $mataPelajaran->count() > 0)
                <div class="flex gap-2">
                    <form method="GET" action="{{ route('murid.dashboard') }}" class="flex gap-2">
                        <select name="mapel_id" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @endif
            </div>

            @if($soalPerMapel->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($soalPerMapel as $item)
                @php
                    $mapel = $item->mataPelajaran;
                    $totalSoal = Soal::where('mapel_id', $item->mapel_id)->sum(\DB::raw('JSON_LENGTH(sub_questions)'));
                    $colors = ['from-purple-400','from-blue-400','from-green-400','from-orange-400','from-pink-400'];
                    $tos    = ['to-indigo-500','to-cyan-500','to-teal-500','to-red-400','to-rose-500'];
                    $bgs    = ['bg-purple-50','bg-blue-50','bg-green-50','bg-orange-50','bg-pink-50'];
                    $texts  = ['text-purple-700','text-blue-700','text-green-700','text-orange-700','text-pink-700'];
                    $idx    = $item->mapel_id % 5;
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <div class="h-2 bg-gradient-to-r {{ $colors[$idx] }} {{ $tos[$idx] }}"></div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 {{ $bgs[$idx] }} {{ $texts[$idx] }} rounded-full text-xs font-semibold">
                                    {{ $mapel->nama_mapel ?? 'N/A' }}
                                </span>
                                <h3 class="font-bold text-gray-900 text-lg mt-2">Soal {{ $mapel->nama_mapel ?? 'N/A' }}</h3>
                            </div>
                            <div class="w-10 h-10 rounded-lg {{ $bgs[$idx] }} flex items-center justify-center">
                                <i class="fas fa-book {{ $texts[$idx] }}"></i>
                            </div>
                        </div>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-question-circle {{ $texts[$idx] }} mr-2"></i>
                                <span>{{ $totalSoal }} Soal tersedia</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-layer-group {{ $texts[$idx] }} mr-2"></i>
                                <span>{{ Soal::where('mapel_id', $item->mapel_id)->count() }} Paket soal</span>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('murid.ujian.mulai', $item->mapel_id) }}"
                               class="block text-center px-5 py-2.5 bg-gradient-to-r {{ $colors[$idx] }} {{ $tos[$idx] }} text-white font-semibold rounded-xl hover:shadow-lg transition">
                                Mulai Ujian
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @else
            <!-- TAMPILAN JIKA TIDAK ADA SOAL -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-gray-100 to-gray-200 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-book-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Belum Ada Soal Tersedia</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Saat ini belum ada soal yang tersedia. Silakan hubungi guru Anda atau coba lagi nanti.
                </p>
                <a href="{{ route('murid.dashboard') }}" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-medium hover:shadow-lg transition">
                    <i class="fas fa-refresh mr-2"></i> Refresh Halaman
                </a>
            </div>
            @endif
        </section>

        <!-- RIWAYAT UJIAN SECTION -->
        @if($riwayatUjian && $riwayatUjian->count() > 0)
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-100 to-cyan-100 flex items-center justify-center">
                            <i class="fas fa-history text-blue-600"></i>
                        </div>
                        Riwayat Ujian Terakhir
                    </h2>
                    <p class="text-gray-600 mt-2">Lihat hasil ujian yang sudah kamu kerjakan</p>
                </div>
                @if(isset($riwayatUjian) && $riwayatUjian->count() > 0)
                <a href="{{ route('murid.riwayat') }}" class="px-4 py-2 text-purple-600 hover:text-purple-700 font-medium flex items-center gap-2">
                    Lihat Semua <i class="fas fa-arrow-right text-sm"></i>
                </a>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Nama Ujian</th>
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Mata Pelajaran</th>
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Nilai</th>
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Tanggal</th>
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Status</th>
                                <th class="text-left py-4 px-6 text-gray-600 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatUjian as $riwayat)
                            @php
                                $nilai = $riwayat->nilai ?? 0;
                                $statusColor = $nilai >= 75 ? 'bg-green-100 text-green-800' : 
                                             ($nilai >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                $statusText = $nilai >= 75 ? 'Lulus' : 
                                            ($nilai >= 60 ? 'Cukup' : 'Tidak Lulus');
                            @endphp
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-4 px-6">
                                    <div class="font-medium text-gray-900">{{ $riwayat->ujian->nama_ujian ?? '-' }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">
                                        {{ $riwayat->ujian->mataPelajaran->nama_mapel ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <span class="text-2xl font-bold {{ $nilai >= 75 ? 'text-green-600' : ($nilai >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $nilai }}
                                        </span>
                                        <span class="text-gray-400 mx-2">/</span>
                                        <span class="text-gray-600">100</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    {{ $riwayat->created_at ? \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 {{ $statusColor }} rounded-full text-xs font-semibold">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    @if(isset($riwayat->id))
                                    <a href="{{ route('murid.hasil.detail', $riwayat->id) }}" 
                                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                        Detail
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @elseif($totalUjianDiikuti > 0)
        <!-- Jika ada ujian diikuti tapi tidak ada riwayat (seharusnya tidak terjadi) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-gray-100 to-gray-200 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-history text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">Belum Ada Riwayat Ujian</h3>
            <p class="text-gray-600 mb-6">
                Data riwayat ujian tidak ditemukan.
            </p>
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

    <!-- CUSTOM LOGOUT MODAL -->
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

    <!-- JavaScript for Dropdown -->
    <script>
        // Toggle profile dropdown
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
            logoutModal.querySelector('div').classList.add('scale-95');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 200);
        });

        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                logoutModal.querySelector('div').classList.add('scale-95');
                setTimeout(() => {
                    logoutModal.classList.add('hidden');
                }, 200);
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !logoutModal.classList.contains('hidden')) {
                logoutModal.querySelector('div').classList.add('scale-95');
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
    </script>

</body>
</html>