<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TlaporanDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_laporan_detail'; 

    protected $fillable = [
        't_laporan_header_id',
        'm_pertanyaan_id',
        'jawaban',
    ];

    protected $dates = ['deleted_at']; 

}

