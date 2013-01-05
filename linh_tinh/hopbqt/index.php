<? session_start();
define('ADMINKUTE_ROOT', true);
include("inc/config.php");
ini_set('session.cookie_lifetime',900);//15 minute  
if(!$_SESSION["user"]){$fix['disable'] = 'disabled="disabled"';}

//session_destroy();
	if(isset($_GET["login"])){include("inc/login.php");}
	elseif(isset($_GET["admin"])){include("inc/admin.php");}
	elseif(isset($_GET["register"])){include("inc/register.php");}
	elseif(isset($_GET["adminkute_smilies"])){include("inc/smilies.php");}
	elseif(isset($_GET["logout"])){session_destroy();echo "<meta http-equiv='refresh' content='0;url=?home'>";}
	elseif(isset($_GET["adminkute_content"]))
	{
		
		if($_POST["name"] && $_POST["text"] && $_SESSION["user"] && $_SESSION["login"])
		{
				$name = substr($_POST["name"],0,15);
				$text = str_replace('\"','"',substr($_POST["text"],0,255));
				$text = str_replace('\\\\','\\',$text);
				$style['b'] = $_POST["upbold"];
				$style['u'] = $_POST["upunderline"];
				$style['i'] = $_POST["upitalic"];
				$style['color'] = $_POST["ccolor"];
				
				if((date('i')*60+date('s')-$_SESSION['shout'])<0){$_SESSION['shout'] = date('i')*60+date('s');}
				//Nếu thời gian chat sau cách thời gian chat trước bao nhiêu giây	
				if((date('i')*60+date('s')-$_SESSION['shout'])>$chat['delay'])
				{
					//Nếu admin + sử dụng lệnh xóa shoutbox
					if($_SESSION["login"]=='admin' && $text==$chat['delete'])
					{
							unlink($root['chatdata']."data.txt");
							echo $name.' has been pruned';
					}
					elseif($_SESSION["login"]=='admin'&&preg_match('^('.$ban['delban'].') (.*)^i',$text,$m))
					{
						if(trim($m[2])==trim($ban['nick'][0])){unlink($root['chatdata']."ban.txt");
							echo'Đã xóa hết danh sách nick bị banned<br>';}
						elseif(trim($m[2])==trim($ban['ip'][0])){unlink($root['chatdata']."banip.txt");
							echo'Đã xóa hết danh sách IP bị banned<br>';}
					}													 
					//Nếu admin + sử dụng ban, unban..
					elseif($_SESSION["login"]=='admin' && preg_match('^('.$ban['nick'][0].'|'.$ban['nick'][1].'|'.$ban['ip'][0].'|'.$ban['ip'][1].') (.*)^i',$text,$m))
					{
						if($m[1]==$ban['nick'][0])//Nếu gõ lệnh ban nick
						{
							$f = fopen($root['chatdata']."ban.txt", "a");fwrite($f,$m[2].'*|*');fclose($f); 
						}
						elseif($m[1]==$ban['nick'][1])//Nếu gõ lệnh mở ban nick
						{
							$data = file_get_contents($root['chatdata']."ban.txt");
							$data = str_replace($m[2].'*|*','',$data);
							$f = fopen($root['chatdata']."ban.txt", "w");fwrite($f,$data);fclose($f);
						}
						elseif($m[1]==$ban['ip'][0])//Nếu gõ lệnh ban IP
						{
							$f = fopen($root['chatdata']."banip.txt", "a");fwrite($f,$m[2].'*|*');fclose($f); 
						}
						elseif($m[1]==$ban['ip'][1])//Nếu gõ lệnh mở ban IP
						{
							$data = file_get_contents($root['chatdata']."banip.txt");
							$data = str_replace($m[2].'*|*','',$data);
							$f = fopen($root['chatdata']."banip.txt", "w");fwrite($f,$data);fclose($f);
						}
						
					}
					
					else
					{
						//Nếu sử dụng từ cấm quá số lần cho phép thì block
						if($_SESSION["block"]>$chat['baned'][0])
						{
							//Nếu hết thời gian cấm thì reset lại session block
							if($chat['baned'][1]-(date('i')*60+date('s')-$_SESSION['shout'])<0)
							{
								$_SESSION["block"]=1;
							}
							else
							{
								echo "<script>alert('Bạn đã bị block ".$chat['baned'][1]."s vì đã sử dụng từ cấm ".$chat['baned'][0]." lần liên tiếp. Còn ".($chat['baned'][1]-(date('i')*60+date('s')-$_SESSION['shout']))."s nữa');</script>";
							}
						}
						else
						{
							//Nếu trong tên nick hoặc nội dung chat có từ láo
							if(preg_match('/('.str_replace(',','|',$chat['block']).')/i', $name.$text, $m))
							{
								if(!isset($_SESSION["block"])) $_SESSION["block"]=1;
								echo "<script>alert('Nhắc nhở ".$_SESSION["block"]." lần bạn ko nên dùng các từ nhạy cảm như \"".$m[1]."\". Cảm ơn!');</script>";
								$_SESSION["block"]=$_SESSION["block"]+1;
								$_SESSION['shout'] = date('i')*60+date('s');
							}
							else
							{
								$data_ban = explode('*|*',file_get_contents($root['chatdata']."ban.txt"));
								$data_banip = explode('*|*',file_get_contents($root['chatdata']."banip.txt"));
								foreach($data_ban as $value)
								{
									if($name==$value)
									{echo"<script>alert('Nick bạn đã bị cấm bởi BQT');</script>";exit();}	
									
								}
								foreach($data_banip as $value)
								{
									if($_SERVER['REMOTE_ADDR']==$value)
									{echo"<script>alert('IP: ".$_SERVER['REMOTE_ADDR']." của bạn bạn đã bị cấm bởi BQT');</script>";exit();}	
									
								}
									//Ghi dữ liệu chat
									$f = fopen($root['chatdata']."data.txt", "a");
									$adminkute_str = "[".date("m/d/Y g:i A")."]*|*".$name."*|*".$text."*|*".$style['b']."*|*".$style['i']."*|*".$style['u']."*|*".$style['color']."*|*".$_SERVER['REMOTE_ADDR']."\n";
									fwrite($f,$adminkute_str);
									$_SESSION['shout'] = date('i')*60+date('s');
									$_SESSION["block"]=1;
									fclose($f); 
							}
						}
					}
				}
				else 
				{
					echo "<script>alert('Thời gian giữa 2 lần chat là ".$chat['delay']."s');</script>";
				}
			}
		
			
			//Smile
			$data_smile = file($root['chatdata'].'adminkute_smilies.txt');
			foreach($data_smile as $value)
			{
				$ex_value = explode(' => ',$value);
				$smileys[htmlspecialchars($ex_value[0])] = $ex_value[1];
			}
			function alter_smiley(&$item1, $key) {
			$item1 = "<img src='$item1' border='0'>";
			}
			array_walk ($smileys, 'alter_smiley');		
			//End Smile
			
			//Đọc file data và hiển thị nội dung chat
			creat_txt('data');
			$data = file($root['chatdata'].'data.txt');
			if($_SESSION["login"]){$u_style='admin';}else {$u_style='user';}
			//Nếu data lớn quá thì xóa
			if(filesize($root['chatdata'].'data.txt')>($fix['data_size']*1024))
			{
				echo 'Dữ liệu hơi nhiều nên chương trình tự động xóa<br>';
				unlink($root['chatdata']."data.txt");
			}
			//Giới hạn số dòng hiển thị
			$limit_line = (count($data)-1>$fix['line'])?(count($chat)-1-$fix['line']):0;
			for($i=(count($data)-1);$i>=$limit_line;$i--)
			{
				if(trim($data[$i]))
				{
					$ex = explode('*|*',$data[$i]);
					$u_style = ($ex[1]==$root['user'])?'admin':'usertalk';
					$mess =  str_replace('\"','"',strtr(htmlspecialchars($ex[2]), $smileys));
					$mess = preg_replace('/('.str_replace(',','|',$chat['block']).')/i','*',$mess);
					$user = preg_replace('/('.str_replace(',','|',$chat['block']).')/i','*',$ex[1]);
					$de_style['b'] = (trim($ex[3])=='B')?'': array('<b>','</b>');
					$de_style['i'] = (trim($ex[4])=='I')?'': array('<i>','</i>');
					$de_style['u'] = (trim($ex[5])=='U')?'': array('<u>','</u>');
					$de_style['color'] = (!trim($ex[6]))?'': array('<font color="'.trim($ex[6]).'">','</font>');
					$de_style_full[0]=$de_style['b'][0].$de_style['i'][0].$de_style['u'][0].$de_style['color'][0]; 
					$de_style_full[1]=$de_style['color'][1].$de_style['b'][1].$de_style['i'][1].$de_style['u'][1];
					$ip = ($_SESSION["login"]=='admin')?'title="'.$ex[1].': '.$ex[7].'"':'';
					echo '<span class="time">'.str_replace(date("m/d/Y"),'Hôm nay',$ex[0]).'</span> <span '.$ip .' class="'.$u_style.'">'.$user.'</span>: <span class="pagetext">'.$de_style_full[0].$mess.$de_style_full[1].'</span><br>';	
				}
			}
	}
	else
	{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$root['webtitle']?> - Admin Kute</title>
<link rel="stylesheet" type="text/css" href="style.css">  
<script src="js/jquery.js" language="javascript"></script>
<script src="js/ajax.js" language="javascript"></script>
<script src="js/him.js" language="javascript"></script>
<script src="js/function.js" language="javascript"></script>
<script>
	function show() 
	{ 
		makeRequest('?adminkute_content',"html","result");
	}
	window.setInterval("show()",<?=$chat['refresh']?>000);
	
</script>

</head>

<script>

$(document).ready(function(){
	//var loading = "Loading...";
	var speed = 'fast';
	$("#do").click(function(){
		var str = $("#adminkute_chatbox").serialize();
		$("#result").fadeOut(speed,function(){
			//$("#result").fadeIn(speed).html(loading);
			 validate();
			$.post('?adminkute_content', str, function(data){
				$("#result").fadeOut(speed,function(){
					$("#result").fadeIn(speed).html(data);
					document.getElementById('text').value='';
					});
				});
			});
		});
	
});
</script> 
</head>

<body>

  <table width="90%<!--<?=$fix['width']?>-->" align="center" style=" margin-top: 10px; box-shadow: 0px 0px 26px black; -webkit-box-shadow: 0px 0px 26px black; -moz-box-shadow: 0px 0px 26px black; border-top-right-radius: 15px; border-top-left-radius: 15px; border-bottom-right-radius: 15px; border-bottom-left-radius: 15px; ">
 
    <tr>
      <td class="fr_top">
	  <?=$root['webtitle']?> - <? if(!$_SESSION["user"]){echo'<a href=?register>Đăng ký</a> - <a href=?login>Đăng nhập</a>';}?><? if($_SESSION["user"]){echo' <a href=?logout>Thoát</a>';}?>
      </td>
    </tr>
    <tr>
      <td class="fr" style="text-align: left;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;">
    <form id="adminkute_chatbox" name="adminkute_chatbox" method="post" action="javascript:function()">
    <input name="name" type="hidden" id="name" value="<?=$_SESSION["user"]?>" />
    <div class="user" ><?=$_SESSION["user"]?> <input style="height: 16px;width:90%;background: white url(http://forum.iloveducpho1.com/chatbox/images/notice.png) center no-repeat;" onfocus="if(this.style.background!=''){this.style.background=''}" onblur="if(this.style.background=='' &amp;&amp; this.value==''){this.style.background='#FFFFFF url(http://forum.iloveducpho1.com/chatbox/images/notice.png) center no-repeat'}" name="text" onkeyup="validate();" type="text" id="text" <? if(!$_SESSION["user"]){echo'disabled="disabled" value="Bạn phải đăng nhập mới chat được"';}?> size="75"/></div>
    <input class="button" <?=$fix['disable']?>type="submit" name="do" id="do" value="Gửi"/>
    <input class="button" <?=$fix['disable']?>name="cbold" id="cbold" type="button" value="B" style="font-weight:bold" onclick="c_style('b');" />
    <input class="button" <?=$fix['disable']?>name="citalic" id="citalic" type="button" value="I" style="font-style:italic" onclick="c_style('i');" />
    <input class="button" <?=$fix['disable']?>name="cunderline" id="cunderline" type="button" value="U" style="text-decoration:underline" onclick="c_style('u');" />
    <input class="button" onclick="smiliepopup();"  type="button" value="Mặt cười" <?=$fix['disable']?>/>
    
<select onchange="cfc_upstyle('color');" name="ccolor"<?=$fix['disable']?>>
<option value="">Màu chữ</option>
<option style="background: Gold none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Gold">Gold</option>
<option style="background: Khaki none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Khaki">Khaki</option>
<option style="background: Orange none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Orange">Orange</option>
<option style="background: LightPink none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="LightPink">LightPink</option>
<option style="background: Salmon none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Salmon">Salmon</option>
<option style="background: Tomato none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Tomato">Tomato</option>
<option style="background: Red none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Red">Red</option>
<option style="background: Brown none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Brown">Brown</option>
<option style="background: Maroon none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Maroon">Maroon</option>

<option style="background: DarkGreen none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="DarkGreen">DarkGreen</option>
<option style="background: DarkCyan none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="DarkCyan">DarkCyan</option>
<option style="background: LightSeaGreen none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="LightSeaGreen">LightSeaGreen</option>
<option style="background: LawnGreen none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="LawnGreen">LawnGreen</option>
<option style="background: MediumSeaGreen none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="MediumSeaGreen">MediumSeaGreen</option>
<option style="background: BlueViolet none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="BlueViolet">BlueViolet</option>
<option style="background: Cyan none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Cyan">Cyan</option>
<option style="background: Blue none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Blue">Blue</option>
<option style="background: DodgerBlue none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="DodgerBlue">DodgerBlue</option>

<option style="background: LightSkyBlue none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="LightSkyBlue">LightSkyBlue</option>
<option style="background: White none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="White">White</option>
<option style="background: DimGray none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="DimGray">DimGray</option>
<option style="background: DarkGray none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="DarkGray">DarkGray</option>
<option style="background: Black none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" value="Black">Black</option>
</select>

    <input type="hidden" name="upbold" value="B" />
    <input type="hidden" name="upitalic" value="I" />
    <input type="hidden" name="upunderline" value="U" />
    <input type="hidden" name="IP" value="<?=$_SERVER['REMOTE_ADDR']?>" />

    </form>
      </td>
    </tr>
	<tr><td style="margin-top: 2px;width:100%;color: #4E4E4E;background: white url(http://forum.iloveducpho1.com/images/gradients/grey-up.png) repeat-x left bottom;_background-image: none;display: block;float: left;position: relative;">
		<marquee direction="left" behavior="alternate" loop="500" scrolldelay="25" truespeed="true" scrollamount="1"><font style="text-shadow: 1px 1px 2px #C2C2C2;" color="#DB08F8" size="3"><b>Chúc bạn có những giờ phút thư giản thoải mái khi đến với diễn đàn I Love Đức Phổ 1. Hãy cùng nhau nói,cùng chém gió để xua tan mọi muộn phiền hay Stress trong người bạn nhé :D.... Chúc các bạn vui vẻ... </b></font></marquee>
		</td></tr>
    <tr>
      <td class="fr_2" height="<?=$fix['height']?>" valign="top">
      	<script>makeRequest('?adminkute_content',"html","result");</script>
      <div id="result" style="width:100%;height:400px/*<?=$fix['height']?>px*/;overflow-y:scroll;padding: 0px 0px 0px 3px;/*text-align: left;margin: 0px auto 20px auto;padding: 10px;border: 5px solid #DDD;width: 720px;background-color: #F8F8F8;border-radius: 20px;-moz-border-radius: 20px;-webkit-border-radius: 20px;*/"></div>
      </td>
    </tr>
  </table>
<!--Thêm-->
<table style="margin-top:15px">
<tr><td align="center">
<a target="_blank" href="index.php" class="footer_adminkute">Phòng Họp Online</a> 
| <a target="_blank" href="http://thpttranquangdieu.com" class="footer_adminkute">Diễn Đàn Trường THPT Trần Quang Diệu</a> 
| <a target="_blank" href="http://iloveducpho1.com" class="footer_adminkute">Diễn Đàn Trường THPT Số 1 Đức Phổ</a>
| <a target="_blank" href="http://truongducpho2.com" class="footer_adminkute">Diễn Đàn Trường THPT Số 2 Đức Phổ</a> 
<br><span class="thongtin_adminkute"><a href="ymsgr:sendim?vanthinh129&amp;m=Mình muốn đăng ký tài khoản để thi trắc nghiệm :D" style="color:white;">AdminKute</a> ||<a href="mailto:vanthinh291@gmail.com" style="color:#B6F7A2;"> Vanthinh291@Gmail.Com</a> || 0975308144</span>
<script language="javascript" type="text/javascript">
function confirmRefresh() {
var okToRefresh = confirm("Bạn chắc chắn muốn tải lại trang này?");
if (okToRefresh)
    {
            setTimeout("location.reload(true);",1000);
    }
}
</script>

<script language="javascript">
    suspendcode=""
    document.write(suspendcode);

    var currentpos,timer;
        
    function initialize()
    {
        timer=setInterval ("scrollwindow ()",30);
    }
    function sc()
    {
        clearInterval(timer);
    }
    function scrollwindow()
    {
        currentpos = document.documentElement.scrollTop || document.body.scrollTop;  
        window.scrollTo(0,++currentpos);
    }
    function amutop()
    {
        window.scrollTo(0,0)
        clearInterval(timer);
    }
    function amubutton()
    {
        window.scrollTo(0,80000)
        clearInterval(timer);
    }
</script>
<div id="congcu_adminkute" align="center"><a onclick="javascript:amutop();return false;" href="#" title="Lên đầu trang"><img border="0" src="images/toolbox/up.png" width="24"></a><br><a onclick="javascript:history.back();return false;" href="#" title="Trở về trang vừa xem"><img border="0" src="images/toolbox/back.png" width="24"></a><br><a href="contact" class="OverlayTrigger" title="Liên hệ"><img border="0" src="images/toolbox/contact.png" width="24"></a><br><a href="javascript:confirmRefresh();" title="Tải lại trang"><img border="0" src="images/toolbox/refresh.png" width="24"></a><br><a onclick="javascript:sc();return false;" href="#" title="Dừng di chuyển"><img border="0" src="images/toolbox/pause.png" width="24"></a><br><a onclick="javascript:clearInterval(timer);initialize();return false;" href="#" title="Di chuyển xuống"><img border="0" src="images/toolbox/autodown.png" width="24"></a><br><a onclick="javascript:amubutton();return false;" href="#" title="Xuống cuối trang"><img border="0" src="images/toolbox/down.png" width="24"></a></div>
</td></tr></table>
</body>
</html>
<? }?>