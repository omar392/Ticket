<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = ['department_id','user_id','title','description','status','attached','complaint_id'];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
