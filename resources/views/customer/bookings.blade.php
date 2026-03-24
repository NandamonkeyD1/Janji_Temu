@extends('layouts.app')

@section('title', 'Booking Saya – Lingsir Ndalu Grosir')

@push('styles')
<style>
.customer-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 48px 5% 80px;
}
.page-header {
    margin-bottom: 32px;
}
.page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--dark);
    margin-bottom: 6px;
}
.page-header p { font-size: .875rem; color: var(--muted); }

/* Profile Card */
.profile-card {
    background: linear-gradient(135deg, var(--dark) 0%, #6B4C3B 100%);
    border-radius: 16px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
    color: #fff;
}
.profile-avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: rgba(232,160,168,.25);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
    color: var(--accent);
    flex-shrink: 0;
}
.profile-name { font-size: 1.05rem; font-weight: 600; margin-bottom: 3px; }
.profile-email { font-size: .8rem; color: #d4b8a8; }
.profile-hp { font-size: .8rem; color: #d4b8a8; margin-top: 2px; }
.profile-actions { margin-left: auto; }
.btn-new-booking {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent);
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: .85rem;
    font-weight: 600;
    transition: all .2s;
    white-space: nowrap;
}
.btn-new-booking:hover {
    background: var(--accent-dk);
    transform: translateY(-1px);
}

/* Booking Cards */
.booking-list { display: flex; flex-direction: column; gap: 14px; }
.booking-item {
    background: #fff;
    border-radius: 14px;
    border: 1px solid var(--border);
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: box-shadow .2s;
}
.booking-item:hover { box-shadow: var(--shadow); }
.booking-date-box {
    text-align: center;
    background: var(--secondary);
    border-radius: 12px;
    padding: 12px 16px;
    min-width: 64px;
    flex-shrink: 0;
}
.booking-date-box .day {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--dark);
    line-height: 1;
}
.booking-date-box .month {
    font-size: .72rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-top: 2px;
}
.booking-info { flex: 1; }
.booking-info .name { font-weight: 600; font-size: .95rem; color: var(--dark); margin-bottom: 4px; }
.booking-meta {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    font-size: .8rem;
    color: var(--muted);
}
.booking-meta span { display: flex; align-items: center; gap: 5px; }
.booking-meta i { color: var(--accent); }
.booking-catatan {
    font-size: .78rem;
    color: var(--muted);
    margin-top: 6px;
    font-style: italic;
}
.booking-status { flex-shrink: 0; }
.badge {
    display: inline-block;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: .75rem;
    font-weight: 600;
}
.badge-pending  { background: #fff3cd; color: #856404; }
.badge-approved { background: #d4edda; color: #155724; }
.badge-rejected { background: #f8d7da; color: #721c24; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--border);
}
.empty-state i { font-size: 3.5rem; color: var(--border); margin-bottom: 16px; display: block; }
.empty-state h3 { font-size: 1.1rem; color: var(--dark); margin-bottom: 8px; }
.empty-state p { font-size: .875rem; color: var(--muted); margin-bottom: 24px; }
.btn-booking-now {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent);
    color: #fff;
    padding: 12px 28px;
    border-radius: 24px;
    font-weight: 600;
    font-size: .9rem;
    transition: all .2s;
}
.btn-booking-now:hover { background: var(--accent-dk); transform: translateY(-2px); }

/* Pagination */
.pagination-wrap { display: flex; justify-content: center; margin-top: 32px; }

@media(max-width: 640px) {
    .profile-card { flex-wrap: wrap; }
    .profile-actions { margin-left: 0; width: 100%; }
    .btn-new-booking { width: 100%; justify-content: center; }
    .booking-item { flex-wrap: wrap; gap: 14px; }
    .booking-date-box { min-width: auto; }
}
</style>
@endpush

@section('content')
<div class="customer-page">

    <div class="page-header">
        <h1>Booking Saya</h1>
        <p>Riwayat dan status semua booking kunjungan Anda</p>
    </div>

    {{-- Profile Card --}}
    <div class="profile-card">
        <div class="profile-avatar"><i class="fas fa-user"></i></div>
        <div>
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-email"><i class="fas fa-envelope" style="margin-right:5px;opacity:.6"></i>{{ auth()->user()->email }}</div>
            @if(auth()->user()->no_hp)
            <div class="profile-hp"><i class="fas fa-phone" style="margin-right:5px;opacity:.6"></i>{{ auth()->user()->no_hp }}</div>
            @endif
        </div>
        <div class="profile-actions">
            <a href="{{ route('booking.create') }}" class="btn-new-booking">
                <i class="fas fa-calendar-plus"></i> Booking Baru
            </a>
        </div>
    </div>

    {{-- Booking List --}}
    @if($bookings->isEmpty())
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3>Belum ada booking</h3>
            <p>Anda belum pernah melakukan booking kunjungan toko.</p>
            <a href="{{ route('booking.create') }}" class="btn-booking-now">
                <i class="fas fa-calendar-check"></i> Booking Sekarang
            </a>
        </div>
    @else
        <div class="booking-list">
            @foreach($bookings as $booking)
            <div class="booking-item">
                <div class="booking-date-box">
                    <div class="day">{{ $booking->tanggal->format('d') }}</div>
                    <div class="month">{{ $booking->tanggal->isoFormat('MMM Y') }}</div>
                </div>
                <div class="booking-info">
                    <div class="name">{{ $booking->nama_customer }}</div>
                    <div class="booking-meta">
                        <span><i class="fas fa-clock"></i> {{ substr($booking->jam, 0, 5) }} WIB</span>
                        <span><i class="fas fa-phone"></i> {{ $booking->no_hp }}</span>
                        <span><i class="fas fa-calendar"></i> {{ $booking->tanggal->isoFormat('dddd, D MMMM Y') }}</span>
                    </div>
                    @if($booking->catatan)
                        <div class="booking-catatan"><i class="fas fa-sticky-note"></i> {{ $booking->catatan }}</div>
                    @endif
                </div>
                <div class="booking-status">
                    <span class="badge badge-{{ $booking->status }}">
                        @if($booking->status === 'pending') <i class="fas fa-clock"></i> Menunggu
                        @elseif($booking->status === 'approved') <i class="fas fa-check"></i> Disetujui
                        @else <i class="fas fa-times"></i> Ditolak
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $bookings->links() }}
        </div>
    @endif

</div>
@endsection
