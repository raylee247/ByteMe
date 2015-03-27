@extends('app')

@section('content')

<style type="text/css">
.panel-info {
    margin-right: 0px;
}
</style>
@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
@endif
<?php
print_r($json_extra);
?>
<br>
<button class="btn btn-sm btn-primary" data-original-title="Edit user information" data-toggle="modal" data-target="#modal-2">
        <i class="glyphicon glyphicon-pencil"></i> Edit
</button>
<table class="table table-user-information">
    <tbody>
        <tr>
            <td>Email</td>
            <td>
                <?php
                    print_r($participant_result[0]['email']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Student number</td>
            <td>
                <?php
                    print_r($participant_result[0]['studentNum']);
                ?>
            </td>
        </tr>
        <tr>
            <td>CS ID</td>
            <td>
                <?php
                    print_r($participant_result[0]['csid']);
                ?>
            </td>
        </tr>                            
        <tr>
            <td>Phone Number</td>
            <td>
                <?php
                    print_r($participant_result[0]['phone']);
                    echo "<br>";
                    print_r($participant_result[0]['phone alt']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <?php
                    print_r($participant_result[0]['gender']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Year of Birth</td>
            <td>
                <?php
                    print_r($participant_result[0]['birth year']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Kickoff night availability</td>
            <td>
                <?php
                    print_r($participant_result[0]['kickoff']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Kickoff availability comments</td>
            <td>
                <?php
                    print_r($participant_result[0]['kickoff']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Preference of mentor gender</td>
            <td>
                <?php
                    print_r($participant_result[0]['genderpref']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Program of Study</td>
            <td>
                <?php
                    print_r($participant_result[0]['programOfStudy']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Year of Study</td>
            <td>
                <?php
                    print_r($participant_result[0]['yearStand']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Courses Completed</td>
            <td>
                <?php
                    print_r($participant_result[0]['courses']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Previous Participation</td>
            <td>
                <?php
                    print_r($participant_result[0]['past participation']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Co-op Status</td>
            <td>
                <?php
                    print_r($participant_result[0]['coop']);
                ?>
            </td>
        </tr>
        <?php
            $extra = json_decode($json_extra, true);
            $extra_keys = array_keys($extra);

            foreach($extra_keys as $key)
            {
                if ($key == "SID" || $key == "Time")
                {
                    //do nothing and continue iteration
                }

                else
                {
                    echo "<tr>";
                    echo "<td>";
                    echo $key;
                    echo "</td>";
                    echo "<td>";
                    echo $extra[$key];
                    echo "</td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>

<div id="modal-2" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title" style="display:inline">NAME</div>
              <button class="btn btn-sm btn-primary" data-original-title="Edit user information" data-toggle="modal" data-target="#modal-2"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class=" col-md-12"> 
                    
                    <form method="POST" action="http://localhost:8888/participant/<?= $participant_result[0]['pid'] ?>". accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="name">Email: </label>
                            <input class="form-control" name="email" type="text" value="<?= $participant_result[0]['email'] ?>" id="email">
                        </div>

                        <!-- Student Number Input -->
                        <div class="form-group">
                            <label for="name">Student Number: </label>
                            <input class="form-control" name="studentnum" type="text" value="<?= $participant_result[0]['studentNum'] ?>" id="studentnum">
                        </div>

                        <!-- CSID Input -->
                        <div class="form-group">
                            <label for="name">CSID: </label>
                            <input class="form-control" name="csid" type="text" value="<?= $participant_result[0]['csid'] ?>" id="csid">
                        </div>

                        <!-- Phone Number Input -->
                        <div class="form-group">
                            <label for="name">Phone Number: </label>
                            <input class="form-control" name="phone" type="text" value="<?= $participant_result[0]['phone'] ?>" id="phone">
                        </div>

                        <!-- Phone Alternative Input -->
                        <div class="form-group">
                            <label for="name">Alt. Phone Number: </label>
                            <input class="form-control" name="phonealt" type="text" value="<?= $participant_result[0]['phone alt'] ?>" id="phonealt">
                        </div>

                        <!-- Gender Input -->
                        <div class="form-group">
                            <label for="name">Gender: </label>
                            <input class="form-control" name="gender" type="text" value="<?= $participant_result[0]['gender'] ?>" id="gender">
                        </div>

                        <!-- Birth Year Input -->
                        <div class="form-group">
                            <label for="name">Birth Year: </label>
                            <input class="form-control" name="birthyear" type="text" value="<?= $participant_result[0]['birth year'] ?>" id="birthyear">
                        </div>

                        <!-- Kickoff Night Availability Input -->
                        <div class="form-group">
                            <label for="name">Kickoff Night Availability: </label>
                            <input class="form-control" name="kickoff" type="text" value="<?= $participant_result[0]['kickoff'] ?>" id="kickoff">
                        </div>

                        <!-- Kickoff Availability Comments Input -->
                        <div class="form-group">
                            <label for="name">Kickoff Availability Comments: </label>
                            <input class="form-control" name="kickoffcomments" type="text" value="<?= $participant_result[0]['kickoff'] ?>" id="kickoffcomments">
                        </div>

                        <!-- Gender Preference Input -->
                        <div class="form-group">
                            <label for="name">Gender Preference: </label>
                            <input class="form-control" name="genderpref" type="text" value="<?= $participant_result[0]['genderpref'] ?>" id="genderpref">
                        </div>

                        <!-- Program of Study Input -->
                        <div class="form-group">
                            <label for="name">Program of Study: </label>
                            <input class="form-control" name="program" type="text" value="<?= $participant_result[0]['programOfStudy'] ?>" id="program">
                        </div>

                        <!-- Year Standing Input -->
                        <div class="form-group">
                            <label for="name">Year Standing: </label>
                            <input class="form-control" name="yearstanding" type="text" value="<?= $participant_result[0]['yearStand'] ?>" id="yearstanding">
                        </div>

                        <!-- Courses Completed Input -->
                        <div class="form-group">
                            <label for="name">Courses Completed: </label>
                            <input class="form-control" name="courses" type="text" value="<?= $participant_result[0]['courses'] ?>" id="courses">
                        </div>

                        <!-- Past Participation Input -->
                        <div class="form-group">
                            <label for="name">Past Participation: </label>
                            <input class="form-control" name="pastparticipation" type="text" value="<?= $participant_result[0]['past participation'] ?>" id="pastparticipation">
                        </div>

                        <!-- Coop Status Input -->
                        <div class="form-group">
                            <label for="name">Coop Status: </label>
                            <input class="form-control" name="coop" type="text" value="<?= $participant_result[0]['coop'] ?>" id="coop">
                        </div>

                        <!-- Extra Input -->
                        <?php
                            $extra = json_decode($json_extra, true);
                            $extra_keys = array_keys($extra);

                            foreach($extra_keys as $key)
                            {
                                // need this line because for some reason request doesn't accept any white spaces and returns NULL
                                $no_spaces_key = preg_replace('/\s+/', '', $key);
                                
                                echo "<div class='form-group'>";
                                echo "<label for='$key'>";
                                echo $key;
                                echo "</label>";
                                echo "<input class='form-control' name='$no_spaces_key' type='text' value='$extra[$key]' id='$no_spaces_key'>";
                                echo "</div>";
                            }
                        ?>

                        <!-- Submit Button --> 
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        <input data-dismiss="modal" type="reset" value="Reset!">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes //TODO:save to db</button>
</div>
</div>
</div>
</div>

<!-- move to app.css -->
<style type="text/css">
textarea {
    height: 28px;
    width: 400px;
}

#textarea {
    -moz-appearance: textfield-multiline;
    -webkit-appearance: textarea;
    border: 1px solid gray;
    font: medium -moz-fixed;
    font: -webkit-small-control;
    height: 4em;
    overflow: auto;
    padding: 2px;
    resize: both;
    width: 225px;
    white-space: normal;
}

input {
    margin-top: 5px;
    width: 400px;
}

#input {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
    background-color: white;
    background-color: -moz-field;
    border: 1px solid darkgray;
    box-shadow: 1px 1px 1px 0 lightgray inset;  
    font: -moz-field;
    font: -webkit-small-control;
    margin-top: 5px;
    padding: 2px 3px;
    width: 225px;    
    white-space: normal;
}
</style>
@endsection