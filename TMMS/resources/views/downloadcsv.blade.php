@extends('app')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading"><b>Download Participant Data</b></div>
  <div class="panel-body">
    <form action="uploadCSV" method="post" enctype="multipart/form-data" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      I am downloading participant information from: //TODO: QUERY YEAR DATA FROM DB <br>
      <div class="col-md-4">
        <form>
          <select class="form-control" name="year_csv" >
                            <option id="2015">2015</option>
                            <option id="2016">2016</option>
                            <option id="2017">2017</option>
                        </select>
		</form><br>
        <span class="input-group-btn">
          <span class="btn btn-primary btn-file">
            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> 
            Download File 


 <!-- Test download button -->
 {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('downloadCSV') }}">--}}
 {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
 {{--<li></li> <a href={{url('downloadcsv')}}>Test.pdf</a></li>--}}
 {{--</form>--}}

 <form class="form-horizontal" role="form" method="GET" action="{{ url('downloadCSV') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {{--<input type="file" name="Download Destination" id="fileToDownload">--}}
  <input type="submit" value="Download CSV" name="Submit">
</form>
{{--                        <li></li> <a href={{url('download')}}>Test.pdf</a></li>--}}

          </span>
        </span>
      </div>
    </form>
  </div>
</div>














@endsection