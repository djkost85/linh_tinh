<?php
if (!defined('RAPIDLEECH'))
{
	require_once("index.html");
	exit;
}

if (strpos(strtolower($LINK), "ziddu.com/downloadlink.php?uid="))
{
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
	//file_put_contents("ziddu_1.txt", $page);
	is_page($page);
	
	if (preg_match('/<a href="(.*)" class="download">/', $page, $nextPage))
	{
		$LINK = "http://www.ziddu.com".$nextPage[1];
		$Url = parse_url($LINK);
	}
	else
	{
		html_error("Download page not found", 0);
	}
}
if (strpos(strtolower($LINK), "ziddu.com/download.php?uid="))
{
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
	//file_put_contents("ziddu_2.txt", $page);
	is_page($page);
	is_present($page, "Location: /errortracking.php?msg=File not found", "File not found");
	
	if (preg_match('/<a href="(.*)" class="link2">/', $page, $nextPage))
	{
		$LINK = "http://www.ziddu.com".$nextPage[1];
		$Url = parse_url($LINK);
	}
	else
	{
		html_error("Download page not found", 0);
	}
}
if (strpos(strtolower($Url["path"]), "/download/") !== false)
{
	$Url["path"] = str_replace("/download/", "/downloadfile/", $Url["path"]);
}

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
//file_put_contents("ziddu_3.txt", $page);
is_page($page);
is_present($page, "Location: /errortracking.php?msg=File not found", "File not found");

if (preg_match('/id="fid" value="(.*)">/', $page, $fid) && preg_match('/id="tid" value="(.*)">/', $page, $tid) && preg_match('/id="fname" value="(.*)">/', $page, $fname) && preg_match('/id="securecode" value="(.*)">/', $page, $securecode) && preg_match('/name="submit" value="(.*)">/', $page, $submit))
{
	$post = Array();
	$post["fid"] = $fid[1];
	$post["tid"] = $tid[1];
	$post["securitycode"] = $securecode[1];
	$post["fname"] = $fname[1];
	$post["securecode"] = $securecode[1];
	$post["Keyword"] = "Ok";
	$post["submit"] = $submit[1];
}
else
{
	html_error("Download form not found", 0);
}

preg_match('/Set-Cookie: ARPT=(.*); /', $page, $coo);
$cookieARPT = "ARPT=".$coo[1];
preg_match('/Set-Cookie: PHPSESSID=(.*); /', $page, $coo);
$cookiePHPSESSID = "PHPSESSID=".$coo[1];
$cookie = $cookieARPT."; ".$cookiePHPSESSID;

$FileName = $fname[1];
$Referer = $LINK;
$Url = parse_url("http://www.ziddu.com/downloadfile.php");

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
//file_put_contents("ziddu_4.txt", $page);
is_page($page);

if (preg_match('/Location: ([^\r\n]+)/', $page, $nextPage))
{
	if (strpos(strtolower($nextPage[1]), "http:") !== false)
	{
		$Url = parse_url($nextPage[1]);
	}
	else
	{
		$Url = parse_url("http://www.ziddu.com".$nextPage[1]);
	}
}
else
{
	html_error("Redirect not found", 0);
}

$cookie = $cookieARPT."; ".$cookiePHPSESSID."; popcount=1";

insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($LINK)."&cookie=".urlencode($cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : "").(isset($_GET["audl"]) ? "&audl=doum" : ""));
?>