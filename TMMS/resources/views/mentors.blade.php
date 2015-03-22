@extends('app')

@section('content')

<style type="text/css">
.panel-info {
    margin-right: 0px;
}
</style>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
          <div class="input-group">
            <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                   <span id="search_concept">Filter by</span> <span class="caret"></span>
               </button>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="#">placeholder</a></li>
                  <li><a href="#">placeholder</a></li>
                  <li class="divider"></li>
                  <li><a href="#">placeholder</a></li>
                  <li><a href="#">placeholder</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Anything</a></li>
              </ul>
          </div>
          <input type="hidden" name="search_param" value="all" id="search_param">         
          <input type="text" class="form-control" name="x" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
        </span>
    </div>
</div>
</div>
<br>
<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
    <!-- PLACEHOLDER DATA FOR TABLE QUERY -->
    <tbody>
        <tr data-toggle="modal" data-id="1" data-target="#orderModal">
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">


            <style type="text/css">.user-row {
                margin-bottom: 14px;
            }

            .user-row:last-child {
                margin-bottom: 0;
            }

            .dropdown-user {
                margin: 13px 0;
                padding: 5px;
                height: 100%;
            }

            .dropdown-user:hover {
                cursor: pointer;
            }

            .table-user-information > tbody > tr {
                border-top: 1px solid rgb(221, 221, 221);
            }

            .table-user-information > tbody > tr:first-child {
                border-top: 0;
            }


            .table-user-information > tbody > tr > td {
                border-top: 0;
            }
            .toppad
            {margin-top:20px;
            }
            </style>

            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">NAME</h3>
                  <a data-original-title="Move to waitlist" data-toggle="tooltip" type="button" data-placement="bottom" class="btn pull-right btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i></a>

              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class=" col-md-12"> 
                          <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>Email</td>
                                    <td>$EMAIL@EMAIL.com</a></td>
                                </tr>
                                <tr>
                                    <td>Student number:</td>
                                    <td>$########</td>
                                </tr>
                                <tr>
                                    <td>Program of study:</td>
                                    <td>$PROGRAM</td>
                                </tr>
                                <tr>
                                    <td>Year of Birth</td>
                                    <td>$YEAR</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>$GENDER</td>
                                </tr>
                                <tr>
                                    <td>Year standing:</td>
                                    <td>$YEARSTANDING</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>123-4567-890<br><br>555-4567-890
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a data-original-title="View email history" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                <a data-original-title="View reports" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-file"></i></a>
                <span class="pull-right">
                    <a data-original-title="Edit user information" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a data-original-title="Remove user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                </span>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>
@endsection