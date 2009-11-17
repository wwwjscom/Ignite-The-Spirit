<%@ page language=C# %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<script src=functions.cs runat=server></script>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<img src=lilshimmy.gif height=15><br>
<center>
<script language=javascript>
if (flash6 || flash7) document.write("<object classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 width=757 height=75><param name=allowScriptAccess value=sameDomain><param name=movie value=small_hdr.swf?section=store><param name=quality value=high><param name=bgcolor value=ffffff><embed src=small_hdr.swf?section=store quality=high bgcolor=ffffff width=757 height=75 allowScriptAccess=sameDomain type=application/x-shockwave-flash></object><br>");
else document.write("<iframe src=store_noflash.aspx width=757 height=197 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe><br>");
</script>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=532 valign=top bgcolor=e5e5e5>
			<img src=lilshimmy.gif height=15><br>
			<img src=lilshimmy.gif width=15 height=18><img src=store_header.gif><br>
			<img src=lilshimmy.gif height=15><br>

			<center><font size="18"><i><b>2008 Calendar coming soon!</i></b></font></center>
			<span class=norm>
			Have an E-Mail sent to you when they are ready, just put your E-Mail address in the box and click submit!<br>
			<form action="store_preorder.aspx" method="post">
			E-Mail: <input class=norm style="width: 250px;" type="text" name="email">
			<br>
			<input type=image src=button_submit.gif border=0>
			</form>
			</span>
			<%
			int itemcount = 0;
			SqlConnection dbconn = new SqlConnection(System.Configuration.ConfigurationSettings.AppSettings.Get("dbconn"));
			SqlDataAdapter sda;
			DataSet ds = new DataSet();
			sda = new SqlDataAdapter();
			SqlCommand command = new SqlCommand("insert into fire_products values('123.004','2008 Chicago Firefighter Calendar','Features 12 Male Chicago Firefighters and their stories.','15.00','1.80','2008_buymen','')",dbconn);
			dbconn.Open();
			command.ExecuteNonQuery();
			dbconn.Close();
			sda.SelectCommand = new SqlCommand("select * from fire_products ORDER BY item_number DESC", dbconn);
			sda.Fill(ds, "products");
			foreach (DataRow r in ds.Tables["products"].Rows) {
				if (itemcount > 0) Response.Write("<br><img src=lilwhite.gif width=479 height=1><br><br>");
				%>
				<%= r[0] %><br>
				<%= r[1] %><br>
				<%= r[2] %><br>
				<%= r[3] %><br>
				<%= r[4] %><br>
				<%= r[5] %><br>
				<%= r[6] %><br>
				<table border=0 cellpadding=0 cellspacing=0>
					<tr>
						<td width=310 valign=top>
							<img src=<%= r["thumbnail"] %>_large.jpg><br>
						</td>
						<td width=193 valign=top>
							<span class=head><%= r["item_name"] %></span><br>
							<span class=norm>
							<br>
							<%= r["item_description"] %><br>
							<br>
							</span>
							<span class=head>
							$<%= r["price"] %><br>
							<br>
							</span>
							<a href=https://www.ignitethespirit.org/store_cart.aspx?function=add&item_number=<%= r["item_number"] %>><img src=button_buynow.gif border=0></a><br>
						</td>
					</tr>
				</table>
				<%
			}
			%>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=216 bgcolor=f2f2f2 valign=top>
			<img src=store_ignite.gif><br>
			<img src=lilwhite.gif width=216 height=3><br>
			<img src=lilshimmy.gif width=1 height=15><br>
			<img src=lilshimmy.gif width=15 height=121><img src=store_cc_light.gif><br>
			<img src=lilshimmy.gif width=1 height=64><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer_store.aspx -->
</html>
