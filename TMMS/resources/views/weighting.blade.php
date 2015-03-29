@extends('app')

@section('content')


<div class="panel panel-info">
  <div class="panel-heading"><b>Adjust Weight Parameters</b></div>
  <div class="panel-body">
    //TODO : NEED TO GRAB THE DIFFERENT PARAMETERS FROM DB, make heights same
    <h5>Required parameters that will be considered for the matching:</h5>

    <form action="matchresult" method="POST">
    <div class="row">
        <ul id="sortable1" class="droptrue">
          <li class="ui-state-default" id="element_gender">Gender Preference</li>
          <li class="ui-state-default" id="element_date">Date Availability</li>
          <li class="ui-state-default" id="element_program">Program of Study</li>
          <li class="ui-state-default" id="element_course">Courses Completed</li>
          <li class="ui-state-default" id="element_interests">CS-related Interests</li>
          <li class="ui-state-default" id="element_interests">Hobbies and Interests</li>
          <li class="ui-state-default" id="element_interests">Co-op Program</li>
      </ul>

      <ul id="sortable2" class="droptrue">
      </ul>

      <ul id="sortable3" class="droptrue">

    </ul>
    <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Run Matching </span></button>
    <!-- <span class="btn btn-primary" data-toggle="modal" data-target="#makematch"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Run Matching </span> -->
    <br style="clear:both">
<!-- 
    <div class="modal fade" id="makematch" tabindex="-1" role="dialog" aria-labelledby="makematchLabel" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-body">Adjustments will now be finalized. Click "continue" to create the matching or "cancel" to make changes.</div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="passparameterSubmit" class="btn btn-primary" data-dismiss="modal">Continue</button> 
            </div>
        </div>
    </div>
</div> -->

<!-- div to display array or parameter order to pass to controller - can remove after-->
<div id= 'test'></div>
</div>
</form>
</div>
</div>

<style type="text/css">
#sortable3 {
    display: inline-table;
}

/*.row .btn-primary "makematch"{
    position:relative;
    top: 225px;
}
*/
</style>

<!-- move to app.js after data passing is successful // only here for convenience -->
<script type="text/javascript">
$(document).ready(function() {
    $("#sortable2, #sortable3").sortable({
        opacity: 0.6,
        update: function(event, ui) {
            var info1 = $(this).sortable("serialize");
            var list1 = [];
            list1.push(info1);
            console.log(list1); //testing only
            document.getElementById("test").innerHTML = info1;
        }
    });
});
</script>


@endsection