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





	{!! HTML::image('images/Mentorship_560x312.jpg', "Logo",array('height'=>'350','width'=>'750')) !!};

				<div class="title"><b>TMMS</b></div><br>
				<a href="{{ url('/mentorapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Mentor</button></a>
				<a href="{{ url('/studentapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Student</button></a>
				<a href="{{ url('home') }}"><button type="button"class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span>Admin Login</button></a><br><br>
				Brought to you by: {!! HTML::image('images/Logo.jpg', "Logo", array('height'=>'90','width'=>'100')) !!};
			</div>
		</div>
	</body>
</html>
