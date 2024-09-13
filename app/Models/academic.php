<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class academic extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'academic_name',
        'academic_stort_name'
    ];

}
