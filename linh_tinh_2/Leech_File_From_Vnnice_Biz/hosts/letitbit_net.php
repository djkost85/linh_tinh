<?php
if (!defined('RAPIDLEECH'))
{
	require_once("index.html");
	exit;
}

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
//file_put_contents("letitbit_1.txt", $page);
is_page($page);
is_present($page, "The requested file was not found");
is_present($page, "Gesuchte Datei wurde nicht gefunden", "The requested file was not found");
is_present($page, "Запрашиваемый файл не найден", "The requested file was not found");

preg_match_all('/Set-Cookie: ([^\r\n]+)/', $page, $cookies);
//one day... $cookie = Array();
foreach ($cookies[1] as $fullCookie)
{
	$cookieSplit = explode("; ", $fullCookie);
	//one day... $cookie[] = $cookieSplit[0];
	$cookie .= $cookieSplit[0]."; ";
}
$cookie = substr($cookie, 0, -2); //remove one day...

if(preg_match('/<form action="(.+?)" method="post" name="Premium" id="Premium">/', $page, $nextPageArray))
{
	$Referer = $LINK;
	$nextPage = $nextPageArray[1];
}
else
{
	html_error("Could not find download form.", 0);
}
preg_match('/\n<input type="hidden" name="uid" value="(.+?)" \/>/', $page, $uidArray);

$post = Array();
$post["uid"] = $uidArray[1];
$post["frameset"] = "Download file";
$post["fix"] = "1";

$Url = parse_url($nextPage);
$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
//file_put_contents("letitbit_2.txt", $page);
is_page($page);

if(preg_match('/<frame src="(.+?)" name="topFrame"/', $page, $nextPageArray))
{
	$Referer = $nextPage;
	$nextPage = "http://letitbit.net".$nextPageArray[1];
}
else
{
	html_error("Could not find frame.", 0);
}
$Url = parse_url($nextPage);
$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, 0, 0, $_GET["proxy"],$pauth);
//file_put_contents("letitbit_3.txt", $page);
is_page($page);

if(preg_match('/<a href="(.+?)" target="_blank">/', $page, $nextPageArray))
{
	$Referer = $nextPage;
	$nextPage = $nextPageArray[1];
}
else
{
	html_error("Could not find download link.", 0);
}
$Url = parse_url($nextPage);

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, 0, 0, $_GET["proxy"],$pauth);
//file_put_contents("letitbit_4.txt", $page);

preg_match('/Location: ([^\r\n]+)/i', $page, $nextPageArray);
$Url = parse_url($nextPageArray[1]);
$FileName = basename($Url["path"]);

insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&port=".$Url["port"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : "").(isset($_GET["audl"]) ? "&audl=doum" : ""));
?>