<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(99, 102, 241, 0.2); }
            50% { box-shadow: 0 0 15px rgba(99, 102, 241, 0.4); }
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        .fade-up { animation: fadeInUp 0.5s ease-out forwards; }
        .scale-in { animation: scaleIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards; }
        .float-icon { animation: float 3s ease-in-out infinite; }
        .glow-effect { animation: glow 2s ease-in-out infinite; }
        .slide-in { animation: slideIn 0.4s ease-out forwards; }
        .bounce-in { animation: bounce 0.5s ease-out; }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -12px rgba(0, 0, 0, 0.15);
        }
        
        .progress-ring {
            transition: stroke-dashoffset 0.5s ease;
        }
        
        .trophy-icon {
            filter: drop-shadow(0 4px 6px rgba(234, 179, 8, 0.3));
        }
        
        .medal-icon {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }
        
        .confetti-bg {
            position: relative;
            overflow: hidden;
        }
        
        .confetti-bg::before {
            content: "🎉";
            position: absolute;
            font-size: 80px;
            opacity: 0.05;
            right: -20px;
            top: -20px;
            transform: rotate(15deg);
        }
        
        .confetti-bg::after {
            content: "🏆";
            position: absolute;
            font-size: 70px;
            opacity: 0.05;
            left: -20px;
            bottom: -20px;
            transform: rotate(-10deg);
        }
        
        .badge-glow {
            transition: all 0.3s ease;
        }
        
        .badge-glow:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.4));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">

    <div class="max-w-3xl mx-auto px-4 py-8">

        {{-- Header dengan sentuhan game --}}
        <div class="text-center mb-6 fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-100 rounded-full text-indigo-700 text-xs font-medium mb-3">
                <i class="fas fa-flag-checkered text-xs"></i>
                <span>Mission Complete</span>
            </div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Hasil Pertempuran</h1>
            <p class="text-gray-500 text-sm mt-1">Ujian {{ $mapel->nama_mapel }}</p>
        </div>

        {{-- Kartu nilai dengan style game --}}
        <div class="confetti-bg bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center mb-8 card-hover fade-up" style="animation-delay: 0.1s">
            <div class="relative inline-block mx-auto mb-4">
                {{-- Progress ring indicator --}}
                <svg class="w-28 h-28 transform -rotate-90">
                    <circle cx="56" cy="56" r="50" stroke="#e5e7eb" stroke-width="6" fill="none"/>
                    <circle cx="56" cy="56" r="50" stroke="url(#gradient)" stroke-width="6" fill="none"
                            stroke-dasharray="314" stroke-dashoffset="{{ 314 - (314 * $nilai / 100) }}"
                            class="progress-ring" stroke-linecap="round"/>
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#6366f1"/>
                            <stop offset="100%" style="stop-color:#8b5cf6"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div>
                        <span class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            {{ $nilai }}
                        </span>
                        <span class="text-xs text-gray-400">/100</span>
                    </div>
                </div>
            </div>
            
            {{-- Badge status dengan efek game --}}
            @php
                $status = $nilai >= 75 ? 'Victory!' : ($nilai >= 60 ? 'Good Try!' : 'Keep Fighting!');
                $statusIcon = $nilai >= 75 ? 'fa-crown' : ($nilai >= 60 ? 'fa-medal' : 'fa-fist-raised');
                $statusColor = $nilai >= 75 ? 'text-green-600' : ($nilai >= 60 ? 'text-yellow-600' : 'text-orange-600');
                $bgColor = $nilai >= 75 ? 'bg-green-50' : ($nilai >= 60 ? 'bg-yellow-50' : 'bg-orange-50');
            @endphp
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-3 {{ $bgColor }} badge-glow">
                <i class="fas {{ $statusIcon }} {{ $statusColor }} text-sm"></i>
                <span class="font-semibold text-sm {{ $statusColor }}">{{ $status }}</span>
            </div>
            
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                {{ $nilai >= 75 ? 'Selamat! Kamu menang dengan gemilang!' : ($nilai >= 60 ? 'Bagus! Terus asah kemampuannya!' : 'Jangan menyerah! Setiap pertempuran adalah pelajaran!') }}
            </h2>
            
            {{-- Statistik dengan icon game --}}
            <div class="flex justify-center gap-8 mt-6 pt-4 border-t border-gray-100">
                <div class="text-center slide-in" style="animation-delay: 0.2s">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <p class="text-xs text-gray-400">Kemenangan</p>
                    <p class="font-bold text-gray-800 text-xl">{{ $benar }}</p>
                </div>
                <div class="text-center slide-in" style="animation-delay: 0.25s">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-times-circle text-red-500 text-xl"></i>
                    </div>
                    <p class="text-xs text-gray-400">Kekalahan</p>
                    <p class="font-bold text-gray-800 text-xl">{{ $totalSoal - $benar }}</p>
                </div>
                <div class="text-center slide-in" style="animation-delay: 0.3s">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-dice-d6 text-indigo-600 text-xl"></i>
                    </div>
                    <p class="text-xs text-gray-400">Total Soal</p>
                    <p class="font-bold text-gray-800 text-xl">{{ $totalSoal }}</p>
                </div>
            </div>
            
            {{-- XP Gain indicator --}}
            <div class="mt-5 pt-4 border-t border-gray-100">
                <div class="flex items-center justify-between text-xs mb-1.5">
                    <span class="text-gray-500"><i class="fas fa-star text-yellow-500 mr-1"></i> XP Gain</span>
                    <span class="font-semibold text-indigo-600">+{{ $nilai * 10 }}</span>
                </div>
                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-500" style="width: {{ $nilai }}%"></div>
                </div>
            </div>
        </div>

        {{-- Pembahasan dengan sentuhan game --}}
        <div class="mb-8 fade-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-scroll text-indigo-500"></i>
                    <span>Review Jawaban</span>
                </h3>
                <span class="text-xs text-gray-400">{{ $benar }}/{{ $totalSoal }} benar</span>
            </div>
            
            <div class="space-y-3">
                @foreach($detail as $index => $item)
                <div class="slide-in" style="animation-delay: {{ 0.3 + $index * 0.03 }}s">
                    <div class="bg-white rounded-xl border p-4 transition-all duration-300 card-hover
                        {{ $item['tipe'] === 'pilihan_ganda' ? 
                            ($item['benar'] ? 'border-green-200 hover:border-green-300' : 'border-red-200 hover:border-red-300') : 
                            'border-gray-200 hover:border-indigo-200' }}">
                        
                        {{-- Header soal dengan nomor --}}
                        <div class="flex gap-3 mb-3">
                            <div class="relative">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                                    {{ $item['tipe'] === 'pilihan_ganda' ? 
                                        ($item['benar'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') : 
                                        'bg-gray-100 text-gray-600' }}">
                                    {{ $item['nomor'] }}
                                </div>
                                @if($item['benar'])
                                <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></div>
                                @endif
                            </div>
                            <p class="text-gray-800 text-sm font-medium pt-0.5 flex-1">{{ $item['pertanyaan'] }}</p>
                            @if($item['tipe'] === 'pilihan_ganda')
                                @if($item['benar'])
                                <span class="text-xs text-green-600"><i class="fas fa-check-circle"></i> +10 XP</span>
                                @else
                                <span class="text-xs text-red-500"><i class="fas fa-skull-crossbones"></i> 0 XP</span>
                                @endif
                            @endif
                        </div>

                        @if($item['tipe'] === 'pilihan_ganda')
                        <div class="ml-10 space-y-1">
                            @foreach(['A','B','C','D'] as $opt)
                            @php $opsiKey = 'opsi_' . strtolower($opt); @endphp
                            @if($item[$opsiKey] ?? null)
                            <div class="flex items-center gap-2 text-sm px-3 py-1.5 rounded-lg transition-all
                                {{ $opt === $item['jawaban_benar'] ? 'bg-green-50 text-green-700 font-medium' :
                                   ($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'] ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-50') }}">
                                <div class="w-5 h-5 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                                    {{ $opt === $item['jawaban_benar'] ? 'bg-green-500 text-white' :
                                       ($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'] ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-500') }}">
                                    {{ $opt }}
                                </div>
                                <span class="flex-1">{{ $item[$opsiKey] }}</span>
                                @if($opt === $item['jawaban_benar'])
                                    <i class="fas fa-check-circle text-green-500 text-xs ml-auto"></i>
                                @elseif($opt === $item['jawaban_user'] && $opt !== $item['jawaban_benar'])
                                    <i class="fas fa-times-circle text-red-400 text-xs ml-auto"></i>
                                @endif
                            </div>
                            @endif
                            @endforeach
                            @if(!$item['jawaban_user'])
                            <div class="flex items-center gap-2 text-sm px-3 py-1.5 rounded-lg bg-gray-50 text-gray-500 italic">
                                <i class="fas fa-hourglass-half text-gray-400"></i>
                                <span>Tidak dijawab</span>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="ml-10">
                            <div class="bg-gradient-to-r from-gray-50 to-indigo-50/30 rounded-lg p-3 border border-gray-100">
                                <div class="flex items-start gap-2 mb-1">
                                    <i class="fas fa-pen-fancy text-indigo-400 text-xs mt-0.5"></i>
                                    <p class="text-gray-500 text-xs">Jawaban kamu:</p>
                                </div>
                                <p class="text-gray-700 text-sm">{{ $item['jawaban_user'] ?? 'Tidak dijawab' }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Tombol aksi dengan efek game --}}
        <div class="flex gap-3 fade-up" style="animation-delay: 0.4s">
            <a href="{{ route('murid.riwayat') }}" 
               class="flex-1 text-center py-3 bg-white border border-gray-200 hover:border-indigo-300 text-gray-700 font-medium rounded-xl transition-all duration-300 hover:shadow-md group">
                <i class="fas fa-history mr-2 group-hover:text-indigo-600 transition"></i> Riwayat
            </a>
            <a href="{{ route('murid.dashboard') }}" 
               class="flex-1 text-center py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg group">
                <i class="fas fa-home mr-2 group-hover:scale-110 transition"></i> Dashboard
            </a>
        </div>
        
        {{-- Achievement hint untuk nilai bagus --}}
        @if($nilai >= 80)
        <div class="mt-5 text-center fade-up" style="animation-delay: 0.5s">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-50 rounded-full text-yellow-700 text-xs border border-yellow-200">
                <i class="fas fa-unlock-alt"></i>
                <span>Achievement Unlocked: Scholar Warrior</span>
                <i class="fas fa-trophy text-yellow-500 ml-1"></i>
            </div>
        </div>
        @elseif($nilai >= 60)
        <div class="mt-5 text-center fade-up" style="animation-delay: 0.5s">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-full text-blue-700 text-xs border border-blue-200">
                <i class="fas fa-chart-line"></i>
                <span>Terus tingkatkan skill Anda!</span>
                <i class="fas fa-arrow-up text-blue-500 ml-1"></i>
            </div>
        </div>
        @endif
    </div>
</body>
</html>