<?php
	require (__DIR__.'/includes/printOut_include.php');
?>

<html>

	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

		<title>RMA Submitted</title>
		<style type="text/css">
			body{
				font-family: 'Montserrat', sans-serif;
			}
			table{
				margin:20px;
				border: solid lightgray 1px;
				width:80%;
			}

			td {
				padding:10px;
			} 

			td.top {
				text-align: center;
			}

			tr{
				text-align: center;
			}

			.shipping, .text {
				text-align: left;
			}

			.header {
				background-color:lightgray; 
				border:1px solid black;
				border-collapse:collapse;
				text-align: center;
			}

			h2, h3{
				margin-left: 20px;
			}

			#buttons {
  				margin-left: 20px;
			}

		</style>

		<script>
			$(document).ready(function($) {
				alert("Please print this RMA sheet and include it in the box being shipped.")
			});

		</script>
	</head>

	<body>

		<h2>Vista Instrumentation RMA Submission</h2>

		<h3>General</h3>
		<table>
			<tr class="header">
				<td width="25%"><b>RMA Number</b></td>
				<td width="25%"><b>Date Filed</b></td>
				<td width="25%"><b>Filed By</b></td>
				<td width="25%"><b>Email Address</b></td>		
			</tr>

			<tr>
				<td><?=$strRmaNumber?></td>
				<td><?=$dtDateFiled?></td>
				<td><?=$strUserName?></td>
				<td><?=$strUserEmail?></td>
			</tr>

		</table>

		<h3>Return Shipping Information</h3>
		<table>
			<tr>
				<td class="shipping"><?=$strUserName?></td>
			</tr>
			<tr>
				<td class="shipping"><?=$strUserAddress?></td>
			</tr>
			<tr>
				<td class="shipping"><?=$strUserCity . " " . $strUserState . ", " . $strUserZip . " " . $strUserCountry?></td>
			</tr>
			<tr>
				<td class="shipping"><?=$strUserPhone?></td>
			</tr>
		</table>

		<h3>Issues</h3>
		<table>
			<tr class="header">
				<td width="50%" class="text"><b>Vehicle</b></td>
				<td width="50%" class="text"><b>Part</b></td>
			</tr>
			<tr>
				<td class="text"><?=$strVehicle?></td>
				<td class="text"><?=$strPart?></td>
			</tr>
			<tr class="header">
				<td colspan="2" class="text"><b>Description</b></td>
			</tr>
			<tr>
				<td colspan="2" class="text"><?=$strDescription?></td>
			</tr>
		</table>

		<div id="buttons">
			<a href="account.php"><button>Go Back</button></a>
			<button onClick="window.print()">Print this page.</button>	
		</div>
	
	</body>

</html>