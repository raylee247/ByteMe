@extends('app')
@section('content')
<style type="text/css">
.panel-info {
    margin-right: 0px;
}
table {
    white-space:normal;
}
tr {
    cursor: pointer;
}
#mentors {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  width: 100%;
  border-collapse: collapse;
}

#mentors td, #mentors th {
  font-size: 1em;
  border: 1px solid #9191B5;
  padding: 3px 7px 2px 7px;
}

#mentors th {
  font-size: 1.1em;
  text-align: left;
  padding-top: 5px;
  padding-bottom: 4px;
  background-color: #1A5690;
  color: #ffffff;
}

#mentors tr.alt td {
  color: #000000;
  background-color: #66CCFF;
}
#content {
  margin-right: 10px;
  margin-left: 10px;
}
</style>
<div class="content">
    <div class="col-xs-8 col-xs-offset-2">
        <form action="mentors" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="text" <?php if(isset($text)) {echo 'value="'.$text.'"';} else {echo 'placeholder="Search with name or email"'; }?>>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
    <br>
    <table id="mentors" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Job</th>
                <th>Years of CS work</th>
                <th>Education Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($result as $single_result)
            {
                $array[$i] = $result[$i]['pid'];
                $i++; 
                echo "<tr href='participant'><td>"; 
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
                echo "</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br><br>
</div>
<script>
$(document).ready(function(){
    $('tbody tr').click(function(){
            // index of row clicked 
            var row = ($(this).index());

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