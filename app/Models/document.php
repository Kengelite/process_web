<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class document extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'id_number',
        'document_name',
        'version',
        'end_time'
    ];
}
