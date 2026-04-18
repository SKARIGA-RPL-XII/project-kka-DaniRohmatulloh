
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hasil Ujian - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 text-center">
                <i class="fas fa-chart-line text-5xl mb-4 opacity-90"></i>
                <h1 class="text-3xl font-bold mb-2">Detail Hasil Ujian</h1>
                <p class="opacity-90">Lihat analisis lengkap performa ujian Anda</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Ujian</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Nama Ujian</span>
                                <span class="font-semibold">{{ $hasil->ujian->nama_ujian ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Mata Pelajaran</span>
                                <span class="font-semibold">{{ $hasil->ujian->mataPelajaran->nama_mapel ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Tanggal Ujian</span>
                                <span class="font-semibold">{{ $hasil->created_at->translatedFormat('d F Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-semibold">{{ $hasil->ujian->durasi ?? 0 }} menit</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Hasil Anda</h3>
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-200">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-green-600 mb-2">{{ $hasil->nilai ?? 0 }}</div>
                                <div class="text-sm text-gray-600 uppercase tracking-wide font-semibold">Nilai Akhir</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kembali ke Riwayat</h3>
                    <a href="{{ route('murid.riwayat') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        Lihat Semua Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

