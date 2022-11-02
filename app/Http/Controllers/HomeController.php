<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use File;
use App\Models\User;
use App\Models\Poll_question;
use App\Models\Poll_answer;
use App\Gallery;
use Session;
use DB;
use Mail;

class HomeController extends Controller
{
    public function home()
    {
        $qry = Poll_question::select('*')->where([])->orderBy('id', 'desc')->get()->toArray();
        return \View::make("frontend/pollList")->with([ 'question_data' => $qry ]);
    }
}
