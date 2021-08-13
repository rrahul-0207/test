<?php 
error_reporting(0); 
$host = 'localhost';
//$user = 'exam_port';
//$password = '2c-Z{@vb??)-';
//$dbs = 'onjobportal';

//$url='http://localhost/job';

$user = 'pushingt_suen';
$password = '_@2*-~mi#2]7';
$dbs = 'pushingt_testing_db';
$url='http://pushingthelimits.in/rohit/rr';

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
