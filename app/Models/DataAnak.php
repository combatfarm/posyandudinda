<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnak extends Model
{
    use HasFactory;

    protected $table = 'data_anak';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'nik',
        'nama_ibu',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];
}
