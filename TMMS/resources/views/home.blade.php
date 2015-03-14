@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        You are logged in!
                        <!-- Test download button -->
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('downloadcsv') }}">--}}
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{--<li></li> <a href={{url('downloadcsv')}}>Test.pdf</a></li>--}}
                        {{--</form>--}}

                        <form class="form-horizontal" role="form" method="GET" action="{{ url('downloadcsv') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{--<input type="file" name="Download Destination" id="fileToDownload">--}}
                            <input type="submit" value="Download CSV" name="Submit">
                        </form>
{{--                        <li></li> <a href={{url('download')}}>Test.pdf</a></li>--}}


                    </div>
                </div>

				<body>
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
				</body>

			</div>
		</div>
	</div>
</div>
@endsection


