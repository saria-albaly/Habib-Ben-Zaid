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
        
        $data['years']   = Year::where(['is_deleted'=>false])->orderBy('id', 'DESC')->get();
        $data['_view']   = 'years/index';
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
        return view('years/modals/create_year');
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
            'year_name' => 'required:max:2100',
          ]);

        $year_name = $request->year_name;

        if(!isset($year_name)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;

        $year            = new Year();
        $year->year_name = $year_name;
        $year->is_active = $is_active;
        $year->save();
        return redirect('years');
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
        return view('years/modals/edit_year',$year);
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
        $request->validate([
            'year_name' => 'required:max:2100',
        ]);

        $year_name = $request->year_name;

        if(!isset($year_name)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $is_active = $request->is_active || false;
        if(isset($is_active) && $is_active == "on")
            $is_active = true;

        $year->year_name = $year_name;
        $year->is_active = $is_active;
        $year->save();

        return redirect('years');
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
        $year->is_deleted = true;
        $year->save();

        return redirect('years');
    }
}
