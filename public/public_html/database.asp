<%
set dbconn = server.createobject("ADODB.Connection")
dbconn.open "ignite", "ignite", "fire77"
set rs = server.createobject("ADODB.Recordset")
rs.activeconnection = dbconn
%>
