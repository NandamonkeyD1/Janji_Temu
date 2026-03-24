@extends('layouts.admin')

@section('title', 'Booking – Admin')
@section('page-title', 'Manajemen Booking')

@push('styles')
<style>
.filter-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
    align-items: center;
}
.filter-bar select,
.filter-bar input[type=date] {
    padding: 8px 12px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: inherit;
    font-size: .82rem;
    outline: none;
    background: #fafafa;
    transition: border-color var(--transition);
}
.filter-bar select:focus,
.filter-bar input[type=date]:focus { border-color: var(--accent); }

.status-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.status-tab {
    padding: 7px 16px;
    border-radius: 20px;
    font-size: .8rem;
    font-weight: 500;
    cursor: pointer;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--muted);
    transition: all var(--transition);
    text-decoration: none;
}
.status-tab:hover { border-color: var(--accent); color: var(--accent); }
.status-tab.active { background: var(--accent); color: #fff; border-color: var(--accent); }
</style>
@endpush

@section('content')

<div style="margin-bottom:24px">
    <h1 style="font-size:1.2rem;font-weight:600;color:var(--dark)">Daftar Booking</h1>
    <p style="font-size:.82rem;color:var(--muted);margin-top:2px">Kelola dan konfirmasi jadwal kunjungan pelanggan</p>
</div>

<div class="card">
    {{-- Filter --}}
    <form class="filter-bar" method="GET">
        <select name="status">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Pending','approved'=>'Disetujui','rejected'=>'Ditolak'] as $val => $label)
                <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" placeholder="Filter tanggal">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filter</button>
        @if(request('status') || request('tanggal'))
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">
                <i class="fas fa-times"></i> Reset
            </a>
        @endif
    </form>

    @if($bookings->isEmpty())
        <div style="text-align:center;padding:60px;color:var(--muted)">
            <i class="fas fa-calendar-times" style="font-size:3rem;color:var(--border);margin-bottom:16px;display:block"></i>
            <p style="font-size:.9rem">Tidak ada booking ditemukan</p>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>No. HP</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $i => $booking)
                <tr>
                    <td style="color:var(--muted);font-size:.78rem">{{ $bookings->firstItem() + $i }}</td>
                    <td style="font-weight:600">
                        {{ $booking->nama_customer }}
                        @if($booking->user)
                            <span style="display:block;font-size:.72rem;color:var(--accent);font-weight:400;margin-top:2px">
                                <i class="fas fa-user-check"></i> Member
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->no_hp) }}"
                           target="_blank"
                           style="color:var(--accent);display:flex;align-items:center;gap:5px;font-size:.82rem">
                            <i class="fab fa-whatsapp"></i> {{ $booking->no_hp }}
                        </a>
                    </td>
                    <td>{{ $booking->tanggal->isoFormat('D MMM Y') }}</td>
                    <td>
                        <span style="background:var(--bg);padding:3px 9px;border-radius:6px;font-size:.8rem;font-weight:600">
                            {{ substr($booking->jam, 0, 5) }}
                        </span>
                    </td>
                    <td style="max-width:160px">
                        @if($booking->catatan)
                            <span style="font-size:.8rem;color:var(--muted)" title="{{ $booking->catatan }}">
                                {{ Str::limit($booking->catatan, 40) }}
                            </span>
                        @else
                            <span style="color:#ccc;font-size:.8rem">–</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        @if($booking->status === 'pending')
                        <div style="display:flex;gap:6px">
                            <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                        @else
                            <span style="color:#ccc;font-size:.8rem">–</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px">{{ $bookings->links() }}</div>
    @endif
</div>

@endsection
