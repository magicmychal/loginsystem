<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>sing up | Secret society</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="main.css">
	</head>
<body>
<?php require_once('header.php') ?>
<div class="container">
	<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<h2>Join us simply by giving your name, e-mail and password!</h2>
				<p>We respect your privacy, thus all the passwords are encrypted and we are not able to restore them.</p>
				<p>Please remember, once registered you cannot go  back.</p>
			</div>
		</div>
	<div class="row">
		<div class="col-lg-12 box">
			<legend>Sing up to the secret society</legend>
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="col-md-12">	
					<div class="input-group">
						<input type="text" name="name" placeholder="Name" class="form-control" aria-describedby="basic-addon1" required>
						<input type="email" name="mail" class="form-control" placeholder="E-mail" aria-describedby="basic-addon1" required>
						<input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
					  <span class="input-group-btn">
						<input type="submit" class="btn btn-default" name="submit" value="go!">
					  </span>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php 
	require_once('db_con.php');
		  
	
	// if not empty - user clicks sing up button
		if(!empty(filter_input(INPUT_POST, 'submit'))){
			//read all inputs and validate them
			$user = filter_input(INPUT_POST, 'name')
				or die('Invalid Name input');
			$mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL)
				or die('Incorrect mail');
			$password = filter_input(INPUT_POST, 'password')
				or die('Empty or incorrect password');
			// now, when we have all from user, password is beeing hashed and saled
			$password = password_hash($password, PASSWORD_DEFAULT);
			
			//checking if the user exist in the database
			$sqlcheck = 'SELECT mail FROM logintest WHERE mail=?';
			$stmtcheck = $con->prepare($sqlcheck);
			$stmtcheck->bind_param('s', $mail);
			$stmtcheck->execute();
			$stmtcheck->bind_result($mailcheck);
			while($stmtcheck->fetch()){}
			if($mail == $mailcheck){
				echo "<div class='alert alert-danger' role='alert'>
					  This mail is already in our database.
					 </div>";
			}
			else{
			
			//now when everything works fine, it's time to put those infromation to the database
			$sql = 'INSERT INTO logintest (username, mail, passwordhash) VALUES (?,?,?)';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('sss', $user, $mail, $password);
			$stmt->execute();
			
			//displaying success alert
			echo "<div class='alert alert-success' role='alert'>
				  <h4 class='alert-heading'>Well done!</h4>
				  <p>Aww yeah, ".$user." ,you successfully signed up to the Secret society and now you&#39;re part of our community. Naw you can <a href='index.php' class='alert-link'>go back to the main page and login</a></p>
				</div>";
			
			echo 'Added '.$stmt->affected_rows.' users';
			
		}
			
		}  
?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg6">
			<div class="alert alert-light" role="alert">
			  Are you already a member of the Secret society?<a href="login.php" class="alert-link">Log in here!</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>