<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use File;
use App\User;
use App\Gallery;
use Session;
use DB;
use Mail;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return \View::make("backend/dashboard")->with([]);
    }
    public function adminLogout()
    {
        Session::flush();
        return redirect('/admin-login');
    }
}
