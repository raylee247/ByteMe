@extends('app')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading"><b>Upload Participant Data</b></div>
  <div class="panel-body">
    <form action="uploadCSV" method="post" enctype="multipart/form-data" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
      <div class="col-lg-6 col-sm-6 col-12">
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

<!-- fix css -->
      <span class="btn btn-primary btn-file">
        <input type="submit" value="Upload CSV File" name="submit">
      </span>

      </div>





<!--       <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload CSV File" name="submit"> -->
</form>




</div>
</div>











    @if (count($preview_header))
    <table id = "preview" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
</div>

@endsection