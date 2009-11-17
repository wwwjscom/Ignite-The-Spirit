<?php
	$database = 'seemysit_uploader';
	$user = 'seemysit_upload';
	$password = 'test';
	
	mysql_connect('localhost', $user, $password) or die('Could not connect to database.');
	mysql_select_db($database);
?>