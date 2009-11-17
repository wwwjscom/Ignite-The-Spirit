<%@ page language=C# %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System.Data.SqlClient" %>
<%@ Import Namespace="System.IO" %>
<%@ Import Namespace="System.Net" %>
<%@ Import Namespace="System.Web.Mail" %>
<script src=functions.cs runat=server></script>
<html>
<%
Boolean ok = false;

DateTime epoch = new DateTime(2001, 1, 1);
TimeSpan ts = DateTime.Now.Subtract(epoch);
int customernum = (int)ts.TotalSeconds;

double carttotal = 0;
double shiptotal = 0;
double transtotal = 0;
int qty;
SqlConnection dbconn = new SqlConnection(System.Configuration.ConfigurationSettings.AppSettings.Get("dbconn"));
SqlDataAdapter sda;
DataSet ds = new DataSet();
sda = new SqlDataAdapter();
foreach (String key in Session.Keys) {
	if (Session[key] == "item") {
		sda.SelectCommand = new SqlCommand("select item_number, item_name, price, shipping from fire_products where item_number = '" + key + "'", dbconn);
		sda.Fill(ds, key);
		DataRow r = ds.Tables[key].Rows[0];
		qty = (int)Session["qty" + key];
		carttotal = carttotal + (Convert.ToDouble(r["price"]) * qty);
		shiptotal = shiptotal + (Convert.ToDouble(r["shipping"]) * qty);
	}
}
transtotal = carttotal + shiptotal;

HttpWebRequest post = (HttpWebRequest)WebRequest.Create("https://www.skipjackic.com/scripts/EvolvCC.dll?AuthorizeAPI");
post.Method = "POST";
post.ContentType = "application/x-www-form-urlencoded";
String postdata = "serialnumber=000125824462&sjname=Customer&orderstring=123.001~Calendar~15.00~1~N~||";
postdata = postdata + "&ordernumber=" + customernum;
postdata = postdata + "&streetaddress=" + Session["bill_address1"];
postdata = postdata + "&city=" + Session["bill_city"];
postdata = postdata + "&state=" + Session["bill_state"];
postdata = postdata + "&zipcode=" + Session["bill_zip"];
postdata = postdata + "&shiptophone=" + Session["bill_phone"];
postdata = postdata + "&email=" + Session["bill_email"];
postdata = postdata + "&accountnumber=" + Session["ccn"];
postdata = postdata + "&month=" + Session["expmon"];
postdata = postdata + "&year=" + Session["expyear"];
postdata = postdata + "&transactionamount=" + transtotal.ToString("#,##0.00");
ASCIIEncoding encoding = new ASCIIEncoding();
byte[] bts = encoding.GetBytes(postdata);
post.ContentLength = postdata.Length;
Stream ps = post.GetRequestStream();
ps.Write(bts, 0, bts.Length);
ps.Close();
HttpWebResponse postresponse = (HttpWebResponse)post.GetResponse();
StreamReader readStream = new StreamReader(postresponse.GetResponseStream(), System.Text.Encoding.GetEncoding("utf-8"));
Char[] read = new Char[2000];
String responsestring = "";
int count = readStream.Read(read, 0, 2000);
while (count > 0) {
	responsestring = responsestring + new String(read, 0, count);
	count = readStream.Read(read, 0, 2000);
}

if (responsestring.IndexOf("EMPTY") == -1) ok = true;

//String responsestring = "";
//ok = true;

if (ok) {
	String sql;
	sql = "insert into fire_customers (customernum, bill_first_name, bill_last_name, bill_address1, bill_address2, bill_city, bill_state, bill_zip, bill_phone, bill_email, ship_first_name, ship_last_name, ship_address1, ship_address2, ship_city, ship_state, ship_zip, amount_merchandise, amount_shipping, date, status) values ('";
	sql = sql + customernum + "', '";
	sql = sql + clean((String)Session["bill_first_name"], 40) + "', '";
	sql = sql + clean((String)Session["bill_last_name"], 40) + "', '";
	sql = sql + clean((String)Session["bill_address1"], 70) + "', '";
	sql = sql + clean((String)Session["bill_address2"], 70) + "', '";
	sql = sql + clean((String)Session["bill_city"], 40) + "', '";
	sql = sql + clean((String)Session["bill_state"], 40) + "', '";
	sql = sql + clean((String)Session["bill_zip"], 10) + "', '";
	sql = sql + clean((String)Session["bill_phone"], 30) + "', '";
	sql = sql + clean((String)Session["bill_email"], 70) + "', '";
	sql = sql + clean((String)Session["ship_first_name"], 40) + "', '";
	sql = sql + clean((String)Session["ship_last_name"], 40) + "', '";
	sql = sql + clean((String)Session["ship_address1"], 70) + "', '";
	sql = sql + clean((String)Session["ship_address2"], 70) + "', '";
	sql = sql + clean((String)Session["ship_city"], 40) + "', '";
	sql = sql + clean((String)Session["ship_state"], 40) + "', '";
	sql = sql + clean((String)Session["ship_zip"], 10) + "', '";
	sql = sql + carttotal + "', '";
	sql = sql + shiptotal + "', '";
	sql = sql + DateTime.Now + "', 0)";
	dononq(sql, dbconn);

	foreach (String key in Session.Keys) {
		if (Session[key] == "item") {
			sql = "insert into fire_orderbasket (customernum, item_number, qty) values ('";
			sql = sql + customernum + "', '";
			sql = sql + key + "', ";
			sql = sql + Session["qty" + key] + ")";
			dononq(sql, dbconn);
		}
	}

	String body;
	body = "Thank you! Please accept this email as confirmation that we received your order from the Ignite the Spirit Online Store. All proceeds from your purchase will go to the Ignite the Spirit Fund to benefit Chicago firefighters and their families in times of need.\n\n";
	body = body + "Your purchase will be shipped via the United States Postal Service. You should receive your delivery in 7-10 days.\n";
	body = body + "If you have questions please contact:\n";
	body = body + "IGNITE THE SPIRIT at 773-507-1379\n\n";
	body = body + "Please keep a copy of this in a safe place - it may be your only record of this transaction.\n\n";
	body = body + "Order Number: " + customernum + "\n";
	body = body + "Transaction Amount: $" + transtotal.ToString("#,##0.00") + "\n";
	body = body + "Name: " + Session["ship_first_name"] + " " + Session["ship_last_name"] + "\n";
	body = body + "Address: " + Session["ship_address1"] + " " + Session["ship_address2"] + "\n";
	body = body + "City: " + Session["ship_city"] + "\n";
	body = body + "State: " + Session["ship_state"] + "\n";
	body = body + "Zip: " + Session["ship_zip"] + "\n\n";
	body = body + "We appreciate your support!" + "\n\n";
	body = body + "Sincerely," + "\n";
	body = body + "Your Friends at Ignite the Spirit\n";
	MailMessage mess = new MailMessage();
	mess.To = (String)Session["bill_email"];
	mess.From = "admin@ignitethespirit.org";
	mess.Subject = "Thank you for your order from Ignite the Spirit!";
	mess.Body = body;
	SmtpMail.SmtpServer = System.Configuration.ConfigurationSettings.AppSettings.Get("emailserver");
	SmtpMail.Send(mess);
}
else {
	String sql = "insert into fire_failures (customernum, response) values ('" + customernum + "', '" + clean(responsestring, 2000) + "')";
	dononq(sql, dbconn);
	sql = "insert into fire_customers (customernum, bill_first_name, bill_last_name, bill_address1, bill_address2, bill_city, bill_state, bill_zip, bill_phone, bill_email, ship_first_name, ship_last_name, ship_address1, ship_address2, ship_city, ship_state, ship_zip, amount_merchandise, amount_shipping, date, status) values ('";
	sql = sql + customernum + "', '";
	sql = sql + clean((String)Session["bill_first_name"], 40) + "', '";
	sql = sql + clean((String)Session["bill_last_name"], 40) + "', '";
	sql = sql + clean((String)Session["bill_address1"], 70) + "', '";
	sql = sql + clean((String)Session["bill_address2"], 70) + "', '";
	sql = sql + clean((String)Session["bill_city"], 40) + "', '";
	sql = sql + clean((String)Session["bill_state"], 40) + "', '";
	sql = sql + clean((String)Session["bill_zip"], 10) + "', '";
	sql = sql + clean((String)Session["bill_phone"], 30) + "', '";
	sql = sql + clean((String)Session["bill_email"], 70) + "', '";
	sql = sql + clean((String)Session["ship_first_name"], 40) + "', '";
	sql = sql + clean((String)Session["ship_last_name"], 40) + "', '";
	sql = sql + clean((String)Session["ship_address1"], 70) + "', '";
	sql = sql + clean((String)Session["ship_address2"], 70) + "', '";
	sql = sql + clean((String)Session["ship_city"], 40) + "', '";
	sql = sql + clean((String)Session["ship_state"], 40) + "', '";
	sql = sql + clean((String)Session["ship_zip"], 10) + "', '";
	sql = sql + carttotal + "', '";
	sql = sql + shiptotal + "', '";
	sql = sql + DateTime.Now + "', -1)";
	dononq(sql, dbconn);
}

%>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
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
			<img src=images/store_thankyou_header.gif><br>
			<img src=images/lilshimmy.gif height=15><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=350>
						<%
						if (ok) {
							%>
							<span class=norm>
							We received your order. Your purchase will be shipped by standard US Mail. Ignite the Spirit greatly appreciates your support.<br>
							<%
						}
						else {
							%>
							<span class=normr>
							Your credit card was declined. Please use your browser's back button and verify that all information is correct.<br>
							<%
						}
						%>
						</span>							
					</td>
				</tr>
			</table>
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
