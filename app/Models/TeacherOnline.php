<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherOnline extends Model
{
    protected $table = 't_teacher_online';

    public function teacher()
    {
        return $this->hasOne('App\User','id', 'teacher_id');
    }
}
