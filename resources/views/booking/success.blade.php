@extends('layouts.app')

@section('title', 'Booking Berhasil – Lingsir Ndalu Grosir')

@section('content')
<div style="min-height:calc(100vh - 68px);display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#FFF0F2,#FFF5E1);padding:40px 5%">
    <div style="background:#fff;border-radius:24px;padding:56px 48px;text-align:center;max-width:480px;width:100%;box-shadow:var(--shadow-lg);border:1px solid var(--border)">

        <div style="width:80px;height:80px;background:linear-gradient(135deg,var(--primary),#FFE4E8);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;font-size:2rem;color:var(--accent)">
            <i class="fas fa-check"></i>
        </div>

        <h1 style="font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--dark);margin-bottom:12px">
            Booking Berhasil!
        </h1>
        <p style="color:var(--muted);font-size:.9rem;line-height:1.8;margin-bottom:32px">
            Terima kasih telah melakukan booking. Kami akan segera menghubungi Anda melalui WhatsApp untuk konfirmasi jadwal kunjungan.
        </p>

        <div style="background:var(--secondary);border-radius:12px;padding:16px;margin-bottom:32px;font-size:.85rem;color:var(--dark);text-align:left">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
                <i class="fas fa-info-circle" style="color:var(--accent)"></i>
                <strong>Yang perlu diingat:</strong>
            </div>
            <ul style="padding-left:20px;color:var(--muted);line-height:1.9">
                <li>Tunggu konfirmasi dari admin kami</li>
                <li>Datang tepat waktu sesuai jadwal</li>
                <li>Bawa nomor HP yang didaftarkan</li>
            </ul>
        </div>

        <div style="display:flex;flex-direction:column;gap:12px">
            @auth
            <a href="{{ route('customer.bookings') }}"
               style="display:block;background:var(--accent);color:#fff;padding:13px;border-radius:12px;font-weight:700;font-size:.9rem;transition:all var(--transition)"
               onmouseover="this.style.background='var(--accent-dk)'"
               onmouseout="this.style.background='var(--accent)'">
                <i class="fas fa-history"></i> Lihat Booking Saya
            </a>
            @endauth
            <a href="{{ route('katalog.index') }}"
               style="display:block;background:{{ auth()->check() ? 'transparent' : 'var(--accent)' }};border:{{ auth()->check() ? '1.5px solid var(--border)' : 'none' }};color:{{ auth()->check() ? 'var(--muted)' : '#fff' }};padding:13px;border-radius:12px;font-weight:{{ auth()->check() ? '500' : '700' }};font-size:.9rem;transition:all var(--transition)"
               onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)'"
               onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
                <i class="fas fa-th-large"></i> Lihat Katalog Produk
            </a>
            <a href="{{ route('booking.create') }}"
               style="display:block;border:1.5px solid var(--border);color:var(--muted);padding:12px;border-radius:12px;font-weight:500;font-size:.9rem;transition:all var(--transition)"
               onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)'"
               onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
                <i class="fas fa-calendar-plus"></i> Buat Booking Baru
            </a>
        </div>
    </div>
</div>
@endsection
