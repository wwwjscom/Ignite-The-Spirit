<html>
<%
response.write now & "<br>"
Dim WshShell
Set WshShell = CreateObject("Wscript.Shell")
com = "c:\windows\system32\regsvr32.exe /s D:\WWWRoot\ignitethespirit.org\www\sj\SJComAPI.dll"
WshShell.run com, 1, true
%>
ok<br>
</html>
