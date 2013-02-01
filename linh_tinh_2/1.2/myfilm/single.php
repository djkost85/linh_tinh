<?php
get_header(); ?>

<?php
get_sidebar();
?>
<?php get_sidebar('right'); ?>
	<?php
	the_post(); 
	?>
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php 
            the_content('<p class="content">' . __('More &raquo;', 'kubrick') . '</p>');
			if(get_post_meta($post->ID, 'boot-field-embed', true)){
				echo get_post_meta($post->ID, 'boot-field-embed', true); // 123$  
			}
			?>
			
			<?php if (is_category('15')) { ?>
<p>This is category 15</p>
<?php }else { ?>
	<p>This is not category 15</p>
<?php } ?>
<?php if (in_category('15')) { ?>
<p>This post in category 15</p>
<?php }else { ?>
	<p>This post not in category 15</p>
<?php } ?>
   
			</div><!-- Item Div -->
			 <br class="clear" />
			 
    <?php get_footer(); ?>