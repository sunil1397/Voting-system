@extends('backend/app')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title"> Create a Poll </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create a Poll</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Poll</h4>
          {{  Form::open( array('url' =>'check-auth', 'id'=>'CreatePoll', 'method'=>'POST', 'class'=>'forms-sample') )  }}
            <div class="form-group">
              <label for="exampleInputName1">Poll Name *</label>
              <input type="text" class="form-control" id="pollName" name="poll_name" placeholder="Name">
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Poll Description</label>
              <textarea class="form-control" name="poll_description" id="pollDescription" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Answer *</label>
              <div id="ans-section">
                <p><input type="text" class="form-control" name="poll_answer[]" placeholder="Answer"></p>
              </div>
              
              <a href="javascript:void(0)" title="Add New Poll Answer" id="addNewPoll" class="btn btn-primary btn-sm m-2"><i class="mdi mdi-plus-box"></i></a>

              
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" name="multiple_answer" value="1" class="form-check-input"> Multiple answer </label>
            </div>
            <div class="form-group">
              <label class="col-sm-3 col-form-label">Poll End</label>
                <input class="form-control" id="pollEndDate" name="poll_end_date" placeholder="dd/mm/yyyy" />
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" name="only_unique" value="1" class="form-check-input"> Only unique </label>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Status</label>
              <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Non Active</option>
              </select>
              
            </div>
            <button type="submit" class="btn btn-gradient-primary me-2">Create a Poll</button>
            <button class="btn btn-light">Cancel</button>
            {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection