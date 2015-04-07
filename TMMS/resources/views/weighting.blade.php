@extends('app')
@section('content')
<div class="content">
<div class="panel panel-info">
    <div class="panel-heading"><b>Adjust Weight Parameters</b></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <h4><center>Parameter Bank</center></h4>
                <ul id="sortable1" class="droptrue">
                    <li class="ui-state-default" id="element_gender">genderpref</li>
                    <li class="ui-state-default" id="element_interest">interest</li>
                    <li class="ui-state-default" id="element_kickoff">kickoff</li>
                    <?php
                        for($i = 0; $i < count($parameter); $i++){
                            echo '<li class="ui-state-default" id=element_' . $parameter[$i] . '>' . $parameter[$i] . '</li>';
                        }
                        ?>
                </ul>
            </div>
            <div class="col-sm-3">
                <h4><center>Must-Have List</center></h4>
                <ul id="sortable2" class="droptrue"></ul>
            </div>
            <div class="col-sm-3">
                <h4><center>Priority List</center></h4>
                <ul id="sortable3" class="droptrue"></ul>
            </div>
        </div>
        <form method="POST" action="makeMatching">
            <br style="clear:both"/>
            <input type="hidden" name="mustList" id="mustList" value="" />
            <input type="hidden" name="priorityList" id="priorityList" value="" />
            <button id="generate" type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Run Matching </span></button>
            <!-- <input id="test" name="params">   -->
            <div class="pull-right" id="loading"></div>
        </form>
    </div>
</div>
</div>
</div>
<!-- move to app.js after data passing is successful // only here for convenience -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#sortable2").sortable({
            opacity: 0.6,
            update: function(event, ui) {
                var info1 = $(this).sortable("serialize");
                var list1 = [];
                list1.push(info1);
                console.log(list1); //testing only
                // document.getElementById("test").value = info1;
                document.getElementById('mustList').value = info1;
            }
        });
    });
    $(document).ready(function() {
        $("#sortable3").sortable({
            opacity: 0.6,
            update: function(event, ui) {
                var info2 = $(this).sortable("serialize");
                var list2 = [];
                list2.push(info2);
                console.log(list2); //testing only
                // document.getElementById("test").value = info1;
                document.getElementById('priorityList').value = info2;
            }
        });
    });
    
    $('#generate').click(function () {
        // add loading image to div
        $('#loading').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');
    });
</script>
@endsection