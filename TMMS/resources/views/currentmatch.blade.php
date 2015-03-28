@extends('app')

@section('content')

<style type="text/css">
.panel-default{
	margin-right: 0px;
}
</style>

<div class="panel panel-info">
	<div class="panel-heading"><b>Viewing Current Match Results</b></div>
	<div class="panel-body">
		<legend>
			<h5>
				<b>Name of Matching:</b> $$$$$<br>
				<b>Parameters Required:</b> $$$$$<br>
				<b>Parameter Priority:</b> $$$$$<br>
				<b>Average Satisfaction:</b> $$$$$<br>
				<b>Median:</b> $$$$$
			</h5>
		</legend>
		<button id="viewmatch" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> View Manual Matches </span></button><br><br>
		<div id="matchpanel" class="panel panel-default">
			<div class="panel-heading">Manual Matches: </div>
			<div class="panel-body">
				<table id="matchresult" class="table table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th>Industry Mentor</th>
							<th>Senior Student</th>
							<th>Junior Student</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>First Last</td>
							<td>First Last</td> 
							<td>First Last</td>
						</tr>
						<tr>
							<td>First Last</td>
							<td>First Last</td> 
							<td>First Last</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>				


		<table id="matchresult" class="table table-striped table-bordered table-hover" width="100%">
			<thead>
				<tr>
					<th>Industry Mentor</th>
					<th>Senior Student</th>
					<th>Junior Student</th>
					<th>Satisfaction %</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>First Last</td>
					<td>First Last</td> 
					<td>First Last</td>
					<td>%</td>
				</tr>
				<tr>
					<td>First Last</td>
					<td>First Last</td> 
					<td>First Last</td>
					<td>%</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$( "#matchpanel" ).hide();
  // $( "#manual" ).hide();

  $( "#viewmatch" ).click(function() {
  	$( "#matchpanel" ).slideToggle();
  });

});
</script>

@endsection