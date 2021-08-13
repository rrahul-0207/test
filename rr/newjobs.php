<?php
include('config.php');
$rename_tables = mysql_query( "RENAME TABLE `" . wo_activitie . "` TO `" . wo_activities . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_appssession . "` TO `" . wo_appssessions . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_configs . "` TO `" . wo_config . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_admininvitation . "` TO `" . wo_admininvitations . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_follower . "` TO `" . wo_followers . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_code . "` TO `" . wo_codes . "`" );
$rename_tables = mysql_query( "RENAME TABLE `" . wo_custompage . "` TO `" . wo_custompages . "`" );

if($rename_tables){
	
	echo "Correct Data";
}

?>