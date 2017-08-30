<?php session_start(); 
if (!isset($_SESSION['userid'])){
	header('HTTP/1.1 303 See other');
	header('LOCATION: http://projects.michaeldesign.pl/loginsystem/login.php');
}
?>
<!doctype html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Secret society</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="main.css">
		
		<link rel="stylesheet" href="glitch/glitch.css">
</head>

<body>
<?php require_once('header.php') ?>
<div class="container">
	<glitch>
	  <div class="hero">
	  </div>
	  <h1>Welcome, <?php echo $_SESSION['person'];?> </h1>
		  <h2>Sometimes we take the road less travelled &hellip;</h2>
		<p>
		  Sometimes we ended up in the place where we wouldn&#39;t like to end up
		</p>
	   <!-- Extra spacing! -->
	  <br />
	  <br />
	  <br />
	  <br />

	</glitch>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="glitch/glitch.js"></script>

</body>
</html>