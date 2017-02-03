<?php
	// begin the session
	session_start();

	// if user already has a session there's no need to be here, so redirect to account.php
	if(isset($_SESSION['user_id'])) {
		header("Location: account.php");
	}

	

	// if posting form
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		
		// imports 
		require 'database.php';

		// get a database connection 
		$connection = database_connection();
		

		// get the info for whatever stuff user entered
		$strSQL = 		"SELECT 
							user_id, user_email, user_password, user_is_admin
						 FROM 
						 	user_table
						 WHERE 
						 	user_email = :email";

		$record = $connection->prepare($strSQL);
		$record->bindParam(':email', $_POST['email']);
		$record->execute();
		$results = $record->fetch(PDO::FETCH_ASSOC);


		// if returned info has a password match and is an admin, redirect to admin page, else redirect to regular page
		if(count($results)>0 && password_verify($_POST['password'], $results['user_password'])) {
			if ($results['user_is_admin']) {
				$_SESSION['user_id'] = $results['user_id'];
				header("Location: adminpage.php");	
			} else {
				$_SESSION['user_id'] = $results['user_id'];
				header("Location: account.php");	
			}
		}
		else {
			$message = "Sorry, could not log in. Please reenter your email and password.";
		}
	}
?>
