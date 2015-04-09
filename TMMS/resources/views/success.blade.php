@extends('app')
@section('navbar')
@if (Auth::check())
@section('sidebar')
@parent
@else
@section('main')
@section('guestcontent')
@endif

<br>
<div class="panel panel-info">
	<div class="panel-heading">
		<h2>Successful!</h2>
	</div>
	<div class="panel-body">
			<!-- put message here -->
			@if (isset($message))
				<p> {{$message}} </p>
			@endif
		</div>
</div>

<style type="text/css">

.panel-info{
	margin-right: 20%;
	margin-left: 20%;
}

</style>
@endsection