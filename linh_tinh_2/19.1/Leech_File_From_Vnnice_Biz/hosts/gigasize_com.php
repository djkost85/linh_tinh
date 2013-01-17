<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
$giga = $_POST['giga']; 
if($giga == "ok"){
	$post = array();
	$post["txtNumber"] = $_POST["txtNumber"];
	$cookie = $_POST["cookie"];
	$Referer = $_POST["link"];
	$Href = $_POST["flink"];
	
	$Url = parse_url($Href);
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
	is_page($page);
	/*
	if(preg_match('/document\.counter\.d2\.value=\'(.*)\'/', $page, $count)){
		$countnum = $count[1];
		insert_timer($countnum, "Waiting link timelock");
	}else{
		echo 'Error[getCountNum]';
		die;
	}
	*/
	preg_match('%(/getcgi\.php\?.*?)"%', $page, $dllink);
	$final = "http://www.gigasize.com".$dllink[1];
	$Url = parse_url($final);
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	preg_match('/ocation: *(.+)/', $page, $redir);
	$Url = parse_url(trim($redir[1]));
	$FileName = basename($Url["path"]);

insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&cookie=".urlencode($cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".$_POST["link2"].($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));

}else{
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	preg_match_all('/Set-Cookie: *(.+);/', $page, $cook);
	$cookie = implode(';', $cook[1]);
	
	print 	"<form method=\"post\" action=\"$PHP_SELF\">$nn";
	print	"<b>Please enter code:</b><br>$nn";
	print	"<img src=\"http://www.gigasize.com/randomImage.php\" >$nn";
	print	"<input name=\"link\" value=\"$LINK\" type=\"hidden\">$nn";
	print	"<input name=\"flink\" value=\"http://www.gigasize.com/formdownload.php\" type=\"hidden\">$nn";
	print	"<input name=\"giga\" value=\"ok\" type=\"hidden\">$nn";
	print	"<input name=\"cookie\" value=\"$cookie\" type=\"hidden\">$nn";
	print	"<input name=\"txtNumber\" type=\"text\" >";
	print	"<input name=\"Submit\" value=\"Submit\" type=\"submit\"></form>";
}
?>