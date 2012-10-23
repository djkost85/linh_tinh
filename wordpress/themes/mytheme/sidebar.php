<!--
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Sidebar") ) : ?>
<h2>Main sidebar</h2>
<p>Bạn chưa gọi widget nào</p>
<?php endif;?>
-->
<div class="nav_header" rel="lightbox">
  <div class="begin_title"></div><h3 class="nav_title">Category</h3>
           <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
         <ul>
            	<li class="cat-item"><a href="#" title="" rel="lightbox">Television</a>
              </li>
              	<li class="cat-item"><a href="#" title="">Cooker</a>
              </li>
              <li class="cat-item"><a href="#" title="">Laptop</a>
              </li>
              	<li class="cat-item"><a href="#" title="">Lamp</a>
              </li>
   	</ul>
</div>
<div  id="s"> 
                        	<h3>Quảng Cáo</h3> 
                            <div id="s1" class="pics">							
                                <div><a href=#><img src= "<?php bloginfo('stylesheet_directory')?>/images/advertise/h10.jpg"  /></a></div>                               
                                <div><a href=#><img src="<?php bloginfo('stylesheet_directory')?>/images/advertise/h11.jpg"   /></a></div>
                                <div><a href=#><img src="<?php bloginfo('stylesheet_directory')?>/images/advertise/h12.jpg"   /></a></div>
                                <div><a href=#><img src="<?php bloginfo('stylesheet_directory')?>/images/advertise/h13.jpg"  /></a></div>
							</div>
                        </div>
                       
<script type="text/javascript">
$(document).ready(function(){
	
	$(".accordion h2:first").addClass("active");
	$(".accordion div.slided:not(:first)").hide();
	
	 $('#s1').cycle({
        fx:     'scrollUp',
        speed:  '500',
        timeout: 3000,
   		pause: 1
    	});
		
	$(".accordion h2").click(function(){
		$(this).next("div.slided").slideToggle("slow")
		.siblings("div.slided:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h2").removeClass("active");
	});

});
</script>