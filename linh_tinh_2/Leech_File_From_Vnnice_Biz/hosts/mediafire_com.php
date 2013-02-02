<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	preg_match('/Location:.*error/i', $page) ? html_error("Invalid File", 0) : '';
	if(preg_match('/Location: (.*)/i', $page, $redir))
	  {
		$Href = trim($redir[1]);
		$Url = parse_url($Href);
		$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
		is_page($page);
	  }
	
	preg_match('/Set-Cookie: (.*)/i', $page, $cook);
	$cookie = $cook[1];
	
	preg_match('/cu\((.*?)\);/', $page, $values);
	$value = preg_split('/\',?\'?/', $values[1], -1, PREG_SPLIT_NO_EMPTY);
	$qk = $value[0];
	$pk = $value[1];
	$r = $value[2];
	
	$Href = "http://www.mediafire.com/dynamic/download.php?qk=$value[0]&pk=$value[1]&r=$value[2]";
	$Url = parse_url($Href);
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, 0, 0, $_GET["proxy"],$pauth);

	preg_match('%starting.*href=.*http://"\+ ?(.*) ?\+\'/\'\+ ?(.*) ?\+\'g/\'\+ ?(.*) ?\+\'/\'\+ ?(.*) ?\+\'">%', $page, $parts);
	preg_match('/'.trim($parts[1]).' ?= ?\'(.*?)\';/', $page, $mhost);
	preg_match('/'.trim($parts[2]).' ?= ?\'(.*?)\';/', $page, $mpath1);
	preg_match('/'.trim($parts[3]).' ?= ?\'(.*?)\';/', $page, $mpath2);
	preg_match('/'.trim($parts[4]).' ?= ?\'(.*?)\';/', $page, $mname);
	
	$Href = 'http://'.$mhost[1].'/'.$mpath1[1].'g/'.$mpath2[1].'/'.$mname[1];
	$Url = parse_url($Href);
	$FileName = !$FileName ? basename($Url["path"]) : $FileName;
	insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "")."&auth=".$auth.($pauth ? "&pauth=$pauth" : ""));
?>