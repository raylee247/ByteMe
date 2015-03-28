@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Saved Match Results</b></div>
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

		<div class="panel-body">
			<table id="savedmatches" class="table table-striped table-bordered table-hover" cellspacing="0">
				<thead>
					<tr> 
						<th>Name of Matching</th>
						<th>Satisfaction Rate</th>
					</tr>
				</thead>
				<tbody>
					<th>Gender prioritized</th>
					<th>60%</th>
					<th id="finalbutton"><center><button id="" class="btn btn-sm btn-primary">Set as Final Matching</button></center></th>
				</tbody>
			</table>
		</div>

		<style type="text/css">
		#savedmatches {
			width: auto;
		}
		</style>
	</div>
</div>


@endsection