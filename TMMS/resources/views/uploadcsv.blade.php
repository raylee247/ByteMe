@extends('app')
@section('content')
<div class="panel panel-info">
  <div class="panel-heading"><b>Upload Participant Data</b></div>
  <div class="panel-body">
    
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-lg-6 col-sm-6 col-12">
        <form action="uploadcsv_preview" method="post" enctype="multipart/form-data" >
          Select a file to upload: 
          <div class="input-group">
            <span class="input-group-btn">
            <span class="btn btn-primary btn-file">
            Browse <input type="file" name="fileToUpload" id="fileToUpload">
            </span>
            </span>
            <input type="text" class="form-control" readonly>
            <span class="input-group-btn">
              <span class="btn btn-info btn-file">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Preview <input type="submit" value="preview" name="submit"><!--specify value type here-->
              </span>
            </span>
          </div>
            <?php if (!isset($category)) { echo '
            <span class="help-block">
        File format requires to be in .csv extension or CSV formatted .txt
        </span>
            I am uploading participant information for: <br>
            <label class="radio-inline"><input type="radio" name="category" value="student">Students</label>
            <label class="radio-inline"><input type="radio" name="category" value="mentor">Mentors</label>
            <label class="radio-inline"><input type="radio" name="category" value="report">Reports</label>
        ';} ?>
        </form>

      <?php if (isset($category)) { echo '
        <span class="help-block">
        File format requires to be in .csv extension or CSV formatted .txt
        </span>
        <form action="uploadcsv_uploaded" method="post" enctype="multipart/form-data" >
          I am uploading participant information for: <br>
            <label class="radio-inline"><input type="radio" name="category" '; if (isset($category) && $category=="student") echo "checked"; echo ' value="student">Students</label>
            <label class="radio-inline"><input type="radio" name="category" '; if (isset($category) && $category=="mentor") echo "checked"; echo ' value="mentor">Mentors</label>
            <label class="radio-inline"><input type="radio" name="category" '; if (isset($category) && $category=="report") echo "checked"; echo ' value="report">Reports</label>

            <br><br>
          <span class="input-group-btn">
          <span class="btn btn-success btn-file">
          <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload File <input type="submit" formmethod="post" value="Upload CSV File" name="submit">
          </span>
          </span>
        </form>';
          } ?>
      </div>
    
  </div>
</div>
File Preview:
<div class="container">
  @if (count($preview_header))
  <table id = "preview" class="table table-striped table-bordered" cellspacing="0" width="auto">
    <thead>
      <tr>
        @foreach ($preview_header as $header)
        <th> {{$header}} </th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($preview_data as $participant)
      <tr>
        @foreach($participant as $data)
        <td> {{$data}} </td>
        @endforeach
      </tr>
      @endforeach 
    </tbody>
  </table>
  @endif
</div>
@endsection