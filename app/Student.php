<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Student extends Model
{
    //
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
