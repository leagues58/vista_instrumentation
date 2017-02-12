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

	// variables
	$connection;
	$strAddressPlaceholder = "";
	$strCityPlaceholder = "";
	$strStatePlaceholder = "";
	$strZipPlaceholder = "";
	$strCountryPlaceholder = "";
	$strPhonePlaceholder = "";


	// get database connection
	$connection = database_connection();

	// get user info
	$user = gf_get_user_info($connection);

	// see if form is submitted and handle if so
	if(!empty($_POST['vehicle']) && !empty($_POST['description']) && !empty($_POST['part'])){
		$strVehicle = $_POST['vehicle'];
		$description = $_POST['description'];
		$part = $_POST['part'];
		$bSaveToAccout = $_POST['savetoaccount'];
		submitRma($strVehicle, $part, $description, $user['user_id'], $bSaveToAccout);
	}

	// set up pre-filled address fields, if available
	if (!empty($user['user_address'])){
		$strAddressPlaceholder = $user['user_address'];
	}

	if (!empty($user['user_city'])){
		$strCityPlaceholder = $user['user_city'];
	} 

	if (!empty($user['user_state'])){
		$strStatePlaceholder = $user['user_state'];
	}

	if (!empty($user['user_zip'])){
		$strZipPlaceholder = $user['user_zip'];
	}

	if (!empty($user['user_country'])){
		$strCountryPlaceholder = $user['user_country'];
	}
	if (!empty($user['user_phone'])) {
		$strPhonePlaceholder = $user['user_phone'];
	}


	// local functions ****************************************************************************************************************

	function submitRma($strVehicle, $part, $description, $user_id, $bSaveToAccout) {

		$connection = database_connection();

		// prepare SQL statement
		$strSQL =	"INSERT INTO rma_table
						(rma_vehicle, rma_part, rma_description, rma_filed_by)
					VALUES
						(:vehicle, :part, :description, :user)";

		$record = $connection->prepare($strSQL);

		// bind user-entered info
		$record->bindParam(':vehicle', $strVehicle);
		$record->bindParam(':part', $part);
		$record->bindParam(':description', $description);
		$record->bindParam(':user', $user_id);

		// execute SQL statement
		try {
			$record->execute();	
		} catch(PDOException $e) {
			$message = "Could not submit RMA.  Please try again.";
		}

		// get varibles to send to print out page
		$id = $connection->lastInsertId();
		$_SESSION['rma_number'] = $id;

		// save if address info, if boolean set
		if($bSaveToAccout) {
			$strSQL = 	"UPDATE user_table set 
							user_address = :address,
							user_city = :city,
							user_state = :state,
							user_zip = :zip,
							user_country = :country,
							user_phone = :phone
						WHERE
							user_id = :user";

			$record = $connection->prepare($strSQL);

			$record->bindParam(':address', $_POST['address']);
			$record->bindParam(':city', $_POST['city']);
			$record->bindParam(':state', $_POST['state']);
			$record->bindParam(':zip', $_POST['zip']);
			$record->bindParam(':country', $_POST['country']);
			$record->bindParam(':phone', $_POST['phone']);
			$record->bindParam(':user', $user_id);

			$record->execute();
		}

		// redirect to print out page
		Header("Location: printOut.php");

	
	}


	function displayRmas() {

		$connection = database_connection();

		$strSQL =	"SELECT 
						rma_id, rma_date_filed, rma_vehicle, rma_description, rma_part, rma_is_resolved, user_name, user_company
					FROM rma_table
					INNER JOIN user_table
						ON rma_table.rma_filed_by = user_table.user_id
					WHERE
						rma_filed_by = :user_id";


		$record = $connection->prepare($strSQL);
		$record->bindParam(':user_id', $_SESSION['user_id']);

		$record->execute();

		?>
		<table id="rmatable" class="admintable">
			<col width="100">
			<col width="100">
  			<col width="100">
  			<col width="100">
			<col width="100">
			<col width="100">
			<col width="100">
			<tr class="selector" colspan=7>

			</tr>

			<tr>
				<th class='lefttab'>RMA#</th>
				<th class='lefttab'>Vehicle</th>
				<th class='lefttab'>Description</th>
				<th class='lefttab'>Date Created</th>
				<th class='lefttab'>Filed By</th>
				<th class='lefttab'>Company</th>
				<th class='lefttab'>Is Resolved</th>
				<th class='lefttab'></th>
			</tr>
			<?php
			while($results = $record->fetch(PDO::FETCH_OBJ)) {
				echo "<tr>";
				echo "<td>". $results->rma_id . "</td>";
				echo "<td>". $results->rma_vehicle . "</td>";
				echo "<td class='description'>". $results->rma_description . "</td>";
				echo "<td>". substr($results->rma_date_filed,0,10) . "</td>"; 
				echo "<td>". $results->user_name . "</td>"; 
				echo "<td>". $results->user_company . "</td>"; 
				if(!$results->rma_is_resolved) { 
					echo "<td id ='". $results->rma_id . "' ></td>";
				} else {
					echo "<td>Yes</td>";	
				}?>
				
				<td><a href="#" onclick='window.open("notes.php?id=<?= $results->rma_id?>", "", "resizable=yes, width=800, height=600px top=50, left=200");'>Notes</a</td>
				
				<?php
				echo "</tr>";
			} ?>

		</table>












<?php

	}


?>