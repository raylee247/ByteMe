@extends('app')

@section('content')

<style type="text/css">
.panel-info {
    margin-right: 0px;
}
</style>

<br>

<table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <?php
    print_r($participant_result[0]['email']);
?>
                                </td>
                            </tr>
                            <tr>
                                <td>Student number</td>
                                <td>$studentnum</td>
                            </tr>
                            <tr>
                                <td>CS ID</td>
                                <td>$csid</td>
                            </tr>                            
                            <tr>
                                <td>Phone Number</td>
                                <td>$number<br>$othernumber</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>$gender</td>
                            </tr>
                            <tr>
                                <td>Year of Birth</td>
                                <td>$birthyear</td>
                            </tr>
                            <tr>
                                <td>Kickoff night availability</td>
                                <td>$kickoffdate</td>
                            </tr>
                            <tr>
                                <td>Kickoff availability comments</td>
                                <td>$kickoffcomments</td>
                            </tr>                            
                            <tr>
                                <td>Preference of mentor gender</td>
                                <td>$mentorpreference</td>
                            </tr>                 
                            <tr>
                                <td>Program of study</td>
                                <td>$programofstudy</td>
                            </tr>
                            <tr>
                                <td>Year of study</td>
                                <td>$yearofstudy</td>
                            </tr>
                            <tr>
                                <td>Courses completed</td>
                                <td>$course</td>
                            </tr>
                            <tr>
                                <td>Previous participation</td>
                                <td>$participation</td>
                            </tr>     
                            <tr>
                                <td>Co-op status</td>
                                <td>$coop</td>
                            </tr>                              
                            <tr>
                                <td>Future career plans</td>
                                <td>$careerplan</td>
                            </tr> 
                            <tr>
                                <td>CS areas of interest</td>
                                <td>$CSinterests</td>
                            </tr>                            
                            <tr>
                                <td>Hobbies and interests</td>
                                <td>$hobbies</td>
                            </tr>                                
                            <tr>
                                <td>Additional comments or questions</td>
                                <td>$additionalcomments</td>
                            </tr>
                        </tbody>
                    </table>

<div id="modal-1" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title" style="display:inline">NAME</div>
              <button class="btn btn-sm btn-primary" data-original-title="Edit user information" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
              <a data-original-title="Move to waitlist" data-toggle="tooltip" type="button" data-placement="bottom" class="btn pull-right btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i></a>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class=" col-md-12"> 
                      <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Email</td>
                                <td>$email</a></td>
                            </tr>
                            <tr>
                                <td>Student number</td>
                                <td>$studentnum</td>
                            </tr>
                            <tr>
                                <td>CS ID</td>
                                <td>$csid</td>
                            </tr>                            
                            <tr>
                                <td>Phone Number</td>
                                <td>$number<br>$othernumber</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>$gender</td>
                            </tr>
                            <tr>
                                <td>Year of Birth</td>
                                <td>$birthyear</td>
                            </tr>
                            <tr>
                                <td>Kickoff night availability</td>
                                <td>$kickoffdate</td>
                            </tr>
                            <tr>
                                <td>Kickoff availability comments</td>
                                <td>$kickoffcomments</td>
                            </tr>                            
                            <tr>
                                <td>Preference of mentor gender</td>
                                <td>$mentorpreference</td>
                            </tr>                 
                            <tr>
                                <td>Program of study</td>
                                <td>$programofstudy</td>
                            </tr>
                            <tr>
                                <td>Year of study</td>
                                <td>$yearofstudy</td>
                            </tr>
                            <tr>
                                <td>Courses completed</td>
                                <td>$course</td>
                            </tr>
                            <tr>
                                <td>Previous participation</td>
                                <td>$participation</td>
                            </tr>     
                            <tr>
                                <td>Co-op status</td>
                                <td>$coop</td>
                            </tr>                              
                            <tr>
                                <td>Future career plans</td>
                                <td>$careerplan</td>
                            </tr> 
                            <tr>
                                <td>CS areas of interest</td>
                                <td>$CSinterests</td>
                            </tr>                            
                            <tr>
                                <td>Hobbies and interests</td>
                                <td>$hobbies</td>
                            </tr>                                
                            <tr>
                                <td>Additional comments or questions</td>
                                <td>$additionalcomments</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a data-original-title="View reports" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-file"></i></a>
            <span class="pull-right">
                <a data-original-title="Delete participant" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
            </span>
        </div>
    </div>    
</div>
</div>
</div>
</div>

<div id="modal-2" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title" style="display:inline">NAME</div>
              <button class="btn btn-sm btn-primary" data-original-title="Edit user information" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class=" col-md-12"> 
                      <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Email// TODO: grab info from previous page</td> 
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Student number</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>CS ID</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>                            
                            <tr>
                                <td>Phone Number</td>
                                <td><div id="input" contenteditable></div><br><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Year of Birth</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Kickoff night availability</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Kickoff availability comments</td>
                                <td><div id="textarea" contenteditable></div></td>
                            </tr>                            
                            <tr>
                                <td>Preference of mentor gender</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>                 
                            <tr>
                                <td>Program of study</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Year of study</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Courses completed</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>
                            <tr>
                                <td>Previous participation</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>     
                            <tr>
                                <td>Co-op status</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr>                              
                            <tr>
                                <td>Future career plans</td>
                                <td><div id="input" contenteditable></div></td>
                            </tr> 
                            <tr>
                                <td>CS areas of interest</td>
                                <td><div id="textarea" contenteditable></div></td>
                            </tr>                            
                            <tr>
                                <td>Hobbies and interests</td>
                                <td><div id="textarea" contenteditable></div></td>
                            </tr>                                
                            <tr>
                                <td>Additional comments or questions</td>
                                <td><div id="textarea" contenteditable></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes //TODO:save to db</button>

</div>
</div>
</div>
</div>

<!-- move to app.css -->
<style type="text/css">
textarea {
    height: 28px;
    width: 400px;
}

#textarea {
    -moz-appearance: textfield-multiline;
    -webkit-appearance: textarea;
    border: 1px solid gray;
    font: medium -moz-fixed;
    font: -webkit-small-control;
    height: 4em;
    overflow: auto;
    padding: 2px;
    resize: both;
    width: 225px;
    white-space: normal;
}

input {
    margin-top: 5px;
    width: 400px;
}

#input {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
    background-color: white;
    background-color: -moz-field;
    border: 1px solid darkgray;
    box-shadow: 1px 1px 1px 0 lightgray inset;  
    font: -moz-field;
    font: -webkit-small-control;
    margin-top: 5px;
    padding: 2px 3px;
    width: 225px;    
    white-space: normal;
}
</style>

@endsection