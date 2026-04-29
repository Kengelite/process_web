<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $table = 'files';
    protected $primaryKey = 'file_id';

    protected $fillable = [
        'uploaded_by_user_id',
        'file_path',
        'file_size',
        'file_type',
    ];

    /**
     * ความสัมพันธ์กับตาราง users (ผู้อัปโหลด)
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by_user_id', 'user_id');
    }
}
