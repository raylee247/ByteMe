@extends('app')
@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<b>Mentor Application Form</b>
		<button class="btn pull-right btn-xs btn-primary" data-toggle="modal" data-target="#modal-7">Add new question</button>
		<button class="btn pull-right btn-xs btn-primary" data-toggle="modal" data-target="#modal-8">Create new form</button>
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
				<button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i></button>
				<div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-6">';
				echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="" checked="checked" style="display:none">';
                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                        $answer = explode("," , $rawAnswer);
                        $answerCount = count($answer);
                        for ($i = 0; $i < $answerCount; $i++){
                        	echo '<input type="checkbox" name="' . $questions[$x][1] . '[]" value="' . $answer[$i] . '">' . $answer[$i] . '<br>';
                        }

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
                        <form action="mentorform" method="POST">
                        <input type="hidden" name="status" value="mentor">
                        <input type="hidden" name="operation" value="update">                        
                        <div class="form-inline">
                        <label class="pull-left">Question:</label><div class="col-md-6"><div class="form-control" name="checkboxquest" value="" contenteditable>' . $questions[$x][2] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Answer choices:</label><div class="col-md-6"><div class="form-control" name="checkboxans" value="" contenteditable>' . $questions[$x][3] . '</div></div><br><br><i>Please enter possible choices as comma-separated values.</i>
                        </div><br>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>';

                        echo '</div><br><br><br>';
                        break;

                        case "text":
                        echo '<div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                        <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-3"><i class="glyphicon glyphicon-pencil"></i></button>
                        <div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="' . $questions[$x][1] . '">
                        </div>';
                        echo '<div id="modal-3" class="modal" tabindex="-1" role="dialog">
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
                        </div><br>
                        <form action="mentorform" method="POST">
                        <input type="hidden" name="status" value="mentor">
                        <input type="hidden" name="operation" value="update"> 
                        <div class="form-inline">
                        <label class="pull-left">Question:</label><div class="col-md-6"><div class="form-control" name="textquest" value="" contenteditable>' . $questions[$x][2] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Answer input:</label><div class="col-md-6"><input type="text" class="form-control" name="textans" value="" placeholder="Applicants will type in here" readonly></div><br>
                        </div><br>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div><br><br>';
                        break;

                        case "radio":
                        echo '<div class="form-inline"><div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                        <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-4"><i class="glyphicon glyphicon-pencil"></i></button><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '</label><div class="col-md-9">' .
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
                        echo '<div id="modal-4" class="modal" tabindex="-1" role="dialog">
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
                        <form action="mentorform" method="POST">
                        <input type="hidden" name="status" value="mentor">
                        <input type="hidden" name="operation" value="update"> 
                        <div class="form-inline">
                        <label class="pull-left">Question:</label><div class="col-md-6"><div class="form-control" name="radioquest" value="" contenteditable>' . $questions[$x][2] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Additional message:</label><div class="col-md-6"><div class="form-control" name="radioans" value="" contenteditable>' . $questions[$x][3] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Choices:</label><div class="col-md-6"><div class="form-control" name="radiochoices" value="" contenteditable>' . $questions[$x][5] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Options:</label><div class="col-md-6"><div class="form-control" name="radiooptions" value="" contenteditable>' . $questions[$x][4] . '</div>
                        </div></div><br><br>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                        break;

                    case "select": //this is dropdown
                    echo '<div class="form-inline"><div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                    <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-5"><i class="glyphicon glyphicon-pencil"></i></button><div class="col-sm-1"></div><label class="control-label pull-left">' . $questions[$x][2] . '<br></label>
                    <div class="col-md-4"><select class="form-control" name="' . $questions[$x][1] . '" >';
                        $rawAnswer = $questions[$x][3]; //answers as a string comma seperated
                        $answer = explode("," , $rawAnswer);
                        $answerCount = count($answer);
                        for($i = 0; $i < $answerCount; $i++){
                        	echo '<option>' . $answer[$i] . '</option>';
                        }
                        echo '</select></div><br>';
                        echo '<div id="modal-5" class="modal" tabindex="-1" role="dialog">
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
                        <form action="mentorform" method="POST">
                        <input type="hidden" name="status" value="mentor">
                        <input type="hidden" name="operation" value="update"> 
                        <div class="form-inline">
                        <label class="pull-left">Question:</label><div class="col-md-6"><div class="form-control" name="selectquest" value="" contenteditable>' . $questions[$x][2] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Answer choices:</label><div class="col-md-6"><div class="form-control" name="selectans" value="" contenteditable>' . $questions[$x][3] . '</div></div><br><br><i>Please enter possible choices as comma-separated values.</i>
                        </div><br>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                        break;

                        case "textarea":
                        echo '<div class="col-sm-1"></div><div class="form-inline"><button type="submit" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i></button>
                        <button type="submit" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-6"><i class="glyphicon glyphicon-pencil"></i></button>
                        <label class="pull-left">' . $questions[$x][2] . '</label><br><br>
                        <div class="col-sm-1"></div>
                        <textarea rows="5" cols="130" name="' . $questions[$x][1] .  '" id="' . $questions[$x][1] .'"></textarea><br>
                        <br>';
                        echo '<div id="modal-6" class="modal" tabindex="-1" role="dialog">
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
                        <form action="mentorform" method="POST">
                        <input type="hidden" name="status" value="mentor">
                        <input type="hidden" name="operation" value="update"> 
                        <div class="form-inline">
                        <label class="pull-left">Question:</label><div class="col-md-6"><div class="form-control" name="textareaquest" value="" contenteditable>' . $questions[$x][2] . '</div>
                        </div></div><br><br>
                        <div class="form-inline">
                        <label class="pull-left">Answer input:</label><div class="col-md-6"><textarea rows="4" cols="50" placeholder=" Applicants will type in here" readonly></textarea></div><br><br><br><br><br>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
                        </div>
                        </form>
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
        			<form action="mentorform" method="POST">
        				<div class="modal-body">
        					<div class="panel panel-info">
        						<div class="panel-heading">
        							<div class="panel-title" style="display:inline"><b>Set deadline for application submission</b></div>
        						</div>
        						<div class="panel-body">
        							<div class="row">
        								<div class="form-group">
        									<input type="hidden" name="deadline" value="<!-- grab date -->">
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
        					<button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
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
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "text"){
                $("#checkbox").hide();
                $("#text").show();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "radio"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").show();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "dropdown"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").show();
                $("#textarea").hide();
            }
            if(type == "textarea"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").show();
            }
            if(type == ""){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").hide();
            }}
        $(document).ready(function(){
            var type = document.getElementById( "questiontype").value;
            if(type == "checkbox"){
                $("#checkbox").show();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "text"){
                $("#checkbox").hide();
                $("#text").show();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "radio"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").show();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
            if(type == "dropdown"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").show();
                $("#textarea").hide();
            }
            if(type == "textarea"){
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").show();
            }
            else{
                $("#checkbox").hide();
                $("#text").hide();
                $("#radio").hide();
                $("#dropdown").hide();
                $("#textarea").hide();
            }
        });
    </script>

        <div id="modal-7" class="modal" tabindex="-1" role="dialog">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<form action="mentorform" method="POST">
        				<div class="modal-body">
        					<div class="panel panel-info">
        						<div class="panel-heading">
        							<div class="panel-title" style="display:inline"><b>Add new question</b></div>
        						</div>
        						<div class="panel-body">
        							<div class="row">
        								<div class="form-group">
        									<label class="col-sm-3 control-label" for="date">Question type:</label>
                                            <select class="form-control" id="questiontype" name="questiontype" onchange="loadQuestion()">
        										<option value="">Select a question type:</option>
        										<option value="checkbox">Checkbox</option>
        										<option value="text">Text input</option>
        										<option value="radio">Radio button</option>
        										<option value="dropdown">Dropdown</option>
        										<option value="textarea">Text area</option>
        									</select>

        									<div id="checkbox">
        										<p>CHECKBOX Tag name:<input type="text" class="form-control" name="tag[]"/></p>
        										<p>Question:<input type="text" class="form-control" name="question[]"/></p>
        										<p>Answer choices:<input type="text" class="form-control" name="answers[]"/><i>Please enter possible choices as comma-separated values.</i></p>
        									</div>

        									<div id="text">
        										<p>TEXT Tag name:<input type="text" class="form-control" name="tag[]"/></p>
        										<p>Question:<input type="text" class="form-control" name="question[]"/></p>
        										<p><input type="text" class="form-control" name="textans" value="" placeholder="Applicants will type in here" readonly></p>
        									</div>

        									<div id="radio">
        										<p>RADIO Tag name:<input type="text" class="form-control" name="tag[]"/></p>
        										<p>Question:<input type="text" class="form-control" name="question[]"/></p>
        										<p>Additional message:<input type="text" class="form-control" name="message"/></p>
        										<p>Options:<input type="text" class="form-control" name="options"/></p>
        										<p>Choices:<input type="text" class="form-control" name="choices"/></p>
        									</div>

        									<div id="dropdown">
        										<p>DROPDOWN Tag name:<input type="text" class="form-control" name="tag[]"/></p>
        										<p>Question:<input type="text" class="form-control" name="question[]"/></p>
        										<p>Answer choices:<input type="text" class="form-control" name="answers[]"/><i>Please enter possible choices as comma-separated values.</i></p>
        									</div>

        									<div id="textarea">
        										<p>TEXTAREA Tag name:<input type="text" class="form-control" name="tag[]"/></p>
        										<p>Question:<input type="text" class="form-control" name="question[]"/></p>
        										<p><textarea rows="4" cols="50" placeholder=" Applicants will type in here" readonly></textarea></p>
        									</div>
        								</div>
        							</div>
        						</div>
        					</div>
        				</div>
        				<div class="modal-footer">
        					//TODO:save to db
        					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        					<button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>
        				</div>
        			</form>
        		</div>
        	</div>
        </div>

        <div id="modal-8" class="modal fade" id="newform" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-body">Creating a new form will replace the current application form. New questions will need to be added. Are you sure you want to continue?</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        				<button type="button" class="btn btn-success">Confirm</button> // TODO : clear application form from db
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