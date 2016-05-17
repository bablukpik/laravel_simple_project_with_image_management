<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="resource/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container"> 
  <a class="btn btn-danger" href="http://localhost/blog/public/showalldata">View data</a>

 		{{ Form::open(array('action' => ['SimpleController@update', $dbUpdateData->user_id], 'files' => true)) }}
 			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Full Name</label>
			    <input type="text" value="{{$dbUpdateData->name}}" name="form_name" class="form-control" id="exampleInputEmail1" placeholder="Full Name">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">E-mail</label>
			    <input type="text" value="{{$dbUpdateData->email}}" name="form_email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" value="{{$dbUpdateData->password}}" name="form_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputFile">Image</label>
			    <input type="file" name="form_file" id="exampleInputFile">
			    <img src="{{url('uploads')}}/{{$dbUpdateData->photo}}" alt="image">
			    @if ($errors->has('form_file'))
	           		<span style="color:red">{!! $errors->first('form_file', '') !!}</span>
	          	@endif
			  </div>
			  <button type="submit" class="btn btn-default">Update</button>
		{{ Form::close() }}
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="resource/js/bootstrap.min.js"></script>
  </body>
</html>