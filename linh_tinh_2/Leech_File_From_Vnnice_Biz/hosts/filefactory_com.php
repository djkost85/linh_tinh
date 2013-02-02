<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }

if ($_GET["step"] == "1")
  {
  $post = array();
  $post["f"] = $_POST["f"];
  $post["h"] = $_POST["h"];
  $post["b"] = $_POST["b"];
  
  
  $post["captcha"] = $_POST["captcha"];
  
  $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, $post, 0, $_GET["proxy"],$pauth);
  is_page($page);
  
  preg_match('%(/check/.+?)"%', $page, $finallink);
  $midHref = "http://www.filefactory.com".$finallink[1];
 
  $Href = str_replace('&amp;','&', $midHref);
  $Url = parse_url($Href);
  
   
   $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, 0, $post, 0, $_GET["proxy"],$pauth);
  is_page($page);
  
	preg_match('/<a (target="_top")?.*href="(.+?)"/', $page, $dllink);
	$Href = $dllink[2];
	$Url = parse_url($Href);
  
  if (!is_array($Url))
    {
    html_error("Download link not found", 0);
    }
  
  $FileName = "attachment";
  
  insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&cookie=".urlencode($premium_cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".$_POST["link2"].($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
}
else
  {
  
  $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, 0, 0, 0, $_GET["proxy"],$pauth);
  is_page($page);

  is_present($page, "This file is no longer available");
  is_notpresent($page, "basicLink", "Download link not found");
  preg_match('/<a href="(.+)" id="basicLink">/', $page, $basiclink);
  $Href = "http://www.filefactory.com".$basiclink[1];
  preg_match('%/f/(.+?)/b/(.+)/h/(.+?)/%', $basiclink[1], $capimg);
  $f = $capimg[1];
  $b = $capimg[2];
  $h = $capimg[3];
  $access_image_url = "http://www.filefactory.com/securimage/securimage_show.php?f=".$f."&h=".$h;
    
  print "<form name=\"dl\" action=\"$PHP_SELF\" method=\"post\">\n";
  print "<input type=\"hidden\" name=\"link\" value=\"".urlencode($Href)."\">\n<input type=\"hidden\" name=\"link2\" value=\"".urlencode($LINK)."\">\n<input type=\"hidden\" name=\"referer\" value=\"".urlencode($Href)."\">\n<input type=\"hidden\" name=\"f\" value=\"$f\">\n<input type=\"hidden\" name=\"h\" value=\"$h\">\n<input type=\"hidden\" name=\"b\" value=\"$b\">\n<input type=\"hidden\" name=\"step\" value=\"1\">\n";
  print "<input type=\"hidden\" name=\"comment\" id=\"comment\" value=\"".$_GET["comment"]."\">\n<input type=\"hidden\" name=\"email\" id=\"email\" value=\"".$_GET["email"]."\">\n<input type=\"hidden\" name=\"partSize\" id=\"partSize\" value=\"".$_GET["partSize"]."\">\n<input type=\"hidden\" name=\"method\" id=\"method\" value=\"".$_GET["method"]."\">\n";
  print "<input type=\"hidden\" name=\"proxy\" id=\"proxy\" value=\"".$_GET["proxy"]."\">\n<input type=\"hidden\" name=\"proxyuser\" id=\"proxyuser\" value=\"".$_GET["proxyuser"]."\">\n<input type=\"hidden\" name=\"proxypass\" id=\"proxypass\" value=\"".$_GET["proxypass"]."\">\n<input type=\"hidden\" name=\"path\" id=\"path\" value=\"".$_GET["path"]."\">\n";
  print "<h4>Enter <img src=\"$access_image_url\"> here: <input type=\"text\" name=\"captcha\" size=\"4\">&nbsp;&nbsp;<input type=\"submit\" onclick=\"return check()\" value=\"Download File\"></h4>\n";
  print "<script language=\"JavaScript\">".$nn."function check() {".$nn."var imagecode=document.dl.captcha.value;".$nn.'if (imagecode == "") { window.alert("You didn\'t enter the image verification code"); return false; }'.$nn.'else { return true; }'.$nn.'}'.$nn.'</script>'.$nn;
  print "</form>\n</body>\n</html>";
  
  }
?>