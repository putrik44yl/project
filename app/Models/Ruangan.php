<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{

    protected $fillable = ['cover', 'nama', 'kapasitas', 'fasilitas'];

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }
 
    public function Jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

}
