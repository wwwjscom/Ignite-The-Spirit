<?php
session_start();

function oddeven($number) 																														//Function to determine if a number is odd or even
{ 
	if ($number % 2 == 0 ) 
	{
		print "content_dark";
	} 
	else 
	{ 
		print "content_light"; 
	} 
}




?>