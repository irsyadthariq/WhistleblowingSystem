<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MruangLingkup extends Model
{
    use SoftDeletes;
    protected $table = 'm_ruang_lingkup';
    protected $guarded = [];
    use HasFactory;
}
