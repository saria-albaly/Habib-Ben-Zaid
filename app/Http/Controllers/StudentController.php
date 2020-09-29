<?php

namespace App\Http\Controllers;

use App\Student;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class StudentController extends Controller
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
        
        $data['students']   = Student::with('course')->where(['is_deleted'=>false])->orderBy('student_name', 'ASC')->get();
        $data['_view']   = 'students/index';
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
        $data['courses'] = Course::where(['is_deleted'=>false])->orderBy('class_name', 'ASC')->get();
        return view('students/modals/create_student',$data);
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
            'student_name' => 'required',
            'father_name' => 'required',
            'address' => 'required',
            'phone' => 'required'
          ]);
        
        $student_name = $request->student_name;
        
        $father_name = $request->father_name;
        
        $address = $request->address;
        
        $phone = $request->phone;
        
        $talents = $request->talents;
        
        $student_image = 'defualt.jpg';
        
        $brothers = $request->brothers;
        
        $course_id = $request->course_id;

        if(!isset($student_name) || !isset($father_name) || !isset($address) || !isset($phone)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $student                = new Student();
        $student->student_name  = $student_name;
        $student->father_name   = $father_name;
        $student->address       = $address;
        $student->phone         = $phone;
        $student->talents       = $talents;
        $student->student_image = $student_image;
        $student->brothers      = $brothers;
        $student->course_id     = $course_id;
        $student->save();

        $uploadedFile = $request->file('file');
        $dir = 'students\\';
        //Upload Files
        if (!file_exists($dir)) {
            echo "Create The Image Directory";
            mkdir($dir, 0777, true);
        }

        if(isset($uploadedFile)){
            $fileName = explode('.',$uploadedFile->getClientOriginalName());
            $filename = $student->id.'.'.$fileName[sizeof($fileName)-1];
            //$uploadedFile->move($dir, $filename);
            Storage::disk('public')->putFileAs(
                $dir,
                $uploadedFile,
                $filename
              );
            $student->student_image = $filename;
            $student->save();
        }

        return redirect('student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Student $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $students)
    {
        //
        var_dump($students);
        die();
        $students['courses'] = Course::where(['is_deleted'=>false])->orderBy('class_name', 'ASC')->get();
        return view('students/modals/edit_student',$students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $students)
    {
        //
        $request->validate([
            'student_name' => 'required',
            'father_name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        
        $student_name = $request->student_name;
        
        $father_name = $request->father_name;
        
        $address = $request->address;
        
        $phone = $request->phone;
        
        $talents = $request->talents;
        
        $student_image = 'defualt.jpg';
        
        $brothers = $request->brothers;
        
        $course_id = $request->course_id;

        if(!isset($student_name) || !isset($father_name) || !isset($address) || !isset($phone)){
            $data['_view']   = 'global_modal/404';
            return view('include/main', $data); 
        }

        $student->student_name  = $student_name;
        $student->father_name   = $father_name;
        $student->address       = $address;
        $student->phone         = $phone;
        $student->talents       = $talents;
        $student->student_image = $student_image;
        $student->brothers      = $brothers;
        $student->course_id     = $course_id;

        $uploadedFile = $request->file('file');
        $dir = 'students\\';
        //Upload Files
        if (!file_exists($dir)) {
            echo "Create The Image Directory";
            mkdir($dir, 0777, true);
        }

        if(isset($uploadedFile)){
            $fileName = explode('.',$uploadedFile->getClientOriginalName());
            $filename = $student->id.'.'.$fileName[sizeof($fileName)-1];
            //$uploadedFile->move($dir, $filename);
            Storage::disk('public')->putFileAs(
                $dir,
                $uploadedFile,
                $filename
              );
            $student->student_image = $filename;
        }
        
        $student->save();
        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $students)
    {
        //
        $students->is_deleted = true;
        $students->save();

        return redirect('student');
    }

    public function search(Request $request)
    {
        //
      $type = $request->type;
      $term = $request->search;
      if($type=="all"){
        $term = $request->search1;
        if(isset($term))
          $type = 'student_id';
        else{
          $type = 'student_name';
          $term = $request->search2;
        }
      }

      if($type == 'student_id'){
        $filterResults = Student::with('course')->select(['*','student_name as label'])->where(['is_deleted'=>false,'id'=>$term])
                                                ->orderBy('student_name', 'ASC')->get()->toArray();
      }
      else{
        $filterResults = Student::with('course')->select(['*','student_name as label'])->where(['is_deleted'=>false])
                                                ->where('student_name', 'like', '%' .$term. '%')
                                                ->orderBy('student_name', 'ASC')->get()->toArray();
      }
      return response()->json($filterResults);
    }
}
