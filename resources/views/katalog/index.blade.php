@extends('layouts.app')

@section('title', 'Katalog Daster – Lingsir Ndalu Grosir')

@push('styles')
<style>
/* ── Page Header ────────────────────────────────────────── */
.page-hero {
    background: linear-gradient(135deg, #FFF0F2 0%, #FFF5E1 100%);
    padding: 52px 5% 44px;
    text-align: center;
}
.page-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 2.4rem);
    color: var(--dark);
    margin-bottom: 8px;
}
.page-hero p { color: var(--muted); font-size: .9rem; }

/* ── Filter Bar ─────────────────────────────────────────── */
.filter-section {
    background: #fff;
    border-bottom: 1px solid var(--border);
    padding: 18px 5%;
    position: sticky;
    top: 68px;
    z-index: 100;
}
.filter-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}
.search-wrap {
    flex: 1;
    min-width: 200px;
    position: relative;
}
.search-wrap i {
    position: absolute;
    left: 13px; top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: .85rem;
}
.search-wrap input {
    width: 100%;
    padding: 9px 14px 9px 36px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family: inherit;
    font-size: .875rem;
    outline: none;
    transition: border-color var(--transition);
    background: #fafafa;
}
.search-wrap input:focus { border-color: var(--accent); background: #fff; }

.filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
.filter-tab {
    padding: 8px 18px;
    border-radius: 20px;
    font-size: .82rem;
    font-weight: 500;
    cursor: pointer;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--muted);
    transition: all var(--transition);
    text-decoration: none;
}
.filter-tab:hover { border-color: var(--accent); color: var(--accent); }
.filter-tab.active { background: var(--accent); color: #fff; border-color: var(--accent); }

.btn-search {
    background: var(--accent);
    color: #fff;
    border: none;
    padding: 9px 20px;
    border-radius: 10px;
    font-family: inherit;
    font-size: .875rem;
    font-weight: 500;
    cursor: pointer;
    transition: background var(--transition);
    white-space: nowrap;
}
.btn-search:hover { background: var(--accent-dk); }

/* ── Product Grid ───────────────────────────────────────── */
.catalog-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 36px 5% 60px;
}
.result-info {
    font-size: .85rem;
    color: var(--muted);
    margin-bottom: 24px;
}
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
    font-size: .68rem;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 10px;
}
.badge-kat {
    position: absolute; top: 10px; right: 10px;
    background: rgba(255,255,255,.92);
    color: var(--dark);
    font-size: .68rem;
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
    margin-bottom: 4px;
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

/* ── Empty State ────────────────────────────────────────── */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: var(--muted);
}
.empty-state i { font-size: 3.5rem; color: var(--border); margin-bottom: 16px; }
.empty-state h3 { font-size: 1.1rem; color: var(--dark); margin-bottom: 8px; }
.empty-state p  { font-size: .875rem; }

/* ── Pagination ─────────────────────────────────────────── */
.pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 48px;
}
.pagination-wrap nav { display: flex; gap: 6px; }
.pagination-wrap .pagination { display: flex; gap: 6px; list-style: none; }
.pagination-wrap .page-item .page-link {
    padding: 8px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: .82rem;
    color: var(--text);
    transition: all var(--transition);
}
.pagination-wrap .page-item .page-link:hover { border-color: var(--accent); color: var(--accent); }
.pagination-wrap .page-item.active .page-link {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent);
}
.pagination-wrap .page-item.disabled .page-link { opacity: .4; cursor: not-allowed; }

/* ── Responsive ─────────────────────────────────────────── */
@media(max-width: 1024px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
@media(max-width: 768px)  {
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .filter-section { top: 60px; }
}
@media(max-width: 400px)  { .product-grid { gap: 10px; } }
</style>
@endpush

@section('content')

<div class="page-hero">
    <h1>Katalog Daster</h1>
    <p>Temukan koleksi daster berkualitas dengan harga grosir terbaik</p>
</div>

<div class="filter-section">
    <form class="filter-inner" method="GET" action="{{ route('katalog.index') }}">
        <div class="search-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="Cari nama atau deskripsi produk..." value="{{ request('search') }}">
        </div>
        <div class="filter-tabs">
            <a href="{{ route('katalog.index', array_merge(request()->except('kategori','page'), [])) }}"
               class="filter-tab {{ !request('kategori') || request('kategori') === 'semua' ? 'active' : '' }}">
                Semua
            </a>
            @foreach(['motif'=>'Motif','polos'=>'Polos','premium'=>'Premium'] as $val => $label)
            <a href="{{ route('katalog.index', array_merge(request()->except('page'), ['kategori'=>$val])) }}"
               class="filter-tab {{ request('kategori') === $val ? 'active' : '' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
        @if(request('search'))
        <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
        @endif
    </form>
</div>

<div class="catalog-wrap">
    @if(request('search') || request('kategori'))
    <p class="result-info">
        Menampilkan {{ $products->total() }} produk
        @if(request('search')) untuk "<strong>{{ request('search') }}</strong>"@endif
        @if(request('kategori') && request('kategori') !== 'semua') kategori <strong>{{ request('kategori') }}</strong>@endif
    </p>
    @endif

    @if($products->isEmpty())
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Produk tidak ditemukan</h3>
            <p>Coba kata kunci lain atau pilih kategori berbeda</p>
            <a href="{{ route('katalog.index') }}"
               style="display:inline-block;margin-top:16px;background:var(--accent);color:#fff;padding:10px 24px;border-radius:20px;font-size:.875rem;font-weight:600">
                Lihat Semua Produk
            </a>
        </div>
    @else
        <div class="product-grid">
            @foreach($products as $product)
            <a href="{{ route('katalog.show', $product) }}" class="product-card">
                <div class="product-card-img">
                    @if($product->gambar)
                        <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}" loading="lazy">
                    @else
                        <div class="placeholder"><i class="fas fa-tshirt"></i></div>
                    @endif
                    @if($product->best_seller)
                        <span class="badge-bs"><i class="fas fa-star"></i> Best Seller</span>
                    @endif
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

        <div class="pagination-wrap">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
