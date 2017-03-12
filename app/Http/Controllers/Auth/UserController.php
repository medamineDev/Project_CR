<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{


    public function getCenterIdByUser($userId)
    {


        $center = DB::table("user_centre")->where("idUser", $userId)->first();
        return $center ? $center->idCentre : 0;
    }

public function userDetailsQuery(){

    $authUser = Auth::user()->id;
    $centerId = $this->getCenterIdByUser($authUser);
    return  User::join("user_centre","user_centre.idUser","=","users.id")
        ->join("centre","centre.id","=","user_centre.idCentre")
        ->join("userroles","userroles.user_id","=","users.id")
        ->join("roles","roles.id","=","userroles.role_id")
        ->where("user_centre.idCentre", $centerId);

}

    public function getUserList()
    {

        $users = $this->userDetailsQuery()->paginate(1);
        $roles = DB::table("roles")->get();
        $centres = DB::table("centre")->get();

        //$users = DB::table("user")->paginate(8);

        return view("auth.users" ,compact('users','roles','centres'));

    }

    
    
    
    public function editUser(Request $request){


        $user = $request->get("user");
        return response()->json(["status"=>true,"response"=>$user]);

        $userId = $request->get("user_id");
        $firstName = $request->get("first_name");
        $lastName = $request->get("first_name");
        $centerId = $request->get("center_id");
        $roleId = $request->get("role_id");

        
        return response()->json(["status"=>true,"response"=>$userId]);

    } 
    
    
    public function removeUser($userId){

        return response()->json(["status"=>true,"response"=>$userId]);

    }


    public function getUserById($userId){

       // $user = DB::table("user")->find($userId);
        $user = $this->userDetailsQuery()->where("users.id",$userId)->first();

        if($user){
            $status = true;
        }else{
            $status = true;
        }
        return response()->json(["status"=>$status,"response"=>$user]);

    }
}
