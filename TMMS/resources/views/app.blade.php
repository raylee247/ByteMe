<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  <title>Application Form</title> -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/adminhome.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jqueryvalidate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <!--   <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
      <![endif]-->
      <script src="lib/sweet-alert.min.js"></script>
      <script src="{{ asset('/js/jquery-1.10.2.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
    <script src="{{ asset('/js/pattern.js') }}"></script>
    <script src="{{ asset('/js/searchfilter.js') }}"></script>  
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/js/sortable.js') }}"></script>
    <link rel="stylesheet" 
      href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" 
      src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!--    this is the page loading -->
  </head>
  <body>
    @section('navbar')
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
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/about') }}">About</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          @if(Session::has('message'))
          <div class="alert alert-info">
          </div>
          @endif
          @if (Auth::guest())
          <li><a href="{{ url('/auth/login') }}">Sign In</a></li>
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
    @show
    @section('sidebar')
    <div class="main">
      <!-- FIX USER AUTH TO YIELD CONTENT ONLY WHEN LOGGED IN -->
      <div class="container">
        @if (Auth::check())
        <div id="sidebar">
          <div class="nav-side-menu">
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
              <ul id="menu-content" class="menu-content collapse in">
                <li  data-toggle="collapse" data-target="#products" class="collapsed">
                  <a href="#"><span class="glyphicon glyphicon-user"></span> Participant Management<span class="caret"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                  <li><a href="{{ url('/students') }}">Students</a></li>
                  <li><a href="{{ url('/mentors') }}">Mentors</a></li>
                  <li><a href="{{ url('/uploadcsv') }}">Add Participant(s)</a></li>
                  <li><a href="{{ url('/downloadcsv') }}">Export Participant(s)</a></li>
                  <li><a href="{{ url('/waitlist') }}">Manage Waitlist</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><span class="glyphicon glyphicon-cog"></span> Match Making<span class="caret"></a>
                </li>
                <ul class="sub-menu collapse" id="service">
                  <li><a href="{{ url('/currentmatch') }}">Tri-Mentoring Matches</a></li>
                  <li><a href="{{ url('/kickoffmatches') }}">Kickoff Night Matches</a></li>
                  <li><a href="{{ url('/weight') }}">Adjust Weighting</a></li>
                  <li><a href="{{ url('/savedmatches') }}">Saved Matches</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><span class="glyphicon glyphicon-pencil"></span> Application Form<span class="caret"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li><a href="{{ url('/studentform') }}">Student Form</a></li>
                  <li><a href="{{ url('/mentorform') }}">Mentor Form</a></li>
                </ul>
              </ul>
            </div>
          </div>
        </div>
        @show
        @section('main')
        <div class="main-content">
          @yield('content')
          @else  
          @yield('guestcontent')
          @endif
        </div>
      </div>
    </div>
    @show
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
  <script type="text/javascript">
      var dropdown = document.querySelectorAll('.collapsed');
      var dropdownArray = Array.prototype.slice.call(dropdown,0);
      dropdownArray.forEach(function(el){
          var button = el.querySelector('a[data-toggle="collapsed"]'),
                  menu = el.querySelector('.sub-menu collapse'),
                  arrow = button.querySelector('i.icon-arrow');

          button.onclick = function(event) {
              if(!menu.hasClass('show')) {
                  menu.classList.add('show');
                  menu.classList.remove('hide');
                  arrow.classList.add('open');
                  arrow.classList.remove('close');
                  event.preventDefault();
              }
              else {
                  menu.classList.remove('show');
                  menu.classList.add('hide');
                  arrow.classList.remove('open');
                  arrow.classList.add('close');
                  event.preventDefault();
              }
          };
      })

      Element.prototype.hasClass = function(className) {
          return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
      };
  </script>
</html>