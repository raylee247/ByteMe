@extends('app')
@section('navbar')
@if (Auth::check())
@section('sidebar')
@parent
@else
@section('main')
@section('guestcontent')
@endif


<br><br>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h2>Failure!</h2>
		<div class="panel-body">
			@if (isset($message))
				<p> {{$message}} </p>
			@endif
		</div>
	</div>
	<div class="panel-body">
			<h4>
				<?php echo $message; ?>
			</h4>
		</div>
</div>

<style type="text/css">

.panel-danger{
	margin-right: 20%;
	margin-left: 20%;
}
h2 {
	color:white;
}

</style>
@endsection