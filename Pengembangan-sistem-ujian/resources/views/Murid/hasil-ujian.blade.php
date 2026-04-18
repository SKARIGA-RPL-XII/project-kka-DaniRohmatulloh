<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Kartu nilai --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center mb-8">
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4
                {{ $nilai >= 75 ? 'bg-green-100' : ($nilai >= 60 ? 'bg-yellow-100' : 'bg-red-100') }}">
                <span class="text-3xl font-extrabold
                    {{ $nilai >= 75 ? 'text-green-600' : ($nilai >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ $nilai }}
                </span>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-1">
                {{ $nilai >= 75 ? 'Selamat, kamu lulus!' : ($nilai >= 60 ? 'Cukup baik, terus berlatih!' : 'Semangat, coba lagi!') }}
            </h2>
            <p class="text-gray-500 text-sm mb-4">Ujian {{ $mapel->nama_mapel }}</p>
            <div class="flex justify-center gap-8 text-sm">
                <div>
                    <p class="text-gray-400">Benar</p>
                    <p class="font-bold text-green-600 text-lg">{{ $benar }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Salah</p>
                    <p class="font-bold text-red-500 text-lg">{{ $totalSoal - $benar }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Total</p>
                    <p class="font-bold text-gray-700 text-lg">{{ $totalSoal }}</p>
                </div>
            </div>
        </div>

        {{-- Pembahasan --}}
        <div class="space-y-4 mb-8">
            <h3 class="font-semibold text-gray-700">Pembahasan Jawaban</h3>
            @foreach($detail as $item)
            <div class="bg-white rounded-xl border p-5
                {{ $item['tipe'] === 'pilihan_ganda' ? ($item['benar'] ? 'border-green-200' : 'border-red-200') : 'border-gray-200' }}">
                <div class="flex gap-3 mb-3">
                    <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                        {{ $item['tipe'] === 'pilihan_ganda' ? ($item['benar'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white') : 'bg-gray-200 text-gray-600' }}">
                        {{ $item['nomor'] }}
                    </span>
                    <p class="text-gray-800 text-sm font-medium pt-0.5">{{ $item['pertanyaan'] }}</p>
                </div>

                @if($item['tipe'] === 'pilihan_ganda')
                <div class="ml-10 space-y-1">
                    @foreach(['A','B','C','D'] as $opt)
                    @php $opsiKey = 'opsi_' . strtolower($opt); @endphp
                    @if($item[$opsiKey] ?? null)
                    <div class="flex items-center gap-2 text-sm px-3 py-1.5 rounded-lg
                        {{ $opt === $item['jawaban_benar'] ? 'bg-green-50 text-green-700 font-semibold' :
                           ($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'] ? 'bg-red-50 text-red-600' : 'text-gray-600') }}">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                            {{ $opt === $item['jawaban_benar'] ? 'bg-green-500 text-white' :
                               ($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'] ? 'bg-red-400 text-white' : 'bg-gray-100 text-gray-500') }}">
                            {{ $opt }}
                        </span>
                        {{ $item[$opsiKey] }}
                        @if($opt === $item['jawaban_benar'])
                            <i class="fas fa-check ml-auto text-green-500 text-xs"></i>
                        @elseif($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'])
                            <i class="fas fa-times ml-auto text-red-400 text-xs"></i>
                        @endif
                    </div>
                    @endif
                    @endforeach
                    @if(!$item['jawaban_user'])
                    <p class="text-xs text-gray-400 italic mt-1">Tidak dijawab</p>
                    @endif
                </div>
                @else
                <div class="ml-10 text-sm text-gray-600 bg-gray-50 rounded-lg p-3">
                    <p class="text-gray-400 text-xs mb-1">Jawaban kamu:</p>
                    <p>{{ $item['jawaban_user'] ?? 'Tidak dijawab' }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <a href="{{ route('murid.dashboard') }}"
           class="block text-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
            <i class="fas fa-home mr-2"></i> Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
