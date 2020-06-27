<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\BankDepartment;
use App\Models\User;

class Role extends Model
{
    //
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function bank_departments()
    {
        return $this->belongsToMany(BankDepartment::class);
    }
}
