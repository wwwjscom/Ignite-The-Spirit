<?php
session_start();
include("db_connect.php");

$delete_query = "DELETE FROM news WHERE news_id = '$_GET[id]'";
$delete_result = mysql_query($delete_query);
header("location:index.php");
?>