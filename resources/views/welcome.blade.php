@extends('layouts.frontend')
@section('content')
<style>
  .hero-blob1 {
    position: absolute; top: -60px; right: 80px;
    width: 320px; height: 320px; border-radius: 50%;
    background: radial-gradient(circle, #e0e7ff 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-blob2 {
    position: absolute; bottom: -40px; left: -40px;
    width: 200px; height: 200px; border-radius: 50%;
    background: radial-gradient(circle, #cffafe 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: #eef2ff; color: #4f46e5; font-size: 12px;
    font-weight: 500; padding: 5px 14px; border-radius: 20px; margin-bottom: 20px;
  }
  .section-eyebrow {
    font-size: 12px; font-weight: 600; color: #06b6d4;
    letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px;
  }
  .room-card { background: #f8faff; border: 1px solid #e0e7ff; border-radius: 18px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
  .room-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(79,70,229,0.1); }
  .room-chip { display: inline-block; background: #eef2ff; color: #4f46e5; font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; }
  .btn-book { background: #fff; color: #4f46e5; border: 1.5px solid #c7d2fe; padding: 10px; border-radius: 10px; font-size: 13px; font-weight: 600; transition: all .2s; }
  .btn-book:hover { background: #4f46e5; color: #fff; border-color: #4f46e5; }
  .img-badge {
    position: absolute; bottom: -14px; left: 20px;
    background: #fff; border: 1px solid #e0e7ff; border-radius: 12px;
    padding: 10px 16px; display: flex; align-items: center; gap: 10px;
    box-shadow: 0 4px 16px rgba(79,70,229,0.1);
  }
  .img-badge-icon { width: 32px; height: 32px; border-radius: 8px; background: #eef2ff; display: flex; align-items: center; justify-content: center; }
  .cal-card { background: #fff; border: 1px solid #e0e7ff; border-radius: 18px; padding: 24px; }
</style>

<div class="main-wrapper" style="padding-top: 120px; background: #f0f4ff;">

  {{-- HERO --}}
  <section class="py-5 bg-white position-relative overflow-hidden">
    <div class="hero-blob1"></div>
    <div class="hero-blob2"></div>
    <div class="container position-relative" style="z-index:1">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="hero-pill">
            <div style="width:6px;height:6px;border-radius:50%;background:#4f46e5"></div>
            Sistem Manajemen Ruangan
          </div>
          <h1 class="fw-bold" style="font-size:44px;letter-spacing:-1.5px;color:#0f172a;line-height:1.1">
            Jadwalkan<br>
            <span style="color:#4f46e5">Ruanganmu</span><br>
            Sekarang
          </h1>
          <p class="mt-3 mb-4" style="color:#64748b;font-size:15px;line-height:1.7;max-width:400px">
            Penjadwalan ruang kelas dan laboratorium secara digital. Efisien, transparan, dan bebas bentrok jadwal.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('bookings.create') }}"
               class="btn d-flex align-items-center gap-2 fw-semibold text-white"
               style="background:#4f46e5;border-radius:10px;padding:12px 28px">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              Booking Sekarang
            </a>
            <a href="#jadwal"
               class="btn fw-semibold"
               style="color:#4f46e5;border:1.5px solid #c7d2fe;border-radius:10px;padding:11px 24px">
              Lihat Jadwal
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="position-relative" style="padding-bottom:14px">
            <img src="{{ asset('assets/backend/img/KELAS.jpg') }}"
                 class="w-100"
                 style="height:240px;object-fit:cover;border-radius:20px;border:3px solid #e0e7ff">
            <div class="img-badge">
              <div class="img-badge-icon">✅</div>
              <div>
                <div class="fw-semibold" style="font-size:13px;color:#0f172a">Tersedia Sekarang</div>
                <div style="font-size:11px;color:#94a3b8">{{ $ruangans->count() }} ruangan aktif</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- STATS --}}
  <div class="bg-white border-top border-bottom" style="border-color:#e0e7ff !important">
    <div class="container">
      <div class="row text-center">
        <div class="col-4 py-4 border-end" style="border-color:#e0e7ff !important">
          <div class="fw-bold" style="font-size:26px;color:#4f46e5">{{ $ruangans->count() }}</div>
          <div class="mt-1" style="font-size:12px;color:#94a3b8">Ruangan Tersedia</div>
        </div>
        <div class="col-4 py-4 border-end" style="border-color:#e0e7ff !important">
          <div class="fw-bold" style="font-size:26px;color:#4f46e5">{{ $totalBooking ?? '—' }}</div>
          <div class="mt-1" style="font-size:12px;color:#94a3b8">Booking Bulan Ini</div>
        </div>
        <div class="col-4 py-4">
          <div class="fw-bold" style="font-size:26px;color:#4f46e5">98%</div>
          <div class="mt-1" style="font-size:12px;color:#94a3b8">Tanpa Bentrok</div>
        </div>
      </div>
    </div>
  </div>

  {{-- KALENDER --}}
  <section class="py-5" id="jadwal">
    <div class="container">
      <div class="section-eyebrow">Jadwal</div>
      <h4 class="fw-bold mb-1" style="color:#0f172a">Kalender Jadwal & Booking</h4>
      <p class="mb-3" style="font-size:14px;color:#94a3b8">Lihat ketersediaan ruangan secara real-time</p>
      <div class="d-flex gap-3 flex-wrap mb-3">
        <div class="d-flex align-items-center gap-2" style="font-size:13px;color:#64748b">
          <div style="width:10px;height:10px;border-radius:50%;background:#f97316"></div> Di-booking
        </div>
        <div class="d-flex align-items-center gap-2" style="font-size:13px;color:#64748b">
          <div style="width:10px;height:10px;border-radius:50%;background:#4f46e5"></div> Jadwal tetap
        </div>
        <div class="d-flex align-items-center gap-2" style="font-size:13px;color:#64748b">
          <div style="width:10px;height:10px;border-radius:50%;background:#fbbf24"></div> Hari ini
        </div>
      </div>
      <div class="cal-card">
        <div id="calendar"></div>
      </div>
    </div>
  </section>

  {{-- DAFTAR RUANGAN --}}
  <section class="py-5 bg-white">
    <div class="container">
      <div class="section-eyebrow">Ruangan</div>
      <h4 class="fw-bold mb-1" style="color:#0f172a">Daftar Ruangan</h4>
      <p class="mb-4" style="font-size:14px;color:#94a3b8">Pilih ruangan yang sesuai kebutuhan Anda</p>
      <div class="row g-4">
        @forelse ($ruangans as $ruangan)
        <div class="col-md-4">
          <div class="room-card h-100">
            <img src="{{ asset('storage/' . $ruangan->cover) }}"
                 class="w-100"
                 style="height:160px;object-fit:cover"
                 onerror="this.style.display='none'">
            <div class="p-3 d-flex flex-column">
              <div class="fw-bold mb-2" style="font-size:15px;color:#0f172a">{{ $ruangan->nama }}</div>
              <span class="room-chip mb-2">👥 {{ $ruangan->kapasitas }} orang</span>
              <p class="flex-grow-1" style="font-size:12px;color:#94a3b8;line-height:1.6">
                {{ \Illuminate\Support\Str::limit($ruangan->fasilitas, 65) }}
              </p>
              <a href="{{ route('bookings.create', $ruangan->id) }}"
                 class="btn btn-book w-100 mt-2">
                Booking Ruangan
              </a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <div style="font-size:40px">🏫</div>
          <p class="mt-2" style="color:#94a3b8">Belum ada data ruangan tersedia</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

</div>

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
      eventDisplay: 'block',
      eventBorderColor: 'transparent',
      dayMaxEvents: 3,
    });
    calendar.render();
  }
});
</script>
@endsection