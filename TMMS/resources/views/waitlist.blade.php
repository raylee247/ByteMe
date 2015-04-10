@extends('app')

@section('content')

@if (Session::has('flash_message'))
    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
@endif

<style type="text/css">
.table {
  white-space:normal;
}
tr {
  cursor: pointer;
}
#waitlist {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  width: 100%;
  border-collapse: collapse;
}

#waitlist td, #waitlist th {
  font-size: 1em;
  border: 1px solid #9191B5;
  padding: 3px 7px 2px 7px;
}

#waitlist th {
  font-size: 1.1em;
  text-align: left;
  padding-top: 5px;
  padding-bottom: 4px;
  background-color: #1A5690;
  color: #ffffff;
}

#waitlist tr.alt td {
  color: #000000;
  background-color: #66CCFF;
}
</style>

<div class="content">
<div class="panel panel-info">
    <div class="panel-heading">
        <b>Viewing Waitlisted Participants</b>
    </div>
  <div class="panel-body">
    <div>    
        <div class="col-xs-8 col-xs-offset-2">
            <form action="waitlist" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group"> 
                  <input type="text" class="form-control" name="text" <?php if(isset($text)) {echo 'value="'.$text.'"';} else {echo 'placeholder="Search with name, email, student number or CS ID"'; }?>>
                  <span class="input-group-btn">
                    <button class="btn btn-default" name="search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
</div>

<br><br><br>
<table id="waitlist" class="table table-striped table-bordered table-hover">
        <thead>
            <tr> 
                <th>First Name</th>
                <th>Last name</th>
                <th>Email</th>      
                <th>Move To...</th>         
            </tr>
        </thead>
 <!-- PLACEHOLDER DATA FOR TABLE QUERY -->
        <tbody>
            <?php
                $i = 0; 
                foreach($result as $single_result) 
                {
                  $array[$i] = $result[$i]['pid'];
                  $i++; 

                    echo "<tr id='clickable' href='participant'><td>"; 
                    print_r($single_result['First name']);
                    echo "</td>";
                    echo "<td>"; 
                    print_r($single_result['Family name']);
                    echo "</td>";
                    echo "<td>"; 
                    print_r($single_result['email']);
                    echo "</td>";
                    echo "<td>";
                    if ($single_result['waitlist'] == 1) {
                      echo "<form method='post' action='toParticipantPool'>";
                      echo "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                      echo "<input type='hidden' name='participant_email_to_pp' value=".$single_result['email'].">";
                      echo "<button type='submit' class='btn btn-xs btn-primary' data-toggle='tooltip' data-placement='top' title='Move to Participant Pool'><span class='glyphicon glyphicon-flag' aria-hidden='true'></span> Move to Participant Pool</button>";
                      echo "</form>";
                    }
                    else {
                      echo "<form method='post' action='toWaitlistPool'>";
                      echo "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                      echo "<input type='hidden' name='participant_email_to_wl' value=".$single_result['email'].">";
                      echo "<button type='submit' class='btn btn-xs btn-danger' data-toggle='tooltip' data-placement='top' title='Move to Participant Pool'><span class='glyphicon glyphicon-flag' aria-hidden='true'></span> Move to Waitlist Pool</button>";
                      echo "</form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
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

<script>
$(document).ready(function(){
  $('tbody tr td:not(:last-child)').click(function(){
          // index of row clicked 
          var row = ($(this).parent().index());
          
          // actual pid of the participant 
          var myvar = <?php
          if (!isset($array)) {
            echo "do nothing";
          }
          else {
            echo json_encode($array);
          }
          ?>;
          window.location.href = "participant" + "/" + myvar[row];
          return false;
        });
});
</script>

@endsection