<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    use HasFactory;

    protected $table = 'vitamin';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_anak',
        'tanggal_vitamin',
        'vitamin',
        'status'
    ];

    protected $casts = [
        'tanggal_vitamin' => 'date',
    ];
}
