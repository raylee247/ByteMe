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
							<input type="text" class="form-control" name="matchname" required>
						</div>
					</div>
					<br><br>
					<b>Parameters Required:</b> <?php foreach ($must as $key) {echo $key;} ?><br>
					<b>Parameter Priority:</b> <?php foreach ($priority as $key) {echo $key . ",";} ?><br>
					<b>Average Satisfaction:</b> {{$avgSat}}<br>
					<b>Median:</b> {{$median}}<br>
					<b>Matched Trios: </b> {{$trioCount}} <?php echo '('.$trioCount*3 . " participants)<br>"?>
					<b>UnMatched Participants:</b> {{$unmatchCount}}<br>
					<?php 
						echo '<input type="hidden" name="must" value="'. base64_encode(serialize($must)) . '">
							  <input type="hidden" name="priority" value= "'. base64_encode(serialize($priority)) . '" >
							  <input type="hidden" name="avgSat" value= "'. base64_encode(serialize($avgSat)) . '">
							  <input type="hidden" name="median" value= "'. base64_encode(serialize($median)) . '" >
							  <input type="hidden" name="result_ids" value= "'. base64_encode(serialize($result_ids)) . '" >
							  <input type="hidden" name="result_names" value= "'. base64_encode(serialize($result_names)) . '">
							  <input type="hidden" name="result_unmatch" value= "'. base64_encode(serialize($result_unmatch)) . '" >
							  <input type="hidden" name="mentors" value= "'. base64_encode(serialize($mentors)) . '" >
							  <input type="hidden" name="seniors" value= "'. base64_encode(serialize($seniors)) . '" >
							  <input type="hidden" name="juniors" value= "'. base64_encode(serialize($juniors)) . '" >
							  <input type="hidden" name="trioCount" value= "'. base64_encode(serialize($trioCount)) . '" >
							  <input type="hidden" name="unmatchCount" value= "'. base64_encode(serialize($unmatchCount)) . '" >';
						?>
				</form>
			</h5>
		</legend>
		<button id="addmatch" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Manual Match </span></button><br><br>
		<div id="matchpanel" class="panel panel-default">
			<form method ="POST" action = "makeMatching_without">
				<?php 
				echo '<input type="hidden" name="must" value="'. base64_encode(serialize($must)) . '">
					  <input type="hidden" name="priority" value= "'. base64_encode(serialize($priority)) . '" >';
				?>
				<div class="panel-heading">Create a trio group: <button id="rerunmatch" type ="submit" class="btn btn-xs btn-success pull-right"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Save and Re-run Matching</span></button><br></div>
				<div class="panel-body">
					<div id="manaul_header"> 
						<div class="row">
								<div class="col-md-4">
									<b><u> Industry Mentor </u></b>
									<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mentorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									<br>
								</div>
								<div class="col-md-4">
									<b><u> Senior Student </u></b>
									<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#seniorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									<br>
								</div>
								<div class="col-md-4">
									<b><u> Junior Student </u></b>
									<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#juniorsearch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									<br>
								</div>
							</div>
					</div>
					<?php 
						if (isset($result_ids)){
							foreach ($result_ids as $key => $value) {
								if(is_null($value)){
									$mid = explode(",", $key)[0];
									$sid = explode(",", $key)[1];
									$jid = explode(",", $key)[2];
									$mname = ", " . $mentors[$mid]['First name']." ".$mentors[$mid]['Family name'];
									$sname = ", " . $seniors[$sid]['First name']." ".$seniors[$sid]['Family name'];
									$jname = ", " . $juniors[$jid]['First name']." ".$juniors[$jid]['Family name'];

									echo '<div id="manual" name = "manual">
											<div class="row">
												<div class="col-md-4">
													<div class="input-group">
														<input type="text" class="form-control" id="mentor_input" name="mentor[]" value="'.$mid.$mname.'" placeholder="Specify a mentor\'s name" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="input-group">
														<input type="text" class="form-control" id="senior_input" name="senior[]" value="'.$sid.$sname.'" placeholder="Specify a senior\'s name" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="input-group">
														<input type="text" class="form-control" id="junior_input" name="junior[]" value="'.$jid.$jname.'" placeholder="Specify a student\'s name" readonly>
													</div>
												</div>
											</div>
										</div>';
								}
							}
						}
					?>
					<div id="manual" name = "manual">
						<div class="row">
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" id="mentor_input" name="mentor[]" placeholder="Specify a mentor's name" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" id="senior_input" name="senior[]" placeholder="Specify a senior's name" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" id="junior_input" name="junior[]" placeholder="Specify a student's name" readonly>
								</div>
							</div>
						</div>
					</div>
					<div id="additional"></div>
					<center>
						<button id="remove_manual" type="button" class="btn btn-sm btn-danger" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove A Match</button>
						<button id="addanothermatch" type="button" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Another</span></button>
					</center>
					<br>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
			  	$( "#matchpanel" ).hide();
			  // $( "#manual" ).hide();
			
			$( "#addmatch" ).click(function() {
			  	$( "#matchpanel" ).slideToggle();
			  });
			
			  $( "#addanothermatch" ).click(function() {
			  	 var mentor = document.getElementsByName("mentor[]");
			  	 var senior = document.getElementsByName("senior[]");
			  	 var junior = document.getElementsByName("junior[]");
			  	 if(mentor[mentor.length-1].value == "" || senior[senior.length-1].value == "" || junior[junior.length-1].value == "" ){
			  	 	alert("please specify all of mentor,senior, and junior before adding a new manual match.");
			  	 }else{
			  	 	$( "#manual" ).clone().appendTo("#additional");

			  	 	var mentor = document.getElementsByName("mentor[]");
			  	 	var senior = document.getElementsByName("senior[]");
			  	 	var junior = document.getElementsByName("junior[]");
			  	 	mentor[mentor.length-1].value = "";
			  	 	senior[senior.length-1].value = "";
			  	 	junior[junior.length-1].value = "";
			  	 }
			  	
			  });

			  $( "#remove_manual" ).click(function() {
			  		var elem = document.getElementsByName("manual");
			  		if (elem.length == 1){
			  			document.getElementsByName("mentor[]")[0].value = "";
			  			document.getElementsByName("senior[]")[0].value = "";
			  			document.getElementsByName("junior[]")[0].value = "";
			  		}else{
			  			elem[elem.length-1].remove();
			  		}
			  		
			  });

			
				$("#mentor_search").on("keyup", function() {
				    var value = $(this).val();
			
				    $("#mentorTable tr").each(function(index) {
				        if (index !== 0) {
			
				            $row = $(this);
				    
				            var id = $row.find("td:eq(0)").text();
				            var id1 = $row.find("td:eq(1)").text();
				            var id2 = $row.find("td:eq(2)").text();
				            var id3 = $row.find("td:eq(3)").text();
				            
				            if (id.indexOf(value) !== 0) {
				            	if(id1.indexOf(value) !== 0) {
				            		if(id2.indexOf(value) !== 0) {
				            			if(id3.indexOf(value) !== 0) {
				            				$row.hide();
				            			}
				            			else {
				            				$row.show();
				            			}
				            		}
				            		else {
				            			$row.show();
				            		}
				            	}
				            	else {
				            		$row.show();
				            	}
				            }
				            else {
				                $row.show();
				            }
				        }
				    });
				});
			
				$("#senior_search").on("keyup", function() {
				    var value = $(this).val();
			
				    $("#seniorTable tr").each(function(index) {
				        if (index !== 0) {
			
				            $row = $(this);
				    
				            var id = $row.find("td:eq(0)").text();
				            var id1 = $row.find("td:eq(1)").text();
				            var id2 = $row.find("td:eq(2)").text();
				            var id3 = $row.find("td:eq(3)").text();
				            
				            if (id.indexOf(value) !== 0) {
				            	if(id1.indexOf(value) !== 0) {
				            		if(id2.indexOf(value) !== 0) {
				            			if(id3.indexOf(value) !== 0) {
				            				$row.hide();
				            			}
				            			else {
				            				$row.show();
				            			}
				            		}
				            		else {
				            			$row.show();
				            		}
				            	}
				            	else {
				            		$row.show();
				            	}
				            }
				            else {
				                $row.show();
				            }
				        }
				    });
				});
	
				$("#junior_search").on("keyup", function() {
				    var value = $(this).val();
			
				    $("#juniorTable tr").each(function(index) {
				        if (index !== 0) {
			
				            $row = $(this);
				    
				            var id = $row.find("td:eq(0)").text();
				            var id1 = $row.find("td:eq(1)").text();
				            var id2 = $row.find("td:eq(2)").text();
				            var id3 = $row.find("td:eq(3)").text();
				            
				            if (id.indexOf(value) !== 0) {
				            	if(id1.indexOf(value) !== 0) {
				            		if(id2.indexOf(value) !== 0) {
				            			if(id3.indexOf(value) !== 0) {
				            				$row.hide();
				            			}
				            			else {
				            				$row.show();
				            			}
				            		}
				            		else {
				            			$row.show();
				            		}
				            	}
				            	else {
				            		$row.show();
				            	}
				            }
				            else {
				                $row.show();
				            }
				        }
				    });
				});
	
				$('#mentorTable tr').click(function(){
			            // index of row clicked 
			            var row = $(this);
			
			            var elem = document.getElementsByName("mentor[]");
			            elem[elem.length-1].value = $(this).find("td:eq(0)").text() + ","
			            						  + $(this).find("td:eq(1)").text() + " "
			            						  + $(this).find("td:eq(2)").text();
			
						$('#mentorsearch').modal('hide');
			            return false;
			        });

				$('#seniorTable tr').click(function(){
			            // index of row clicked 
			            var row = $(this);
			
			            var elem = document.getElementsByName("senior[]");
			            elem[elem.length-1].value = $(this).find("td:eq(0)").text() + ","
						  						  + $(this).find("td:eq(1)").text() + " "
						                          + $(this).find("td:eq(2)").text();
			
						$('#seniorsearch').modal('hide');
			            return false;
			        });

				$('#juniorTable tr').click(function(){
			            // index of row clicked 
			            var row = $(this);
			
			            var elem = document.getElementsByName("junior[]");
			            elem[elem.length-1].value = $(this).find("td:eq(0)").text() + ","
						  						  + $(this).find("td:eq(1)").text() + " "
						                          + $(this).find("td:eq(2)").text();
			
						$('#juniorsearch').modal('hide');
			            return false;
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
				<?php
					if(isset($result_names) && isset($result_ids)){
						foreach ($result_names as $key => $value) {
							if(!is_null($value)){
								echo "<tr>";
								$key_array = explode(',', $key);
								foreach ($key_array as $index => $names) {
									echo "<td>".$names."</td>";
								}
								echo "<td>".$value."%</td>";
								echo "</tr>";
							}
						}
					} 
					?>
			</tbody>
		</table>
		<form method="POST" action="makeMatching_refresh">
			<table id="unmatchedlist" class="table table-striped table-bordered table-hover" width="100%">
				<caption>Viewing Unmatched Participants</caption>
				<thead>
					<tr>
						<th>Type</th>
						<th>Pid</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Move to Waitlist  </th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($result_unmatch)){
							foreach ($result_unmatch as $key => $value) {
								echo "<tr>";
								echo "<td>".$value['type']."</td>";
								echo "<td>".$value['pid']."</td>";
								echo "<td>".$value['FirstName']."</td>";
								echo "<td>".$value['LastName']."</td>";
								echo "<td>".$value['email']."</td>";
								echo '<input type="hidden" name="must" value="'. base64_encode(serialize($must)) . '">
									  <input type="hidden" name="priority" value= "'. base64_encode(serialize($priority)) . '" >
									  <input type="hidden" name="avgSat" value= "'. base64_encode(serialize($avgSat)) . '">
									  <input type="hidden" name="median" value= "'. base64_encode(serialize($median)) . '" >
									  <input type="hidden" name="result_ids" value= "'. base64_encode(serialize($result_ids)) . '" >
									  <input type="hidden" name="result_names" value= "'. base64_encode(serialize($result_names)) . '">
									  <input type="hidden" name="result_unmatch" value= "'. base64_encode(serialize($result_unmatch)) . '" >
									  <input type="hidden" name="mentors" value= "'. base64_encode(serialize($mentors)) . '" >
									  <input type="hidden" name="seniors" value= "'. base64_encode(serialize($seniors)) . '" >
									  <input type="hidden" name="juniors" value= "'. base64_encode(serialize($juniors)) . '" >
									  <input type="hidden" name="trioCount" value= "'. base64_encode(serialize($trioCount)) . '" >
									  <input type="hidden" name="unmatchCount" value= "'. base64_encode(serialize($unmatchCount)) . '" >';
								if (!$value['waitlist']){
									echo '<td><button type="submit" class="btn btn-sm btn-primary"
									  name= "pidToWaitList" value = "' . $value['pid'] .  '">
									  <span class="glyphicon glyphicon-flag"></span></span></button></td>';
								}else{
									echo '<td><button type="submit" class="btn btn-sm btn-primary btn-danger" 
									  name= "Undo" value = "' . $value['pid'] .  '" >
									  <span class="glyphicon glyphicon-remove"></span></span> UNDO</button></td>';
								}
								
						
								echo "</tr>";
								
							}
						}
						?>
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
								<div class="col-xs-8 col-xs-offset-2">
									<input type="text" id="mentor_search" name="mentor_search" placeholder="live search"></input>
								</div>
							</div>
						</div>
						<br><br><br>
						<table id="mentorTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>pid</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, job for MENTORS-->
								<?php 
									if (isset($mentors)){
										foreach ($mentors as $key => $value) {
											echo "<tr>";
											foreach ($value as $title => $info) {
												echo "<td>".$info."</td>";
											}
											echo '<td><center>
												  <button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span>
												  </button></center></td>';
											echo "</tr>";
										}
									}
									?>
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
								<input type="text" id="senior_search" name="mentor_search" placeholder="live search"></input>
							</div>
						</div>
						<br><br><br>
						<table id="seniorTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>pid</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, yearstanding for SENIORS-->
								<?php 
									if (isset($seniors)){
										foreach ($seniors as $key => $value) {
											foreach ($value as $title => $info) {
												echo "<td>".$info."</td>";
											}
											echo '<td><center>
												  <button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span>
												  </button></center></td>';
											echo "</tr>";
										}
									}
									?>
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
								<input type="text" id="junior_search" name="mentor_search" placeholder="live search"></input>
							</div>
						</div>
						<br><br><br>
						<table id="juniorTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>pid</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<!-- fill table data here with first, last name, email, yearstanding for JUNIORS-->
								<?php 
									if (isset($juniors)){
										foreach ($juniors as $key => $value) {
											foreach ($value as $title => $info) {
												echo "<td>".$info."</td>";
											}
											echo '<td><center>
												  <button id="" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span>
												  </button></center></td>';
											echo "</tr>";
										}
									}
									?>
							</tbody>
							</tbody>
						</table>
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