@extends('app')

@section('guestcontent')


<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"><center>Student Application Form</center></div>
            <div class="panel-body">
                
// TODO : SET UP REQUIRED FIELDS AND FIELD TYPES, POST VARIABLES (FIX ACTION URL)
<form class="form-horizontal" role="form" action="mentorapp" method="POST" >
    <div class="form-group">
         <label class="control-label col-sm-3">Email address:</label>
            <div class="col-md-6">
           <input type="text" class="form-control" name="email">
          </div><br><br> 
      </form>
         <label class="control-label col-sm-3">Student number:</label>
           <div class="col-md-6">
           <input type="text" class="form-control" name="studentnum">
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
      </form><br>
        <label class="control-label col-sm-3">Year of birth (Optional):</label>
            <div class="col-md-6">
           <input type="text" class="form-control" id="birthyear">
          </div><br><br> 
        <label class="control-label col-sm-3">Kickoff event availability</label>
         <div class="col-md-9">Students are required to attend one evening kickoff event to meet with their student/mentor matches. There are 3 different event dates to choose from. All evenings follow the same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please indicate your availability for the following dates:
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
        <div class="form-inline">
            <label class="control-label col-sm-3">Mentor gender preference:</label>
            <select class="form-control">
                <option id="nopref">No preference</option>
                <option id="femalepref">Match with female mentor only</option>
                <option id="malepref">Match with male mentor only</option>
            </select>
        </div><br>
        <div class="form-inline">
            <label class="control-label col-sm-3">Program of study:</label>
            <select class="form-control">
                <option id="program_none">- None -</option>
                <option id="ba_cs">BA, Computer Science</option>
                <option id="bcomm_combined_cs">BComm, Combined Business / Computer Science (BUCS)</option>
                <option id="bcs_second">BCS (Bachelor of CS, 2nd Degree)</option>
                <option id="bsc_cog">BSc, Cognitive Systems (Comp. Intelligence and Design)</option>
                <option id="bsc_cs">BSc, Computer Science</option>
                <option id="bsc_combined_cs_bio">BSc, Combined Major (Computer Science and Biology)</option>
                <option id="bsc_combined_cs_math">BSc, Combined Major (Computer Science and Mathematics)</option>
                <option id="bsc_combined_cs_micb">BSc, Combined Major (Computer Science and Microbiology and Immunology</option>
                <option id="bsc_combined_cs_stats">BSc, Combined Major (Computer Science and Statistics</option>
                <option id="bsc_cs_phys">BSc, Combined Major (Computer Science and Physics</option>
                <option id="bsc_combined_cs_other">BSc, Combined Major (Computer Science and Another Science Subject</option>
                <option id="bsc_honours_cs">BSc, Honours Computer Science</option>
            </select>
        </div><br>
        <div class="form-inline">
            <label class="control-label col-sm-3">Program of study (other):</label>
            <input type="text" class="form-control" id="programofstudy_other">
        </div><br> 

        <div class="form-inline">
            <label class="control-label col-sm-3">Year of study:</label>
            <select class="form-control">
                <option id="year_none">- None -</option>
                <option id="firstyr">1st year</option>
                <option id="secondyr">2nd year</option>
                <option id="thirdyr">3rd year</option>
                <option id="fourthyr">4th year</option>
                <option id="other">Other</option> //TODO
            </select>
        </div><br>
    <label class="control-label col-sm-4">Which of the following courses have you completed:</label>
    <form role="form">
    <label class="checkbox-inline">
      <input type="checkbox" id="210">CPSC 210</label>
    <label class="checkbox-inline">
      <input type="checkbox" id="213">CPSC 213</label>
    <label class="checkbox-inline">
      <input type="checkbox" id="221">CPSC 221</label>
  </form><br>

<form role="form">
    <div class="form-inline">
    <label class="control-label col-sm-4">Previously matched with a mentor and/or student mentee in the CS tri-mentoring program?<br></label>
    <select class="form-control">
      <option id="previousmatched_no">No, I have not participated before</option>
      <option id="previousmatched_junior">Yes, as a junior student</option>
      <option id="previousmatched_senior">Yes, as a senior student</option>
      <option id="previousmatched_both">Both junior and senior student</option>
    </select>
    </div></form><br>

<form role="form">
        <label class="control-label col-sm-1">Co-op status:</label> // TODO: FIX ALIGNMENT
        <select class="form-control">
          <option value="coop_completed">Have completed all co-op terms</option>
          <option value="coop_current">Currently a co-op student</option>
          <option value="coop_interested">Not a co-op student, but interested in joining co-op</option>
          <option value="coop_no">Not a co-op student</option>
      </select>
  </form>
<br>

    <label class="control-label col-sm-4">Future career plans (choose all that apply):</label>
    <form role="form">
    <div class="col-md-6">
    <div class="checkbox">
      <label><input type="checkbox" id="work_cs">Work in CS-related job immediately after graduation</label>
    </div>
        <div class="checkbox">
      <label><input type="checkbox" id="work_startup">Work for a start-up</label>
    </div>
        <div class="checkbox">
      <label><input type="checkbox" id="work_ownbusiness">Own my own business</label>
    </div>
        <div class="checkbox">
      <label><input type="checkbox" id="masters_phd">Complete a Master's or PhD</label>
    </div>
        <div class="checkbox">
      <label><input type="checkbox" id="work_academic">Work as an academic</label>
    </div>
        <div class="checkbox">
      <label><input type="checkbox" id="career_unsure">Career plans still unsure</label>
    </div>
</div>


  </form><br>

        <div class="form-inline">
            <label class="control-label col-sm-3">Computer Science areas of interest (please enter as comma-separated list):</label>
            <textarea rows="5" cols="90" name="cs_areasofinterest" id="cs_areasofinterest"></textarea><br>
        </div> <br>

        <div class="form-inline">
            <label class="control-label col-sm-3">Hobbies and interests (please enter as comma-separated list):</label>
            <textarea rows="5" cols="90" name="hobbies_interest" id="hobbies_interest"></textarea><br>
        </div> <br>

        <div class="form-inline">
            <label class="control-label col-sm-3">Additional questions or comments?</label>
            <textarea rows="5" cols="90" name="addit" id="additionalcomments_questions"></textarea><br>
        </div> <br>
      </form>
  </div><br><br> 
</form>


<center><button type="submit" class="btn btn-primary">Submit Application</button></center>
</div>
</form>
</body>
</html>
</div>
</div>
</div>


@endsection

<!-- <div class="form-inline">
<div class="form-group">

Email: {!! Form::text('email', null, ['class'=> 'form-control']) !!} <br><br>
Student number: {!! Form::text('studentnum', null, ['class'=> 'form-control']) !!} <br><br>
Given name: {!! Form::text('givenname', null, ['class'=> 'form-control']) !!}<br><br> 
Family name: {!! Form::text('familyname', null, ['class'=> 'form-control']) !!}<br><br> 
Phone: {!! Form::text('phone', null, ['class'=> 'form-control']) !!}<br><br> 
Phone(alternate): {!! Form::text('phonealt', null, ['class'=> 'form-control']) !!}<br><br> 
Gender: 
<div class="form-group">
{!! Form::radio('sex', 'male') !!} Identify as male <br>
{!! Form::radio('sex', 'female') !!} Identify as female <br>
{!! Form::radio('sex', 'othersex') !!} Other (please specify) //TODO - OTHER <br>  
</div>
<br><br>
Birth year: {!! Form::text('birthyear', null, ['class'=> 'form-control']) !!}<br><br> 
Kickoff event availability<br><br> 
                                Students are required to attend one evening kickoff event to meet with their student/mentor matches. There are 3 different event dates to choose from. All evenings follow the same format and all kickoffs are held at the UBC Vancouver campus in the ICICS/CS Building. Please indicate your availability for the following dates:
                                <br><br> 
                                <table style="width:100%">
                                    <tr>
                                        <th></th>
                                        <th>FIRST CHOICE</th>
                                        <th>SECOND CHOICE</th>      
                                        <th>THIRD CHOICE</th>
                                        <th>NOT AVAIL.</th>
                                    </tr>
                                    <tr>
                                        <td>Wed. Sept. 24, 2014, from 5:45 - 7:45pm</td>
                                        <td> {!! Form::radio('kickoffavail', 'first') !!}
                                        <td> {!! Form::radio('kickoffavail', 'second') !!}
                                        <td> {!! Form::radio('kickoffavail', 'third') !!}
                                        <td> {!! Form::radio('kickoffavail', 'notavail') !!}
                                    </tr>
                                    <tr>
                                        <td>Thurs. Sept. 25, 2014 from 5:45 - 7:45pm</td> 
                                        <td> {!! Form::radio('kickoffavail', 'first') !!}
                                        <td> {!! Form::radio('kickoffavail', 'second') !!}
                                        <td> {!! Form::radio('kickoffavail', 'third') !!}
                                        <td> {!! Form::radio('kickoffavail', 'notavail') !!}
                                     </tr>
                                     <tr>
                                        <td>Thurs. Oct. 2, 2014, from 5:45 - 7:45pm</td>
                                        <td> {!! Form::radio('kickoffavail', 'first') !!}
                                        <td> {!! Form::radio('kickoffavail', 'second') !!}
                                        <td> {!! Form::radio('kickoffavail', 'third') !!}
                                        <td> {!! Form::radio('kickoffavail', 'notavail') !!}
                                      </tr>
                                    </table>

Additional comments regarding availability? <br>
{!! Form::textarea('additionalcomments_avail') !!} <br><br>
 Mentor gender preference: <br>
 {!! Form::select('mentorgender', array(
            'No preference',
            'Match with female mentor only', 
            'Match with male mentor only')) !!} <br><br>
Program of study: <br>
{!! Form::select('programstudy', array(
'None',
'BA, Computer Science', 
'BComm, Combined Business / Computer Science (BUCS)',
'BCS (Bachelor of CS, 2nd Degree)', 
'BSc, Cognitive Systems (Comp. Intelligence and Design)', 
'BSc, Computer Science', 
'BSc, Combined Major (Computer Science and Biology)', 
'BSc, Combined Major (Computer Science and Mathematics)', 
'BSc, Combined Major (Computer Science and Mathematics)', 
'BSc, Combined Major (Computer Science and Microbiology and Immunology)', 
'BSc, Combined Major (Computer Science and Statistics)', 
'BSc, Combined Major (Computer Science and Physics)', 
'BSc, Combined Major (Computer Science and Another Science Subject)',
'BSc, Honours Computer Science')) !!} <br><br>
           
 Program of study (other): <br>                   
{!! Form::text('otherprogramstudy', null, ['class'=> 'form-control']) !!} <br><br>
                                 
 Year of study (according to UBC SSC): <br>
  {!! Form::select('yearofstudy', array(     
  'None',
  '1st year', 
  '2nd year',
  '3rd year',
  '4th year',
  'Other')) !!} // TODO <br><br> 
                                    
  Please check all the courses that you have completed:
                                    **TODO: 
                                    CPSC 101
                                    CPSC 110
                                    CPSC 121
                                    CPSC 189
                                    CPSC 210
                                    CPSC 213
                                    CPSC 221
                                    CPSC 259
                                    CPSC 261
                                    CPSC 301
                                    CPSC 302
                                    CPSC 303
                                    CPSC 304
                                    CPSC 310
                                    CPSC 311
                                    CPSC 312
                                    CPSC 313
                                    CPSC 314
                                    CPSC 317
                                    CPSC 319
                                    CPSC 320
                                    CPSC 322
                                    CPSC 340
                                    CPSC 344
                                    CPSC 349
                                    CPSC 404
                                    CPSC 406
                                    CPSC 410
                                    CPSC 411
                                    CPSC 415
                                    CPSC 416
                                    CPSC 420
                                    CPSC 421
                                    CPSC 422
                                    CPSC 430
                                    CPSC 445
                                    <br>


 Previously matched with a mentor and/or student mentee in the CS tri-mentoring program? <br>
  {!! Form::select('previousmatched', array(     
  'No',
  'Yes, as a junior student', 
  'Yes, as a senior student',
  'Both junior and senior student' )) !!} <br><br> 

  Co-op status: <br>
  {!! Form::select('previousmatched', array(     
  'Have completed all co-op terms',
  'Currently a co-op student', 
  'Not a co-op student, but interested in joining co-op',
  'Not a co-op student' )) !!} <br><br> 

 Future career plans (choose all that apply): <br>
 <div class="form-group">
{!! Form::checkbox('careerplan', 'work_cs') !!}   Work in CS-related job immediately after graduation<br>
{!! Form::checkbox('careerplan', 'work_startup') !!}  Work for a start-up<br>
{!! Form::checkbox('careerplan', 'work_ownbusiness') !!}  Own my own business<br>
{!! Form::checkbox('careerplan', 'workcs_mastersphd') !!}  Complete a Master's or PhD<br>
{!! Form::checkbox('careerplan', 'work_academic') !!}  Work as an academic<br>
{!! Form::checkbox('careerplan', 'career_unsure') !!}  Career plans still unsure<br>
{!! Form::checkbox('careerplan', 'career_other') !!}  'Other (please specify)//TODO<br>
</div>

{!! Form::radio('sex', 'male') !!} Identify as male <br>
{!! Form::radio('sex', 'female') !!} Identify as female <br>
{!! Form::radio('sex', 'othersex') !!} Other (please specify) //TODO - OTHER <br>  

Computer Science areas of interest (please enter as comma-separated list):<br>    
{!! Form::textarea('cs_areasofinterest') !!} <br><br>
                                    
Hobbies and interests (please enter as comma-separated list):<br>                                    
{!! Form::textarea('hobbies_interests') !!} <br><br>                                  

Additional questions or comments? <br>                                   
{!! Form::textarea('additionalcomments') !!} <br><br>                                      

{!!Form::submit("Submit", ["class"=>"btn btn-primary", "id" => "submitForm"])!!}                                 
{!! Form::close() !!}
</div>
</div> -->


