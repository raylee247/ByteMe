<html>
	<head>
		<title>TMMS</title>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
		<style>
			body {
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
			color: #B0BEC5;
			display: table;
			font-weight: 100;
			font-family: 'Lato';
			}
			.container {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
			top: 25px;
			}
			.content {
			text-align: center;
			display: inline-block;
			}
			.title {
			font-size: 96px;
			margin-bottom: 40px;
			}
			.quote {
			font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<h1>
					<div class="title"><b>TMMS</b></div>
				</h1><br>
				<h1>Tri-Mentoring Matching System
				</h1><br>
				<p>		
					<a href="{{ url('/mentorapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Mentor</button></a>
					<a href="{{ url('/studentapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Student</button></a>
					<a href="{{ url('home') }}"><button type="button"class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Admin Login</button></a><br><br><br><br><br>
				</p>
				Brought to you by: <br>{!! HTML::image('images/Byteme_logo.gif', "Logo", array('height'=>'90','width'=>'100')) !!};
			</div>
		</div>
	</body>
	<style type="text/css">
		body{
		background:     
		url('images/welcome_background.jpg');
		background-size: cover;
		color: #7A7A99;
		font-weight: 800;
		}
		h1{
		font-weight: 800;
		}
		.btn {
			font-weight: 800;
		}
	</style>
</html>