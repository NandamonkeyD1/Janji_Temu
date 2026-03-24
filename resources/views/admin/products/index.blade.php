@extends('layouts.admin')

@section('title', 'Produk – Admin')
@section('page-title', 'Manajemen Produk')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div>
        <h1 style="font-size:1.2rem;font-weight:600;color:var(--dark)">Daftar Produk</h1>
        <p style="font-size:.82rem;color:var(--muted);margin-top:2px">Kelola semua produk katalog toko</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<div class="card">
    @if($products->isEmpty())
        <div style="text-align:center;padding:60px;color:var(--muted)">
            <i class="fas fa-tshirt" style="font-size:3rem;color:var(--border);margin-bottom:16px;display:block"></i>
            <p style="font-size:.9rem">Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color:var(--accent);font-weight:600">Tambah sekarang</a></p>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Label</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px">
                            @if($product->gambar)
                                <img src="{{ Storage::url($product->gambar) }}"
                                     style="width:44px;height:44px;object-fit:cover;border-radius:8px;flex-shrink:0">
                            @else
                                <div style="width:44px;height:44px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--accent);flex-shrink:0">
                                    <i class="fas fa-tshirt"></i>
                                </div>
                            @endif
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:var(--dark)">{{ $product->nama }}</div>
                                @if($product->deskripsi)
                                <div style="font-size:.75rem;color:var(--muted);margin-top:2px;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    {{ $product->deskripsi }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background:var(--bg);color:var(--dark);font-size:.75rem;font-weight:600;padding:3px 10px;border-radius:8px;text-transform:capitalize">
                            {{ $product->kategori }}
                        </span>
                    </td>
                    <td style="font-weight:600;color:var(--accent)">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>
                        <span style="color:{{ $product->stok > 0 ? 'var(--dark)' : '#dc3545' }};font-weight:500">
                            {{ $product->stok }}
                        </span>
                    </td>
                    <td>
                        @if($product->best_seller)
                            <span style="background:#fff3cd;color:#856404;font-size:.72rem;font-weight:700;padding:3px 9px;border-radius:8px">
                                <i class="fas fa-star"></i> Best Seller
                            </span>
                        @else
                            <span style="color:#ccc;font-size:.8rem">–</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Hapus produk {{ addslashes($product->nama) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px">{{ $products->links() }}</div>
    @endif
</div>

@endsection
