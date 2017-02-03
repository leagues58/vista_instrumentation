<?php require("includes/admin_include.php");?>

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

  	<script>
		$(document).ready(function($) {
			$(':checkbox').click(function() {
				$.ajax("ajax/markResolved.php?"+this.name, {
  					success: function(data) {
  						console.log(data);
     					$("#" + data).html("Yes");
  					},
  					error: function() {
     					alert("not posted!");
  					}
				});
			});
			$('select').change(function(){
				$.ajax("ajax/updateRMATable.php?type="+$('#resolvedselect').val()+"&company="+$('#companyselect').val(), {
  					success: function(data) {
     					$('#rmatablecontent').html(data);
     					//console.log(data);
  					},
  					error: function() {
     					alert("not posted!");
  					}
				});
			});
		});
	</script>
</head>
<body>

	<div class="container">
  		<h2>Admin Page</h2>
  		<ul class="nav nav-tabs">
    		<li class="active"><a data-toggle="tab" href="#users">Users</a></li>
    		<li><a data-toggle="tab" href="#viewrma">View RMA's</a></li>
  		</ul>

	  	<div class="tab-content">
	    	<div id="users" class="tab-pane fade in active">
	      		<h3>Users</h3>

	      		<?php displayUsersTable();?>

	      		<div id="newuserarea">
	      			<div id="newuserform">
		      			<form method="POST">
		      				<h3>Create New Account</h3>
		      				<input type="text" name="newName" placeholder="New User's Name"><br>
		      				<input type="text" name="newEmail" placeholder="New User's Email"><br>
		      				<input type="text" name="newCompany" placeholder="New User's Company"><br>
		      				<input type="checkbox" name="newAdmin">    User is Admin<br>
		      				<div id="newusersubmitbutton">
		      				<input type="submit" name="submitbutton" value="Add User">
		      				</div>
		      			</form>
		      		</div>
	      		</div>
	      		<?php
	      			if(!empty($strMessage)){
	      				echo "<div id='message'>" . $strMessage . "</div>";
	      			}
	      		?>

	    	</div>
	    	<div id="viewrma" class="tab-pane fade">
	      		<h3>View RMA's</h3>
	      		<select id="resolvedselect">
					<option value="both">Both</option>
					<option value="resolved">Resolved Only</option>
					<option value="unresolved">Unresolved Only</option>
				</select>
				<select id="companyselect">
					<?php displayCompanyOptions();?>
				</select>
	      		<div id="rmatablecontent">
	      			<?php displayRMAs();?>
	      		</div>
	    	</div>
	  	</div>
	  	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	  	<a href="logout.php" id="logoutlink">Log Out</a>
	  	<br><br><br><br>
	</div>

</body>
</html>