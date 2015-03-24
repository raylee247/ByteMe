@extends('app')

@section('guestcontent')

<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading"><center>Student Application Form</center></div>
      <div class="panel-body">

        <h2>Sign up to be a Student</h2>

        Thank you for your interest in becoming a student with our Computer Science tri-mentoring program. To help in matching mentors to appropriate students, please complete all sections of the application form.

        // TODO : SET UP REQUIRED FIELDS , validation, fix "other" fields
        <form class="form-horizontal" role="form" action="mentorapp" method="POST" >
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

              <?php
              //generate kickoff section on application form
              $count = count($kickoff);

              echo '<label class="control-label col-sm-3">Kickoff event availability</label>
             <div class="col-md-9">Students are required to attend one evening kickoff event to meet with their
              student/mentor matches. There are " . $count . " different event dates to choose from. All evenings follow the
              same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please
              indicate your availability for the following dates:
            </div>
            <table class="table table-hover" style="width:90%">
                <tr>
                    <th></th>';

              for($i = 0; $i < $count; $i++){
                  echo '<th><center>CHOICE ' . ($i+1) . '</center></th>';
              }
              echo '<th><center>NOT AVAIL.</th></center>
            </tr>';

              //display kickoff dates and radio buttons
              for($i = 0; $i < $count; $i++){
                  echo '<tr>
                    <td><center>' . $kickoff[$i] . '</center></td>';
                  //generate each row
                  for($j = 0; $j < $count; $j++){
                      echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                      if(isset($day1) && $day1 == $kickoff[$i]){
                          echo "checked";
                      }
                      $value = 'value="' . $kickoff[$i] . '"></center>';
                      echo $value;
                  }
                  echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                  if (isset($day1) && $day1== $kickoff[$i]) {
                      echo "checked";
                  }
                  echo $value = 'value="null"></center>';
                  echo "</tr>";
              }

              echo '</table><br>';
              ?>

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


        <?php

            //generate the program of study section of application form
            echo '<div class="form-inline">
                <label class="control-label col-sm-3">Program of study:</label>
                <select class="form-control" name="programofstudy" >';

            $programCount = count($program);
            for($i = 0; $i < $programCount; $i++){
                echo '<option>' . $program[$i] . '</option>';
            }

            echo ' </select></div><br>';

        ?>

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
          <center><button type="submit" class="btn btn-primary">Submit Application</button></center>
        </div><br>
      </div></form></div></div>

      @endsection
