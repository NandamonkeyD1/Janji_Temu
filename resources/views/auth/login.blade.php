<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – Lingsir Ndalu</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --accent: #E8A0A8;
            --accent-dk: #d4848d;
            --dark: #4A3728;
            --border: #F0E0E2;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #FFF0F2 0%, #FFF5E1 50%, #FFF0F2 100%);
        }
        a { text-decoration: none; color: inherit; }

        .login-left {
            flex: 1;
            background: linear-gradient(160deg, #4A3728 0%, #2D1F17 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            color: #d4b8a8;
        }
        .login-left .brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 12px;
        }
        .login-left .brand span { color: var(--accent); }
        .login-left p {
            font-size: .9rem;
            line-height: 1.8;
            text-align: center;
            max-width: 300px;
            color: #b8a090;
        }
        .login-left .deco {
            margin-top: 40px;
            display: flex;
            gap: 16px;
        }
        .deco-card {
            width: 80px; height: 100px;
            border-radius: 12px;
            background: rgba(255,255,255,.06);
            display: flex; align-items: center; justify-content: center;
            color: rgba(232,160,168,.4);
            font-size: 2rem;
        }
        .deco-card:nth-child(2) { margin-top: 20px; background: rgba(232,160,168,.1); color: rgba(232,160,168,.6); }

        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 48px;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
        }
        .login-box h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 6px;
        }
        .login-box .sub { font-size: .875rem; color: #888; margin-bottom: 32px; }

        .form-group { margin-bottom: 18px; }
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
        }
        .input-wrap input:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(232,160,168,.12);
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
        .btn-login {
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
        .btn-login:hover {
            background: var(--accent-dk);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(232,160,168,.45);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: .82rem;
            color: #aaa;
            transition: color .2s;
        }
        .back-link:hover { color: var(--accent); }

        @media(max-width: 768px) {
            .login-left { display: none; }
            .login-right { padding: 40px 24px; }
        }
    </style>
</head>
<body>

<div class="login-left">
    <div class="brand">Lingsir <span>Ndalu</span></div>
    <p>Panel admin untuk mengelola produk dan booking kunjungan toko Anda.</p>
    <div class="deco">
        <div class="deco-card"><i class="fas fa-tshirt"></i></div>
        <div class="deco-card"><i class="fas fa-calendar-check"></i></div>
        <div class="deco-card"><i class="fas fa-chart-pie"></i></div>
    </div>
</div>

<div class="login-right">
    <div class="login-box">
        <h1>Selamat Datang</h1>
        <p class="sub">Masuk ke panel admin Lingsir Ndalu</p>

        @if($errors->any())
            <div class="alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@example.com" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>

        <p style="text-align:center;margin-top:18px;font-size:.85rem;color:#aaa">
            Belum punya akun? <a href="{{ route('register') }}" style="color:var(--accent);font-weight:600">Daftar di sini</a>
        </p>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Toko
        </a>
    </div>
</div>

</body>
</html>
