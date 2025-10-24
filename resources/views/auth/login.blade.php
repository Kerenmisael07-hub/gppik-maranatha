<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GPPIK</title>
    @if(site_setting('favicon'))
        <link rel="icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-1: #003a8c;
            --blue-2: #0066cc;
            --muted: #6b7280;
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-700: #334155;
            --gray-800: #1e293b;
        }
        
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 50%, #e0e7ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.5;
            color: var(--gray-800);
        }
        
        /* Decorative shapes */
        body::before,
        body::after {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(37, 99, 235, 0.05) 100%);
            border-radius: 50%;
            filter: blur(40px);
            z-index: 0;
        }
        
        body::before {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite;
        }
        
        body::after {
            width: 500px;
            height: 500px;
            bottom: -150px;
            right: -150px;
            animation: float 10s ease-in-out infinite reverse;
        }
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-card {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
            -webkit-animation: fadeIn 0.8s ease-out forwards;
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 340px;
            text-align: center;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .login-logo img {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: 2px solid #ffffff;
        }
        .login-logo h2 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            letter-spacing: -0.01em;
        }
        .login-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--gray-800);
            letter-spacing: -0.01em;
        }
        .login-subtitle {
            font-size: 14px;
            color: var(--gray-700);
            margin-bottom: 24px;
            line-height: 1.5;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .form-group {
            text-align: left;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }
        .login-form input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            transition: all 0.2s ease;
            color: var(--gray-800);
            background: var(--gray-50);
        }
        .login-form input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .login-form input::placeholder {
            color: var(--muted);
            font-size: 13px;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            letter-spacing: 0.01em;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(37, 99, 235, 0.25),
                       0 15px 30px rgba(37, 99, 235, 0.15);
            filter: brightness(110%);
        }
        .login-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }
        .error {
            color: #dc2626;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .error::before {
            content: '⚠️';
            font-size: 16px;
        }
        @media (max-width: 768px) {
            .login-card {
                width: 90%;
                padding: 24px;
                margin: 16px;
                border-radius: 20px;
            }
            .login-logo img {
                width: 60px;
                height: 60px;
            }
            .login-logo h2 {
                font-size: 28px;
            }
            .login-title {
                font-size: 24px;
            }
            .login-subtitle {
                font-size: 15px;
                margin-bottom: 32px;
            }
            .login-form input,
            .login-btn {
                padding: 14px;
                font-size: 15px;
            }
        }

        @media (min-width: 769px) {
            .login-card {
                width: 400px; /* Menyesuaikan lebar untuk layar besar */
                padding: 32px; /* Padding default untuk layar besar */
            }
            .login-form input {
                width: 100%; /* Memberikan ruang di sisi kiri dan kanan */
            }
            .login-btn {
                font-size: 16px; /* Ukuran font default untuk layar besar */
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ site_logo() }}" alt="Logo Maranatha" />
            <h2>Maranatha</h2>
        </div>
        <div class="login-title">Selamat Datang! 👋</div>
        <div class="login-subtitle">Silahkan masuk menggunakan akun anda</div>
        <form class="login-form" method="post" action="{{ route('login.attempt') }}">
            @csrf
            @error('email')<div class="error">{{ $message }}</div>@enderror
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email"
                       name="email" 
                       placeholder="Masukan Email Anda" 
                       value="{{ old('email') }}" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div style="position: relative;">
                    <input type="password" 
                           id="password"
                           name="password" 
                           placeholder="············" 
                           required 
                           style="padding-right: 45px;">
                    <i id="toggle-password-icon" 
                       class="fas fa-eye-slash" 
                       style="cursor: pointer; font-size: 18px; color: var(--muted); position: absolute; top: 50%; right: 16px; transform: translateY(-50%);" 
                       onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
            
            <button type="submit" class="login-btn">Masuk</button>
        </form>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggle-password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>
