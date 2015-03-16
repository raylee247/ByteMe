@extends('app')

@section('content')
<div class="container">

 <form action="uploadCSV" method="post" enctype="multipart/form-data" >
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload CSV File" name="submit">
</form>

@if (count($preview_header))
<table id = "preview">
  <tr>
    @foreach ($preview_header as $header)
    <th> {{$header}} </th>
    @endforeach
  </tr>
  @foreach($preview_data as $participant)
  <tr>
    @foreach($participant as $data)
    <td> {{$data}} </td>
    @endforeach
  </tr>  
  @endforeach 
</table>
@endif


</div>


@endsection