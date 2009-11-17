//flash detection
var flash6 = false;
var flash7 = false;
var flash8 = false;
var flash9 = false;
if (((navigator.appName == "Netscape") && (parseFloat(navigator.appVersion) >= 4) && navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"] && navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)) {
	if (navigator.plugins['Shockwave Flash'].description.indexOf("6.") != -1) flash6 = true;
	if (navigator.plugins['Shockwave Flash'].description.indexOf("7.") != -1) flash7 = true;
	if (navigator.plugins['Shockwave Flash'].description.indexOf("8.") != -1) flash8 = true;
	if (navigator.plugins['Shockwave Flash'].description.indexOf("9.") != -1) flash9 = true;
}
else if ( (navigator.userAgent) && (navigator.userAgent.indexOf("MSIE") >= 0) && (navigator.appVersion.toLowerCase().indexOf("win") != -1) ) {
	document.write('<script language=VBScript>');
	document.write('on error resume next \n');
	document.write('flash6 = (IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash.6"))) \n');
	document.write('flash7 = (IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash.7"))) \n');
	document.write('flash8 = (IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash.8"))) \n');
	document.write('flash9 = (IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash.9"))) \n');
	document.write('<\/script>');
}
if (flash8) flash7 = true;
//flash6 = false;
//flash7 = false;
//flash8 = false;

n1off = new Image(107, 29);
n1off.src = "/images/nav_index_off.gif";
n2off = new Image(107, 29);
n2off.src = "/images/nav_about_off.gif";
n3off = new Image(107, 29);
n3off.src = "/images/nav_meet_off.gif";
n4off = new Image(107, 29);
n4off.src = "/images/nav_store_off.gif";
n5off = new Image(107, 29);
n5off.src = "/images/nav_news_off.gif";
n6off = new Image(107, 29);
n6off.src = "/images/nav_supporters_off.gif";
n7off = new Image(109, 29);
n7off.src = "/images/nav_contact_off.gif";
m1off = new Image(95, 42);
m1off.src = "/images/meet_2006_off.gif";
m2off = new Image(95, 42);
m2off.src = "/images/meet_2005_off.gif";
m3off = new Image(95, 42);
m3off.src = "/images/meet_2007_off.gif";

n1on = new Image(107, 29);
n1on.src = "/images/nav_index_on.gif";
n2on = new Image(107, 29);
n2on.src = "/images/nav_about_on.gif";
n3on = new Image(107, 29);
n3on.src = "/images/nav_meet_on.gif";
n4on = new Image(107, 29);
n4on.src = "/images/nav_store_on.gif";
n5on = new Image(107, 29);
n5on.src = "/images/nav_news_on.gif";
n6on = new Image(107, 29);
n6on.src = "/images/nav_supporters_on.gif";
n7on = new Image(109, 29);
n7on.src = "/images/nav_contact_on.gif";
m1on = new Image(95, 42);
m1on.src = "/images/meet_2006_on.gif";
m2on = new Image(95, 42);
m2on.src = "/images/meet_2005_on.gif";
m3on = new Image(95, 42);
m3on.src = "/images/meet_2007_on.gif";

function img_act(v) {
	document[v].src = eval(v + "on.src");
}
function img_inact(v) {
	document[v].src = eval(v + "off.src");
}
unrollable = "zzz";
function boxon(v) {
	if (v != unrollable) {
		if (document.all) document.all[v].style.visibility = "visible";
		if (document.layers) document.layers[v].visibility = "visible";
		if (document.getElementById) document.getElementById(v).style.visibility = "visible";
	}
}
function boxoff(v) {
	if (v != unrollable) {
		if (document.all) document.all[v].style.visibility = "hidden";
		if (document.layers) document.layers[v].visibility = "hidden";
		if (document.getElementById) document.getElementById(v).style.visibility = "hidden";
	}
}
