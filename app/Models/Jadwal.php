<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal'; // Menentukan nama tabel jika tidak mengikuti konvensi
    protected $fillable = ['tanggal', 'waktu']; // Kolom yang dapat diisi
}
