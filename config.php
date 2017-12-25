<?php
/**********************************************************************
	Language
***********************************************************************/
$LANG_DIR = "lang/";
#$LANG = "en";
#$LANG = "jp";
$LANG = "zh-simp";
#$LANG = "zh-tw";
@include("$LANG_DIR$LANG.php");


/**********************************************************************
	timezone
***********************************************************************/
date_default_timezone_set("Asia/Shanghai");
#date_default_timezone_set("Asia/Tokyo");
#date_default_timezone_set("Asia/Taipei");
#date_default_timezone_set("Europe/London");
#date_default_timezone_set("America/New_York");

/**********************************************************************
	DataBase
***********************************************************************/

$db = new mysqli("localhost", "webdoc", "webdoc", "webdoc");
$db->set_charset("utf8");

/**********************************************************************
	table create tool config
***********************************************************************/
$CONFIG_CREATE_TABLE_LINES = 20;

?>
