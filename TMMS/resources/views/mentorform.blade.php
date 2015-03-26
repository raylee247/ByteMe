@extends('app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <b>Mentor Application Form</b>
            <!-- <button class="btn pull-right btn-xs btn-primary" data-target="#modal-1"><i class="glyphicon glyphicon-pencil"></i> Edit Form</button> -->
        </div>
        <div class="panel-footer">
            <h5>Application Submission Deadline: <b>September 25, 2015 at 11:59:59 PM //TODO: update this value</b>
                <button class="btn pull-right btn-xs btn-primary" data-toggle='modal' data-target='#modal-1'><i class="glyphicon glyphicon-calendar"></i> Set Deadline</button>
            </h5>
        </div>
        <div class="panel-body">
            <?php
            //questions comes in as an array holding arrays
            //each array looks like the following [format2|id2|question2|answer]
            for ($x = 0; $x < count($questions); $x++) {
                //echo "NEW QUESTIONS ARE HERE";
                echo '<legend></legend>';
                // echo '<legend></legend><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                // <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i></button>';


                switch($questions[$x][0]){

                    case "checkbox":
                        echo '<div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                             <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-1"><i class="glyphicon glyphicon-pencil"></i></button>
                            <div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-6">';
                        echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="" checked="checked" style="display:none">';
                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                        $answer = explode("," , $rawAnswer);
                        $answerCount = count($answer);
                        for ($i = 0; $i < $answerCount; $i++){
                            echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="' . $answer[$i] . '">' . $answer[$i] . '<br>';
                        }

                        echo '<div id="modal-1" class="modal" tabindex="-1" role="dialog">
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
                                          <div class="col-md-6">
                                              <select class="form-control" name="questiontype">
                                              // option is "selected" depending on the question type clicked
                                                  <option>Checkbox</option>
                                                  <option>Radio button</option>
                                                  <option>Dropdown</option>
                                                  <option>Text input</option>
                                                  <option>Text area</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                            </div>
                            <b>Question:</b><div id="input" contenteditable>' . $questions[$x][2] . '</div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>';

                        echo '</div><br><br><br>';
                        break;

                    case "text":
                        echo '<div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                              <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i></button>
                              <div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
                              <div class="col-md-4">
                              <input type="text" class="form-control" name="' . $questions[$x][1] . '">
			                  </div>';
                        echo '<div id="modal-2" class="modal" tabindex="-1" role="dialog">
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
                                          <div class="col-md-6">
                                              <select class="form-control" name="questiontype">
                                              // option is "selected" depending on the question type clicked
                                                  <option>Checkbox</option>
                                                  <option>Radio button</option>
                                                  <option>Dropdown</option>
                                                  <option selected>Text input</option>
                                                  <option>Text area</option>
                                              </select>
                                          </div>
                                      </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div><br><br>';
                        break;

                    case "radio":
                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-9">' .
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
                            for($j = 0; $j < $answerCount; $j++){
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
                        echo '<div id="modal-2" class="modal" tabindex="-1" role="dialog">
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
                                      <div class="col-md-6">
                                          <select class="form-control" name="questiontype">
                                          // option is "selected" depending on the question type clicked
                                              <option>Checkbox</option>
                                              <option selected>Radio button</option>
                                              <option>Dropdown</option>
                                              <option>Text input</option>
                                              <option>Text area</option>

                                          </select>
                                      </div>
                                  </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                        break;

                    case "select": //this is dropdown
                        echo '<div class="form-inline"><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '<br></label>
			                <div class="col-md-4"><select class="form-control" name="' . $questions[$x][1] . '" >';
                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                        $answer = explode("," , $rawAnswer);
                        $answerCount = count($answer);
                        for($i = 0; $i < $answerCount; $i++){
                            echo '<option>' . $answer[$i] . '</option>';
                        }
                        echo '</select></div><br>';
                        echo '<div id="modal-2" class="modal" tabindex="-1" role="dialog">
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
                                          <div class="col-md-6">
                                              <select class="form-control" name="questiontype">
                                              // option is "selected" depending on the question type clicked
                                                  <option>Checkbox</option>
                                                  <option>Radio button</option>
                                                  <option selected>Dropdown</option>
                                                  <option>Text input</option>
                                                  <option>Text area</option>
                                              </select>
                                          </div>
                                      </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>';
                        break;

                    case "textarea":
                        echo '<div class="col-sm-1"></div>
                            <label class="pull-left">' . $questions[$x][2] . '</label><br><br>
                            <div class="col-sm-1"></div>
                            <textarea rows="5" cols="130" name="' . $questions[$x][1] .  '" id="' . $questions[$x][1] .'"></textarea><br>
                            <br>';
                        echo '<div id="modal-2" class="modal" tabindex="-1" role="dialog">
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
                                              <div class="col-md-6">
                                                  <select class="form-control" name="questiontype">
                                                  // option is "selected" depending on the question type clicked
                                                      <option>Checkbox</option>
                                                      <option>Radio button</option>
                                                      <option>Dropdown</option>
                                                      <option>Text input</option>
                                                      <option selected>Text area</option>
                                                  </select>
                                              </div>
                                          </div>
                                </div>
                                </div>
                                </div>
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