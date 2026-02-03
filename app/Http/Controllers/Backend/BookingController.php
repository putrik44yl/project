<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bookings;
use App\Models\ruangans;
use App\Models\jadwals;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        bookings::where(function ($query) {
            $query->where('tanggal', '<', now()->toDateString())->orWhere(function ($q) 
            {$q->where('tanggal', now()->toDateString())->where('jam_selesai', '<', now()->format('H:i:s'));         
        });

        })
        ->where('status', '!=', 'Selesai')
        ->update(['status' => 'Selesai']);

        //mengambil filter
        $query = bookings::with(['ruangan', 'user'])->orderBy('tanggal', 'desc');

        if ($request->filled('ruang_id')) {
            $query->where('ruang_id', $request->ruang_id);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // format tanggal
        $bookings = $query->get()->map(function($booking) {
            $booking->tanggal_format = Carbon::parse($booking->tanggal)->translatedFormat('l, j F Y');
            return $booking;
        });

        $ruangans = ruangans::all();

        confirmDelete('Hapus Booking', 'Apakah Anda yakin ingin menghapus booking ini?');
        return view('backend.bookings.index', compact('bookings', 'ruangans'));
    }

    public function destroy($id)
    {
        $booking = bookings::findOrFail($id);
        $booking->delete();

        toast('Booking berhasil dihapus.', 'success');
        return redirect()->route('backend.bookings.index');
    }
}