@extends('app')
@section('content')
<div class="content">
<div class="panel panel-info">
  <div class="panel-heading"><b>Upload Participant Data</b></div>
  <div class="panel-body">
    
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-lg-6 col-sm-6 col-12">
        <form action="uploadcsv" method="post" enctype="multipart/form-data" >
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
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Preview <input type="submit" value="preview" formaction="uploadcsv_preview" name="submit_preview"><!--specify value type here-->
              </span>
            </span>
          </div>
        <span class="help-block">
        File format requires to be in .csv extension or CSV formatted .txt
        </span>
          I am uploading participant information for: <br>
            <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="student") echo "checked"; ?> value="student">Students</label>
            <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="mentor") echo "checked"; ?> value="mentor">Mentors</label>
            <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="report") echo "checked"; ?> value="report">Reports</label>

            <br><br>
            <?php if(isset($preview_header)) { echo '
          <span class="input-group-btn">
          <span class="btn btn-success btn-file">
          <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload File <input type="submit" formmethod="post" formaction="uploadcsv_uploaded" value="Upload CSV File" name="submit_upload">
          </span>
          </span>
          ';} ?>
        </form>
      </div>
    
  </div>
</div>
</div>
@if (isset($preview_header))
File Preview:
<div>
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
@endif


@endsection