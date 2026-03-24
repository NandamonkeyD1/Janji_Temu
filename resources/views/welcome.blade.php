@extends('layouts.app')

@section('title', 'Daster Collection – Lingsir Ndalu Grosir')

@push('styles')
<style>
/* ── Hero ───────────────────────────────────────────────── */
.hero {
    background: linear-gradient(135deg, #FFF0F2 0%, #FFF5E1 60%, #FFF0F2 100%);
    padding: 80px 5% 72px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    min-height: 520px;
}
.hero-text .eyebrow {
    display: inline-block;
    background: var(--primary);
    color: var(--accent-dk);
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 20px;
    margin-bottom: 18px;
}
.hero-text h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3rem);
    color: var(--dark);
    line-height: 1.2;
    margin-bottom: 18px;
}
.hero-text h1 em { color: var(--accent); font-style: italic; }
.hero-text p {
    font-size: .95rem;
    color: var(--muted);
    line-height: 1.8;
    max-width: 420px;
    margin-bottom: 32px;
}
.hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }
.btn-hero-primary {
    background: var(--accent);
    color: #fff;
    padding: 13px 30px;
    border-radius: 28px;
    font-weight: 600;
    font-size: .9rem;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 4px 16px rgba(232,160,168,.4);
}
.btn-hero-primary:hover {
    background: var(--accent-dk);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(232,160,168,.5);
}
.btn-hero-outline {
    border: 2px solid var(--accent);
    color: var(--accent);
    padding: 11px 28px;
    border-radius: 28px;
    font-weight: 600;
    font-size: .9rem;
    transition: all var(--transition);
}
.btn-hero-outline:hover {
    background: var(--accent);
    color: #fff;
    transform: translateY(-2px);
}
.hero-visual {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
.hero-img-card {
    border-radius: 16px;
    overflow: hidden;
    aspect-ratio: 3/4;
    background: var(--primary);
    display: flex; align-items: center; justify-content: center;
    color: var(--accent);
    font-size: 3.5rem;
    box-shadow: var(--shadow);
}
.hero-img-card:first-child { margin-top: 28px; }
.hero-img-card img { width:100%; height:100%; object-fit:cover; }

/* ── Stats Bar ──────────────────────────────────────────── */
.stats-bar {
    background: var(--dark);
    padding: 28px 5%;
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}
.stat-item { text-align: center; }
.stat-item .num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: #fff;
    font-weight: 600;
}
.stat-item .lbl { font-size: .8rem; color: #b8a090; margin-top: 2px; }

/* ── Section ────────────────────────────────────────────── */
.section { padding: 72px 5%; }
.section-header { text-align: center; margin-bottom: 48px; }

/* ── Category Cards ─────────────────────────────────────── */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.cat-card {
    border-radius: var(--radius);
    padding: 36px 24px;
    text-align: center;
    cursor: pointer;
    transition: transform var(--transition), box-shadow var(--transition);
    position: relative;
    overflow: hidden;
}
.cat-card::before {
    content:'';
    position:absolute; inset:0;
    opacity:0;
    transition: opacity var(--transition);
}
.cat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
.cat-card:hover::before { opacity:1; }
.cat-card.motif   { background: linear-gradient(135deg, #FFF0F2, #FFE4E8); }
.cat-card.polos   { background: linear-gradient(135deg, #FFF5E1, #FFF0D0); }
.cat-card.premium { background: linear-gradient(135deg, #F0EAF8, #E8E0F5); }
.cat-icon {
    width: 64px; height: 64px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem;
    margin: 0 auto 16px;
}
.cat-card.motif   .cat-icon { background: rgba(232,160,168,.2); color: var(--accent); }
.cat-card.polos   .cat-icon { background: rgba(240,165,0,.15);  color: #d4900a; }
.cat-card.premium .cat-icon { background: rgba(140,100,200,.15); color: #8c64c8; }
.cat-card h3 { font-size: 1.05rem; font-weight: 600; color: var(--dark); margin-bottom: 6px; }
.cat-card p  { font-size: .82rem; color: var(--muted); }

/* ── Best Seller Grid ───────────────────────────────────── */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}
.product-card {
    border-radius: var(--radius);
    overflow: hidden;
    background: #fff;
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
    cursor: pointer;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}
.product-card-img {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: var(--secondary);
}
.product-card-img img {
    width:100%; height:100%;
    object-fit:cover;
    transition: transform .4s ease;
}
.product-card:hover .product-card-img img { transform: scale(1.05); }
.product-card-img .placeholder {
    width:100%; height:100%;
    display:flex; align-items:center; justify-content:center;
    color: var(--accent); font-size: 3rem;
}
.badge-bs {
    position: absolute; top: 10px; left: 10px;
    background: #FFD700;
    color: #5C4033;
    font-size: .7rem;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 10px;
    letter-spacing: .3px;
}
.badge-kat {
    position: absolute; top: 10px; right: 10px;
    background: rgba(255,255,255,.9);
    color: var(--dark);
    font-size: .7rem;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 10px;
    text-transform: capitalize;
}
.product-card-body { padding: 14px 16px 16px; }
.product-card-name {
    font-size: .9rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.product-card-price {
    font-size: 1rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 10px;
}
.product-card-stok { font-size: .75rem; color: var(--muted); margin-bottom: 12px; }
.btn-card-detail {
    display: block;
    text-align: center;
    background: var(--dark);
    color: #fff;
    padding: 8px;
    border-radius: 8px;
    font-size: .82rem;
    font-weight: 500;
    transition: background var(--transition);
}
.btn-card-detail:hover { background: var(--accent); }

/* ── CTA Booking ────────────────────────────────────────── */
.cta-section {
    background: linear-gradient(135deg, var(--dark) 0%, #6B4C3B 100%);
    padding: 72px 5%;
    text-align: center;
    color: #fff;
}
.cta-section h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    margin-bottom: 14px;
}
.cta-section p { color: #d4b8a8; font-size: .95rem; margin-bottom: 32px; max-width: 500px; margin-left:auto; margin-right:auto; }
.btn-cta {
    display: inline-block;
    background: var(--accent);
    color: #fff;
    padding: 14px 40px;
    border-radius: 32px;
    font-weight: 700;
    font-size: .95rem;
    letter-spacing: .3px;
    transition: all var(--transition);
    box-shadow: 0 4px 20px rgba(232,160,168,.4);
}
.btn-cta:hover {
    background: #fff;
    color: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(255,255,255,.2);
}

/* ── How It Works ───────────────────────────────────────── */
.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}
.step-card {
    text-align: center;
    padding: 32px 24px;
    border-radius: var(--radius);
    background: #fff;
    border: 1px solid var(--border);
    transition: box-shadow var(--transition);
}
.step-card:hover { box-shadow: var(--shadow); }
.step-num {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: var(--primary);
    color: var(--accent-dk);
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 600;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
}
.step-card h3 { font-size: .95rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
.step-card p  { font-size: .83rem; color: var(--muted); line-height: 1.7; }

/* ── Responsive ─────────────────────────────────────────── */
@media(max-width: 1024px) {
    .product-grid { grid-template-columns: repeat(3, 1fr); }
}
@media(max-width: 768px) {
    .hero { grid-template-columns: 1fr; gap: 40px; padding: 48px 5%; min-height: auto; }
    .hero-visual { display: none; }
    .hero-text p { max-width: 100%; }
    .cat-grid { grid-template-columns: 1fr; gap: 14px; }
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .steps-grid { grid-template-columns: 1fr; gap: 16px; }
    .stats-bar { gap: 32px; }
}
@media(max-width: 480px) {
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
}
</style>
@endpush

@section('content')

{{-- ── Hero ──────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-text">
        <span class="eyebrow">✦ Grosir Daster Wanita</span>
        <h1>Koleksi Daster <em>Elegan</em> untuk Setiap Hari</h1>
        <p>Temukan pilihan daster berkualitas tinggi dengan harga grosir terbaik. Motif cantik, bahan nyaman, cocok untuk semua kesempatan.</p>
        <div class="hero-actions">
            <a href="{{ route('katalog.index') }}" class="btn-hero-primary">
                <i class="fas fa-th-large"></i> Lihat Katalog
            </a>
            <a href="{{ route('booking.create') }}" class="btn-hero-outline">
                <i class="fas fa-calendar-check"></i> Booking Kunjungan
            </a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="hero-img-card"><i class="fas fa-tshirt"></i></div>
        <div class="hero-img-card"><i class="fas fa-tshirt"></i></div>
    </div>
</section>

{{-- ── Stats Bar ─────────────────────────────────────────── --}}
<div class="stats-bar">
    <div class="stat-item">
        <div class="num">{{ $totalProduk }}+</div>
        <div class="lbl">Koleksi Produk</div>
    </div>
    <div class="stat-item">
        <div class="num">3</div>
        <div class="lbl">Kategori Pilihan</div>
    </div>
    <div class="stat-item">
        <div class="num">100%</div>
        <div class="lbl">Kualitas Terjamin</div>
    </div>
    <div class="stat-item">
        <div class="num">Grosir</div>
        <div class="lbl">Harga Terbaik</div>
    </div>
</div>

{{-- ── Kategori ──────────────────────────────────────────── --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Kategori Produk</h2>
            <p class="section-sub">Pilih kategori sesuai selera Anda</p>
        </div>
        <div class="cat-grid">
            <a href="{{ route('katalog.index', ['kategori'=>'motif']) }}" class="cat-card motif">
                <div class="cat-icon"><i class="fas fa-palette"></i></div>
                <h3>Daster Motif</h3>
                <p>Beragam motif cantik dan berwarna untuk tampilan ceria</p>
            </a>
            <a href="{{ route('katalog.index', ['kategori'=>'polos']) }}" class="cat-card polos">
                <div class="cat-icon"><i class="fas fa-circle"></i></div>
                <h3>Daster Polos</h3>
                <p>Simpel dan elegan, cocok untuk aktivitas sehari-hari</p>
            </a>
            <a href="{{ route('katalog.index', ['kategori'=>'premium']) }}" class="cat-card premium">
                <div class="cat-icon"><i class="fas fa-gem"></i></div>
                <h3>Daster Premium</h3>
                <p>Bahan pilihan berkualitas tinggi untuk kenyamanan maksimal</p>
            </a>
        </div>
    </div>
</section>

{{-- ── Best Sellers ──────────────────────────────────────── --}}
@if($bestSellers->isNotEmpty())
<section class="section" style="padding-top:0">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Produk Terlaris</h2>
            <p class="section-sub">Pilihan favorit pelanggan kami</p>
        </div>
        <div class="product-grid">
            @foreach($bestSellers as $product)
            <a href="{{ route('katalog.show', $product) }}" class="product-card">
                <div class="product-card-img">
                    @if($product->gambar)
                        <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}">
                    @else
                        <div class="placeholder"><i class="fas fa-tshirt"></i></div>
                    @endif
                    <span class="badge-bs"><i class="fas fa-star"></i> Best Seller</span>
                    <span class="badge-kat">{{ $product->kategori }}</span>
                </div>
                <div class="product-card-body">
                    <div class="product-card-name">{{ $product->nama }}</div>
                    <div class="product-card-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    <div class="product-card-stok"><i class="fas fa-box"></i> Stok: {{ $product->stok }}</div>
                    <span class="btn-card-detail">Lihat Detail</span>
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:36px">
            <a href="{{ route('katalog.index') }}"
               style="display:inline-block;border:2px solid var(--accent);color:var(--accent);padding:11px 32px;border-radius:24px;font-weight:600;font-size:.9rem;transition:all var(--transition)"
               onmouseover="this.style.background='var(--accent)';this.style.color='#fff'"
               onmouseout="this.style.background='transparent';this.style.color='var(--accent)'">
                Lihat Semua Produk <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ── Cara Booking ──────────────────────────────────────── --}}
<section class="section" style="background:var(--secondary)">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Cara Booking Kunjungan</h2>
            <p class="section-sub">Mudah dan cepat dalam 3 langkah</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-num">1</div>
                <h3>Isi Form Booking</h3>
                <p>Masukkan nama, nomor WhatsApp, pilih tanggal dan jam kunjungan yang tersedia.</p>
            </div>
            <div class="step-card">
                <div class="step-num">2</div>
                <h3>Tunggu Konfirmasi</h3>
                <p>Admin kami akan segera memproses dan mengkonfirmasi jadwal kunjungan Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-num">3</div>
                <h3>Kunjungi Toko</h3>
                <p>Datang sesuai jadwal dan temukan koleksi daster pilihan Anda secara langsung.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA ───────────────────────────────────────────────── --}}
<section class="cta-section">
    <h2>Siap Menemukan Daster Impian Anda?</h2>
    <p>Booking kunjungan sekarang dan dapatkan pengalaman belanja yang menyenangkan di toko kami.</p>
    <a href="{{ route('booking.create') }}" class="btn-cta">
        <i class="fas fa-calendar-check"></i> Booking Sekarang
    </a>
</section>

@endsection
