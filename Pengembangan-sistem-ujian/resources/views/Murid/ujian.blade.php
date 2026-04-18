<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ujian {{ $mapel->nama_mapel }} - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    {{-- Header --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Ujian {{ $mapel->nama_mapel }}</p>
                    <p class="text-xs text-gray-500">{{ count($soalList) }} soal</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                {{-- Timer --}}
                <div class="flex items-center gap-2 bg-orange-50 border border-orange-200 px-3 py-1.5 rounded-lg">
                    <i class="fas fa-clock text-orange-500 text-sm"></i>
                    <span id="timer" class="font-mono font-bold text-orange-600 text-sm">60:00</span>
                </div>
                <span class="text-xs text-gray-500">
                    <span id="terjawab">0</span>/{{ count($soalList) }} terjawab
                </span>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4 py-6 flex gap-6">

        {{-- Kolom kiri: soal --}}
        <div class="flex-1">
            <form id="ujianForm" method="POST" action="{{ route('murid.ujian.submit', $mapel_id) }}">
                @csrf

                <div class="space-y-6">
                    @foreach($soalList as $soal)
                    <div class="bg-white rounded-xl border border-gray-200 p-6 soal-card" id="soal-{{ $soal['nomor'] }}">
                        {{-- Nomor & pertanyaan --}}
                        <div class="flex gap-3 mb-4">
                            <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">
                                {{ $soal['nomor'] }}
                            </span>
                            <p class="text-gray-800 font-medium pt-1">{{ $soal['pertanyaan'] }}</p>
                        </div>

                        {{-- Pilihan Ganda --}}
                        @if($soal['tipe'] === 'pilihan_ganda')
                        <div class="space-y-2 ml-11">
                            @foreach(['A','B','C','D'] as $opt)
                            @php $opsiKey = 'opsi_' . strtolower($opt); @endphp
                            @if($soal[$opsiKey])
                            <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-indigo-50 hover:border-indigo-300 transition-colors opsi-label"
                                   data-nomor="{{ $soal['nomor'] }}">
                                <input type="radio"
                                       name="jawaban[{{ $soal['nomor'] }}]"
                                       value="{{ $opt }}"
                                       class="w-4 h-4 text-indigo-600 opsi-radio"
                                       data-nomor="{{ $soal['nomor'] }}"
                                       onchange="tandaiTerjawab({{ $soal['nomor'] }})">
                                <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold flex-shrink-0">{{ $opt }}</span>
                                <span class="text-gray-700 text-sm">{{ $soal[$opsiKey] }}</span>
                            </label>
                            @endif
                            @endforeach
                        </div>

                        {{-- Essay --}}
                        @else
                        <div class="ml-11">
                            <textarea name="jawaban[{{ $soal['nomor'] }}]"
                                      rows="4"
                                      placeholder="Tulis jawaban kamu di sini..."
                                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                                      onkeyup="tandaiTerjawab({{ $soal['nomor'] }}, this.value)"></textarea>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-8 bg-white rounded-xl border border-gray-200 p-5 flex items-center justify-between">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle text-indigo-400 mr-1"></i>
                        Pastikan semua soal sudah dijawab sebelum submit.
                    </p>
                    <button type="button" onclick="konfirmasiSubmit()"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i> Kumpulkan Jawaban
                    </button>
                </div>
            </form>
        </div>

        {{-- Kolom kanan: navigasi nomor soal --}}
        <div class="w-56 flex-shrink-0">
            <div class="bg-white rounded-xl border border-gray-200 p-4 sticky top-20">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Navigasi Soal</p>
                <div class="grid grid-cols-5 gap-1.5 mb-4">
                    @foreach($soalList as $soal)
                    <button type="button"
                            onclick="scrollKeSoal({{ $soal['nomor'] }})"
                            id="nav-{{ $soal['nomor'] }}"
                            class="w-8 h-8 rounded-lg text-xs font-semibold border border-gray-200 text-gray-500 hover:border-indigo-400 hover:text-indigo-600 transition-colors">
                        {{ $soal['nomor'] }}
                    </button>
                    @endforeach
                </div>
                <div class="space-y-1.5 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 rounded bg-indigo-600 inline-block"></span> Sudah dijawab
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 rounded border border-gray-300 inline-block"></span> Belum dijawab
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal konfirmasi submit --}}
    <div id="modalSubmit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full mx-4 shadow-2xl">
            <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-paper-plane text-indigo-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 text-center mb-1">Kumpulkan Jawaban?</h3>
            <p class="text-sm text-gray-500 text-center mb-5">
                <span id="infoTerjawab"></span> soal terjawab dari {{ count($soalList) }} soal.
                Jawaban tidak bisa diubah setelah dikumpulkan.
            </p>
            <div class="flex gap-3">
                <button onclick="tutupModal()" class="flex-1 py-2.5 border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50">Batal</button>
                <button onclick="document.getElementById('ujianForm').submit()"
                        class="flex-1 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700">
                    Ya, Kumpulkan
                </button>
            </div>
        </div>
    </div>

    <script>
        const totalSoal = {{ count($soalList) }};
        const terjawab = {};

        // Timer 60 menit
        let sisa = 60 * 60;
        const timerEl = document.getElementById('timer');
        const interval = setInterval(() => {
            sisa--;
            const m = String(Math.floor(sisa / 60)).padStart(2, '0');
            const s = String(sisa % 60).padStart(2, '0');
            timerEl.textContent = m + ':' + s;
            if (sisa <= 300) timerEl.classList.add('text-red-600');
            if (sisa <= 0) {
                clearInterval(interval);
                document.getElementById('ujianForm').submit();
            }
        }, 1000);

        function tandaiTerjawab(nomor, val) {
            if (val !== undefined && val.trim() === '') {
                delete terjawab[nomor];
            } else {
                terjawab[nomor] = true;
            }
            updateNav(nomor);
            document.getElementById('terjawab').textContent = Object.keys(terjawab).length;
        }

        function updateNav(nomor) {
            const btn = document.getElementById('nav-' + nomor);
            if (!btn) return;
            if (terjawab[nomor]) {
                btn.className = 'w-8 h-8 rounded-lg text-xs font-semibold bg-indigo-600 text-white border border-indigo-600';
            } else {
                btn.className = 'w-8 h-8 rounded-lg text-xs font-semibold border border-gray-200 text-gray-500 hover:border-indigo-400 hover:text-indigo-600 transition-colors';
            }
        }

        // Highlight opsi yang dipilih
        document.querySelectorAll('.opsi-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const nomor = this.dataset.nomor;
                document.querySelectorAll('[data-nomor="' + nomor + '"].opsi-label').forEach(label => {
                    label.classList.remove('bg-indigo-50', 'border-indigo-400');
                    label.classList.add('border-gray-200');
                });
                this.closest('.opsi-label').classList.add('bg-indigo-50', 'border-indigo-400');
                this.closest('.opsi-label').classList.remove('border-gray-200');
            });
        });

        function scrollKeSoal(nomor) {
            document.getElementById('soal-' + nomor)?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function konfirmasiSubmit() {
            document.getElementById('infoTerjawab').textContent = Object.keys(terjawab).length;
            document.getElementById('modalSubmit').classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalSubmit').classList.add('hidden');
        }
    </script>
</body>
</html>
