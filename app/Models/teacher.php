<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class teacher extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'teacher_name',
        'picture_url'
    ];
}
