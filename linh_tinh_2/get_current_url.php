<html>
	<head>
		<title>Get current url</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	</head>
	
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

echo"Cach 1: &nbsp ";
echo curPageURL()."<br/>";
//echo "<br/>".$_SERVER["SERVER_NAME"]."<br/>".$_SERVER["REQUEST_URI"];
//echo substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1)."<br/>" ;
function selfURL() { 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; }
function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
echo"Cach 2: &nbsp ";
echo selfURL() ."<br/>";

echo "Cach 3: &nbsp ";
function currentURL(){
	if(!isset($_SERVER['REQUEST_URI'])){ 
		$serverrequri = $_SERVER['PHP_SELF']; }
	else{ $serverrequri = $_SERVER['REQUEST_URI']; } 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri; }
echo currentURL()."<br/>";

?>
<script>
$(document).ready(function () {
	  console.log('Jquery');
      console.log($(location).attr('href'));    
      console.log($(document).attr('title'));
});
</script>
<script type="text/javascript">
	console.log('javascript');
      console.log("URL : " + window.location.href);       //Hiển thị đường dẫn url
      console.log("Title : " + window.document.title);    //Hiển thị tiêu đề trang
</script>
<?php
/*
 * 
    $_SERVER['HTTP_HOST'] = Bạn vào http://sinhvienit.net/@forum/showthread.php?t=2053 thì kết quả là sinhvienit.net
    $_SERVER['PHP_SELF'] = Bạn vào http://sinhvienit.net/@forum/showthread.php?t=2053 thì kết quả là /@forum/showthread.php
    $_SERVER['REQUEST_TIME'] = Thời gian mà Client gửi request, ở dạng TIME _STAMP
    $_SERVER['QUERY_STRING'] = Bạn vào http://sinhvienit.net/@forum/showthread.php?t=2053 thì kết quả là t = 2053
    $_SERVER['DOCUMENT_ROOT'] = Thư mục gốc chứa mã nguồn. VD: /home/sinhvienit/public_html (Đối với Linux) hay C:\www (Đối với windows)
    $_SERVER['HTTP_REFERER'] = Cái này bạn đang trên http://www.google.com.vn/search?q=sinhvienit mà click vào link tới sinhvienit.net thì nó có giá trị http://www.google.com.vn/search?q=sinhvienit
    $_SERVER['REMOTE_HOST'] = Hostname của người truy cập
    $_SERVER['REMOTE_PORT'] = Port mà trình duyệt mở ra để kết nối tới server
    $_SERVER['REQUEST_URI'] = Bạn vào http://sinhvienit.net/@forum/showthread.php?t=2053 thì kết quả là /@forum/showthread.php?t=2053
    $_SERVER['SERVER_NAME'] = Tên của server (Gần giống với computername) ở máy PC của mình. Ví dụ server.sinhvienit.net
    $_SERVER['SERVER_ADDR'] = IP của server
    $_SERVER['REMOTE_ADDR'] = IP của người truy cập
    $_SERVER['HTTP_USER_AGENT'] = Thông tin về trình duyệt của người truy cập

*/?>
