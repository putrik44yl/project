@extends('layouts.frontend')

@section('content')
<div class="container py-5" style="margin-top:100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card booking-card border-0">

                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <h3 class="fw-bold">📅 Booking Ruangan</h3>
                    <p class="text-muted small">Pilih waktu dan ruangan yang tersedia</p>
                </div>

                <div class="card-body p-0">

                    {{-- ALERT --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-modern">
                            ⚠️ {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        {{-- RUANGAN --}}
                        <div class="mb-3">
                            <label class="form-label label-custom">Ruangan</label>
                            <select name="ruang_id" class="form-select input-custom" required>
                                <option disabled {{ old('ruang_id', $ruang_id ?? '') == '' ? 'selected' : '' }}>
                                    Pilih Ruangan
                                </option>
                                @foreach ($ruangans as $data)
                                    <option value="{{ $data->id }}" 
                                        {{ request('ruang_id') == $data->id || old('ruang_id') == $data->id ? 'selected' : ''}}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="mb-3">
                            <label class="form-label label-custom">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" 
                                   class="form-control input-custom" required>
                        </div>

                        {{-- JAM --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label label-custom">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" 
                                       class="form-control input-custom" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label label-custom">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" 
                                       class="form-control input-custom" required>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid mt-4">
                            <button class="btn btn-submit" type="submit">
                                🚀 Ajukan Booking
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@push('styles')
<style>

/* CARD */
.booking-card {
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.06);
    transition: 0.3s;
}

.booking-card:hover {
    transform: translateY(-4px);
}

/* LABEL */
.label-custom {
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
}

/* INPUT */
.input-custom {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    transition: 0.2s;
}

.input-custom:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.15);
}

/* BUTTON */
.btn-submit {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 12px;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    transition: 0.3s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37,99,235,0.3);
}

/* ALERT */
.alert-modern {
    border-radius: 10px;
    font-size: 13px;
    padding: 10px 14px;
}

.is-invalid {
    border-color: red !important;
}

</style>
@endpush@extends('layouts.frontend')

@section('content')
<div class="container py-5" style="margin-top:100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card booking-card border-0">

                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <h3 class="fw-bold">📅 Booking Ruangan</h3>
                    <p class="text-muted small">Pilih waktu dan ruangan yang tersedia</p>
                </div>

                <div class="card-body p-0">

                    {{-- ALERT --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-modern">
                            ⚠️ {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        {{-- RUANGAN --}}
                        <div class="mb-3">
                            <label class="form-label label-custom">Ruangan</label>
                            <select name="ruang_id" class="form-select input-custom" required>
                                <option disabled {{ old('ruang_id', $ruang_id ?? '') == '' ? 'selected' : '' }}>
                                    Pilih Ruangan
                                </option>
                                @foreach ($ruangans as $data)
                                    <option value="{{ $data->id }}" 
                                        {{ request('ruang_id') == $data->id || old('ruang_id') == $data->id ? 'selected' : ''}}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="mb-3">
                            <label class="form-label label-custom">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" 
                                   class="form-control input-custom" required>
                        </div>

                        {{-- JAM --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label label-custom">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" 
                                       class="form-control input-custom" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label label-custom">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" 
                                       class="form-control input-custom" required>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid mt-4">
                            <button class="btn btn-submit" type="submit">
                                🚀 Ajukan Booking
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@push('styles')
<style>

/* CARD */
.booking-card {
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.06);
    transition: 0.3s;
}

.booking-card:hover {
    transform: translateY(-4px);
}

/* LABEL */
.label-custom {
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
}

/* INPUT */
.input-custom {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    transition: 0.2s;
}

.input-custom:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.15);
}

/* BUTTON */
.btn-submit {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 12px;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    transition: 0.3s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37,99,235,0.3);
}

/* ALERT */
.alert-modern {
    border-radius: 10px;
    font-size: 13px;
    padding: 10px 14px;
}

.is-invalid {
    border-color: red !important;
}

</style>
@endpush