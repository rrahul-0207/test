<?php 
error_reporting(0); 
$host = 'localhost';
$user = 'qwwxser';
$password = 'DBt]wuU5K?SH';
$dbs = 'fjdshghjh';
$url='http://mitrah.in/javascript';

$db = new mysqli($host,$user,$password,$dbs);
function formatDate($date){
	return date('g:i a',strtotime($date));
}
mysql_connect($host,$user,$password);
$asd=mysql_select_db($dbs);
if($asd)
{
	
}
else
{
	echo "<script>alert('DataBase Is Not Connected !')</script>";
}
?>
