<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['complaint_id','writer','title','description','attached'];
    public function complaint()
    {
        return $this->belongsTo(Complaint::class,'complaint_id');
    }
}
