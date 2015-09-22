@extends('app')

@section('content')
    <style type="text/css">
        .main {
            overflow-x: scroll;
        }
        .content{
            display: table;
            width:100%;
        }
        .table {
            white-space:normal;
            word-wrap: break-word;
            width:100%;
        }

        #log{
            padding-right: 10px;
        }
        .panel-body{
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">Database Audit Log</div>
                <div class="panel-body">
                <strong>Select number of log records to retrieve</strong>
                <br>
                <i>Retrieves 10 by default</i>
                <strong>:</strong>
                <br>
                    <form id="log" class="form-horizontal" role="form" method="POST" action="{{ url('/log') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="numRetrieve" >
                        {{--<input type="text" class="form-control" placeholder="Enter 0 to retrieve all" name="numRetrieve" method="POST"/>--}}
                        <button type="submit" class="btn btn-primary" name ="Submit" value ="Retrieve Log Records">Retrieve Log Records</button>
                    </form>
                    {{--<li> <a href={{url('download')}}>Test.pdf</a></li>--}}
                </div>
            </div>
            <table id="table" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Admin Name</th>
                    <th>Admin Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($result)) {
                    foreach($result as $single_result) {
                        echo "<tr><td>";
                        print_r($single_result['logID']);
                        echo "</td>";
                        echo "<td>";
                        print_r($single_result['name']);
                        echo "</td>";
                        echo "<td>";
                        print_r($single_result['email']);
                        echo "</td>";
                        echo "<td>";
                        print_r($single_result['Action']);
                        echo "</td></tr>";
                    }
                }
                ?>
                </tbody>
            </table>
            <div class="panel-body">
            </div>
        </div>
    </div>
    </div>
@endsection
