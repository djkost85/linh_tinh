<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
				
$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"], $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
is_page($page);

preg_match_all('/Set-Cookie: *(.+);/', $page, $cook);
$cookie = implode(';', $cook[1]);
preg_match('%Name:.*>(.*)</font%i', $page, $name);
/*
if(preg_match('/var t = (\d*);/i', $page, $count))
  {
	$countDown = $count[1];
	insert_timer($countDown, "Waiting link timelock");
  }*/

if(preg_match('/var downloadlink = unescape\(\'(.*)\'\);/i', $page, $dllink))
  {
	$link = urldecode($dllink[1]);
  }
else
  {
	exit('<center>Download-link not found.</center>');
  }
$Url = parse_url($link);

$FileName = str_replace(' ', '_', trim($name[1]));

insert_location("$PHP_SELF?filename=".urlencode($FileName)."&force_name=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&cookie=".urlencode($cookie)."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "")."&auth=".$auth.($pauth ? "&pauth=$pauth" : ""));
?>