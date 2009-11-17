<html>
<!-- #include file=../database.asp -->
<%
sub unclean(os, ns, max)
	ns = replace(os, "<br>", chr(10))
	if len(ns) > max then
		ns = left(ns, max)
	end if
end sub

if not session("flogin") = "true" then
	response.write "invalid login.<br>"
	response.end
end if
%>
<script language=javascript>
function dcheck() {
	if (confirm("Are You Sure?")) document.delf.submit();
}
</script>
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
		<td width=636 valign=top bgcolor=ffcc00>
			<span class=head>
			<br>
			Edit/Delete News Item<br>
			</span>
			<%
			if request("id") = "" then
				response.write "<span class=norm><br>choose item<br>"
				sql = "select id, title from fire_news"
				rs.open sql
				while not rs.eof
					response.write "<a href=editnews.asp?id=" & rs("id") & ">" & rs("title") & "</a><br>"
					rs.movenext
				wend
				rs.close
			else
				sql = "select title, dates, description from fire_news where id = '" & request("id") & "'"
				rs.open sql
				unclean rs("title"), title, 45
				unclean rs("dates"), dates, 20
				unclean rs("description"), description, 7900
				rs.close
				%>
				<form action=main.asp method=post>
				<input type=hidden name=function value=editnews>
				<input type=hidden name=id value=<%=request("id")%>>
				<span class=norm>
				<br>
				Title<br>
				<input type=text name=title size=45 maxlength=45 value='<%=title%>'><br>
				<br>
				Dates<br>
				<input type=text name=dates size=20 maxlength=20 value='<%=dates%>'><br>
				<br>
				Copy<br>
				<textarea name=description cols=60 rows=12 maxlength=7900 wrap=soft><%=description%></textarea><br>
				<br>
				<input type=submit value=Submit><br>
				</form>
				<br>
				<img src=lilwhite.gif width=521 height=3><br>
				<br>
				<br>
				<form action=main.asp method=post name=delf>
				<input type=hidden name=function value=deletenews>
				<input type=hidden name=id value=<%=request("id")%>>
				To delete this item, hit Delete<br>
				<br>
				<input type=button value=Delete onClick=dcheck()><br>
				<br>
				</span>
				<%
			end if
			%>
			<img src=lilshimmy.gif width=1 height=75><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<img src=lilwhite.gif width=757 height=3><br>
</html>
