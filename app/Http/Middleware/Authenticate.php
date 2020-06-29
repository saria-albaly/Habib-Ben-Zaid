<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        // Assuming employeeid matches the windows logon
/*        if($request->server('REMOTE_USER') !== null){
            $remoteUser = substr($request->server('REMOTE_USER'), 1 + strpos($request->server('REMOTE_USER') , '\\'));        
            if ($request->server('AUTH_USER') && ($user = User::where(['email' => $remoteUser.""])->orWhere(['email' => $remoteUser.""])->first()))
            {
                $this->auth->login($user);
            }
            else
            {
                return redirect()->guest('auth/login');
            }
        }
        else
            return redirect()->guest('auth/login');*/
    }
}
