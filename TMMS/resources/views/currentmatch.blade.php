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
			<?php
				if(isset($rawApp)){
						$length = count($rawApp);
						$total = 0;
						foreach ($rawApp as $key => $match) {
						 	$total += $match['satisfaction'];	  
						}
						$avg = $total/$length;
						echo '<b>Average Satisfaction:</b>'.$avg.'<br>';
					}
			?>
				<!-- <b>Name of Matching:</b> $$$$$<br>
				<b>Parameters Required:</b> $$$$$<br>
				<b>Parameter Priority:</b> $$$$$<br>
				
				<b>Median:</b> $$$$$ -->
			</h5>
		</legend>
		<button id="viewmatch" class="btn btn-xs btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> View Manual Matches </span></button><br><br>
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
							echo '<tr>
									<td>'.$names[$match['mentor']].'</td>
									<td>'.$names[$match['senior']].'</td> 
									<td>'.$names[$match['junior']].'</td>
									<td>'.$match['satisfaction'].'%</td>
								  </tr>';
						}
					}
				?>
			</tbody>
		</table>
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
					<div class="panel-footer">
						<center><button type="submit" class="btn btn-primary">Redirect to Adjust Weighting</button></center>
					</div>
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
});
</script>

@endsection