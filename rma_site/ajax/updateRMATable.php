<?php
	// imports 
	require '../database.php';

	// get a database connection 
	$connection = database_connection();

	// get the sort options from the querystring
	$strSortByType = $_GET["type"];
	$strSortByCompany = $_GET["company"];

	$bResolved = "false";
	$bUnresolved = "false";
	$bBoth = "false";


	if($strSortByType == "resolved") {
		$strWhere = "rma_is_resolved = 1 ";
		$strResolved = "true";
	} else if($strSortByType == "unresolved") {
		$strWhere = "rma_is_resolved = 0 ";
		$strUnresolved = "true";
	} else if ($strSortByType == "both") {
		$strWhere = "rma_is_resolved IS NOT NULL ";
		$strBoth = "true";
	}

	if($strSortByCompany != "All" and $strSortByCompany != "None") {
		$strWhere = $strWhere . "AND user_company = '$strSortByCompany'";
	} else if($strSortByCompany == "All") {
		$strWhere = $strWhere . "AND user_company IS NOT NULL";
	}


	$strSQL = 	"SELECT 
					rma_id, rma_date_filed, rma_vehicle, rma_description, rma_is_resolved, UT.user_name, UT.user_company
				FROM rma_table RT
				INNER JOIN user_table UT
					ON RT.rma_filed_by = UT.user_id 
				WHERE " . $strWhere;

	$connection = database_connection();			
	$record = $connection->prepare($strSQL);
	if($record->execute()){
	?>
	<table id="rmatable" class="admintable">
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
			}
			
			echo "</tr>";
		} ?>

	</table>



<?php	} else {
		echo "No data, man.  ";
	}?>




