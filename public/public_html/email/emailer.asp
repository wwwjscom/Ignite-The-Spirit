<html>
<!-- #include file=../database.asp -->
<%
set m = server.createobject("JMail.Message")
m.silent = true
m.contenttype = "text/html"
m.from = "admin@ignitethespirit.org"
m.fromname = "admin@ignitethespirit.org"
m.subject = "2005 Chicago Firefighter Calendar - A Great Holiday Gift"
m.appendbodyfromfile("D:\WWWRoot\ignitethespirit.org\www\email\email.html")

sql = "select distinct email from ignite_remindme where email > 'stan117@comcast.net' order by email"
rs.open sql
while not rs.eof
	m.clearrecipients()
	m.addrecipient rs("email")
	m.send("2k3mail.siteprotect.com")
	response.write rs("email") & "<br>"
	response.flush
	rs.movenext
wend

%>
ok<br>
</html>
