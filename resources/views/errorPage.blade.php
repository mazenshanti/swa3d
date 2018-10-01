
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Error Page</title>
		<link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('vendor/css/error.css') }}" rel="stylesheet">
		<link rel="stylesheet" href=" {{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}">

  </head>

  <body id="container" class="site-wrapper">

		<div class="fa fa-exclamation-circle" aria-hidden="true" id="background">			</div>
	    <div class="box" id="bluebox"><!-- flex item -->

				<div class="inner cover ">
			            <h1 class="cover-heading" style="">Error <i class="fa fa-exclamation" aria-hidden="true"></i>
</h1>
									<h1 style="    margin-bottom: 36px;">
										{{$errors->first()}}
									</h1>
											<a href="{{route('main')}}" class="btn btn-lg error-btn btn-secondary">
											<i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;   Go Home</a>
			            <p class="lead">
			            </p>
			    </div>
				</div>



  </body>
</html>
