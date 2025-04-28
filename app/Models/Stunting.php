<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stunting extends Model
{
    use HasFactory;

    protected $table = 'stunting';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_anak',
        'tanggal',
        'usia',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'catatan',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'lingkar_kepala' => 'decimal:2'
    ];
}
