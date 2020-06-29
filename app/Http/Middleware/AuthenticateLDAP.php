<?php 

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Notification;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
    
class AuthenticateLDAP {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user = User::where(['username' => "luay"])->first();  //
        $this->auth->login($user);
        return $next($request);

/*        if($request->server('REMOTE_USER') !== null){
            $remoteUser = substr($request->server('REMOTE_USER'), 1 + strpos($request->server('REMOTE_USER') , '\\'));  
            $user = User::where(['email' => $remoteUser.""])->orWhere(['email' => $remoteUser.""])->first();    
            if ($remoteUser && ($user !== null ))
            {
                if($user->role != null){
                    $this->auth->login($user);
                    return $next($request);
                }
                else{
                    return redirect()->guest('auth/login');
                }
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