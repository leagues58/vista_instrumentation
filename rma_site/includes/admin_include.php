<?php
	session_start();

	// ensure user is valid
	if(!isset($_SESSION['user_id'])) {
		header("Location: index.php");
	}

	// imports
	require(__DIR__.'/../database.php');
	require(__DIR__.'/../userinfo.php');

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
		?>

		<table class='admintable'>
			<tr>
				<th class='lefttab'>User Name</th>
				<th class='lefttab'>User Email</th>
				<th class='lefttab'>User Registration Date</th>
				<th class='lefttab'>User Company</th>
				<th class='lefttab'>Admin</th>
				<th class='lefttab'>Account Created</th>
			</tr>

		<?php while($results = $records->fetch(PDO::FETCH_OBJ)) {  ?>
			<tr>
			
				<td class="righttab"> <?=$results->user_name?> </td>
				<td class="righttab"> <?= $results->user_email?> </td>
				<td class="righttab"> <?= substr($results->user_registration_date,0,10)?> </td>
				<td class="righttab"> <?= $results->user_company ?> </td>
				<td class="righttab"> <?= $results->user_is_admin ?> </td>
				<td class="righttab"> <?= $results->user_created ?> </td>
				<td class="righttab"> <a href='#' onclick='window.open("editUser.php?id=<?= $results->user_id?>", "", "resizable=yes, width=300, height=500px top=50, left=200");'>Edit</a></td>
			</tr>
		<?php }
 		?>

		</table>
	<?php 
		}
		?>

<?php
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
			while($results = $record->fetch(PDO::FETCH_OBJ)) { ?>
				<tr>
				<td> <?=$results->rma_id?> </td>
				<td> <?=$results->rma_vehicle?> </td>
				<td class='description'> <?= $results->rma_description ?> </td>
				<td> <?=substr($results->rma_date_filed,0,10) ?> </td>
				<td> <?=$results->user_name ?> </td>
				<td> <?=$results->user_company ?> </td>

				<?php 
				if(!$results->rma_is_resolved) { ?>
					<td id =' <?=$results->rma_id?>' ><input type='checkbox' name='<?=$results->rma_id?>'></td>
				<?php } else { ?>
					<td>Yes</td>	
				<?php }
				?>
			<td><a href="#" onclick='window.open("notes.php?id=<?= $results->rma_id?>", "", "resizable=yes, width=800, height=600px top=50, left=200");'>Notes</a</td>
				</tr>
							
				<?php
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










