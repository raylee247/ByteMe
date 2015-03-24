@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Mentor Application Form</b>
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
					<input type="text" class="form-control" name="email">
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
				<label class="control-label col-sm-3">Phone(alternate):</label>
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

				<div class="form-inline">
					<label class="control-label col-sm-3">Preference of student mentee gender:</label>
					<div class="col-md-4">
						<select class="form-control" name="studentgenderpref">
							<option id="nopref">No preference</option>
							<option id="femalepref">Match with female students only</option>
							<option id="malepref">Match with male students only</option>
						</select>
					</div>
				</div><br>

				<label>Kickoff event availability</label> //TODO: fix alignment
				<div class="col-md-9">Mentors are requested to attend one evening kickoff event to meet with their student matches. There are 3 different event dates to choose from. All evenings follow the same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please indicate your availability for the following dates:
				</div> 
				<table class="table table-hover" style="width:90%">
					<tr>
						<th></th>
						<th><center>FIRST CHOICE</center></th>
						<th><center>SECOND CHOICE</center></th>  
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
					<textarea class="form-control" rows="5" cols="90" name="additionalcomments_avail"></textarea><br>
				</div> <br>

				<label class="control-label col-sm-4">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?<br></label>
				<select class="form-control" name="participation" >
					<option id="previousmatched_no">No, I have not participated before</option>
					<option id="previousmatched_junior">Yes, as a junior student</option>
					<option id="previousmatched_senior">Yes, as a senior student</option>
					<option id="previousmatched_both">Both junior and senior student</option>
				</select>
				<br>

				<label class="control-label col-sm-4">Current employment status (check all that apply):</label>
				<form role="form">
					<div class="col-md-6">
						<input type="checkbox" name="employmentstatus[]" value="industry">Working in industry<br>
						<input type="checkbox" name="employmentstatus[]" value="academia">Working in academia<br>
						<input type="checkbox" name="employmentstatus[]" value="startup">Working for a startup<br>
						<input type="checkbox" name="employmentstatus[]" value="selfemployed">Self-employed<br>
						<input type="checkbox" name="employmentstatus[]" value="retired">Retired<br>
						<input type="checkbox" name="employmentstatus[]" value="other_employment">Other (please specify) //TODO <br>
					</div> 
				</form><br>

				<div class="form-inline">
					<label class="control-label col-sm-4">Years of CS-related work experience:</label>
					<div class="col-md-6">
						<select class="form-control" name="yearsofcswork">
							<option id="0-2years">0-2 years</option>
							<option id="3-5years">3-5 years</option>
							<option id="6-10years">6-10 years</option>
							<option id="11-15years">11-15 years</option>
							<option id="16-20years">16-20 years</option>
							<option id="20+years">20+ years</option>
						</select>
					</div>
				</div><br>

				<div class="form-inline">
					<label class="control-label col-sm-4">Highest level of education:</label>
					<div class="col-md-6">
						<select class="form-control" name="levelofeducation">
							<option id="0-2years">Bachelor's</option>
							<option id="3-5years">Master's</option>
							<option id="6-10years">PhD</option>
							<option id="11-15years">Other (please specify)</option> // TODO
						</select>
					</div>
				</div><br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Computer Science areas of interest (please enter as comma-separated list):</label>
					<textarea rows="5" cols="90" name="cs_areasofinterest" id="cs_areasofinterest"></textarea><br>
				</div> <br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Hobbies and interests (please enter as comma-separated list):</label>
					<textarea rows="5" cols="90" name="hobbies_interest" id="hobbies_interest"></textarea><br>
				</div> 

				<div class="alumnus">
					<label class="control-label col-sm-3">Are you a UBC alumnae/alumnus?</label>
					<label class="radio-inline"><input type="radio" name="alumnus" <?php if (isset($alumnus) && $alumnus=="alumnus_yes") echo "checked";?> value="alumnus_yes">Yes</label>
					<label class="radio-inline"><input type="radio" name="alumnus" <?php if (isset($alumnus) && $alumnus=="alumnus_no") echo "checked";?> value="alumnus_no">No</label>
				</div><br>

				<div class="form-inline">
					<label class="control-label col-sm-3">Additional questions or comments?</label>
					<textarea rows="5" cols="90" name="additionalcomments_questions" id="additionalcomments_questions"></textarea><br>
				</div> 

		
			</div>		<center><button class="btn btn-primary">Submit Application</button></center>
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
</div>
</div>

<style type="text/css">
.panel-info {
    margin-right: 0px;
    margin-bottom: 0px;
}
</style>

@endsection