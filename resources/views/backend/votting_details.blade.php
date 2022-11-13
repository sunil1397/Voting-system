@extends('backend/app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Votting Details </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Votting</a></li>
          <li class="breadcrumb-item active" aria-current="page">Votting Percent</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <input type="hidden" name="physical_address" id="physical_address"  />
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
              @foreach($poll_question as $data)
                <p class="card-title mb-2"> {{$data['poll_question']}}</p>
                <p class="mb-3">{{$data['description']}}</p>
                <input type="hidden" name="question_id" value="{{$data['id']}}" id="question_id" />
              @endforeach
              <div id="votingDetails">
              @if(empty($votingData))
              @foreach($ans_qry as $value)
              <div class="d-flex border-bottom border-top py-3">
                    <div class="ps-2">
                    <p class="m-0 text-black">
                    <?php echo $value['answer'] .'  '.'0%' ?>
                    </p>
                    </div>
                </div>
                @endforeach
              @else
                <?php echo $votingData; ?>
              @endif  
              </div>            
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('contentVotingDetails')
<script src="{{ URL::asset('public/assets/backend/js/votingDetails.js')}}"></script> 
@endsection