<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Lingsir Ndalu</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary:   #F8D7DA;
            --secondary: #FFF5E1;
            --accent:    #E8A0A8;
            --accent-dk: #d4848d;
            --dark:      #4A3728;
            --border:    #F0E0E2;
            --text:      #333333;
            --muted:     #888888;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #FFF0F2 0%, #FFF5E1 50%, #FFF0F2 100%);
        }
        a { text-decoration: none; color: inherit; }

        .register-left {
            flex: 1;
            background: linear-gradient(160deg, #4A3728 0%, #2D1F17 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            color: #d4b8a8;
        }
        .register-left .brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 12px;
        }
        .register-left .brand span { color: var(--accent); }
        .register-left p {
            font-size: .9rem;
            line-height: 1.8;
            text-align: center;
            max-width: 300px;
            color: #b8a090;
            margin-bottom: 32px;
        }
        .benefit-list { list-style: none; width: 100%; max-width: 280px; }
        .benefit-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .85rem;
            color: #d4b8a8;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .benefit-list li:last-child { border-bottom: none; }
        .benefit-list li i { color: var(--accent); width: 16px; }

        .register-right {
            flex: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 48px;
            overflow-y: auto;
        }
        .register-box {
            width: 100%;
            max-width: 440px;
        }
        .register-box h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 6px;
        }
        .register-box .sub { font-size: .875rem; color: var(--muted); margin-bottom: 28px; }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 7px;
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: .85rem;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 38px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: .9rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            background: #fafafa;
            color: var(--text);
        }
        .input-wrap input:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(232,160,168,.12);
        }
        .form-error {
            color: #c0392b;
            font-size: .75rem;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
            padding: 11px 14px;
            border-radius: 8px;
            font-size: .82rem;
            margin-bottom: 20px;
        }
        .btn-register {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-family: inherit;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(232,160,168,.35);
            margin-top: 8px;
        }
        .btn-register:hover {
            background: var(--accent-dk);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(232,160,168,.45);
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            font-size: .85rem;
            color: var(--muted);
        }
        .login-link a { color: var(--accent); font-weight: 600; }
        .login-link a:hover { text-decoration: underline; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: .82rem;
            color: #aaa;
            transition: color .2s;
        }
        .back-link:hover { color: var(--accent); }

        @media(max-width: 768px) {
            .register-left { display: none; }
            .register-right { padding: 40px 24px; }
        }
    </style>
</head>
<body>

<div class="register-left">
    <div class="brand">Lingsir <span>Ndalu</span></div>
    <p>Daftar sekarang dan nikmati kemudahan booking kunjungan toko kami.</p>
    <ul class="benefit-list">
        <li><i class="fas fa-calendar-check"></i> Booking kunjungan mudah</li>
        <li><i class="fas fa-history"></i> Riwayat booking tersimpan</li>
        <li><i class="fas fa-tshirt"></i> Akses katalog lengkap</li>
        <li><i class="fas fa-bell"></i> Notifikasi status booking</li>
    </ul>
</div>

<div class="register-right">
    <div class="register-box">
        <h1>Buat Akun Baru</h1>
        <p class="sub">Bergabung dengan pelanggan Lingsir Ndalu Grosir</p>

        @if($errors->any() && !$errors->has('email') && !$errors->has('name') && !$errors->has('no_hp') && !$errors->has('password'))
            <div class="alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap <span style="color:var(--accent)">*</span></label>
                <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Nama lengkap Anda" required autofocus>
                </div>
                @error('name')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email <span style="color:var(--accent)">*</span></label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="email@contoh.com" required>
                </div>
                @error('email')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>No. HP / WhatsApp <span style="color:var(--accent)">*</span></label>
                <div class="input-wrap">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           placeholder="Contoh: 08123456789" required>
                </div>
                @error('no_hp')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password <span style="color:var(--accent)">*</span></label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
                @error('password')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password <span style="color:var(--accent)">*</span></label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>
        </form>

        <p class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Toko
        </a>
    </div>
</div>

</body>
</html>
