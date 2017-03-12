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

    public function userDetailsQuery()
    {

        $authUser = Auth::user()->id;
        $centerId = $this->getCenterIdByUser($authUser);
        return User::join("user_centre", "user_centre.idUser", "=", "users.id")
            ->join("centre", "centre.id", "=", "user_centre.idCentre")
            ->join("userroles", "userroles.user_id", "=", "users.id")
            ->join("roles", "roles.id", "=", "userroles.role_id")
            ->where("user_centre.idCentre", $centerId);

    }

    public function getUserList()
    {

        $users = $this->userDetailsQuery()->paginate(10);
        $roles = DB::table("roles")->get();
        $centres = DB::table("centre")->get();

        return view("auth.users", compact('users', 'roles', 'centres'));

    }


    public function editUser(Request $request)
    {


        $user = $request->get("user");

        $userId = $user["userId"];
        $firstName = $user["firstName"];
        $lastName = $user["lastName"];
        $userName = $user["userName"];
        $centerId = $user["userCenter"];
        $roleId = $user["userRole"];


        $arrayEditUser = array("first_name" => $firstName, "last_name" => $lastName, "username" => $userName);

        $isUserSaved = DB::table("users")->where('id', '=', $userId)->update($arrayEditUser);

        $isRoleUserSaved = DB::table("userroles")->where('user_id', '=', $userId)->update(array('role_id' => $roleId));

        $isCenterUserSaved = DB::table("user_centre")->where('idUser', '=', $userId)->update(array('idCentre' => $centerId));

        $status = $isUserSaved && $isRoleUserSaved && $isCenterUserSaved ? true : false;


        return response()->json(["status" => $status,
            "response" => $user,
            "savedUser" => $isUserSaved,
            "savedCenter" => $isCenterUserSaved,
            "savedRole" => $isCenterUserSaved]);


    }


    public function removeUser($userId)
    {

        return response()->json(["status" => true, "response" => $userId]);

    }


    public function getUserById($userId)
    {

        $user = $this->userDetailsQuery()->where("users.id", $userId)->first();

        $status = $user ? true : false;

        return response()->json(["status" => $status, "response" => $user]);

    }
}
