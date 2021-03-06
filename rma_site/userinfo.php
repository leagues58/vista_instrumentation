<?php

	function gfGetUserInfo($connection) {
		if(isset($_SESSION['user_id'])) {

			$user = NULL;
			$strSQL =	"SELECT 
							user_id, user_name, user_email, user_address, user_city, user_state, user_zip, user_country,
							user_phone, user_company, user_registration_date, user_is_admin
						FROM user_table
						WHERE
							user_id = :id";

			$records = $connection->prepare($strSQL);
			$records->bindParam(':id', $_SESSION['user_id']);
			
			try{
				$records->execute();	
			} catch(PDOException $e) {
				$strMessage = "Failed to load user info.";
			}
			
			$results = $records->fetch(PDO::FETCH_ASSOC);


			if(count($results) > 0) {
				$user = $results;
			} else {
				$strMessage = "User not found.";
				exit;
			}
		} else {
			$strMessage = "User not found.";
			exit();
		}	

		return $user;
	}
	
?>