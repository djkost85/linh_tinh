<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }

if($_COOKIE["clearsettings"])
   {
		setcookie("domail", "", time() - 3600);
		setcookie("email", "", time() - 3600);
		setcookie("saveto", "", time() - 3600);
		setcookie("path", "", time() - 3600);
		setcookie("useproxy", "", time() - 3600);
		setcookie("proxy", "", time() - 3600);
		setcookie("proxyuser", "", time() - 3600);
		setcookie("proxypass", "", time() - 3600);
		setcookie("split", "", time() - 3600);
		setcookie("partSize", "", time() - 3600);
		setcookie("savesettings", "", time() - 3600);
		setcookie("clearsettings", "", time() - 3600);
	}


if($_GET["savesettings"] == "on")
	{
		setcookie("savesettings", TRUE,time()+800600);
		if($_GET["domail"] == "on")
			{
				setcookie("domail", TRUE,time()+800600);
				if(checkmail($_GET["email"]))
					{
						setcookie("email", $_GET["email"],time()+800600);
					}
						else
					{
						setcookie("email", "", time() - 3600);
					}
					
				if($_GET["split"] == "on")
					{
						setcookie("split", TRUE,time()+800600);
						if(is_numeric($_GET["partSize"]))
							{
								setcookie("partSize", $_GET["partSize"],time()+800600);
							}
								else
							{
								setcookie("partSize", "", time() - 3600);
							}
						if(in_array($_GET["method"], array("tc", "rfc")))
							{
								setcookie("method", $_GET["method"],time()+800600);
							}
								else
							{
								setcookie("method", "", time() - 3600);
							}
					}
						else
					{
						setcookie("split", "", time() - 3600);
					}
			}
				else
			{
				setcookie("domail", "", time() - 3600);
			}
			
		if($_GET["saveto"] == "on")
			{
				setcookie("saveto", TRUE,time()+800600);
				if(isset($_GET["path"]))
					{
						setcookie("path", $_GET["path"],time()+800600);
					}
						else
					{
						setcookie("path", "", time() - 3600);
					}
			}
				else
			{
				setcookie("saveto", "", time() - 3600);
			}
			
		if($_GET["useproxy"] == "on")
			{
				setcookie("useproxy", TRUE,time()+800600);
				if(strlen(strstr($_GET["proxy"], ":")) > 0)
					{
						setcookie("proxy", $_GET["proxy"],time()+800600);
					}
						else
					{
						setcookie("proxy", "", time() - 3600);
					}

				if($_GET["proxyuser"])
					{
						setcookie("proxyuser", $_GET["proxyuser"],time()+800600);
					}
						else
					{
						setcookie("proxyuser", "", time() - 3600);
					}

				if($_GET["proxypass"])
					{
						setcookie("proxypass", $_GET["proxypass"],time()+800600);
					}
						else
					{
						setcookie("proxypass", "", time() - 3600);
					}
			}
				else
			{
				setcookie("useproxy", "", time() - 3600);
			}
	}
?>