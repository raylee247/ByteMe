@extends('app')


@section('content')




    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experimenting on view log</div>
                <div class="panel-body">
                </div>

            </div>
        </div>
    </div>
    <?php


    foreach($result as $single_result) {
        print("<strong>LogID:</strong> " . $single_result['logID'] . " <strong>Admin Name:</strong> " . $single_result['name'] . " <strong>Admin E-Mail:</strong> " . $single_result['email']);
        echo "<br>";
        print("<strong>Action:</strong> " . $single_result['Action']);
        echo "<br><br>";
    }

    ?>

@endsection
