<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Daster Collection – Lingsir Ndalu Grosir')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ── Design Tokens ──────────────────────────────────── */
        :root {
            --primary:    #F8D7DA;
            --secondary:  #FFF5E1;
            --accent:     #E8A0A8;
            --accent-dk:  #d4848d;
            --dark:       #4A3728;
            --text:       #333333;
            --muted:      #888888;
            --border:     #F0E0E2;
            --radius:     14px;
            --shadow:     0 4px 20px rgba(74,55,40,.08);
            --shadow-lg:  0 8px 32px rgba(74,55,40,.12);
            --transition: .25s ease;
        }

        /* ── Reset ──────────────────────────────────────────── */
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { font-family:'Poppins',sans-serif; color:var(--text); background:#fff; line-height:1.6; }
        a { text-decoration:none; color:inherit; }
        img { display:block; max-width:100%; }
        ul { list-style:none; }

        /* ── Navbar ─────────────────────────────────────────── */
        .navbar {
            background: rgba(255,255,255,.97);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 500;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--dark);
            letter-spacing: -.3px;
            flex-shrink: 0;
        }
        .navbar-brand span { color: var(--accent); }

        /* Desktop nav */
        .nav-desktop {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .nav-desktop a, .nav-desktop button {
            font-size: .875rem;
            font-weight: 500;
            color: var(--text);
            position: relative;
            padding-bottom: 2px;
            transition: color var(--transition);
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        .nav-desktop a::after, .nav-desktop button::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: var(--accent);
            transition: width var(--transition);
        }
        .nav-desktop a:hover, .nav-desktop a.active,
        .nav-desktop button:hover { color: var(--accent); }
        .nav-desktop a:hover::after, .nav-desktop a.active::after,
        .nav-desktop button:hover::after { width: 100%; }

        .btn-nav-booking {
            background: var(--accent);
            color: #fff !important;
            padding: 9px 22px;
            border-radius: 24px;
            font-size: .85rem;
            font-weight: 600;
            transition: background var(--transition), transform var(--transition);
            flex-shrink: 0;
        }
        .btn-nav-booking:hover {
            background: var(--accent-dk) !important;
            transform: translateY(-1px);
        }
        .btn-nav-booking::after { display: none !important; }

        /* Hamburger — hidden on desktop */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            background: none;
            border: none;
        }
        .nav-toggle span {
            display: block;
            width: 22px; height: 2px;
            background: var(--dark);
            border-radius: 2px;
            transition: var(--transition);
        }

        /* Mobile nav drawer — hidden by default always */
        .nav-mobile {
            display: none;
            position: fixed;
            top: 68px; left: 0; right: 0;
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 12px 5% 20px;
            z-index: 499;
            flex-direction: column;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
        }
        .nav-mobile.open { display: flex; }
        .nav-mobile a,
        .nav-mobile button {
            padding: 12px 0;
            font-size: .9rem;
            font-weight: 500;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            background: none;
            border-left: none;
            border-right: none;
            border-top: none;
            cursor: pointer;
            font-family: inherit;
            text-align: left;
            width: 100%;
            transition: color var(--transition);
        }
        .nav-mobile a:hover, .nav-mobile button:hover { color: var(--accent); }
        .nav-mobile a:last-child { border-bottom: none; }
        .nav-mobile .btn-mobile-booking {
            display: block;
            text-align: center;
            margin-top: 12px;
            background: var(--accent);
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: background var(--transition);
        }
        .nav-mobile .btn-mobile-booking:hover { background: var(--accent-dk); color: #fff; }

        /* ── Flash Messages ─────────────────────────────────── */
        .flash-wrap { padding: 12px 5% 0; }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: .875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-danger  { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }

        /* ── Footer ─────────────────────────────────────────── */
        .site-footer { background: var(--dark); color: #d4b8a8; margin-top: 80px; }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 5% 32px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand { font-family:'Playfair Display',serif; font-size:1.2rem; color:#fff; margin-bottom:10px; }
        .footer-brand span { color: var(--accent); }
        .footer-desc { font-size:.85rem; line-height:1.7; color:#b8a090; }
        .footer-col h4 { font-size:.9rem; font-weight:600; color:#fff; margin-bottom:14px; }
        .footer-col ul li { margin-bottom:8px; }
        .footer-col ul li a { font-size:.85rem; color:#b8a090; transition:color var(--transition); }
        .footer-col ul li a:hover { color: var(--accent); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            padding: 18px 5%;
            text-align: center;
            font-size: .8rem;
            color: #8a7060;
        }

        /* ── Utilities ──────────────────────────────────────── */
        .container { max-width:1200px; margin:0 auto; padding:0 5%; }
        .section-title { font-family:'Playfair Display',serif; font-size:1.75rem; color:var(--dark); margin-bottom:6px; }
        .section-sub { font-size:.9rem; color:var(--muted); margin-bottom:32px; }

        /* ── Pagination (Bootstrap-compatible override) ──────── */
        .pagination { display:flex; gap:4px; flex-wrap:wrap; list-style:none; padding:0; margin:0; }
        .page-item .page-link {
            display: block;
            padding: 6px 12px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: .82rem;
            color: var(--text);
            background: #fff;
            transition: all var(--transition);
            text-decoration: none;
        }
        .page-item .page-link:hover { border-color:var(--accent); color:var(--accent); }
        .page-item.active .page-link { background:var(--accent); border-color:var(--accent); color:#fff; }
        .page-item.disabled .page-link { opacity:.4; pointer-events:none; }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 768px) {
            .nav-desktop { display: none; }
            .btn-nav-booking { display: none; }
            .nav-toggle { display: flex; }
            .footer-inner { grid-template-columns: 1fr; gap: 28px; }
        }
        @media (min-width: 769px) {
            .nav-mobile { display: none !important; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ── Navbar ──────────────────────────────────────────────── --}}
<nav class="navbar">
    <a href="{{ route('home') }}" class="navbar-brand">Lingsir <span>Ndalu</span></a>

    {{-- Desktop Links --}}
    <div class="nav-desktop">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('katalog.index') }}" class="{{ request()->routeIs('katalog*') ? 'active' : '' }}">Katalog</a>
        <a href="{{ route('booking.create') }}" class="{{ request()->routeIs('booking*') ? 'active' : '' }}">Booking</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin*') ? 'active' : '' }}">Admin</a>
            @else
                <a href="{{ route('customer.bookings') }}" class="{{ request()->routeIs('customer*') ? 'active' : '' }}">Booking Saya</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Masuk</a>
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Daftar</a>
        @endauth
    </div>

    <a href="{{ route('booking.create') }}" class="btn-nav-booking">Booking Sekarang</a>

    {{-- Hamburger --}}
    <button class="nav-toggle" onclick="toggleNav()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- ── Mobile Nav Drawer ───────────────────────────────────── --}}
<div class="nav-mobile" id="navMobile">
    <a href="{{ route('home') }}">Beranda</a>
    <a href="{{ route('katalog.index') }}">Katalog</a>
    <a href="{{ route('booking.create') }}">Booking</a>
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
        @else
            <a href="{{ route('customer.bookings') }}">Booking Saya</a>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('register') }}">Daftar Akun</a>
    @endauth
    <a href="{{ route('booking.create') }}" class="btn-mobile-booking">Booking Sekarang</a>
</div>

{{-- ── Flash Messages ──────────────────────────────────────── --}}
@if(session('success') || session('error'))
<div class="flash-wrap">
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
</div>
@endif

@yield('content')

{{-- ── Footer ──────────────────────────────────────────────── --}}
<footer class="site-footer">
    <div class="footer-inner">
        <div>
            <div class="footer-brand">Lingsir <span>Ndalu</span></div>
            <p class="footer-desc">Grosir daster wanita berkualitas dengan harga terjangkau. Melayani pembelian grosir dan eceran.</p>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('katalog.index') }}">Katalog Produk</a></li>
                <li><a href="{{ route('booking.create') }}">Booking Kunjungan</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kategori</h4>
            <ul>
                <li><a href="{{ route('katalog.index', ['kategori'=>'motif']) }}">Daster Motif</a></li>
                <li><a href="{{ route('katalog.index', ['kategori'=>'polos']) }}">Daster Polos</a></li>
                <li><a href="{{ route('katalog.index', ['kategori'=>'premium']) }}">Daster Premium</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} Daster Collection – Lingsir Ndalu Grosir. All rights reserved.
    </div>
</footer>

<script>
function toggleNav() {
    const nav = document.getElementById('navMobile');
    nav.classList.toggle('open');
}
// Close mobile nav when clicking outside
document.addEventListener('click', function(e) {
    const nav = document.getElementById('navMobile');
    const toggle = document.querySelector('.nav-toggle');
    if (nav.classList.contains('open') && !nav.contains(e.target) && !toggle.contains(e.target)) {
        nav.classList.remove('open');
    }
});
</script>
@stack('scripts')
</body>
</html>
