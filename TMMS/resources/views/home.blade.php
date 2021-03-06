@extends('app')

@section('content')

<style type="text/css">
.col-xs-6 {
  word-break: keep-all;
}
.row{
  margin-right: 15px;
}
.jumbotron {
  margin-right: 15px;
  background-color: #002859;
  color:#FFF;
}
</style>

<div class="jumbotron">
        <h1>Welcome to TMMS</h1><br>
        <h3>Tri-Mentoring Matching System </h3>

        <p></p>
</div>

<div class="row">
  <a href="currentmatch">
   <div class="col-xs-6 col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div><h3>View Current Matching</h3></div><br>
        <p>View the currently selected matching</p>
        <div class="panel-heading"></div>
      </div>
    </div>
  </div>
</a>

<a href="weight">
<div class="col-xs-6 col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div><h3>Match Making</h3></div><br>
      <p>Create a new matching</p>
      <div class="panel-heading"></div>
    </div>
  </div>
</div>
</a>

<a href="kickoffmatches">
<div class="col-xs-6 col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div><h3>Kickoff Matching</h3></div><br>
      <p>View the current kickoff night matching</p>
      <div class="panel-heading"></div>
    </div>
  </div>
</div>
</a>
</div>
@endsection