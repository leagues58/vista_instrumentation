<?php

	session_start();

	// ensure user is valid
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
		exit;
	}

	// imports
	require ('database.php');
	require ('userinfo.php');


	// get database connection
	$connection = database_connection();


	// declare variables
	$lngRMAID = $_GET['id'];
	$strSQL = "";
	$records;
	$connection;
	$insertID;
	$message = "";


	// see if new user form is submitted and handle if so
	if(!empty($_POST['notetext'])){

		// first, see if there is an existing note header
		$strSQL = "	SELECT nh_id 
					FROM note_header_table
					WHERE 
						rma_id = :id";

		$records = $connection->prepare($strSQL);
		$records->bindParam(':id', $lngRMAID);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_OBJ);

		
		if(!empty($results)){

			$insertID = $results->nh_id;

		} else {

			$strSQL = 	"INSERT INTO note_header_table
							(rma_id, user_id, date_created)
						VALUES
							(:rmaid, :userid, :datecreated)";

			$records = $connection->prepare($strSQL);

			$records->bindParam(':rmaid', $lngRMAID);
			$records->bindParam(':userid', $_SESSION['user_id']);
			$records->bindParam(':datecreated', date('Y-m-d H:i:s'));

			try {
				$records->execute();	
			} catch(PDOException $e) {
				$message = "Could not add note.  Please try again.";
			}

			$insertID = $connection->lastInsertId();
		}

		$strSQL = 	"INSERT INTO note_table
						(nh_id, note_text, note_date_entered, note_date_changed)
					VALUES
						(:nhid, :notetext, :dateentered, :datechanged)";

		$records = $connection->prepare($strSQL);

		$records->bindParam(':nhid', $insertID);
		$records->bindParam(':notetext', $_POST["notetext"]);
		$records->bindParam(':dateentered', date('Y-m-d H:i:s'));
		$records->bindParam(':datechanged', date('Y-m-d H:i:s'));

		try {
			$records->execute();	
		} catch(PDOException $e) {
			$message = "Could not add note.  Please try again.";
		}
	}




	// load in all the notes
	$strSQL = 	"SELECT 
					nht.nh_id, nt.note_text, nt.note_date_entered
				FROM note_header_table nht 
				INNER JOIN note_table nt
					ON nht.nh_id = nt.nh_id
				WHERE 
					nht.rma_id = :id";

	$records = $connection->prepare($strSQL);
	$records->bindParam(':id', $lngRMAID);
	$records->execute();

	while($results = $records->fetch(PDO::FETCH_OBJ)) { ?>
		<p>
			<?= $results->note_text?>

		</p>
	


	<?php
	}


?>