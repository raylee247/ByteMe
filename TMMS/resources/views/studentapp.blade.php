@extends('app')
@section('guestcontent')
<style type="text/css">
div.error {
    position: absolute;
    right: -155px;
    top: 5px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
}
.studentapp{
    position: absolute;

}
#input.required.error{
        position: relative;
    right: -755px;
    top: -20px;
    color:white;
    z-index:1;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:20%;
}
#gender-error.error{
    position: relative;
    right: -755px;
    top: -20px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:20%;
}
#cs_areasofinterest-error.error{
    position: relative;
    right: -850px;
    top: -145px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
}
#coop-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
    }
#participation-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
}
#mentorgender-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
    }
#yearofstudy-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
    }
#programofstudy-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
}
#gender-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day1-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day2-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day3-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day4-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day5-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day6-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day7-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day8-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day9-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day10-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
#day11-error.error{
    position: relative;
    right: -550px;
    top: 0px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:100%;
}
</style>
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
            <form class="form-horizontal" role="form" id="studentapp" action="studentapp" method="POST" >

                    <label class="control-label col-sm-3">Email address:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" placeholder="example@example.com">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Student number:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="studentnum" maxlength="8" placeholder="12345678">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Computer Science ID:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="csid" minlength="4" maxlength="4" placeholder="ie. m9n9">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Given name:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="givenname" placeholder="John">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Family name:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="familyname" placeholder="Smith">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Phone:</label>
                    <div class="col-md-6">
                        <input class="form-control" minlength="10" maxlength="10" name="phone" placeholder="Format: 1234567890">
                    </div>
                    <br><br>
                    <label class="control-label col-sm-3">Phone (alternate):</label>
                    <div class="col-md-6">
                        <input class="form-control" name="phonealt" minlength="10" maxlength="10" placeholder="Format: 1234567890">
                    </div>
                    <br><br>
                    <div class="gender">
                        <label class="control-label col-sm-3">Gender:</label>
                        <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" required>Identify as male</label>
                        <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female" required>Identify as female</label>
                    </div>
                    <br>
                    <label class="control-label col-sm-3">Year of birth (Optional):</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="birthyear" placeholder="YYYY" minlength="4" maxlength="4">
                    </div>
                    <br><br><br>
                    <?php
                        //generate kickoff section on application form
                        $count = count($kickoff);
                        
                        echo '<label class="control-label col-sm-3">Kickoff event availability</label>
                        <div class="col-sm-4"></div><div class="col-md-9">Students are required to attend one evening kickoff event to meet with their
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
                        echo '<th><center>NOT AVAIL.</center></th></tr>';
                        
                        //display kickoff dates and radio buttons
                        for($i = 0; $i < $count; $i++){
                            echo '<tr><td><center>' . $kickoff[$i] . '</center></td>';
                            //generate each row
                            for($j = 0; $j < $count; $j++){
                                echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                                if(isset($day1) && $day1 == $kickoff[$i]){
                                    echo "checked";
                                }
                                $value = 'value="' . $kickoff[$i] . '" required></center></td>';
                                echo $value;
                            }
                            echo '<td><center><input type="radio" name="day' . ($i+1) . '"';
                            if (isset($day1) && $day1== $kickoff[$i]) {
                                echo "checked";
                            }
                            echo $value = 'value="" ></center>
                            <label for="day' . ($i+1) . '" class="error" style="display:none;">Please choose one.</label></td>';
                            echo "</tr>";
                        }
                        
                        echo '</table>';
                        ?>

                    <div>
                        <div class="col-sm-2"></div>
                        <label class="control-label">Additional comments regarding availability?</label><br><br>
                        <center><textarea name="additionalcomments_avail" rows="5" cols="125"></textarea></center>  
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

                        <label class="control-label col-sm-3">Which of the following courses have you completed?</label><br>
                        <input type="checkbox" name="course[]" value="" checked="checked" style="display:none" ><label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="210">CPSC 210<label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="213">CPSC 213<label class="checkbox-inline"></label>
                        <input type="checkbox" name="course[]" value="221">CPSC 221<label class="checkbox-inline"></label>
                    <br><br>

                    <div class="form-inline">
                        <label class="control-label col-sm-3">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?</label><br>
                        <select class="form-control" name="participation">
                            <option value="">Select...</option>
                            <option id="previousmatched_no">No, I have not participated before</option>
                            <option id="previousmatched_junior">Yes, as a junior student</option>
                            <option id="previousmatched_senior">Yes, as a senior student</option>
                            <option id="previousmatched_both">Both junior and senior student</option>
                        </select>
                    </div>
                    <br>

                    <div class="form-inline">
                        <label class="control-label col-sm-3">Co-op status:</label>
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


                        echo'<label class="control-label col-sm-3">' . $questions[$x][2] . '</label><br>
                        <div class="col-md-6"><input type="checkbox" name="' . $questions[$x][1] . '[]" value="" checked="checked" style="display:none">';
                                    $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                                    $answer = explode("," , $rawAnswer);
                                    $answerCount = count($answer);
                                    for ($i = 0; $i < $answerCount; $i++){

                        echo'<input type="checkbox" name="' . $questions[$x][1] . '[]" value="' . $answer[$i] . '">' . $answer[$i] . '<br>';
                    }
                       
                   echo' </div><br><br><br><br><br><br><br>';
                                    break;
                        
                                case "text":
                                    echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="' . $questions[$x][1] . '">
                        </div></div><br><br>';
                                    break;
                        
                                case "radio":
                                    echo '<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><br><br>
                                    <div class="col-sm-1"></div>
                                    <div class="col-md-9">' .
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
                                            
                                            $value ='value="' . $questions[$i][1] . '"></center></td>';
                        
                        
                                            echo $value;
                                            // echo $questions[$x][1];
                        
                        
                                        }
                                        echo "</tr>";
                                    }
                        
                        
                                    echo '</table><br>';
                                    break;
                        
                                case "select": //this is dropdown
                                    echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '<br></label>
                        <div class="col-md-4"><select class="form-control" name="' . $questions[$x][1] . '">';
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





                                    echo '<div class="col-sm-2"></div>
                        <label class="pull-left">' . $questions[$x][2] . '</label><br>
                        <center>
                        <textarea rows="5" cols="130" name="' . $questions[$x][1] .  '" id="' . $questions[$x][1] .'"></textarea>
                        </center>
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
                                        echo ' value="' . $answer[$i] . '">' . $answer[$i] . '</label><br>';
                                    }
                        
                            }
                            echo '<br>';
                        }
                        
                        ?>                        

                    <div class="col-sm-1"></div>
                        <label class="pull-left">Computer Science areas of interest (please enter as comma-separated list):</label><br><br>
                        <div class="col-sm-1"></div>
                        <textarea rows="5" cols="130" name="cs_areasofinterest" id="cs_areasofinterest" required></textarea>
                        <br><br>

                    <center><button type="submit" class="btn btn-primary">Submit Application</button></center>
                </div>
                <br>
        </div>
        </form>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    $("#studentapp").validate({
        errorElement: 'div',
        rules: {
            email: {
                required: true,
                pattern: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
            },
            studentnum: {
                required: true,
                number: true,
                pattern: /^[0-9]{8}$/
            },
            givenname: {
                required: true,
                pattern: /(([a-zA-Z]+\-?)|([a-zA-Z]+\-?\ ))+/
            },
            familyname: {
                required: true,
                pattern: /(([a-zA-Z]+\-?)|([a-zA-Z]+\-?\ ))+/
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                pattern: /^\(?([0-9]{3})\)?[-.]?([0-9]{3})[-.]?([0-9]{4})$/
            },
            phonealt: {
                number: true,
                pattern: /^\(?([0-9]{3})\)?[-.]?([0-9]{3})[-.]?([0-9]{4})$/
            },
            csid: {
                required: true,
                pattern: /[a-z][0-9][a-z][0-9]/
            },
            birthyear: {
                number: true,
                minlength: 4,
                maxlength: 4,
                pattern: /^[1-9]\d{3,}$/
            },
            gender: {
                required: true
            },
            birthyear: {
                number: true,
                pattern: /^[1-2]\d{3,}$/
            },
            participation: {
                required: true
            },
            <?php for($i = 0; $i < $count; $i++){
                echo 'day' . ($i+1) .':{required:true},';
            }
                ?>
        },
        messages: {
            email: {
                pattern: "Input is not a valid email address."
            },
            studentnum: {
                pattern: "Student number must be 8 digits long."
            },
            csid: {
                pattern: "Input is not a valid CS ID."
            },
            birthyear: {
                pattern: "Input is not a valid year."
            }
        }
    });
</script>
@endsection