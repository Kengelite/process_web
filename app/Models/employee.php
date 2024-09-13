<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'emp_name',
        'picture_url',
        'emp_name'
    ];
}
