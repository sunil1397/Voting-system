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

class AdminVottingController extends Controller
{
    public function pollDetails($id)
    {
        $question_Id = $id;
        $qry = Poll_question::select('*')->where(['id' => $question_Id])->get()->toArray();
        $ans_qry = Poll_answer::select('*')->where(['fk_question_id' => $question_Id])->get()->toArray();
        
        return \View::make("backend/votting_details")->with(['poll_question' => $qry ,'ans_qry' => $ans_qry]);
    }
    
    public function pollResult(Request $request){

        $question_id = $request->question_id;
        $physical_address = $request->physical_address;
        $res  = $this->votingCalculation($question_id,$physical_address);
        echo json_encode(array("data"=>$res));
    }

    public function votingCalculation($question_id,$physical_address)
    {
        $anshtml="";
        $check_ans = User_answer::select(DB::raw('COUNT(*) as total_answer'))->where(['fk_question_id' => $question_id])->where(['physical_device_id' => $physical_address])->get()->toArray();

        $total_ans_of_question = User_answer::select(DB::raw('COUNT(*) as answer_total'))->where(['fk_question_id' => $question_id])->get()->toArray();

        if($check_ans[0]['total_answer'] > 0){
            $poll_ansTotal_data = Poll_answer::select('*')->where(['fk_question_id' => $question_id])->get()->toArray();

        
        foreach($poll_ansTotal_data as $data){
            
                $sum_of_ans = User_answer::select(array('fk_answer_id', DB::raw('COUNT(*) as total')))->where(['fk_question_id' => $question_id])->where(['fk_answer_id'=>$data['id']])->groupBy('fk_answer_id')->get()->toArray();
                $answerTotal = 0;
                if(sizeof($sum_of_ans) > 0){
                    $answerTotal = $sum_of_ans[0]['total'];
                }

                $votPercent = ($answerTotal * 100) / $total_ans_of_question[0]['answer_total']; 

                $anshtml.='<div class="d-flex border-bottom border-top py-3">
                                <div class="ps-2">
                                <p class="m-0 text-black">
                                '.$data['answer'].' '.round($votPercent,2).'%
                                </p>
                                </div>
                            </div>';
            }
        }
        return $anshtml;
    }
}
