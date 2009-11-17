<? 
/*
INSERTS NEW CALENDAR INTO DB
die("Protecting...");
$conn=odbc_connect('ignite','ignite','fire77');
$sql="INSERT INTO fire_products(item_number, item_name, item_description, price, thumbnail, shipping) VALUES ('123.003', '2007 Female Firefighter Calendar', 'Features 12 Female Chicago Firefighters and their stories.', '15.00', 'buywomen', '1.80')"; 
odbc_exec($conn,$sql);

odbc_close($conn);


$sql="SELECT * FROM fire_products"; 
$rs=odbc_exec($conn,$sql);
//odbc_fetch_row($rs);
while(odbc_fetch_row($rs))
{
 echo "Item Number: ".odbc_result($rs,1)."<br>";
 echo "Title: ".odbc_result($rs,2)."<br>";
 echo "Desc.: ".odbc_result($rs,3)."<br>";
 echo "Price: ".odbc_result($rs,4)."<br>";
 echo "Shiping: ".odbc_result($rs,5)."<br>";
 echo "Thumble: ".odbc_result($rs,6)."<br>";
 echo odbc_result($rs,7)."<br>";
}
odbc_close($conn);
*/

/*
$conn=odbc_connect('ignite','ignite','fire77');
$sql="DELETE "; 
odbc_exec($conn,$sql);

odbc_close($conn);
*/


/*
DELETES ORDERS -- Used when testing if the orders worked or not
$conn=odbc_connect('ignite','ignite','fire77');
//$sql="DELETE FROM fire_orderbasket where customernum = 184001263"; 
$sql="DELETE FROM fire_customers where customernum = 184001263"; 
odbc_exec($conn,$sql);

odbc_close($conn);



$conn=odbc_connect('ignite','ignite','fire77');
//$sql="SELECT * FROM fire_orderbasket where customernum = 184001263"; 
$sql="SELECT * FROM fire_customers where customernum = 184001263"; 
$rs=odbc_exec($conn,$sql);
echo "Trying...<br>";
while(odbc_fetch_row($rs))
{
 echo "Item Number: ".odbc_result($rs,1)."<br>";
 echo "Title: ".odbc_result($rs,2)."<br>";
 echo "Desc.: ".odbc_result($rs,3)."<br>";
 echo "Price: ".odbc_result($rs,4)."<br>";
 echo "Shiping: ".odbc_result($rs,5)."<br>";
 echo "Thumble: ".odbc_result($rs,6)."<br>";
 echo odbc_result($rs,7)."<br>";
}
odbc_close($conn);

*/





?>
