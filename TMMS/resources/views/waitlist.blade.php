@extends('app')

@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <div>    
        <div class="col-xs-8 col-xs-offset-2">
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Junior students</a></li>
                      <li><a href="#">Senior students</a></li>
                      <li><a href="#">All students</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Mentors</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="text" placeholder="Search with name, student number, CS ID or email">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
	</div>
<br>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr> TODO // implement MOVE TO PARTICIPANT function + SEARCH FUNCTION + FILL IN DATATABLE + IMPLEMENT DB QUERY <br> + PARTICIPANT INFO PROFILE (figure out whether participant is mentor/student and displaying accordingly)
                <th>First Name</th>
                <th>Last name</th>
                <th>Student Number</th>
                <th>CS ID</th>
                <th>Year Standing</th>
                <th>Email</th>               
            </tr>
        </thead>
 <!-- PLACEHOLDER DATA FOR TABLE QUERY -->
        <tbody>
            <tr> 
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td><p data-placement="top" data-toggle="tooltip" title="Move to Participants"><button class="btn btn-danger btn-xs" data-title="Move" data-toggle="modal" data-target="#move" ><span class="glyphicon glyphicon-flag"></span></button></p></td> 
            </tr>
        </tbody>
    </table>

</div>
</div>

<div class="modal fade" id="move" tabindex="-1" role="dialog" aria-labelledby="moveLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-body">Moving this participant will add them to the program. Would you like to continue?</div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary">Confirm</button> // TODO : move participant from waitlist to participant for db
  </div>
</div>
</div>
</div>


<!-- if waitlisted person is mentor, display this profile -->
<div class="modal fade" id="mentor" tabindex="-1" role="dialog" aria-labelledby="mentorLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-body">
    <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title" style="display:inline">NAME</div>
          <a data-original-title="Edit user information" data-toggle="tooltip" type="button" data-placement="bottom" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
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
                            <td>Phone Number</td>
                            <td>$number<br><br>$othernumber</td>
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
                            <td>Preference of mentee gender</td>
                            <td>$menteepreference</td>
                        </tr>
                        <tr>
                            <td>Kickoff night availability</td>
                            <td>$kickoffdate</td>
                        </tr>
                        <tr>
                            <td>Previous participation</td>
                            <td>$participation</td>
                        </tr>
                        <tr>
                            <td>Current employment</td>
                            <td>$employment</td>
                        </tr>
                        <tr>
                            <td>Years of CS-related work</td>
                            <td>$yearsofCSwork</td>
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
                            <td>UBC alumnae/alumnus</td>
                            <td>$alumnus</td>
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
        <a data-original-title="View email history" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
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

<!-- if waitlisted person is student, display this profile -->
<div class="modal fade" id="student" tabindex="-1" role="dialog" aria-labelledby="studentLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
        <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title" style="display:inline">NAME</div>
              <a data-original-title="Edit user information" data-toggle="tooltip" type="button" data-placement="bottom" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
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
                                <td>$number<br><br>$othernumber</td>
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
            <a data-original-title="View email history" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
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









<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

@endsection