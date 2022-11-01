<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use File;
use App\Models\User;
use App\Gallery;
use Session;
use DB;
use Mail;

class AdminLoginController extends Controller
{
    public function adminLogin()
    {
        
        return \View::make("backend/login")->with(array());
        
    }
    public function checkAuth(Request $request)
    {
        $returnData = [];
        $select_user = User::where([['email', '=', $request->email], ['password', '=', $request->password]])->get();
        if(count($select_user) > 0){
            Session::put('user_id', $select_user[0]->id);
            $returnData = ["status" => 1];
        }else{
            $returnData = ["status" => 0, "msg" => "Sorry... you have wrong authantication"];
        }
        return response()->json($returnData);
                
    }
}
