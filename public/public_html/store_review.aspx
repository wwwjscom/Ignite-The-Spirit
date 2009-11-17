<%@ page language=C# %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<%
if (Request.RequestType.ToLower() == "post") {
	Session["ship_first_name"] = Request["ship_first_name"];
	Session["ship_last_name"] = Request["ship_last_name"];
	Session["ship_address1"] = Request["ship_address1"];
	Session["ship_address2"] = Request["ship_address2"];
	Session["ship_city"] = Request["ship_city"];
	Session["ship_state"] = Request["ship_state"];
	Session["ship_zip"] = Request["ship_zip"];

}
%>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<script language=javascript>
var subbed = false;
function fcheck() {
	if (!subbed) {
		subbed = true;
		document.frm.submit();
	}
}
</script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<form action=store_thankyou.aspx method=post name=frm>
<img src=images/lilshimmy.gif height=15><br>
<center>
<script language=javascript>
if (flash6 || flash7) document.write("<object classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 width=757 height=75><param name=allowScriptAccess value=sameDomain><param name=movie value=small_hdr.swf?section=store><param name=quality value=high><param name=bgcolor value=ffffff><embed src=small_hdr.swf?section=store quality=high bgcolor=ffffff width=757 height=75 allowScriptAccess=sameDomain type=application/x-shockwave-flash></object><br>");
else document.write("<iframe src=images/store_noflash_plain.aspx width=757 height=73 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe><br>");
</script>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=115 valign=top align=center bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/logo.gif><br>
		</td>
		<td width=417 valign=top bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=15><br>
			<img src=images/store_review_header.gif><br>
			<img src=images/lilshimmy.gif height=5><br>
			<span class=norm><a href=store_cart.aspx>View Cart</a> | <a href=store_billing.aspx>Billing Info</a> | <a href=store_shipping.aspx>Shipping Info</a> | Review Order</span><br>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<img src=images/lilshimmy.gif height=15><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=250>
						<span class=norm><b>Shopping Cart</b></span><br>
					</td>
					<td width=100 align=right>
						<a href=store_cart.aspx><img src=images/button_edit.gif border=0></a><br>
					</td>
				</tr>
			</table>
			<%
			double carttotal = 0;
			double shiptotal = 0;
			int itemcount = 0;
			int qty;
			SqlConnection dbconn = new SqlConnection(System.Configuration.ConfigurationSettings.AppSettings.Get("dbconn"));
			SqlDataAdapter sda;
			DataSet ds = new DataSet();
			sda = new SqlDataAdapter();
			foreach (String key in Session.Keys) {
				if (Session[key] == "item") {
					itemcount++;
					sda.SelectCommand = new SqlCommand("select item_number, item_name, price, shipping from fire_products where item_number = '" + key + "'", dbconn);
					sda.Fill(ds, key);
					DataRow r = ds.Tables[key].Rows[0];
					qty = (int)Session["qty" + key];
					%>
					<span class=norm><b><%= r["item_name"] %></b></span><br>
					<img src=images/lilwhite.gif width=350 height=1><br>
					<img src=images/lilshimmy.gif height=2><br>
					<table border=0 cellpadding=0 cellspacing=0>
						<tr>
							<td width=120>
								<span class=norm>Each: $<%= r["price"] %></span><br>
							</td>
							<td width=40>
								<span class=norm>Qty: </span><br>
							</td>
							<td width=90>
								<span class=norm><%= qty %></span><br>
							</td>
							<td width=100>
								<span class=norm>Price: $<%= (Convert.ToDouble(r["price"]) * qty).ToString("#,##0.00") %></span><br>
							</td>
						</tr>
					</table>
					<%
					carttotal = carttotal + (Convert.ToDouble(r["price"]) * qty);
					shiptotal = shiptotal + (Convert.ToDouble(r["shipping"]) * qty);
				}
			}
			%>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=280>
						<span class=norm>Subtotal:</span><br>
					</td>
					<td width=70 align=right>
						<span class=norm>$<%= carttotal.ToString("#,##0.00") %></span><br>
					</td>
				</tr>
				<tr>
					<td width=280>
						<span class=norm>Shipping:</span><br>
					</td>
					<td width=70 align=right>
						<span class=norm>$<%= shiptotal.ToString("#,##0.00") %></span><br>
					</td>
				</tr>
				<tr>
					<td width=280>
						<span class=norm><b>Total:</b></span><br>
					</td>
					<td width=70 align=right>
						<span class=norm><b>$<%= (carttotal + shiptotal).ToString("#,##0.00") %></b></span><br>
					</td>
				</tr>
			</table>
			<br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=200 valign=top>
						<img src=images/lilshimmy.gif height=15><br>
						<table border=0 cellpadding=0 cellspacing=0>
							<tr>
								<td width=120>
									<span class=norm><b>Billing Info</b></span><br>
								</td>
								<td>
									<a href=store_billing.aspx><img src=images/button_edit.gif border=0></a><br>
								</td>
							</tr>
						</table>
						<span class=norm>
						<%= Session["bill_first_name"] %>&nbsp;<%= Session["bill_last_name"] %><br>
						<%= Session["bill_address1"] %><br>
						<%= Session["bill_address2"] %><br>
						<%= Session["bill_city"] %>, <%= Session["bill_state"] %>&nbsp;<%= Session["bill_zip"] %><br>
						<%= Session["bill_phone"] %><br>
						<%= Session["bill_email"] %><br>
						<br>
						Credit Card<br>
						<%= Session["ccn"] %><br>
						Exp <%= Session["expmon"] %>/<%= Session["expyear"] %><br>
						<br>
						</span>
					</td>
					<td width=1 bgcolor=ffffff><br></td>
					<td width=16><br></td>
					<td width=200 valign=top>
						<img src=images/lilshimmy.gif height=15><br>
						<table border=0 cellpadding=0 cellspacing=0>
							<tr>
								<td width=120>
									<span class=norm><b>Shipping Info</b></span><br>
								</td>
								<td>
									<a href=store_shipping.aspx><img src=images/button_edit.gif border=0></a><br>
								</td>
							</tr>
						</table>
						<span class=norm>
						<%= Session["ship_first_name"] %>&nbsp;<%= Session["ship_last_name"] %><br>
						<%= Session["ship_address1"] %><br>
						<%= Session["ship_address2"] %><br>
						<%= Session["ship_city"] %>, <%= Session["ship_state"] %>&nbsp;<%= Session["ship_zip"] %><br>
						</span>
					</td>
				</tr>
			</table>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<span class=norm><b>Only click Confirm Order once!</b> If you click it multiple times you may be billed more than once.  If you have any questions please call us at 773-507-1379.</span>
			<br>
			<img src=images/button_confirm.gif onClick=fcheck() style="cursor: hand;"><br>
			<br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=216 valign=top bgcolor=f2f2f2>
			<img src=images/store_ignite.gif><br>
			<img src=images/lilwhite.gif width=216 height=3><br>
			<img src=images/lilshimmy.gif width=1 height=200><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer_store.aspx -->
</html>
