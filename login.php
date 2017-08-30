<?php session_start(); ?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>login | Secret society</title>
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
			<p>It takes courage to make this one step that is needed to enter the secret</p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<legend>Login to the secret society</legend>
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="col-md-12 box">	
					<div class="input-group">
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
		<div class="col-lg-6 col-lg-offset-3">
			<?php 
				require_once('db_con.php');

				echo "<div class='alert alert-success' role='alert'>Connected to the database</div>";

				// NOTE. IN ORDER TO LOG IN I DECIDED TO USE MAIL INSTEAD OF THE 'NAME' THAT USER GAVE WHEN EGISTERING 	  

				// if not empty - user clicks sing up button
					if(!empty(filter_input(INPUT_POST, 'submit'))){
						//read all inputs and validate them
						$mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL)
							or die("<div class='alert alert-danger' role='alert'>Incorrect mail</div>");
						$password = filter_input(INPUT_POST, 'password')
							or die("<div class='alert alert-danger' role='alert'>Empty or incorrect password</div>");

						$sql = 'SELECT ID, username, passwordhash FROM logintest WHERE mail=?';
						$stmt = $con->prepare($sql); //let's prepare to execute our sql, it's gonna be stored in $stmt
						$stmt->bind_param('s', $mail);
						$stmt->execute();
						$stmt->bind_result($userid, $person, $passwordhash);
						while($stmt->fetch()){}
						if (password_verify($password, $passwordhash)){
							echo 'logged in as user '.$userid.', '.$person;
							$_SESSION['userid'] = $userid;
							$_SESSION['username'] = $mail; 
							$_SESSION['person'] = $person; //change this cuz youre just confusing people lol
							print_r($_SESSION);
							header('HTTP/1.1 303 See other');
							header('LOCATION: http://projects.michaeldesign.pl/loginsystem/index.php');
							}
						else{
							echo "<div class='alert alert-danger' role='alert'>Check your email or password and try again</div>";

						}

					}  
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg6">
			<div class="alert alert-light" role="alert">
			  Are you not in the Secret society? Don&#39;t worry! You can join us in couple of seconds. <a href="register.php" class="alert-link">Just fill the registration form here.</a>
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
</body>
</html>