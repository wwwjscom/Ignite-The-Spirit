<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
	include("db_connect.php");
	
	if ($_POST['action'] == 'add')
	{
		$cleaned_content = addslashes(strip_tags($_POST['content']));
		$cleaned_title = addslashes(strip_tags($_POST['title']));
	
		$insert_query = "INSERT INTO news (`news_date`, `news_title`, `news_content`, `news_link`) VALUES ('$_POST[date]', '$cleaned_title','$cleaned_content','$_POST[link]')";
		$insert_result = mysql_query($insert_query) or die(mysql_error());
		header ('location:index.php');
	}
	else if ($_POST['action'] == 'edit')
	{
		$cleaned_content = addslashes(strip_tags($_POST['content']));
		$cleaned_title = addslashes(strip_tags($_POST['title']));
		$query = "UPDATE news SET news_title = '$cleaned_title', news_content = '$cleaned_content', news_active = '$_POST[active]', news_link = '$_POST[link]' WHERE news_id = '$_POST[id]'";
		$update_result = mysql_query($query);
		header ('location:index.php');
	}
	else if ($_POST['action'] == 'delete')
	{
		$delete_query = "DELETE FROM news WHERE news_id = '$_GET[id]'";
		$delete_result = mysql_query($delete_query);
		header("location:index.php");
	}
	
}
else
{
	include("log_form.php");
}
?>