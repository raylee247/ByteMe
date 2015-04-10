@extends('app')
@section('content')
    <div class="content">
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>Student Application Form</b>
                <div class="pull-right">
                    <button class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#modal-101"><i class="glyphicon glyphicon-plus-sign"></i> Create New Form</button>
                    <button class="btn btn-xs btn-primary" type="button" data-toggle='modal' data-target='#modal-102'><i class="glyphicon glyphicon-cog"></i> Load Application Forms</button>
                </div>
            </div>
            <div class="panel-footer">
                <h5>Application Submission Deadline: <b>
                        <?php
                        echo $deadline;
                        ?>
                    </b>
                    <button class="btn pull-right btn-xs btn-primary" data-toggle='modal' data-target='#modal-1'><i class="glyphicon glyphicon-calendar"></i> Set Deadline</button>
                </h5>
            </div>
        </div>
        <button class="btn pull-right btn-sm btn-success" data-toggle="modal" data-target="#modal-100"><i class="glyphicon glyphicon-plus"></i> Add New Question</button><br><br>
        <div class="panel panel-info">
            <div class="panel-body">
                <?php
                $count = count($kickoff);

                echo '<label class="control-label col-sm-3">Kickoff event availability</label><button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-103"><i class="glyphicon glyphicon-pencil"></i></button><br>
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

                echo '</table><legend></legend>';
                // kickoff modal
                echo '<div id="modal-103" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <form action="editform" method="POST">                     
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Kickoff Night Dates...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <div class="form-inline">
				         <label class="pull-left">Question type: </label> <u>Kickoff Night Dates</u> <br><br>
				         <div class="form-inline">
				         <label class="pull-left">Kickoff dates:</label><div class="col-md-6"><input class="form-control" name="kickoff"></div><br><br><i>Please enter possible choices as comma-separated values.</i>
				         </div><br>
				         </div>
				         </div>
				         </div><br>
				         </div>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div>';

                //generate the program of study section of application form





                echo '<div class="form-inline">
				<div class="col-sm-1"></div><label class="control-label pull-left">Program of study:</label><button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-104"><i class="glyphicon glyphicon-pencil"></i></button>						
				            <select class="form-control" name="programofstudy" >';

                $programCount = count($program);
                for($i = 0; $i < $programCount; $i++){
                    echo '<option>' . $program[$i] . '</option>';
                }

                echo ' </select></div><br>';
                // program modal
                echo '<div id="modal-104" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <form action="editform" method="POST">                     
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Programs of Study...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <div class="form-inline">
				         <label class="pull-left">Question type: </label> <u>Program of Study</u> <br><br>
				         <div class="form-inline">
				         <label class="pull-left">Programs:</label><div class="col-md-6"><input class="form-control" name="program"></div><br><br><i>Please enter possible choices as comma-separated values.</i>
				         </div><br>
				         </div>
				         </div>
				         </div><br>
				         </div>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div>';
                //questions comes in as an array holding arrays
                //each array looks like the following [format2|id2|question2|answer]
                for ($x = 0; $x < count($questions); $x++) {
                    //echo "NEW QUESTIONS ARE HERE";
                    echo '<legend></legend>';
                    // echo '<legend></legend><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                    // <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i></button>';
                    echo '<div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-20' . ($x+2) . '4" ><i class="glyphicon glyphicon-trash"></i></button>
				      <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-' . ($x+2) . '"><i class="glyphicon glyphicon-pencil"></i></button>';

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

                            //makes checkbox modal for delete
                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                            <div class="modal-dialog">
				                            <form action="editform" method="POST">
				                                <div class="modal-content">
				                                    <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                   <input type="hidden" name="year" value="' . $year . '">
				                                   <input type="hidden" name="status" value="student">
				                                   <input type="hidden" name="operation" value="delete">
				                                   <input type="hidden" name="questiontype" value="checkbox">
				                                   <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                   <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                   <input type="hidden" name="answers" value="' . $questions[$x][3] . '">
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                        <button type="submit" class="btn btn-danger">Confirm</button> 
				                                    </div>
				                                </div>
				                                </form>
				                            </div>
				                        </div>';

                            //makes checkbox modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Question...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <div class="form-inline">
				         <label class="pull-left">Question type:</label>
				         <div class="col-md-4">
				         <u>Checkbox</u>
				         </div>
				         <label class="pull-left">Tag name:</label>
				         <div class="col-md-4">
				         <u>' . $questions[$x][1] . '</u>
				         </div>
				         </div>
				         </div>
				         </div><br>
				         <form action="editform" method="POST">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <input type="hidden" name="operation" value="update">
				         <input type="hidden" name="questiontype" value="checkbox">
				         <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				         <div class="form-inline">
				         <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Answer choices:</label><div class="col-md-6"><input class="form-control" name="answers" value="' . $questions[$x][3] . '"></div><br><br><i>Please enter possible choices as comma-separated values.</i>
				         </div><br>
				         </div>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>';



                            echo '</div><br><br><br>';
                            break;

                        case "text":
                            echo '<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
				         <div class="col-md-4">
				         <input type="text" class="form-control" name="' . $questions[$x][1] . '">';

                            //makes text delete modal
                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                            <div class="modal-dialog">
				                            <form action="editform" method="POST">
				                                <div class="modal-content">
				                                    <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                   <input type="hidden" name="year" value="' . $year . '">
				                                   <input type="hidden" name="status" value="student">
				                                   <input type="hidden" name="operation" value="delete">
				                                   <input type="hidden" name="questiontype" value="text">
				                                   <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                   <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-20' . ($x+2) . '4" >Confirm</button> 
				                                    </div>
				                                </div>
				                                </form>
				                            </div>
				                        </div>';

                            //makes text modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Question...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <div class="form-inline">
				         <label class="pull-left">Question type:</label>
				         <div class="col-md-4">
				         <u>Text input</u>
				         </div>
				         <label class="pull-left">Tag name:</label>
				         <div class="col-md-4">
				         <u>' . $questions[$x][1] . '</u>
				         </div>
				         </div>
				         </div>
				         </div><br>
				         <form action="editform" method="POST">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <input type="hidden" name="operation" value="update">
				         <input type="hidden" name="questiontype" value="text">
				         <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				         <div class="form-inline">
				         <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Answer input:</label><div class="col-md-6"><input type="text" class="form-control" name="textans" value="" placeholder="Applicants will type in here" readonly></div><br>
				         </div><br>
				         </div>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </div>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div><br><br>';
                            break;

                        case "radio":
                            echo '<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><br><br><div class="col-sm-1"></div><div class="col-md-9">' .
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

                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                            <div class="modal-dialog">
				                            <form action="editform" method="POST">
				                                <div class="modal-content">
				                                    <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                   <input type="hidden" name="year" value="' . $year . '">
				                                   <input type="hidden" name="status" value="student">
				                                   <input type="hidden" name="operation" value="delete">
				                                   <input type="hidden" name="questiontype" value="radio">
				                                   <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                   <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                   <input type="hidden" name="message" value="' . $questions[$x][3] . '">
				                                    <input type="hidden" name="options" value="' . $questions[$x][4] . '">
				                                     <input type="hidden" name="choices" value="' . $questions[$x][5] . '">
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                        <button type="submit" class="btn btn-danger">Confirm</button>
				                                    </div>
				                                </div>
				                                </form>
				                            </div>
				                        </div>';

                            //makes radio modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Question...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <div class="form-inline">
				         <label class="pull-left">Question type:</label>
				         <div class="col-md-4">
				         <u>Radio button</u>
				         </div>
				         <label class="pull-left">Tag name:</label>
				         <div class="col-md-4">
				         <u>' . $questions[$x][1] . '</u>
				         </div>
				         </div>
				         </div>
				         </div><br>
				         <form action="editform" method="POST">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <input type="hidden" name="operation" value="update">
				         <input type="hidden" name="questiontype" value="radio">
				         <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				         <div class="form-inline">
				         <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Additional message:</label><div class="col-md-6"><input class="form-control" name="message" value="' . $questions[$x][3] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Choices:</label><div class="col-md-6"><input class="form-control" name="choices" value="' . $questions[$x][5] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Options:</label><div class="col-md-6"><input class="form-control" name="options" value="' . $questions[$x][4] . '">
				         </div></div><br><br>
				         </div>
				         
				         
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </div>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div>';
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

                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                            <div class="modal-dialog">
				                            <form action="editform" method="POST">
				                                <div class="modal-content">
				                                    <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                   <input type="hidden" name="year" value="' . $year . '">
				                                   <input type="hidden" name="status" value="student">
				                                   <input type="hidden" name="operation" value="delete">
				                                   <input type="hidden" name="questiontype" value="select">
				                                   <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                   <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                   <input type="hidden" name="answers" value="' . $questions[$x][3] . '">
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                        <button type="submit" class="btn btn-danger">Confirm</button>
				                                    </div>
				                                </div>
				                                </form>
				                            </div>
				                        </div>';

                            //makes dropdown modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Question...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <div class="form-inline">
				         <label class="pull-left">Question type:</label>
				         <div class="col-md-4">
				         <u>Dropdown</u>
				         </div>
				         <label class="pull-left">Tag name:</label>
				         <div class="col-md-4">
				         <u>' . $questions[$x][1] . '</u>
				         </div>
				         </div>
				         </div>
				         </div><br>
				         <form action="editform" method="POST">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <input type="hidden" name="operation" value="update">
				         <input type="hidden" name="questiontype" value="select">
				         <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				         <div class="form-inline">
				         <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Answers:</label><div class="col-md-6"><input class="form-control" name="answers" value="' . $questions[$x][3] . '"><br><i>Please enter possible choices as comma-seperated values.</i>
				         </div></div><br><br>
				         </div><br>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div>';
                            break;

                        case "textarea":
                            echo '<div class="col-sm-1"></div><label class="pull-left">' . $questions[$x][2] .
                                    '</label><br><br><div class="col-sm-1"></div><textarea rows="5" cols="130" name="' .
                                    $questions[$x][1] .  '" id="' . $questions[$x][1] .'"></textarea><br><br>';

                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                            <div class="modal-dialog">
				                            <form action="editform" method="POST">
				                                <div class="modal-content">
				                                    <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                   <input type="hidden" name="year" value="' . $year . '">
				                                   <input type="hidden" name="status" value="student">
				                                   <input type="hidden" name="operation" value="delete">
				                                   <input type="hidden" name="questiontype" value="textarea">
				                                   <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                   <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                        <button type="submit" class="btn btn-danger">Confirm</button>
				                                    </div>
				                                </div>
				                                </form>
				                            </div>
				                        </div>';

                            //makes textarea modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				         <div class="modal-dialog">
				         <div class="modal-content">
				         <div class="modal-body">
				         <div class="panel panel-info">
				         <div class="panel-heading">
				         <div class="panel-title" style="display:inline">Editing Question...</div>
				         </div>
				         <div class="panel-body">
				         <div class="row">
				         <div class=" col-md-12">
				         <div class="form-inline">
				         <label class="pull-left">Question type:</label>
				         <div class="col-md-4">
				         <u>Text area</u>
				         </div><label class="pull-left">Tag name:</label>
				         <div class="col-md-4">
				         <u>' . $questions[$x][1] . '</u>
				         </div>
				         </div>
				         </div>
				         </div><br>
				         <form action="editform" method="POST">
				         <input type="hidden" name="year" value="' . $year . '">
				         <input type="hidden" name="status" value="student">
				         <input type="hidden" name="operation" value="update">
				         <input type="hidden" name="questiontype" value="textarea">
				         <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				         <div class="form-inline">
				         <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				         </div></div><br><br>
				         <div class="form-inline">
				         <label class="pull-left">Answer input:</label><div class="col-md-6"><textarea rows="4" cols="50" placeholder=" Applicants will type in here" readonly></textarea></div><br><br><br><br><br>
				         </div>
				         </div><br>
				         <div class="modal-footer">
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save Changes</button>
				         </div>
				         </div>
				         </form>
				         </div>
				         </div>
				         </div>
				         </div>
				         </div>';
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



                            echo '<div class="modal fade" id="modal-20' . ($x+2) . '4" tabindex="-1" role="dialog">
				                                <div class="modal-dialog">
				                                <form action="editform" method="POST">
				                                    <div class="modal-content">
				                                        <div class="modal-body">Deleting the question will remove it from the application form. Are you sure you want to continue?
				                                       <input type="hidden" name="year" value="' . $year . '">
				                                       <input type="hidden" name="status" value="student">
				                                       <input type="hidden" name="operation" value="delete">
				                                       <input type="hidden" name="questiontype" value="singleRadio">
				                                       <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				                                       <input type="hidden" name="question" value="' . $questions[$x][2] . '">
				                                       <input type="hidden" name="answers" value="' . $questions[$x][3] . '">
				                                        </div>
				                                        <div class="modal-footer">
				                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                                            <button type="submit" class="btn btn-danger">Confirm</button>
				                                        </div>
				                                    </div>
				                                    </form>
				                                </div>
				                            </div>';

                            //makes radio modal
                            echo '<div id="modal-' . ($x+2) . '" class="modal" tabindex="-1" role="dialog">
				             <div class="modal-dialog">
				             <div class="modal-content">
				             <div class="modal-body">
				             <div class="panel panel-info">
				             <div class="panel-heading">
				             <div class="panel-title" style="display:inline">Editing Question...</div>
				             </div>
				             <div class="panel-body">
				             <div class="row">
				             <div class=" col-md-12">
				             <div class="form-inline">
				             <label class="pull-left">Question type:</label>
				             <div class="col-md-4">
				             <u>Radio button</u>
				             </div>
				             <label class="pull-left">Tag name:</label>
				             <div class="col-md-4">
				             <u>' . $questions[$x][1] . '</u>
				             </div>
				             </div>
				             </div>
				             </div><br>
				             <form action="editform" method="POST">
				             <input type="hidden" name="year" value="' . $year . '">
				             <input type="hidden" name="status" value="student">
				             <input type="hidden" name="operation" value="update">
				             <input type="hidden" name="questiontype" value="singleRadio">
				             <input type="hidden" name="tag" value="' . $questions[$x][1] . '">
				             <div class="form-inline">
				             <label class="pull-left">Question:</label><div class="col-md-6"><input class="form-control" name="question" value="' . $questions[$x][2] . '">
				             </div></div><br><br>
				             <div class="form-inline">
				             <label class="pull-left">Answers:</label><div class="col-md-6"><input class="form-control" name="answers" value="' . $questions[$x][3] . '"><br><i>Please enter possible choices as comma-seperated values.</i>
				             </div></div><br><br>
				             </div>
				
				
				             <div class="modal-footer">
				             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				             <button type="submit" class="btn btn-primary">Save Changes</button>
				             </div>
				             </div>
				             </div>
				             </form>
				             </div>
				             </div>
				             </div>
				             </div>
				             </div>';
                            break;

                    }
                    echo '<br>';
                }

                ?>
            </div>
        </div>
        <div id="modal-1" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="editform" method="POST">
                        <div class="modal-body">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="panel-title" style="display:inline"><b>Set deadline for application submission</b></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="hidden" name="deadline" value="<!-- grab date -->">
                                            <input type="hidden" name="year" value="2015">
                                            <input type="hidden" name="status" value="student">
                                            <label class="col-sm-3 control-label" for="date">Deadline Date</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <input type="number" class="form-control" id="date" name="dlyear" min="2015" max="2050" placeholder="YYYY" required>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="number" class="form-control" id="date" name="dlmonth" min="01" max="12" placeholder="MM" required>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="number" class="form-control" id="date" name="dlday" min="01" max="31" placeholder="DD" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            function loadQuestion(){
                var type = document.getElementById( "questiontype").value;
                if(type == "checkbox"){
                    $("#checkbox").show();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                    document.getElementById("checktag").required = true;
                    document.getElementById("checkq").required = true;
                    document.getElementById("checkans").required = true;
                }
                if(type == "text"){
                    $("#checkbox").hide();
                    $("#text").show();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();                    
                    document.getElementById("texttag").required = true;
                    document.getElementById("textq").required = true;
                }
                if(type == "radio"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").show();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                    document.getElementById("radiotag").required = true;
                    document.getElementById("radioq").required = true;
                    document.getElementById("radiomsg").required = true;
                    document.getElementById("radiooptions").required = true;
                    document.getElementById("radiochoices").required = true;
                }
                if(type == "select"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").show();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                    document.getElementById("selecttag").required = true;
                    document.getElementById("selectq").required = true;
                    document.getElementById("selectmsg").required = true;
                }
                if(type == "textarea"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").show();
                    $("#singleRadio").hide();
                    document.getElementById("textareatag").required = true;
                    document.getElementById("textareaq").required = true;
                }
                if(type == "singleRadio"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").show();
                    document.getElementById("singleradiotag").required = true;
                    document.getElementById("singleradioq").required = true;
                    document.getElementById("singleradioans").required = true;
                }
                if(type == ""){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();                    
                }}
            $(document).ready(function(){
                var type = document.getElementById( "questiontype").value;
                if(type == "checkbox"){
                    $("#checkbox").show();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                }
                if(type == "text"){
                    $("#checkbox").hide();
                    $("#text").show();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                }
                if(type == "radio"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").show();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                }
                if(type == "select"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").show();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                }
                if(type == "textarea"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").show();
                    $("#singleRadio").hide();
                }
                if(type == "singleRadio"){
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").show();
                }
                else{
                    $("#checkbox").hide();
                    $("#text").hide();
                    $("#radio").hide();
                    $("#select").hide();
                    $("#textarea").hide();
                    $("#singleRadio").hide();
                }
            });
        </script>
        <div id="modal-100" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="questionmodal" role="form" action="editform" method="POST">
                        <div class="modal-body">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="panel-title" style="display:inline"><b>Add New Question</b></div>
                                </div>
                                <div class="panel-body">
                                    <i>Identify relations by assigning the same tag to the mentor question and corresponding student question.</i>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="date">Question type:</label>
                                            <select class="form-control" id="questiontype" name="questiontype" onchange="loadQuestion()">
                                                <option value="">Select a question type:</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="text">Text input</option>
                                                <option value="radio">Radio button (table)</option>
                                                <option value="select">Dropdown</option>
                                                <option value="textarea">Text area</option>
                                                <option value="singleRadio">Single row Radio button</option>
                                                <input type="hidden" name="operation" value="add">
                                                <input type="hidden" name="year" value=" <?php echo $year ?> ">
                                                <input type="hidden" name="status" value="student">
                                            </select>
                                            <div id="checkbox">
                                                <p>CHECKBOX Tag name:<input type="text" class="form-control" id="checktag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="checkq" name="question[]"/></p>
                                                <p>Answer choices:<input type="text" class="form-control" id="checkans" name="answers[]"/><i>Please enter possible choices as comma-separated values.</i></p>
                                            </div>
                                            <div id="text">
                                                <p>TEXT Tag name:<input type="text" class="form-control" id="texttag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="textq" name="question[]"/></p>
                                                <p><input type="text" class="form-control" name="answers[]" value="" placeholder="Applicants will type in here" readonly></p>
                                            </div>
                                            <div id="radio">
                                                <p>RADIO Tag name:<input type="text" class="form-control" id="radiotag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="radioq" name="question[]"/></p>
                                                <p>Additional message:<input type="text" class="form-control" id="radiomsg" name="message"/></p>
                                                <p>Options:<input type="text" class="form-control" id="radiooptions" name="options"/></p>
                                                <p>Choices:<input type="text" class="form-control" id="radiochoices" name="choices"/></p>
                                            </div>
                                            <div id="select">
                                                <p>DROPDOWN Tag name:<input type="text" class="form-control" id="selecttag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="selectq" name="question[]"/></p>
                                                <p>Answer choices:<input type="text" class="form-control" id="selectans" name="answers[]"/><i>Please enter possible choices as comma-separated values.</i></p>
                                            </div>
                                            <div id="textarea">
                                                <p>TEXTAREA Tag name:<input type="text" class="form-control" id="textareatag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="textareaq" name="question[]"/></p>
                                                <p><textarea rows="4" cols="50" placeholder=" Applicants will type in here" readonly></textarea></p>
                                            </div>
                                            <div id="singleRadio">
                                                <p>RADIO Tag name:<input type="text" class="form-control" id="singleradiotag" name="tag[]"/></p>
                                                <p>Question:<input type="text" class="form-control" id="singleradioq" name="question[]"/></p>
                                                <p>Answer choices:<input type="text" class="form-control" id="singleradioans" name="answers[]"/><i>Please enter possible choices as comma-separated values.</i></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modal-101" class="modal fade" id="newform" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="editform" method="POST">
                        <div class="modal-body">
                            Creating a new form will replace the current application form. New questions will need to be added. Are you sure you want to continue?
                            <input type="hidden" name="operation" value="new">
                            <input type="hidden" name="year" value=" <?php echo $year ?> ">
                            <input type="hidden" name="status" value="student">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modal-102" class="modal fade" id="pastforms" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="studentform" method="POST">
                        <div class="modal-body">Specify a year:
                            <?php
                            echo '<select name="year">';
                            $count = count($years);
                            for($i = 0; $i < $count; $i++){
                                echo '<option value=" ' . $years[$i] . '"> ' . $years[$i] .'</option>';
                            }
                            echo '<input type="hidden" name="status" value="student">';
                            echo '</select>';
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Go!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
$("#questionmodal").validate(
      {
        rules: 
        {
          tag[]: 
          {
            required: true
          }
        }
      });
</script>
@endsection