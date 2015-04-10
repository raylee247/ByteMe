@extends('app')

@section('content')

<style type="text/css">
.main { 
  overflow-x: scroll; 
}
.content{
  display: table;
/*  overflow-x: visible;*/
}
    .table {
    white-space:normal;
    word-wrap: break-word;
/*    max-width: 40%;*/
/*table-layout:fixed;*/
    }

</style>
<div class="content">
<div class="panel panel-info">
	<div class="panel-heading"><b>Saved Match Results</b></div>
	<div class="panel-body">
		<legend>
			<h5>
				Saved Matchings 
			</h5>
		</legend>
			<table id="savedmatches" class="table table-striped table-bordered table-hover" cellspacing="0">
				<thead>
					<tr> 
						<th>Name of Matching</th>
            <th>Matching ID </th>
            <th>Must List</th>
            <th>Priority List</th>
						<th>Average Satisfaction Rate</th>
            <th>Year</th>
					</tr>
				</thead>
				<tbody>
          <?php 
          if(isset($Response)){
            foreach ($Response as $index => $result) {
              echo "<tr>";
              echo "<td>" . $result['name'] . '<button class="btn pull-right btn-xs btn-primary" data-toggle="modal" data-target="#rename-'.$result['wid'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>';
              echo "<td>" . $result['wid'] . "</td>";
              echo "<td>" . $result['must'] . "</td>";
              echo "<td>" . $result['helpful'] . "</td>";
              echo "<td>" . $result['avgSat'] . "</td>";
              echo "<td>" . $result['year'] . "</td>";
              if($result['setAsFinal'] == 0){
                echo '<td id="finalbutton"><center><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#final-'.$result['wid'].'">Set as Final Matching</button></center></th>';
                echo '<td id="deletebutton"><center><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#remove-'.$result['wid'].'"><span class="glyphicon glyphicon-trash"></span></button></center></th>';
              }else{
                echo '<td id="finalbutton"><center><button class="btn btn-sm btn-default" data-toggle="modal" data-target="#final-'.$result['wid'].'" disabled="disabled">Already the Final Match</button></center></th>';
                echo '<td id="deletebutton"><center><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#remove-'.$result['wid'].'"><span class="glyphicon glyphicon-trash"></span></button></center></th>';
              }
                echo "</tr>";
            }
            
          }
          ?>
					
				</tbody>
			</table>
	</div>
</div>
</div>

<?php 
  if(isset($Response)){
    foreach ($Response as $key => $result) {
      echo '<div id="rename-'.$result['wid'].'" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="POST" action="savedmatches_refresh">
                      <div class="modal-body">Rename the match result:
                        <input type="text" class="form-control" name="rename">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary" name ="wid" value = ' . $result['wid'] .'">Confirm</button> 
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div id="remove-'.$result['wid'].'" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="POST" action="savedmatches_refresh">
                      <div class="modal-body"> You are about to delete the selected Matching PERMANENTLY</div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary" name ="Deletewid" value = ' . $result['wid'] .'">Confirm</button> 
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div id="final-'.$result['wid'].'" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">You are about to save the selected match as the final matching. Click "Confirm" to continue and proceed to kickoff night matching or "Cancel" to return.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#genKickOff-'.$result['wid'].'">Confirm</button> 
                  </div>
                </div>
              </div>
              </div>
              <div id="genKickOff-'.$result['wid'].'" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <form action="kickoffmatches" method="POST">
                          <div class="modal-content">
                                <div class="modal-body"><u>Kickoff night matching will now be generated. </u><br><br> 
                                  Please specify the maximum number of participants for the kickoff nights: <br>
                                      <input type="number" class="form-control" name="maxparticipants" min="1" max="1000"required><br>
                                      Please specify the number of mentors per kickoff night group:<br>
                                      <input type="number" class="form-control" name="nummentors" min="1" max="50"required><br>
                                      <input type="hidden" name="target_wid" value= "'.$result['wid']. '" >

                              </div>
                              <div class="modal-footer">
                                <div id="loading"></div>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button id="generate" type="submit" class="btn btn-primary">Confirm</button> 
                          </div>
                    </div>
                </form>
              </div>
              </div>';
    }
  }
?>

<script type="text/javascript">

      $('#generate').click(function () {
        // add loading image to div
        $('#loading').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');

    });
</script>
@endsection