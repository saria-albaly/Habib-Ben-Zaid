<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        
        $data['teachers']   = Teacher::where(['is_deleted'=>false])->orderBy('teacher_name', 'ASC')->get();
        $data['_view']   = 'teachers/index';
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
        return view('teachers/modals/create_teacher');
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
            'teacher_name' => 'required',
            'teacher_phone' => 'required',
            'teacher_address' => 'required'
          ]);

        $teacher_name = $request->teacher_name;
        $teacher_phone = $request->teacher_phone;
        $teacher_address = $request->teacher_address;

        if(!isset($teacher_name) || !isset($teacher_phone) || !isset($teacher_address) ){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $teacher            = new Teacher();
        $teacher->teacher_name    = $teacher_name;
        $teacher->teacher_phone   = $teacher_phone;
        $teacher->teacher_address = $teacher_address;
        $teacher->save();

        return redirect('teachers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        return view('teachers/modals/edit_teacher',$teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $request->validate([
            'teacher_name' => 'required',
            'teacher_phone' => 'required',
            'teacher_address' => 'required'
          ]);

        $teacher_name = $request->teacher_name;
        $teacher_phone = $request->teacher_phone;
        $teacher_address = $request->teacher_address;

        if(!isset($teacher_name) || !isset($teacher_phone) || !isset($teacher_address) ){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $teacher->teacher_name    = $teacher_name;
        $teacher->teacher_phone   = $teacher_phone;
        $teacher->teacher_address = $teacher_address;
        $teacher->save();

        return redirect('teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        $teacher->is_deleted = true;
        $teacher->save();

        return redirect('teachers');
    }
}
