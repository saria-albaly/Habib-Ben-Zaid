<?php

namespace App\Http\Controllers;

use App\Semester;
use App\YearSemester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['table_script']   = true;
        $data['table_script_2'] = true;
        $data['styles']  = ['bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
                            'bower_components/select2/dist/css/select2.min.css'
                            ];
        $data['scripts'] = ['bower_components/datatables.net/js/jquery.dataTables.min.js',
                            'bower_components/select2/dist/js/select2.full.min.js',
                            'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                            ];
        
        $data['semesters']        = Semester::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        $data['semester_years']   = YearSemester::with(['year','semester'])->where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        $data['_view']       = 'semesters/index';
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
        return view('semesters/modals/create_semester');
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
            'semester_name' => 'required',
          ]);

        $semester_name = $request->semester_name;

        if(!isset($semester_name)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;

        $semester            = new Semester();
        $semester->semester_name = $semester_name;
        $semester->is_active = $is_active;
        $semester->save();
        return redirect('semesters');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
        return view('semesters/modals/edit_semester',$semester);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        //
        $request->validate([
            'semester_name' => 'required',
        ]);

        $semester_name = $request->semester_name;

        if(!isset($semester_name)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;

        $semester->semester_name = $semester_name;
        $semester->is_active = $is_active;
        $semester->save();

        return redirect('semesters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        //
        $semester->is_deleted = true;
        $semester->save();

        return redirect('semesters');
    }
}
