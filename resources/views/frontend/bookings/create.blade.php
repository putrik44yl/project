@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow border-0 rounded-4">

                {{-- Header --}}
                <div class="card-header bg-primary bg-opacity-10 border-0 rounded-top-4 text-center">
                    <h4 class="mb-0 text-primary fw-semibold">
                        <i class="bi bi-calendar-check-fill me-2"></i>
                        Form Booking Ruangan
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('frontend.bookings.store') }}" method="POST">
                        @csrf

                        {{-- Nama Pengguna --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Nama Pengguna</label>
                            <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        {{-- Ruangan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Ruangan</label>
                            <select name="ruang_id"
                                class="form-select @error('ruang_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" {{ old('ruang_id') == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ruang_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tanggal</label>
                            <input type="date"
                                name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jam --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Jam Mulai</label>
                                <input type="time"
                                    name="jam_mulai"
                                    class="form-control @error('jam_mulai') is-invalid @enderror"
                                    value="{{ old('jam_mulai') }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Jam Selesai</label>
                                <input type="time"
                                    name="jam_selesai"
                                    class="form-control @error('jam_selesai') is-invalid @enderror"
                                    value="{{ old('jam_selesai') }}" required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send-check me-1"></i> Ajukan Booking
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
