@extends('app')

@section('content')

<style type="text/css">
.panel-info {
    margin-right: 0px;
}
</style>

<div class="panel panel-default">
  <div class="panel-body">
    <div>    
        <div class="col-xs-8 col-xs-offset-2">
            <form action="mentors" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="input-group">
                      <input type="hidden" name="search_param" value="all" id="search_param">         
                      <input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
        </form>
    </div>
</div>
<br>
<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr> TODO // SEARCH FUNCTION + FILL IN DATATABLE + IMPLEMENT DB QUERY + PARTICIPANT INFO PROFILE<br>
            TODO// participant info - implement jquery to display row data when selected and DB query, implement buttons functionality
            <th>First Name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Job</th>
            <th>Years of Computer Science</th>
            <th>Education Level</th>
            <th>Field of Interest</th>
        </tr>
    </thead>
    <!-- PLACEHOLDER DATA FOR TABLE QUERY -->
    <tbody>
        <?php
            foreach($result as $single_result) {
                echo "<tr class='studenttable' data-toggle='modal' data-id='1' data-target='#orderModal'><td>"; 
                print_r($single_result['First name']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['Family name']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['email']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['job']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['yearofcs']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['edulvl']);
                echo "</td>";
                echo "<td>"; 
                print_r($single_result['field of interest']);
                echo "</td></tr>";
            }
            ?>
    </tbody>
</table>
</div>
</div>

<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
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

<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection