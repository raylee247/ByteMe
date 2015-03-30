@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Kickoff Match Result</b></div>
	<div class="panel-body">
		<div class="kickoffcontent">
			<ul class="nav nav-tabs">
				<li><h4>Kickoff night dates: </h4></li>
				<!-- <li class="active"><a data-toggle="tab" href="#1">$kickoffdate1</a></li>
				<li><a data-toggle="tab" href="#2">$kickoffdate2</a></li> -->
				<?php
				$count = 1;

				foreach($kickoffmatchings as $key => $value){
					if($count == 1){
						echo "<li class=\"active\"><a data-toggle=\"tab\" href=\"#{$count}\">".$key."</a></li>";
					}else{
						echo "<li><a data-toggle=\"tab\" href=\"#{$count}	\">".$key."</a></li>";
					}
					$count++;
				}

				?>
				<form action="currentmatch">
				<button type="submit" id="viewcurrentselection" class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> View Tri-Mentoring Match Result</span></button>
				</form>
			</ul>
			<div class="tab-content">
				<?php
					$all_mentors = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')->get();
					$all_senior = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')->get();
					$all_junior = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')->get();
					// var_dump($kickoffmatchings);
					// var_dump($all_participants);
					// var_dump($all_mentors);	
					$counter = 1;
					foreach($kickoffmatchings as $key => $value){
						echo "<div id=\"{$counter}\" class=\"tab-pane fade in active\">";
							echo "<h3>".$key." - Grouping</h3>";
							echo "<table class=\"table table-hover\">";
								echo "<thead>";
									echo "<tr>";
										echo "<th>Group</th>";
										echo "<th>Mentors</th>";
										echo "<th>Students</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									foreach($value as $group_index => $group_member){
										$group_id = $group_index+1;
										echo "<tr>";
										echo "<td>{$group_id}</td>";
										$mentor_array = array();
										$student_array = array();
										foreach($group_member as $member_id){
											//loop thourgh all members in the group and put the data into menter array or student array
											foreach($all_mentors as $mentor){
												// var_dump($mentor);
												if(strcmp($mentor['mid'], $member_id) == 0){
													array_push($mentor_array, $mentor);
													break;
												}
											}
											
											foreach($all_senior as $senior){
												if(strcmp($senior['sid'], $member_id) == 0){
													array_push($student_array, $senior);
													break;
												}
											}
											
											foreach ($all_junior as $junior){
												if(strcmp($junior['jid'], $member_id) == 0){
													array_push($student_array, $junior);
													break;
												}
											}
										}
										// var_dump($mentor_array);
										for($i=0; $i<count($mentor_array); $i++){
											if($i == 0 && count($mentor_array) == 1){
												echo "<td>".$mentor_array[$i]['First name']." ".$mentor_array[$i]['Family name']." - ".$mentor_array[$i]['company']."</td>";
											}else{
												if($i == 0 && count($mentor_array) > 1){
													echo "<td>".$mentor_array[$i]['First name']." ".$mentor_array[$i]['Family name']." - ".$mentor_array[$i]['company']."<br>";
												}else{
													if($i == count($mentor_array)-1){
														echo $mentor_array[$i]['First name']." ".$mentor_array[$i]['Family name']." - ".$mentor_array[$i]['company']."</td>";
													}else{
														if($i != 0)
														echo $mentor_array[$i]['First name']." ".$mentor_array[$i]['Family name']." - ".$mentor_array[$i]['company']."<br>";
													}
												}
											}
										}

										for($i=0; $i<count($student_array); $i++){
											if($i == 0 && count($student_array) == 1){
												echo "<td>".$student_array[$i]['First name']." ".$student_array[$i]['Family name']." - ".$student_array[$i]['programOfStudy']."</td>";
											}else{
												if($i == 0 && count($student_array) > 1){
													echo "<td>".$student_array[$i]['First name']." ".$student_array[$i]['Family name']." - ".$student_array[$i]['programOfStudy']."<br>";
												}else{
													if($i == count($student_array)-1){
														echo $student_array[$i]['First name']." ".$student_array[$i]['Family name']." - ".$student_array[$i]['programOfStudy']."</td>";
													}else{
														echo $student_array[$i]['First name']." ".$student_array[$i]['Family name']." - ".$student_array[$i]['programOfStudy']."<br>";
													}
												}
											}
										}
										echo "</tr>";
									}
								echo "</tbody>";
							echo "</table>";
						echo "</div>";
					$counter++;
					}
				?>
				<!-- <div id="1" class="tab-pane fade in active">
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
				</div> -->
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(window).load(function(){
	$('#noresult').modal('show');
});
</script>

@endsection