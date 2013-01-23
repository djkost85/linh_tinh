
<?php
#
//$filename = $_GET['filename'];
//$filename = "http://sinhvienit.net/@forum/attachment/26942/1358221983/SinhVienIT.Net---Averin_WP_v5.1.zip";
$filename = "ajax_one.js";
#
 
#

#
// Đường dẫn tới file download
#
$download_path = "upload/";
#
 
#
if(eregi("\.\.", $filename)) die("I'm sorry, you may not download that file.");
#
$file = str_replace("..", "", $filename);
#
 
#
// Không cho download file .ht.
#
if(eregi("\.ht.+", $filename)) die("I'm sorry, you may not download that file.");
#
 
#
//Kết hợp đường dẫn tới file và tên file để tạo đường dẫn đầy đủ.
#
$file = "$download_path$file";
#
 
#
// Kiểm tra xem file có tồn tại không.
#
if(!file_exists($file)) die("I'm sorry, the file doesn't seem to exist.");
#
 
#
// Lấy ra dạng file (đuôi file)
#
$type = filetype($file);
#
 
#
// lấy ngày hiện tại
#
$today = date("F j, Y, g:i a");
#
$time = time();
#
 
#
// gởi yêu cầu download tới browser
#
header("Content-type: $type");
#
header("Content-Disposition: attachment;filename=$filename");
#
header("Content-Transfer-Encoding: binary");
#
header('Pragma: no-cache');
#
header('Expires: 0');
#
#
set_time_limit(0);
#
readfile($file);  

?>

