@extends('app')

@section('content')

    <div>    
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
                      <li><a href="all">All</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="text" placeholder="Search with name, student number or cs-id">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
</form>


        </div>
	</div>
<br>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr> TODO // SEARCH FUNCTION + FILL IN DATATABLE + IMPLEMENT DB QUERY + PARTICIPANT INFO PROFILE
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
                foreach($result as $single_result) {
                    echo "<tr><td>"; 
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




@endsection