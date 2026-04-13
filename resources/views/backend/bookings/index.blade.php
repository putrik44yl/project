@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">

    <!-- Card -->
    <div class="card shadow border-0 rounded-3">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Data Booking</h5>

            <div class="d-flex gap-2">
                <a href="{{ route('backend.bookings.export.pdf', request()->query()) }}" 
                   class="btn btn-danger btn-sm">
                    <i class="fa fa-file-pdf me-1"></i> PDF
                </a>

                <a href="{{ route('backend.bookings.create') }}" 
                   class="btn btn-primary btn-sm">
                    <i class="ti ti-plus me-1"></i> Tambah
                </a>
            </div>
        </div>

        <!-- Filter -->
        <div class="card-body border-bottom">
            <form method="GET" action="{{ route('backend.bookings.index') }}">
                <div class="row g-2 align-items-end">

                    <div class="col-md-3">
                        <label class="form-label">Ruangan</label>
                        <select name="ruang_id" class="form-select">
                            <option value="">Semua</option>
                            @foreach($ruangans as $data)
                                <option value="{{ $data->id }}" 
                                    {{ request('ruang_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" 
                               value="{{ request('tanggal') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            Filter
                        </button>
                        <a href="{{ route('backend.bookings.index') }}" 
                           class="btn btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="bookingTable">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user->name ?? '-' }}</td>
                            <td>{{ $booking->ruangan->nama ?? '-' }}</td>
                            <td>{{ $booking->tanggal_format }}</td>
                            <td>{{ $booking->jam_mulai }}</td>
                            <td>{{ $booking->jam_selesai }}</td>

                            <td>
                                @switch($booking->status)
                                    @case('Pending')
                                        <span class="badge bg-secondary">Pending</span>
                                        @break
                                    @case('Diterima')
                                        <span class="badge bg-primary">Diterima</span>
                                        @break
                                    @case('Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @break
                                    @case('Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                        @break
                                @endswitch
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('backend.bookings.edit', $booking->id) }}" 
                                               class="dropdown-item">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('backend.bookings.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script>
    $(document).ready(function () {
        $('#bookingTable').DataTable({
            language: {
                emptyTable: "Tidak ada data booking"
            }
        });
    });
</script>
@endpush