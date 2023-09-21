<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttachment extends Model
{
    protected $guarded = [];
    protected $table = 'teacher_attachments';


//    public function teachers()
//    {
//        return $this->belongsTo('App\Models\Teacher');
//    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }


//    use HasFactory;
}
