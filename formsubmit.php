<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Contact Verification</title>
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

				<!-- Parse the email form and do some basic sanity checks -->
				
				<?php
				
				   // Get the senders IP address, etc
				
				   $sender_ip     = getenv("REMOTE_ADDR");
				   $http_ref      = getenv ("HTTP_REFERER");
				   $http_agent    = getenv ("HTTP_USER_AGENT");
				
				   // Get the fields from the email form filled out by the visitor
				
				   $name          = $_POST['name'];
				   $email         = $_POST['email'];
				   $message       = $_POST['message'];
				
				
				   if (eregi('http:', $message)) {
					   echo "<h2>The 'http:' characters are not allowed in your message.</h2>\n";
					   die ("Use the browser 'Go back' to correct your message. ");
				   }
				
				   if(empty($name) || empty($email) || empty($message )) {
					   echo "<h2>Please fill in all the fields in your message.</h2>\n";
					   die ("Use the browser 'Go back' to correct your message. ");
				   }

				   if(!$email == "" && (!strstr($email,"@") || !strstr($email,"."))) {
					   echo "<h2>Please enter a valid e-mail address.</h2>\n";
					   die ("Use the browser 'Go back' to correct your message. ");
				   }
				
				
				   $todayis = date("l, F j, Y, g:i a") ;
				   $message = stripcslashes($message);
				
				   $tot_message = " $todayis [EST] \n
				   $message \n
				   From: $name ($email)\n
				   Additional Info : Senders IP: $sender_ip \n
				   Browser Info: $http_agent \n
				   Referral : $http_ref \n
				   ";
				
				?>

				<!-- This a "dummy" form to pass information to the php mailer -->

				<form action="gdform.php" method="post" name="sendemail">
		
					<input type="hidden" name="subject" value="Vista Instrumentation message from website"/>
					<input type="hidden" name="redirect" value="thankyou.php"/>
					<input type="hidden" name="email" value="<?php echo $email ?>"/>
		
					<input type="hidden" name="Message" value="<?php echo $tot_message ?>"/>

					<!-- Auto-submit the form -->
	
					<script language="JavaScript">javascript:document.sendemail.submit();</script>

				</form>


				<h2><span>There has been an error with your message</span></h2>

			</div>
		  </div>
		  <div class="clr"></div>
		</div>
	   </div>
	 </div>
	</div>
	</body>
</html>
