<?php
get_header(); ?>

<?php
get_sidebar();
?>
<?php get_sidebar('right'); ?>
<?php
if(is_home()){
	query_posts( array( 'category_id' => array(15,1,7,), 'posts_per_page' => 5, 'orderby' => 'title', 'order' => 'DESC' ) );

while ( have_posts() ) : the_post();
	echo "<div class='bai-viet'>";
	//echo '<li>';
	//the_title();
	?>
	 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	 <?php
	//echo '</li>';
	echo "<br/>";
	echo "<div class='tom-tat-nd'>";
	the_excerpt();
	echo "</div>[....]</div>";
endwhile;

// Reset Query
wp_reset_query();

}



?>
</div>
<script>
$(document).ready(function(){
    $(".tom-tat-nd").each(function(){
        var text = $(this).html();
        if(text.length > 200){
            text = text.substring(0,200);
            $(this).html(text);
        }
    });
})
</script>