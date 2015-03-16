@extends('app')

@section('content')
<div class="container">
  <div id="sidebar">
    <ul>
      <li><a href="#">Participant Management</a>
        <ul>
          <li><a href="#">Students</a></li>
          <li><a href="#">Mentors</a></li>
          <li><a href="{{url('uploadcsv') }}">Add Participant(s)</a></li>
          <li><a href="{{url('downloadcsv') }}">Export Participant(s)</a></li>
          <li><a href="#">Waitlist</a></li>
        </ul></li>
        <li><a href="#">Match Making</a>
          <ul>
            <li><a href="#">Current Selection</a></li>
            <li><a href="#">Adjust Weighting</a></li>
            <li><a href="#">Saved Matches</a></li>
          </ul></li>
          <li><a href="#">Application Form</a>
            <ul>
              <li><a href="#">Student Form</a></li>
              <li><a href="#">Mentor Form</a></li>
            </ul></li>

          </ul>
        </div>

        <div class="main-content">
          <div class="swipe-area"></div>
          <a href="#" data-toggle=".container" id="sidebar-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </a>
      

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


<!--  move to upload and dl csv -->

<div class="container">

 <!-- Test download button -->
 {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('downloadcsv') }}">--}}
 {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
 {{--<li></li> <a href={{url('downloadcsv')}}>Test.pdf</a></li>--}}
 {{--</form>--}}

 <form class="form-horizontal" role="form" method="GET" action="{{ url('downloadcsv') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {{--<input type="file" name="Download Destination" id="fileToDownload">--}}
  <input type="submit" value="Download CSV" name="Submit">
</form>
{{--                        <li></li> <a href={{url('download')}}>Test.pdf</a></li>--}}



<!--body>
 <form action="uploadCSV" method="post" enctype="multipart/form-data" >
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload CSV File" name="submit">
</form>

@if (count($preview_header))
<table id = "preview">
  <tr>
    @foreach ($preview_header as $header)
    <th> {{$header}} </th>
    @endforeach
  </tr>
  @foreach($preview_data as $participant)
  <tr>
    @foreach($participant as $data)
    <td> {{$data}} </td>
    @endforeach
  </tr>  
  @endforeach 
</table>
@endif
</body>

</div>

      
        </div>
      </div>






@endsection


