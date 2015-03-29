@extends('app')

@section('content')


    <div class="panel panel-info">
        <div class="panel-heading"><b>Adjust Weight Parameters</b></div>
        <div class="panel-body">
            //TODO : NEED TO GRAB THE DIFFERENT PARAMETERS FROM DB, make heights same
            <h5>Required parameters that will be considered for the matching:</h5>
            
                <div class="row">
                    Parameter Bank
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

                    {{--TODO HEADER ON TOP OF EACH LIST--}}
                    Must List
                    <ul id="sortable2" class="droptrue">
                    </ul>

                    Priority List
                    <ul id="sortable3" class="droptrue">
                    </ul>







                <form method="POST" action="makeMatching">




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

                    <input type="hidden" name="mustList" id="mustList" value="" />
                    <input type="hidden" name="priorityList" id="priorityList" value="" />
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Run Matching </span></button>
                    <!-- <input id="test" name="params">   -->
                </form>
            </div>
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
    </script>


@endsection