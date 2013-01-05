<?
if(!defined('ADMINKUTE_ROOT')) die ('Hello pro!');
	$root['user'] = 'admin';
	$root['pass'] = '123456';
	$root['chatdata'] = 'data/';
	putenv("TZ=Asia/Bangkok");//Set time theo giờ Việt Nam
	########################
	if(!fopen($root['chatdata'].'config.txt','a')) die ('Host cua ban ko ho tro ham fopen');
	
	function creat_txt($str)
	{
		global $root;
		if(!file_exists($root['chatdata'].$str.".txt"))
		{$f = fopen($root['chatdata'].$str.".txt", "a");
		if($str=='config'){
			fwrite($f,'Phòng Họp Online|2|10|/prune|đéo,ngu,chó|30|5,30|100|670|170|/ban,/unban|/banip,/unbanip');}
		fclose($f);}
	}
	creat_txt('config');
	creat_txt('ban');creat_txt('banip');
	creat_txt('user');creat_txt('data');

	
	$data = file_get_contents($root['chatdata'].'config.txt');
	$ex = explode('|',$data);	
	
	$root['webtitle'] = $ex[0];
	$chat['delay'] = $ex[1];//(giây) Thời gian chênh lệch giữa 2 lần shout, tránh spam
	$chat['refresh'] = $ex[2];//(giây) Thời gian tự động refresh khung chat
	$chat['delete'] = $ex[3]; //Lệnh xóa shoutbox khi đã đăng nhập admin
	$chat['block'] = $ex[4];//Loại bỏ các từ láo, ngăn cách nhau bởi dấu ,
	$fix['line'] = $ex[5];//(dòng) Giới hạn số dòng hiển thị trong khung chat
	$chat['baned'] = explode(',',$ex[6]);//array(5,30) -  5 lần sử dụng từ láo sẽ bị khóa nick 30 giây
	$fix['data_size'] = $ex[7];//(kb) Khi data nặng hơn 100kb thì tự động xóa
	$fix['width'] = $ex[8]; //Chiều rộng chat box
	$fix['height'] = $ex[9];//Chiều cao chat box
	$ban['nick'] = explode(',',$ex[10]);//Cấm nick chat
	$ban['ip'] =  explode(',',$ex[11]);//Cấm IP chat
	$ban['delban'] = $ex[12];
	
	
	
	
	
	
	
	
	
	
?>
