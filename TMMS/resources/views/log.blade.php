@extends('app')


@section('content')




    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experimenting on view log</div>
                <br>

                <strong>Select number of log records to retrieve</strong>
                <i>Retrieves 10 by default, enter 0 to retrieve all</i>
                <strong>:</strong>
                <br>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/log') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="numRetrieve">
                        {{--<input type="text" class="form-control" placeholder="Enter 0 to retrieve all" name="numRetrieve" method="POST"/>--}}
                        <input type="submit" value="Retrieve Log Records" name="Submit">
                    </form>
                    {{--<li> <a href={{url('download')}}>Test.pdf</a></li>--}}

            </div>
            <?php



            echo "<br><br>";
            if (isset($result)) {
                foreach($result as $single_result) {
                    print("<strong>LogID:</strong> " . $single_result['logID'] . " <strong>Admin Name:</strong> " . $single_result['name'] . " <strong>Admin E-Mail:</strong> " . $single_result['email']);
                    echo "<br>";
                    print("<strong>Action:</strong> " . $single_result['Action']);
                    echo "<br><br>";
                }
            }

            ?>
            <div class="panel-body">
            </div>

        </div>
    </div>
    </div>


@endsection
