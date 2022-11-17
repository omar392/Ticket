<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = ['name','email','image','password','department_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
