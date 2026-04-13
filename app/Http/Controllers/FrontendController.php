<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Jadwal;
use App\Models\Ruangan;

class FrontendController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('ruangan')->get();
        $jadwals = Jadwal::with('ruangan')->get();
        $ruangans = Ruangan::all(); 
        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'title' => 'Booking - ' . ($booking->ruangan->nama ?? 'Tanpa Ruangan'),
                'start' => $booking->tanggal . 'T' . $booking->jam_mulai,
                'end' => $booking->tanggal . 'T' . $booking->jam_selesai,
                'color' => '#f39c12',
            ];
        }

        foreach ($jadwals as $jadwal) {
            $events[] = [
                'title' => 'Jadwal - ' . ($jadwal->ruangan->nama ?? 'Tanpa Ruangan'),
                'start' => $jadwal->tanggal . 'T' . $jadwal->jam_mulai,
                'end' => $jadwal->tanggal . 'T' . $jadwal->jam_selesai,
                'color' => '#3498db', 
            ];
        }

        return view('welcome', [
            'jadwal' => $events,
            'ruangans' => $ruangans
        ]);
    }

    public function booking()
    {
        return view('booking_create');
    }

    public function ruanganShow(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangan_detail', compact('ruangan'));
    }       
}