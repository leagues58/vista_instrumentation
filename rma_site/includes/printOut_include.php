<?php

	session_start();

	// ensure user is valid
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
		exit;
	}

	// imports
	require ('database.php');


	// get the database connection
	$connection = database_connection();

	// get rma number from session variable
	$strRmaNumber = $_SESSION['rma_number'];


	// query for rma info for print out
	$strSQL = "	SELECT 
					user_name, user_address, user_city, user_state, user_zip, user_country, user_phone,
					user_company, user_email, rma_vehicle, rma_part, rma_date_filed, rma_description, rma_filed_by
				FROM rma_table
				INNER JOIN user_table
					ON rma_table.rma_filed_by = user_table.user_id
				WHERE rma_table.rma_id = :rma_id";


	$record = $connection->prepare($strSQL);
	$record->bindParam(':rma_id', $strRmaNumber);
	$record->execute();
	$results = $record->fetch(PDO::FETCH_ASSOC);

	// return variables
	$strVehicle		 		= $results['rma_vehicle'];
	$strPart				= $results['rma_part'];
	$strDescription		 	= $results['rma_description'];
	$strCompanyName 		= $results['user_company'];
	$strUserName 			= $results['user_name'];
	$strUserEmail			= $results['user_email'];
	$strUserAddress			= $results['user_address'];
	$strUserCity			= $results['user_city'];
	$strUserState			= $results['user_state'];
	$strUserZip				= $results['user_zip'];
	$strUserCountry			= $results['user_country'];
	$strUserPhone			= $results['user_phone'];
	$dtDateFiled			= substr($results['rma_date_filed'], 0, 10);


?>