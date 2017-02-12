<?php
	session_start();

	// ensure user is valid
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	}

	// imports
	require('database.php');
	require 'userinfo.php';

	// get a database connection
	$connection = database_connection();

	// get user info
	$user = gf_get_user_info($connection);

	// if user is not admin, redirect to normal account page
	if(!isset($user['user_is_admin'])) {
		header("Location: account.php");
	}
	

	// see if new user form is submitted and handle if so
	if(!empty($_POST['newName']) && (!empty($_POST['newEmail'])) && (!empty($_POST['newCompany'])) ){

		if (empty($_POST['newAdmin'])) {
			$_POST['newAdmin'] = false;
		} else {
			$_POST['newAdmin'] = true;
		}

		if(createNewUser($_POST['newName'], $_POST['newEmail'], $_POST['newCompany'], $_POST['newAdmin'])){
			$strMessage = "User successfully created.";
		} else {
			$strMessage = "Unable to create new user.  Please try again";
		}
	}








/************************** LOCAL FUNCTIONS ***********************************************************/


	// function to insert new users into the user_table
	function createNewUser($strNewName, $strNewEmail, $strNewCompany, $bUserIsAdmin) {

		$dtDate = date('Y-m-d G:i:s');

		
		$strSQL =	"INSERT INTO user_table 
						(user_name, user_email, user_registration_date, user_company, user_is_admin)
					VALUES 
						(:userName, :userEmail, :userDate, :userCompany, :userAdmin)";
		$connection = database_connection();
		$query = $connection->prepare($strSQL);
		$query->bindParam(':userName', $strNewName);
		$query->bindParam(':userEmail', $strNewEmail);
		$query->bindParam(':userDate', $dtDate);
		$query->bindParam(':userCompany', $strNewCompany);
		$query->bindParam(':userAdmin', $bUserIsAdmin);

		if($query->execute()) {
			return true;
		} else {
			return false;

		}	
	}


	function displayUsersTable() {

		$strSQL = 	"SELECT 
						user_id, user_name, user_email, user_registration_date, user_company, user_is_admin, user_created
					FROM user_table";

		$connection = database_connection();
		$records = $connection->prepare($strSQL);
		$records->execute();


		echo 	"
					<script>
						jQuery(document).ready(function($) {
    						$('td').hover(function() {
        						
    						});
						});
					</script>

				";

		echo "<table class='admintable'>";
		echo("<tr>
				<th class='lefttab'>User Name</th>
				<th class='lefttab'>User Email</th>
				<th class='lefttab'>User Registration Date</th>
				<th class='lefttab'>User Company</th>
				<th class='lefttab'>Admin</th>
				<th class='lefttab'>Account Created</th>
			</tr>");

		while($results = $records->fetch(PDO::FETCH_OBJ)) {
			echo("<tr>");
			
			echo("<td class='righttab'>" . $results->user_name . "</td>");
			echo("<td class='righttab'>" . $results->user_email . "</td>");
			echo("<td class='righttab'>" . substr($results->user_registration_date,0,10) . "</td>");
			echo("<td class='righttab'>" . $results->user_company . "</td>");
			echo("<td class='righttab'>" . $results->user_is_admin . "</td>");
			echo("<td class='righttab'>" . $results->user_created . "</td>");
			echo("<td class='editfield'><a href='editUser.php?".$results->user_id."'>Edit</a></td>");
			echo("</tr>");
		}


		echo "</table>";
	}


	function displayRMAs() {

		$strSQL = 	"SELECT 
						rma_id, rma_date_filed, rma_vehicle, rma_description, rma_is_resolved, UT.user_name, UT.user_company
					FROM rma_table RT
					INNER JOIN user_table UT
						ON RT.rma_filed_by = UT.user_id";

		$connection = database_connection();			
		$record = $connection->prepare($strSQL);
		$record->execute();?>

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
					echo "<td id ='". $results->rma_id . "' ><input type='checkbox' name='". $results->rma_id ." '></td>";
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

	function displayCompanyOptions() {

	$strSQL = 	"SELECT DISTINCT
					user_company
				FROM user_table UT
				";

		$connection = database_connection();			
		$record = $connection->prepare($strSQL);
		$record->execute();
		?>
			<option name="all">All</option>

		<?php
		while($results = $record->fetch(PDO::FETCH_OBJ)) {
			if($results->user_company == "") {
				$results->user_company = "None";
			}
			?>
				<option name ="<?php echo $results->user_company?>"><?php echo $results->user_company?></option>

		<?php
		}
	}
		?>










