<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Adldap\Laravel\Facades\Adldap;

use App\Models\User;
use App\Models\BankDepartment;
use App\Models\Permission;
use App\Models\Role;

class UserLDAPController extends Controller
{
    protected function syncDBFromLDAP(Request $request)
    {
        $ldap_host = "BBSY.LOC";
     
        // Active Directory user for querying
        $query_user = "l.assadi@".$ldap_host;
        $password = "Lu12345678!@#";
        $user =  "l.assadi" ;
        // Connect to AD
        $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP");
        ldap_bind($ldap,$query_user,$password) or die("Could not bind to LDAP");


        //$dn = "dc=BBSY,dc=LOC"; //very important: in which part of your database are you looking
        $dn = "OU=Security Groups,OU=Groups,dc=bbsy,dc=loc";//"OU=Security Groups,OU=Groups,DC=BBSY,DC=LOC"; //very important: in which part of your database are you looking
        $filter = "(*)"; //don't filter anyone out (every user has a uid)
        //$filter="mail=$query_user";
        $sr = ldap_search($ldap, $dn, $filter,array("memberof","primarygroupid","cn", "mail")) or die ("error"); //define your search scope

        $results = ldap_get_entries($ldap, $sr); //here we are pulling the actual entries from the search we just defined
        
            /*$output = $results[0]['memberof'];
            foreach ($output as $key => $value) {
                # code...
                echo $key ."=>". $value."<br>";
            }
            $token = $results[0]['primarygroupid'][0];
        echo "<hr><br>";*/
        foreach ($results as $key => $value) {
            # code...
            $Bank_dep = new BankDepartment();
            if($value["cn"][0] != null)
                $Bank_dep->department_name     = $value["cn"][0] ;
            else
                $Bank_dep->department_name     = '' ;
            $Bank_dep->department_description    = '';
            $Bank_dep->save();
            if($value["cn"][0] != null)
                $Bank_dep_name     = $value["cn"][0] ;
            else
                $Bank_dep_name     = '' ;
            $DEPID = BankDepartment::where(['department_name'=>$Bank_dep_name])->first();
            if(!isset($DEPID) || $DEPID->count() == 0){
                $Bank_dep = new BankDepartment();
                if($value["cn"][0] != null)
                    $Bank_dep->department_name     = $value["cn"][0] ;
                else
                    $Bank_dep->department_name     = '' ;
                $Bank_dep->department_description    = '';
                $Bank_dep->save();
            }

            if(isset($value["member"])){
                foreach ($value["member"] as $k => $v) {
                    # code...
                    $details = explode(",",$v);
                    $user = User::where(['name'=>str_replace('CN=','',$details[0])])->first();
                    if(isset($user)){
                        $user->bank_department()->attach([$DEPID->id]);
                    }
                    else{
                        $user = new User();
                    
                        $user->name         = str_replace('CN=','',$details[0]);
                        $user->password = '';
                        //echo "type : ".$details[1];
                        if (strpos($v, "Abandoned Accounts") !== false) {
                            $user->is_active = false;
                        }
                        else
                            $user->is_active = true;
                        $user->save();
                        $user->bank_department()->attach([$DEPID->id]);
                    }
                }
            }
            else{
/*            echo "<br><hr>Start<hr><br>";
            var_dump($value);
            echo "<br><hr>End<hr><br>";*/
            }
        }
    }

    protected function syncRolePermisisons(Request $request)
    {
        $permission_ids = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route)
        {
         // get route action
         $action = $route->getActionname();// separating controller and method
         $_action = explode('@',$action);
         
         $controller = $_action[0];
         $method = end($_action);
         
         // check if this permission is already exists
         $permission_check = Permission::where(
                 ['controller'=>$controller,'method'=>$method]
             )->first();
         if(!$permission_check){
           $permission = new Permission;
           $permission->controller = $controller;
           $permission->method = $method;
           $permission->save();
           // add stored permission id in array
           $permission_ids[] = $permission->id;
         }
        }// find admin role.
        $admin_role = Role::where('name','admin')->first();// atache all permissions to admin role
        $admin_role->permissions()->attach($permission_ids);
    }

    protected function addByMe(Request $request)
    {
        /*$ds = ldap_connect("BBSY.LOC");  // assuming the LDAP server is on this host
        if ($ds) {
            $query_user = "l.assadi@BBSY.LOC";
            $password = "!@#";
            // bind with appropriate dn to give update access
            $r = ldap_bind($ds, $query_user,$password);

            $dn = "OU=Security Groups,OU=Groups,DC=BBSY,DC=LOC";
            // prepare data
            $info["cn"] = "luay test";
            $info["sn"] = "luaytest";
            $info["objectclass"] = "person";

            // add data to directory
            //OU=IT,OU=Security Groups,OU=Groups,
            $r = ldap_add($ds, "cn=luay test,DC=BBSY,DC=LOC", $info);

            ldap_close($ds);
        } else {
            echo "Unable to connect to LDAP server";
        }*/
        require('vendor/autoload.php'); //Use composer autoload

        $ad = new ActiveDirectory\ActiveDirectory();

        //Load AD server settings from ini file
        $ad->loadConfig('config.ini');

        //Identify user. Uses Apache authentication (mod_auth_kerb) as primary authentication method but has http auth as fallback method.
        $login = $ad->identify();

        //Get dname for user $login
        $dname = $ad->getDname($login);

        //Get user information
        $userInfo = $ad->getInfo($dname);

        //Check if user is member of an AD group (recursive search)
        if($ad->isMemberOf($dname, "Test Group", true)) {
            $isMember = true;
        }
        else {
            $isMember = false;
        }
    }

    public function insertUsersAndDepartment() {
        $user =  "test" ;

        // Active Directory server
        $ldap_host = "BBSY.LOC";
     
        // Active Directory DN, base path for our querying user
        $ldap_dn = "OU=AlBaraka Bank Syria,dc=bbsy,dc=loc";
     
        // Active Directory user for querying
        $query_user = "t.adis@".$ldap_host;
        $password = "Ta123456";
     
        // Connect to AD
        $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP");
        ldap_bind($ldap,$query_user,$password) or die("Could not bind to LDAP");
        
        $pageSize = 1000;

        $cookie = '';

            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_control_paged_result($ldap, $pageSize, false, $cookie);
            // Search AD samaccountname=*
            $results = ldap_search($ldap,$ldap_dn,"(samaccountname=*)",array("memberof","primarygroupid","cn", "mail"));

            $entries = ldap_get_entries($ldap, $results);
            
            // No information found, bad user
            if($entries['count'] == 0) return false;
            
            array_shift($entries);
            foreach ($entries as $key => $value) {
                // Get groups and primary group token
                if(isset($entries[$key]) && isset($entries[$key]['memberof']) && isset($entries[$key]['mail'])){
                    $DEPID = array();
                    foreach ($entries[$key]['memberof'] as $groupK => $groupV) {
                        # code...
                        if($groupK != 'count'){
                            $groupString = explode(",",$entries[$key]['memberof'][$groupK])[0];
                            $groupName   = $this->clean(explode("=",$groupString)[1]);
                            echo $groupName."<br>";

                            $record = BankDepartment::where(['department_name'=>$groupName])->first();
                            if($record == null){

                            //Insert BankDep to DB
                                $Bank_dep = new BankDepartment();
                                $Bank_dep->department_name           = $groupName ;
                                $Bank_dep->department_description    = '';
                                $Bank_dep->save();
                                
                                $DEPID[] = $Bank_dep->id;
                            }
                            else{
                                $DEPID[] = $record->id;
                            }
                        }
                    };
                    /*var_dump($entries[$key]);*/
                    $email = strtolower($entries[$key]['mail'][0]);
                    $userR = User::where(['email'=>$email])->first();
                    if($userR == null){
                        $user           = new User();
                        $user->name     = $entries[$key]['cn'][0];
                        $user->password = '';
                        $user->email    = $email;
                        $user->is_active = true;
                        $user->save();

                        if(sizeof($DEPID) > 0){
                            $user->bank_department()->attach($DEPID);
                        }
                    }
                    else{
                        if(sizeof($DEPID) > 0){
                            //$userR->bank_department()->detach();
                            $userR->bank_department()->sync($DEPID);
                        }
                    }
                }
            }
    }

    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
