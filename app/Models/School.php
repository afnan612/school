<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table ='schools';

    protected $guarded = [];

    use HasFactory;


//    public function teachers()
//    {
//        return $this->hasMany(Teacher::class);
//    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_school');
    }

}
