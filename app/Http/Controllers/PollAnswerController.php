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

class PollAnswerController extends Controller
{
    public function pollAnswer($id)
    {   
        $question_Id = base64_decode($id);
        $qry = Poll_question::select('*')->where(['id' => $question_Id])->get()->toArray();
        $ans_qry = Poll_answer::select('*')->where(['fk_question_id' => $question_Id])->get()->toArray();
        $votingData = $this->votingCalculation($question_Id);
        return \View::make("frontend/pollAnswer")->with(['poll_question' => $qry , 'ans_qry' => $ans_qry, 'votingData' => $votingData]);
    }
    public function mac_id()
    {
        system('ipconfig/all');
        $mycom=ob_get_contents(); 
        ob_clean(); 
        $findme = "Physical";
        $pmac = strpos($mycom, $findme); 
        $mac=substr($mycom,($pmac+36),17);
        return $mac; 
    }
    public function submitPollAnswer(Request $request)
    {
        $returnData = [];
        if ($request->ajax()) { 
            // DB::enableQueryLog();
            $multiple_checking = $request->is_multiple_checking;
            if ($multiple_checking == 1){
                for($i=0; $i<sizeof($request->answer); $i++){
                    $data = new User_answer;
                    $date =  date('Y-m-d h:i:s');
                    $data->fk_question_id = $request->question_id;
                    $data->fk_answer_id = $request->answer[$i];
                    $data->created_at = $date;
                    $data->updated_at = $date;
                    $data->physical_device_id = $this->mac_id();
                    $saveData= $data->save();
                }
            }else{
                $data = new User_answer;
                $date =  date('Y-m-d h:i:s');
                $data->fk_question_id = $request->question_id;
                $data->fk_answer_id = $request->answer;
                $data->created_at = $date;
                $data->updated_at = $date;
                $data->physical_device_id = $this->mac_id();
                $saveData= $data->save();
            }
            
            // $query = DB::getQueryLog();
            // dd($query);
            if($saveData) {
               $total_ans =  $this->votingCalculation($request->question_id);
                $returnData = ["status" => 1, "msg" => "Save successful.", "data" => $total_ans];
            }else {
                $returnData = ["status" => 0, "msg" => "Save failed! Something is wrong."];
            } 
        }
        return response()->json($returnData);
    }

    public function votingCalculation($question_id)
    {
        $anshtml="";
        $total_ans = User_answer::select(DB::raw('COUNT(*) as total_answer'))->where(['fk_question_id' => $question_id])->get()->toArray();
        if($total_ans[0]['total_answer'] > 0){
            $poll_ansTotal_data = Poll_answer::select('*')->where(['fk_question_id' => $question_id])->get()->toArray();

        
        foreach($poll_ansTotal_data as $data){
            
                $sum_of_ans = User_answer::select(array('fk_answer_id', DB::raw('COUNT(*) as total')))->where(['fk_question_id' => $question_id,'fk_answer_id'=>$data['id']])->groupBy('fk_answer_id')->get()->toArray();
                $answerTotal = 0;
                if(sizeof($sum_of_ans) > 0){
                    $answerTotal = $sum_of_ans[0]['total'];
                }

                $votPercent = ($answerTotal * 100) / $total_ans[0]['total_answer']; 
                $anshtml.='<div class="d-flex border-bottom border-top py-3">
                                <div class="ps-2">
                                <p class="m-0 text-black">
                                '.$data['answer'].' '.$votPercent.'%
                                </p>
                                </div>
                            </div>';
            }
        }
        return $anshtml;
    }
}
