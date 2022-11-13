@extends('frontend/app')
@section('content')
<div class="container page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper pb-0">
        <!-- table row starts here -->
        <div class="row">
            <!-- <div class="col-xl-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body pb-0">
                <h4 class="card-title">Poll Answer</h4>
                </div>
                <div class="card-body pb-0">

                </div>
            </div>
            </div> -->
            <div class="col-sm-12 col-xl-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    @if(($poll_question[0]['closing_date'] != NULL))
                    
                    <?php
                        //$time_diff =  - date('Y-m-d H:i:s');
                        //echo date('H:i:s', $time_diff);
                        $datetime_1 = date('Y-m-d H:i:s'); 
                        $datetime_2 = $poll_question[0]['closing_date']; 
                        
                        $start_datetime = new DateTime($datetime_1); 
                        $diff = $start_datetime->diff(new DateTime($datetime_2)); 
                        $total_minutes = ($diff->days * 24 * 60); 
                        $total_minutes += ($diff->h * 60); 
                        $total_minutes += $diff->i;
                    ?>
                    <div style="float:right;">Voting close on <span id="time" data-minute="{{$total_minutes*60}}"></span></div>
                    @endif
                    {{  Form::open( array('url' =>'', 'id'=>'UserAnswer', 'method'=>'POST', 'class'=>'forms-sample') )  }}

                    @foreach($poll_question as $data)

                        <div class="card-title mb-2"> {{$data['poll_question']}} </div>

                        <p class="mb-3">{{$data['description']}}</p>

                        <input type="hidden" name="question_id" value="{{$data['id']}}" id="question_id" />

                        <input type="hidden" name="is_multiple_checking" value="{{$poll_question[0]['multiple_checking']}}" />
                        <input type="hidden" name="physical_address" id="physical_address"  />
                    @endforeach
                    
                    <div id="VotingPercent">
                    @if(empty($votingData))
                        @foreach($ans_qry as $value)
                        <div class="d-flex border-bottom border-top py-3">
                        <div class="ps-2">
                            <p class="m-0 text-black">
                                @if($poll_question[0]['multiple_checking']==1)
                                    <input type="checkbox" name="answer[]" value="{{$value['id']}}" /> {{$value['answer']}}
                                @else
                                    <input type="radio" name="answer" value="{{$value['id']}}" /> {{$value['answer']}}
                                @endif
                            </p>
                        </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary m-2">Submit</button>
                        @else
                        <?php echo $votingData ?>
                    @endif
                    </div>
                    {{ Form::close() }}
                    
                  </div>
                </div>
              </div>
        </div>
        <!-- doughnut chart row starts -->
        <!-- last row starts here -->
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('frontend/common/footer')
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
@endsection
@section('script')
<script>
var upgradeTime = $("#time").attr("data-minute");
var seconds = upgradeTime;
function timer() {
  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('time').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  if (seconds == 0) {
    clearInterval(countdownTimer);
    document.getElementById('time').innerHTML = "Completed";
    window.location.href = APP_URL;
  } else {
    seconds--;
  }
}
@if(($poll_question[0]['closing_date'] != NULL))
    var countdownTimer = setInterval('timer()', 1000);
@endif

</script>
@endsection