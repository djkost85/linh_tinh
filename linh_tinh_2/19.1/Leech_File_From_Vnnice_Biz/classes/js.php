<?php
if (!defined('RAPIDLEECH'))
  {
  require_once("index.html");
  exit;
  }
?>

<script language="JavaScript">
function switchCell(m)
  {
  var style;
  document.getElementById("navcell1").className = "tab-off";
  document.getElementById("navcell2").className = "tab-off";
  document.getElementById("navcell3").className = "tab-off";
  document.getElementById("navcell4").className = "tab-offr";

  document.getElementById("tb1").className = "hide-table";
  document.getElementById("tb2").className = "hide-table";
  document.getElementById("tb3").className = "hide-table";
  document.getElementById("tb4").className = "hide-table";
  if(m == 4)
    {
    style = "tab-onr";
    }
  else
    {
    style = "tab-on";
    }
  document.getElementById("navcell" + m).className = style;
  document.getElementById("tb" + m).className = "tab-content show-table";
  }

function getCookie(name)
  {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1)
    {
    begin = dc.indexOf(prefix);
    if (begin != 0)
      {
      return null;
      }
    }
  else
    {
    begin += 2;
    }
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    {
    end = dc.length;
    }
  return unescape(dc.substring(begin + prefix.length, end));
}

function deleteCookie(name, path, domain)
  {
  if (getCookie(name))
    {
    document.cookie = name + "=" +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
  }

function clearSettings()
  {
  clear("domail"); clear("email"); clear("split"); clear("method");
  clear("partSize"); clear("useproxy"); clear("proxy"); clear("saveto");
  clear("path"); clear("savesettings");

  document.getElementById('domail').checked = false;
  document.getElementById('splitchkbox').checked = false;
  document.getElementById('useproxy').checked = false;
  document.getElementById('premium_acc').checked = false;
  document.getElementById('saveto').checked = false;
  document.getElementById('savesettings').checked = false;

  document.getElementById('email').value= "";
  document.getElementById('proxy').value= "";
  document.getElementById('proxyuser').value= "";
  document.getElementById('proxypass').value= "";
  document.getElementById('premium_user').value= "";
  document.getElementById('premium_pass').value= "";
                            
  document.getElementById('emailtd').style.display = "none";
  document.getElementById('splittd').style.display = "none";
  document.getElementById('methodtd').style.display = "none";
  document.getElementById('proxy').style.display = "none";
  document.getElementById('premiumblock').style.display = "none";
  document.getElementById('path').style.display = "none";
  document.getElementById('clearsettings').style.display = "none";
  
  document.cookie = "clearsettings = 1;";
  }

function clear(name)
  {
  document.cookie = name + " = " + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }

function setCheckboxes(act)
  {
  elts =  document.forms["flist"].elements["files[]"];
  var elts_cnt  = (typeof(elts.length) != 'undefined') ? elts.length : 0;
  if (elts_cnt)
    {
    for (var i = 0; i < elts_cnt; i++)
      {
      elts[i].checked = (act == 1 || act == 0) ? act : elts[i].checked ? 0 : 1;
      }
    }
  }

function showAll()
  {
  if(getCookie("showAll") == 1)
    {
    deleteCookie("showAll");
    location.href = "<?php echo $PHP_SELF."?act=files"; ?>";
    }
  else
    {
    document.cookie = "showAll = 1;";
    location.href = "<?php echo $PHP_SELF."?act=files"; ?>";
    }
  }

function showAdd()
  {
  document.getElementById('add').style.display = show ? 'none' : '';
  show = show ? 0 : 1;
  }

function showAdd2()
  {
  document.getElementById('add2').style.display = show2 ? 'none' : '';
  show2 = show2 ? 0 : 1;
  }

function mail(str, field)
  {
  document.getElementById("mailPart." + field).innerHTML = str;
  return true;
  }

function setFtpParams()
  {
  setParam("host"); setParam("port"); setParam("login");
  setParam("password"); setParam("dir");
  document.cookie = "ftpParams=1";
  document.getElementById("hrefSetFtpParams").style.color = "#808080";
  document.getElementById("hrefDelFtpParams").style.color = "#0000FF";
  }

function delFtpParams()
  {
  deleteCookie("host"); deleteCookie("port"); deleteCookie("login");
  deleteCookie("password"); deleteCookie("dir"); deleteCookie("ftpParams");
  document.getElementById("hrefSetFtpParams").style.color = "#0000FF";
  document.getElementById("hrefDelFtpParams").style.color = "#808080";
  }

function setParam(param)
  {
  document.cookie = param + "=" + document.getElementById(param).value;
  }

function pr(percent, received, speed)
  {
	document.getElementById("received").innerHTML = '<b>' + received + '</b>';
	document.getElementById("percent").innerHTML = '<b>' + percent + '%</b>';
	document.getElementById("progress").style.width = percent + '%';
	document.getElementById("speed").innerHTML = '<b>' + speed + ' KB/s</b>';
	document.title = 'Uploaded ' + percent + '%';
	return true;
	}

function changeStatus(file, size)
  {
	document.getElementById("status").innerHTML = 'Uploading File <b>' + file + '</b>, Size <b>' + size + '</b>...<br>';
	}

function zip()
  {
	var i = document.ziplist.act.selectedIndex;
	var selected = document.ziplist.act.options[i].value;
	document.getElementById('add').style.display = 'none';
	switch (selected)
		{
		case "zip_add":
			document.getElementById('add').style.display = 'block';
		break;
		//case "zip_extract":
			
		//break;
		//case "zip_list":
			//void(document.ziplist.submit());
		//break;
		}
	}
</script>