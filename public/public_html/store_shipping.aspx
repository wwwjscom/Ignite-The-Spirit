<%@ page language=C# %>
<%
if (Request.RequestType.ToLower() == "post") {
	Session["bill_first_name"] = Request["bill_first_name"];
	Session["bill_last_name"] = Request["bill_last_name"];
	Session["bill_address1"] = Request["bill_address1"];
	Session["bill_address2"] = Request["bill_address2"];
	Session["bill_city"] = Request["bill_city"];
	Session["bill_state"] = Request["bill_state"];
	Session["bill_zip"] = Request["bill_zip"];
	Session["bill_phone"] = Request["bill_phone"];
	Session["bill_email"] = Request["bill_email"];
	Session["ccn"] = Request["ccn"];
	Session["expmon"] = Request["expmon"];
	Session["expyear"] = Request["expyear"];
}
%>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<script language=javascript>
var ship_first_name = "<%= Session["bill_first_name"] %>";
var ship_last_name = "<%= Session["bill_last_name"] %>";
var ship_address1 = "<%= Session["bill_address1"] %>";
var ship_address2 = "<%= Session["bill_address2"] %>";
var ship_city = "<%= Session["bill_city"] %>";
var ship_state = "<%= Session["bill_state"] %>";
var ship_zip = "<%= Session["bill_zip"] %>";

function formfill() {
	document.frm.ship_first_name.value = ship_first_name;
	document.frm.ship_last_name.value = ship_last_name;
	document.frm.ship_address1.value = ship_address1;
	document.frm.ship_address2.value = ship_address2;
	document.frm.ship_city.value = ship_city;
	document.frm.ship_state.value = ship_state;
	document.frm.ship_zip.value = ship_zip;
}
function fcheck() {
	err = "";
	if (document.frm.ship_first_name.value == "") err = "Please enter your first name";
	else if (document.frm.ship_last_name.value == "") err = "Please enter your last name";
	else if (document.frm.ship_address1.value == "") err = "Please enter your address";
	else if (document.frm.ship_city.value == "") err = "Please enter your city";
	else if (document.frm.ship_state.value == "") err = "Please enter your state";
	else if (document.frm.ship_zip.value == "") err = "Please enter your zip";
	if (err != "") alert(err);
	else document.frm.submit();
}
</script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<form action=store_review.aspx method=post name=frm>
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
			<img src=images/store_shipping_header.gif><br>
			<img src=images/lilshimmy.gif height=5><br>
			<span class=norm><a href=store_cart.aspx>View Cart</a> | <a href=store_billing.aspx>Billing Info</a> | Shipping Info</span><span class=normg> | Review Order</span><br>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<img src=images/lilshimmy.gif height=15><br>
			<span class=normr>
			<i>Fields in red are required information.</i><br>
			<br>
			</span>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=30 valign=top align=center bgcolor=d4d4d4>
						<input type=checkbox onClick=formfill()><br>
					</td>
					<td width=387 bgcolor=d4d4d4>
						<span class=norm>
						Check here if your shipping address is the same as your billing address.<br>
						</span>
					</td>
				</tr>
			</table>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=208>
						<span class=normr>First Name</span><br>
						<input type=text name=ship_first_name value="<%= Session["ship_first_name"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
					<td>
						<span class=normr>Last Name</span><br>
						<input type=text name=ship_last_name value="<%= Session["ship_last_name"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
				</tr>
			</table>
			<span class=normr>Address</span><br>
			<input type=text name=ship_address1 value="<%= Session["ship_address1"] %>" maxlength=80 style="width: 401px;"><br>
			<span class=norm>Address 2</span><br>
			<input type=text name=ship_address2 value="<%= Session["ship_address2"] %>" maxlength=80 style="width: 401px;"><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=208>
						<span class=normr>City</span><br>
						<input type=text name=ship_city value="<%= Session["ship_city"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
					<td width=104>
						<span class=normr>State</span><br>
						<input type=text name=ship_state value="<%= Session["ship_state"] %>" maxlength=40 style="width: 89px;"><br>
					</td>
					<td>
						<span class=normr>Zip</span><br>
						<input type=text name=ship_zip value="<%= Session["ship_zip"] %>" maxlength=10 style="width: 89px;"><br>
					</td>
				</tr>
			</table>
			<br>
			<img src=images/button_nextstep.gif onClick=fcheck() style="cursor: hand;"><br>
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
