<?php
	session_start();

	if(isset($_SESSION['user_id'])) {
		header("Location: account.php");
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Vista Instrumentation</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	</head>
	<body>

		<div class="header">
			<a href="index.php">Vista Instrumentation</a>
		</div> 

			<h2>Please <a href="login.php">Login</a> or <a href="register.php">Register</a></h2>
			

	</body>
</html>