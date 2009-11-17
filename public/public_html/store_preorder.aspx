<%@ page language=C# %>
<%@ Import Namespace="System.Web.Mail" %>
<html>
<%
String messtext = "Email: " + Request["email"] + "\n";
MailMessage mess = new MailMessage();
mess.To = "wwwjscom@aol.com";
mess.From = "admin@ignitethespirit.org";
mess.Subject = "preorder";
mess.Body = messtext;
SmtpMail.SmtpServer = System.Configuration.ConfigurationSettings.AppSettings.Get("emailserver");
SmtpMail.Send(mess);

//set m = server.createobject("JMail.Message")
//m.logging = true
//m.silent = true
//m.from = "admin@ignitethespirit.org"
//m.fromname = "Web Site"
//m.addrecipient "rich@popstudio.net"
//m.addrecipient "rnmpin@aol.com"
//m.subject = "message from the i.t.s. contact form"
//bod = "Name: " & request.form("name") & chr(10) & "Email: " & request.form("email") & chr(10) & "Comment:" & request.form("comment")
//m.body = bod
//m.send("2k3mail.siteprotect.com")
%>
<link rel=stylesheet href=fonts.css type=text/css>
<script language=javascript src=main.js></script>
<body bgcolor=383838 marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<img src=images/lilshimmy.gif height=15><br>
<center>
<script language=javascript>
if (flash6 || flash7) document.write("<object classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 width=757 height=75><param name=allowScriptAccess value=sameDomain><param name=movie value=small_hdr.swf?section=store><param name=quality value=high><param name=bgcolor value=ffffff><embed src=small_hdr.swf?section=store quality=high bgcolor=ffffff width=757 height=75 allowScriptAccess=sameDomain type=application/x-shockwave-flash></object><br>");
else document.write("<iframe src=images/store_noflash.aspx width=757 height=73 marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=no></iframe><br>");
</script>
<table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=115 valign=top align=center bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=5><br>
			<img src=images/logo.gif><br>
		</td>
		<td width=364 valign=top bgcolor=e5e5e5>
			<img src=images/lilshimmy.gif height=15><br>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=349>
						<span class=norm>
						Thank you!  We will E-Mail you when our calendar is ready to order online!  If you have any questions please contact us using the contact page.  Thank you once again for supporting your local firefighters!<br>
						</span>
					</td>
				</tr>
			</table>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
		<td width=269 bgcolor=f2f2f2 valign=top>
			<a href=store.asp><img src=images/buynow.jpg border=0></a><br>
			<img src=images/lilwhite.gif width=269 height=3><br>
			<img src=images/lilshimmy.gif width=1 height=200><br>
		</td>
		<td width=3 bgcolor=ffffff><br></td>
	</tr>
</table>
<!-- #include file=footer.aspx -->
</html>
