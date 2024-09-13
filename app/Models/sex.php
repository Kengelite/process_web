<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class sex extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'sex_name',
    ];
}
