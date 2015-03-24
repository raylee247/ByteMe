@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Student Application Form</b>
		<button class="btn pull-right btn-xs btn-primary" data-target="#modal-1"><i class="glyphicon glyphicon-pencil"></i> Edit Form</button>
	</div>
	<div class="panel-footer">
		<h5>Application Submission Deadline: <b>September 25, 2015 at 11:59:59 PM //TODO: update this value</b>
			<button class="btn pull-right btn-xs btn-primary" data-toggle='modal' data-target='#modal-1'><i class="glyphicon glyphicon-calendar"></i> Set Deadline</button>          
		</h5>
	</div>
	<div class="panel-body">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-3">Email address:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="email" >
				</div><br><br> 
				<label class="control-label col-sm-3">Student number:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="studentnum">
				</div><br><br> 
				<label class="control-label col-sm-3">Computer Science ID:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="csid">
				</div><br><br> 
				<label class="control-label col-sm-3">Given name:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="givenname">
				</div><br><br> 
				<label class="control-label col-sm-3">Family name:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="familyname">
				</div><br><br> 
				<label class="control-label col-sm-3">Phone:</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="phone">
				</div><br><br> 
				<label class="control-label col-sm-3">Phone (alternate):</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="phonealt">
				</div><br><br> 

				<div class="gender">
					<label class="control-label col-sm-3">Gender:</label>
					<label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Identify as male</label>
					<label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Identify as female</label>
					<label class="radio-inline"><input type="radio" name="gender" class ="other" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other (please specify)//TODO</label>
					<div class="genderother" id="otherfield">
						<label class="control-label col-sm-3">Gender (please specify):</label> //TODO : FIX ALIGNMENT
						<div class="col-md-6 panel-collapse collapse in">
							<input type="text" class="form-control" name="genderother" value="otherfield">
						</div>
					</div>
				</div><br>

				<label class="control-label col-sm-3">Year of birth (Optional):</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="birthyear">
				</div><br><br> 
				<label class="control-label col-sm-3">Kickoff event availability</label>
				<div class="col-md-9">Students are required to attend one evening kickoff event to meet with their 
					student/mentor matches. There are 3 different event dates to choose from. All evenings follow the 
					same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please 
					indicate your availability for the following dates:
				</div> 
				<table class="table table-hover" style="width:90%">
					<tr>
						<th></th>
						<th><center>FIRST CHOICE</center></th>
						<th><center>SECOND CHOICE</center> </th> 
						<th><center>THIRD CHOICE</center></th>
						<th><center>NOT AVAIL.</center></th>
					</tr>
					<tr>
						<td><center>Wed. Sept. 24, 2014, from 5:45 - 7:45pm</center></td>
						<td><center><input type="radio" name="day1" <?php if (isset($day1) && $day1=="firstchoice") echo "checked";?> value="firstchoice" ></center></td>
						<td><center><input type="radio" name="day1" <?php if (isset($day1) && $day1=="secondchoice") echo "checked";?> value="secondchoice" ></center></td>
						<td><center><input type="radio" name="day1" <?php if (isset($day1) && $day1=="thirdchoice") echo "checked";?>value="thirdchoice" ></center></td>
						<td><center><input type="radio" name="day1" <?php if (isset($day1) && $day1=="fourthchoice") echo "checked";?>value="fourthchoice" ></center></td>
					</tr>
					<tr>
						<td><center>Thurs. Sept. 25, 2014 from 5:45 - 7:45pm</center></td> 
						<td><center><input type="radio" name="day2" <?php if (isset($day2) && $day2=="firstchoice") echo "checked";?> value="firstchoice" ></center></td>
						<td><center><input type="radio" name="day2" <?php if (isset($day2) && $day2=="secondchoice") echo "checked";?> value="secondchoice" ></center></td>
						<td><center><input type="radio" name="day2" <?php if (isset($day2) && $day2=="thirdchoice") echo "checked";?> value="thirdchoice" ></center></td>
						<td><center><input type="radio" name="day2" <?php if (isset($day2) && $day2=="fourthchoice") echo "checked";?> value="fourthchoice" ></center></td>
					</tr>
					<tr>
						<td><center>Thurs. Oct. 2, 2014, from 5:45 - 7:45pm</center></td>
						<td><center><input type="radio" name="day3" <?php if (isset($day3) && $day3=="firstchoice") echo "checked";?> value="firstchoice" ></center></td>
						<td><center><input type="radio" name="day3" <?php if (isset($day3) && $day3=="secondchoice") echo "checked";?> value="secondchoice" ></center></td>
						<td><center><input type="radio" name="day3" <?php if (isset($day3) && $day3=="thirdchoice") echo "checked";?> value="thirdchoice" ></center></td>
						<td><center><input type="radio" name="day3" <?php if (isset($day3) && $day3=="fourthchoice") echo "checked";?> value="fourthchoice" ></center></td>
					</tr>
				</table><br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Additional comments regarding availability?</label>
					<textarea name="additionalcomments_avail" class="form-control" rows="5" cols="90" ></textarea><br>
				</div> <br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Mentor gender preference:</label>
					<select class="form-control" name="mentorgender" >
						<option id="nopref">No preference</option>
						<option id="femalepref">Match with female mentor only</option>
						<option id="malepref">Match with male mentor only</option>
					</select>
				</div><br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Program of study:</label>
					<select class="form-control" name="programofstudy" >
						<option id="program_none">None</option>
						<option id="ba_cs">BA, Computer Science</option>
						<option id="bcomm_combined_cs">BComm, Combined Business / Computer Science (BUCS)</option>
						<option id="bcs_second">BCS (Bachelor of CS, 2nd Degree)</option>
						<option id="bsc_cog">BSc, Cognitive Systems (Comp. Intelligence and Design)</option>
						<option id="bsc_cs">BSc, Computer Science</option>
						<option id="bsc_combined_cs_bio">BSc, Combined Major (Computer Science and Biology)</option>
						<option id="bsc_combined_cs_math">BSc, Combined Major (Computer Science and Mathematics)</option>
						<option id="bsc_combined_cs_micb">BSc, Combined Major (Computer Science and Microbiology and Immunology)</option>
						<option id="bsc_combined_cs_stats">BSc, Combined Major (Computer Science and Statistics)</option>
						<option id="bsc_cs_phys">BSc, Combined Major (Computer Science and Physics)</option>
						<option id="bsc_combined_cs_other">BSc, Combined Major (Computer Science and Another Science Subject)</option>
						<option id="bsc_honours_cs">BSc, Honours Computer Science</option>
						<option id="other">Other (please specify)</option>
					</select>
				</div><br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Program of study (other):</label> // TODO: DROPDOWN WHEN OTHER IS SELECTED
					<input type="text" class="form-control" name="programofstudy_other">
				</div><br> 

				<div class="form-inline">
					<label class="control-label col-sm-3">Year of study:</label> // TODO: OTHER
					<select class="form-control" name="yearofstudy" >
						<option id="year_none">- None -</option>
						<option id="firstyr">1st year</option>
						<option id="secondyr">2nd year</option>
						<option id="thirdyr">3rd year</option>
						<option id="fourthyr">4th year</option>
						<option id="other">Other</option> 
					</select>
				</div><br>

				<label class="control-label col-sm-4">Which of the following courses have you completed:</label>
				<form role="form">
					<label class="checkbox-inline">
						<input type="checkbox" name="course[]" value="" checked="checked" style="display:none"></label>
						<input type="checkbox" name="course[]" value="210">CPSC 210<label class="checkbox-inline"></label>
						<input type="checkbox" name="course[]" value="213">CPSC 213<label class="checkbox-inline"></label>
						<input type="checkbox" name="course[]" value="221">CPSC 221<label class="checkbox-inline"></label>
					</form><br>


					<label class="control-label col-sm-4">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?<br></label>
					<select class="form-control" name="participation" >
						<option id="previousmatched_no">No, I have not participated before</option>
						<option id="previousmatched_junior">Yes, as a junior student</option>
						<option id="previousmatched_senior">Yes, as a senior student</option>
						<option id="previousmatched_both">Both junior and senior student</option>
					</select>
					<br>

					<label class="control-label col-sm-1">Co-op status:</label> // TODO: FIX ALIGNMENT
					<select class="form-control" name="coop">
						<option value="coop_alltermscompleted">Have completed all co-op terms</option>
						<option value="coop_currentstudent">Currently a co-op student</option>
						<option value="coop_interested">Not a co-op student, but interested in joining co-op</option>
						<option value="coop_notacoopstudent">Not a co-op student</option>
					</select><br>

					<label class="control-label col-sm-4">Future career plans (choose all that apply):</label>
					<div class="col-md-6">
						<input type="checkbox" name="careerplan[]" value="" checked="checked" style="display:none">
						<input type="checkbox" name="careerplan[]" value="work_csaftergrad">Work in CS-related job immediately after graduation <br>
						<input type="checkbox" name="careerplan[]" value="work_forstartup">Work for a start-up<br>
						<input type="checkbox" name="careerplan[]" value="work_ownbusiness">Own my own business<br>
						<input type="checkbox" name="careerplan[]" value="domasters_phd">Complete a Master's or PhD<br>
						<input type="checkbox" name="careerplan[]" value="work_asacademic">Work as an academic<br>
						<input type="checkbox" name="careerplan[]" value="career_unsure">Career plans still unsure<br>
						<input type="checkbox" name="careerplan[]" value="career_other">Other (please specify) // TODO: DROPDOWN<br>
					</div>
					<br>

					<div class="form-inline">
						<label class="control-label col-sm-3">Computer Science areas of interest (please enter as comma-separated list):</label>
						<textarea rows="5" cols="90" name="cs_areasofinterest" id="cs_areasofinterest"></textarea><br>
					</div> <br>

					<div class="form-inline">
						<label class="control-label col-sm-3">Hobbies and interests (please enter as comma-separated list):</label>
						<textarea rows="5" cols="90" name="hobbies_interest" id="hobbies_interest"></textarea><br>
					</div> <br>

					<div class="form-inline">
						<label class="control-label col-sm-3">Additional questions or comments?</label>
						<textarea rows="5" cols="90" name="additionalcomments_questions" id="additionalcomments_questions"></textarea><br>
					</div> <br>
				</div><br>
			</div>
		</form>
	</div>
</div>

<div id="modal-1" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title" style="display:inline"><b>Set deadline for application submission</b></div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="date">Deadline Date</label>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-xs-4">
											<input type="text" class="form-control" id="date" name="year" min="2015" max="2050" placeholder="YYYY">
										</div>
										<div class="col-xs-4">
											<input type="text" class="form-control" id="date" name="month" min="01" max="12" placeholder="MM">
										</div>
										<div class="col-xs-4">
											<input type="text" class="form-control" id="date" name="day" min="01" max="31" placeholder="DD">
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal-footer">
				//TODO:save to db
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button> 
			</div>
		</div>    
	</div>
</div>

@endsection