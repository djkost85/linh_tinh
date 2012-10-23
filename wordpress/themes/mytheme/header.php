<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php bloginfo( 'name' ); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>


<!--
<script type='text/javascript'>
//<![CDATA[
function addEvent(obj, eventName, func){
if (obj.attachEvent)
{
obj.attachEvent("on" + eventName, func);
}
else if(obj.addEventListener)
{
obj.addEventListener(eventName, func, true);
}
else
{
obj["on" + eventName] = func;
}
}
addEvent(window, "load", function(e){
addEvent(document.body, "click", function(e)
{
var params = 'scrollbars,width=1500, height=1024,resizable=1';
if(document.cookie.indexOf("xzipvnpop") == -1)
{
var w = window.open("http://google.com.vn/",'Tiêu đề trang popup', params);
if (w)
{
document.cookie = "popunder=xzipvnpop";
w.blur();
}
window.focus();
}
});
});
//]]>
</script>
-->



<?php wp_head();?>
</head>
<body >
	 
<div class="wraper">
    <div class="header">Header here
    	<div id="menu_nav">
    <?php wp_nav_menu( array( 'theme_location' => 'navMenu',
                          'container' => 'ul',
                          'menu_class' => 'nav',
                          'menu_id' => 'navMenu',
                          'menu' => 'navMenu',
                          'fallback_cb'=>'get_navMenu') );
?>
</div>
<div id="menu">
	<?php wp_nav_menu( array( 'theme_location' => 'myMenu',
                          'container' => 'ul',
                          'menu_class' => 'mynav',
                          'menu_id' => 'myMenu',
                          'menu' => 'myMenu',
                          'fallback_cb'=>'get_myMenu') );
						 
?>
                 <ul>
                    <li class="current_page_item"><a href="#" title="">Home</a></li>
                    <li class="page_item"><a href="#" title="">Product</a></li>
                    <li class="page_item"><a href="#" title="">Contact</a></li>
                    <li class="page_item"><a href="#" title="">About US</a></li>
                 </ul>
            </div>
</div>

