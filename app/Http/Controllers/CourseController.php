<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use App\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['table_script'] = true;
        $data['styles']  = ['bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
                            'bower_components/select2/dist/css/select2.min.css'
                            ];
        $data['scripts'] = ['bower_components/datatables.net/js/jquery.dataTables.min.js',
                            'bower_components/select2/dist/js/select2.full.min.js',
                            'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                            ];
        
        $data['courses']   = Course::with('students')->where(['is_deleted'=>false])->orderBy('class_name', 'ASC')->get();
        $data['_view']   = 'courses/index';
        return view('include/main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['teachers'] = Teacher::where(['is_deleted'=>false])->orderBy('teacher_name', 'ASC')->get();
        return view('courses/modals/create_course',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'class_name' => 'required',
            'teacher_id' => 'required'
          ]);

        $class_name = $request->class_name;
        $teacher_id = $request->teacher_id;

        if(!isset($class_name) || !isset($teacher_id) ){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $course            = new Course();
        $course->class_name    = $class_name;
        $course->teacher_id    = $teacher_id;
        $course->save();

        return redirect('courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        $course['teachers'] = Teacher::where(['is_deleted'=>false])->orderBy('teacher_name', 'ASC')->get();
        return view('courses/modals/edit_course',$course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
        $request->validate([
            'class_name' => 'required',
            'teacher_id' => 'required'
          ]);

        $class_name = $request->class_name;
        $teacher_id = $request->teacher_id;

        if(!isset($class_name) || !isset($teacher_id) ){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $course->class_name    = $class_name;
        $course->teacher_id    = $teacher_id;
        $course->save();

        return redirect('courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        $course->is_deleted = true;
        $course->save();

        return redirect('courses');
    }
}
