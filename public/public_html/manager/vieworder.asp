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
			<span class=head><br></span>
			<%
			sql = "select bill_first_name, bill_last_name, bill_address1, bill_address2, bill_city, bill_state, bill_zip, bill_phone, bill_email, ship_first_name, ship_last_name, ship_address1, ship_address2, ship_city, ship_state, ship_zip, amount_merchandise, amount_shipping, date, status from fire_customers where customernum = '" & request("customernum") & "'"
			rs.open sql
			amount_merchandise = 0 + rs("amount_merchandise")
			amount_shipping = 0 + rs("amount_shipping")
			status = rs("status")
			if status = 0 then
				statusmessage = "Unprocessed Order"
			else
				statusmessage = "Processed Order"
			end if
			%>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td>
						<span class=head><%=statusmessage%></span><br>
					</td>
					<td width=35><br></td>
					<td>
						<span class=head><a href=viewprintable.asp?customernum=<%=request("customernum")%> target=_blank>View printable version</a></span><br>
					</td>
				</tr>
			</table>
			<span class=norm>
			<br>
			<img src=lilwhite.gif width=400 height=1><br>
			<br>
			order number: <%= request("customernum") %> &nbsp; date: <%= rs("date") %><br>
			<br>
			</span>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=200 valign=top>
						<span class=norm>
						<b>Billing address</b><br>
						<br>
						<%= rs("bill_first_name") %>&nbsp;<%= rs("bill_last_name") %><br>
						<%= rs("bill_address1") %>&nbsp;<%= rs("bill_address2") %><br>
						<%= rs("bill_city") %>, <%= rs("bill_state") %>&nbsp;<%= rs("bill_zip") %><br>
						<br>
						phone: <%= rs("bill_phone") %><br>
						email: <%= rs("bill_email") %><br>
						</span>
					</td>
					<td valign=top>
						<span class=norm>
						<b>Shipping address</b><br>
						<br>
						<%= rs("ship_first_name") %>&nbsp;<%=rs("ship_last_name") %><br>
						<%= rs("ship_address1") %> <%= rs("ship_address2") %><br>
						<%= rs("ship_city") %>, <%= rs("ship_state") %>&nbsp;<%= rs("ship_zip") %><br>
						</span>
					</td>
				</tr>
			</table>
			<span class=norm>
			<br>
			<img src=lilwhite.gif width=400 height=1><br>
			</span>
			<table border=0 cellpadding=0 cellspacing=0>
			<%
			rs.close
			sql = "select fire_orderbasket.qty, item_name, price, shipping from fire_orderbasket, fire_products where fire_orderbasket.item_number = fire_products.item_number and customernum = '" & request("customernum") & "'"
			rs.open sql
			while not rs.eof
				response.write "<tr><td width=10 bgcolor=ff9900><br></td><td width=390 colspan=5 bgcolor=ff9900><span class=norm><b>" & rs("item_name") & "</b></span><br></td></tr>"
				response.write "<tr><td width=10 bgcolor=ff9900><br></td>"
				response.write "<td width=100 bgcolor=ff9900><span class=norm>Each: $" & rs("price") & "</span><br></td>"
				response.write "<td width=100 bgcolor=ff9900><span class=norm>Qty: " & rs("qty") & "</span><br></td>"
				response.write "<td width=60 bgcolor=ff9900><span class=norm>Price:</span><br></td>"
				response.write "<td width=60 align=right bgcolor=ff9900><span class=norm>$" & rs("price") & "</span><br></td>"
				response.write "<td width=70 bgcolor=ff9900><br></td></tr>"
				rs.movenext
			wend
			%>
				<tr>
					<td width=400 colspan=6 bgcolor=ff9900><br></td>
				</tr>
				<tr>
					<td width=10 bgcolor=ff9900><br></td>
					<td width=260 colspan=3 bgcolor=ff9900>
						<span class=norm>Subtotal</span><br>
					</td>
					<td width=60 align=right bgcolor=ff9900>
						<span class=norm>$<%= money(amount_merchandise) %></span><br>
					</td>
					<td width=70 bgcolor=ff9900><br></td>
				</tr>
				<tr>
					<td width=10 bgcolor=ff9900><br></td>
					<td width=260 colspan=3 bgcolor=ff9900>
						<span class=norm>Shipping</span><br>
					</td>
					<td width=60 align=right bgcolor=ff9900>
						<span class=norm>$<%= money(amount_shipping) %></span><br>
					</td>
					<td width=70 bgcolor=ff9900><br></td>
				</tr>
				<tr>
					<td width=10 bgcolor=ff9900><br></td>
					<td width=260 colspan=3 bgcolor=ff9900>
						<span class=norm><b>Total</b></span><br>
					</td>
					<td width=60 align=right bgcolor=ff9900>
						<span class=norm><b>$<%= money(amount_merchandise + amount_shipping) %></b></span><br>
					</td>
					<td width=70 bgcolor=ff9900><br></td>
				</tr>
				<tr>
					<td width=400 colspan=6 bgcolor=ff9900><br></td>
				</tr>
			</table>
			<img src=lilwhite.gif width=400 height=1><br>
			<br>
			<%
			if status = 0 then
				%>
				<form action=main.asp method=post>
				<input type=hidden name=function value=processorder>
				<input type=hidden name=customernum value=<%= request("customernum") %>>
				<input type=submit value="Process this Order"><br>
				<br>
				<%
			end if
			%>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<img src=lilwhite.gif width=757 height=3><br>
<br>
</html>
