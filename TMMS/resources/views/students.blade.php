@extends('app')
@section('content')
<style type="text/css">
  .panel-info {
  margin-right: 0px;
  }
  .table {
  white-space:normal;
  }
  tr {
  cursor: pointer;
  }
</style>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="col-xs-8 col-xs-offset-2">
      <form action="students" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group">
          <div class="input-group-btn search-panel">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span id="search_concept">Filter by</span> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="junior students">Junior students</a></li>
              <li><a href="senior students">Senior students</a></li>
              <li><a href="all">All students</a></li>
            </ul>
          </div>
          <input type="hidden" name="search_param" value="all" id="search_param">         
          <input type="text" class="form-control" name="text" placeholder="Search with name, email, student number or CS ID">
          <span class="input-group-btn">
          <button class="btn btn-default" onclick="myFunction()" type="submit"><span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div>
      </form>
    </div>
    <br><br><br>
    <table id="example" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last name</th>
          <th>Student Number</th>
          <th>CS ID</th>
          <th>Year Standing</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0; 
          foreach($result as $single_result) {
              $array[$i] = $result[$i]['pid'];
              $i++; 
          
              echo "<tr href='participant'><td>"; 
              print_r($single_result['First name']);
              echo "</td>";
              echo "<td>"; 
              print_r($single_result['Family name']);
              echo "</td>";
              echo "<td>"; 
              print_r($single_result['studentNum']);
              echo "</td>";
              echo "<td>"; 
              print_r($single_result['csid']);
              echo "</td>";
              echo "<td>"; 
              print_r($single_result['yearStand']);
              echo "</td>";
              echo "<td>"; 
              print_r($single_result['email']);
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