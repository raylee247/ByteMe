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
</style>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-xs-8 col-xs-offset-2">
            <form action="mentors" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group">
                    <input type="hidden" name="search_param" value="all" id="search_param">         
                    <input type="text" class="form-control" name="text" placeholder="Search with name or email">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form>
        </div>
        <br><br><br>
        <table id="example" class="table table-striped table-bordered table-hover" width="100%">
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
    </div>
</div>
<script>
    $(document).ready(function(){
        $('tbody tr').click(function(){
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