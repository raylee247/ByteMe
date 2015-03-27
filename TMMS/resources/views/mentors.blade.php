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
            TODO// participant info - implement jquery to display row data when selected and DB query, implement buttons functionality, fix table width
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Job</th>
            <th>Years of<br>CS work</th>
            <th>Education Level</th>
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
</div>
</div>

<script>
    $(document).ready(function(){
        $('table tr').click(function(){
            // index of row clicked 
            var row = ($(this).index());

            // actual pid of the participant 
            var myvar = <?php
                            echo json_encode($array);
                        ?>;

            window.location.href = "participant" + "/" + myvar[row];
            return false;
        });
    });
</script>
@endsection