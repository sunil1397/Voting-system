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

class PollController extends Controller
{
    public function addPoll()
    {
        return \View::make("backend/add_poll")->with(array());
    }
    public function savePoll(Request $request)
    {
        $returnData = [];
        if ($request->ajax()) {
            $date =  date('Y-m-d h:i:s',strtotime($request->poll_end_date));

            $data = new Poll_question;
            $data->poll_question = $request->poll_name;
            $data->description = $request->poll_description;
            if($request->multiple_answer){
                $data->multiple_checking = $request->multiple_answer;
            }else{
                $data->multiple_checking = 0;
            }
            if($request->only_unique){
                $data->unique_checking = $request->only_unique;
            }else{
                $data->unique_checking = 0;
            }
            $data->closing_date = $date;
            $data->created_on = date("Y-m-d H:i:s");
            $data->status = $request->status;
            $saveData= $data->save();
            
            $question_id = $data->id;
            for($i=0;$i<sizeof($request->poll_answer);$i++){
                $ans_data = new Poll_answer;
                $ans_data->answer = $request->poll_answer[$i];
                $ans_data->fk_question_id = $question_id;
                $saveData= $ans_data->save();
            }
            if($saveData) {
                $returnData = ["status" => 1, "msg" => "Save successful."];
            }else {
                $returnData = ["status" => 0, "msg" => "Save failed! Something is wrong."];
            } 
        }
        return response()->json($returnData);
    }
    public function listPoll()
    {
        $qry = Poll_question::select('*')->where([])->get()->toArray();
        return \View::make("backend/poll_list")->with([ 'question_data' => $qry ]);
    }
    
}
