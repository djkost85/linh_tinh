<?php
if (!defined('RAPIDLEECH'))
{
	require_once("index.html");
	exit;
}

$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
is_page($page);
is_present($page, "The download is deleted or the Download-Link is wrong.");

if(preg_match('/Set-Cookie: (.*);/i', $page, $cook))
{
	$cookie = $cook[1];
}
else
{
	html_error("Cookie not found", 0);
}
if (preg_match('/<input class="d_button" name="([a-z0-9]{32})"/i', $page, $button))
{
	$submit = $button[1];
}
else
{
	html_error("Download link not found", 0);
}

$post = Array();
$post[$submit] = "Download Now !";
$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
is_page($page);
is_present($page, "You already have started a Download.", "Your IP is already downloading a file");
is_present($page, "You already have downloaded more than", "Download limit exceeded");

if (preg_match('/Location: ([^\r\n]+)/i', $page, $redir))
{
	$Url = parse_url($redir[1]);
}
else
{
	html_error("Final download link not found", 0);
}
insert_location("$PHP_SELF?filename=none&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&cookie=".urlencode($cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".$LINK.($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
?>