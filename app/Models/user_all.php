<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_all extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_fname',
        'user_lname',
        'user_mail',
        'user_password',
        'user_role'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    // ตัวอย่างการเข้ารหัสรหัสผ่าน (ในกรณีนี้ใช้ md5)
    public function setUserPasswordAttribute($value)
    {
        $this->attributes['user_password'] = md5($value);
    }
}
