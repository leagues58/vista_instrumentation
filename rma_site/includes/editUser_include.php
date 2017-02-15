<?php
	// begin the session
	session_start();

	// ensure user is valid
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	}

	// imports 
	require (__DIR__.'/../database.php');

	// get a database connection 
	$connection = database_connection();

	// get the rma_id from the querystring
	$lngUserID = $_SERVER["QUERY_STRING"];

	// see if form is submitted and handle if so
	if(!empty($_POST['userName']) && !empty($_POST['userEmail'])){

		// prepare SQL statement
		$strSQL =	"UPDATE user_table
					 SET user_name = :name, user_email = :email, user_address = :address, user_city = :city, user_state = :state, user_zip = :zip, user_country = :country, user_phone = :phone, user_company = :company, user_is_admin = :admin
					 WHERE 
					 	user_id = :userid";

		$record = $connection->prepare($strSQL);

		// bind user-entered info
		$record->bindParam(':name', $_POST['userName']);
		$record->bindParam(':email', $_POST['userEmail']);
		$record->bindParam(':address', $_POST['userAddress']);
		$record->bindParam(':city', $_POST['userCity']);
		$record->bindParam(':state', $_POST['userState']);
		$record->bindParam(':zip', $_POST['userZip']);
		$record->bindParam(':country', $_POST['userCountry']);
		$record->bindParam(':phone', $_POST['userPhone']);
		$record->bindParam(':company', $_POST['userCompany']);
		$record->bindParam(':admin', $_POST['userIsAdmin']);
		$record->bindParam(':userid', $lngUserID);
		
		// execute SQL statement
		if($record->execute()) {
			// yaaay
			
		} else {
			$strMessage = "Could not update user info.  Please try again.";
		}
	}


	// set up variables
	$strMessage = "";
	$strUserName = "";
	$strUserEmail = "";
	$strUserAddress = "";
	$strUserCity = "";
	$strUserState = "";
	$strUserZip = "";
	$strUserCountry = "";
	$strUserPhone = "";
	$strUserCompany = "";
	$bIsAdmin = "";

		

	// get the info for whatever stuff user entered
	$strSQL = 		"SELECT 
						user_name, user_email, user_address, user_city, user_state, user_zip, user_country,
						user_phone, user_company, user_is_admin 
					 FROM 
					 	user_table
					 WHERE 
					 	user_id = :user_id";

	$query = $connection->prepare($strSQL);
	$query->bindParam(':user_id', $lngUserID);

	if($query->execute()) {
		$results = $query->fetch(PDO::FETCH_OBJ);
		if(!empty($results)){
			$strUserName = $results->user_name;
			$strUserEmail = $results->user_email;
			$strUserAddress = $results->user_address;
			$strUserCity = $results->user_city;
			$strUserState = $results->user_state;
			$strUserZip = $results->user_zip;
			$strUserCountry = $results->user_country;
			$strUserPhone = $results->user_phone;
			$strUserCompany = $results->user_company;
			$bIsAdmin = $results->user_is_admin;
	
		}else{
			$strMessage = "This user doesn't exist!";
		}
	}
	




?>