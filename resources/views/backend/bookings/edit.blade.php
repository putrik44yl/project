@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <b>Edit Booking Ruangan</b>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.bookings.update', $bookings->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- User --}}
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $bookings->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Ruangan --}}
                        <div class="mb-3">
                            <label for="ruang_id" class="form-label">Ruangan</label>
                            <select name="ruang_id" id="ruang_id" class="form-control" required>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}"
                                        {{ $bookings->ruang_id == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control"
                                value="{{ $bookings->tanggal }}" required>
                        </div>

                        {{-- Jam Mulai --}}
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai"
                                class="form-control"
                                value="{{ $bookings->jam_mulai }}" required>
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai"
                                class="form-control"
                                value="{{ $bookings->jam_selesai }}" required>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Pending" {{ $bookings->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Diterima" {{ $bookings->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ $bookings->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Selesai" {{ $bookings->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                            <a href="{{ route('backend.bookings.index') }}" class="btn btn-outline-warning ms-2">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection