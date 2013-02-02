<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }

$langcookie = "setlang=en";

/*if ($_GET["step"] == "1")
	{*/
  $post = array();
  $post["cs_data"] = $_GET["cs_data"];
	$post["saff"]="0";
  $post["s"]="0";
  $post["us"]="0";
	$post["nextstep"]="1";
	$post["imgcode"] = $_GET["imgcode"];
  
  $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $langcookie, $post, 0, $_GET["proxy"],$pauth);
  is_page($page);
  
  is_present($page,'You seem to have bumped into an invalid link');
  
 /*$linkblock = trim(cut_str($page,'<div id="linkblock"','</div>'));
      				
if (!$Href)
  	{
    html_error("Download link not found", 0);
    }
      				
$Href = trim(cut_str($linkblock, '<a href="', '"'));
*/
  preg_match('/href="(.+get.php?.+?)"/', $page, $linkblock);
  $Href = $linkblock[1];
  
  $Url = parse_url($Href);
  $Referer = $LINK;
  
	if (!$Href)
    {
    html_error("Download link not found", 0);
    }
	
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $langcookie, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	while (stristr($page, "Location:"))
		{
		$Href = trim(cut_str($page, "Location:", "\n"));
		$Url = parse_url($Href);
						
		$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $langcookie, 0, 0, $_GET["proxy"],$pauth);
		is_page($page);
		}

	insert_location("$PHP_SELF?filename=attachment&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
/*	}
else
	{
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, $langcookie, 0, 0, $_GET["proxy"],$pauth);				
	is_page($page);
	
	if (stristr($page, "Location:"))
    {
    $Referer = $LINK;
    $Href = trim(cut_str($page, "Location:", "\n"));
    $Url = parse_url($Href);
    
    $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $langcookie, 0, 0, $_GET["proxy"],$pauth);
    is_page($page);
    }
  else
    {
    $Href = $LINK;
    }
  
	is_present($page, 'You seem to have bumped into an invalid link');
	
	$findvar = trim(cut_str($page, "Please wait %d", ");")).");";
	$findvar = trim(cut_str($findvar, '",', ");"));
  $countDown = trim(cut_str($page, $findvar."=", ";"));
  $countDown = $countDown ? $countDown : 25;
	
	$codeblock = trim(cut_str($page, "<form", "</form>"));
	
	if (!$codeblock)
    {
    html_error("Image code not found", 0);
    }
	
	$access_image_url = trim(cut_str($codeblock, '<img src="', '"'));
	
	$code = "<form name=\"dl\" action=\"$PHP_SELF\" method=\"post\">$nn";
	$code.= "<input type=\"hidden\" name=\"link\" value=\"".urlencode($Href)."\">$nn<input type=\"hidden\" name=\"referer\" value=\"".urlencode($Href)."\">$nn<input type=\"hidden\" name=\"cs_data\" value=\"".trim(cut_str($codeblock, 'name="cs_data" value="', '"'))."\">$nn<input type=\"hidden\" name=\"step\" value=\"1\">$nn";
	$code.= "<input type=\"hidden\" name=\"comment\" id=\"comment\" value=\"".$_GET["comment"]."\">$nn<input type=\"hidden\" name=\"email\" id=\"email\" value=\"".$_GET["email"]."\">$nn<input type=\"hidden\" name=\"partSize\" id=\"partSize\" value=\"".$_GET["partSize"]."\">$nn<input type=\"hidden\" name=\"method\" id=\"method\" value=\"".$_GET["method"]."\">$nn";
	$code.= "<input type=\"hidden\" name=\"proxy\" id=\"proxy\" value=\"".$_GET["proxy"]."\">$nn<input type=\"hidden\" name=\"proxyuser\" id=\"proxyuser\" value=\"".$_GET["proxyuser"]."\">$nn<input type=\"hidden\" name=\"proxypass\" id=\"proxypass\" value=\"".$_GET["proxypass"]."\">$nn<input type=\"hidden\" name=\"path\" id=\"path\" value=\"".$_GET["path"]."\">$nn";
	$code.= "<h4>Enter <img src=\"$access_image_url\"> here: <input type=\"text\" name=\"imgcode\" size=\"4\">&nbsp;&nbsp;<input type=\"submit\" value=\"Download File\"></h4>$nn";	
	$code.= "</form>$nn</body>$nn</html>";
	
	$js_code = "<script language=\"JavaScript\">".$nn."function check() {".$nn."var imagecode=document.dl.imgcode.value;".$nn.'if (imagecode == "") { window.alert("You didn\'t enter the image verification code"); return false; }'.$nn.'else { return true; }'.$nn.'}'.$nn.'</script>';
	
	insert_new_timer($countDown, rawurlencode($code), "File is being prepared.", $js_code);
  }*/
?>