<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }

if (($_GET["premium_acc"] == "on" && $_GET["premium_user"] && $_GET["premium_pass"]) || ($_GET["premium_acc"] == "on" && $premium_acc["megaupload"]["user"] && $premium_acc["megaupload"]["pass"] || $_GET["mu_acc"] == "on" && $_GET["mu_cookie"]) || $_GET["mu_acc"] == "on" && $mu_cookie_user_value)
  {
  $post = array();
  $post["login"] = $_GET["premium_user"] ? $_GET["premium_user"] : $premium_acc["megaupload"]["user"];
  $post["password"] = $_GET["premium_pass"] ? $_GET["premium_pass"] : $premium_acc["megaupload"]["pass"];
  $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, "/", 0, 0, $post, 0, $_GET["proxy"],$pauth);
  is_page($page);
  
  $premium_cookie = trim(cut_str($page, "Set-Cookie:", ";"));
  
	if($mu_cookie_user_value)
	{
		$premium_cookie = 'user='.$mu_cookie_user_value;
	}elseif($_GET["mu_acc"] == "on" && $_GET["mu_cookie"])
	{
		$premium_cookie = 'user='.$_GET["mu_cookie"];
	}elseif (!stristr($premium_cookie, "user"))
	{
		html_error("Cannot use premium account", 0);
	}
  
  $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, $premium_cookie, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
	
	if (stristr($page, "Location:"))
		{
		preg_match('/Location: (.*)/i', $page, $loc);
		$Href = trim($loc[1]);
		$Url =  parse_url($Href);
		$FileName = !$FileName ? basename($Url["path"]) : $FileName;
	  
	 	insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&cookie=".urlencode($premium_cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
		}
	elseif(preg_match('/href="(.*?)\' \+ \w \+ \w \+ \'(.*?)"/i', $page, $loc))
		{
		preg_match('/var \w.*abs\(\-([0-9]*)\)/i', $page, $h);
		$h_val = chr($h[1]);
		
		preg_match('/var \w.*\'(.*)\'.*sqrt\(([0-9]*)\)/i', $page, $k);
		$k_val = $k[1].chr(sqrt($k[2]));
		
		$finallink = $loc[1].$k_val.$h_val.$loc[2];
		$Url =  parse_url($finallink);
		$FileName = !$FileName ? basename($Url["path"]) : $FileName;
	  
	 	insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&cookie=".urlencode($premium_cookie)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
		}
	else
		{
		html_error("Download link not found", 0);
		}
  }
else
  {
$cookie = array("user=f256de5761a351e4b7cd7b1c0d5c266f; megauploadtoolbar_id=D910E987B19B436EBF452B3C0D503909; megauploadtoolbar_visible=yes; toolbar=1; MUTBI=E%3D3%2CP%3D3; v=1");

if ($_GET["step"] == "1")
	{
	$post["d"] = $_GET["fileid"];
	$post["imagecode"] = $_GET["imagecode"];
	$post["imagestring"] = $_GET["imagestring"];
	$post["megavar"] = $_GET["megavar"];
					
	$Href = $LINK;
	$LINK = $Referer;
	$Url = parse_url($Href);
					
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, $post, 0, $_GET["proxy"],$pauth);
	is_page($page);
					
  is_present($page, "The file you are trying to access is temporarily unavailable");
	
	$findvar = trim(cut_str($page, "'Please wait", "seconds"));
	$findvar = trim(cut_str($findvar, "+", "+"));
	$countDown = trim(cut_str($page, $findvar."=", ";"));
	$countDown = (!is_numeric($countDown) ? 26 : $countDown);
	
	$tmp = trim(cut_str($page, 'if('.$findvar.' == 0)', 'if('.$findvar.' > 0)'));
	$tmp_url = '"'.trim(cut_str($tmp, '("dlbutton").innerHTML = \'<a href="', '"')).'"';
					
	if (!$tmp_url)
    {
    html_error("Download link not found", 0);
    }
          
  $a = chr(abs(trim(cut_str($tmp, "Math.abs(", "))"))));
  $b = trim(cut_str($tmp, "var", "document"));
  $b = trim(cut_str($b, "var", ";"));
  $b = trim(cut_str($b, "'", "'")).chr(sqrt(trim(cut_str($b, "Math.sqrt(", "))"))));
          
  $Href = trim(cut_str($tmp_url, '"', "' +")).$b.$a.trim(cut_str($tmp_url, "+ '", '"'));
	$Url = parse_url($Href);
					
	if (!is_array($Url))
		{
		html_error("Download link not found", 0);
		}
					
	insert_timer($countDown, "The file is being prepared.","",true);
					
	$FileName = !$FileName ? basename($Url["path"]) : $FileName;
					
	insert_location("$PHP_SELF?filename=".urlencode($FileName)."&host=".$Url["host"]."&path=".urlencode($Url["path"].($Url["query"] ? "?".$Url["query"] : ""))."&referer=".urlencode($Referer)."&email=".($_GET["domail"] ? $_GET["email"] : "")."&partSize=".($_GET["split"] ? $_GET["partSize"] : "")."&method=".$_GET["method"]."&proxy=".($_GET["useproxy"] ? $_GET["proxy"] : "")."&saveto=".$_GET["path"]."&link=".urlencode($LINK).($_GET["add_comment"] == "on" ? "&comment=".urlencode($_GET["comment"]) : "").($pauth ? "&pauth=$pauth" : ""));
	}
else
	{
	list ($tmp,$fid) = explode('=',$Url["query"]);
	$page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), 0, $cookie, 0, 0, $_GET["proxy"],$pauth);
	is_page($page);
					
	if (stristr($page, "Location:"))
    {
    $Referer = $LINK;
    $Href = trim(cut_str($page, "ocation:", "\n"));
    $Url = parse_url($Href);
            
    $page = geturl($Url["host"], $Url["port"] ? $Url["port"] : 80, $Url["path"].($Url["query"] ? "?".$Url["query"] : ""), $Referer, $cookie, 0, 0, $_GET["proxy"],$pauth);
    is_page($page);
            
    is_present($page, "All download slots assigned to your country", "All download slots assigned to your country are currently in use");
    
    if (!stristr($page, "capgen.php?"))
      {
      print "An error occured, see details below:<br>".$nn.str_replace("<HEAD>", "<HEAD>$nn<base href=\"http://www.megaupload.com\">", $page);
      exit;
      }
    }
    
  is_present($page, 'The file you are trying to access is temporarily unavailable');
  is_present($page, 'the link you have clicked is not available', 'Invalid link');
  is_present($page, 'This file has expired due to inactivity');
            
  $Href = cut_str(cut_str($page, '<div id="downloadbutton"', '</div>'), '<form method="POST" action="', '"');
  $Referer = $LINK;
  
  if (stristr($page,"capgen.php?"))
    {
    $imagecode = cut_str($page,'<input type="hidden" name="imagecode" value="','"');
    $capcode = cut_str($page,'capgen.php?','"');
    $megavar = cut_str($page, '<input type="hidden" name="megavar" value="', '">');
              
    $access_image_url = $Url["scheme"]."://".$Url["host"]."/capgen.php?".$capcode;
             
    print "<form name=\"dl\" action=\"$PHP_SELF\" method=\"post\">\n";
    print "<input type=\"hidden\" name=\"link\" value=\"".urlencode($Href)."\">\n<input type=\"hidden\" name=\"referer\" value=\"".urlencode($Referer)."\">\n<input type=\"hidden\" name=\"fileid\" value=\"$fid\">\n<input type=\"hidden\" name=\"imagecode\" value=\"$imagecode\">\n<input type=\"hidden\" name=\"megavar\" value=\"$megavar\">\n<input type=\"hidden\" name=\"step\" value=\"1\">\n";
    print "<input type=\"hidden\" name=\"comment\" id=\"comment\" value=\"".$_GET["comment"]."\">\n<input type=\"hidden\" name=\"email\" id=\"email\" value=\"".$_GET["email"]."\">\n<input type=\"hidden\" name=\"partSize\" id=\"partSize\" value=\"".$_GET["partSize"]."\">\n<input type=\"hidden\" name=\"method\" id=\"method\" value=\"".$_GET["method"]."\">\n";
    print "<input type=\"hidden\" name=\"proxy\" id=\"proxy\" value=\"".$_GET["proxy"]."\">\n<input type=\"hidden\" name=\"proxyuser\" id=\"proxyuser\" value=\"".$_GET["proxyuser"]."\">\n<input type=\"hidden\" name=\"proxypass\" id=\"proxypass\" value=\"".$_GET["proxypass"]."\">\n<input type=\"hidden\" name=\"path\" id=\"path\" value=\"".$_GET["path"]."\">\n";
    print "<h4>Enter <img src=\"$access_image_url\"> here: <input type=\"text\" name=\"imagestring\" size=\"3\">&nbsp;&nbsp;<input type=\"submit\" onclick=\"return check()\" value=\"Download File\"></h4>\n";
    print "<script language=\"JavaScript\">".$nn."function check() {".$nn."var imagecode=document.dl.imagestring.value;".$nn.'if (imagecode == "") { window.alert("You didn\'t enter the image verification code"); return false; }'.$nn.'else { return true; }'.$nn.'}'.$nn.'</script>'.$nn;
    print "</form>\n</body>\n</html>";
    }
  else
    {
    html_error("Image code not found", 0);
    }
	}
	}
?>