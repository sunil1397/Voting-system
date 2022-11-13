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
    public function stopPoll(Request $request)
    {
        $returnData = [];
        if ($request->ajax()) {
            $updateData = Poll_question::where('id', $request->id)->update(['status' => 0]);
            if($updateData) {
                $returnData = ["status" => 1, "msg" => "Poll Stoped Successfully"];
            }else {
                $returnData = ["status" => 0, "msg" => "Poll Stoped failed! Something is wrong."];
            }
        }
        return response()->json($returnData);
    }
    public function getPollResultAdmin(Request $request)
    {
        $question_id = $request->question_id;
        $physical_address = $request->physical_address;
        $res  = $this->votingCalculation($question_id,$physical_address);
        echo json_encode(array("data"=>$res));
    }
    public function votingCalculation($question_id,$physical_address)
    {
        $anshtml="";

        $total_ans_of_question = User_answer::select(DB::raw('COUNT(*) as answer_total'))->where(['fk_question_id' => $question_id])->get()->toArray();

        $poll_ansTotal_data = Poll_answer::select('*')->where(['fk_question_id' => $question_id])->get()->toArray();

        
        foreach($poll_ansTotal_data as $data){
            
                $sum_of_ans = User_answer::select(array('fk_answer_id', DB::raw('COUNT(*) as total')))->where(['fk_question_id' => $question_id])->where(['fk_answer_id'=>$data['id']])->groupBy('fk_answer_id')->get()->toArray();
                $answerTotal = 0;
                if(sizeof($sum_of_ans) > 0){
                    $answerTotal = $sum_of_ans[0]['total'];
                }

                $votPercent = 0;
                if($total_ans_of_question[0]['answer_total'] > 0)
                $votPercent = ($answerTotal * 100) / $total_ans_of_question[0]['answer_total']; 

                $anshtml.='<div class="d-flex border-bottom border-top py-3">
                                <div class="ps-2">
                                <p class="m-0 text-black">
                                '.$data['answer'].' '.round($votPercent,2).'%
                                </p>
                                </div>
                            </div>';
            }
        return $anshtml;
    }
    
}
