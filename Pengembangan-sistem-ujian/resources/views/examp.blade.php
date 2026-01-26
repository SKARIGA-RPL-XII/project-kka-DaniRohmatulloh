<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ujian Game Edukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Ujian Game Edukasi</h1>

    <!-- Timer -->
    <p class="mb-4 font-semibold">
        Waktu tersisa: <span id="timer" class="text-red-500"></span>
    </p>

    <!-- Aturan -->
    <ul class="list-disc ml-5 text-sm mb-4">
        <li>Jawaban benar mendapat poin</li>
        <li>Tidak bisa menjeda ujian</li>
        <li>Ujian berakhir otomatis saat waktu habis</li>
    </ul>

    <!-- Soal -->
    <form method="POST" action="/ujian/jawab">
        @csrf
        <p class="mb-2">1. 2 + 2 = ?</p>

        <input type="hidden" name="jawaban" value="benar">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Jawab
        </button>
    </form>

    @if(session('skor'))
        <p class="mt-4 text-green-600">
            Skor kamu: {{ session('skor') }}
        </p>
    @endif
</div>

<script>
    let waktu = 1800; // 30 minutes in seconds

    const timer = setInterval(() => {
        let menit = Math.floor(waktu / 60);
        let detik = waktu % 60;

        document.getElementById('timer').innerText =
            menit + ":" + (detik < 10 ? "0" : "") + detik;

        waktu--;

        if (waktu < 0) {
            clearInterval(timer);
            alert("Waktu ujian habis!");
            document.querySelector('form').submit();
        }
    }, 1000);
</script>

</body>
</html>
