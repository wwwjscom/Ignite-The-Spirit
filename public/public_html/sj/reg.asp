<html>
<%
response.write now & "<br>"
Dim WshShell
Set WshShell = CreateObject("Wscript.Shell")
com = "regsvr32 /s c:\websites\popstudio\ignitethespirit\uu\skipjack\SJComAPI.dll"
WshShell.run com, 1, true
%>
ok<br>
</html>
