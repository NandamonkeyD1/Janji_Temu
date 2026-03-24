@extends('layouts.app')

@section('title', $product->nama . ' – Lingsir Ndalu Grosir')

@push('styles')
<style>
/* ── Breadcrumb ─────────────────────────────────────────── */
.breadcrumb {
    padding: 16px 5%;
    font-size: .8rem;
    color: var(--muted);
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 8px;
}
.breadcrumb a { color: var(--muted); transition: color var(--transition); }
.breadcrumb a:hover { color: var(--accent); }
.breadcrumb i { font-size: .65rem; }

/* ── Detail Layout ──────────────────────────────────────── */
.detail-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 5% 60px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 56px;
    align-items: start;
}

/* ── Image Side ─────────────────────────────────────────── */
.detail-img-main {
    border-radius: 20px;
    overflow: hidden;
    aspect-ratio: 3/4;
    background: var(--secondary);
    position: sticky;
    top: 88px;
}
.detail-img-main img {
    width:100%; height:100%;
    object-fit:cover;
}
.detail-img-placeholder {
    width:100%; height:100%;
    display:flex; align-items:center; justify-content:center;
    color: var(--accent); font-size: 6rem;
}

/* ── Info Side ──────────────────────────────────────────── */
.detail-info { padding-top: 8px; }
.detail-badges { display: flex; gap: 8px; margin-bottom: 14px; flex-wrap: wrap; }
.badge-kategori {
    background: var(--primary);
    color: var(--dark);
    font-size: .75rem;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 12px;
    text-transform: capitalize;
}
.badge-bestseller {
    background: #FFD700;
    color: #5C4033;
    font-size: .75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 12px;
}
.detail-name {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2rem);
    color: var(--dark);
    line-height: 1.25;
    margin-bottom: 16px;
}
.detail-price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 20px;
    line-height: 1;
}
.detail-price small {
    font-size: .8rem;
    font-weight: 400;
    color: var(--muted);
    display: block;
    margin-top: 4px;
}

.detail-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .85rem;
    color: var(--muted);
}
.meta-item i { color: var(--accent); width: 16px; }
.meta-item strong { color: var(--dark); }

.divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

.detail-desc-label {
    font-size: .8rem;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}
.detail-desc {
    font-size: .9rem;
    color: #555;
    line-height: 1.8;
    margin-bottom: 28px;
}

.detail-actions { display: flex; flex-direction: column; gap: 12px; }
.btn-booking-main {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: var(--accent);
    color: #fff;
    padding: 15px 32px;
    border-radius: 14px;
    font-weight: 700;
    font-size: .95rem;
    transition: all var(--transition);
    box-shadow: 0 4px 16px rgba(232,160,168,.35);
}
.btn-booking-main:hover {
    background: var(--accent-dk);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(232,160,168,.45);
}
.btn-katalog-back {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: 1.5px solid var(--border);
    color: var(--muted);
    padding: 13px 32px;
    border-radius: 14px;
    font-weight: 500;
    font-size: .9rem;
    transition: all var(--transition);
}
.btn-katalog-back:hover { border-color: var(--accent); color: var(--accent); }

/* ── Rekomendasi ────────────────────────────────────────── */
.rekomendasi-section {
    background: var(--secondary);
    padding: 60px 5%;
}
.rekomendasi-inner { max-width: 1200px; margin: 0 auto; }
.rek-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.rek-card {
    border-radius: var(--radius);
    overflow: hidden;
    background: #fff;
    border: 1px solid var(--border);
    transition: transform var(--transition), box-shadow var(--transition);
}
.rek-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}
.rek-img {
    aspect-ratio: 3/4;
    overflow: hidden;
    background: var(--primary);
}
.rek-img img { width:100%; height:100%; object-fit:cover; transition: transform .4s ease; }
.rek-card:hover .rek-img img { transform: scale(1.05); }
.rek-img .placeholder {
    width:100%; height:100%;
    display:flex; align-items:center; justify-content:center;
    color: var(--accent); font-size: 2.5rem;
}
.rek-body { padding: 12px 14px 14px; }
.rek-name { font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.rek-price { font-size: .9rem; font-weight: 700; color: var(--accent); }

/* ── Responsive ─────────────────────────────────────────── */
@media(max-width: 900px) {
    .detail-wrap { grid-template-columns: 1fr; gap: 32px; }
    .detail-img-main { position: static; aspect-ratio: 4/3; }
    .rek-grid { grid-template-columns: repeat(2, 1fr); }
}
@media(max-width: 480px) {
    .rek-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <a href="{{ route('home') }}">Beranda</a>
    <i class="fas fa-chevron-right"></i>
    <a href="{{ route('katalog.index') }}">Katalog</a>
    <i class="fas fa-chevron-right"></i>
    <span style="color:var(--dark)">{{ Str::limit($product->nama, 30) }}</span>
</div>

<div class="detail-wrap">
    {{-- Gambar --}}
    <div>
        <div class="detail-img-main">
            @if($product->gambar)
                <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}">
            @else
                <div class="detail-img-placeholder"><i class="fas fa-tshirt"></i></div>
            @endif
        </div>
    </div>

    {{-- Info --}}
    <div class="detail-info">
        <div class="detail-badges">
            <span class="badge-kategori">{{ $product->kategori }}</span>
            @if($product->best_seller)
                <span class="badge-bestseller"><i class="fas fa-star"></i> Best Seller</span>
            @endif
        </div>

        <h1 class="detail-name">{{ $product->nama }}</h1>

        <div class="detail-price">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
            <small>Harga Grosir</small>
        </div>

        <div class="detail-meta">
            <div class="meta-item">
                <i class="fas fa-box"></i>
                Stok: <strong>{{ $product->stok }} pcs</strong>
            </div>
            <div class="meta-item">
                <i class="fas fa-tag"></i>
                Kategori: <strong style="text-transform:capitalize">{{ $product->kategori }}</strong>
            </div>
        </div>

        <hr class="divider">

        @if($product->deskripsi)
        <div class="detail-desc-label">Deskripsi Produk</div>
        <p class="detail-desc">{{ $product->deskripsi }}</p>
        @endif

        <div class="detail-actions">
            <a href="{{ route('booking.create') }}" class="btn-booking-main">
                <i class="fas fa-calendar-check"></i> Booking Kunjungan Sekarang
            </a>
            <a href="{{ route('katalog.index') }}" class="btn-katalog-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</div>

{{-- Rekomendasi --}}
@if($rekomendasi->isNotEmpty())
<section class="rekomendasi-section">
    <div class="rekomendasi-inner">
        <div style="margin-bottom:32px">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:var(--dark);margin-bottom:6px">Produk Serupa</h2>
            <p style="font-size:.875rem;color:var(--muted)">Mungkin Anda juga menyukai ini</p>
        </div>
        <div class="rek-grid">
            @foreach($rekomendasi as $rek)
            <a href="{{ route('katalog.show', $rek) }}" class="rek-card">
                <div class="rek-img">
                    @if($rek->gambar)
                        <img src="{{ Storage::url($rek->gambar) }}" alt="{{ $rek->nama }}" loading="lazy">
                    @else
                        <div class="placeholder"><i class="fas fa-tshirt"></i></div>
                    @endif
                </div>
                <div class="rek-body">
                    <div class="rek-name">{{ $rek->nama }}</div>
                    <div class="rek-price">Rp {{ number_format($rek->harga, 0, ',', '.') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
