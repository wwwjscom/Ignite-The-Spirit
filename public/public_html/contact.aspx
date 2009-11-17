<%@ page language=C# %>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<img src=images/lilshimmy.gif height=15><br>
<center>
<script language=javascript>
if (flash6 || flash7) document.write("<object classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 width=757 height=75><param name=allowScriptAccess value=sameDomain><param name=movie value=small_hdr.swf?section=contact><param name=quality value=high><param name=bgcolor value=ffffff><embed src=small_hdr.swf?section=contact quality=high bgcolor=ffffff width=757 height=75 allowScriptAccess=sameDomain type=application/x-shockwave-flash></object><br>");
else document.write("<iframe src=images/contact_noflash.aspx width=757 height=73 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe><br>");
</script>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=115 valign=top align=center bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/logo.gif><br>
		</td>
		<td width=364 valign=top bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=15><br>
			<img src=images/contact_header.gif><br>
			<form action=contact_thankyou.aspx method=post>
			<span class=norm>
			We would like to hear from you.<br>
			<br>
			Name<br>
			<input type=text name=name class=norm style="width: 300px;"><br>
			<br>
			Email address<br>
			<input type=text name=email class=norm style="width: 300px;"><br>
			<br>
			Enter comments<br>
			<textarea name=comment cols=25 rows=8 wrap=soft class=norm style="width: 300px;"></textarea><br>
			<br>
			<input type=image src=images/button_submit.gif border=0><br>
			<br>
			Mail correspondence to:<br>
			Ignite the Spirit Fund<br>
			5447 W. Cullom<br>
			Chicago, IL 60641<br>
			<br>
			Phone: 773-218-1038<br>
			<br>
			</span>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=269 bgcolor=f2f2f2 valign=top>
			<a href=store.aspx><img src=images/buynow.jpg border=0></a><br>
			<img src=images/lilwhite.gif width=269 height=3><br>
			<img src=images/lilshimmy.gif width=1 height=220><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer.aspx -->
</html>
