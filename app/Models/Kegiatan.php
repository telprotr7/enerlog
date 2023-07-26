<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = "kegiatan";

    protected $fillable = [
        'penyelenggara',
        'nama_kegiatan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan'
    ];
}
