<?php
	// begin the session
	session_start();

	// if user already has a session there's no need to be here, so redirect to account.php
	if(isset($_SESSION['user_id'])) {
		header("Location: account.php");
	}

	// imports 
	require (__DIR__.'/../database.php');

	// get a database connection 
	$connection = database_connection();


	// if posting
	if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {

		// check to see if they have an entry in the user table
		$strSQL = 	"SELECT 
						user_id, user_email, user_is_admin
					FROM user_table
					WHERE
						user_email = :email
						AND user_created = 0
					";

		$query = $connection->prepare($strSQL);
		$query->bindParam(':email', $_POST['email']);

		// if they do, make sure the passwords match, and then update the password and set to verified account
		if($query->execute()) {
			
			$results = $query->fetch(PDO::FETCH_ASSOC);
			if(!empty($results)>0) {

				if($_POST['password'] != $_POST['passwordConfirm']) {
					$strMessage = "These passwords don't match!";
				} else {
					$strSQL = 	"UPDATE user_table 
								 SET 
								 	user_password = :password,
								 	user_created = 1
								 WHERE 
								 	user_id = :user_id";

					$query = $connection->prepare($strSQL);
					$query->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
					$query->bindParam(':user_id', $results['user_id']);

					if($query->execute()) {
						if ($results['user_is_admin']) {
							$_SESSION['user_id'] = $results['user_id'];
							header("Location: adminpage.php");	
						} else {
							$_SESSION['user_id'] = $results['user_id'];
							header("Location: account.php");	
						}
					}
				}
				// if there is no record for this person in the database
			} else {
				$strMessage = "Please contact the site administrator to set up an account.";
		}
	}
}	


?>