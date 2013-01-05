<?php
include 'simple_html_dom.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Create a DOM object
$html = new simple_html_dom();
$html->load_file('http://dantri.com.vn/');
//$html->load_file('http://192.168.1.58/linkapp/elgg/settings/user/thaodv');
$link = $html->find('a');
echo $html->plaintext;
foreach($link as $element)
       //echo $element->href . '<br>'; 
       //echo $element.'<br/>';

?>
