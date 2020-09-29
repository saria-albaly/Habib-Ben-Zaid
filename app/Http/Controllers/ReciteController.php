<?php

namespace App\Http\Controllers;

use App\Recite;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReciteController extends Controller
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
        $data['daterange'] = '#student_recite_time';
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
        
        $data['student_recite_array']   = Recite::with(['student','course','point'])->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();
        $data['_view']   = 'recites/index';
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recite  $recite
     * @return \Illuminate\Http\Response
     */
    public function show(Recite $recite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recite  $recite
     * @return \Illuminate\Http\Response
     */
    public function edit(Recite $recite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recite  $recite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recite $recite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recite  $recite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recite $recite)
    {
        //
    }
}
