<%@ page language=C# %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<script src=functions.cs runat=server></script>
<html>
<%
double carttotal = 0;
double shiptotal = 0;
if (Request["function"] == "add") {
	Session.Add(Request["item_number"], "item");
	Session.Add("qty" + Request["item_number"], 1);
}
if (Request["function"] == "remove") {
	Session.Remove(Request["item_number"]);
	Session.Remove("qty" + Request["item_number"]);
}
if (Request["function"] == "update") {
	int i;
	for (i = 0; i < Request.Form.AllKeys.Length; i++) {
		if (Request.Form.AllKeys[i].Substring(0, 3) == "qty") {
			Session[Request.Form.AllKeys[i]] = Convert.ToInt32(Request.Form[i]);
		}
	}
}
%>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<script language=javascript>
function fcheck() {
	for (i = 0; i < document.frm.elements.length; i++) {
		if (document.frm.elements[i].name.indexOf("qty") != -1) {
			document.frm.elements[i].value = parseInt(document.frm.elements[i].value);
			if (isNaN(document.frm.elements[i].value)) document.frm.elements[i].value = "1";
		}
	}
	document.frm.submit();
}
</script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<form action=store_cart.aspx method=post name=frm>
<input type=hidden name=function value=update>
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
			<img src=images/store_cart_header.gif><br>
			<img src=images/lilshimmy.gif height=5><br>
			<span class=norm>View Cart</span><span class=normg> | Billing Info | Shipping Info | Review Order</span><br>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<img src=images/lilshimmy.gif height=15><br>
			<%
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
					<img src=lilwhite.gif width=350 height=1><br>
					<img src=lilshimmy.gif height=2><br>
					<table border=0 cellpadding=0 cellspacing=0>
						<tr>
							<td width=120>
								<span class=norm>Each: $<%= r["price"] %></span><br>
							</td>
							<td width=40>
								<span class=norm>Qty: </span><br>
							</td>
							<td width=90>
								<input type=text name=qty<%= r["item_number"] %> value=<%= qty %> size=3 style="width: 50px;"><br>
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
					<td width=120><br></td>
					<td>
						<img src=images/button_update.gif onClick=fcheck() style="cursor: hand;"><br>
					</td>
				</tr>
			</table>
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
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<img src=images/lilshimmy.gif height=10><br>
			<a href=store_billing.aspx><img src=images/button_checkout.gif border=0></a><br>
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
