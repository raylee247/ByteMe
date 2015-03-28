@extends('app')

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading"><b>Download Participant Data</b></div>
        <div class="panel-body">

            I am downloading participant information from:<br>
            <div class="col-md-4">


                <!-- Test download button -->
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('downloadCSV') }}">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--<li><a href={{url('downloadcsv')}}>Test.pdf</a></li>--}}
                {{--</form>--}}

                <form class="form-horizontal" role="form" method="POST" action="{{ url('downloadCSV') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{--<input type="file" name="Download Destination" id="fileToDownload">--}}

                    <select class="form-control" name="year_csv" >
                        <?php
                        foreach($range as $range_index) {
                            $option_year = $range_index['year'];
                            echo "<option value=$option_year>$option_year</option>";
                        }
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

    <div class="panel panel-danger">
        <div class="panel-heading"><b>Delete Participant Data</b></div>
        <div class="panel-body">
            I am deleting participant information from:<br>
            <div class="col-md-4">
                <form>
                    <select class="form-control" name="year_csv" >
                        <?php
                        foreach($range as $range_index) {
                            $option_year = $range_index['year'];
                            echo "<option value=$option_year>$option_year</option>";
                        }
                        ?>
                    </select>
                </form><br>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Confirm</button> // TODO : delete data from db
                </div>
            </div>
        </div>
    </div>

@endsection