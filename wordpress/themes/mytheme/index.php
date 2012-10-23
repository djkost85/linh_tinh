<?php
get_header(); ?>


<?php if(function_exists('wp_simple_pagination')) {
		wp_simple_pagination();
	} ?>
<div class="container">
	<div class ='dimox_breadcrumbs'><?php if (function_exists('dimox_breadcrumbs')) 
		dimox_breadcrumbs();
		dimox_breadcrumbs(); ?></div>
    <div class="sidebar">
    	<div id="left_col">
    		<?php include (TEMPLATEPATH."/sidebar.php");?></div>
    	</div>
    	
    <div class="mainContent">
    	
<?php
/*
 * 
echo "<div id=\"portfolio\">"; 
$args = array( 'post_type' => 'portfolios', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	echo '<div class="item" >';
	the_title();
	the_content();
	echo '</div>';
 endwhile; 
echo "</div>";
 * 
 */
 ?>
 

    	<?php while (have_posts()) : the_post(); ?>
    		
          <div class="item" >
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php 
            //the_content('<p class="content">' . __('More &raquo;', 'kubrick') . '</p>');
			//the_excerpt('<p class="content">' . __('More &raquo;', 'kubrick') . '</p>');
			the_excerpt();
			 ?>
          </div><!-- Item Div -->
       <?php endwhile;?> 
        

    <br class="clear" />
    </div>
    <?php if(function_exists('wp_simple_pagination')) {
		wp_simple_pagination();
	} ?>
	<?php if(function_exists('wp_pagenavi')) { 
	 wp_pagenavi();} ?>
	 <?php if(function_exists(' pagenavi')) { 
	  pagenavi();} ?>
	

<?php get_footer(); ?>




<!--
	http://nhanweb.com/2011/07/thiet-ke-theme-wp-phan-10-lam-viec-voi-widget-tiep.html
-->