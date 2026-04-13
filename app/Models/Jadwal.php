<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ruangan;

class Jadwal extends Model
{
    protected $fillable = [
        'ruang_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'ket'
    ];

    public function ruangan()
    {   
        return $this->belongsTo(Ruangan::class, 'ruang_id');
    }
}