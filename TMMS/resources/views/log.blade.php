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
        print_r($single_result);
        echo "<br>";
    }

    ?>

@endsection
