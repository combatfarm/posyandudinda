<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'nik',
        'nama_ibu',
        'nama_anak',
        'no_telp',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'usia',
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'usia' => 'string',
    ];
} 