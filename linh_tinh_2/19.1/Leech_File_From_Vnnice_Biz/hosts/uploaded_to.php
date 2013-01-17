<?php
if (!defined('RAPIDLEECH'))
{
	require_once("index.html");
	exit;
}

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
//file_put_contents("uploaded_to_1.txt", $page);
is_page($page);
is_present($page, "Location: /?view=error_fileremoved", "File not found");
is_present($page, "Location: /?view=error_traffic_exceeded_free", "Download limit exceeded");
is_present($page, "http://images.uploaded.to/key.gif", "This file is password protected");

if (preg_match('/(http.+dl\?id=[0-9a-zA-Z]+)/', $page, $dllink))
{
	$dlink = $dllink[1];
}
else
{
	html_error("Download link not found", 0);
}
$Url = parse_url($dlink);
$FileName = "none";

insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
?>