@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">

    <div class="card shadow border-0 rounded-3">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Jadwal Tetap</h5>

            <a href="{{ route('backend.jadwal.create') }}" 
               class="btn btn-primary btn-sm">
                <i class="ti ti-plus me-1"></i> Tambah
            </a>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="jadwalTable">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Keterangan</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($jadwals as $jadwal)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($jadwal->ruangan)->nama ?? '-' }}</td>
                            <td>{{ $jadwal->tanggal_format }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_selesai }}</td>
                            <td>{{ $jadwal->ket ?? '-' }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="#" class="dropdown-item">
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="#" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr class="text-center">
                            <td></td>
                            <td></td>
                            <td>Tidak ada data</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
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
        $('#jadwalTable').DataTable();
    });
</script>
@endpush