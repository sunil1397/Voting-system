<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use File;
use App\Models\User;
use App\Models\Poll_question;
use App\Models\Poll_answer;
use App\Models\User_answer;
use App\Gallery;
use Session;
use DB;
use Hamcrest\Arrays\IsArray;
use Mail;

class VoterController extends Controller
{
    public function VoterList()
    {
        echo "Hello World!";
    }
}
