<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
$es = $_POST['es']; 
if($es == "ok"){
	$post = array();
	$post["id"] = $_POST["id"];
	$post["captcha"] = $_POST["captcha"];
	
	$cookie = $_POST["cookie"];
	$Referer = $_POST["link"];
	$Href = $_POST["flink"];
	$FileName = $_POST["name"];
	
	$Url = parse_url($Href);
	$FileName = !$FileName ? basename($Url["path"]) : $FileName;
	//$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
	
	insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&cookie=".urlencode($cookie)."&post=".urlencode(serialize($post))."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&method=POST&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "")."&auth=".$auth.($pauth ? "&pauth=$pauth" : ""));
}else{
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	preg_match('/<title>Download (.*),/', $page, $name);
	preg_match('/u=\'(.*)\';/', $page, $redir);

	if(preg_match('/w=\'([0-9]*)\';/', $page, $count)){
		$countnum = $count[1];
		insert_timer($countnum, "Waiting link timelock");
	}else{
		exit('<center>Please retry.</center>');
	}
	
	$redirect = 'http://'.$Url["host"].$redir[1];
	$Url = parse_url($redirect);
	
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	preg_match_all('/Set-Cookie: *(.+);/', $page, $cook);
	$cookie = implode(';', $cook[1]);
	
	preg_match('/action="(.+?)"/', $page, $flink);
	
	preg_match('/<img *src="(.+?)"/', $page, $imglink);
	$img ='http://'.$Url["host"].$imglink[1];
	
	preg_match('/name="id" *value="(.+)">/', $page, $id);
	
	$Url = parse_url($img);
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $LINK, $cookie, 0, 0, $_GET["proxy"],$pauth);
	
	$headerend = strpos($page,"\r\n\r\n");
	$pass_img = substr($page,$headerend+4);
	write_file($download_dir."easyshare_captcha.jpg", $pass_img);
	$randnum = rand(10000, 100000);
	
	$img_data = explode("\r\n\r\n", $page);
	$header_img = $img_data[0];
	preg_match('/Set-Cookie: *(EASYID=.*?);/', $page, $easyid);
	$cookie = $cookie.';'.$easyid[1];

	print 	"<form method=\"post\" action=\"$PHP_SELF\">$nn";
	print	"<b>Please enter code:</b><br>$nn";
	print	"<img src=\"{$download_dir}easyshare_captcha.jpg?id=".$randnum."\" >$nn";
	print	"<input name=\"link\" value=\"$LINK\" type=\"hidden\">$nn";
	print	"<input name=\"flink\" value=\"$flink[1]\" type=\"hidden\">$nn";
	print	"<input type=hidden name=id value=$id[1]>$nn";
	print	"<input name=\"es\" value=\"ok\" type=\"hidden\">$nn";
	print	"<input name=\"cookie\" value=\"$cookie\" type=\"hidden\">$nn";
	print	"<input name=\"name\" value=\"$name[1]\" type=\"hidden\">$nn";
	print	"<input name=\"captcha\" type=\"text\" >";
	print	"<input name=\"Submit\" value=\"Submit\" type=\"submit\"></form>";
}
?>