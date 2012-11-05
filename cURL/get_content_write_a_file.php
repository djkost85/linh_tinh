<head>
	<title>Thế giới - Dân trí </title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<pre>
<?php
include 'curl_simple_html_dom.php';

$html = new simple_html_dom();
$html->load_file('http://dantri.com.vn/the-gioi/quan-doi-israel-va-syria-dau-phao-tra-dua-nhau-662053.htm');

 $ret = $html->find('#ctl00_IDContent_ctl00_divContent');
 //echo $ret->plaintext."<br/>";
 
 echo __DIR__;
$fp=fopen(__DIR__."/test.txt",a)or exit("khong tim thay file can mo");



 if(!$ret){
 	echo "FALSE!!!";
 }
 foreach ($ret as $content => $value) {
     
fwrite($fp,$value->plaintext);
 }
 fclose($fp);

?>
</pre>