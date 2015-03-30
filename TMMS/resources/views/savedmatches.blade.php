@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading"><b>Saved Match Results</b></div>
	<div class="panel-body">
		<legend>
			<h5>
				<b>Name of Matching:</b> $$$$$<br>
				<b>Parameters Required:</b> $$$$$<br>
				<b>Parameter Priority:</b> $$$$$<br>
				<b>Average Satisfaction:</b> $$$$$<br>
				<b>Median:</b> $$$$$
			</h5>
		</legend>

		<div class="panel-body">
			<table id="savedmatches" class="table table-striped table-bordered table-hover" cellspacing="0">
				<thead>
					<tr> 
						<th>Name of Matching</th>
            <th>Matching Id </th>
						<th>Average Satisfaction Rate</th>
            <th> </th>
					</tr>
				</thead>
				<tbody>
          <?php 
          if(isset($Response)){
            
            foreach ($Response as $index => $result) {
              echo "<tr>";
              echo "<td>" . $result['name'] . '<button class="btn pull-right btn-xs btn-primary" data-toggle="modal" data-target="#rename-'.$result['wid'].'"><i class="glyphicon glyphicon-pencil"></i></button></td>';
              echo "<td>" . $result['wid'] . "</td>";
              echo "<td>" . $result['avgSat'] . "</td>";
              echo '<td id="finalbutton"><center><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-2">Set as Final Matching</button></center></th>';
              echo "</tr>";
            }
            
          }
          ?>
					
				</tbody>
			</table>
		</div>

		<style type="text/css">
		#savedmatches {
			width: 80%;
		}
		</style>
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
                          <button type="button" class="btn btn-primary" name ="rename-' . $result['wid'] .' value = ' . $result['wid'] .'">Confirm</button> 
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
                                      <input type="text" class="form-control" name="maxparticipants"><br>
                                      Please specify the number of mentors per kickoff night group:<br>
                                      <input type="text" class="form-control" name="nummentors"><br>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm</button> 
                          </div>
                    </div>
                </form>
              </div>
              </div>';
    }
  }











?>
<div id="modal-1" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-body">Rename the match result:
                        <input type="text" class="form-control" name="rename">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary">Confirm</button> 
            </div>
      </div>
</div>
</div>

<div id="modal-2" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-body">You are about to save the selected match as the final matching. Click "Confirm" to continue and proceed to kickoff night matching or "Cancel" to return.
                </div>
                <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle='modal' data-target="#modal-3">Confirm</button> 
            </div>
      </div>
</div>











</div>
<div id="modal-3" class="modal fade" id="renamemodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
      <div class="modal-dialog">
      	<form action="kickoffmatches" method="POST">
            <div class="modal-content">
                  <div class="modal-body"><u>Kickoff night matching will now be generated. </u><br><br> 
                  	Please specify the maximum number of participants for the kickoff nights: <br>
                        <input type="text" class="form-control" name="maxparticipants"><br>
                        Please specify the number of mentors per kickoff night group:<br>
                        <input type="text" class="form-control" name="nummentors"><br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Confirm</button> 
            </div>
      </div>
  </form>
</div>
</div>

@endsection