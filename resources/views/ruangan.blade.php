@extends('layouts.frontend')

@section('content')
<div class="container py-5" style="margin-top:100px;">

    <div class="text-center mb-5">
        <h2 class="fw-bold">🏫 Daftar Ruangan</h2>
        <p class="text-muted">Pilih ruangan sesuai kebutuhanmu</p>
    </div>

    <div class="row g-4">
        @foreach($ruangans as $data)
        <div class="col-lg-3 col-md-6">

            <div class="card ruang-card h-100 border-0">

                {{-- IMAGE --}}
                @if($data->cover)
                <div class="position-relative">
                    <img src="{{ asset('storage/'.$data->cover) }}" 
                         class="card-img-top ruang-img" 
                         alt="{{ $data->nama }}">
                    
                    <span class="badge kapasitas-badge">
                        👥 {{ $data->kapasitas }}
                    </span>
                </div>
                @endif

                {{-- BODY --}}
                <div class="card-body">
                    <h5 class="fw-bold mb-2">{{ $data->nama }}</h5>

                    <p class="text-muted small mb-2">
                        Kapasitas: <strong>{{ $data->kapasitas }} orang</strong>
                    </p>

                    <div class="mb-2">
                        <small class="text-muted">Fasilitas:</small>
                        <div class="d-flex flex-wrap gap-1 mt-1">
                            @foreach(explode(' ', $data->fasilitas) as $fasilitas)
                                <span class="badge fasilitas-badge">
                                    ✔ {{ trim($fasilitas) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-transparent border-0 px-3 pb-3">
                    <a href="{{ route('ruangan.show', $data->id) }}" 
                       class="btn btn-primary w-100 btn-detail">
                        Lihat Detail →
                    </a>
                </div>

            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection

@push('styles')
<style>
/* CARD */
.ruang-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.ruang-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

/* IMAGE */
.ruang-img {
    height: 180px;
    object-fit: cover;
    transition: 0.3s;
}

.ruang-card:hover .ruang-img {
    transform: scale(1.05);
}

/* BADGE KAPASITAS */
.kapasitas-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
}

/* FASILITAS */
.fasilitas-badge {
    background: #f1f5f9;
    color: #333;
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 8px;
}

/* BUTTON */
.btn-detail {
    border-radius: 10px;
    font-weight: 500;
    transition: 0.2s;
}

.btn-detail:hover {
    transform: scale(1.02);
}
</style>
@endpush