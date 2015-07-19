<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	
  <title>Anton Apps</title>
	
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="/css/cosmo.min.css">
  <link rel="stylesheet" href="/sb-admin/css/sb-admin.css">

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- HighCharts -->
  <script src="http://code.highcharts.com/highcharts.js"></script>

</head>
<body>
  <div class="wrapper">
      
      @include('sidebar')

	    @yield('content')

  </div>
</body>
</html>