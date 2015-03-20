@extends('app')

@section('guestcontent')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        Welcome to mentor application form!


Welcome <?php echo $_POST["email"]; ?><br>


                    </div>
                </div>
            </div>
        </div>

@endsection
