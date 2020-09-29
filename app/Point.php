<?php

namespace App;
use App\Student;
use App\Course;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    //
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
