<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\BankDepartment;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        //
        $data['roles'] = Role::get();
        $data['table_script'] = true;
        // Page Styles & Scripts & Information 
        $data['styles']  = ['bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
                            'bower_components/select2/dist/css/select2.min.css'
                            ];
        $data['scripts'] = ['bower_components/datatables.net/js/jquery.dataTables.min.js',
                            'bower_components/select2/dist/js/select2.full.min.js',
                            'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                            ];
        $data['_view']   = 'roles/index';
        return view('include/main', $data);
    }

    public function create()
    {
        //
        $data['permissions'] = Permission::get();
        $data['departments'] = BankDepartment::where(['is_deleted'=>0])->get();
        return view('roles/modals/create_new_role', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
          ]);

        $same_dep = false;
        if(isset($request->same_dep) && $request->same_dep == 'on' )
            $same_dep = true;
        //@TODO 
        // Check if permission_ids & department_id exist
        $new_role = new Role();
        $new_role->name         = $request->name;
        $new_role->description  = $request->description;
        $new_role->same_dep     = $same_dep;
        $new_role->save();

        $new_role->permissions()->attach($request->permissions);
        /*$new_role->bank_departments()->attach($request->bank_department);*/

        return redirect('roles');
    }

    public function edit(Role $role)
    {
        //
        $data['permissions'] = Permission::get();
        $data['departments'] = BankDepartment::where(['is_deleted'=>0])->get();
        $data['role']        =  $role;
        
        // Array Of Permissions ID
        $data['role_permissions'] = array();
        $tempPermissions = $role->permissions->toArray();
        foreach ($tempPermissions as $row) {
            # code...
            $data['role_permissions'][] = $row['id'];
        }

        // Array Of Department ID
        $data['role_bank_dep'] = array();
        $tempBnkDep = $role->bank_departments->toArray();
        foreach ($tempBnkDep as $row) {
            # code...
            $data['role_bank_dep'][] = $row['id'];
        }

        return view('roles/modals/edit_role', $data);
    }

    public function viewDetails(Request $request)
    {
        //
        $role = Role::find($request->role_id);
        $data['disabled'] = true;
        $data['permissions'] = Permission::get();
        $data['departments'] = BankDepartment::where(['is_deleted'=>0])->get();
        $data['role']        =  $role;
        
        // Array Of Permissions ID
        $data['role_permissions'] = array();
        $tempPermissions = $role->permissions->toArray();
        foreach ($tempPermissions as $row) {
            # code...
            $data['role_permissions'][] = $row['id'];
        }

        // Array Of Department ID
        $data['role_bank_dep'] = array();
        $tempBnkDep = $role->bank_departments->toArray();
        foreach ($tempBnkDep as $row) {
            # code...
            $data['role_bank_dep'][] = $row['id'];
        }

        return view('roles/modals/edit_role', $data);
    }

    public function update(Request $request, Role $role)
    {
        //
        $same_dep = false;
        if(isset($request->same_dep) && $request->same_dep == 'on' )
            $same_dep = true;
        
        $role->name         = $request->name;
        $role->description  = $request->description;
        $role->same_dep     = $same_dep;

        $role->save();
        
        $role->permissions()->detach();
        $role->permissions()->attach($request->permissions);

        $role->bank_departments()->detach();
        $role->bank_departments()->attach($request->bank_department);

        return redirect('roles');
    }

    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);
          if($role) {
            $role->permissions()->detach();
            $role->bank_departments()->detach();
            $role->delete();
          }

        return redirect('roles');
    }
}
