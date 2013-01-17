<?php if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
?>
<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<style type="text/css">
<!--
@import url("images/rl_style_pm.css");
-->
</style>

<title>RAPIDLEECH PLUGMOD</title>
</head>

<body>
<?php
require_once(CLASS_DIR."js.php");
?>
<center><img src="<?php print IMAGE_DIR; ?>logo_pm.gif" alt="RapidLeech PlugMod" border="0"></center><br>
<table align="center">
<tbody>
<tr>
<td valign="top">
<table width="100%"  border="0">
<tr>
<td valign="top">
<table height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="131" height="100%">
<img src="<?php print IMAGE_DIR; ?>currently_works_with_pm.gif" alt="supports" /></td>
</tr>
<tr>
<td>
<div align="center" style="background-color:#657B87; color:#eee; padding:1px; width:102px; margin:1px auto 2px 1px"><?php echo '<b><small>'.count($host).'</small></b> Plugins'; ?></div></td>
</tr>
<tr>
<td height="100%" style="padding:3px;">
<div dir="rtl" align="left" style="overflow-y:scroll; height:150px; padding-left:5px;">
<?php
ksort($host);
foreach ($host as $site => $file)
	{
	echo "<span style=color:ccc>".$site."</span><br>";
	}
?>
</div>
<br>
<a href="audl.php" target="_blank"><img src="<?php print IMAGE_DIR; ?>auto_dl_pm.gif" alt="AutoDownload" /></a>
</td>
</tr>
</table>
</td>
</tr>
</table></td>
<td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td id="navcell1" align="center"> <a href="javascript:switchCell(1)"><img src="<?php print IMAGE_DIR; ?>main_window_pm.gif" border="0"></a> </td>
<td id="navcell2" align="center"> <a href="javascript:switchCell(2)"><img src="<?php print IMAGE_DIR; ?>settings_pm.gif" border="0"></a> </td>
<td id="navcell3" align="center"> <a href="javascript:switchCell(3)"><img src="<?php print IMAGE_DIR; ?>server_files_pm.gif" border="0"></a> </td>
<td id="navcell4" align="center"> <a href="javascript:switchCell(4)"><img src="<?php print IMAGE_DIR; ?>link_checker_pm.gif" border="0"></a> </td>
</tr>
</tbody>
</table>
<table id="tb_content">
<tbody>
<tr>
<td align="center">
<table class="tab-content" id="tb1" name="tb" cellspacing="5" width="100%">
<tbody>
<tr>
<td align="center">
<form action="<?php echo $PHP_SELF; ?>" method="post">
<p align="left"><b>Link to download:</b><br />&nbsp;<input type="text" name="link" id="link" size="50">
<p align="left"><b>Referrer:</b><br />&nbsp;<input type="text" name="referer" id="referer" size="50">
</td>
<td align="center"><input type="submit" value="Download File"></td>
</tr>
<tr>
<td align="left"><input type="checkbox" name="add_comment" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('comment').style.display=displ;">&nbsp;Add Comments</td>
</tr>
<tr id="comment" style="DISPLAY: none;">
<td align="center">
<textarea name="comment" rows="4" cols="50"></textarea>
</td>
</tr>
<tr>
<td>
<br>
<small style="color:55bbff">PluginOptions:</small><hr>
<label><input type="checkbox" name="dis_plug">&nbsp;<small>Disable All Plugins</small></label>
</td>
</tr>
<tr>
<td>
<label><input type="checkbox" name="ytube_mp4">&nbsp;<small>Transfer YouTube Video in High Quality Mp4 (H264) Format</small></label>
</td>
</tr>
<tr>
<td><label><input type="checkbox" name="imageshack_tor" id="imageshack_tor" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('torpremiumblock').style.display=displ;"<?php if (is_array($imageshack_acc)) print ' checked'; ?>>&nbsp;<small>ImageShack&reg; TorrentService</small></label><table width="150" border="0" id="torpremiumblock" style="display: none;">
<tr><td>Username:&nbsp;</td><td><input type="text" name="tor_user" id="tor_user" size="15" value=""></td></tr>
<tr><td>Password:&nbsp;</td><td><input type="password" name="tor_pass" id="tor_pass" size="15" value=""></td></tr>
</table>
</td>
</tr>
<tr>
<td>
<label><input type="checkbox" name="mu_acc" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('mupremiumblock').style.display=displ;"<?php if ($mu_cookie_user_value) print ' checked'; ?>>&nbsp;<small>Megaupload.com Cookie Value</small></label>
<table width="150" border="0" id="mupremiumblock" style="display: none;">
<tr><td>user=</td><td><input type="text" name="mu_cookie" id="tor_user" size="25" value=""></td></tr>
</table>
</td>
</tr>
</tbody>
</table>
<table class="hide-table" id="tb2" name="tb" cellspacing="5" width="100%">
<tbody>
<tr>
<td align="center">
<table align="center">
<tr>
<td><input type="checkbox" name="domail" id="domail" onClick="javascript:document.getElementById('emailtd').style.display=document.getElementById('splittd').style.display=this.checked?'':'none';document.getElementById('methodtd').style.display=(document.getElementById('splitchkbox').checked&this.checked)?'':'none';"<?php echo $_COOKIE["domail"] ? " checked" : ""; ?>>&nbsp;Send File to Email</td>
<td>&nbsp;</td>
<td id="emailtd"<?php echo $_COOKIE["domail"] ? "" : " style=\"display: none;\""; ?>>Email:&nbsp;<input type="text" name="email" id="mail"<?php echo $_COOKIE["email"] ? " value=\"".$_COOKIE["email"]."\"" : ""; ?>></td>
</tr>
<tr>
<td></td>
</tr>
<tr id="splittd"<?php echo $_COOKIE["split"] ? "" : " style=\"display: none;\""; ?>>
<td>
<input id="splitchkbox" type="checkbox" name="split" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('methodtd').style.display=displ;"<?php echo $_COOKIE["split"] ? " checked" : ""; ?>>&nbsp;Split Files
</td>
<td>&nbsp;</td>
<td id="methodtd"<?php echo $_COOKIE["split"] ? "" : " style=\"display: none;\""; ?>>
<table>
<tr>
<td>Method:&nbsp;<select name="method"><option value="tc"<?php echo $_COOKIE["method"] == "tc" ? " selected" : ""; ?>>Total Commander</option><option value=rfc<?php echo $_COOKIE["method"] == "rfc" ? " selected" : ""; ?>>RFC 2046</option></select></td>
</tr>
<tr>
<td>Parts Size:&nbsp;<input type="text" name="partSize" size="2" value=<?php echo $_COOKIE["partSize"] ? $_COOKIE["partSize"] : 10; ?>>&nbsp;MB</td>
</tr>
</table>
</td>
</tr>
<tr>
<td><input type="checkbox" id="useproxy" name="useproxy" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('proxy').style.display=displ;"<?php echo $_COOKIE["useproxy"] ? " checked" : ""; ?>>&nbsp;Use Proxy Settings</td>
<td>&nbsp;</td>
<td id="proxy"<?php echo $_COOKIE["useproxy"] ? "" : " style=\"display: none;\""; ?>>
<table width="150" border="0">
<tr><td>Proxy:&nbsp;</td><td><input type="text" name="proxy" id="proxy" size="20"<?php echo $_COOKIE["proxy"] ? " value=\"".$_COOKIE["proxy"]."\"" : ""; ?>></td></tr>
<tr><td>Username:&nbsp;</td><td><input type="text" name="proxyuser" id="proxyuser" size="20" <?php echo $_COOKIE["proxyuser"] ? " value=\"".$_COOKIE["proxyuser"]."\"" : ""; ?>></td></tr>
<tr><td>Password:&nbsp;</td><td><input type="text" name="proxypass" id="proxypass" size="20" <?php echo $_COOKIE["proxypass"] ? " value=\"".$_COOKIE["proxypass"]."\"" : ""; ?>></td></tr>
</table>
</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td><input type="checkbox" name="premium_acc" id="premium_acc" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('premiumblock').style.display=displ;"<?php if (is_array($premium_acc)) print ' checked'; ?>>&nbsp;Use Premium Account</td>
<td>&nbsp;</td>
<td id="premiumblock" style="display: none;">
<table width="150" border="0">
<tr><td>Username:&nbsp;</td><td><input type="text" name="premium_user" id="premium_user" size="15" value=""></td></tr>
<tr><td>Password:&nbsp;</td><td><input type="password" name="premium_pass" id="premium_pass" size="15" value=""></td></tr>
</table>
</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td><input type="checkbox" name="saveto" id="saveto" onClick="javascript:var displ=this.checked?'':'none';document.getElementById('path').style.display=displ;"<?php echo $_COOKIE["saveto"] ? " checked" : ""; ?>>&nbsp;Save To</td>
<td>&nbsp;</td>
<td id="path"<?php echo $_COOKIE["saveto"] ? "" : " style=\"display: none;\""; ?>>Path:&nbsp;<input type="text" name="path" size="40" value="<?php echo ($_COOKIE["path"] ? $_COOKIE["path"] : (substr($download_dir, 0, 6) != "ftp://" ? realpath(DOWNLOAD_DIR) : $download_dir)); ?>"></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td><input type="checkbox" name="savesettings" id="savesettings"<?php echo $_COOKIE["savesettings"] ? " checked" : ""; ?> onClick="javascript:var displ=this.checked?'':'none';document.getElementById('clearsettings').style.display=displ;">&nbsp;Save Settings</td>
<td>&nbsp;</td>
<td id="clearsettings"<?php echo $_COOKIE["savesettings"] ? "" : " style=\"display: none;\""; ?>><a href="javascript:clearSettings();">Clear Current Settings</a></td>
</tr>
</table>
</form>
</td>
</tr>
</tbody>
</table>
<table class="hide-table" id="tb3" name="tb" cellspacing="5" width="100%">
<tbody><td align="center" width="100%">
<?php
_create_list();
require_once(CLASS_DIR."options.php");
if($list)
  {
  if ($show_all === true)
    { 
    unset($Path);
    }
  ?>
<form name="flist" method="post">
<a href="javascript:setCheckboxes(1);" style="color: #99C9E6;">Check All</a> |
<a href="javascript:setCheckboxes(0);" style="color: #99C9E6;">Un-Check All</a> |
<a href="javascript:setCheckboxes(2);" style="color: #99C9E6;">Invert Selection</a>
<?php if ($show_all === true)
  {
  ?>
| <a href="javascript:showAll();">Show
<script language="JavaScript">
if(getCookie("showAll") == 1)
  {
  document.write("Downloaded");
  }
else
  {
  document.write("Everything");
  }
</script></a>
<?php
  }
  ?>
<br><br>
<table cellpadding="3" cellspacing="1" width="100%" class="filelist">
<tbody>
<tr bgcolor="#4B433B" valign="bottom" align="center" style="color: white;">
<td>

</td>
<td>
<select name="act" onChange="javascript:void(document.flist.submit());" style="float:left;<?php if($disable_action) echo 'display:none'; ?>">
<option selected>Action</option>
<option value="upload">Upload</option>
<option value="ftp">FTP File</option>
<option value="mail">E-Mail</option>
<option value="boxes">Mass Submits</option>
<option value="split">Split Files</option>
<option value="merge">Merge Files</option>
<option value="md5">MD5 Hash</option>
<?php if (@file_exists(CLASS_DIR."pear.php") || @file_exists(CLASS_DIR."tar.php")) print "<option value=\"pack\">Pack Files</option>".$nn; ?>
<?php if (@file_exists(CLASS_DIR."pclzip.php")) print "<option value=\"zip\">ZIP Files</option>".$nn; ?>
<?php if (@file_exists(CLASS_DIR."unzip.php")) print "<option value=\"unzip\">Unzip Files (beta)</option>".$nn; ?>
<?php if(!$disable_deleting) echo "<option value=\"rename\">Rename</option>".$nn;; ?>
<?php if(!$disable_deleting) echo "<option value=\"mrename\">Mass Rename</option>".$nn;; ?>
<?php if(!$disable_deleting) echo "<option value=\"delete\">Delete</option>".$nn;; ?>
</select><b>Name</b></td>
<td><b>Size</b></td>
<td><b>Download Link</b></td>
<td><b>Comments</b></td>
<td><b>Date</b></td>
</tr>
<?php
  }
else
  {
  print "<center>No files found</center>";
  if ($show_all === true)
    {
    unset($Path);
    ?>
<form name="flist" method="post">
<a href="javascript:showAll();">Show
<script language="JavaScript">
if(getCookie("showAll") == 1)
  {
  document.write("Downloaded");
  }
else
  {
  document.write("Everything");
  }
</script></a><br><br>
<?php
    }
  }
if($list)
  {
  $total_files = 0;
  foreach($list as $key => $file)
    {
    if(file_exists($file["name"]))
       {
       $total_files++;
       $total_size+=filesize($file["name"]);
       $inCurrDir = strstr(dirname($file["name"]), ROOT_DIR) ? TRUE : FALSE;
       if($inCurrDir)
         {
         $Path = parse_url($PHP_SELF);
         $Path = substr($Path["path"], 0, strlen($Path["path"]) - strlen(strrchr($Path["path"], "/")));
         }
         ?>
<tr onMouseOver="this.bgColor='#F5A249';" onMouseOut="this.bgColor='#D49659';" align="center" bgcolor="#D49659" style="color: black;" title="<?php echo $file["name"]; ?>">
<td bgcolor="#D49659"><input type=checkbox name="files[]" value="<?php echo $file["date"]; ?>"></td>
<td><?php echo $inCurrDir ? "<b><a href=\"".$Path.substr(dirname($file["name"]), strlen(ROOT_DIR))."/".basename($file["name"]) : ""; echo $inCurrDir ? "\" style=\"color: #000;\">".basename($file["name"])."</a></b>" : basename($file["name"]); ?></td>
<td bgcolor="#DC9F5F"><?php echo $file["size"]; ?></td>
<td bgcolor="#CF965D"><?php echo $file["link"] ? "<a href=\"".$file["link"]."\" style=\"color: #000;\">".$file["link"]."</a>" : "" ; ?></td>
<td bgcolor="#C29569"><?php echo $file["comment"] ? str_replace("\\r\\n", "<br>", $file["comment"]) : ""; ?></td>
<td bgcolor="#C29569"><?php echo date("d.m.Y H:i:s", $file["date"]) ?></td>
</tr>
<?php
       }
    }
  if (($total_files > 1) && ($total_size > 0))
    {
    print "<tr bgcolor=\"#4B433B\"  style=\"color: white;\" align=\"center\">$nn<td></td>$nn<td>Total:</td>$nn<td>".bytesToKbOrMbOrGb($total_size)."</td>$nn<td></td>$nn<td></td>$nn<td></td>$nn</tr>";
    }
  unset($total_files,$total_size);
  }
if($list)
  {
  ?>
</tbody>
</table>
</form>
<?php
  }
  ?>
</td>
</tr>
</table>
<!--Start Lix Checker-->
<table class="hide-table" id="tb4" name="tb" cellspacing="5" width="100%">
<tbody><?php
if($_GET["act"])
  {
	echo "<script language=\"JavaScript\">switchCell(3);</script>";
  }
elseif($_GET["debug"] || $_POST["links"])
  {
	echo "<script language=\"JavaScript\">switchCell(4);</script>";
  }
else
  {
	echo "<script language=\"JavaScript\">switchCell(1);</script>";
  }
?>
<tr><td align="center" width="100%">
	<?php
	//Copyright Dman :p this has been coded by dman biatches!!!
	//Optimized by zpikdum :D
	//Moded by eqbal ;)
	//Lets calulate the time required.
	$time = explode(' ', microtime());
	$time = $time[1] + $time[0];
	$begintime = $time;
    //User Enabled settings 
    $debug = 1; // change it to one to enable it.
	//Override PHP's stardard time limit
	set_time_limit(120);
	$maxlinks = 300;
	$lcver = 301;
	//Lets use this as a function to visit the site.	
function curl($link, $post='0')
{
    if($fgc == 1)
	{
        file_get_contents($link);
	}
    else 
	{

		$ch = curl_init($link);
		curl_setopt($ch, CURLOPT_HEADER, 0);
	    if(eregi("megashares\.com" , $link))
		{
            curl_setopt($ch, CURLOPT_COOKIE, 1);
		    curl_setopt($ch, CURLOPT_COOKIEJAR, "1");
		    curl_setopt($ch, CURLOPT_COOKIEFILE, "1");
		}
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if($post != '0') 
		{

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		$page = curl_exec($ch);
		curl_close($ch);
		return($page);		
	}

}
	
	
function check($link, $x, $regex, $pattern='', $replace='') 
{
    if(!empty($pattern)) 
    {


	    $link = preg_replace($pattern, $replace, $link);
    }
	$page = curl($link);
	$link = htmlentities($link, ENT_QUOTES);
	flush();
	ob_flush();
	
	if($_POST['d'] && eregi($regex, $page)) 
	{

		echo "<div class=\"g\"><a href=\"$link\"><b>$link</b></a></div>\n";  
	} 
	elseif($_POST['d'] && eregi("The file you are trying to access is temporarily unavailable.", $page)) 
	{

		echo "<div class=\"y\"><a href=\"$link\"><b>$link</b></a></div>\n";
	}
	elseif($_POST['d'] && !eregi($regex, $page)) 
	{

		echo "<div class=\"r\"><a href=\"$link\"><b>$link</b></a></div>\n";			
	}
	elseif(!$_POST['d'] && eregi($regex, $page)) 
	{

		echo "<div class=\"g\">$x: Active: <a href=\"$link\"><b>$link</b></a></div>\n";  
	} 
	elseif(!$_POST['d'] && eregi("The file you are trying to access is temporarily unavailable.", $page)) 
	{

		echo "<div class=\"y\">$x: Unavailable: <a href=\"$link\"><b>$link</b></a></div>\n";
	}
	else 
	{

		echo "<div class=\"r\">$x: Dead: <a href=\"$link\"><b>$link</b></a></div>\n";			
	}
}
	
	function debug() {
	echo '<div style="text-align:left; margin:0 auto; width:450px;">';
	if ( !extension_loaded("curl") )
	echo "You need to load/activate the cURL extension (http://www.php.net/cURL) or you can set $fgc = 1 in config.php.<br/>";
        else
        echo "<b>cURL is enabled</b><br/>";
	if( PHP_VERSION < 5 ){ 
	echo "PHP version 5 is recommended although it is not obligatory<br/>";
	}
	//echo "This will display all of your PHP info on your server<br/>";
	echo "Check if your safe mode is turned off as the script cannot work with safe mode on<br/>";
	echo "</div>";
	//phpinfo();
	}
	?>
	<div style="text-align:center">
	<div align="center"><b>Works With</b></div>
	<div style="text-align:center; padding:3px; color:#dedede; margin:0 auto; width:450px; font-size:9px; height:50px;overflow:auto; border:1px solid #666">Axifile.com | Badongo.com | <b>Depositfiles.com</b> | <strong>Megarotic.com</strong>
	Easy-Share.com | Egoshare.com | <b>Filefactory.com</b> | <strong>Adrive.com</strong>
	Files.to | Gigasize.com | <b>Mediafire.com</b> | iFolder.ru | BitRoad.net
	<b>Megashares.com</b> | <b>Megaupload.com</b> | Mihd.net | UploadPalace.com
	Momupload.com | <b>Rapidshare.com</b> | Rapidshare.de | Shareonall.com
	Rndbload.com |  Savefile.com | <b>Sendspace.com</b> | Ziddu.com | <strong>MegaShare.com</strong>
	Speedyshare.com | Turboupload.com | Uploaded.to | Cocoshare.com 
	Uploading.com | Usaupload.net | Zshare.net | <strong>FileFront.com </strong>
	<br><b>Kills</b><br>
	Anonym.to | Linkbucks.com | Lix.in<br />
	Rapidshare.com Folders | Usercash.com</div><br>
	<div align="center">
	<form action="<?php echo $PHP_SELF ?>" method="post">
	<textarea rows="10" cols="87" name="links"></textarea><br /><br>
	Display Links Only: <input type="checkbox" value="d" name="d" />
	Kill Links Only: <input type ="checkbox" value ="1" name="k" /><br /><br>
	<input type="submit" value="Check Links" name="submit" />
	</form>
	</div>
	<!-- <p style="text-align:center; font-size:8px"><small>Lix Checker v3.0.0 | Copyright Dman - MaxW.org | Optimized by zpikdum and sarkar<br /><b>Mod by eqbal</b></p> -->
	<div style="text-align:left; margin:0 auto; width:450px;">
	<a href="<?php echo $PHP_SELF.'?debug=1' ?>" style="color:#3B5A6F"><b>Debug Mode</b></a>
	</div>
	</small>
	<div align="center">
	  <?php
	if(isset($_REQUEST['debug'])) {
		if($debug == 1) 
			debug();
        else
		echo "Please change the debug mode to <b>1</b>";
		if ($_POST['k'] == 1) {
			$kl = 1;
			$l = 0; 
		}
}
	if (isset($_REQUEST['submit'])) {
	$alllinks = @$_POST['links'];
	$alllinks = explode(" ", $alllinks);
	$alllinks = implode("\n", $alllinks);
	$alllinks = explode("\n", $alllinks);
	$l = 1;
	$x = 1;

	$alllinks = array_unique($alllinks); //removes duplicates
	foreach($alllinks as $link) {
	   $link = trim($link); 
		if(eregi("^(http)\:\/\/(www\.)?anonym\.to\/\?", $link)){
			$link = explode("?", $link);
			unset($link[0]);
			$link = implode($link, "?");
			  if($kl == 1)
			  echo"<div class=\"n\"><a href=\"$link\"><b>$link</b></a></div>\n";
		}
		
	   if(eregi("^(http)\:\/\/(www\.)?lix\.in\/", $link)){
		  $post = 'tiny='.trim(substr(strstr($link, 'n/'), 2)).'&submit=continue';
		  preg_match('@name="ifram" src="(.+?)"@i', curl($link, $post), $match);
		  $link = $match[1];
			if($kl == 1)
			echo"<div class=\"n\"><a href=\"$link\"><b>$link</b></a></div>\n";
	   }
		
		if(eregi("^(http)\:\/\/(www\.)?linkbucks\.com\/link\/" , $link)) {
		   $page = curl($link);
		   preg_match("/<a href=\"(.+)\" id=\"aSkipLink\">/" , $page , $match);
		   $link = $match[1];
			 if($kl == 1)
			 echo"<div class=\"n\"><a href=\"$link\"><b>$link</b></a></div>\n";
		}
	
		 if(eregi("usercash\.com" , $link)) {
			$page = curl($link);
			preg_match("/<TITLE>(.+)<\/TITLE>/" , $page , $match);
			$link = $match[1];
			  if($kl == 1)
			  echo"<div class=\"n\"><a href=\"$link\"><b>$link</b></a></div>\n";
		 }  
		 
		   if(eregi("rapidshare\.com\/users\/" , $link)) {
		  $page = curl($link);
		  preg_match_all("/<a href=\"(.+)\" target=\"_blank\">/" , $page , $match);
		  unset($match[1][0]);
			foreach($match[1] as $link)
			 {
				if($l == 1)
			   {
				  check(trim($link), $x, "You would like to download the following file::" );
				  $x++;
			   }
			if($kl == 1)
			 echo"<div class=\"n\"><a href=\"$link\"><b>$link</b></a></div>\n";
			   }
	   }
	
	if($l == 1) {
		$sites = 
		array(
			array("rapidshare\.com\/files\/", "(FILE DOWNLOAD|This file is larger than 200 Megabyte)"),
			array("megashares\.com\/\?d01=", "Click here to download"),
			array("megaupload\.com/([a-z]{2}\/)?\?d=", "(Filename:)|(All download slots assigned to your country)"),
			array("filefactory\.com\/file\/", "(download link)|(Please try again later)"),
			array("rapidshare\.de\/files\/", "You want to download"),
			array("mediafire\.com\/(download\.php)?\?", "You requested"),
			array("netload\.in\/datei[0-9a-z]{32}\/", "download_load"),	
			array("depositfiles\.com\/([a-z]{2}\/)?files\/", "File Name", "@(com\/files\/)|(com\/[a-z]{2}\/files\/)@i", "com/en/files/"),
			array("sendspace\.com\/file\/", "The download link is located below."),
			array("ifile\.it\/", "Request Ticket"),
			array("usaupload\.net\/d\/", "This is the download page for file"),
			array("badongo\.com\/([a-z]{2}\/)?(file)|(vid)\/", "fileBoxMenu"),
			array("uploading\.com\/files\/", "Download file"),
			array("savefile\.com\/files\/", "link to this file"),
			array("cocoshare\.cc\/[0-9]+\/", "Filesize:"),
			array("axifile\.com\/?", "You have request", "@com\?@i", "com/?"),
			array("(d\.turboupload\.com\/)|(turboupload.com\/download\/)", "(Please wait while we prepare your file.)|(You have requested the file)"),
			array("files\.to\/get\/", "You requested the following file"),
			array("gigasize\.com\/get\.php\?d=", "Downloaded"),
			array("ziddu\.com\/", "Download Link"),
			array("zshare\.net\/(download|audio|video)\/", "Last Download"),
			array("uploaded\.to\/(\?id=|file\/)", "Filename:"),
			array("filefront\.com\/", "http://static4.filefront.com/ffv6/graphics/b_download_still.gif"),
			array("uploadpalace\.com\/[a-zA-Z]{2}\/file\/[0-9]+\/", "Filename:"),
			array("speedyshare\.com\/[0-9]+\.html", "\/data\/"),
			array("momupload\.com\/files\/", "You want to download the file"),
			array("rnbload\.com\/file/" , "Filename:"),
			array("ifolder\.ru\/[0-9]+", "ints_code"),
			array("adrive\.com\/public\/", "view"),
			array("easy-share\.com" , "file url:"),
			array("bitroad\.net\/download\/[0-9a-z]+\/", "File:"),
			array("megarotic\.com/([a-z]{2}\/)?\?d=", "(Filename:)|(All download slots assigned to your country)"),  
			array("egoshare\.com" , "You have requested"),
			array("flyupload\.flyupload.com\/get\?fid" , "Download Now"),

			array("megashare\.com\/[0-9]+", "Free")	
		);
		
		foreach($sites as $site) {
			if(eregi($site[0], $link)) {
				check(trim($link), $x, $site[1], $site[2], $site[3]);
				$x++;
			}
		}
		
		if($x > $maxlinks) {
			echo "<p style=\"text-align:center\">Maximum No ($maxlinks) Of links have been reached.</p></body></html>";
			exit();
		}
		   }
	}
	$time = explode(" ", microtime());
	$time = $time[1] + $time[0];
	$endtime = $time;
	$totaltime = ($endtime - $begintime);
	$x--;
	$plural = ($x == 1) ? "" : "s";
	($fgc == 0) ? $method = 'cURL' : $method = 'file_get_contents';
	echo "<p style=\"text-align:center\">$x Link$plural checked in $totaltime seconds. (Method: <b>$method</b>)</p>";
	}
	?>
	</div></div>
</td>
</tr>
</tbody>
</table>
<!--End lix checker-->

</td>
<td valign="top">&nbsp;</td>
</tr>
</table>
</td>
<td valign="top">
<!--Stat r-sidebar , Put your content in this block-->

<!-- End r-sidebar -->
</td>
</tr>
</table>
<br>
<table width="60%" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div align="center"></div>
<script language="JavaScript">
var show = 0;
var show2 = 0;
</script>
<div align="center"></div>
<div align="center" style="color:#ccc">
<?php if($server_info) require_once(CLASS_DIR."sinfo.php"); ?>
<hr>
<?php print CREDITS; ?><br>
</div>
</td>
</tr>
</table>
</body>
</html>