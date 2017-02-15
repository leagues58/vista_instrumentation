<?php 
	require(__DIR__.'/includes/notes_include.php');
?>




<html>
	<head>
		<title>Notes: RMA <?= $lngRMAID?></title>

		<link rel="stylesheet" type="text/css" href="assets/insidecss.css">
	</head>	


	<body>
		<h2>Notes for RMA #<?=$lngRMAID?></h2>
		<hr>
		<?php echo $message;?>


		<?php
			while($results = $records->fetch(PDO::FETCH_OBJ)) { ?>
		<div class="note">
			<?= $results->note_text?>
			<p class="date"><?= $results->note_date_entered?></p>
			

		</div>
	
	<?php
	}
	?>


		<?php
			if ($user["user_is_admin"]) {
		?>
		<hr>
		<h3>Add Note</h3>
		

		<form name="form1" method="POST" action="notes.php?id=<?=$lngRMAID?>">
			<textarea name="notetext"></textarea>
			<input type="hidden" name="rmaid" value="<?=$lngRMAID?>">
			<input type="submit" name="sumbit">	
		</form>
		
		<?php } ?>


	</body>



</html>