<?php

namespace App\Http\Controllers\Auth;

/*use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\Request;*/

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /*use AuthenticatesUsers;*/

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        // we could return config('ldap_auth...') directly
        // but it seems to change a lot and with this check we make sure
        // that it will fail in future versions, if changed.
        // you can return the config(...) directly if you want.
        $column_name = config('ldap_auth.identifiers.database.username_column', null);
        if ( !$column_name ) {
            die('Error in LoginController::username(): could not find username column.');
        }
        return $column_name;
    }

    protected function ldapLogin(Request $request)
    {
        var_dump($_SERVER['AUTH_USER']);

        // $ldap_host = "BBSY.LOC";
     
        // // Active Directory user for querying
        // $query_user = "l.assadi@".$ldap_host;
        // $password = "Lu1234567!@#";
        // $user =  "l.assadi" ;
        // // Connect to AD
        // $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP");
        // ldap_bind($ldap,$query_user,$password) or die("Could not bind to LDAP");


        // //$dn = "dc=BBSY,dc=LOC"; //very important: in which part of your database are you looking
        // $dn = "OU=Security Groups,OU=Groups,DC=BBSY,DC=LOC"; //very important: in which part of your database are you looking
        // $filter = "CN=*"; //don't filter anyone out (every user has a uid)
        // //$filter="mail=$query_user";
        // $sr = ldap_search($ldap, $dn, $filter) or die ("error"); //define your search scope

        // $results = ldap_get_entries($ldap, $sr); //here we are pulling the actual entries from the search we just defined
        
        //     $output = $results[0]['memberof'];
        //     foreach ($output as $key => $value) {
        //         # code...
        //         echo $key ."=>". $value."<br>";
        //     }
        //     $token = $results[0]['primarygroupid'][0];
        // echo "<hr><br>";
        // foreach ($results as $key => $value) {
        //     # code...
        //     echo $value["cn"][0]; // Group Names
        //     echo "<hr>";
        //     if(isset($value["member"])){
        //         foreach ($value["member"] as $k => $v) {
        //             # code...
        //             $details = explode(",",$v);
        //             /*var_dump($v);
        //             echo "name : ". str_replace('CN=','',$details[0]);
        //             //echo "type : ".$details[1];
        //             if (strpos($v, "Abandoned Accounts") !== false) {
        //                 echo ' Account is Not Active';
        //             }
        //             else
        //                 echo ' Account is Active';   
        //             echo "<br>_<br>";
        //         }
        //     }
        //     echo "<br><hr><br>";
        // }*/

    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $username = $credentials[$this->username()];
        $password = $credentials['password'];

        $user_format = env('LDAP_USER_FORMAT', 'cn=%s,'.env('LDAP_BASE_DN', ''));
        $userdn = sprintf($user_format, $username);

        // you might need this, as reported in
        // [#14](https://github.com/jotaelesalinas/laravel-simple-ldap-auth/issues/14):
        // Adldap::auth()->bind($userdn, $password);

        if(Adldap::auth()->attempt($username, $password, $bindAsUser = true)) {
            // the user exists in the LDAP server, with the provided password

                // Active Directory server
        $ldap_host = "BBSY.LOC";
     
        // Active Directory DN, base path for our querying user
        $ldap_dn = "CN=Users,DC=BBSY,DC=LOC";
     
        // Active Directory user for querying
        $query_user = "l.assadi@".$ldap_host;
        $password = "Lu1234567!@#";
        $user =  "l.assadi" ;
        // Connect to AD
        $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP");
        ldap_bind($ldap,$query_user,$password) or die("Could not bind to LDAP");
     
        // Search AD
        $results = ldap_search($ldap,$ldap_dn,"(samaccountname=$user)",array("memberof","primarygroupid"));
        $entries = ldap_get_entries($ldap, $results);
        
        // No information found, bad user
        if($entries['count'] == 0) echo "FALSE";
        
        // Get groups and primary group token
        $output = $entries[0]['memberof'];
        $token = $entries[0]['primarygroupid'][0];
        
        // Remove extraneous first entry
        array_shift($output);
        
        // We need to look up the primary group, get list of all groups
        $results2 = ldap_search($ldap,$ldap_dn,"(objectcategory=group)",array("distinguishedname","primarygrouptoken"));
        $entries2 = ldap_get_entries($ldap, $results2);
        
        // Remove extraneous first entry
        array_shift($entries2);
        
        // Loop through and find group with a matching primary group token
        foreach($entries2 as $e) {
            if($e['primarygrouptoken'][0] == $token) {
                // Primary group found, add it to output array
                $output[] = $e['distinguishedname'][0];
                // Break loop
                break;
            }
        }
        
        var_dump($output);

            // Single level groups
/*            $groups = $user->getGroups();*/

            //var_dump($groups);

            $user = \App\User::where($this->username(), $username)->first();
/*            if (!$user) {
                // the user doesn't exist in the local database, so we have to create one

                $user = new \App\User();
                $user->username = $username;
                $user->password = '';

                // you can skip this if there are no extra attributes to read from the LDAP server
                // or you can move it below this if(!$user) block if you want to keep the user always
                // in sync with the LDAP server 
                $sync_attrs = $this->retrieveSyncAttributes($username);
                foreach ($sync_attrs as $field => $value) {
                    $user->$field = $value !== null ? $value : '';
                }
                $user->save();
            }*/

            // by logging the user we create the session, so there is no need to login again (in the configured time).
            // pass false as second parameter if you want to force the session to expire when the user closes the browser.
            // have a look at the section 'session lifetime' in `config/session.php` for more options.
            $this->guard()->login($user, true);
            var_dump($userdn);
            echo "string 123";
            //return true;
        }
        else{
            // the user doesn't exist in the LDAP server or the password is wrong
            // log error
            // return false;
            echo " >>> <br>";
            var_dump($userdn);
        }

    }

    protected function retrieveSyncAttributes($username)
    {
        $ldapuser = Adldap::search()->where(env('LDAP_USER_ATTRIBUTE'), '=', $username)->first();
        if ( !$ldapuser ) {
            // log error
            return false;
        }
        // if you want to see the list of available attributes in your specific LDAP server:
        // var_dump($ldapuser->attributes); exit;

        // needed if any attribute is not directly accessible via a method call.
        // attributes in \Adldap\Models\User are protected, so we will need
        // to retrieve them using reflection.
        $ldapuser_attrs = null;

        $attrs = [];

        foreach (config('ldap_auth.sync_attributes') as $local_attr => $ldap_attr) {
            if ( $local_attr == 'username' ) {
                continue;
            }

            $method = 'get' . $ldap_attr;
            if (method_exists($ldapuser, $method)) {
                $attrs[$local_attr] = $ldapuser->$method();
                continue;
            }

            if ($ldapuser_attrs === null) {
                $ldapuser_attrs = self::accessProtected($ldapuser, 'attributes');
            }

            if (!isset($ldapuser_attrs[$ldap_attr])) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            if (!is_array($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
            }

            if (count($ldapuser_attrs[$ldap_attr]) == 0) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            // now it returns the first item, but it could return
            // a comma-separated string or any other thing that suits you better
            $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
            //$attrs[$local_attr] = implode(',', $ldapuser_attrs[$ldap_attr]);
        }

        return $attrs;
    }

    protected static function accessProtected ($obj, $prop)
    {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
