<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Course;

class StudentPoint extends Model
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
