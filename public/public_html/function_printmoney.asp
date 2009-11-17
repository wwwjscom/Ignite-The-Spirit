<%
sub printmoney(v)
	vs = ""
	vs = vs & v
	if instr(vs, ".") = 0 then
		response.write vs & ".00"
	else
		vswhole = left(vs, instr(vs, ".") - 1)
		vsdecimal = right(vs, len(vs) - instr(vs, "."))
		if len(vsdecimal) = 2 then
			response.write v
		elseif len(vsdecimal) < 2 then
			response.write vswhole & "." & vsdecimal & "0"
		elseif len(vsdecimal) > 2 then
			response.write vswhole & "." & left(vsdecimal, 2)
		end if
	end if
end sub

function money(v)
	vs = ""
	vs = vs & v
	if instr(vs, ".") = 0 then
		money = vs & ".00"
	else
		vswhole = left(vs, instr(vs, ".") - 1)
		vsdecimal = right(vs, len(vs) - instr(vs, "."))
		if len(vsdecimal) = 2 then
			money = v
		elseif len(vsdecimal) < 2 then
			money = vswhole & "." & vsdecimal & "0"
		elseif len(vsdecimal) > 2 then
			money = vswhole & "." & left(vsdecimal, 2)
		end if
	end if
end function
%>
