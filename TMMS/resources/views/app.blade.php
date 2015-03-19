<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--  <title>Application Form</title> -->

  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/adminhome.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
<!--   <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- Fonts -->
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <![endif]-->

    <script src="{{ asset('/js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('/js/adminhome.js') }}"></script>
    <script src="{{ asset('/js/searchfilter.js') }}"></script>  
    <script src="{{ asset('/js/app.js') }}"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="{{ asset('/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/js/sortable.js') }}"></script>







   <!-- Latest compiled and minified JavaScript -->
 </head>
 <body>

  <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapsed" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       @if (Auth::guest())
       <a class="navbar-brand" href="{{ url('/') }}">TMMS</a>
       @else
      <a class="navbar-brand" href="{{ url('/home') }}">TMMS</a>
      @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#">About</a></li>      
        <li><a href="#">Contact Us</a></li>
      </ul>   
      <ul class="nav navbar-nav navbar-right">

        @if(Session::has('message'))
        <div class="alert alert-info">

        </div>
        @endif

        @if (Auth::guest())
        <li><a href="{{ url('/auth/login') }}">Sign In</a></li> 
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
        @else
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
         <ul class="dropdown-menu" role="menu">
          <li><a href={{url('/makeadmin')}}>Make New Admin</a></li>
          <li><a href={{url('/password/email')}}>Change Password</a></li>
          <li><a href={{url('/log')}}>View Logs</a></li>
          <li role="presentation" class="divider"></li>
          <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
        </ul>
      </li>
      @endif
    </ul>
  </div>
</nav>

<!-- FIX USER AUTH TO YIELD CONTENT ONLY WHEN LOGGED IN -->
<div class="container">
   @if (Auth::check())
  <div id="sidebar">
    <ul>
      <li><a href="#">Participant Management</a>
        <ul>
          <li><a href="{{ url('/students') }}">Students</a></li>
          <li><a href="{{ url('/mentors') }}">Mentors</a></li>
          <li><a href="{{ url('/uploadcsv') }}">Add Participant(s)</a></li>
          <li><a href="{{ url('/downloadcsv') }}">Export Participant(s)</a></li>
          <li><a href="{{ url('/waitlist') }}">Waitlist</a></li>
        </ul></li>
        <li><a href="#">Match Making</a>
          <ul>
            <li><a href="{{ url('/currentmatch') }}">Current Selection</a></li>
            <li><a href="{{ url('/weight') }}">Adjust Weighting</a></li>
            <li><a href="{{ url('/savedmatches') }}">Saved Matches</a></li>
          </ul></li>
          <li><a href="#">Application Form</a>
            <ul>
              <li><a href="{{ url('/studentform') }}">Student Form</a></li>
              <li><a href="{{ url('/mentorform') }}">Mentor Form</a></li>
            </ul></li>
          </ul>
        </div>
        <div class="main-content">
          @yield('content')
        </div>
        @else
          @yield('guestcontent')
          @endif
      </div>

  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    </body>
    </html>