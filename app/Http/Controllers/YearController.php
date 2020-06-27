<?php

namespace App\Http\Controllers;

use App\Year;
use Illuminate\Http\Request;

class YearController extends Controller
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
        
        $data['_view']   = 'doucments/index';
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
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        //
    }
}
