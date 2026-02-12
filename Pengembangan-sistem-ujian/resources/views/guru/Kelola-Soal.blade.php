<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-screen">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800 text-lg">ExamSystem</h1>
                        <p class="text-xs text-gray-500">Dashboard Guru</p>
                    </div>
                </div>
            </div>
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->nama }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-xs font-medium text-blue-700">Guru Aktif</span>
                </div>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="/guru/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group">
                    <i class="fas fa-home w-5 text-center text-gray-500 group-hover:text-indigo-600"></i><span>Dashboard</span></a>
                <a href="/guru/soal" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium shadow-sm">
                    <i class="fas fa-question-circle w-5 text-center"></i><span>Kelola Soal</span></a>
                <a href="/guru/examp" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group">
                    <i class="fas fa-cog w-5 text-center text-gray-500 group-hover:text-indigo-600"></i><span>Pengaturan Soal</span></a>
                <a href="{{ route('guru.hasil-ujian') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group"><i class="fas fa-chart-bar w-5 text-center text-gray-500 group-hover:text-indigo-600">
                </i><span>Lihat Hasil Ujian</span></a>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <button onclick="showLogoutConfirm()" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors group"><i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform"></i><span>Logout</span></button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 overflow-y-auto bg-gray-50">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-question-circle text-indigo-600"></i>Kelola Soal</h2>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full font-medium">Bank Soal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors relative"><i class="fas fa-bell text-lg"></i><span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span></button>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors"><i class="fas fa-search text-lg"></i></button>
                    </div>
                </div>
            </header>

            <div class="px-8 py-6">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Soal</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $totalSoal }}</p>
                                <p class="text-xs text-green-600 mt-2">Total bank soal</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center"><i class="fas fa-question text-indigo-600 text-xl"></i></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Pilihan Ganda</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $soalPG }}</p>
                                <p class="text-xs text-blue-600 mt-2">{{ $totalSoal > 0 ? round(($soalPG/$totalSoal)*100) : 0 }}% dari total</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center"><i class="fas fa-check-circle text-blue-600 text-xl"></i></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Essay</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $soalEssay }}</p>
                                <p class="text-xs text-purple-600 mt-2">{{ $totalSoal > 0 ? round(($soalEssay/$totalSoal)*100) : 0 }}% dari total</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center"><i class="fas fa-pencil-alt text-purple-600 text-xl"></i></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Mata Pelajaran</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $mataPelajaran->count() }}</p>
                                <p class="text-xs text-orange-600 mt-2">Total mapel</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center"><i class="fas fa-book text-orange-600 text-xl"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full lg:w-auto">
                            <h3 class="font-semibold text-gray-800 text-lg">Bank Soal</h3>
                            <div class="flex items-center gap-2 bg-gray-50 p-1 rounded-lg border border-gray-200 w-full sm:w-auto">
                                <button onclick="setActiveType('pg')" id="pgBtn" class="flex-1 sm:flex-none px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center justify-center gap-2 shadow-sm"><i class="fas fa-check-circle"></i><span>Pilihan Ganda</span><span class="bg-white/20 px-1.5 py-0.5 rounded-full text-xs">{{ $soalPG }}</span></button>
                                <button onclick="setActiveType('essay')" id="essayBtn" class="flex-1 sm:flex-none px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-lg text-sm font-medium flex items-center justify-center gap-2"><i class="fas fa-pencil-alt"></i><span>Essay</span><span class="bg-gray-200/50 px-1.5 py-0.5 rounded-full text-xs">{{ $soalEssay }}</span></button>
                            </div>
                            <div class="relative w-full sm:w-48"><select class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2 pl-4 pr-10 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 w-full">
                                    <option value="">Semua Mapel</option>
                                    @foreach($mataPelajaran as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select><i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-xs"></i></div>
                        </div>
                        <div class="flex items-center gap-3 w-full lg:w-auto">
                            <div class="relative flex-1 lg:flex-initial"><i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i><input type="text" placeholder="Cari soal..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 w-full lg:w-64"></div>
                            <button onclick="showTambahSoalModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 shadow-sm whitespace-nowrap">
                                <i class="fas fa-plus-circle"></i><span>Tambah Soal</span></button>
                        </div>
                    </div>
                    <div id="essayFilters" class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 hidden">
                        <div><label class="block text-xs font-medium text-gray-500 mb-1">Panjang Jawaban</label>
                            <div class="flex gap-2"><button class="flex-1 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">Pendek</button><button class="flex-1 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">Sedang</button><button class="flex-1 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">Panjang</button></div>
                        </div>
                        <div><label class="block text-xs font-medium text-gray-500 mb-1">Pedoman</label>
                            <div class="flex gap-2"><button class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200">Ada Rubrik</button><button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">Tanpa</button></div>
                        </div>
                        <div><label class="block text-xs font-medium text-gray-500 mb-1">Batas Kata</label>
                            <div class="flex gap-2"><button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">≤100</button><button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">100-300</button><button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-200">≥300</button></div>
                        </div>
                        <div><label class="block text-xs font-medium text-gray-500 mb-1">Kesulitan</label>
                            <div class="flex gap-2"><button class="flex-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-xs font-medium hover:bg-green-200">Mudah</button><button class="flex-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-medium hover:bg-yellow-200">Sedang</button><button class="flex-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-xs font-medium hover:bg-red-200">Sulit</button></div>
                        </div>
                    </div>
                </div>

                <!-- Soal Grids -->
                <div id="pgSoalGrid" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @forelse($recentSoal->where('tipe', 'pilihan_ganda') as $soal)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">{{ $soal->mataPelajaran->nama_mapel ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg"><i class="fas fa-edit"></i></button>
                                    <button onclick="deleteSoal({{ $soal->id }})" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-800 font-medium mb-2">{{ $soal->nomor }}. {{ $soal->pertanyaan }}</p>
                                <div class="space-y-2 ml-2">
                                    @foreach(['A' => $soal->opsi_a, 'B' => $soal->opsi_b, 'C' => $soal->opsi_c, 'D' => $soal->opsi_d] as $key => $opsi)
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-5 h-5 {{ $soal->jawaban_benar == $key ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} rounded-full flex items-center justify-center text-xs font-medium">{{ $key }}</span>
                                        <span class="text-gray-700 {{ $soal->jawaban_benar == $key ? 'font-medium' : '' }}">{{ $opsi }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100 text-xs text-gray-500">
                                <span><i class="fas fa-clock mr-1"></i>{{ $soal->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">Belum ada soal pilihan ganda</p>
                    </div>
                    @endforelse
                </div>

                <div id="essaySoalGrid" class="grid grid-cols-1 lg:grid-cols-2 gap-6 hidden">
                    @forelse($recentSoal->where('tipe', 'essay') as $soal)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow p-6">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">{{ $soal->mataPelajaran->nama_mapel ?? 'N/A' }}</span>
                            </div>
                            <div class="flex gap-1">
                                <button class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteSoal({{ $soal->id }})" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <p class="text-gray-800 font-medium mb-3">{{ $soal->nomor }}. {{ $soal->pertanyaan }}</p>
                        <div class="flex justify-between pt-3 border-t border-gray-100 text-xs text-gray-500 mt-3">
                            <span><i class="fas fa-clock mr-1"></i>{{ $soal->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">Belum ada soal essay</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Soal -->
    <div id="tambahSoalModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-2xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-gray-800">Tambah Soal Baru</h3><button onclick="hideTambahSoalModal()" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg"><i class="fas fa-times"></i></button>
            </div>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Tipe Soal</label>
                    <div class="flex gap-4"><label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg flex-1 cursor-pointer hover:bg-gray-50"><input type="radio" name="tipe_soal" value="pg" class="w-4 h-4 text-indigo-600" checked><span class="text-sm text-gray-700">Pilihan Ganda</span></label><label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg flex-1 cursor-pointer hover:bg-gray-50"><input type="radio" name="tipe_soal" value="essay" class="w-4 h-4 text-indigo-600"><span class="text-sm text-gray-700">Essay</span></label></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Soal</label><textarea rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Tulis soal di sini..."></textarea></div>
                <div id="pgOptions">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Opsi Jawaban</label>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-medium text-gray-600">A</span>
                            <input type="text" placeholder="Opsi A" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                            <input type="radio" name="kunci_jawaban" value="A" class="w-4 h-4 text-green-600">
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-medium text-gray-600">B</span>
                            <input type="text" placeholder="Opsi B" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                            <input type="radio" name="kunci_jawaban" value="B" class="w-4 h-4 text-green-600">
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-medium text-gray-600">C</span>
                            <input type="text" placeholder="Opsi C" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                            <input type="radio" name="kunci_jawaban" value="C" class="w-4 h-4 text-green-600">
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-medium text-gray-600">D</span>
                            <input type="text" placeholder="Opsi D" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                            <input type="radio" name="kunci_jawaban" value="D" class="w-4 h-4 text-green-600">
                        </div>
                    </div>
                    <button class="mt-2 text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1"><i class="fas fa-plus-circle"></i>Tambah Opsi</button>
                </div>
                <div id="essayOptions" class="hidden">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-blue-700 mb-2">Pedoman Penskoran</label>
                        <div class="space-y-3">
                            <div><label class="block text-xs text-gray-600 mb-1">Batas Kata</label><input type="number" placeholder="500" class="w-full border border-blue-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"></div>
                            <div><label class="block text-xs text-gray-600 mb-1">Skor Maksimal</label><input type="number" placeholder="50" class="w-full border border-blue-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"></div>
                            <div><label class="block text-xs text-gray-600 mb-1">Rubrik</label><textarea rows="2" placeholder="Kriteria penilaian..." class="w-full border border-blue-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"></textarea></div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button onclick="hideTambahSoalModal()" class="px-4 py-2 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-sm">Simpan Soal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Logout -->
    <div id="logoutModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-sign-out-alt text-red-600 text-2xl"></i></div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
            <p class="text-gray-600 mb-5">Apakah Anda yakin ingin keluar dari sistem?</p>
            <div class="flex gap-3"><button onclick="hideLogoutConfirm()" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-medium">Batal</button><button onclick="logout()" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium shadow-sm">Ya, Logout</button></div>
        </div>
    </div>

    <script>
        function setActiveType(t) {
            let e = document.getElementById('pgBtn'),
                a = document.getElementById('essayBtn'),
                o = document.getElementById('pgFilters'),
                l = document.getElementById('essayFilters'),
                s = document.getElementById('pgSoalGrid'),
                i = document.getElementById('essaySoalGrid');
            'pg' == t ? (e.className = 'flex-1 sm:flex-none px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center justify-center gap-2 shadow-sm', a.className = 'flex-1 sm:flex-none px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-lg text-sm font-medium flex items-center justify-center gap-2', o.classList.remove('hidden'), l.classList.add('hidden'), s.classList.remove('hidden'), i.classList.add('hidden'), document.getElementById('paginationInfo').innerHTML = 'Menampilkan 1-4 dari 180 soal pilihan ganda') : (a.className = 'flex-1 sm:flex-none px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium flex items-center justify-center gap-2 shadow-sm', e.className = 'flex-1 sm:flex-none px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-lg text-sm font-medium flex items-center justify-center gap-2', l.classList.remove('hidden'), o.classList.add('hidden'), i.classList.remove('hidden'), s.classList.add('hidden'), document.getElementById('paginationInfo').innerHTML = 'Menampilkan 1-4 dari 65 soal essay')
        }

        function showTambahSoalModal() {
            document.getElementById('tambahSoalModal').classList.remove('hidden'), document.getElementById('tambahSoalModal').classList.add('flex')
        }

        function hideTambahSoalModal() {
            document.getElementById('tambahSoalModal').classList.add('hidden'), document.getElementById('tambahSoalModal').classList.remove('flex')
        }

        function toggleSoalOptions() {
            let t = document.getElementById('pgOptions'),
                e = document.getElementById('essayOptions');
            document.querySelector('input[name="tipe_soal"][value="pg"]').checked ? (t.classList.remove('hidden'), e.classList.add('hidden')) : (e.classList.remove('hidden'), t.classList.add('hidden'))
        }

        function showLogoutConfirm() {
            document.getElementById('logoutModal').classList.remove('hidden'), document.getElementById('logoutModal').classList.add('flex')
        }

        function hideLogoutConfirm() {
            document.getElementById('logoutModal').classList.add('hidden'), document.getElementById('logoutModal').classList.remove('flex')
        }

        function logout() {
            alert('Logout berhasil!'), window.location.href = '/login'
        }
        document.addEventListener('DOMContentLoaded', function() {
            let t = document.querySelector('input[name="tipe_soal"][value="pg"]'),
                e = document.querySelector('input[name="tipe_soal"][value="essay"]');
            t && e && (t.addEventListener('change', toggleSoalOptions), e.addEventListener('change', toggleSoalOptions))
        }), window.onclick = function(t) {
            t.target === document.getElementById('logoutModal') && hideLogoutConfirm(), t.target === document.getElementById('tambahSoalModal') && hideTambahSoalModal()
        };
    </script>
</body>

</html>