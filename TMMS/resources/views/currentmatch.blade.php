@extends('app')
@section('content')
<style type="text/css">
	.panel-default{
	margin-right: 0px;
	}
	.panel-body b{
	color:black;
	}
	.table {
	white-space:normal;
	}
	#matchresult, #manual {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	width: 100%;
	border-collapse: collapse;
	}
	#matchresult td, #matchresult th, #manual td, #manual th{
	font-size: 1em;
	border: 1px solid #9191B5;
	padding: 3px 7px 2px 7px;
	}
	#matchresult th, #manual th {
	font-size: 1.1em;
	text-align: left;
	padding-top: 5px;
	padding-bottom: 4px;
	background-color: #1A5690;
	color: #ffffff;
	}
	#matchresult tr.alt td, #manual tr.alt td {
	color: #000000;
	background-color: #66CCFF;
	}
</style>
<div class="content">
	<div class="panel panel-info">
		<div class="panel-heading"><b>Current Tri-Mentoring Match Results</b></div>
		<div class="panel-body">
			<button id="viewmatch" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> View Manual Matches </span></button>
			<h5>
				@if(isset($weighting))
				<b>Match Name:</b> {{$weighting['name']}}<br>
				<b>Match ID:</b> {{$weighting['wid']}}<br>
				<b>Parameters Required:</b> {{$weighting['must']}}<br>
				<b>Parameter Priority:</b> {{$weighting['helpful']}}<br>
				<b>Average Satisfaction:</b> {{$weighting['avgSat']}}<br>
				<b>Median:</b> {{$weighting['median']}}<br>
				@endif
			</h5>
			<legend>
			</legend>
			<div id="matchpanel" class="panel panel-default">
				<div class="panel-heading">Manual Matches: </div>
				<div class="panel-body">
					<table id="manual" class="table table-striped table-hover" width="100%">
						<thead>
							<tr>
								<th>Industry Mentor</th>
								<th>Senior Student</th>
								<th>Junior Student</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if(isset($rawApp) && isset($names)){
									foreach ($rawApp as $key => $match) {
										if (is_null($match['satisfaction'])){
											echo '<tr>
													<td>'.$names[$match['mentor']].'</td>
													<td>'.$names[$match['senior']].'</td> 
													<td>'.$names[$match['junior']].'</td>
										  		  </tr>';
										}
										
									};
								}
								else {
									echo 'No match';
								} 
								?>
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
					<?php 
						if(isset($rawApp) && isset($names)){
							foreach ($rawApp as $key => $match) {
								if (!is_null($match['satisfaction'])){
									echo '<tr>
											<td>'.$names[$match['mentor']].'</td>
											<td>'.$names[$match['senior']].'</td> 
											<td>'.$names[$match['junior']].'</td>
											<td>'.$match['satisfaction'].'%</td>
										  </tr>';
								}
								
							}
						}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	if ($message == 'fail'){
		echo '<div class="modal fade in" id="noresult" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">No Match Results</h3>
						</div>
						<div class="panel-body">
							There are currently no match results. Please run the matching before attempting to view this page.			
						</div>
						<form method ="GET" action = "weight">
							<div class="panel-footer">
								<center><button type="submit" class="btn btn-primary">Redirect to Adjust Weighting</button></center>
							</div>
						</form>
					</div>
				</div>        
			</div>
		</div>
	</div>';
	
	}
	?>
<script type="text/javascript">
	$(window).load(function(){
		$('#noresult').modal('show');
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$( "#matchpanel" ).hide();
		$( "#viewmatch" ).click(function() {
			$( "#matchpanel" ).slideToggle();
		});
	
	  $('#matchresult').dataTable( {
	    "pageLength": 20,
	    "searching": false
	  });		
	    $('#manual').dataTable( {
	    "pageLength": 20,
	    "searching": false
	  });
	  });
</script>
@endsection