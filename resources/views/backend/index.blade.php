@extends('layouts.backend')

@section('content')

 <div class="container-fluid">
          <!--  count -->
          <div class="row">
            <!-- user -->
            <div class="col-md-3"> <!-- atur ukuran card -->
              <div class="card border-0 zoom-in bg-primary shadow">
                <a href="{{route('backend.user.index')}}">
                  <div class="card-body">
                    <div class="text-center">
                      <i class="ti ti-user" style="font-size: 70px; color: white;"></i>
                      <p class="fw-semibold fs-3 text-light mb-1">User</p>
                      <h5 class="fw-semibold text-light mb-0">{{ \App\Models\User::count() }}</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- end user -->

            <!-- ruangan -->
            <div class="col-md-3"> <!-- atur ukuran card -->
              <div class="card border-0 zoom-in bg-primary shadow">
                <a href="{{route ('backend.ruangan.index')}}">
                  <div class="card-body">
                    <div class="text-center">
                      <i class="ti ti-door" style="font-size: 70px; color: white;"></i>
                      <p class="fw-semibold fs-3 text-light mb-1">Ruangan</p>
                      <h5 class="fw-semibold text-light mb-0">{{ \App\Models\ruangans::count() }}</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- end ruangan -->

            <!-- jadwal -->
            <div class="col-md-3"> <!-- atur ukuran card -->
              <div class="card border-0 zoom-in bg-primary shadow">
                <a href="{{route ('backend.jadwal.index')}}">
                  <div class="card-body">
                    <div class="text-center">
                      <i class="ti ti-calendar" style="font-size: 70px; color: white;"></i>
                      <p class="fw-semibold fs-3 text-light mb-1">jadwal</p>
                      <h5 class="fw-semibold text-light mb-0">{{ \App\Models\jadwals::count() }}</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- end jadwal -->

            <!-- booking -->
            <div class="col-md-3"> <!-- atur ukuran card -->
              <div class="card border-0 zoom-in bg-primary shadow">
                <a href="{{route ('backend.bookings.index')}}">
                  <div class="card-body">
                    <div class="text-center">
                      <i class="ti ti-bookmark" style="font-size: 70px; color: white;"></i>
                      <p class="fw-semibold fs-3 text-light mb-1">booking</p>
                      <h5 class="fw-semibold text-light mb-0">{{ \App\Models\bookings::count() }}</h5>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <!-- end booking -->
          </div>
          <!-- end count -->
        </div>

@endsection