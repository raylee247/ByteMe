<?php

 //   foreach($course as $c){
 //       echo $c . "<br>";
 //   }

//    foreach($careerplan as $p){
//        echo $p . "<br>";
//    }

 //   foreach($kickoff as $k){
 //       echo $k . "<br>";
 //  }

//    for ($x = 0; $x < count($variables); $x++) {
//        echo "This is question " . ($x + 1) . " ";
//        //for ($y = 0; $y < count($variables[$x]); $y++){
//            echo $variables[$x] . " ";
//        }
//        echo "<br>";
//    }

//echo $parameter;

foreach($test[0] as $t){
    echo $t . "<br>";
}
echo $test[0]['pid'] . "<br>";

echo count($test);
?>

{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
{{--<script>--}}
    {{--function loadQuestion(){--}}
        {{--var type = document.getElementById( "questiontype").value;--}}
        {{--if(type == "checkbox"){--}}
            {{--$("#checkbox").show();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "text"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").show();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "radio"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").show();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "dropdown"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").show();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "textarea"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").show();--}}
        {{--}--}}
        {{--if(type == ""){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
    {{--}}--}}
    {{--$(document).ready(function(){--}}
        {{--var type = document.getElementById( "questiontype").value;--}}
        {{--if(type == "checkbox"){--}}
            {{--$("#checkbox").show();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "text"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").show();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "radio"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").show();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "dropdown"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").show();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
        {{--if(type == "textarea"){--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").show();--}}
        {{--}--}}
        {{--else{--}}
            {{--$("#checkbox").hide();--}}
            {{--$("#text").hide();--}}
            {{--$("#radio").hide();--}}
            {{--$("#dropdown").hide();--}}
            {{--$("#textarea").hide();--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}

{{--<div id="modal-7" class="modal" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<form action="mentorform" method="POST">--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="panel panel-info">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<div class="panel-title" style="display:inline"><b>Add new question</b></div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<div class="row">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-sm-3 control-label" for="date">Question type:</label>--}}
                                    {{--<select class="form-control" id="questiontype" name="questiontype" onchange="loadQuestion()">--}}
                                        {{--<option value="">Select a question type:</option>--}}
                                        {{--<option value="checkbox">Checkbox</option>--}}
                                        {{--<option value="text">Text input</option>--}}
                                        {{--<option value="radio">Radio button</option>--}}
                                        {{--<option value="dropdown">Dropdown</option>--}}
                                        {{--<option value="textarea">Text area</option>--}}
                                    {{--</select>--}}

                                    {{--<div id="checkbox">--}}
                                        {{--<p>CHECKBOX Tag name:<input type="text" class="form-control" id="tag"/></p>--}}
                                        {{--<p>Question:<input type="text" class="form-control" id="question"/></p>--}}
                                        {{--<p>Answer choices:<input type="text" class="form-control" id="answers"/><i>Please enter possible choices as comma-separated values.</i></p>--}}
                                    {{--</div>--}}

                                    {{--<div id="text">--}}
                                        {{--<p>TEXT Tag name:<input type="text" class="form-control" id="tag"/></p>--}}
                                        {{--<p>Question:<input type="text" class="form-control" id="question"/></p>--}}
                                        {{--<p><input type="text" class="form-control" name="textans" value="" placeholder="Applicants will type in here" readonly></p>--}}
                                    {{--</div>--}}

                                    {{--<div id="radio">--}}
                                        {{--<p>RADIO Tag name:<input type="text" class="form-control" id="tag"/></p>--}}
                                        {{--<p>Question:<input type="text" class="form-control" id="question"/></p>--}}
                                        {{--<p>Additional message:<input type="text" class="form-control" id="message"/></p>--}}
                                        {{--<p>Options:<input type="text" class="form-control" id="options"/></p>--}}
                                        {{--<p>Choices:<input type="text" class="form-control" id="choices"/></p>--}}
                                    {{--</div>--}}

                                    {{--<div id="dropdown">--}}
                                        {{--<p>DROPDOWN Tag name:<input type="text" class="form-control" id="tag"/></p>--}}
                                        {{--<p>Question:<input type="text" class="form-control" id="question"/></p>--}}
                                        {{--<p>Answer choices:<input type="text" class="form-control" id="answers"/><i>Please enter possible choices as comma-separated values.</i></p>--}}
                                    {{--</div>--}}

                                    {{--<div id="textarea">--}}
                                        {{--<p>TEXTAREA Tag name:<input type="text" class="form-control" id="tag"/></p>--}}
                                        {{--<p>Question:<input type="text" class="form-control" id="question"/></p>--}}
                                        {{--<p><textarea rows="4" cols="50" placeholder=" Applicants will type in here" readonly></textarea></p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--//TODO:save to db--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="submit" class="btn btn-primary">Save Changes//todo: implement functionality</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}