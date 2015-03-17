@extends('app')

@section('content')

<div class="row">
  <div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
      <div class="list-group">
        <a href="#" class="list-group-item text-center">
          <h3 class="glyphicon glyphicon-user"><br><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span></h3><br/>Participant Management
        </a>
        <a href="#" class="list-group-item text-center">
          <h2 class="glyphicon glyphicon-road"></h2><br/>Match Making
        </a>
        <a href="#" class="list-group-item text-center">
          <h2 class="glyphicon glyphicon-pencil"><span class="glyphicon glyphicon-file"></span></h2><br/>Application Form
        </a>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
      <!-- Participant Management -->        
      <div class="bhoechie-tab-content active">
        <center>
          <h1 class="glyphicon glyphicon-user" style="font-size:14em;color:#55518a"></h1>
          <h2 style="margin-top: 0;color:#55518a">Coming Soon</h2>
          <h3 style="margin-top: 0;color:#55518a">Participant Management</h3>
        </center>
      </div>
      <!-- Run Match Making -->
      <div class="bhoechie-tab-content">
        <center>
          <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#55518a"></h1>
          <h2 style="margin-top: 0;color:#55518a">Coming Soon</h2>
          <h3 style="margin-top: 0;color:#55518a">Match Making</h3>
        </center>
      </div>
      <!-- Application Form -->
      <div class="bhoechie-tab-content">
        <center>
          <h1 class="glyphicon glyphicon-pencil" style="font-size:12em;color:#55518a"><span class="glyphicon glyphicon-file"></span></h1>
          <h2 style="margin-top: 0;color:#55518a">Coming Soon</h2>
          <h3 style="margin-top: 0;color:#55518a">Application Form</h3>
        </center>
      </div>
    </div>
  </div>
</div>

@endsection