@extends('app')
@section('guestcontent')
<div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2>
                <center>Student Application Form</center>
            </h2>
            <br>
            <h4>
                <center>Thank you for your interest in becoming a student with our Computer Science tri-mentoring program. <br>
                    To help in matching mentors to appropriate students, please complete all sections of the application form.
                </center>
            </h4>
        </div>
        <div class="panel-body">
            // TODO : SET UP REQUIRED FIELDS , validation, fix "other" fields
            <form class="form-horizontal" role="form" id="studentapp" action="studentapp" method="POST" >

                    <label class="control-label col-sm-3">Email address:</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Student number:</label>
                    <div class="col-md-6">
                        <input type="digits" class="form-control" name="studentnum" minlength="8" maxlength="8" required>
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Computer Science ID:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="csid" minlength="4" maxlength="4" required>
                    </div>
                    <br><br>
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
                        <input type="text" class="form-control" minlength="10" maxlength="10" name="phone" required>
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Phone (alternate):</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="phonealt" minlength="10" maxlength="10">
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
                    <br><br><br>
                    <?php
                        //generate kickoff section on application form
                        $count = count($kickoff);
                        
                        echo '<label class="control-label col-sm-3">Kickoff event availability</label><br><br>
                        <div class="col-sm-1"></div><div class="col-md-9">Students are required to attend one evening kickoff event to meet with their
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
                    <div>
                        <div class="col-sm-1"></div>
                        <label class="pull-left">Additional comments regarding availability?</label><br><br>
                        <div class="col-sm-1"></div>
                        <textarea name="additionalcomments_avail" rows="5" cols="130"></textarea>
                    </div>
                    <br>
                    <div class="form-inline">
                        <label class="control-label col-sm-3">Mentor gender preference:</label>
                        <select class="form-control" name="mentorgender" required>
                            <option value=""> Select...</option>
                            <option id="nopref">No preference</option>
                            <option id="femalepref">Match with female mentor only</option>
                            <option id="malepref">Match with male mentor only</option>
                        </select>
                    </div>
                    <br>
                    <?php
                        //generate the program of study section of application form
                        echo '<div class="form-inline">
                        <label class="control-label col-sm-3">Program of study:</label>
                        <select class="form-control" name="programofstudy" required>
                        <option value=""> Select...</option>';
                        
                        $programCount = count($program);
                        for($i = 0; $i < $programCount; $i++){
                            echo '<option>' . $program[$i] . '</option>';
                        }
                        
                        echo ' </select></div><br>';
                        
                        ?>
                    <div class="form-inline">
                        <label class="control-label col-sm-3">Program of study (other):</label>
                        <input type="text" class="form-control" name="programofstudy_other">
                    </div>
                    <br>
                    <div class="form-inline">
                        <label class="control-label col-sm-3">Year of study:</label> 
                        <select class="form-control" name="yearofstudy" required>
                            <option value=""> Select...</option>
                            <option id="firstyr">1st year</option>
                            <option id="secondyr">2nd year</option>
                            <option id="thirdyr">3rd year</option>
                            <option id="fourthyr">4th year</option>
                            <option id="other">Other</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-inline">
                        <div class="col-sm-1"></div>
                        <label class="control-label">Which of the following courses have you completed?</label>
                        <input type="checkbox" name="course[]" value="" checked="checked" style="display:none" ><label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="210">CPSC 210<label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="213">CPSC 213<label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="221">CPSC 221<label class="checkbox-inline"></label>
                    </div>
                    <br>
                    <div class="form-inline">
                        <div class="col-sm-1"></div>
                        <label class="control-label">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?</label>
                        <select class="form-control" name="participation" required>
                            <option value="">Select...</option>
                            <option id="previousmatched_no">No, I have not participated before</option>
                            <option id="previousmatched_junior">Yes, as a junior student</option>
                            <option id="previousmatched_senior">Yes, as a senior student</option>
                            <option id="previousmatched_both">Both junior and senior student</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-inline">
                        <div class="col-sm-1"></div>
                        <label class="control-label">Co-op status:</label>
                        <select class="form-control" name="coop" required>
                            <option value="">Select...</option>
                            <option value="coop_alltermscompleted">Have completed all co-op terms</option>
                            <option value="coop_currentstudent">Currently a co-op student</option>
                            <option value="coop_interested">Not a co-op student, but interested in joining co-op</option>
                            <option value="coop_notacoopstudent">Not a co-op student</option>
                        </select>
                    </div>
                    <br>
                    {{--this is the extra questions part--}}
                    <?php
                        //questions comes in as an array holding arrays
                        //each array looks like the following [format2|id2|question2|answer]
                        for ($x = 0; $x < count($questions); $x++) {
                            //echo "NEW QUESTIONS ARE HERE";
                            switch($questions[$x][0]){
                        
                                case "checkbox":
                                    echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-6">';
                                    echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="" checked="checked" style="display:none" required>';
                                    $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                    $answer = explode("," , $rawAnswer);
                                    $answerCount = count($answer);
                                    for ($i = 0; $i < $answerCount; $i++){
                                        echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="' . $answer[$i] . '">' . $answer[$i] . '<br>';
                                    }
                                    echo '</div></div><br><br><br><br><br><br><br>';
                                    break;
                        
                                case "text":
                                    echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="' . $questions[$x][1] . '" required>
                        </div></div><br><br>';
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
                                        echo '</tr>';
                                    //display the answers (on the side) and the radio buttons
                                    for($i = 0; $i < $answerCount; $i++){
                                        echo '<tr><td><center>' . $answer[$i] . '</center></td>';
                                        //generate each row
                                        for($j = 0; $j < $optionsCount; $j++){
                                            echo '<td><center><input type="radio" name="' . $questions[$i][1] . '"';
                                            if(isset($d) && $d == $answer[$i]){
                                                echo "checked";
                                            }
                                            
                                            $value ='value="' . $questions[$i][1] . '" required></center></td>';
                        
                        
                                            echo $value;
                                            // echo $questions[$x][1];
                        
                        
                                        }
                                        echo "</tr>";
                                    }
                        
                        
                                    echo '</table></div><br>';
                                    break;
                        
                                case "select": //this is dropdown
                                    echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '<br></label>
                        <div class="col-md-4"><select class="form-control" name="' . $questions[$x][1] . '" required>';
                                    $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                    $answer = explode("," , $rawAnswer);
                                    $answerCount = count($answer);
                                    echo '<option value="">Select...</option>';
                                    for($i = 0; $i < $answerCount; $i++){
                                        echo '<option>' . $answer[$i] . '</option>';
                                    }
                                    echo '</select></div></div><br>';
                                    break;
                        
                                case "textarea":
                                    echo '<div class="col-sm-1"></div>
                        <label class="pull-left">' . $questions[$x][2] . '</label><br><br>
                        <div class="col-sm-1"></div>
                        <textarea rows="5" cols="130" name="' . $questions[$x][1] .  '" id="' . $questions[$x][1] .'" required></textarea><br>
                        <br>';
                                    break;

                                case "singleRadio":
                                    echo '<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><br><br><table class="table table-hover" style="width:90%"><tr><th></th>';

                                    $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                    $answer = explode("," , $rawAnswer);
                                    $answerCount = count($answer);
                                    for ($i = 0; $i < $answerCount; $i++){
                                        echo '<label class="radio-inline"><input type="radio" name="' . $questions[$x][1] . '"';
                                        if(isset($questions[$x][1]) && $questions[$x][1]==$answer[$i]){
                                            echo "checked";
                                        }
                                        echo ' value="' . $answer[$i] . '" required>' . $answer[$i] . '</label><br>';
                                    }
                        
                            }
                            echo '<br>';
                        }
                        
                        ?>                        
                    <br>
                    <center><button type="submit" class="btn btn-primary">Submit Application</button></center>
                </div>
                <br>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#studentapp").validate({
        rules: {
            phone: {
                required: true,
                digits: true
            },
            givenname: {
                required: true,
                minlength: 2
            },
            familyname: {
                required: true
            },
            csid: {
                required: true,
                pattern: /[a-z][0-9][a-z][0-9]/
            },
        },
        messages: {
            csid: {
                pattern: "CS ID should be like: x9y9"
            }
        }
    });
</script>
@endsection