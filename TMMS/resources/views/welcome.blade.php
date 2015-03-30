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
				top: 75px;
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





	{!! HTML::image('images/stockfresh_131055_new-business-strategies_sizeM_6db108.jpg') !!};





				<div class="title"><b>TMMS</b></div>
				<a href="{{ url('/mentorapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Mentor</button></a>
				<a href="{{ url('/studentapp') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span> Apply As Student</button></a>
				<a href="{{ url('home') }}"><button type="button"class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span>Admin Login</button></a>
			</div>
		</div>
	</body>
</html>
