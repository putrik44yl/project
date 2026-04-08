<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['ruang_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'ket'];

    public function ruangan()
    {   
        return $this->belongsTo(ruangans::class, 'ruang_id');
    }
}
 