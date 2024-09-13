<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class cotton extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'cotton_name',
    ];
}
