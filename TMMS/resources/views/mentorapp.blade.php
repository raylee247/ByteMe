@extends('app')
@section('guestcontent')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2>
                        <center>Mentor Application Form</center>
                    </h2>
                    <br>
                    <h4>
                        <center>Thank you for your interest in becoming a mentor with our Computer Science tri-mentoring program. <br>
                            To help in matching mentors to appropriate students, please complete all sections of the application form.
                        </center>
                    </h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="mentorapp" action="mentorapp" method="POST" >
                        <div class="form-group">
                            <label class="control-label col-sm-3">Email address:</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <br><br><br><br>
                            <label class="control-label col-sm-3">Given name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="givenname" minlength="2" required>
                            </div>
                            <br><br>
                            <label class="control-label col-sm-3">Family name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="familyname" minlength="2" required>
                            </div>
                            <br><br>
                            <label class="control-label col-sm-3">Phone:</label>
                            <div class="col-md-6">
                                <input type="digit" class="form-control" minlength="10" maxlength="10" name="phone" required>
                            </div>
                            <br><br>
                            <label class="control-label col-sm-3">Phone (alternate):</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" minlength="10" maxlength="10" name="phonealt">
                            </div>
                            <br><br>
                            <div class="gender">
                                <label class="control-label col-sm-3">Gender:</label>
                                <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" required>Identify as male</label>
                                <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female" required>Identify as female</label>
                                <label class="radio-inline"><input type="radio" name="gender" class ="other" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other" required>Other (please specify)</label>
                                <div class="genderother" id="otherfield">
                                    <label class="control-label col-sm-3">Gender (please specify):</label> 
                                    <div class="col-md-6 panel-collapse collapse in">
                                        <input type="text" class="form-control" name="genderother" value="otherfield">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label class="control-label col-sm-3">Year of birth (Optional):</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="birthyear">
                            </div>
                            <br><br>
                            <?php
                            //generate kickoff section on application form
                            $count = count($kickoff);

                            echo '<label class="control-label col-sm-3">Kickoff event availability</label><br><br><div class="col-sm-1"></div>
					   <div class="col-md-9">Students are required to attend one evening kickoff event to meet with their
					   student/mentor matches. There are ' . $count . ' different event dates to choose from. All evenings follow the
					   same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please
					   indicate your availability for the following dates:
					   </div><br><br><br><br>
					   <table class="table table-hover table-striped" style="width:90%">
					   <tr>
					   <th></th>';

                            for($i = 0; $i < $count; $i++){
                                echo '<th><center>CHOICE ' . ($i+1) . '</center></th>';
                            }
                            echo '<th><center>NOT AVAIL.</th></center></tr>';

                            //display kickoff dates and radio buttons
                            for($i = 0; $i < $count; $i++){
                                echo '<tr><td><center>' . $kickoff[$i] . '</center></td>';
                                //generate each row
                                for($j = 0; $j < $count; $j++){
                                    echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                                    if(isset($day1) && $day1 == $kickoff[$i]){
                                        echo "checked";
                                    }
                                    $value = 'value="' . $kickoff[$i] . '" required></center>';
                                    echo $value;
                                }
                                echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                                if (isset($day1) && $day1== $kickoff[$i]) {
                                    echo "checked";
                                }
                                echo $value = 'value="null"></center>';
                                echo "</tr>";
                            }

                            echo '</table>';
                            ?>
<!--                             <div>
                                <div class="col-sm-1"></div>
                                <label class="pull-left">Additional comments regarding availability?</label><br><br>
                                <div class="col-sm-1"></div>
                                <textarea name="additionalcomments_avail" rows="5" cols="130"></textarea>
                            </div> -->
                            <br>
                            <div class="form-inline">
                                <div class="col-sm-1"></div>
                                <label class="pull-left">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?<br></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="participation" required>
                                        <option value="">Select...</option>
                                        <option id="previousmatched_no">No, I have not participated before</option>
                                        <option id="previousmatched_junior">Yes, as a junior student</option>
                                        <option id="previousmatched_senior">Yes, as a senior student</option>
                                        <option id="previousmatched_both">Both junior and senior student</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-sm-1"></div>
                            <label class="pull-left">Preference of student mentee gender:</label>
                            <div class="col-md-4">
                                <select class="form-control" name="studentgenderpref" required>
                                    <option value="">Select...</option>
                                    <option id="nopref">No preference</option>
                                    <option id="femalepref">Match with female students only</option>
                                    <option id="malepref">Match with male students only</option>
                                </select>
                            </div>
                            <br><br><br>

                            <div class="form-inline">
                                <div class="col-sm-1"></div><label class="control-label pull-left">Current company (optional)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="company">
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-inline">
                                <div class="col-sm-1"></div><label class="control-label pull-left">Current position at work (optional)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="position">
                                </div>
                            </div>
                            <br><br><br>
<!--                             <div class="col-sm-1"></div>
                            <label class="control-label pull-left">Current employment status (check all that apply):</label>
                            <div class="col-md-4">
                                <input type="checkbox" name="employmentstatus[]" value="industry">Working in industry<br>
                                <input type="checkbox" name="employmentstatus[]" value="academia">Working in academia<br>
                                <input type="checkbox" name="employmentstatus[]" value="startup">Working for a startup<br>
                                <input type="checkbox" name="employmentstatus[]" value="selfemployed">Self-employed<br>
                                <input type="checkbox" name="employmentstatus[]" value="retired">Retired<br>
                                <input type="checkbox" name="employmentstatus[]" value="other_employment">Other (please specify)<br>
                            </div>
                            <br><br><br><br><br><br><br> -->
                            <div class="form-inline">
                                <div class="col-sm-1"></div>
                                <label class="pull-left">Years of CS-related work experience:</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="yearsofcswork" required>
                                        <option value="">Select...</option>
                                        <option id="0-2years">0-2 years</option>
                                        <option id="3-5years">3-5 years</option>
                                        <option id="6-10years">6-10 years</option>
                                        <option id="11-15years">11-15 years</option>
                                        <option id="16-20years">16-20 years</option>
                                        <option id="20+years">20+ years</option>
                                    </select>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-inline">
                                <div class="col-sm-1"></div>
                                <label class="pull-left">Highest level of education:</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="levelofeducation" required>
                                        <option value="">Select...</option>
                                        <option id="0-2years">Bachelor's</option>
                                        <option id="3-5years">Master's</option>
                                        <option id="6-10years">PhD</option>
                                        <option id="11-15years">Other (please specify)</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            {{--this is the extra questions part--}}
                            <?php
                            //questions comes in as an array holding arrays
                            //each array looks like the following [format2|id2|question2|answer]
                            for ($x = 0; $x < count($questions); $x++) {
                                //echo "NEW QUESTIONS ARE HERE";
                                switch($questions[$x][0]){

                                    case "checkbox":
                                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-6">';
                                        echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="" checked="checked" style="display:none">';
                                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                        $answer = explode("," , $rawAnswer);
                                        $answerCount = count($answer);
                                        for ($i = 0; $i < $answerCount; $i++){
                                            echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="' . $answer[$i] . '">' . $answer[$i] . '<br>';
                                        }
                                        echo '</div><br><br><br><br><br><br>';
                                        break;

                                    case "text":
                                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
					                 <div class="col-md-4"><input type="text" class="form-control" name="' . $questions[$x][1] . '"></div><br><br>';
                                        break;

                                    case "radio":
                                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><br><br><div class="col-sm-1"></div><div class="col-md-9">' .
                                                $questions[$x][3] . '</div><table class="table table-hover" style="width:90%"><tr><th></th>';

                                        $rawOptions = $questions[$x][4];
                                        $options = explode("," , $rawOptions);
                                        $optionsCount = count($options);

                                        $rawAnswer = $questions[$x][5];
                                        $answer = explode("," , $rawAnswer);
                                        $answerCount = count($answer);

                                        //display the options on the top
                                        for($i = 0; $i < $optionsCount; $i++){
                                            echo '<th><center>' . $options[$i] . '</center></th>';
                                        }

                                        //display the answers (on the side) and the radio buttons
                                        for($i = 0; $i < $answerCount; $i++){
                                            echo '<tr><td><center>' . $answer[$i] . '</center></td>';
                                            //generate each row
                                            for($j = 0; $j < $optionsCount; $j++){
                                                echo '<td><center><input type="radio" name="' . $questions[$i][1] . '"';
                                                if(isset($day1) && $day1 == $answer[$i]){
                                                    echo "checked";
                                                }
                                                $value = 'value="' . $answer[$i] . '"></center>';
                                                echo $value;
                                            }
                                            echo "</tr>";
                                        }

                                        echo '</table><br>';
                                        break;

                                    case "select": //this is dropdown
                                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' .
                                                $questions[$x][2] . '<br></label><div class="col-md-4"><select class="form-control" name="' .
                                                $questions[$x][1] . '" >';
                                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                        $answer = explode("," , $rawAnswer);
                                        $answerCount = count($answer);
                                        for($i = 0; $i < $answerCount; $i++){
                                            echo '<option>' . $answer[$i] . '</option>';
                                        }
                                        echo '</select></div><br>';
                                        break;

                                    case "textarea":
                                        echo '<div class="col-sm-1"></div><label class="pull-left">' . $questions[$x][2] .
                                                '</label><br><br><div class="col-sm-1"></div><textarea rows="5" cols="130" name="' .
                                                $questions[$x][1] .  '" id="' . $questions[$x][1] .'"></textarea><br><br>';
                                        break;

                                    case "singleRadio":
                                        echo '<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><br><br><table class="table table-hover" style="width:90%"><tr><th></th>';

                                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                        $answer = explode("," , $rawAnswer);
                                        $answerCount = count($answer);
                                        for ($i = 0; $i < $answerCount; $i++){
                                            echo '<div class="col-sm-1"></div><label class="radio-inline"><input type="radio" name="' . $questions[$x][1] . '"';
                                            if(isset($questions[$x][1]) && $questions[$x][1]==$answer[$i]){
                                                echo "checked";
                                            }
                                            echo ' value="' . $answer[$i] . '" required>' . $answer[$i] . '</label><br>';
                                        }

                                }
                                echo '<br>';
                            }

                            ?>
                           <!--  <div class="col-sm-1"></div>
                            <label class="control-label pull-left">Are you a UBC alumnae/alumnus?</label>
                            <div class="col-md-4">
                                <label class="radio-inline"><input type="radio" name="alumnus" <?php if (isset($alumnus) && $alumnus=="alumnus_yes") echo "checked";?> value="alumnus_yes" required>Yes</label>
                                <label class="radio-inline"><input type="radio" name="alumnus" <?php if (isset($alumnus) && $alumnus=="alumnus_no") echo "checked";?> value="alumnus_no" required>No</label>
                            </div> -->
                            <br><br>
                            <div class="col-sm-1"></div>
                            <label class="control-label pull-left">Computer Science areas of interest (please enter as comma-separated list):</label><br><br>
                            <div class="col-sm-1"></div>
                            <textarea rows="5" cols="130" name="cs_areasofinterest" id="cs_areasofinterest" required></textarea>
                            <br><br>
                            
                            <center><button type="submit" class="btn btn-primary">Submit Application</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

            <script type="text/javascript">
            $("#mentorapp").validate({
                rules: {
                    phone: {
                        required: true,
                        digits: true
                    }
                }
            });
            </script>
@endsection