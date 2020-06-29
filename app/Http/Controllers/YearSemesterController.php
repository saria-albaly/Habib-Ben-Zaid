<?php

namespace App\Http\Controllers;

use App\YearSemester;
use App\Semester;
use App\Year;
use Illuminate\Http\Request;

class YearSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['years']       = Year::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        $data['semesters']   = Semester::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        return view('semesters/modals/create_year_semester',$data);
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
            'session_number' => 'required|max:1000',
            'startdate' => 'required',
            'enddate' => 'required',
            'year_id' => 'required',
            'semester_id' => 'required'
          ]);

        $session_number = $request->session_number;
        $startdate      = $request->startdate;
        $enddate        = $request->enddate;
        $year_id        = $request->year_id;
        $semester_id    = $request->semester_id;

        if(!isset($year_id) || !isset($semester_id)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;

        $semester                   = new YearSemester();

        $semester->session_number   = $session_number;
        $semester->startdate        = $startdate  ;
        $semester->enddate          = $enddate;
        $semester->year_id          = $year_id  ;
        $semester->semester_id      = $semester_id;
        $semester->is_active        = $is_active;
        $semester->save();
        return redirect('semesters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $semester                = YearSemester::find($request->id);
        $semester['years']       = Year::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        $semester['semesters']   = Semester::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        return view('semesters/modals/edit_year_semester',$semester);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'session_number' => 'required|max:1000',
            'startdate' => 'required',
            'enddate' => 'required',
            'year_id' => 'required',
            'semester_id' => 'required'
          ]);

        $session_number = $request->session_number;
        $startdate      = $request->startdate;
        $enddate        = $request->enddate;
        $year_id        = $request->year_id;
        $semester_id    = $request->semester_id;

        if(!isset($year_id) || !isset($semester_id)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;
        $semester                = YearSemester::find($request->id);
        $semester->session_number   = $session_number;
        $semester->startdate        = $startdate  ;
        $semester->enddate          = $enddate;
        $semester->year_id          = $year_id  ;
        $semester->semester_id      = $semester_id;
        $semester->is_active        = $is_active;
        $semester->save();

        return redirect('semesters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $semester                = YearSemester::find($request->id);
        $semester->is_deleted = true;
        $semester->save();

        return redirect('semesters');
    }
}
