<html>
<!-- #include file=../database.asp -->
<%
if not session("flogin") = "true" then
	response.write "invalid login.<br>"
	response.end
end if
%>
<link rel=stylesheet href=../fonts.css type=text/css>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<img src=lilshimmy.gif height=15><br>
<center>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=757 align=center bgcolor=ffffff>
			<img src=lilshimmy.gif height=3><br>
			<img src=noflash_top_plain.jpg><br>
			<img src=lilshimmy.gif height=3><br>
		</td>
	</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><img src=lilshimmy.gif width=1 height=35><br></td>
		<td width=115 bgcolor=ff6600><br></td>
		<td width=400 bgcolor=ff6600>
			<span class=head>News Manager</span><br>
		</td>
		<td width=236 bgcolor=ff6600>
			<span class=norm>IGNITE THE SPIRIT ONLINE MANAGER</span><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<img src=lilwhite.gif width=757 height=3><br>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=115 valign=top align=center bgcolor=ffcc00>
			<span class=norm>
			<br>
			<a href=main.asp>Main Menu</a><br>
			<img src=lilshimmy.gif width=1 height=300><br>
			</span>
		</td>
		<td width=636 bgcolor=ffcc00>
			<span class=head>
			<br>
			Add News Item<br>
			</span>
			<span class=norm>
			<br>
			<form action=main.asp method=post>
			<input type=hidden name=function value=addnews>
			Title<br>
			<input type=text name=title size=45 maxlength=45><br>
			<br>
			Dates<br>
			<input type=text name=dates size=20 maxlength=20><br>
			<br>
			Copy<br>
			<textarea name=description cols=60 rows=12 maxlength=7900 wrap=soft></textarea><br>
			<br>
			<input type=submit value=Submit><br>
			</span>
			<img src=lilshimmy.gif width=1 height=75><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<img src=lilwhite.gif width=757 height=3><br>
</html>
