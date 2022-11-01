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

class PollController extends Controller
{
    public function addPoll()
    {
        return \View::make("backend/add_poll")->with(array());
    }
}
