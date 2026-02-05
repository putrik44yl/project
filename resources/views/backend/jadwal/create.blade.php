@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h4 class="mb-0">
                        <i class="ti ti-calendar-plus me-2"></i>
                        Tambah Jadwal Tetap
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('backend.jadwal.store') }}" method="POST">
                        @csrf
                        {{-- Ruangan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ruangan</label>
                            <select name="ruang_id" class="form-select" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}">
                                        {{ $ruangan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        {{-- Jam --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" required>
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea name="ket" class="form-control" rows="3" placeholder="Contoh: Jadwal rutin rapat"></textarea>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('backend.jadwal.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
