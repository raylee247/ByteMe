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
    .mentorapp{
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
    #studentgenderpref-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
    }
    #yearsofcswork-error.error{
    position: relative;
    right: -850px;
    top: -30px;
    color:white;
    background: #F00;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .7);
    padding: 2px 5px;
    width:15%;
    }
    #levelofeducation-error.error{
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
                            <input type="email" class="form-control" name="email" required placeholder="example@example.com">
                        </div>
                        <br><br>
                        <label class="control-label col-sm-3">Given name:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="givenname" minlength="2" required placeholder="ie. John">
                        </div>
                        <br><br>
                        <label class="control-label col-sm-3">Family name:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="familyname" minlength="2" required placeholder="ie. Smith">
                        </div>
                        <br><br>
                        <label class="control-label col-sm-3">Phone:</label>
                        <div class="col-md-6">
                            <input type="digit" class="form-control" minlength="10" maxlength="10" name="phone" required placeholder="ie. 1234567890">
                        </div>
                        <br><br>
                        <label class="control-label col-sm-3">Phone (alternate):</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" minlength="10" maxlength="10" name="phonealt" placeholder="ie. 1234567890">
                        </div>
                        <br><br>
                        <div class="gender">
                            <label class="control-label col-sm-3">Gender:</label>
                            <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Identify as male</label>
                            <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female" required>Identify as female</label>
                        </div>
                        <br>
                        <label class="control-label col-sm-3">Year of birth (Optional):</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="birthyear" placeholder="YYYY">
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
                                echo $value = 'value=""></center>';
                                echo "</tr>";
                            }
                            
                            echo '</table>';
                            ?>
                        <br>
                        <div class="form-inline">
                            <label class="control-label col-sm-3">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?</label>
                            <select class="form-control" name="participation" required>
                                <option value="">Select...</option>
                                <option id="previousmatched_no">No, I have not participated before</option>
                                <option id="previousmatched_junior">Yes, as a junior student</option>
                                <option id="previousmatched_senior">Yes, as a senior student</option>
                                <option id="previousmatched_both">Both junior and senior student</option>
                            </select>
                        </div>
                        <br><br>
                        <div class="form-inline">
                            <label class="control-label col-sm-3">Preference of student mentee gender:</label>
                            <select class="form-control" name="studentgenderpref" required>
                                <option value="">Select...</option>
                                <option id="nopref">No preference</option>
                                <option id="femalepref">Match with female students only</option>
                                <option id="malepref">Match with male students only</option>
                            </select>
                        </div>
                        <br><br>
                        <div class="form-inline">
                            <label class="control-label col-sm-3">Current company (optional):</label>
                            <input type="text" class="form-control" name="company" placeholder="ie. Amazon">
                        </div>
                        <br><br>
                        <div class="form-inline">
                            <label class="class=control-label col-sm-3">Current position at work (optional):</label>
                            <input type="text" class="form-control" name="position" placeholder="ie. Software Developer">
                        </div>
                        <br><br>
                        <div class="form-inline">
                            <label class="class=control-label col-sm-3">Years of CS-related work experience:</label>
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
                        <br><br>
                        <div class="form-inline">
                            <label class="class=control-label col-sm-3">Highest level of education:</label>
                            <select class="form-control" name="levelofeducation" required>
                                <option value="">Select...</option>
                                <option id="0-2years">Bachelor's</option>
                                <option id="3-5years">Master's</option>
                                <option id="6-10years">PhD</option>
                                <option id="11-15years">Other (please specify)</option>
                            </select>
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
        errorElement: 'div',
        rules: {
            email: {
                required: true,
                pattern: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
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
                minlength: 10,
                pattern: /^\(?([0-9]{3})\)?[-.]?([0-9]{3})[-.]?([0-9]{4})$/
            },
            phonealt: {
                number: true,
                pattern: /^\(?([0-9]{3})\)?[-.]?([0-9]{3})[-.]?([0-9]{4})$/
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
            phone: {
                pattern: "Please enter a valid number (excluding dashes)."
            },
            email: {
                pattern: "Input is not a valid email address."
            },
            birthyear: {
                pattern: "Input is not a valid year."
            }
        }
    });
</script>
@endsection