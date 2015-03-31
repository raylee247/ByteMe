@extends('app')

@section('content')

<div class="jumbotron">
  <h1>Welcome to TMMS</h1><br>
  <h3>Tri-Mentoring Matching System</h3>
  <p></p>
</div>

<div class="row">
  <a href="#">
   <div class="col-xs-6 col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div><h3>Participant Management</h3></div><br>
        <p>View, manage and organize participant information, upload and download participant data</p>
        <div class="panel-heading"></div>
      </div>
    </div>
  </div>
</a>

<a href="#">
<div class="col-xs-6 col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div><h3>Match Making</h3></div><br>
      <p>Adjust parameters to generate optimal match results, view and compare generated results</p>
      <div class="panel-heading"></div>
    </div>
  </div>
</div>
</a>

<a href="#">
<div class="col-xs-6 col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div><h3>Application Form</h3></div><br>
      <p>View, manage, and customize current and previous application forms for students and mentors</p>
      <div class="panel-heading"></div>
    </div>
  </div>
</div>
</a>
</div>

<style type="text/css">
.col-xs-6 {
  word-break: break-all;
  word-wrap: break-word;
}

.row{
  margin-right: 15px;
}

.jumbotron {
  margin-right: 15px;
  background-color: #99A2A2;
  color:#FFF;
}

</style>

@endsection