<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Muser extends Model
{
    use SoftDeletes;
    protected $table = 'm_user';
    protected $guarded = [];
    use HasFactory;
}
