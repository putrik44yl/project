<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('ruangan')
        ->orderBy('tanggal', 'desc')
        ->get()
        ->map(function ($jadwal) {
            $jadwal->tanggal_format = Carbon::parse($jadwal->tanggal)
                ->translatedFormat('l, j F Y');
            return $jadwal;
        });

        $title = 'Hapus Jadwal';
        $text  = 'Apakah anda yakin ingin menghapus jadwal ini?';
        confirmDelete($title, $text);

        return view('backend.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $jadwals  = Jadwal::all();   // sebenarnya ini nggak wajib
        $ruangans = Ruangan::all();

        return view('backend.jadwal.create', compact('jadwals', 'ruangans'));
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'ruang_id'   => 'required|exists:ruangans,id',
        'tanggal'    => 'required|date',
        'jam_mulai'  => 'required',
        'jam_selesai'=> 'required|after:jam_mulai',
        'ket'        => 'nullable|string',
    ]);

    Jadwal::create([
        'ruang_id'   => $validated['ruang_id'],
        'tanggal'    => $validated['tanggal'],
        'jam_mulai'  => $validated['jam_mulai'],
        'jam_selesai'=> $validated['jam_selesai'],
        'ket'        => $validated['ket'] ?? null,
    ]);

    return redirect()
        ->route('backend.jadwal.index')
        ->with('success', 'Jadwal berhasil ditambahkan');
}


}
