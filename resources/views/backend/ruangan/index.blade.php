@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">

    <div class="card shadow border-0 rounded-3">

        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Data Ruangan</h5>

            <a href="{{ route('backend.ruangan.create') }}" 
               class="btn btn-primary btn-sm">
                <i class="ti ti-plus me-1"></i> Tambah
            </a>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="ruanganTable">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Nama</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($ruangans as $ruangan)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <img src="{{ asset('storage/'.$ruangan->cover) }}" 
                                     alt="cover" 
                                     style="width:80px; height:60px; object-fit:cover; border-radius:8px;">
                            </td>

                            <td>{{ $ruangan->nama }}</td>
                            <td>{{ $ruangan->kapasitas }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ruangan->fasilitas, 30) }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('backend.ruangan.show', $ruangan->id) }}" class="dropdown-item">
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('backend.ruangan.edit', $ruangan->id) }}" class="dropdown-item">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('backend.ruangan.destroy', $ruangan->id) }}" method="POST" onsubmit="return confirm('Hapus ruangan ini?')">
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
        $('#ruanganTable').DataTable({
            columnDefs: [
                { targets: '_all', defaultContent: '-' }
            ]
        });
    });
</script>
@endpush