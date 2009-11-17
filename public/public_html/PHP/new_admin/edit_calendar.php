<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
include("db_connect.php");

	if ($_POST['action'] == "addfiremen" || $_GET['action'] == "addfiremen")
	{
		echo "<h1>Add A New Firemen</h1>";
		echo "<form name='add_firemen' action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>";
		echo "<input name='action' type='hidden' value='add' />";
		echo "<table><tr><td>";
		echo "Year: <input name='year' size='5' type='text' /><br /><br />";
		echo "First Name:<input name='first_name'  size='16' type='text' /><br /><br /> ";
		echo "Last Name:<input name='last_name'  size='16' type='text' /><br /><br />";
		echo "Job:<input name='job'  size='40' type='text' /><br /><br />";
		echo "Picture:<input name='picture' type='file'><br /><br />";
		echo "Thumbnail:<input name='thumbnail' type='file'><br /><br />";
		echo "</td>";
		echo "<td>";
		echo "Story: <br />";
		echo "<textarea name='info' cols='60' rows='15'></textarea><br><br>";
		echo "</td></tr><tr><td colspan='2'><hr /></td></tr></table>";
		echo "Save -and- ";
		echo "<input name='next_step' type='radio' value='add' checked />Add Another <input name='next_step' type='radio' value='continue' /> Continue";
		echo "  <input name='submit' type='submit' value='Submit'>";
		echo "</form>";
		
	}
	else if ($_POST['action'] == 'add')
	{
		include("upload_photo.php");

		$file_error_pic = $_FILES['picture']['error'];
		$file_type_pic = $_FILES['picture']['type'];
		$file_size_pic = $_FILES['picture']['size'];														
		$file_name_pic = $_FILES['picture']['name'];															
		$file_tmp_name_pic = $_FILES['picture']['tmp_name'];
			
		$file_error_thumb = $_FILES['thumbnail']['error'];
		$file_type_thumb = $_FILES['thumbnail']['type'];
		$file_size_thumb = $_FILES['thumbnail']['size'];														
		$file_name_thumb = $_FILES['thumbnail']['name'];															
		$file_tmp_name_thumb = $_FILES['thumbnail']['tmp_name'];
	
		$calendar_year = addslashes(strip_tags($_POST['year']));
		$calendar_fname = addslashes(strip_tags($_POST['first_name']));
		$calendar_lname = addslashes(strip_tags($_POST['last_name']));
		$calendar_job = addslashes(strip_tags($_POST['job']));
		$calendar_info = addslashes(strip_tags($_POST['info']));
		$calendar_picture = upload_photo ($file_error_pic, $file_size_pic, $file_name_pic, $file_tmp_name_pic, $calendar_year, $calendar_fname, $calendar_lname, 'pic');
		$calendar_thumb = upload_photo ($file_error_thumb, $file_size_thumb, $file_name_thumb, $file_tmp_name_thumb, $calendar_year, $calendar_fname, $calendar_lname, 'thumb');
	
		$insert_query = "INSERT INTO calendar (`calendar_year`, `calendar_fname`,`calendar_lname`,`calendar_job`,`calendar_info`, `calendar_picture`,`calendar_thumbnail`) 
									   VALUES ('$calendar_year','$calendar_fname','$calendar_lname','$calendar_job','$calendar_info','$calendar_picture','$calendar_thumb')";
		$result = mysql_query($insert_query); 
		//echo $insert_query."<br />";
		if ($_POST['next_step'] == "add") { header ('location:edit_calendar.php?action=addfiremen'); }
		else if($_POST['next_step'] == "continue") { header ('location:index.php?page=calendars'); }
	}
}
else { include("log_form.php"); }		
?>