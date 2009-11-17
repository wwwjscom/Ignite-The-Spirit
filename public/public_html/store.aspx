<%@ page language=C# %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<script src=functions.cs runat=server></script>
<html>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<img src=images/lilshimmy.gif height=15><br>
<center>
<script language=javascript>
if (flash6 || flash7) document.write("<object classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 width=757 height=75><param name=allowScriptAccess value=sameDomain><param name=movie value=small_hdr.swf?section=store><param name=quality value=high><param name=bgcolor value=ffffff><embed src=small_hdr.swf?section=store quality=high bgcolor=ffffff width=757 height=75 allowScriptAccess=sameDomain type=application/x-shockwave-flash></object><br>");
else document.write("<iframe src=images/store_noflash.aspx width=757 height=197 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe><br>");
</script>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=532 valign=top bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=15><br>
			<img src=images/lilshimmy.gif width=15 height=18><img src=images/store_header.gif>
			<!--<h1>&nbsp; &nbsp; The Store Will Return Soon.</h1> -->
			<img src=images/lilshimmy.gif height=15><br> <br>

			<!--
			<center><font size="18"><i><b>2008 Calendar coming soon!</i></b></font></center>
			<span class=norm>
			Have an E-Mail sent to you when they are ready, just put your E-Mail address in the box and click submit!<br>
			<form action="store_preorder.aspx" method="post">
			E-Mail: <input class=norm style="width: 250px;" type="text" name="email">
			<br>
			<input type=image src=button_submit.gif border=0>
			</form>
			</span>
			-->
			
			<!--
			<table cellpadding=25><tr><td>The Shopping Cart page for ordering calendars will be shut down for a couple of days for repair. If you are looking to purchase a calendar go to the hot line number <b>773.507.1379</b> and leave a message and a member of the Ignite the Spirit team will return your call ASAP. Thank You and we are sorry for the inconvienence.</td></tr></table>
			-->
			
			
			
			<table border=0>
				<tr>
					<td rowspan=2>
					<img src=images/2008_buymen_large.jpg>
					</td>
					<td>
					<h3>2008 Chicago Firefighter Calendar</h3>
				<h5>Features 12 Male Chicago Firefighters and their stories.</h5>
					</td>
				</tr>
				<tr>
			
					<td>
						<table>
							<tr>
								<td>
								<h3>$15.00 + S&amp;H </h3>
								</td>
								<td>
								<form method="POST" action="https://checkout.google.com/cws/v2/Merchant/153253128090852/checkoutForm" accept-charset="utf-8">
								<input type="hidden" name="item_name_1" value="2008 Chicago Firefighter Calendar"/>
							    <input type="hidden" name="item_description_1" value="Features 12 Male Chicago Firefighters and their stories."/>
  								<input type="hidden" name="item_quantity_1" value="1"/>
  								<input type="hidden" name="item_price_1" value="15.00"/>
	
  								<input type="hidden" name="ship_method_name_1" value="USPS"/>
  								<input type="hidden" name="ship_method_price_1" value="1.80"/>

  								<input type="hidden" name="tax_rate" value="0.000"/>
  								<input type="hidden" name="tax_us_state" value="NY"/>

  								<input type="hidden" name="_charset_"/>

  								<input type="image" name="Google Checkout" alt="Fast checkout through Google" src="https://checkout.google.com/buttons/buy.gif?merchant_id=153253128090852&amp;w=121&amp;h=44&amp;style=trans&amp;variant=text&amp;loc=en_US" height="35" width="90"/>

								</form>

								
								



								</td>
							</tr>
						</table>
					
					</td>
				</tr>
			</table>
			

				
			
				


			
			<%  /*
			int itemcount = 0;
			SqlConnection dbconn = new SqlConnection(System.Configuration.ConfigurationSettings.AppSettings.Get("dbconn"));
			SqlDataAdapter sda;
			DataSet ds = new DataSet();
			sda = new SqlDataAdapter();
			sda.SelectCommand = new SqlCommand("select item_number, item_name, price, item_description, thumbnail from fire_products ORDER BY item_number DESC", dbconn);
			sda.Fill(ds, "products");
			foreach (DataRow r in ds.Tables["products"].Rows) {
				if (itemcount > 0) Response.Write("<br><img src=images/lilwhite.gif width=479 height=1><br><br>");
				%>
				<table border=0 cellpadding=0 cellspacing=0>
					<tr>
						<td width=310 valign=top>
							<img src=images/<%= r["thumbnail"] %>_large.jpg><br>
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
							<a href=https://www.ignitethespirit.org/store_cart.aspx?function=add&item_number=<%= r["item_number"] %>><img src=images/button_buynow.gif border=0></a><br>
						</td>
					</tr>
				</table>
				<%
			}  */
			%>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=216 bgcolor=f2f2f2 valign=top>
			<img src=images/store_ignite.gif><br>
			<img src=images/lilwhite.gif width=216 height=3><br>
			<img src=images/lilshimmy.gif width=1 height=15><br>
			<img src=images/lilshimmy.gif width=15 height=121><!-- <img src=images/store_cc_light.gif> --><br>
			<img src=images/lilshimmy.gif width=1 height=64><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer_store.aspx -->
</html>
