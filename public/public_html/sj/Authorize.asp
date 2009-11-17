<%
authorizeMethod()

Sub authorizeMethod

''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'	This script is a demo script for calling the authorize method    '
'	on the SkipjackIC server. Take a minute to read all the comments '
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

'creating an instance of the COM object.

Dim objOnHand

	Set objOnHand = Server.CreateObject("SJComAPI.TransactionInfo.1")

'	objOnHand.strRequestLogFileLocation= "C:\\request.log"
'	objOnHand.strResponseLogFileLocation= "C:\\response.log"


'	if( (objOnHand.strRequestLogFileLocation= "C:\\request.log")) then
'		response.write "response file location = C:\\request.log"
'	else
'		response.write "no response file location"
'	end if 


	
'	To check if the instantiation of the COM object was successful or
'	not.

	If IsObject(objOnHand) = False Then
		response.write "COM object not created."
	End if

	' Now I am going to set the values which I receive from the form

	'All the bill to information is essential to process your order.

	'Setting the Bill To Name in the COM object.
	'Response.Write("Bill To Name " + Request.Form("billtoname") & vbrlf)
	objOnHand.strBillToName = Trim(cstr(Request.Form("billtoname")))

	'Setting the Bill To Street in the COM object.
	'Response.Write("Bill To Street " + Request.Form("billtostreetaddress"))
	objOnHand.strBillToStreetAddress = Trim(cstr(Request.Form("billtostreetaddress")))

	'Setting the Bill To City in the COM object.
	'Response.Write("Bill To City " + Request.Form("billtocity"))
	objOnHand.strBillToCity = Trim(cstr(Request.Form("billtocity")))

	'Setting the Bill To State in the COM object.
	'Response.Write("Bill To State " + Request.Form("billtostate"))
	objOnHand.strBillToState = Trim(cstr(Request.Form("billtostate")))

	'Setting the Bill To Zip in the COM object.
	'Response.Write("Bill To Zip " + Request.Form("billtozip"))
	objOnHand.strBillToZip = Trim(cstr(Request.Form("billtozip")))

	'Setting the Bill To Email in the COM object.
	'Response.Write("Bill To Email " + Request.Form("billtoemail"))
	objOnHand.strBillToEmail = Trim(cstr(Request.Form("billtoemail")))

'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'						Ship To Information							         '
'	Ship to information is not necessary to process your order. If it  '
'	empty it will be assumed that it is same as bill to information    '
'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

	'Setting the Ship To Name in the COM object.
	'Response.Write("Ship To Name " + Request.Form("shiptoname"))
	objOnHand.strShipToName = Trim(cstr(Request.Form("shiptoname")))

	'Setting the Ship To Street in the COM object.
	'Response.Write("Ship To Street " + Request.Form("shiptostreetaddress"))
	objOnHand.strShipToStreetAddress = Trim(cstr(Request.Form("shiptostreetaddress")))

	'Setting the Ship To City in the COM object.
	'Response.Write("Ship To City " + Request.Form("shiptocity"))
	objOnHand.strShipToCity = Trim(cstr(Request.Form("shiptocity")))

	'Setting the Ship To State in the COM object.
	'Response.Write("Ship To State " + Request.Form("shiptostate"))
	objOnHand.strShipToState = Trim(cstr(Request.Form("shiptostate")))

	'Setting the Ship To Zip in the COM object.
	'Response.Write("Ship To Zip " + Request.Form("shiptozip"))
	objOnHand.strShipToZip = Trim(cstr(Request.Form("shiptozip")))

	'Setting the Ship To Telephone in the COM object.
	'Response.Write("Ship To Telephone " + Request.Form("shiptotelephone"))
	objOnHand.strShipToTelephone = Trim(cstr(Request.Form("shiptotelephone")))

'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'				Order Information								         '
'		All the fields in here are necessary they either can	  '
' come from the form all you can explicitly set them here. Read '
' the readme file for further information.						  '
'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

	'Setting the Order number in the COM object.
	'Response.Write("Order Number " + Request.Form("ordernumber"))
	objOnHand.strOrderNumber = Trim(cstr(Request.Form("ordernumber")))

	'Setting the Number of items in the COM object.
	'Response.Write("Number of Items " + Request.Form("howmanyitems"))
	'objOnHand.lHowManyItems = Trim(cint(Request.Form("howmanyitems")))
	
	'set lHowManyItems to 0 if the order string is set explicitly.
	'objOnHand.lHowManyItems = 0

	'Setting the Order String in the COM object.
	'Response.Write("Order String " + Request.Form("orderstring"))
	'objOnHand.strOrderString = Trim(cstr(Request.Form("orderstring")))


	'Setting the IsProduction Flag in the COM object.
	' set the flag to 0 if you are in a testing process else
	' set the flag to 1 if you are in a production stage.

	objOnHand.strComments = "Test comment."
	
	select case (request.form("isProduction"))
	
	case "0"
		objOnHand.strIsProduction = "0"
	case "1"
		objOnHand.strIsProduction = "1"
	end select


	select case (request.form("SSLProvider"))
	
	case "1"
		objOnHand.lSSLTransport = 1
	case "2"
		objOnHand.lSSLTransport = 2
	end select




	'Setting the individual item string.
	
	for i = 0 to Request.Form("howmanyitems")
		objOnhand.SetItemString "0198536895", "Symmetry in Chaos - a search for pattern in mathematics, art and nature", "10.10", "2", "Y"
	Next 


	'Setting the Transaction Amount in the COM object.
	'Response.Write("Transaction Amount " + Request.Form("transactionamount"))
	objOnHand.strTransactionAmount = Trim(cstr(Request.Form("transactionamount")))


	'Setting the Skipjack Assigned HTML Serial Number in the COM object.
	'Response.Write("Sj Serial Number " + Request.Form("serialnumber"))
	objOnHand.strSerialNumber = Trim(cstr(Request.Form("serialnumber")))

''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'				Credit Card Information						        '
'			All the fields are necessary.					        '
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	'Setting the Credit Card Number in the COM object.
	'Response.Write("CC Number " + Request.Form("accountnumber"))

	objOnHand.strCCNumber = Trim(cstr(Request.Form("accountnumber")))

	'Setting the Expiration Month of Credit Card Number in the COM object.
	'Response.Write("Expiraiton Month " + Request.Form("month"))
	objOnHand.strCCExpirationMonth = Trim(cstr(Request.Form("month")))

	'Setting the Expiration Year of Credit Card Number in the COM object.
	'Response.Write("Expiraiton year " + Request.Form("year"))
	objOnHand.strCCExpirationYear = Trim(cstr(Request.Form("year")))


'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'	One can set user defined fields in the transaction. This is  ' 
'	a name and value pair and it will appear in the transaction  '
'	detail when you logon to the merchant services. First		   '
'	parameter is the name and the other is value.				   '
'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'				Calling the Authorization Method.			        '
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

	'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	'					VERY IMPORTANT								        '
	' When calling a method in the com object a parameter which is	 '
	' passed as value should not be of type variant but a paramter	 '
	' which is passed by reference should be variant.				    '
	'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


	objOnHand.AuthorizeEx strAuthenticationcode, strErrorInfo, strIsApproved


	'Releasing the object.
	Set objOnHand = nothing

''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'				Presenting the authorization code.			        '
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

if IsNull(strAuthenticationcode) Then
	response.write "Error"
End If

response.write "Authorization Code = " & strAuthenticationcode
response.write "<BR>"
response.write "Error Info = " & strErrorInfo
response.write "<BR>"
response.write "Is Approved = " & strIsApproved
response.write "<BR>"


end sub
%>


<!--	Displaying the the result This Html page can be modified the way you want. -->

<p><b><font face="Verdana" size="4">We are processing your order.</font></b></p>
