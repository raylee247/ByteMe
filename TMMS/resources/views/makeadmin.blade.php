@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Make New Admin</div>
				<div class="panel-body">
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
					@if (Session::has('flash_message'))
   						<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
					@endif
					{!! Form::open(['url' => 'makeadmin']) !!}
						<!-- Name Input -->
						<div class="form-group">
							{!! Form::label('name', 'Name: ') !!}
							{!! Form::text('name', null, ['class' => 'form-control']) !!}
						</div>

						<!-- Email Input -->
						<div class="form-group">
							{!! Form::label('email', 'Email: ') !!}
							{!! Form::text('email', null, ['class' => 'form-control']) !!}
						</div>

						<!-- Password Input -->
						<div class="form-group">
							{!! Form::label('password', 'Password: ') !!}
							{!! Form::password('password', null, ['class' => 'form-control']) !!}
						</div>

						<!-- Password Confirmation Input -->
						<div class="form-group">
							{!! Form::label('password_confirmation', 'Password Confirmation: ') !!}
							{!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
						</div>

						<!-- Register Button --> 
						<div class="form-group">
							{!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
