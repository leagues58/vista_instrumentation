<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Contact Vista Instrumentation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
		<script type="text/javascript" src="js/cufon-yui.js"></script>
		<script type="text/javascript" src="js/arial.js"></script>
		<script type="text/javascript" src="js/cuf_run.js"></script>
		<!-- CuFon ends -->
	</head>

	<body>
	<div class="main">
	  <div class="header">
		<div class="header_resize">
		  <div class="menu_nav">
			<ul>
			  <?php require('text/top_menu.txt'); ?>
			</ul>
			<div class="clr"></div>
		  </div>
		  <div class="clr"></div>
		  <div class="logo"><?php require('text/banner_logo.txt'); ?></h1></div>
		</div>
	  </div>
	
	  <div class="content">
		<div class="content_resize">
		  <div class="mainbar">
			<div class="article">
			  <h2><span>Contact</span></h2>
			  <p>To get in touch with Vista Instrumentation, please fill out the form below.</p>
			</div>
			<div class="article">
			  <h2><span>Send us</span> mail</h2>

			  <form action="formsubmit.php" method="post" id="sendemail">

		      <!-- User to fill out these fields -->

			  <ol><li>
				<label for="name">Name (required)</label>
				<input id="name" name="name" class="text" />
			  </li><li>
				<label for="email">Email Address (required)</label>
				<input id="email" name="email" class="text" />
			  </li><li>
				<label for="message">Your Message</label>
				<textarea id="message" name="message" rows="10" cols="50"></textarea>
			  </li><li>
				<input type="image" name="imageField" id="imageField" src="images/submit.gif" class="send" />
				<div class="clr"></div>
			  </li></ol>
			  </form>
			</div>
		  </div>

		  <div class="col c3">
			<h2>Contact Details</h2>
			  <?php require('text/contact.txt'); ?></div>      
		  <div class="clr"></div>

		  </div>
		  <div class="clr"></div>
		</div>
	  </div>
	
	  <div class="footer">
		<div class="footer_resize">
		  <p class="lf"><?php require('text/copyright.txt'); ?></p>
		  <ul class="fmenu">
			  <?php require('text/top_menu.txt'); ?>
		  </ul>
		  <div class="clr"></div>
		</div>
	  </div>
	</div>
	</body>
</html>
