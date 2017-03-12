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


    public function getUserList()
    {

        $authUser = Auth::user()->id;

        $centerId = $this->getCenterIdByUser($authUser);

        $users = User::join("user_centre","user_centre.idUser","=","users.id")
            ->join("centre","centre.id","=","user_centre.idCentre")
            ->join("userroles","userroles.user_id","=","users.id")
            ->join("roles","roles.id","=","userroles.role_id")
            ->where("user_centre.idCentre", $centerId)
            ->paginate(1);




        $users = DB::table("user")->paginate(8);

        return view("auth.users" ,compact('users'));

    }

    public function removeUser($userId){

        return response()->json(["status"=>true,"response"=>$userId]);

    }
}
