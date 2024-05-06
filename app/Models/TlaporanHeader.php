<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TLaporanHeader extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_laporan_header'; 

    protected $fillable = [
        'disclosure_id',
        'm_ruang_lingkup_id',
        'lampiran_file',
    ];

    protected $dates = ['deleted_at']; 

}


