@extends('app')


@section('content')


    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Experimenting with DB queries</div>
                    <div class="panel-body">
                    </div>

                </div>
            </div>
        </div>
        <?php
        $results = DB::table('users')->select('name as user_name')->addSelect('email as user_email')->get();
            
        foreach($results as $single_result) {
            print($single_result["user_name"]);
            echo "\r\n";
        }

        ?>
    </div>
@endsection
