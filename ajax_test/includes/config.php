<?php
	$host = "localhost";
	$user_host = "root";
	$pass_host = "root";
	$db_name = "tintuc";
	
	$link = mysql_connect($host,$user_host,$pass_host) or die("can not connect host");
	mysql_select_db($db_name,$link) or die("can not connect database");
	
?>