<?php

	function database_connection() {
		// set up connection variables
		require(__DIR__.'/../credentials.php');

		// connect to the database
		try{
			$connection = new PDO("mysql:host=$host; dbname=$database", $username,$password);	
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $err) {
			echo $err->getMessage();
			die();
		}

		return $connection;	
	}
	

?>