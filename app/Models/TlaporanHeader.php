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
        'disclosure_status',
        'm_ruang_lingkup_id',
        'lampiran_file',
        'nama_pelapor',
        'departemen',
        'alamat_email',
        'nomor_kontak',
        'informasi_lain',
        'koneksi',
        'password',
        'status',
        'bobot_status',
        'keterangan',
                   
    ];

    protected $dates = ['deleted_at']; 

}


