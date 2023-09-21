<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\AssignOp\Mod;

//use Illuminate\Database\Eloquent\Factories\HasFactory;

//use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    protected $table ='user';

    protected $guarded = [];



    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

}



