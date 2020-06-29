<?php

namespace App\Http\Controllers;

use App\Absence;
use App\YearSemester;
use App\Student;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AbsenceController extends Controller
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
        $data['daterange'] = '#student_arrival_time';
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
        
        $data['student_absence_array']   = Absence::with(['student','course','point'])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();
        $data['_view']   = 'absence/index';
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
            'type' => 'required',
            'now' => 'required',
        ]);

        $student_id         = $request->student_id;
        $type               = $request->type;
        $is_now             = $request->now;
        $arrival_datetime   = $request->arrival_datetime;

        if(!isset($student_id) || (!isset($student_id) && $is_now == 0 && !isset($arrival_datetime) ))
            return response()->json(['error'=>true , 'message'=> 'خطأ في مدخلات النظام، رقم الطالب غير صحيح أو لم يتم تحديد وقت الوصول بشكل صحيح']);

        if(!isset($type) || $type = 'ontime')
            $point_id = 1;
        else
            $point_id = 2;

        //Get Current Student Class
        $course_id = Student::find($student_id)->course_id;
        //Get Current Year-Semester ID
        $result  = YearSemester::where(['is_active'=>true])->get();

        if(!isset($course_id) || $result->isEmpty())
            return response()->json(['error'=>true , 'message'=> 'رقم الطالب غير صحيح أو لا يوجد فصول مفعلة حالياً، لتفعيل أو إضافة فصل اضغط هنا <a href="'.url('semesters').'"> إدارة الفصول </a>']);
        else if($result->isEmpty())
            return response()->json(['error'=>true , 'message'=> 'لا يوجد فصول مفعلة حالياً، لتفعيل أو إضافة فصل اضغط هنا <a href="'.url('semesters').'"> إدارة الفصول </a>']);
        if($is_now == 1)
            $checkDuplicates = Absence::where(['student_id'=>$student_id, 'y_s_c_id'=>$result->toArray()[0]['id']])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();
        else{
            $dt = new DateTime($arrival_datetime);
            $date = $dt->format('Y-m-d');
            $checkDuplicates = Absence::where(['student_id'=>$student_id, 'y_s_c_id'=>$result->toArray()[0]['id']])->whereDate('created_at', $date)->orderBy('created_at', 'DESC')->get();
        }

        if(!$checkDuplicates->isEmpty())
            return response()->json(['error'=>true , 'message'=> 'تم تسجيل حضور الطالب في نفس اليوم بالوقت التالي :'.$checkDuplicates->toArray()[0]['created_at']]);

        $student_absence             = new Absence();
        $student_absence->student_id = $student_id;
        $student_absence->point_id   = $point_id;
        $student_absence->course_id  = $course_id;
        $student_absence->y_s_c_id   = $result->toArray()[0]['id'];
        if($is_now == 0){
            $student_absence->created_at = new DateTime($arrival_datetime);
            $student_absence->updated_at = new DateTime();
            $student_absence->save(['timestamps' => false]);
        }
        else
            $student_absence->save();

        return response()->json(['message'=> 'تم تسجيل الحضور بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
        $absence->delete();
        return response()->json(['message'=> 'تم حذف السطر بنجاح']);
    }

    public function refresh(){
        $data['student_absence_array']   = Absence::with(['student','course','point'])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();

        $view = \View::make('absence/table_template', $data) ;

        $html = $view->render();

        return $html;
    }
}
