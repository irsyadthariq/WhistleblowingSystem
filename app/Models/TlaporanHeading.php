<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TlaporanHeading extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_laporan_heading'; 

    protected $fillable = [
        't_laporan_header_id',
        'password',
        'ket_laporan',
        'status',
    ];

    protected $dates = ['deleted_at']; 

}
