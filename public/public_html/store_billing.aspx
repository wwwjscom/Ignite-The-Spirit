<%@ page language=C# %>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<script language=javascript>
function setdate() {
	m = "<%= Session["expmon"] %>";
	if (m == "") m = new Date().getMonth() + 1;
	for (i = 0; i < document.frm.expmon.length; i++) {
		if (document.frm.expmon[i].value == m) document.frm.expmon[i].selected = true;
		else document.frm.expmon[i].selected = false;
	}
	y = "<%= Session["expyear"] %>";
	if (y != "") {
		for (i = 0; i < document.frm.expyear.length; i++) {
			if (document.frm.expyear[i].value == y) document.frm.expyear[i].selected = true;
			else document.frm.expyear[i].selected = false;
		}
	}
}

function fcheck() {
	err = "";
	if (document.frm.bill_first_name.value == "") err = "Please enter your first name";
	else if (document.frm.bill_last_name.value == "") err = "Please enter your last name";
	else if (document.frm.bill_address1.value == "") err = "Please enter your address";
	else if (document.frm.bill_city.value == "") err = "Please enter your city";
	else if (document.frm.bill_state.value == "") err = "Please enter your state";
	else if (document.frm.bill_zip.value == "") err = "Please enter your zip";
	else if (document.frm.bill_phone.value == "") err = "Please enter your phone number";
	else if (document.frm.bill_email.value == "") err = "Please enter your email";
	else if (document.frm.ccn.value == "") err = "Please enter your credit card number";
	else if (document.frm.ccn.value.indexOf(" ") != -1) err = "Please, no spaces in credit card number";
	else if (document.frm.ccn.value.indexOf("-") != -1) err = "Please, no punctuation in credit card number";
	if (err != "") alert(err);
	else document.frm.submit();
}
</script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0 onLoad=setdate()>
<form action=store_shipping.aspx method=post name=frm>
<img src=lilshimmy.gif height=15><br>
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
			<img src=images/store_billing_header.gif><br>
			<img src=images/lilshimmy.gif height=5><br>
			<span class=norm><a href=store_cart.aspx>View Cart</a> | Billing Info</span><span class=normg> | Shipping Info | Review Order</span><br>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<img src=images/lilshimmy.gif height=15><br>
			<span class=normr>
			<i>Fields in red are required information.</i><br>
			<br>
			</span>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=208>
						<span class=normr>First Name</span><br>
						<input type=text name=bill_first_name value="<%= Session["bill_first_name"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
					<td>
						<span class=normr>Last Name</span><br>
						<input type=text name=bill_last_name value="<%= Session["bill_last_name"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
				</tr>
			</table>
			<span class=normr>Address</span><br>
			<input type=text name=bill_address1 value="<%= Session["bill_address1"] %>" maxlength=80 style="width: 401px;"><br>
			<span class=norm>Address 2</span><br>
			<input type=text name=bill_address2 value="<%= Session["bill_address2"] %>" maxlength=80 style="width: 401px;"><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=208>
						<span class=normr>City</span><br>
						<input type=text name=bill_city value="<%= Session["bill_city"] %>" maxlength=40 style="width: 193px;"><br>
					</td>
					<td width=104>
						<span class=normr>State</span><br>
						<input type=text name=bill_state value="<%= Session["bill_state"] %>" maxlength=40 style="width: 89px;"><br>
					</td>
					<td>
						<span class=normr>Zip</span><br>
						<input type=text name=bill_zip value="<%= Session["bill_zip"] %>" maxlength=10 style="width: 89px;"><br>
					</td>
				</tr>
			</table>
			<span class=normr>
			Phone<br>
			<input type=text name=bill_phone value="<%= Session["bill_phone"] %>" maxlength=30 style="width: 401px;"><br>
			Email<br>
			<input type=text name=bill_email value="<%= Session["bill_email"] %>" maxlength=70 style="width: 401px;"><br>
			<br>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<br>
			Credit Card Number<br>
			<input type=text name=ccn value="<%= Session["ccn"] %>" maxlength=16 style="width: 401px;"><br>
			Exp Date<br>
			<select name=expmon><option value=01>Jan<option value=02>Feb<option value=03>Mar<option value=04>Apr<option value=05>May<option value=06>Jun<option value=07>Jul<option value=08>Aug<option value=09>Sep<option value=10>Oct<option value=11>Nov<option value=12>Dec</select>
			<select name=expyear>
			<%
			int i;
			int yy = DateTime.Now.Year;
			for (i = yy; i < yy + 10; i++) {
				Response.Write("<option value=" + i + ">" + i);
			}
			%>
			</select><br>
			<br>
			</span>
			<img src=images/lilwhite.gif width=417 height=1><br>
			<br>
			<img src=images/button_nextstep.gif onClick=fcheck() style="cursor: hand;"><br>
			<br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=216 valign=top bgcolor=f2f2f2>
			<img src=images/store_ignite.gif><br>
			<img src=images/lilwhite.gif width=216 height=3><br>
			<img src=images/lilshimmy.gif width=1 height=240><br>
			<img src=images/lilshimmy.gif width=15 height=121><img src=store_cc_light.gif><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer_store.aspx -->
</html>
