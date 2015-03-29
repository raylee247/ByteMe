@extends('app')

@section('content')

@if (Session::has('flash_message'))
    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
@endif

<div class="panel panel-default">
  <div class="panel-body">
    <div>    
        <div class="col-xs-8 col-xs-offset-2">
            <form action="waitlist" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group"> 
                  <input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
                  <span class="input-group-btn">
                    <button class="btn btn-default" name="search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
</div>

<br>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr> TODO // implement MOVE TO PARTICIPANT function + SEARCH FUNCTION + FILL IN DATATABLE + IMPLEMENT DB QUERY <br> + PARTICIPANT INFO PROFILE (figure out whether participant is mentor/student and displaying accordingly)
                <th>First Name</th>
                <th>Last name</th>
                <th>Email</th>               
            </tr>
        </thead>
 <!-- PLACEHOLDER DATA FOR TABLE QUERY -->
        <tbody>
            <?php
                foreach($result as $single_result) 
                {
                    echo "<tr class='waitlisttable' data-toggle='modal' data-target='#modal-1'><td>"; 
                    print_r($single_result['First name']);
                    echo "</td>";
                    echo "<td>"; 
                    print_r($single_result['Family name']);
                    echo "</td>";
                    echo "<td>"; 
                    print_r($single_result['email']);
                    echo "</td>";
                    // echo "<td><p data-placement='top' data-toggle='tooltip' title='Move to Participants'><button class='btn btn-danger btn-xs' data-title='Move' data-toggle='modal' data-target='#move' ><span class='glyphicon glyphicon-flag'></span></button></p></td>";             
               
                    echo "<td>";
                    echo "<form method='post' action='toParticipantPool'>";
                    echo "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                    echo "<span class='input-group-btn'>";
                    echo "<span class='btn btn-primary btn-file'>";
                    echo "<span class='glyphicon glyphicon-flag' aria-hidden='true'></span>";
                    echo "<input type='hidden' name='participant_email_to_pp' value=".$single_result['email'].">";
                    echo "<input type='submit' value='Move to Participant Pool' name='move_to_participant_pool'>";
                    echo "</span>";
                    echo "</span>";
                    echo "</div>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</div>
</div>

<!-- <div class="modal fade" id="move" tabindex="-1" role="dialog" aria-labelledby="moveLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-body">Moving this participant will add them to the program. Would you like to continue?</div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary">Confirm</button>
  </div>
</div>
</div>
</div> -->

<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

@endsection