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
    @if (Session::has('updated'))
      <span style="color:green"> {!! Session::get('updated') !!} </span>
    @endif
    @if (Session::has('notUpdated'))
      <span style="color:green"> {!! Session::get('notUpdated') !!} </span>
    @endif  
    <a class="btn btn-danger" href="http://localhost/blog/public/form">Insert new data</a>
		<table class="table table-hover table-bordered">
		    <thead>
		        <tr>
		            <th>Full Name</th>
		            <th>E-mail</th>
		            <th>Photo</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach ($user as $key => $data)
		        <tr>
					 <td>{{$data->name}}</td>
					 <td>{{$data->email}}</td>
					 <td><img src="{{url('uploads')}}/{{$data->photo}}" alt="image"></td>
					 <td><a class="btn btn-success" href="{{url('edit')}}/{{$data->user_id}}">Edit</a> | <a class="btn btn-success" href="{{url('delete')}}/{{$data->user_id}}">Delete</a></td>
				 </tr>
				@endforeach
		    </tbody>

		</table>
		    {{ $user->render() }}
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="resource/js/bootstrap.min.js"></script>
  </body>
</html>