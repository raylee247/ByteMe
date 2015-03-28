@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Kickoff Match Result</b></div>
	<div class="panel-body">
		<div class="kickoffcontent">
			<ul class="nav nav-tabs">
				<li><h4>Kickoff night dates: </h4></li>
				<li class="active"><a data-toggle="tab" href="#1">$kickoffdate1</a></li>
				<li><a data-toggle="tab" href="#2">$kickoffdate2</a></li>
				<form action="currentmatch">
				<button type="submit" id="viewcurrentselection" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> View Tri-Mentoring Match Result</span></button>
				</form>
			</ul>
			<div class="tab-content">
				<div id="1" class="tab-pane fade in active">
					<h3>$kickoffdate1 - FAKE DATA</h3>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Group</th>
								<th>Mentors</th>
								<th>Students</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Calvin Kok - Microsoft<br> William Hsiao - Amazon</td>
								<td>Miranda Tuet - Bsc Combined Major<br>Robin Or - BSc Computer Science<br> Ray Lee - BSc Computer Science<br> Edwin Ko - BSc Computer Science</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Calvin Kok - Microsoft<br> William Hsiao - Amazon</td>
								<td>Miranda Tuet - Bsc Combined Major<br>Robin Or - BSc Computer Science<br> Ray Lee - BSc Computer Science<br> Edwin Ko - BSc Computer Science</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="2" class="tab-pane fade">
					<h3>$kickoffdate2 - FAKE DATA</h3>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Group</th>
								<th>Mentors</th>
								<th>Students</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Calvin Kok - Microsoft<br> William Hsiao - Amazon</td>
								<td>Miranda Tuet - Bsc Combined Major<br>Robin Or - BSc Computer Science<br> Ray Lee - BSc Computer Science<br> Edwin Ko - BSc Computer Science</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Calvin Kok - Microsoft<br> William Hsiao - Amazon</td>
								<td>Miranda Tuet - Bsc Combined Major<br>Robin Or - BSc Computer Science<br> Ray Lee - BSc Computer Science<br> Edwin Ko - BSc Computer Science</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection