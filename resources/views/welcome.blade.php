@extends('layouts.frontend')

@section('content')

<div class="main-wrapper" style="padding-top: 100px;">

  {{-- HERO --}}
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 text-center text-lg-start">
          <h1 class="fw-bold text-primary">RUANGKU</h1>
          <p class="text-muted fs-5 mb-4">
            Sistem Penjadwalan Ruangan Kelas dan Laboratorium. Digital, efisien, dan bebas bentrok jadwal.
          </p>
          <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill">
            Booking Sekarang
          </a>
        </div>

        <div class="col-lg-6 text-center">
          <img src="{{ asset('assets/backend/img/KELAS.jpg') }}"
               class="img-fluid rounded shadow-sm"
               style="max-height: 300px;">
        </div>
      </div>
    </div>
  </section>

  {{-- KALENDER --}}
  <section class="py-5">
    <div class="container">
      <div class="card border-0 shadow rounded-4">
        <div class="card-body">
          <h4 class="fw-semibold text-center mb-4">Kalender Jadwal & Booking</h4>

          <div class="d-flex gap-3 mb-3 flex-wrap">
            <div class="d-flex align-items-center">
              <div style="width:20px;height:20px;border-radius:50px;background:#ff9500;margin-right:10px;"></div>
              <span>Di Booking</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="width:20px;height:20px;border-radius:50px;background:#00aaff;margin-right:10px;"></div>
              <span>Jadwal Tetap</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="width:20px;height:20px;border-radius:50px;background:#fffb7d;margin-right:10px;"></div>
              <span>Hari Ini</span>
            </div>
          </div>

          <div style="overflow-x:auto;">
            <div id="calendar"></div>
          </div>

        </div>
      </div>
    </div>
  </section>

  {{-- LIST RUANGAN --}}
  <section class="py-5 bg-light">
    <div class="container">
      <h4 class="fw-semibold text-center mb-4">Daftar Ruangan</h4>

      <div class="row">
        @forelse ($ruangans as $ruangan)
        <div class="col-md-4 mb-4">
          <div class="card border-0 shadow-sm rounded-4 h-100">

            <img src="{{ asset('storage/' . $ruangan->cover) }}"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            <div class="card-body d-flex flex-column">
              <h5 class="fw-bold">{{ $ruangan->nama }}</h5>

              <p class="mb-1">👥 Kapasitas: {{ $ruangan->kapasitas }}</p>

              <p class="text-muted small flex-grow-1">
                {{ \Illuminate\Support\Str::limit($ruangan->fasilitas, 60) }}
              </p>

              <a href="{{ route('bookings.create', $ruangan->id) }}"
                 class="btn btn-primary w-100 rounded-pill">
                Booking
              </a>
            </div>

          </div>
        </div>
        @empty
        <div class="text-center">
          <p class="text-muted">Belum ada data ruangan</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

</div>

{{-- FULLCALENDAR --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  if (calendarEl) {
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 'auto',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth'
      },
      events: @json($jadwal ?? []),
      eventColor: '#3A87AD',
      eventTextColor: '#fff'
    });

    calendar.render();
  }
});
</script>

@endsection