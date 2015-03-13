@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<!--Upload CSV file button for test-->
				<body>
					<form action="uploadCSV" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					Select file to upload:
    					<input type="file" name="fileToUpload" id="fileToUpload">
    					<input type="submit" value="Upload CSV File" name="submit">
					</form>
				</body>

			</div>
		</div>
	</div>
</div>
@endsection
