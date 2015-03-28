@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2>Successful!</h2>
		<div class="panel-body">
			<!-- put message here -->
			@if (isset($message))
				<p> {{$message}} </p>
			@endif
		</div>
	</div>
</div>

<style type="text/css">

.panel-info{
	margin-right: 200px;
	margin-left: 150px;
	height:50%;
}

</style>
@endsection