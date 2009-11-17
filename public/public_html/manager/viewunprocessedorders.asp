<html>
<!-- #include file=../database.asp -->
<!-- #include file=../function_printmoney.asp -->
<%
if not session("flogin") = "true" then
	response.write "session timed out.<br>"
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
			Unprocessed Orders<br>
			</span>
			<span class=norm>
			Please select an order:<br>
			<br>
			</span>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=200>
						<span class=normg>Date</span><br>
					</td>
					<td width=200>
						<span class=normg>Name</span><br>
					</td>
					<td width=100>
						<span class=normg>Amount</span><br>
					</td>
				</tr>
			<%
			sql = "select customernum, ship_first_name, ship_last_name, date, amount_merchandise, amount_shipping from fire_customers where status = 0 order by customernum"
			rs.open sql
			while not rs.eof
				tot = 0
				tot = tot + rs("amount_merchandise")
				tot = tot + rs("amount_shipping")
				response.write "<tr><td><span class=norm><a href=vieworder.asp?customernum=" & rs("customernum") & ">" & rs("date") & "</span><br></td>"
				response.write "<td><span class=norm><a href=vieworder.asp?customernum=" & rs("customernum") & ">" & rs("ship_first_name") & " " & rs("ship_last_name") & "</a></span><br></td>"
				response.write "<td><span class=norm><a href=vieworder.asp?customernum=" & rs("customernum") & ">$" & money(tot) & "</a></span><br></td></tr>"
				response.write "<tr><td colspan=3><img src=lilshimmy.gif height=3><br></td></tr>"
				rs.movenext
			wend
			%>
			</table>
			<br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<img src=lilwhite.gif width=757 height=3><br>
</html>
