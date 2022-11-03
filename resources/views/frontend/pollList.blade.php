@extends('frontend/app')
@section('content')
<div class="container page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <!-- table row starts here -->
            <div class="row">
              <div class="col-xl-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body pb-0">
                    <h4 class="card-title">Voting Poll</h4>
                  </div>
                  <div class="card-body pb-0">
                    <div class="table-responsive">
                      <table class="table custom-table text-dark" id="PollList-user">
                        <thead>
                          <tr>
                            <th> Poll </th>
                            <th> Genarate Date </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($question_data as $data)
                          <tr>
                            <td> {{$data['poll_question']}} </td>
                            <td> {{$data['created_on']}} </td>
                            <td> <a href="{{URL('poll-answer')}}/{{base64_encode($data['id'])}}" class="btn btn-success btn-sm"><i class="mdi mdi mdi-eye"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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