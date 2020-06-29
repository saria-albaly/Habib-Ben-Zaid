<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Teacher;
use App\Student;

class Course extends Model
{
    //
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'course_id');
    }
}
