<html>
<!-- #include file=../database.asp -->
<!-- #include file=../function_printmoney.asp -->
<%
if not session("flogin") = "true" then
	response.write "session timed out.<br>"
	response.end
end if

sql = "select bill_first_name, bill_last_name, bill_address1, bill_address2, bill_city, bill_state, bill_zip, bill_phone, bill_email, ship_first_name, ship_last_name, ship_address1, ship_address2, ship_city, ship_state, ship_zip, amount_merchandise, amount_shipping, date from fire_customers where customernum = '" & request("customernum") & "'"
rs.open sql
amount_merchandise = 0 + rs("amount_merchandise")
amount_shipping = 0 + rs("amount_shipping")
%>
<link rel=stylesheet href=../fonts.css type=text/css>
<body bgcolor=ffffff marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<br>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=170 align=center>
			<img src=viewprintable_logo.gif><br>
			<span class=norm>
			5447 W. Cullom<br>
			Chicago, IL 60641<br>
			</span>
		</td>
		<td width=20><br></td>
		<td>
			<span class=norm>
			Ship To:<br>
			<br>
			<%=rs("ship_first_name")%>&nbsp;<%=rs("ship_last_name")%><br>
			<%=rs("ship_address1")%>&nbsp;<%=rs("ship_address2")%><br>
			<%=rs("ship_city")%>, <%=rs("ship_state")%>&nbsp;<%=rs("ship_zip")%><br>
			</span>
		</td>
	</tr>
</table>
<br>
<hr>
<br>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=40><br></td>
		<td>
			<img src=viewprintable_logo.gif><br>
			<span class=norm>
			5447 W. Cullom<br>
			Chicago, IL 60641<br>
			<br>
			</span>
		</td>
	</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Order Number</b><br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=request("customernum")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Date</b><br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=rs("date")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Name</b><br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=rs("bill_first_name")%>&nbsp;<%=rs("bill_last_name")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Address</b><br>
			<br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=rs("bill_address1")%>&nbsp;<%=rs("bill_address2")%><br>
			<%=rs("bill_city")%>, <%=rs("bill_state")%>&nbsp;<%=rs("bill_zip")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Phone</b><br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=rs("bill_phone")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150>
			<span class=norm>
			<b>Email</b><br>
			<br>
			</span>
		</td>
		<td>
			<span class=norm>
			<%=rs("bill_email")%><br>
			<br>
			</span>
		</td>
	</tr>
	<tr>
		<td width=40><br></td>
		<td width=150 valign=top>
			<span class=norm>
			<b>Products Purchased</b><br>
			<br>
			</span>
		</td>
		<td>
			<table border=0 cellpadding=0 cellspacing=0>
			<%
			rs.close
			sql = "select fire_orderbasket.qty, item_name, price, shipping from fire_orderbasket, fire_products where fire_orderbasket.item_number = fire_products.item_number and customernum = '" & request("customernum") & "'"
			rs.open sql
			while not rs.eof
				response.write "<tr><td width=390 colspan=5><span class=norm><b>" & rs("item_name") & "</b></span><br></td></tr>"
				response.write "<tr><td width=100><span class=norm>Each: $" & rs("price") & "</span><br></td>"
				response.write "<td width=100><span class=norm>Qty: " & rs("qty") & "</span><br></td>"
				response.write "<td width=60><span class=norm>Price:</span><br></td>"
				response.write "<td width=60 align=right><span class=norm>$" & rs("price") & "</span><br></td>"
				response.write "<td width=70><br></td></tr>"
				rs.movenext
			wend
			%>
				<tr>
					<td width=400 colspan=5><br></td>
				</tr>
				<tr>
					<td width=260 colspan=3>
						<span class=norm>Subtotal</span><br>
					</td>
					<td width=60 align=right>
						<span class=norm>$<%= money(amount_merchandise) %></span><br>
					</td>
					<td width=70><br></td>
				</tr>
				<tr>
					<td width=260 colspan=3>
						<span class=norm>Shipping</span><br>
					</td>
					<td width=60 align=right>
						<span class=norm>$<%= money(amount_shipping) %></span><br>
					</td>
					<td width=70><br></td>
				</tr>
				<tr>
					<td width=260 colspan=3>
						<span class=norm><b>Total</b></span><br>
					</td>
					<td width=60 align=right>
						<span class=norm><b>$<%= money(amount_merchandise + amount_shipping) %></b></span><br>
					</td>
					<td width=70><br></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</html>


