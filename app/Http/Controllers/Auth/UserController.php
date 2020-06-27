<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankDepartment;
use App\Models\Role;
use App\Models\User;
use App\Models\Notification;

class UserController extends Controller
{
    public function index()
    {
        //
        $data['users'] = User::with('role')->get();

        $data['table_script'] = true;
        // Page Styles & Scripts & Information 
        $data['styles']  = ['bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
                            'bower_components/select2/dist/css/select2.min.css'
                            ];
        $data['scripts'] = ['bower_components/datatables.net/js/jquery.dataTables.min.js',
                            'bower_components/select2/dist/js/select2.full.min.js',
                            'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                            ];
        $data['_view']   = 'roles/users';
        return view('include/main', $data);
    }

    public function create(Request $request)
    {
        //
        $data['user'] = User::with('bank_department')->find($request->user_id);
        $data['roles'] = Role::get();
        $data['user_id'] = $request->user_id;
        $data['deparments'] = $request->user_id;
        /*$data['departments'] = BankDepartment::where(['is_deleted'=>0])->get();*/
        return view('roles/modals/assign_role', $data);
    }

    public function assign_role(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'user_id' => 'required',
          ]);
        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();

        //Send notification
        $notification                    = new Notification();
        $notification->by_user_id        = \Illuminate\Support\Facades\Auth::user()->id;
        $notification->user_id           = $request->user_id;
        $notification->notification_name = "تم تغيير صلاحياتكم من قبل  ".\Illuminate\Support\Facades\Auth::user()->name." إلى ".Role::find($request->role_id)->name;
        $notification->link              = "#";
        $notification->save();

        return redirect('users');
    }
}
