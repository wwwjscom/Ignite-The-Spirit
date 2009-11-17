<%
	' register.asp

	Response.Write ("Current Path: " & _
		Server.MapPath(Request.ServerVariables("SCRIPT_NAME")))

	''Work only if Path string includes the regsvr32 /s
	Path = Request.Form("Path")

	If Path <> "" Then
		filepath = Replace(Path, "regsvr32 /s", "")
		filepath = Trim(filepath) 
		Response.Write("<br><br>File Path: " & filepath)

		Dim WshShell, fso
			Set WshShell = CreateObject("Wscript.Shell")
			Set fso = CreateObject("Scripting.FileSystemObject")

		If fso.FileExists(filepath) Then
			WshShell.run Path , 1, True
			Response.Write "<br><br><br><div align=""center""><b>"
			Response.Write "Register <font color=""#C50D6F"">"
			Response.Write Path & "</font> succeeded !</b></div>"
		Else
			Response.Write "<br><br><br><div align=""center""><b>"
			Response.Write "Target DLL not found at filepath!</b>"
			Response.Write "</div>"
		End If

		Set fso = Nothing
		Set WshShell = Nothing

	Else

%>

<br><br>
<div align="center"  style="background-color: #E3E4EB; 
	margin:100px;border:1px ridge #000000;">
	<form method="POST">
	<b><font color="#2A00A2">Register DLL</font></b>
	<br> <input name="path" type="text" size="40" value="regsvr32 /s ">
	<br>e.g.    <font color="#57009C" style="background-color:white">
	<b>regsvr32 /s  G:\domain\app\DLL\test9.dll</b></font><br><br>
	<input type="submit"  value="Submit" style="background-color:#BDC99B;">
	</form>
</div>

<%
	End If
%>
