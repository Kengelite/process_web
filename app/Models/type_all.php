<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_all extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'type_all_name',
    ];
}
