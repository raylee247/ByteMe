@extends('app')

@section('content')

    <!-- Test download button -->
    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('downloadCSV') }}">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<li></li> <a href={{url('downloadcsv')}}>Test.pdf</a></li>--}}
    {{--</form>--}}

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experimenting on download user emails</div>
                <div class="panel-body">
                </div>

            </div>
        </div>
    </div>


    {{--                        <li></li> <a href={{url('download')}}>Test.pdf</a></li>--}}


    <form class="form-horizontal" role="form" method="GET" action="{{ url('downloademails') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--<input type="file" name="Download Destination" id="fileToDownload">--}}
        <input type="submit" value="Download Emails" name="Submit">
    </form>

    <?php

    foreach($result as $single_result) {
        print("<strong>Name:</strong> " . $single_result['name'] . " <strong>E-Mail:</strong> " . $single_result['email']);
        echo "<br>";
    }

    ?>



@endsection