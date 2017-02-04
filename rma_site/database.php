<?php

	function database_connection() {
		// set up connection variables
		$host = 'localhos';
		$username = 'root';
		$password = '';
		$database = 'rma_site_db';

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