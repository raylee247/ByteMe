@extends('app')

@section('guestcontent')


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Student Application Form</div>
                    <div class="panel-body">
                        <html>
                        <head>
                            <link rel="stylesheet" href="css/studentapp.css" />
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> 
                        </head>
                        <body>
<div class="form-inline">
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
</div>

<!-- 
<form role="form-inline">
 Email: <input type="text" name="email"><br> <br> 
                                Student number: <input type="text" name="studentnum"><br><br> 
                                Given name: <input type="text" name="givenname"><br><br> 
                                Family name: <input type="text" name="familyname"><br><br> 
                                Phone: <input type="text" name="phone"><br><br> 
                                Phone(alternate): <input type="text" name="phonealt"><br><br> 
                                Gender:
                                <input type="radio" name="sex" value="male">Identify as female
                                <input type="radio" name="sex" value="female">Identify as male
                                <input type="radio" name="sex" value="other">Other (please specify) <br><br> 
                                Birth year: <input type="text" name="birthyear"><br><br> 
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
                                        <td><input type="radio" name="kickoffavail" value="kickoff_first_a">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_second_a">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_third_a">    
                                        <td><input type="radio" name="kickoffavail" value="kickoff_notavail_a">
                                    </tr>
                                    <tr>
                                        <td>Thurs. Sept. 25, 2014 from 5:45 - 7:45pm</td> 
                                        <td><input type="radio" name="kickoffavail" value="kickoff_first_b">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_second_b">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_third_b">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_notavail_b">
                                     </tr>
                                     <tr>
                                        <td>Thurs. Oct. 2, 2014, from 5:45 - 7:45pm</td>
                                        <td><input type="radio" name="kickoffavail" value="kickoff_first_c">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_second_c">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_third_c">
                                        <td><input type="radio" name="kickoffavail" value="kickoff_notavail_c"> 
                                      </tr>
                                    </table>
                                    Additional comments regarding availability? <br>
                                    <textarea rows="5" cols="100" name="additionalcomments_avail" id="additionalcomments_avail"></textarea><br><br>
                                    Mentor gender preference: <br>
                                    <select>
                                        <option value="nopref">No preference</option>
                                        <option value="femalepref">Match with female mentor only</option>
                                        <option value="malepref">Match with male mentor only</option>
                                    </select> <br>
                                    Program of study: <br>
                                    <select>
                                        <option value="program_none">- None -</option>
                                        <option value="ba_cs">BA, Computer Science</option>
                                        <option value="bcomm_combined_cs">BComm, Combined Business / Computer Science (BUCS)</option>
                                        <option value="bcs_second">BCS (Bachelor of CS, 2nd Degree)</option>
                                        <option value="bsc_cog">BSc, Cognitive Systems (Comp. Intelligence and Design)</option>
                                        <option value="bsc_cs">BSc, Computer Science</option>
                                        <option value="bsc_combined_cs_bio">BSc, Combined Major (Computer Science and Biology)</option>
                                        <option value="bsc_combined_cs_math">BSc, Combined Major (Computer Science and Mathematics)</option>
                                        <option value="bsc_combined_cs_micb">BSc, Combined Major (Computer Science and Microbiology and Immunology</option>
                                        <option value="bsc_combined_cs_stats">BSc, Combined Major (Computer Science and Statistics</option>
                                        <option value="bsc_cs_phys">BSc, Combined Major (Computer Science and Physics</option>
                                        <option value="bsc_combined_cs_other">BSc, Combined Major (Computer Science and Another Science Subject</option>
                                        <option value="bsc_honours_cs">BSc, Honours Computer Science</option>
                                    </select><br>
                                    Program of study (other): <br>
                                    <input class="textbox" type="text" value=""><br>
                                    Year of study (according to UBC SSC): <br>
                                    <select>
                                        <option value="year_none">- None -</option>
                                        <option value="firstyr">1st year</option>
                                        <option value="secondyr">2nd year</option>
                                        <option value="thirdyr">3rd year</option>
                                        <option value="fourthyr">4th year</option>
                                        <option value="other">Other</option>
                                    </select><br>
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
                                    <select>
                                      <option value="previousmatched_no">No</option>
                                      <option value="previousmatched_junior">Yes, as a junior student</option>
                                      <option value="previousmatched_senior">Yes, as a senior student</option>
                                      <option value="previousmatched_both">Both junior and senior student</option>
                                    </select><br>
                                    Co-op status: <br>
                                    <select>
                                      <option value="coop_completed">Have completed all co-op terms</option>
                                      <option value="coop_current">Currently a co-op student</option>
                                      <option value="coop_interested">Not a co-op student, but interested in joining co-op</option>
                                      <option value="coop_no">Not a co-op student</option>
                                    </select><br>
                                    Future career plans (choose all that apply): <br>
                                    <input type="checkbox" name="careerplan" value="work_cs">Work in CS-related job immediately after graduation<br>
                                    <input type="checkbox" name="careerplan" value="work_startup">Work for a start-up<br>
                                    <input type="checkbox" name="careerplan" value="work_ownbusiness">Own my own business<br>
                                    <input type="checkbox" name="careerplan" value="masters_phd">Complete a Master's or PhD<br>
                                    <input type="checkbox" name="careerplan" value="work_academic">Work as an academic<br>
                                    <input type="checkbox" name="careerplan" value="career_unsure">Career plans still unsure<br>
                                    <input type="checkbox" name="careerplan" value="career_other">Other (please specify)<br> 
                                    Computer Science areas of interest (please enter as comma-separated list):<br>
                                    <textarea rows="5" cols="100" name="cs_areasofinterest" id="cs_areasofinterest"></textarea><br><br>
                                    Hobbies and interests (please enter as comma-separated list):<br>
                                    <textarea rows="5" cols="100" name="hobbies_interest" id="hobbies_interest"></textarea><br><br>
                                    Additional questions or comments? <br>
                                    <textarea rows="5" cols="100" name="addit" id="additionalcomments_questions"></textarea><br><br>
                                                               
                                
    <button type="submit" class="btn btn-default">Submit</button>
  </form> -->



                 
                                </body>
                                </html>
                    </div>
                </div>
           </div>
       </div>

@endsection
