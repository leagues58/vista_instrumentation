<?php
	require (__DIR__.'/includes/login_include.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vista Instrumentation - Login</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>


	<div class="header">
		<a href="../index.php">Vista Instrumentation</a>
	</div> 

	<?php if(!empty($message)) { ?>
			<p><?=$message?></p>
	<?php } ?>

	
	<h1>Login</h1>

	<form action = "login.php" method="POST">
		<input type="text" placeholder="Enter email address" name="email" required>
		<input type="password" placeholder="Enter password" name="password" required>
		<input type="submit" name="sumbit">
	</form>
	
	
</body>
</html>
