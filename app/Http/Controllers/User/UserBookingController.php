<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    // ================= BOOKING =================
    public function create(Request $request)
    {
        $ruangans = Ruangan::all();

        $selectedRuangan = $request->ruangan_id;

        return view('booking_create', compact('ruangans', 'selectedRuangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $tanggalInput = Carbon::parse($request->tanggal)->format('Y-m-d');
        $hariIni = Carbon::now()->format('Y-m-d');

        if ($tanggalInput === $hariIni) {
            $jamSelesai = Carbon::parse($request->tanggal . ' ' . $request->jam_selesai);
            if ($jamSelesai->lt(Carbon::now())) {
                return back()
                    ->withInput()
                    ->with('error', 'Waktu booking sudah lewat.');
            }
        }

        // ================= CEK BENTROK BOOKING =================
        $cekBentrok = Booking::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                          ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($cekBentrok) {
            return back()->withInput()->with('error', 'Jadwal sudah dibooking!');
        }

        // ================= CEK BENTROK JADWAL =================
        $bentrokJadwal = Jadwal::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($data) use ($request) {
                $data->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($jadwal) use ($request) {
                        $jadwal->where('jam_mulai', '<=', $request->jam_mulai)
                               ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($bentrokJadwal) {
            return back()->withInput()->with('error', 'Bentrok dengan jadwal tetap!');
        }

        // ================= CEK JEDA 30 MENIT =================
        $lastBooking = Booking::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_selesai', '<=', $request->jam_mulai)
            ->orderBy('jam_selesai', 'desc')
            ->first();

        if ($lastBooking) {
            $lastEnd = Carbon::parse($request->tanggal . ' ' . $lastBooking->jam_selesai);
            $newStart = Carbon::parse($request->tanggal . ' ' . $request->jam_mulai);

            if ($lastEnd->gt($newStart->copy()->subMinutes(30))) {
                return back()->withInput()->with('error', 'Harus ada jeda 30 menit!');
            }
        }

        // ================= SIMPAN =================
        $booking = new Booking();
        $booking->user_id     = Auth::id();
        $booking->ruang_id    = $request->ruang_id;
        $booking->tanggal     = $request->tanggal;
        $booking->jam_mulai   = $request->jam_mulai;
        $booking->jam_selesai = $request->jam_selesai;
        $booking->status      = 'Pending';
        $booking->save();

        return redirect()->route('bookings.create')
            ->with('success', 'Booking berhasil, tunggu konfirmasi!');
    }

    // ================= RIWAYAT =================
    public function riwayat()
    {
        $booking = Booking::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($item) {
                $item->tanggal_format = Carbon::parse($item->tanggal)
                    ->translatedFormat('l, j F Y');
                return $item;
            });

        return view('booking_riwayat', compact('booking'));
    }

    // ================= LIST RUANGAN =================
    public function show()
    {
        $ruangans = Ruangan::all();
        return view('ruangan', compact('ruangans'));
    }
}