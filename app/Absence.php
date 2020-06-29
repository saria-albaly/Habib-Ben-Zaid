<?php

namespace App;

use App\Student;
use App\Course;
use App\Point;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
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

    public function point()
    {
        return $this->belongsTo(Point::class,'point_id');
    }
}
