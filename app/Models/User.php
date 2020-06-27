<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\BankDepartment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    public function bank_department()
    {
        return $this->belongsToMany(BankDepartment::class);
    }

    public function userRole()
    {
        //return $this->join('roles','roles.id','=','role_id')->join('permission_role','permission_role.role_id','=','roles.id')->get();
        return DB::table('permission_role')->where(['role_id'=>Auth::user()->role_id])->get();
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
}
