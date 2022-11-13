@extends('backend/app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Basic Tables </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Bordered table</h4>
                    <p class="card-description"> Add class <code>.table-bordered</code>
                    </p>
                    <table class="table table-hover table-bordered" id="PollList">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Question </th>
                          <th> Description </th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($question_data as $data)
                        <tr>
                          <td> {{$data['id']}} </td>
                          <td> {{$data['poll_question']}} </td>
                          <td> {{$data['description']}} </td>
                          <td>
                            <!-- <button class=""><i class="mdi mdi-close-circle"></i></button> -->
                          <input name="_token" type="hidden" value="{{ csrf_token() }}">
                          @if($data['status']==1)
                          <a href="javascript:void(0)" class="stop-question btn btn-danger btn-sm" data-id="{{$data['id']}}" data-status="2" title="Stop Question"><i class="mdi mdi-close-circle"></i></a>
                          @endif

                          <a class="btn btn-success btn-sm" href="{{URL('poll-details')}}/{{$data['id']}}"><i class="mdi mdi mdi-eye"></i></a>
                        </td>
                          <!-- <td></td> -->
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('contentPollList')
<script src="{{ URL::asset('public/assets/backend/js/poll.js')}}"></script> 
@endsection