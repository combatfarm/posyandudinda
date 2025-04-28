<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganAnak extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_anak';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_anak',
        'tanggal',
        'berat_badan',
        'ket_berat_badan',
        'tinggi_badan',
        'ket_tinggi_badan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
    ];
}
