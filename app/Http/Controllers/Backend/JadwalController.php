<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\jadwals;
use App\Models\ruangans;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
        public function index() 
    {
        $jadwals = jadwals::orderBy('tanggal', 'desc')->get()->map(function ($jadwal) {
            $jadwal->tanggal_format = Carbon::parse($jadwal->tanggal)->translatedFormat('l, j F Y');
            return $jadwal;
        });

        $title = 'Jadwal telah dihapus';
        $text  = 'Apakah anda yakin ingin menghapus jadwal ini?';
        confirmDelete($title, $text);

        return view('backend.jadwal.index', compact('jadwals'));
    }
}
