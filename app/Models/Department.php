<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','active'];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
