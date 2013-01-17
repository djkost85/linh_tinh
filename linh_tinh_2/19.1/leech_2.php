<?
/*
*	Coded by H.Thuong.
*	leech.php
*	Đang cần tìm người phát triển site anime.
*	Cần tuyển trans edit.
*	Ai có như cầu giúp đỡ mình vui lòng liên hệ Yahoo: boysockkhockvigirl
*/
set_time_limit(0);
ignore_user_abort(true);
error_reporting(E_ALL && ~E_NOTICE);
if (!function_exists('fopen'))
{
	echo 'Function fopen() has been disable.';
	exit;
}
if (!function_exists('feof'))
{
	echo 'Function feof() has been disable.';
	exit;
}
if (!function_exists('fread'))
{
	echo 'Function fread() has been disable.';
	exit;
}
if (!function_exists('fwrite'))
{
	echo 'Function fwrite() has been disable.';
	exit;
}
if (!function_exists('fclose'))
{
	echo 'Function fclose() has been disable.';
	exit;
}
function leech_file($remote_file , $local_file , $kb = 5)
{
	$return = false;
	$f = @fopen( $remote_file, "r");
	$file = @fopen( $local_file, "w");
	if (($f) && ($file))
	{
		while(!feof($f))
		{
			fwrite($file, fread($f, 1024*$kb));
		}
		fclose($file);
		fclose($f);
		$return = true;
		return $return;
	}
	else
	{
		return $return;
	}
}
function get_size ($size)
{
	if ($size <= 1024) // B 
	{
		return $size." B";
	}
	elseif ($size > 1024 && $size <= 1024 * 1024) // KB
	{
		return round($size / 1024, 2). " KB";
	}
	elseif ($size > 1024 * 1024 && $size <= 1024 * 1024 * 1024) // MB
	{
		return round($size / (1024 * 1024) , 2). " MB";
	}
	elseif ($size > 1024 * 1024 * 1024 && $size <= 1024 * 1024 * 1024 * 1024) // GB
	{
		return round($size / (1024 * 1024 * 1024) , 2). " GB";
	}
}
function file_list($dir = "./")
{
	$file_arr = scandir($dir);
	$return = '<table class="ui-widget ui-widget-content ui-corner-all ui-theme">'."\n";
	$return .= '	<thead class="ui-widget-header">'."\n";
	$return .= '		<tr>'."\n";
	$return .= '			<th class="ui-widget-header ui-corner-all ui-state-default">'."\n";
	$return .= '				File name'."\n";
	$return .= '			</th>'."\n";
	$return .= '			<th class="ui-widget-header ui-corner-all ui-state-default">'."\n";
	$return .= '				File size'."\n";
	$return .= '			</th>'."\n";
	$return .= '			<th class="ui-widget-header ui-corner-all ui-state-default">'."\n";
	$return .= '				Create time'."\n";
	$return .= '			</th>'."\n";
	$return .= '			<th class="ui-widget-header ui-corner-all ui-state-default">'."\n";
	$return .= '				Last modified'."\n";
	$return .= '			</th>'."\n";
	$return .= '		</tr>'."\n";
	$return .= '	</thead>'."\n";
	$return .= '	<tbody class="ui-widget-content">'."\n";
	$i = 0;
	foreach ($file_arr as $file)
	{
		if ($file != '.' && $file != '..')
		{
			$filename = '<a href="/'.$file.'">'.$file.'</a> <br />';
			$filesize = get_size(filesize($file));
			$filecreate = date("H:i d/m/Y" , filectime($file));
			$filemod = date("H:i d/m/Y" , filemtime($file));
			if ($i%2 != 0)
			{
				$class = "ui-state-default odd";
			}
			else
			{
				$class = "ui-widget-content even";
			}
			$return .= '		<tr class="'.$class.'">'."\n";
			$return .= '			<td>'."\n";
			$return .= '				'.$filename."\n";
			$return .= '			</td>'."\n";
			$return .= '			<td>'."\n";
			$return .= '				'.$filesize."\n";
			$return .= '			</td>'."\n";
			$return .= '			<td>'."\n";
			$return .= '				'.$filecreate."\n";
			$return .= '			</td>'."\n";
			$return .= '			<td>'."\n";
			$return .= '				'.$filemod."\n";
			$return .= '			</td>'."\n";
			$return .= '		</tr>'."\n";
			$i++;
		}
	}
	$return .= '	</tbody>'."\n";
	$return .= '</table>'."\n";
	return $return;
}
if (isset($_GET['getlist']))
{
	echo file_list();
	exit;
}
if (isset($_POST['download']))
{
	$url_arr = explode("\n", $_POST['url']);
	foreach ($url_arr as $url)
	{
		if ($url != "")
		{
			$ex = explode("|", $url);
			if ($ex[1] == '')
			{
				if(!leech_file($ex[0] , urldecode(basename($ex[0]))))
				{
					echo "Không thể ghi file ".urldecode(basename($ex[0]))." hoặc mở file {$ex[0]} trên url";
					exit;
				}
			}
			else
			{
				if(!leech_file($ex[0] , $ex[1]))
				{
					echo "Không thể ghi file {$ex[1]} hoặc mở file {$ex[0]} trên url";
					exit;
				}
			}
		}
	}
	echo 'OK';
	exit;
}
?>
<html>
<head>
<title>Leech file by H.Thuong</title>
<style type="text/css">
table
{
	width:70%;
	margin:auto;
}
table tbody tr td
{
	font-size:12px;
	padding:1.5 0 1.5 0px;
}
table tbody tr td a
{
	text-decoration:none;
}
</style>
<link type="text/css" rel="stylesheet" href="http://taitems.github.com/Aristo-jQuery-UI-Theme/css/Aristo/Aristo.css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function showlist()
{
	if ($('#file_list').text() == 'Show file list')
	{
		$.get("<? echo $_SERVER['PHP_SELF'];?>", { getlist: true,},
		   function(data) {
				$('#listfile').html(data);
				$('#listfile').fadeIn();
				$('#file_list').text("Hide file list");
		   });
	}
	else
	{
		$('#listfile').fadeOut();
		$('#file_list').text("Show file list");
	}
}
function download()
{
	if ($('#url').val() == 'Nhập url bạn muốn leech. Phân cách nhiều url bằng cách xuống dòng.' || $('#url').val() == '')
	{
		alert("Vui lòng nhập URL");
	}
	else
	{
		$('#status').html('<img src="https://lh5.googleusercontent.com/-q7Icrku_wF8/T7e1er2HhNI/AAAAAAAAAP8/2taIurxCnLY/s0/1-1.gif"> Downloading ...');
		$.post("<? echo $_SERVER['PHP_SELF'];?>", { download: true, url:$('#url').val()},
			function(data) {
				if (data == 'OK')
				{
					alert("Đã tải thành công. \\m/");
					$('#status').html('');
				}
				else
				{
					alert(data);
					$('#status').html('');
				}
			});
	}
}
</script>
</head>
<body class="ui-form" style="text-align: center;">
<div style="padding-bottom:50px;"></div>
<textarea id="url" style="width: 688px; height: 170px; margin:auto;" onClick="if(this.value=='Nhập url bạn muốn leech. Phân cách nhiều url bằng cách xuống dòng.')this.value='';" onBlur="if(this.value=='')this.value='Nhập url bạn muốn leech. Phân cách nhiều url bằng cách xuống dòng.';">Nhập url bạn muốn leech. Phân cách nhiều url bằng cách xuống dòng.</textarea>
<br />
<br />
<a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="javascript:void();" onclick="showlist();"><span class="ui-button-text" id="file_list">Show file list</span></a>
<a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="javascript:void();" onclick="download();"><span class="ui-button-text" id="download">Download now</span></a>
<div id="status" style="padding-top:5px;">
</div>
<br />
<br />
<div id="listfile" style="display:none;">
</div>
</body>
</html>