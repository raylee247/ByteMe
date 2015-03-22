@extends('app')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading"><b>Upload Participant Data</b></div>
  <div class="panel-body">
    <form action="uploadCSV" method="post" enctype="multipart/form-data" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-lg-6 col-sm-6 col-12">
        <form>
          I am uploading participant information for: <br> //TODO: NEED TO POST VALUES AND SEND TO CONTROLLER
          <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="junior") echo "checked";?> value="junior">Juniors</label>
          <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="senior") echo "checked";?> value="senior">Seniors</label>
          <label class="radio-inline"><input type="radio" name="category" <?php if (isset($category) && $category=="mentor") echo "checked";?> value="mentor">Mentors</label>
        </form><br><br>
        Select a file to upload: 
        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-primary btn-file">
              Browse <input type="file" name="fileToUpload" id="fileToUpload">
            </span>
          </span>
          <input type="text" class="form-control" readonly>
        </div>
        <span class="help-block">
          File format requires to be in .csv extension
        </span>
        <span class="input-group-btn">
          <span class="btn btn-primary btn-file">
            <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload File <input type="submit" value="Upload CSV File" name="submit">
          </span>
        </span>
      </div>
    </form>
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