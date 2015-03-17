@extends('app')

@section('content')



<div class="container">

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

</div>


@endsection