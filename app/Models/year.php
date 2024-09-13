<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class year extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'year_name',
    ];
}
