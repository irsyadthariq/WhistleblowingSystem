<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mfaq extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_faq'; 

    protected $fillable = [
        'pertanyaan',
        'jawaban',
    ];

    protected $dates = ['deleted_at']; 
}