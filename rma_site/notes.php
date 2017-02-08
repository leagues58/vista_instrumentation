<?php 
	require('includes/notes_include.php');
?>




<html>
	<head>
		<title>Notes: RMA <?= $lngRMAID?></title>

		<link rel="stylesheet" type="text/css" href="assets/insidecss.css">
	</head>	


	<body>
		<h2>Notes for RMA #<?=$lngRMAID?></h2>
		<?php echo $message;?>





		<h3>Add Note</h3>
		

		<form name="form1" method="POST" action="notes.php?id=<?=$lngRMAID?>">
			<textarea name="notetext"></textarea>
			<input type="hidden" name="rmaid" value="<?=$lngRMAID?>">
			<input type="submit" name="sumbit">	
		</form>
		



	</body>



</html>