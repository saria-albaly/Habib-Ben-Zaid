<?php

namespace App\Http\Middleware;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Closure;

class RolesAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        /*// get user role permissions
        $role = Role::findOrFail(Auth::user()->role_id);
        $permissions = $role->permissions;// get requested action
        $actionName = class_basename($request->route()->getActionname());// check if requested action is in permissions list
        foreach ($permissions as $permission)
        {
         $_namespaces_chunks = explode('\\', $permission->controller);
         $controller = end($_namespaces_chunks);
         if ($actionName == $controller . '@' . $permission->method)
         {
           // authorized request
           return $next($request);
         }
        }// none authorized request
        return response('Unauthorized Action', 403);*/
    }
}

