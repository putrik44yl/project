<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = ['user_id', 'ruang_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruang_id');
    }

     

}
