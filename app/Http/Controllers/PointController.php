<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\YearSemester;
use App\Student;
use App\StudentPoint;
use Carbon\Carbon;
use DateTime;

class PointController extends Controller
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
        $data['daterange'] = '#student_point_time';
        $data['styles']  = ['bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
                            'bower_components/bootstrap-daterangepicker/daterangepicker.css',
                            'bower_components/select2/dist/css/select2.min.css'
                            ];
        $data['scripts'] = ['bower_components/datatables.net/js/jquery.dataTables.min.js',
                            'bower_components/select2/dist/js/select2.full.min.js',
                            'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                            'bower_components/moment/moment.js',
                            'bower_components/bootstrap-daterangepicker/daterangepicker.js'
                            ];
        
        $data['student_point_array']   = StudentPoint::with(['student','course'])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();
        $data['_view']   = 'student_points/index';
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
            'student_id' => 'required',
            'point_amount' => 'required',
            'now' => 'required',
        ]);

        $student_id         = $request->student_id;
        $point_amount       = $request->point_amount;
        $point_cause        = $request->point_cause || "لم يتم ذكر السبب";
        $is_now             = $request->now;
        $point_datetime   = $request->point_datetime;

        if(!isset($student_id) || (!isset($student_id) && $is_now == 0 && !isset($point_datetime) ))
            return response()->json(['error'=>true , 'message'=> 'خطأ في مدخلات النظام، رقم الطالب غير صحيح أو لم يتم تحديد وقت النقاط بشكل صحيح']);

        //Get Current Student Class
        $course_id = Student::find($student_id)->course_id;
        //Get Current Year-Semester ID
        $result  = YearSemester::where(['is_active'=>true])->get();

        if(!isset($course_id) || $result->isEmpty())
            return response()->json(['error'=>true , 'message'=> 'رقم الطالب غير صحيح أو لا يوجد فصول مفعلة حالياً، لتفعيل أو إضافة فصل اضغط هنا <a href="'.url('semesters').'"> إدارة الفصول </a>']);
        else if($result->isEmpty())
            return response()->json(['error'=>true , 'message'=> 'لا يوجد فصول مفعلة حالياً، لتفعيل أو إضافة فصل اضغط هنا <a href="'.url('semesters').'"> إدارة الفصول </a>']);

        $student_point             = new StudentPoint();
        $student_point->student_id = $student_id;
        $student_point->point_amount = $point_amount;
        $student_point->point_cause = $point_cause;
        $student_point->course_id  = $course_id;
        $student_point->y_s_c_id   = $result->toArray()[0]['id'];
        if($is_now == 0){
            $student_point->created_at = new DateTime($point_datetime);
            $student_point->updated_at = new DateTime();
            $student_point->save(['timestamps' => false]);
        }
        else
            $student_point->save();

        return response()->json(['message'=> 'تم تسجيل النقاط بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentPoint  $point
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPoint $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentPoint  $student_point
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPoint $student_point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentPoint  $student_point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $student_point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentPoint  $student_point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StudentPoint $student_point)
    {
        //
        $student_point = StudentPoint::find($request->id);
        $student_point->delete();
        return response()->json(['message'=> 'تم حذف السطر بنجاح']);
    }


    public function refresh(){
        $data['student_point_array']   = StudentPoint::with(['student','course'])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();

        $view = \View::make('student_points/table_template', $data) ;

        $html = $view->render();

        return $html;
    }
}
