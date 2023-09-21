<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $table ='teachers';

    protected $guarded = [];

    use HasFactory;

    public function schools()
    {
        return $this->belongsToMany('App\Models\School','teacher_school');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\TeacherAttachment', 'teacher_id');
    }

}
