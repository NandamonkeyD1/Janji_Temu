@extends('layouts.admin')

@section('title', 'Dashboard – Admin')
@section('page-title', 'Dashboard')

@push('styles')
<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}
.stat-card {
    background: #fff;
    border-radius: var(--radius);
    padding: 22px 24px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 18px;
    transition: box-shadow var(--transition);
}
.stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.09); }
.stat-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}
.stat-icon.pink    { background: rgba(232,160,168,.15); color: var(--accent); }
.stat-icon.brown   { background: rgba(74,55,40,.1);     color: var(--dark); }
.stat-icon.yellow  { background: rgba(240,165,0,.12);   color: #d4900a; }
.stat-num  { font-size: 2rem; font-weight: 700; color: var(--dark); line-height: 1; }
.stat-label { font-size: .78rem; color: var(--muted); margin-top: 4px; }

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}
.section-header h2 { font-size: 1rem; font-weight: 600; color: var(--dark); }

@media(max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
}
@media(max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush

@section('content')

<div style="margin-bottom:24px">
    <h1 style="font-size:1.3rem;font-weight:600;color:var(--dark)">Selamat datang, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>
    <p style="font-size:.85rem;color:var(--muted);margin-top:3px">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon pink"><i class="fas fa-tshirt"></i></div>
        <div>
            <div class="stat-num">{{ $totalProduk }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon brown"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-num">{{ $totalBooking }}</div>
            <div class="stat-label">Total Booking</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-num">{{ $bookingPending }}</div>
            <div class="stat-label">Menunggu Konfirmasi</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="section-header">
        <h2><i class="fas fa-history" style="color:var(--accent);margin-right:8px"></i> Booking Terbaru</h2>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
    </div>

    @if($recentBookings->isEmpty())
        <div style="text-align:center;padding:40px;color:var(--muted)">
            <i class="fas fa-calendar-times" style="font-size:2.5rem;color:var(--border);margin-bottom:12px;display:block"></i>
            Belum ada booking
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBookings as $b)
                <tr>
                    <td style="font-weight:500">{{ $b->nama_customer }}</td>
                    <td>{{ $b->no_hp }}</td>
                    <td>{{ $b->tanggal->isoFormat('D MMM Y') }}</td>
                    <td>{{ substr($b->jam, 0, 5) }}</td>
                    <td><span class="badge badge-{{ $b->status }}">{{ ucfirst($b->status) }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
