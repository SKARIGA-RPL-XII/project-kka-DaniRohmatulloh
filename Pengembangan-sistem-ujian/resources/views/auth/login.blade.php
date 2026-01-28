<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Ujian Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.2);
        }
        
        .logo-glow {
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }
        
        .input-focus {
            transition: all 0.3s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        }
        
        .btn-gradient:active {
            transform: translateY(0);
        }
        
        .btn-gradient::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-gradient:hover::after {
            left: 100%;
        }
        
        .social-btn {
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .error-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-y-auto">

    <!-- Floating Elements Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-10 w-72 h-72 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse delay-500"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 relative z-10 overflow-y-auto">
        
        <!-- Main Container with Glassmorphism Effect -->
        <div class="w-full max-w-lg form-container rounded-2xl p-8 md:p-10 my-8">
            
            <!-- Logo & Brand -->
            <div class="text-center mb-10">
                <div class="flex flex-col items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-3xl logo-glow floating-element">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            ExamPro
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">Sistem Ujian Online Terintegrasi</p>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">
                    Selamat Datang Kembali 👋
                </h2>
                <p class="text-gray-600 max-w-sm mx-auto">
                    Masukkan kredensial Anda untuk mengakses dashboard siswa
                </p>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-100 flex items-start gap-3 hidden error-shake">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-red-800">Login Gagal</p>
                    <p class="text-sm text-red-700 mt-1" id="error-text">Email atau password salah</p>
                </div>
                <button onclick="hideError()" class="text-red-400 hover:text-red-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Email Input -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                        Alamat Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <input
                            type="email"
                            name="email"
                            required
                            autofocus
                            class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-3 focus:ring-indigo-500/30 focus:border-indigo-500 outline-none transition-all input-focus bg-white/50"
                            placeholder="contoh: siswa@sekolah.sch.id"
                            id="emailInput">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <i class="fas fa-check-circle text-green-500 opacity-0" id="emailValid"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-indigo-500"></i>
                            Password
                        </label>
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                            <i class="fas fa-key mr-1"></i> Lupa password?
                        </a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full pl-12 pr-12 py-4 border border-gray-200 rounded-xl focus:ring-3 focus:ring-indigo-500/30 focus:border-indigo-500 outline-none transition-all input-focus bg-white/50"
                            placeholder="Masukkan password Anda"
                            id="passwordInput">
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                            onclick="togglePassword()"
                            id="togglePasswordBtn">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500 px-1">
                        <div class="flex items-center space-x-2" id="passwordStrength">
                            <span>Keamanan password:</span>
                            <div class="flex space-x-1">
                                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                            </div>
                        </div>
                        <span id="passwordHint"></span>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer group">
                        <div class="relative">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="sr-only peer"
                                id="rememberCheckbox">
                            <div class="w-5 h-5 bg-gray-100 border-2 border-gray-300 rounded-md peer-checked:bg-indigo-600 peer-checked:border-indigo-600 transition-colors duration-200 group-hover:border-indigo-400"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>
                        <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">Tetap masuk selama 30 hari</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full btn-gradient text-white font-semibold py-4 rounded-xl transition-all duration-300 transform hover:shadow-lg mt-8"
                    id="submitBtn"
                    onclick="handleLogin(event)">
                    <span class="flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        <span id="btnText">Masuk ke Dashboard</span>
                    </span>
                    <div class="hidden" id="loadingSpinner">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                    </div>
                </button>
            </form>

            <!-- Social Login -->
            <div class="mt-8">
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                </div>
                
            </div>

            <!-- Register Link -->
            <div class="text-center mt-10 pt-6 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Belum memiliki akun? 
                    <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors ml-1 group">
                        Buat akun baru
                        <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </p>
                <p class="text-xs text-gray-500 mt-4">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Keamanan data Anda terjamin dengan enkripsi SSL 256-bit
                </p>
            </div>

        </div>

    </div>

    <script>
        // Handle login form submission
        function handleLogin(event) {
            event.preventDefault();
            
            const form = document.getElementById('loginForm');
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const remember = document.querySelector('input[name="remember"]').checked;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            
            // Create form data
            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            if (remember) formData.append('remember', '1');
            
            // Submit login request
            fetch('{{ route("login") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.errors) {
                    showError(data.errors.email ? data.errors.email[0] : 'Login gagal');
                } else {
                    // Check user role and redirect
                    fetch('/test-role')
                    .then(res => res.json())
                    .then(userData => {
                        if (userData.role === 'guru') {
                            window.location.href = '/guru/dashboard';
                        } else if (userData.role === 'murid') {
                            window.location.href = '/murid/dashboard';
                        } else {
                            window.location.href = '/dashboard';
                        }
                    })
                    .catch(() => {
                        window.location.href = '/dashboard';
                    });
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                showError('Terjadi kesalahan sistem');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            });
        }
        
        // Show error message
        function showError(message) {
            const errorMsg = document.getElementById('error-message');
            const errorText = document.getElementById('error-text');
            errorText.textContent = message;
            errorMsg.classList.remove('hidden');
            errorMsg.classList.add('error-shake');
        }
        
        // Password visibility toggle
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const icon = toggleBtn.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Hide error message
        function hideError() {
            const errorMsg = document.getElementById('error-message');
            errorMsg.classList.add('hidden');
        }
        
        // Email validation
        const emailInput = document.getElementById('emailInput');
        const emailValidIcon = document.getElementById('emailValid');
        
        emailInput.addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (emailRegex.test(email)) {
                emailValidIcon.classList.remove('opacity-0');
                emailValidIcon.classList.add('opacity-100');
            } else {
                emailValidIcon.classList.remove('opacity-100');
                emailValidIcon.classList.add('opacity-0');
            }
        });
        
        // Password strength indicator
        const passwordInput = document.getElementById('passwordInput');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordHint = document.getElementById('passwordHint');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let hint = '';
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const indicators = passwordStrength.querySelectorAll('div > div');
            indicators.forEach((indicator, index) => {
                indicator.className = 'w-2 h-2 rounded-full ';
                if (index < strength) {
                    if (strength <= 2) {
                        indicator.classList.add('bg-red-500');
                    } else if (strength === 3) {
                        indicator.classList.add('bg-yellow-500');
                    } else {
                        indicator.classList.add('bg-green-500');
                    }
                } else {
                    indicator.classList.add('bg-gray-200');
                }
            });
            
            // Set hint text
            if (password.length > 0 && password.length < 8) {
                hint = 'Password minimal 8 karakter';
            } else if (strength <= 2) {
                hint = 'Password lemah';
            } else if (strength === 3) {
                hint = 'Password cukup';
            } else {
                hint = 'Password kuat';
            }
            
            passwordHint.textContent = hint;
        });
        
    </script>d.length > 0 && password.length < 8) {
                hint = 'Password minimal 8 karakter';
            } else if (strength <= 2) {
                hint = 'Password lemah';
            } else if (strength === 3) {
                hint = 'Password cukup';
            } else {
                hint = 'Password kuat';
            }
            
            passwordHint.textContent = hint;
        });
        
    </script>

</body>

</html>