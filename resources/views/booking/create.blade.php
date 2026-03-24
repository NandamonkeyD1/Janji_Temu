@extends('layouts.app')

@section('title', 'Booking Kunjungan – Lingsir Ndalu Grosir')

@push('styles')
<style>
/* ── Layout ─────────────────────────────────────────────── */
.booking-page {
    background: linear-gradient(160deg, #FFF0F2 0%, #FFF5E1 50%, #fff 100%);
    min-height: calc(100vh - 68px);
    padding: 52px 5% 80px;
}
.booking-container {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 48px;
    align-items: start;
}

/* ── Left Info Panel ────────────────────────────────────── */
.booking-info { position: sticky; top: 88px; }
.booking-info h1 {
    font-family: 'Playfair Display', serif;
    font-size: 1.9rem;
    color: var(--dark);
    line-height: 1.2;
    margin-bottom: 12px;
}
.booking-info p {
    font-size: .875rem;
    color: var(--muted);
    line-height: 1.8;
    margin-bottom: 28px;
}
.info-card {
    background: #fff;
    border-radius: var(--radius);
    padding: 20px;
    border: 1px solid var(--border);
    margin-bottom: 16px;
}
.info-card h3 {
    font-size: .85rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.info-card h3 i { color: var(--accent); }
.jam-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.jam-chip {
    background: var(--secondary);
    color: var(--dark);
    font-size: .78rem;
    font-weight: 500;
    padding: 4px 12px;
    border-radius: 12px;
}

/* ── Form Card ──────────────────────────────────────────── */
.booking-form-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
}
.form-section-title {
    font-size: .75rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 16px;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}
.form-section-title:first-child { margin-top: 0; padding-top: 0; border-top: none; }

.form-group { margin-bottom: 18px; }
.form-group label {
    display: block;
    font-size: .82rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 7px;
}
.form-group label .req { color: var(--accent); margin-left: 2px; }
.input-wrap { position: relative; }
.input-wrap i {
    position: absolute;
    left: 13px; top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: .85rem;
    pointer-events: none;
}
.input-wrap input,
.input-wrap textarea {
    width: 100%;
    padding: 11px 14px 11px 38px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family: inherit;
    font-size: .9rem;
    outline: none;
    transition: border-color var(--transition), box-shadow var(--transition);
    background: #fafafa;
    color: var(--text);
}
.input-wrap textarea { padding-top: 11px; resize: vertical; min-height: 80px; }
.input-wrap input:focus,
.input-wrap textarea:focus {
    border-color: var(--accent);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(232,160,168,.12);
}
.form-error {
    color: #c0392b;
    font-size: .78rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* ── Jam Picker ─────────────────────────────────────────── */
.jam-picker-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-top: 6px;
}
.jam-btn {
    padding: 11px 6px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    font-size: .82rem;
    font-weight: 600;
    transition: all var(--transition);
    background: #fafafa;
    color: var(--text);
    user-select: none;
}
.jam-btn:hover:not(.taken) {
    border-color: var(--accent);
    color: var(--accent);
    background: rgba(232,160,168,.06);
}
.jam-btn.selected {
    border-color: var(--accent);
    background: var(--accent);
    color: #fff;
    box-shadow: 0 3px 10px rgba(232,160,168,.35);
}
.jam-btn.taken {
    background: #f5f5f5;
    color: #ccc;
    cursor: not-allowed;
    text-decoration: line-through;
    border-color: #eee;
}
.jam-legend {
    display: flex;
    gap: 16px;
    margin-top: 10px;
    font-size: .75rem;
    color: var(--muted);
}
.jam-legend span { display: flex; align-items: center; gap: 5px; }
.dot { width: 10px; height: 10px; border-radius: 50%; }
.dot-available { background: var(--border); border: 1.5px solid #ccc; }
.dot-selected  { background: var(--accent); }
.dot-taken     { background: #eee; border: 1.5px solid #ddd; }

/* ── Submit ─────────────────────────────────────────────── */
.btn-submit-booking {
    width: 100%;
    background: var(--accent);
    color: #fff;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-family: inherit;
    font-size: .95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all var(--transition);
    margin-top: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 16px rgba(232,160,168,.35);
}
.btn-submit-booking:hover {
    background: var(--accent-dk);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(232,160,168,.45);
}

/* ── Responsive ─────────────────────────────────────────── */
@media(max-width: 768px) {
    .booking-container { grid-template-columns: 1fr; gap: 28px; }
    .booking-info { position: static; }
    .booking-form-card { padding: 24px 20px; }
    .jam-picker-grid { grid-template-columns: repeat(4, 1fr); }
}
@media(max-width: 400px) {
    .jam-picker-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush

@section('content')
<div class="booking-page">
    <div class="booking-container">

        {{-- Left: Info Panel --}}
        <div class="booking-info">
            <h1>Booking Kunjungan Toko</h1>
            <p>Pesan jadwal kunjungan Anda dan kami akan siapkan pelayanan terbaik untuk Anda.</p>

            <div class="info-card">
                <h3><i class="fas fa-clock"></i> Jam Operasional</h3>
                <div class="jam-list">
                    <span class="jam-chip">Senin – Sabtu</span>
                    <span class="jam-chip">08.00 – 16.00</span>
                    <span class="jam-chip">Istirahat 12.00 – 13.00</span>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-info-circle"></i> Informasi Penting</h3>
                <ul style="font-size:.82rem;color:var(--muted);line-height:1.9;padding-left:16px">
                    <li>Booking bersifat gratis</li>
                    <li>Konfirmasi via WhatsApp</li>
                    <li>Harap datang tepat waktu</li>
                    <li>Slot yang sudah dipesan tidak bisa dipilih</li>
                </ul>
            </div>
        </div>

        {{-- Right: Form --}}
        <div class="booking-form-card">
            @guest
            <div style="background:var(--secondary);border-radius:10px;padding:13px 16px;margin-bottom:20px;font-size:.82rem;color:var(--dark);display:flex;align-items:center;gap:10px">
                <i class="fas fa-info-circle" style="color:var(--accent);flex-shrink:0"></i>
                <span>
                    <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600">Masuk</a> atau
                    <a href="{{ route('register') }}" style="color:var(--accent);font-weight:600">daftar</a>
                    untuk menyimpan riwayat booking Anda.
                </span>
            </div>
            @endguest
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                @csrf

                <div class="form-section-title">Data Diri</div>

                <div class="form-group">
                    <label>Nama Lengkap <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nama_customer"
                               value="{{ old('nama_customer', auth()->user()?->name) }}"
                               placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    @error('nama_customer')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>No. HP / WhatsApp <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="no_hp"
                               value="{{ old('no_hp', auth()->user()?->no_hp) }}"
                               placeholder="Contoh: 08123456789" required>
                    </div>
                    @error('no_hp')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-section-title">Jadwal Kunjungan</div>

                <div class="form-group">
                    <label>Tanggal Kunjungan <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-calendar"></i>
                        <input type="date" name="tanggal" id="tanggalInput"
                               value="{{ old('tanggal', $tanggal) }}"
                               min="{{ date('Y-m-d') }}" required>
                    </div>
                    @error('tanggal')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Pilih Jam <span class="req">*</span></label>
                    <input type="hidden" name="jam" id="jamInput" value="{{ old('jam') }}">
                    <div class="jam-picker-grid" id="jamGrid">
                        @foreach($jamList as $jam)
                            @php $taken = in_array($jam, $bookedSlots); @endphp
                            <div class="jam-btn {{ $taken ? 'taken' : '' }} {{ old('jam') === $jam ? 'selected' : '' }}"
                                 data-jam="{{ $jam }}"
                                 @if(!$taken) onclick="selectJam(this)" @endif>
                                {{ $jam }}
                            </div>
                        @endforeach
                    </div>
                    <div class="jam-legend">
                        <span><span class="dot dot-available"></span> Tersedia</span>
                        <span><span class="dot dot-selected"></span> Dipilih</span>
                        <span><span class="dot dot-taken"></span> Penuh</span>
                    </div>
                    @error('jam')
                        <div class="form-error" style="margin-top:8px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-section-title">Catatan (Opsional)</div>

                <div class="form-group">
                    <label>Catatan untuk Toko</label>
                    <div class="input-wrap">
                        <i class="fas fa-sticky-note" style="top:14px;transform:none"></i>
                        <textarea name="catatan" placeholder="Produk yang ingin dilihat, ukuran, dll.">{{ old('catatan') }}</textarea>
                    </div>
                    @error('catatan')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-booking">
                    <i class="fas fa-calendar-check"></i> Konfirmasi Booking
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function selectJam(el) {
    document.querySelectorAll('.jam-btn:not(.taken)').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('jamInput').value = el.dataset.jam;
}

document.getElementById('tanggalInput').addEventListener('change', function () {
    const tanggal = this.value;
    if (!tanggal) return;

    fetch(`{{ route('booking.slots') }}?tanggal=${tanggal}`)
        .then(r => r.json())
        .then(booked => {
            document.querySelectorAll('.jam-btn').forEach(btn => {
                const jam = btn.dataset.jam;
                btn.classList.remove('selected');
                if (booked.includes(jam)) {
                    btn.classList.add('taken');
                    btn.onclick = null;
                } else {
                    btn.classList.remove('taken');
                    btn.onclick = function() { selectJam(this); };
                }
            });
            document.getElementById('jamInput').value = '';
        });
});
</script>
@endpush
