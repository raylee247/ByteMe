@extends('app')

@section('content')


TODO NEED TO GRAB THE DIFFERENT PARAMETERS FROM DB
MUSTHAVES
<ul id="sortable1" class="droptrue">
  <li class="ui-state-default" id="element_gender">Gender Preference</li>
  <li class="ui-state-default" id="element_date">Date Availability</li>
  <li class="ui-state-default" id="element_3">Item 3</li>
  <li class="ui-state-default" id="element_4">Item 4</li>
  <li class="ui-state-default" id="element_5">Item 5</li>
  <li class="ui-state-default" id="element_6">Item 6</li>
</ul>

<ul id="sortable2" class="droptrue">
</ul>

<br style="clear:both">

<!-- div to display array or parameter order to pass to controller - can remove after-->
<div id= 'test'></div>

<div id="sortable3">
    <b>PRIORITY</b>
    <li class="ui-state-default" id="element_1"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
    <li class="ui-state-default" id="element_2"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
    <li class="ui-state-default" id="element_3"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
    <li class="ui-state-default" id="element_4"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
    <li class="ui-state-default" id="element_5"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
    <li class="ui-state-default" id="element_6"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
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
            document.getElementById("test").innerHTML = info1;
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#sortable3").sortable({
        opacity: 0.6,
        update: function(event, ui) {
            var info2 = $(this).sortable("serialize");
            var list2 = [];
            list2.push(info2);
            console.log(list2); //testing only
            document.getElementById("test").innerHTML = info2;
        }
    });
});


</script>

@endsection