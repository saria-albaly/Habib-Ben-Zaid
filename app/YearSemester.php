<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Year;
use App\Semester;

class YearSemester extends Model
{
	protected $table = 'year_semester_course';
    //
    public function year()
    {
        return $this->belongsTo(Year::class,'year_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id');
    }
}
