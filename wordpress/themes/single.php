<?php
get_header(); ?>
<div class="container">
    <div class="sidebar">
    	<div id="left_col">
    		<?php include (TEMPLATEPATH."/sidebar.php");?></div>
    	</div>
    	
    <div class="mainContent">
    	
<div class="item" >
	<?php
	the_post(); 
	?>
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php 
            the_content('<p class="content">' . __('More &raquo;', 'kubrick') . '</p>');
			?>
			</div><!-- Item Div -->
			 <br class="clear" />
    </div>
    <?php get_footer(); ?>