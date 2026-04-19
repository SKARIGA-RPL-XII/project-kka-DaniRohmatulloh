{{-- resources/views/guru/soal/index.blade.php --}}
@php use App\Models\Soal; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Soal - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
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
                        {{ strtoupper(substr(auth()->user()->nama ?? 'G', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->nama ?? 'Guru' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'guru@email.com' }}</p>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-xs font-medium text-blue-700">Guru Aktif</span>
                </div>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="/guru/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group">
                    <i class="fas fa-home w-5 text-center text-gray-500 group-hover:text-indigo-600"></i><span>Dashboard</span>
                </a>
                <a href="/guru/soal" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium shadow-sm">
                    <i class="fas fa-question-circle w-5 text-center"></i><span>Kelola Soal</span>
                </a>
                <a href="/guru/examp" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group">
                    <i class="fas fa-cog w-5 text-center text-gray-500 group-hover:text-indigo-600"></i><span>Pengaturan Soal</span>
                </a>
                <a href="{{ route('guru.hasil-ujian') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors group">
                    <i class="fas fa-chart-bar w-5 text-center text-gray-500 group-hover:text-indigo-600"></i><span>Lihat Hasil Ujian</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <button onclick="showLogoutConfirm()" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors group">
                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform"></i><span>Logout</span>
                </button>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-64 overflow-y-auto bg-gray-50">
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-question-circle text-indigo-600"></i>Kelola Soal
                        </h2>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full font-medium">Bank Soal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors relative">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </div>
            </header>

            <div class="px-8 py-6">
                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-700">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-700">&times;</button>
                    </div>
                @endif

                {{-- Quick Stats --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    @php
                        $stats = [
                            ['label' => 'Total Soal', 'value' => $totalSoal, 'sub' => 'Total bank soal', 'color' => 'indigo', 'icon' => 'question'],
                            ['label' => 'Pilihan Ganda', 'value' => $soalPG, 'sub' => ($totalSoal > 0 ? round(($soalPG/$totalSoal)*100) : 0) . '% dari total', 'color' => 'blue', 'icon' => 'check-circle'],
                            ['label' => 'Essay', 'value' => $soalEssay, 'sub' => ($totalSoal > 0 ? round(($soalEssay/$totalSoal)*100) : 0) . '% dari total', 'color' => 'purple', 'icon' => 'pencil-alt'],
                            ['label' => 'Mata Pelajaran', 'value' => $mataPelajaran->count(), 'sub' => 'Total mapel', 'color' => 'orange', 'icon' => 'book']
                        ];
                    @endphp
                    @foreach($stats as $stat)
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">{{ $stat['label'] }}</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                                <p class="text-xs text-{{ $stat['color'] }}-600 mt-2">{{ $stat['sub'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-{{ $stat['color'] }}-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Action Bar --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
                    {{-- Baris 1: Judul + Tombol Aksi --}}
                    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 text-lg">Bank Soal</h3>
                        <div class="flex items-center gap-2">
                            <button onclick="showTambahMapelModal()" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                                <i class="fas fa-book-medical"></i>
                                <span>Tambah Mapel</span>
                            </button>
                            <button onclick="showTambahSoalModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Soal</span>
                            </button>
                        </div>
                    </div>
                    {{-- Baris 2: Filter + Search --}}
                    <div class="px-6 py-3 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        {{-- Tab Tipe --}}
                        <div class="flex items-center bg-gray-100 p-1 rounded-lg">
                            <button onclick="setActiveType('pg')" id="pgBtn" class="px-4 py-1.5 bg-indigo-600 text-white rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors">
                                <i class="fas fa-check-circle text-xs"></i> Pilihan Ganda
                                <span class="bg-white/20 text-white text-xs px-1.5 py-0.5 rounded-full ml-1">{{ $soalPG }}</span>
                            </button>
                            <button onclick="setActiveType('essay')" id="essayBtn" class="px-4 py-1.5 text-gray-500 hover:text-gray-700 rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors">
                                <i class="fas fa-pencil-alt text-xs"></i> Essay
                                <span class="bg-gray-300/50 text-gray-600 text-xs px-1.5 py-0.5 rounded-full ml-1">{{ $soalEssay }}</span>
                            </button>
                        </div>
                        {{-- Filter Mapel --}}
                        <div class="relative">
                            <select id="filterMapel" class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2 pl-3 pr-8 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">Semua Mapel</option>
                                @foreach($mataPelajaran as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down absolute right-2.5 top-3 text-gray-400 text-xs pointer-events-none"></i>
                        </div>
                        {{-- Search --}}
                        <div class="relative flex-1 max-w-xs">
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                            <input type="text" id="searchSoal" placeholder="Cari soal..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 w-full">
                        </div>
                    </div>
                </div>

                @php
                    // Helper: pastikan sub_questions selalu array
                    $getSubs = fn($s) => is_array($s->sub_questions)
                        ? $s->sub_questions
                        : (json_decode($s->sub_questions ?? '[]', true) ?? []);

                    $pgGroups    = $recentSoal->where('tipe', 'pilihan_ganda')->groupBy('mapel_id');
                    $essayGroups = $recentSoal->where('tipe', 'essay')->groupBy('mapel_id');
                @endphp

                {{-- PG --}}
                <div id="pgSoalGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($pgGroups as $mapelId => $group)
                    @php
                        $mapelNama  = $group->first()->mataPelajaran->nama_mapel ?? 'N/A';
                        $totalSoalN = $group->sum(fn($s) => count($getSubs($s)));
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-shadow soal-item" data-mapel="{{ $mapelId }}">
                        <div class="p-5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-file-alt text-indigo-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $mapelNama }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $totalSoalN }} soal &bull; Pilihan Ganda</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="lihatSoal({{ $mapelId }}, 'pilihan_ganda')"
                                        class="px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-medium flex items-center gap-1.5 transition-colors">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                @foreach($group as $soalRow)
                                <button onclick="editSoal({{ $soalRow->id }})" title="Edit" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button onclick="deleteSoal({{ $soalRow->id }})" title="Hapus" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12 bg-white rounded-xl border border-gray-100">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">Belum ada soal pilihan ganda</p>
                    </div>
                    @endforelse
                </div>

                {{-- Essay --}}
                <div id="essaySoalGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                    @forelse($essayGroups as $mapelId => $group)
                    @php
                        $mapelNama  = $group->first()->mataPelajaran->nama_mapel ?? 'N/A';
                        $totalSoalN = $group->sum(fn($s) => count($getSubs($s)));
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-shadow soal-item" data-mapel="{{ $mapelId }}">
                        <div class="p-5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-pencil-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $mapelNama }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $totalSoalN }} soal &bull; Essay</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="lihatSoal({{ $mapelId }}, 'essay')"
                                        class="px-3 py-1.5 bg-purple-50 hover:bg-purple-100 text-purple-600 rounded-lg text-xs font-medium flex items-center gap-1.5 transition-colors">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                @foreach($group as $soalRow)
                                <button onclick="editSoal({{ $soalRow->id }})" title="Edit" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button onclick="deleteSoal({{ $soalRow->id }})" title="Hapus" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-12 bg-white rounded-xl border border-gray-100">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">Belum ada soal essay</p>
                    </div>
                    @endforelse
                </div>

                {{-- Data soal untuk preview dikirim via PHP ke JS --}}
                @php
                    $allSoalData = [];
                    foreach($recentSoal as $s) {
                        $subs = $getSubs($s);
                        $mid  = $s->mapel_id;
                        if (!isset($allSoalData[$mid])) {
                            $allSoalData[$mid] = [
                                'tipe' => $s->tipe,
                                'nama' => $s->mataPelajaran->nama_mapel ?? 'N/A',
                                'soal' => [],
                            ];
                        }
                        foreach ($subs as $sub) {
                            $allSoalData[$mid]['soal'][] = array_merge($sub, ['tipe' => $s->tipe]);
                        }
                    }
                @endphp
            </div>
        </main>
    </div>

    {{-- Modal Preview Soal --}}
    <div id="previewModal" class="fixed inset-0 bg-gray-900/60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-2xl mx-4 shadow-2xl flex flex-col max-h-[90vh]">
            {{-- Header modal --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
                <div>
                    <h3 class="font-bold text-gray-800" id="previewTitle">Preview Soal</h3>
                    <p class="text-xs text-gray-400" id="previewSub"></p>
                </div>
                <button onclick="tutupPreview()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            {{-- Isi soal --}}
            <div id="previewBody" class="overflow-y-auto px-6 py-5 space-y-6 flex-1"></div>
            {{-- Footer --}}
            <div class="px-6 py-3 border-t border-gray-100 flex justify-end flex-shrink-0">
                <button onclick="tutupPreview()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Tambah/Edit Soal --}}
    {{-- Modal Tambah/Edit Soal --}}
<div id="soalModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-4xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Tambah Soal Baru</h3>
            <button onclick="hideSoalModal()" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" action="{{ route('guru.soal.store') }}" id="soalForm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="soal_id" id="soalId">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Soal</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg flex-1 cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="tipe" value="pilihan_ganda" class="w-4 h-4 text-indigo-600" checked onchange="toggleTipeForm()">
                            <span class="text-sm text-gray-700">Pilihan Ganda</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg flex-1 cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="tipe" value="essay" class="w-4 h-4 text-indigo-600" onchange="toggleTipeForm()">
                            <span class="text-sm text-gray-700">Essay</span>
                        </label>
                    </div>
                </div>

                <div id="subQuestionsContainer" class="space-y-4"></div>

                
                <button type="button" onclick="tambahSubQuestion()" class="w-full py-2 border-2 border-dashed border-indigo-300 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-50 flex items-center justify-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Sub Pertanyaan
                </button>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="hideSoalModal()" class="px-4 py-2 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-sm">Simpan Soal</button>
                </div>
            </div>
        </form>
    </div>
</div>
    {{-- Modal Tambah Mata Pelajaran --}}
    <div id="tambahMapelModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-gray-800">Tambah Mata Pelajaran</h3>
                <button onclick="hideTambahMapelModal()" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('guru.mapel.store') }}">
                @csrf
                <div class="space-y-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Pelajaran</label><input type="text" name="nama_mapel" required placeholder="Contoh: Matematika" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Kode Mapel</label><input type="text" name="kode_mapel" required placeholder="Contoh: MTK" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500"></div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" onclick="hideTambahMapelModal()" class="px-4 py-2 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-sm">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Logout --}}
    <div id="logoutModal" class="fixed inset-0 bg-gray-900/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-sign-out-alt text-red-600 text-2xl"></i></div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
            <p class="text-gray-600 mb-5">Apakah Anda yakin ingin keluar dari sistem?</p>
            <div class="flex gap-3">
                <button onclick="hideLogoutConfirm()" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-medium">Batal</button>
                <button onclick="logout()" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium shadow-sm">Ya, Logout</button>
            </div>
        </div>
    </div>

    <script>
        const soalData = @json($allSoalData);
        let subQuestionCount = 0;

        function toggleTipeForm() {
            const tipe = document.querySelector('input[name="tipe"]:checked').value;
            document.querySelectorAll('#subQuestionsContainer .sub-question-item').forEach(item => {
                const pg = item.querySelector('.pg-options'), essay = item.querySelector('.essay-options');
                if(pg) pg.classList.toggle('hidden', tipe !== 'pilihan_ganda');
                if(essay) essay.classList.toggle('hidden', tipe !== 'essay');
                // Atur atribut required pada radio
                const radios = item.querySelectorAll('input[type="radio"]');
                radios.forEach(radio => {
                    if (tipe === 'pilihan_ganda') {
                        radio.setAttribute('required', 'required');
                    } else {
                        radio.removeAttribute('required');
                    }
                });
            });
        }

        function tambahSubQuestion(data = null) {
            const tipe = document.querySelector('input[name="tipe"]:checked').value;
            const idx = subQuestionCount++;
            const pgHidden = tipe !== 'pilihan_ganda' ? 'hidden' : '';
            const essayHidden = tipe !== 'essay' ? 'hidden' : '';
            const ops = ['A','B','C','D'];
            const pgHtml = `<div class="pg-options ${pgHidden}"><label class="block text-sm font-medium text-gray-700 mb-2 mt-3">Opsi Jawaban</label><div class="space-y-2">` + ops.map(o => `
                <div class="flex items-center gap-3">
                    <span class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-xs font-medium text-gray-600">${o}</span>
                    <input type="text" name="sub_opsi_${o.toLowerCase()}[${idx}]" value="${data?.['opsi_' + o.toLowerCase()] || ''}" placeholder="Opsi ${o}" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <input type="radio" name="sub_jawaban_benar[${idx}]" value="${o}" ${data?.jawaban_benar === o ? 'checked' : ''} class="w-4 h-4 text-green-600" required>
                </div>`).join('') + `</div></div>`;
            const essayHtml = `<div class="essay-options ${essayHidden}"><label class="block text-sm font-medium text-gray-700 mb-1 mt-3">Pedoman Jawaban</label><textarea name="sub_pedoman_jawaban[${idx}]" rows="2" placeholder="Tulis pedoman penskoran..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">${data?.pedoman_jawaban || ''}</textarea></div>`;
            const div = document.createElement('div');
            div.className = 'sub-question-item bg-gray-50 rounded-xl p-4 border border-gray-200';
            div.innerHTML = `<div class="flex justify-between items-center mb-3"><span class="font-semibold text-gray-700 text-sm sub-question-label">Sub Pertanyaan</span><button type="button" onclick="hapusSubQuestion(this)" class="text-red-400 hover:text-red-600 text-sm"><i class="fas fa-trash"></i> Hapus</button></div><textarea name="sub_pertanyaan[${idx}]" rows="2" required placeholder="Tulis sub pertanyaan di sini..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">${data?.pertanyaan || ''}</textarea>${pgHtml}${essayHtml}`;
            document.getElementById('subQuestionsContainer').appendChild(div);
            updateSubQuestionLabels();
            reindexSubQuestions();
        }

        function hapusSubQuestion(btn) {
            const item = btn.closest('.sub-question-item');
            // Hapus required pada radio sebelum dihapus dari DOM
            const radios = item.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => radio.removeAttribute('required'));
            item.remove();
            updateSubQuestionLabels();
            reindexSubQuestions();
        }
        // Reindex semua atribut name pada sub pertanyaan agar urut dan tidak ada required radio yang tidak focusable
        function reindexSubQuestions() {
            const items = document.querySelectorAll('#subQuestionsContainer .sub-question-item');
            items.forEach((item, idx) => {
                // Textarea pertanyaan
                const pertanyaan = item.querySelector('textarea[name^="sub_pertanyaan"]');
                if (pertanyaan) pertanyaan.name = `sub_pertanyaan[${idx}]`;
                // Essay
                const essay = item.querySelector('textarea[name^="sub_pedoman_jawaban"]');
                if (essay) essay.name = `sub_pedoman_jawaban[${idx}]`;
                // Opsi PG
                ['a','b','c','d'].forEach(o => {
                    const opsi = item.querySelector(`input[name^='sub_opsi_${o}']`);
                    if (opsi) opsi.name = `sub_opsi_${o}[${idx}]`;
                });
                // Radio PG
                const radios = item.querySelectorAll('input[type="radio"][name^="sub_jawaban_benar"]');
                radios.forEach(radio => {
                    radio.name = `sub_jawaban_benar[${idx}]`;
                });
            });
        }

        function updateSubQuestionLabels() {
            const items = document.querySelectorAll('#subQuestionsContainer .sub-question-item .sub-question-label');
            items.forEach((label, idx) => {
                label.textContent = 'Sub Pertanyaan ' + (idx + 1);
            });
        }

        function lihatSoal(mapelId, tipe) {
            const data = soalData[mapelId];
            if (!data || !data.soal || data.soal.length === 0) {
                alert('Tidak ada soal untuk ditampilkan.');
                return;
            }
            document.getElementById('previewTitle').textContent = data.nama;
            document.getElementById('previewSub').textContent = data.soal.length + ' soal \u2022 ' + (tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Essay');

            let html = '';
            let nomor = 1;
            data.soal.forEach(function(soal) {
                html += '<div class="flex gap-3">';
                // Gunakan soal.nomor jika ada, jika tidak pakai counter
                html += '<span class="w-7 h-7 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">' + (soal.nomor ? soal.nomor : nomor) + '</span>';
                nomor++;
                html += '<div class="flex-1">'; 
                html += '<p class="text-gray-800 font-medium text-sm mb-2">' + soal.pertanyaan + '</p>';

                if (tipe === 'pilihan_ganda') {
                    ['A','B','C','D'].forEach(function(opt) {
                        var opsiKey = 'opsi_' + opt.toLowerCase();
                        if (!soal[opsiKey]) return;
                        var isBenar = soal.jawaban_benar === opt;
                        html += '<div class="flex items-center gap-2 text-sm px-2 py-1.5 rounded-lg mb-1 ' + (isBenar ? 'bg-green-50' : 'bg-gray-50') + '">';
                        html += '<span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 ' + (isBenar ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500') + '">' + opt + '</span>';
                        html += '<span class="' + (isBenar ? 'text-green-700 font-semibold' : 'text-gray-600') + '">' + soal[opsiKey] + '</span>';
                        if (isBenar) html += '<i class="fas fa-check text-green-500 ml-auto text-xs"></i>';
                        html += '</div>';
                    });
                } else {
                    if (soal.pedoman_jawaban) {
                        html += '<p class="text-xs text-gray-400 italic"><i class="fas fa-info-circle text-purple-400 mr-1"></i>Pedoman: ' + soal.pedoman_jawaban + '</p>';
                    }
                }
                html += '</div></div>';
            });

            document.getElementById('previewBody').innerHTML = html;
            document.getElementById('previewModal').classList.remove('hidden');
            document.getElementById('previewModal').classList.add('flex');
        }

        function tutupPreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
        }

        function showTambahSoalModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Soal Baru';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('soalForm').action = '{{ route("guru.soal.store") }}';
            document.getElementById('soalForm').reset();
            document.getElementById('subQuestionsContainer').innerHTML = '';
            subQuestionCount = 0;
            tambahSubQuestion();
            document.getElementById('soalModal').classList.remove('hidden');
            document.getElementById('soalModal').classList.add('flex');
        }

        // Validasi form sebelum submit
        document.getElementById('soalForm').addEventListener('submit', function(e) {
            const mapel = document.getElementById('mapel_id').value;
            const tipe = document.querySelector('input[name="tipe"]:checked').value;
            const subItems = document.querySelectorAll('#subQuestionsContainer .sub-question-item');

            if (!mapel) {
                e.preventDefault();
                showToast('Pilih mata pelajaran terlebih dahulu!', 'error');
                return;
            }
            if (subItems.length === 0) {
                e.preventDefault();
                showToast('Tambahkan minimal 1 sub pertanyaan!', 'error');
                return;
            }

            // Cek setiap sub pertanyaan
            let valid = true;
            subItems.forEach(function(item, i) {
                const subPertanyaan = item.querySelector('textarea[name^="sub_pertanyaan"]');
                if (!subPertanyaan || !subPertanyaan.value.trim()) {
                    valid = false;
                    showToast('Sub pertanyaan ' + (i+1) + ' tidak boleh kosong!', 'error');
                    return;
                }
                // Hanya cek radio jika tipe PG
                if (tipe === 'pilihan_ganda') {
                    const jawaban = item.querySelector('input[type="radio"]:checked');
                    if (!jawaban) {
                        valid = false;
                        showToast('Pilih jawaban benar untuk soal ' + (i+1) + '!', 'error');
                        return;
                    }
                }
            });

            if (!valid) e.preventDefault();
        });

        function showToast(msg, type) {
            const existing = document.getElementById('toastPopup');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.id = 'toastPopup';
            toast.className = 'fixed top-5 left-1/2 -translate-x-1/2 z-[999] px-5 py-3 rounded-xl shadow-lg text-sm font-medium flex items-center gap-2 transition-all ' +
                (type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white');
            toast.innerHTML = '<i class="fas ' + (type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle') + '"></i>' + msg;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function editSoal(id) {
            fetch('/guru/soal/' + id + '/edit').then(r => r.json()).then(data => {
                document.getElementById('modalTitle').innerText = 'Edit Soal';
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('soalForm').action = '/guru/soal/' + id;
                document.getElementById('soalId').value = id;
                document.getElementById('mapel_id').value = data.mapel_id;
                document.getElementById('pertanyaan_utama').value = data.pertanyaan;
                document.querySelector(`input[name="tipe"][value="${data.tipe}"]`).checked = true;
                document.getElementById('subQuestionsContainer').innerHTML = '';
                subQuestionCount = 0;
                const subs = typeof data.sub_questions === 'string' ? JSON.parse(data.sub_questions) : data.sub_questions;
                (subs && subs.length ? subs : [null]).forEach(s => tambahSubQuestion(s));
                toggleTipeForm();
                document.getElementById('soalModal').classList.remove('hidden');
                document.getElementById('soalModal').classList.add('flex');
            }).catch(() => alert('Gagal memuat data soal'));
        }

        function hideSoalModal() { document.getElementById('soalModal').classList.add('hidden'); document.getElementById('soalModal').classList.remove('flex'); }

        function deleteSoal(id) {
            if(!confirm('Apakah Anda yakin ingin menghapus soal ini?')) return;
            document.getElementById('deleteForm-' + id).submit();
        }

        function setActiveType(t) {
            const pgBtn = document.getElementById('pgBtn'), essayBtn = document.getElementById('essayBtn'), pgGrid = document.getElementById('pgSoalGrid'), essayGrid = document.getElementById('essaySoalGrid');
            if(t === 'pg') {
                pgBtn.className = 'px-4 py-1.5 bg-indigo-600 text-white rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors';
                essayBtn.className = 'px-4 py-1.5 text-gray-500 hover:text-gray-700 rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors';
                pgGrid.classList.remove('hidden'); essayGrid.classList.add('hidden');
            } else {
                essayBtn.className = 'px-4 py-1.5 bg-indigo-600 text-white rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors';
                pgBtn.className = 'px-4 py-1.5 text-gray-500 hover:text-gray-700 rounded-md text-sm font-medium flex items-center gap-1.5 transition-colors';
                essayGrid.classList.remove('hidden'); pgGrid.classList.add('hidden');
            }
        }

        function showTambahMapelModal() { document.getElementById('tambahMapelModal').classList.remove('hidden'); document.getElementById('tambahMapelModal').classList.add('flex'); }
        function hideTambahMapelModal() { document.getElementById('tambahMapelModal').classList.add('hidden'); document.getElementById('tambahMapelModal').classList.remove('flex'); }
        function showLogoutConfirm() { document.getElementById('logoutModal').classList.remove('hidden'); document.getElementById('logoutModal').classList.add('flex'); }
        function hideLogoutConfirm() { document.getElementById('logoutModal').classList.add('hidden'); document.getElementById('logoutModal').classList.remove('flex'); }
        function logout() { alert('Logout berhasil!'); window.location.href = '/login'; }

        function filterSoal(mapelId, searchText) {
            const isPg = !document.getElementById('pgSoalGrid').classList.contains('hidden');
            const items = document.querySelectorAll((isPg ? '#pgSoalGrid' : '#essaySoalGrid') + ' .soal-item');
            items.forEach(i => { i.style.display = (!mapelId || i.dataset.mapel === mapelId) && (!searchText || i.innerText.toLowerCase().includes(searchText)) ? 'block' : 'none'; });
        }

        document.getElementById('filterMapel')?.addEventListener('change', function() { filterSoal(this.value, document.getElementById('searchSoal')?.value.toLowerCase() || ''); });
        document.getElementById('searchSoal')?.addEventListener('keyup', function() { filterSoal(document.getElementById('filterMapel')?.value || '', this.value.toLowerCase()); });
        window.onclick = function(e) { ['soalModal', 'tambahMapelModal', 'logoutModal', 'previewModal'].forEach(id => { if(e.target === document.getElementById(id)) eval('hide' + id.charAt(0).toUpperCase() + id.slice(1).replace('Modal','') + 'Modal()'); }); };
        document.getElementById('previewModal').addEventListener('click', function(e) { if(e.target === this) tutupPreview(); });
        
        // Auto-remove success/error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() { alert.remove(); }, 500);
            });
        }, 5000);
    </script>

    {{-- Hidden forms untuk delete --}}
    @foreach($soal as $soalItem)
    <form id="deleteForm-{{ $soalItem->id }}" method="POST" action="/guru/soal/{{ $soalItem->id }}" style="display:none">
        @csrf
        @method('DELETE')
    </form>
    @endforeach

</body>
</html>