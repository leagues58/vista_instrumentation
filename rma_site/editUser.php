<?php require(__DIR__.'/includes/editUser_include.php');?>

<!DOCTYPE html>
<html>
	<head>
		<title>User Info</title>
	  	<link rel="stylesheet" type="text/css" href="assets/insidecs.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	  	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	</head>
	<body>

		<?php
			if(!empty($strMessage)) {
				echo $strMessage;
			} else {
		?>

			<h3>User Info</h3>
			<form action = "editUser.php?<?=$lngUserID?>" method="POST">
				<table>
					<tr>
						<th>Name:</th>
						<td><input type="text" name="userName" value="<?=$strUserName?>"></td>
					</tr>
					<tr>
						<th>Email:</th>
						<td><input type="text" name="userEmail" value="<?=$strUserEmail?>"></td>
					</tr>
					<tr>
						<th>Address:</th>
						<td><input type="text" name="userAddress" value="<?=$strUserAddress?>"></td>
					</tr>
					<tr>
						<th>City:</th>
						<td><input type="text" name="userCity" value="<?=$strUserCity?>"></td>
					</tr>
					<tr>
						<th>State:</th>
						<td><input type="text" name="userState" value="<?=$strUserState?>"></td>
					</tr>
					<tr>
						<th>Zip Code:</th>
						<td><input type="text" name="userZip" value="<?=$strUserZip?>"></td>
					</tr>
					<tr>
						<th>Country:</th>
						<td><input type="text" name="userCountry" value="<?=$strUserCountry?>"></td>
					</tr>
					<tr>
						<th>Phone:</th>
						<td><input type="text" name="userPhone" value="<?=$strUserPhone?>"></td>
					</tr>
					<tr>
						<th>Company:</th>
						<td><input type="text" name="userCompany" value="<?=$strUserCompany?>"></td>
					</tr>
				</table>

				<input type="submit" name="">
				<br><br>
				<input type="submit" name="resetpassword" value="Reset Password">
			</form>


		<?php
			}
		?>
	</body>



</html>