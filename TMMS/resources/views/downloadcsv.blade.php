@extends('app')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading"><b>Download Participant Data</b></div>
    <div class="panel-body">
        I am downloading participant information from:<br>
        <div class="col-md-4">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('downloadCSV') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{--<input type="file" name="Download Destination" id="fileToDownload">--}}

                <select class="form-control" name="year_csv" >
                    <?php
                    foreach($range as $range_index) {
                        $option_year = $range_index['year'];
                        if ($option_year != 0) {
                            echo "<option value=$option_year>$option_year</option>";
                        }                        }
                        ?>
                    </select><br>
                    <span class="input-group-btn">
                      <span class="btn btn-primary btn-file">
                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                        Download File
                        <input type="submit" value="Download CSV" name="Submit">
                    </span>
                </span>
            </form>
            {{--<li> <a href={{url('download')}}>Test.pdf</a></li>--}}

        </div>
    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading"><b>Download Participant Emails</b></div>
    <div class="panel-body">
        I am downloading participant emails from:<br>
        <div class="col-md-4">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('downloadEmailAction') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{--<input type="file" name="Download Destination" id="fileToDownload">--}}

                <select class="form-control" name="year_csv" >
                    <?php
                    foreach($range as $range_index) {
                        $option_year = $range_index['year'];
                        if ($option_year != 0) {
                            echo "<option value=$option_year>$option_year</option>";
                        }                        }
                        ?>
                    </select><br>
                    <span class="input-group-btn">
                      <span class="btn btn-primary btn-file">
                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                        Download Emails
                        <input type="submit" value="Download Emails" name="Submit">
                    </span>
                </span>
            </form>
            {{--<li> <a href={{url('download')}}>Test.pdf</a></li>--}}

        </div>
    </div>
</div>

<!-- TODO -->
<div class="panel panel-info">
    <div class="panel-heading"><b>Download Participant Reports</b></div>
    <div class="panel-body">
        I am downloading participant reports from:<br>
        <div class="col-md-4">

           <select class="form-control" name="year_csv" >
            <?php
            foreach($range as $range_index) {
                $option_year = $range_index['year'];
                if ($option_year != 0) {
                    echo "<option value=$option_year>$option_year</option>";
                }                        }
                ?>
            </select><br>
            <span class="btn btn-primary btn-file">
                <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                Download Report
                <input type="submit" value="Download Report" name="Submit">
            </span>
        </div>
    </div>
</div>


<div>
    <div class="panel panel-danger">
        <div class="panel-heading"><b>Delete Participant Data</b></div>
        <div class="panel-body">
            I am deleting participant information from:<br>
            <div class="col-md-4">
                <select class="form-control" name="year_csv" >
                    <?php
                    foreach($range as $range_index) {
                        $option_year = $range_index['year'];
                        if ($option_year != 0) {
                            echo "<option value=$option_year>$option_year</option>";
                        }
                    }
                    ?>
                </select>
                <br>
                <span class="input-group-btn">
                    <span class="btn btn-danger btn-file" data-toggle="modal" data-target="#delete">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        Delete
                    </span>
                </span>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">Deleting the information will remove all associated data for that year within the system. Are you sure you want to continue?</div>
                <div class="modal-footer">
                    <p align="left">Please confirm the year that you are deleting:</p>
                    <form class="form-horizontal" method="POST" role="form" action="{{ url('deleteYear') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <select class="form-control" name="year_csv" >
                            <?php
                            foreach($range as $range_index) {
                                $option_year = $range_index['year'];
                                if ($option_year != 0) {
                                    echo "<option value=$option_year>$option_year</option>";
                                }                                }
                                ?>
                            </select>
                            <br>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <span class="btn btn-primary btn-file">
                                <span class="glyphicon glyphicon-confirm" aria-hidden="true"></span>
                                Confirm
                                <input type="submit" value="Confirm Delete" name="Submit">
                            </span>
                        </form>

                        // TODO : delete data from db
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection