<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin – Lingsir Ndalu')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg:  #2D1F17;
            --sidebar-w:   240px;
            --accent:      #E8A0A8;
            --accent-dk:   #d4848d;
            --bg:          #F7F3F1;
            --white:       #ffffff;
            --border:      #EDE8E5;
            --text:        #333333;
            --muted:       #888888;
            --dark:        #4A3728;
            --radius:      12px;
            --shadow:      0 2px 12px rgba(0,0,0,.06);
            --transition:  .2s ease;
        }

        /* ── Bootstrap Pagination Override ─────────────────── */
        .pagination { gap: 4px; flex-wrap: wrap; }
        .page-link {
            border-radius: 7px !important;
            border: 1.5px solid var(--border) !important;
            color: var(--text) !important;
            font-size: .8rem;
            padding: 5px 11px;
            transition: all var(--transition);
        }
        .page-link:hover { border-color: var(--accent) !important; color: var(--accent) !important; background: #fff !important; }
        .page-item.active .page-link { background: var(--accent) !important; border-color: var(--accent) !important; color: #fff !important; }
        .page-item.disabled .page-link { opacity: .4; }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Poppins',sans-serif; background:var(--bg); display:flex; min-height:100vh; color:var(--text); }
        a { text-decoration:none; color:inherit; }

        /* ── Sidebar ──────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            color: #d4b8a8;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: transform var(--transition);
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .sidebar-brand .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #fff;
            font-weight: 600;
        }
        .sidebar-brand .logo span { color: var(--accent); }
        .sidebar-brand .sub {
            font-size: .72rem;
            color: #8a7060;
            margin-top: 2px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .sidebar-nav { flex: 1; padding: 12px 0; overflow-y: auto; }
        .nav-label {
            font-size: .65rem;
            font-weight: 700;
            color: #6a5040;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 14px 20px 6px;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 20px;
            font-size: .85rem;
            color: #b8a090;
            border-left: 3px solid transparent;
            transition: all var(--transition);
        }
        .sidebar-nav a i { width: 16px; font-size: .9rem; }
        .sidebar-nav a:hover { background: rgba(255,255,255,.05); color: #fff; }
        .sidebar-nav a.active {
            background: rgba(232,160,168,.12);
            color: var(--accent);
            border-left-color: var(--accent);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,.07);
        }
        .sidebar-footer .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: rgba(232,160,168,.2);
            display: flex; align-items: center; justify-content: center;
            color: var(--accent);
            font-size: .85rem;
        }
        .user-name { font-size: .82rem; color: #d4b8a8; font-weight: 500; }
        .user-role { font-size: .7rem; color: #8a7060; }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .8rem;
            color: #8a7060;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            padding: 0;
            transition: color var(--transition);
        }
        .btn-logout:hover { color: var(--accent); }

        /* ── Main ─────────────────────────────────────────── */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .admin-topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title { font-size: .95rem; font-weight: 600; color: var(--dark); }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-right a {
            font-size: .8rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color var(--transition);
        }
        .topbar-right a:hover { color: var(--accent); }

        .admin-content { padding: 28px 32px; flex: 1; }

        /* ── Alerts ───────────────────────────────────────── */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: .875rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-danger  { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }

        /* ── Cards ────────────────────────────────────────── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 24px;
        }

        /* ── Table ────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .85rem; }
        thead th {
            text-align: left;
            padding: 10px 14px;
            background: #faf8f7;
            color: var(--muted);
            font-weight: 600;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }
        tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #faf8f7; }

        /* ── Buttons ──────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: .82rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            font-family: inherit;
            transition: all var(--transition);
            text-decoration: none;
        }
        .btn:hover { opacity: .88; transform: translateY(-1px); }
        .btn-primary   { background: var(--accent); color: #fff; }
        .btn-success   { background: #28a745; color: #fff; }
        .btn-danger    { background: #dc3545; color: #fff; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-outline   { background: transparent; border: 1.5px solid var(--border); color: var(--muted); }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
        .btn-sm { padding: 5px 12px; font-size: .78rem; }

        /* ── Badges ───────────────────────────────────────── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: .72rem;
            font-weight: 600;
        }
        .badge-pending  { background: #fff3cd; color: #856404; }
        .badge-approved { background: #d4edda; color: #155724; }
        .badge-rejected { background: #f8d7da; color: #721c24; }

        /* ── Form ─────────────────────────────────────────── */
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 7px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-family: inherit;
            font-size: .875rem;
            outline: none;
            transition: border-color var(--transition);
            background: #fafafa;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--accent);
            background: #fff;
        }
        .form-group .error { color: #c0392b; font-size: .78rem; margin-top: 4px; }

        /* ── Pagination ───────────────────────────────────── */
        .pagination { display: flex; gap: 6px; list-style: none; flex-wrap: wrap; }
        .page-item .page-link {
            padding: 6px 12px;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            font-size: .8rem;
            color: var(--text);
            transition: all var(--transition);
        }
        .page-item .page-link:hover { border-color: var(--accent); color: var(--accent); }
        .page-item.active .page-link { background: var(--accent); color: #fff; border-color: var(--accent); }
        .page-item.disabled .page-link { opacity: .4; cursor: not-allowed; }

        /* ── Responsive ───────────────────────────────────── */
        @media(max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .admin-content { padding: 20px 16px; }
            .admin-topbar { padding: 0 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div id="sidebarOverlay" onclick="toggleSidebar()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:99"></div>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="logo">Lingsir <span>Ndalu</span></div>
        <div class="sub">Admin Panel</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="fas fa-tshirt"></i> Produk
        </a>
        <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Booking
        </a>
        <div class="nav-label">Lainnya</div>
        <a href="{{ route('home') }}" target="_blank">
            <i class="fas fa-store"></i> Lihat Toko
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar"><i class="fas fa-user"></i></div>
            <div>
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div class="admin-main">
    <header class="admin-topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button onclick="toggleSidebar()" style="display:none;background:none;border:none;cursor:pointer;padding:4px;flex-direction:column;gap:4px" id="sidebarToggle" aria-label="Menu">
                <span style="display:block;width:20px;height:2px;background:var(--dark);border-radius:2px"></span>
                <span style="display:block;width:20px;height:2px;background:var(--dark);border-radius:2px"></span>
                <span style="display:block;width:20px;height:2px;background:var(--dark);border-radius:2px"></span>
            </button>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Toko
            </a>
        </div>
    </header>

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const isOpen = sidebar.classList.toggle('open');
    overlay.style.display = isOpen ? 'block' : 'none';
}
function initMobile() {
    const btn = document.getElementById('sidebarToggle');
    btn.style.display = window.innerWidth <= 768 ? 'flex' : 'none';
    if (window.innerWidth > 768) {
        document.getElementById('sidebarOverlay').style.display = 'none';
        document.getElementById('sidebar').classList.remove('open');
    }
}
initMobile();
window.addEventListener('resize', initMobile);
</script>
</body>
</html>
