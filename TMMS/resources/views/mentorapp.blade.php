@extends('app')

@section('guestcontent')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"><center>Mentor Application Form</center></div>
            <div class="panel-body">



<?php echo $studentnum . " " . $email . " " . $givenname . " " . $familyname . " " . $phone . " " . $phonealt . " " . 
        $birthyear . " " . $additionalcomments_avail . " " . $mentorgender . " " . $programofstudy . " " .  $programofstudy_other
         . " " . $yearofstudy . " " . $participation . " " . $coop  . " " . $cs_areasofinterest . " " .$hobbies_interest . " " .
         $additionalcomments_questions   ?><br>

    

                <h2>Sign up to be a mentor<?php foreach($course as $g){ echo $g . "<br>";} ?></h2>


                Thank you for your interest in becoming a mentor with our Computer Science tri-mentoring program. To help in matching mentors to appropriate students, please complete all sections of the application form.

// TODO : SET UP REQUIRED FIELDS AND FIELD TYPES, POST VARIABLES, SET UP ROUTE AND CONTROLLER METHOD

                <form class="form-horizontal" role="form" action="TODO" method="POST" >
                    <div class="form-group">
                       <label class="control-label col-sm-3">Email address:</label>
                       <div class="col-md-6">
                         <input type="text" class="form-control" name="email">
                     </div><br><br> 
                     <label class="control-label col-sm-3">Given name:</label>
                     <div class="col-md-6">
                        <input type="text" class="form-control" id="givenname">
                    </div><br><br> 
                    <label class="control-label col-sm-3">Family name:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="familyname">
                    </div><br><br> 
                    <label class="control-label col-sm-3">Phone:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="phone">
                    </div><br><br> 
                    <label class="control-label col-sm-3">Phone(alternate):</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="phonealt">
                    </div><br><br> 
                    <div class="gender">
                      <label class="control-label col-sm-3">Gender:</label>
                      <form role="form">
                        <label class="radio-inline">
                          <input type="radio" name="gender" id="male">Identify as male
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="gender" id="female">Identify as female
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="gender" class ="other" id="other">Other (please specify)
                      </label>
                      <div class="col-md-6" id="otherfield">
                         <label class="control-label col-sm-6">Gender (please specify):</label>
                         <div class="col-md-6 panel-collapse collapse in">
                             <input type="text" class="form-control" id="otherfield">
                         </div><br>
                     </div>
                 </form></div><br>
                 <label class="control-label col-sm-3">Year of birth (Optional):</label>
                 <div class="col-md-6">
                     <input type="text" class="form-control" id="birthyear">
                 </div><br><br> 
                 <div class="form-inline">
                    <label class="control-label col-sm-3">Preference of student mentee gender:</label>
                    <div class="col-md-4">
                    <select class="form-control">
                        <option id="nopref">No preference</option>
                        <option id="femalepref">Match with female students only</option>
                        <option id="malepref">Match with male students only</option>
                    </select>
                    </div>
                </div><br>

                <label>Kickoff event availability</label> //TODO: fix alignment
                <div class="col-md-9">Mentors are requested to attend one evening kickoff event to meet with their student matches. There are 3 different event dates to choose from. All evenings follow the same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please indicate your availability for the following dates:
                </div> 
                <table class="table table-hover" style="width:90%">
                    <tr>
                        <th></th>
                        <th><center>FIRST CHOICE</th></center>
                        <th><center>SECOND CHOICE</th></center>  
                        <th><center>THIRD CHOICE</th></center>
                        <th><center>NOT AVAIL.</th></center>
                    </tr>
                    <tr>
                        <td><center>Wed. Sept. 24, 2014, from 5:45 - 7:45pm</center></td>
                        <td><center><input type="radio" name="dayone" id="kickoff_first_a"></center>
                        <td><center><input type="radio" name="dayone" id="kickoff_second_a"></center>
                        <td><center><input type="radio" name="dayone" id="kickoff_third_a"></center>
                        <td><center><input type="radio" name="dayone" id="kickoff_notavail_a"></center>
                    </tr>
                    <tr>
                        <td><center>Thurs. Sept. 25, 2014 from 5:45 - 7:45pm</center></td> 
                        <td><center><input type="radio" name="daytwo" id="kickoff_first_b"></center>
                        <td><center><input type="radio" name="daytwo" id="kickoff_second_b"></center>
                        <td><center><input type="radio" name="daytwo" id="kickoff_third_b"></center>
                        <td><center><input type="radio" name="daytwo" id="kickoff_notavail_b"></center>
                    </tr>
                    <tr>
                        <td><center>Thurs. Oct. 2, 2014, from 5:45 - 7:45pm</center></td>
                        <td><center><input type="radio" name="daythree" id="kickoff_first_c"></center>
                        <td><center><input type="radio" name="daythree" id="kickoff_second_c"></center>
                        <td><center><input type="radio" name="daythree" id="kickoff_third_c"></center>
                        <td><center><input type="radio" name="daythree" id="kickoff_notavail_c"></center>
                    </tr>
                </table><br>
                <div class="form-inline">
                    <label class="control-label col-sm-3">Additional comments regarding availability?</label>
                    <textarea class="form-control" rows="5" cols="90" id="additionalcomments_avail"></textarea><br>
                </div> <br>

                <label class="control-label col-sm-4">Current employment status (check all that apply):</label>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label><input type="checkbox" id="industry">Working in industry</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="academia">Working in academia</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="startup">Working for a startup</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="selfemployed">Self-employed</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="retired">Retired</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="other_employment">Other (please specify)</label> //TODO
                            </div>
                        </div><br>

                <div class="form-inline">
                    <label class="control-label col-sm-4">Years of CS-related work experience:</label>
                    <div class="col-md-6">
                        <select class="form-control">
                            <option id="0-2years">0-2 years</option>
                            <option id="3-5years">3-5 years</option>
                            <option id="6-10years">6-10 years</option>
                            <option id="11-15years">11-15 years</option>
                            <option id="16-20years">16-20 years</option>
                            <option id="20+years">20+ years</option>
                        </select>
                    </div>
                </div><br>

                <div class="form-inline">
                    <label class="control-label col-sm-4">Highest level of education:</label>
                    <div class="col-md-6">
                        <select class="form-control">
                            <option id="0-2years">Bachelor's</option>
                            <option id="3-5years">Master's</option>
                            <option id="6-10years">PhD</option>
                            <option id="11-15years">Other (please specify)</option> // TODO
                        </select>
                    </div>
                </div><br>


        <div class="form-inline">
            <label class="control-label col-sm-3">Computer Science areas of interest (please enter as comma-separated list):</label>
            <textarea rows="5" cols="90" name="cs_areasofinterest" id="cs_areasofinterest"></textarea><br>
        </div> <br>

        <div class="form-inline">
            <label class="control-label col-sm-3">Hobbies and interests (please enter as comma-separated list):</label>
            <textarea rows="5" cols="90" name="hobbies_interest" id="hobbies_interest"></textarea><br>
        </div> 


        <label class="control-label col-sm-3">Are you a UBC alumnae/alumnus?</label>
                    <form role="form">
                        <label class="radio-inline">
                          <input type="radio" name="alumnae" id="yes">Yes
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="alumnae" id="no">No
                      </label>
                    </form>

        <div class="form-inline">
            <label class="control-label col-sm-3">Additional questions or comments?</label>
            <textarea rows="5" cols="90" name="addit" id="additionalcomments_questions"></textarea><br>
        </div> </div>
      </form>
  </div>
</form> 

<center><button type="submit" class="btn btn-primary">Submit Application</button></center>
</div></div></div></div>


@endsection
