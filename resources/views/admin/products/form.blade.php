@extends('layouts.admin')

@section('title', ($product->id ? 'Edit' : 'Tambah') . ' Produk – Admin')
@section('page-title', $product->id ? 'Edit Produk' : 'Tambah Produk')

@push('styles')
<style>
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
.img-preview-wrap {
    border: 2px dashed var(--border);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color var(--transition);
    background: #fafafa;
}
.img-preview-wrap:hover { border-color: var(--accent); }
.img-preview-wrap img { max-height: 160px; border-radius: 8px; margin: 0 auto 10px; }
.img-preview-wrap .placeholder-icon { font-size: 2.5rem; color: var(--border); margin-bottom: 8px; }
.img-preview-wrap p { font-size: .8rem; color: var(--muted); }
.checkbox-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    cursor: pointer;
    transition: border-color var(--transition);
    background: #fafafa;
}
.checkbox-wrap:hover { border-color: var(--accent); }
.checkbox-wrap input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; }
.checkbox-wrap label { font-size: .875rem; font-weight: 500; color: var(--dark); cursor: pointer; margin: 0; }

@media(max-width: 640px) {
    .form-grid, .form-grid-3 { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<div style="margin-bottom:20px">
    <a href="{{ route('admin.products.index') }}" style="font-size:.82rem;color:var(--muted);display:inline-flex;align-items:center;gap:6px;transition:color var(--transition)"
       onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--muted)'">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
    </a>
</div>

<div style="max-width:720px">
    <div class="card">
        <form action="{{ $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($product->id) @method('PUT') @endif

            {{-- Nama --}}
            <div class="form-group">
                <label>Nama Produk <span style="color:var(--accent)">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $product->nama) }}"
                       placeholder="Contoh: Daster Batik Motif Bunga" required>
                @error('nama')<div class="error">{{ $message }}</div>@enderror
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" rows="4"
                          placeholder="Deskripsikan produk: bahan, ukuran, keunggulan, dll.">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')<div class="error">{{ $message }}</div>@enderror
            </div>

            {{-- Harga, Stok, Kategori --}}
            <div class="form-grid-3">
                <div class="form-group" style="margin-bottom:0">
                    <label>Harga (Rp) <span style="color:var(--accent)">*</span></label>
                    <input type="number" name="harga" value="{{ old('harga', $product->harga) }}"
                           placeholder="0" min="0" required>
                    @error('harga')<div class="error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label>Stok <span style="color:var(--accent)">*</span></label>
                    <input type="number" name="stok" value="{{ old('stok', $product->stok) }}"
                           placeholder="0" min="0" required>
                    @error('stok')<div class="error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label>Kategori <span style="color:var(--accent)">*</span></label>
                    <select name="kategori" required>
                        @foreach(['motif'=>'Daster Motif','polos'=>'Daster Polos','premium'=>'Daster Premium'] as $val => $label)
                            <option value="{{ $val }}" {{ old('kategori', $product->kategori) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Gambar --}}
            <div class="form-group" style="margin-top:18px">
                <label>Gambar Produk</label>
                <div class="img-preview-wrap" onclick="document.getElementById('gambarInput').click()">
                    @if($product->gambar)
                        <img src="{{ Storage::url($product->gambar) }}" alt="Preview" id="imgPreview">
                        <p>Klik untuk ganti gambar</p>
                    @else
                        <div class="placeholder-icon" id="imgPlaceholder"><i class="fas fa-cloud-upload-alt"></i></div>
                        <img id="imgPreview" style="display:none;max-height:160px;border-radius:8px;margin:0 auto 10px">
                        <p>Klik untuk upload gambar (maks. 2MB)</p>
                    @endif
                </div>
                <input type="file" name="gambar" id="gambarInput" accept="image/*"
                       style="display:none" onchange="previewImg(this)">
                @error('gambar')<div class="error">{{ $message }}</div>@enderror
            </div>

            {{-- Best Seller --}}
            <div class="form-group">
                <div class="checkbox-wrap">
                    <input type="checkbox" name="best_seller" id="best_seller" value="1"
                           {{ old('best_seller', $product->best_seller) ? 'checked' : '' }}>
                    <label for="best_seller">
                        <i class="fas fa-star" style="color:#FFD700;margin-right:4px"></i>
                        Tandai sebagai Best Seller
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ $product->id ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('imgPreview');
            const placeholder = document.getElementById('imgPlaceholder');
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
