<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class status_all extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'status_all_name',
    ];
}
