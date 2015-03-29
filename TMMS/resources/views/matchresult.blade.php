@extends('app')

@section('content')

<style type="text/css">
.panel-default{
	margin-right: 0px;
}
</style>

<div class="panel panel-info">
	<div class="panel-heading"><b>Viewing Match Results</b></div>
	<div class="panel-body">
		<legend>
			<h5>
				<form action="savedmatches" method="POST">
				<button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Save Matching </span></button>
				<div class="form-inline">
				<div class="form-group">
					<label for="usr">Name of Matching:</label>
					<input type="text" class="form-control" id="matchname" required>
				</div></div><br><br>
				<b>Parameters Required:</b> <?php foreach ($must as $key) {echo $key;} ?><br>
				<b>Parameter Priority:</b> <?php foreach ($priority as $key) {echo $key . ",";} ?><br>
				<b>Average Satisfaction:</b> $$$$$<br>
				<b>Median:</b> $$$$$
			</form>
			</h5>
		</legend>

		<button id="addmatch" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Manual Match </span></button><br><br>
		<div id="matchpanel" class="panel panel-default">
			<div class="panel-heading">Create a trio group: <button id="rerunmatch" class="btn btn-xs btn-success pull-right"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Save and Re-run Matching</span></button><br></div>
			<div class="panel-body">
				<div id="manual">
					<div class="row">
						<div class="col-md-4">
							<b> Industry Mentor </b>
							<div class="input-group">
								<input type="text" class="form-control" name="mentor" placeholder="Specify a mentor's name">
								<span class="input-group-btn">
									<span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mentorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
								</span>
							</div>	
						</div>
						<div class="col-md-4">	
							<b> Senior Student </b>
							<div class="input-group">
								<input type="text" class="form-control" name="senior" placeholder="Specify a senior's name">
								<span class="input-group-btn">
									<span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#seniorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
								</span>
							</div>
						</div>
						<div class="col-md-4">
							<b> Junior Student </b>
							<div class="input-group">
								<input type="text" class="form-control" name="junior" placeholder="Specify a student's name">
								<span class="input-group-btn">
									<span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#juniorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div id="additional"></div><br>
				<center>
					<button id="addanothermatch" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Another</span></button>
				</center><br>
			</div>
		</div>

		<script type="text/javascript">
		$(document).ready(function(){
			$( "#matchpanel" ).hide();
  // $( "#manual" ).hide();

  $( "#addmatch" ).click(function() {
  	$( "#matchpanel" ).slideToggle();
  });

  $( "#addanothermatch" ).click(function() {
  	$( "#manual" ).clone().appendTo("#additional");
  	$( "addanothermatch").hide();
  });

});
		</script>


		<table id="matchresult" class="table table-striped table-bordered table-hover" width="100%">
			<caption>Viewing Match Results</caption>
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
<form method="POST">
		<table id="unmatchedlist" class="table table-striped table-bordered table-hover" width="100%">
			<caption>Viewing Unmatched Participants</caption>
			<thead>
				<tr>
					<th>Type</th>
					<th>First Name</th>
					<th>Last Name</th>
			        <th>Email</th>
			        <th>Move to Waitlist  <button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#waitlistone"><span class="glyphicon glyphicon-ok-sign"></span></span></button></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Mentor</td>
					<td>First</td> 
					<td>Last</td>
					<td>mentor@mentor.com</td>
					<td><button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#waitlistone"><span class="glyphicon glyphicon-flag"></span></span></button></td>
				</tr>
				<tr>
					<td>Senior</td>
					<td>First</td> 
					<td>Last</td>
					<td>senior@senior.com</td>
					<td><button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#waitlistone"><span class="glyphicon glyphicon-flag"></span></span></button></td>
				</tr>
				<tr>
					<td>Junior</td>
					<td>First</td> 
					<td>Last</td>
					<td>junior@junior.com</td>
					<td><button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#waitlistone"><span class="glyphicon glyphicon-flag"></span></span></button></td>
				</tr>
			</tbody>
		</table>
</form>

	</div>
</div>


<!--  mentor modal -->
<div class="modal fade" id="mentorsearch" tabindex="-1" role="dialog" aria-labelledby="mentorsearchLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div>    
							<div class="col-xs-8 col-xs-offset-2">
								<form action="mentors" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="input-group">
										<input type="hidden" name="search_param" value="all" id="search_param">         
										<input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<br><br><br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr> 
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Job</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, job for MENTORS-->
								<th>Whoever</th>
								<th>Bleh</th>
								<th>w@blah.com</th>
								<th>Not Google Q.Q</th>
								<th><center><button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span></button></center></th>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- senior modal -->
<div class="modal fade" id="seniorsearch" tabindex="-1" role="dialog" aria-labelledby="seniorsearchLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div>    
							<div class="col-xs-8 col-xs-offset-2">
								<form action="mentors" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="input-group">
										<input type="hidden" name="search_param" value="all" id="search_param">         
										<input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<br><br><br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr> 
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Year Standing</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, yearstanding for SENIORS-->
								<th>Miranda</th>
								<th>Tuet</th>
								<th>m@blah.com</th>
								<th>3</th>
								<th><center><button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></center></th>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- juniormodal-->
<div class="modal fade" id="juniorsearch" tabindex="-1" role="dialog" aria-labelledby="juniorsearchLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div>    
							<div class="col-xs-8 col-xs-offset-2">
								<form action="mentors" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="input-group">
										<input type="hidden" name="search_param" value="all" id="search_param">         
										<input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<br><br><br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr> 
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Year Standing</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, yearstanding for JUNIORS-->
								<th>Whatever</th>
								<th>Blah</th>
								<th>blah@blah.com</th>
								<th>1</th>
								<th><center><button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span></button></center></th>
							</tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<div class="modal fade" id="waitlistone" tabindex="-1" role="dialog" aria-labelledby="waitlistoneLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Waitlist Participant</h3>
					</div>
					<div class="panel-body">
						Are you sure you want to move this participant to the waitlist? Click "Confirm" to continue or "Cancel" to return to the page.
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</div>
			</div>        
		</div>
	</div>
</div>

<div class="modal fade" id="waitlistall" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Waitlist All Participants</h3>
					</div>
					<div class="panel-body">
						Are you sure you want to move ALL participants to the waitlist? Click "Confirm" to continue or "Cancel" to return to the page.			
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Confirm</button></center>
					</div>
				</div>
			</div>        
		</div>
	</div>
</div>
@endsection