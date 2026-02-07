<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Sistem Ujian Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes appear {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-white flex items-center justify-center p-4">
    <div class="min-h-screen flex items-center justify-center p-4">

        <div
          class="max-w-md w-full bg-gradient-to-r from-blue-800 to-purple-600 rounded-xl shadow-2xl overflow-hidden p-8 space-y-8"
        >
          <h2
            class="text-center text-4xl font-extrabold text-white"
          >
            Selamat Datang
          </h2>
          <p class="text-center text-gray-200">
            Masuk ke akun Anda
          </p>
          
          <!-- Error Message -->
          @if ($errors->any())
              <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-400/30">
                  <div class="flex items-start gap-3">
                      <div class="w-10 h-10 bg-red-500/30 rounded-lg flex items-center justify-center flex-shrink-0">
                          <i class="fas fa-exclamation-circle text-red-300"></i>
                      </div>
                      <div class="flex-1">
                          <p class="text-sm font-semibold text-red-200">Login Gagal</p>
                          @foreach ($errors->all() as $error)
                              <p class="text-sm text-red-300 mt-1">{{ $error }}</p>
                          @endforeach
                      </div>
                  </div>
              </div>
          @endif
          
          <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div class="relative">
              <input
                placeholder="john@example.com"
                class="peer h-10 w-full border-b-2 border-gray-300 text-white bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500"
                required=""
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autofocus
              />
              <label
                class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                for="email"
                >Alamat Email</label
              >
            </div>
            <div class="relative">
              <input
                placeholder="Password"
                class="peer h-10 w-full border-b-2 border-gray-300 text-white bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500"
                required=""
                id="password"
                name="password"
                type="password"
              />
              <label
                class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                for="password"
                >Kata Sandi</label
              >
            </div>
            <div class="flex items-center justify-between">
              <label class="flex items-center text-sm text-gray-200">
                <input
                  class="form-checkbox h-4 w-4 text-purple-600 bg-gray-800 border-gray-300 rounded"
                  type="checkbox"
                  name="remember"
                  {{ old('remember') ? 'checked' : '' }}
                />
                <span class="ml-2">Ingat saya</span>
              </label>
              <a class="text-sm text-purple-200 hover:underline" href="{{ route('password.request') }}"
                >Lupa kata sandi?</a
              >
            </div>
            <button
              class="w-full py-2 px-4 bg-purple-500 hover:bg-purple-700 rounded-md shadow-lg text-white font-semibold transition duration-200"
              type="submit"
            >
              Masuk
            </button>
          </form>
          <div class="text-center text-gray-300">
            Belum punya akun?
            <a class="text-purple-300 hover:underline" href="{{ route('register') }}">Daftar</a>
          </div>
        </div>
    </div>
</body>
</html>