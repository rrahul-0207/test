<?php
include('config.php');
$rename_tables = mysql_query( "RENAME TABLE `" . wo_activities . "` TO `" . wo_activitie . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_appssessions . "` TO `" . wo_appssession . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_config . "` TO `" . wo_configs . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_admininvitations . "` TO `" . wo_admininvitation . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_followers . "` TO `" . wo_follower . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_codes . "` TO `" . wo_code . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_custompages . "` TO `" . wo_custompage . "`" );

if($rename_tables){
	
	echo "Wrong Data";
}

?>