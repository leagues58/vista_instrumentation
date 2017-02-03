<?php
	require ('includes/account_include.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="assets/insidecss.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
  		<h2>RMA Page</h2>
  		<ul class="nav nav-tabs">
    		<li class="active"><a data-toggle="tab" href="#requestrma">Submit RMA</a></li>
    		<li><a data-toggle="tab" href="#viewrma">View RMA's</a></li>
    		<!--<li><a data-toggle="tab" href="#accountinfo">Account Info</a></li>-->
  		</ul>

	  	<div class="tab-content">
	    	<div id="requestrma" class="tab-pane fade in active">
	      		<h3>Submit RMA</h3>
	      		<hr>
	      		<?php if(!empty($message)) { ?>
					<p><?=$message?></p>
				<?php } ?>
	      		<form action="account.php" method="POST" class="form-horizontal" id="rmaform">
	      			<table class="userrmatable">
	      				<tr>
	      					<td class="lefttab">
	      						<b>Vehicle:</b>
	      					</td>
		      				<td class="righttab">
								<input type="text" name="vehicle">
							</td>
	      				</tr>

	       				<tr>
	      					<td class="lefttab">
	      						<b>Part:</b>
	      					</td>
		      				<td class="righttab">
								<select name="part">
									<option>Camera Tube</option>
									<option>Main Section</option>
									<option>Other</option>
								</select>
							</td>
	      				</tr>
	      				
	      				<tr>
	      					<td class="lefttab">
	      						<b>Description:</b>
	      					</td>
	      					<td class="righttab">
	      						<textarea form="rmaform" name="description"></textarea>
	      					</td>
	      						
	      				</tr>
	      				<tr>
	      					<td><hr></td><td><hr></td>
	      				</tr>
	      			
	      				<tr>
	      					<td class="lefttab">
	      						<b>Return Address:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strAddressPlaceholder ?>" name="address" value="">
	      					</td>	
	      				</tr>

	      				<tr>
	      					<td class="lefttab">
	      						<b>City:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strCityPlaceholder?>" name="city" value="">
	      					</td>	
	      				</tr>

	      				<tr>
	      					<td class="lefttab">
	      						<b>State:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strStatePlaceholder?>" name="state" value="">
	      					</td>	
	      				</tr>

	      				<tr>
	      					<td class="lefttab">
	      						<b>Zip Code:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strZipPlaceholder?>" name="zip" value="">
	      					</td>	
	      				</tr>
						<tr>
	      					<td class="lefttab">
	      						<b>Country:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strCountryPlaceholder?>" name="country" value="">
	      					</td>	
	      				</tr>
	      				<tr>
	      					<td class="lefttab">
	      						<b>Phone Number:</b>
	      					</td>
	      					<td class="righttab">
	      						<input type="text" placeholder="<?=$strPhonePlaceholder?>" name="phone" value="">
	      					</td>	
	      				</tr>
	      				
	      				<tr><td><input type="checkbox" checked> Save Address to Account</td></tr>
	      				<tr><td><hr></td><td><hr></td></tr>
	      				<tr>
	      					<td colspan=2>
	      						<br>
	      						<input type="submit" name="sumbit">	
	      					</td>
	      					
	      				</tr>
	      			</table>


	      		</form>

	    	</div>
	    	<div id="viewrma" class="tab-pane fade">
	      		<h3>View RMA's</h3>
	      		<?php  
	      			displayRmas();  
	      		?>








	    	</div>
	    	<!--
	    	<div id="accountinfo" class="tab-pane fade">
	      		<h3>Account Info</h3>
	      		<table>
	      			<tr>
	      				<td class="lefttab">
	      					<b>User:</b>
	      				</td>
	      				<td class="righttab">
	      					<?=$user['user_name']?>
	      				</td>
	      			</tr>
	      			<tr>
	      				<td class="lefttab">
	      					<b>Email:</b>
	      				</td>
	      				<td class="righttab">
	      					<?=$user['user_email']?>
	      				</td>
	      			</tr>
	      			<tr>
	      				<td class="lefttab">
	      					<b>Company:</b>
	      				</td>
	      				<td class="righttab">
	      					<?=$user['user_company']?>
	      				</td>
	      			</tr>
	      			<tr>
	      				<td class="lefttab">
	      					<b>Registered:</b>
	      				</td>
	      				<td class="righttab">
	      					<?=$user['user_registration_date']?>
	      				</td>
	      			</tr>

	      		</table>
	      		
	    	</div>
	    	-->
	    	
	  	</div>



	  	<br><br><br><br><br><br><br><br><br>
	  	<a href="logout.php" id="logoutlink">Log Out</a>
	  	<br><br><br><br>
	</div>






</body>
</html>