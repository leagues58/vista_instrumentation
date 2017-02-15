<?php

	// imports 
	require (__DIR__.'/../database.php');

	// get a database connection 
	$connection = database_connection();

	// get the rma_id from the querystring
	$lngRmaID = $_SERVER["QUERY_STRING"];

	// update the rma_table
	$strSQL = 	"UPDATE rma_table 
				 SET 
				 	rma_is_resolved = 1
				 WHERE 
				 	rma_id = :rma_id";

	$query = $connection->prepare($strSQL);
	$query->bindParam(':rma_id', $lngRmaID);

	// if successful, return the rma_id to the admin page
	if($query->execute()) {
		echo $lngRmaID;
	}

?>