<?php 
	require(__DIR__.'/includes/notes_include.php');
?>




<html>
	<head>
		<title>Notes: RMA <?= $lngRMAID?></title>

		<link rel="stylesheet" type="text/css" href="assets/insidecss.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		<script>
			$(document).ready(function(){
				$('.deleteNote').click(function(){
					$('input[name=delete]').val = this.id;
					console.log(this.id);
					console.log($('input[name=delete]').val);
					$('form').submit();
				});
				
			});		
		</script>
	</head>	


	<body>
		<h2>Notes for RMA #<?=$lngRMAID?></h2>
		<hr>
		<?php echo $message;?>


		<?php
			while($results = $records->fetch(PDO::FETCH_OBJ)) { ?>
		<div class="note" id="<?=$results->note_id?>">
			<?= $results->note_text?>
			<p class="date"><?= $results->note_date_entered?></p>
			<a href="#" >Edit</a>
			<a href="#" class="deleteNote" id="<?=$results->note_id?>">Delete</a>

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
			<input type="hidden" name="delete" value = "">
			<input type="submit" name="sumbit">	
		</form>
		
		<?php } ?>


	</body>



</html>