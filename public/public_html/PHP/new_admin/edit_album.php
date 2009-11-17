<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
include("db_connect.php");

	if ($_GET['action'] == "new")
	{
	echo "<form action='".$_SERVER['PHP_SELF']."' method='post' name='new_album'>";
	echo "<input type='hidden' name='action' value='create'>\n";
	echo "Album Name:  <input name='album_name' type='text' /><br /> ";
	echo "Album Description:<br /><textarea name='album_description' cols='50' rows='10'></textarea><br />";
	echo "<input name='submit' type='submit' value='Create New Album' />";
	echo "</form>";
	}
	else if($_POST['action'] == "create")
	{
	echo "Album Created!";
	}
	
}
else { include("log_form.php"); }		
?>