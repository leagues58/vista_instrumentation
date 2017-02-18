<?php
	require (__DIR__.'/includes/register_include.php');
?>


<!DOCTYPE html>
<html>

	<head>
		<title>Vista Instrumentation - Register</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
		
		
		<?php if(!empty($strMessage)){
		?> 
			<div id="err"><?=$strMessage?></div>
		<?php
		} ?>
				


		<h1>Register</h1>
		<span>or <a href="login.php">login here</a></span>

		<form action = "register.php" method="POST">
			<input type="text" placeholder="Enter email address" name="email" value="">
			<input type="password" placeholder="Enter password" name="password">
			<input type="password" placeholder="Confirm password" name="passwordConfirm">
			<input type="submit" name="sumbit">

		</form>
		</div>
	</body>
</html>
 