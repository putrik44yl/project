@extends('layouts.frontend')

@section('content')
<div class="container py-5" style="margin-top: 100px;">

    <div class="text-center mb-4">
        <h4 class="fw-semibold mb-1">Riwayat Booking</h4>
        <p class="text-muted small mb-0">Daftar pemesanan ruangan yang pernah Anda lakukan</p>
    </div>

    <div class="card history-card border-0">

        @if($booking->count())
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="fw-medium">
                            {{ $data->ruangan->nama }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}
                        </td>

                        <td class="text-nowrap">
                            {{ $data->jam_mulai }} - {{ $data->jam_selesai }}
                        </td>

                        <td>
                            @switch($data->status)
                                @case('Pending')
                                    <span class="badge status-pending">Menunggu</span>
                                    @break
                                @case('Diterima') 
                                    <span class="badge status-approved">Disetujui</span>
                                    @break
                                @case('Ditolak')
                                    <span class="badge status-rejected">Ditolak</span>
                                    @break
                                @case('Selesai')
                                    <span class="badge status-done">Selesai</span>
                                    @break
                                @default
                                    <span class="badge status-unknown">-</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
        <div class="empty-state text-center py-5">
            <div class="mb-2 fs-4">📭</div>
            <p class="text-muted mb-0">Belum ada riwayat booking</p>
        </div>
        @endif

    </div>
</div>
@endsection


@push('styles')
<style>

/* CARD */
.history-card {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

/* TABLE */
.table-custom thead {
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.table-custom th {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.table-custom td {
    font-size: 14px;
    color: #111827;
    padding: 12px 10px;
}

.table-custom tbody tr {
    border-bottom: 1px solid #f1f5f9;
}

.table-custom tbody tr:hover {
    background: #f9fafb;
}

/* BADGE STATUS (TEGAS, BUKAN SOFT) */
.badge {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 6px;
}

/* STATUS COLORS */
.status-pending {
    background: #facc15;
    color: #111;
}

.status-approved {
    background: #2563eb;
    color: white;
}

.status-rejected {
    background: #dc2626;
    color: white;
}

.status-done {
    background: #16a34a;
    color: white;
}

.status-unknown {
    background: #9ca3af;
    color: white;
}

/* EMPTY */
.empty-state {
    color: #6b7280;
}

</style>
@endpush