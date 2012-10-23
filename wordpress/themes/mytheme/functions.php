<?php
register_sidebar( array(
		'name' => __( 'Main Sidebar' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

register_sidebar( array(
		'name' => __( 'Footer 1' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
register_sidebar( array(
		'name' => __( 'Footer 2' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
register_sidebar( array(
		'name' => __( 'Footer 3' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
register_sidebar( array(
		'name' => __( 'Footer 4' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

function mymenus_setup() {    register_nav_menus( array( $location => $description ) );
}
function nhanweb_widget() {
    // Dang ky widget cho Admin
    register_sidebar( array(
        'name' => __( 'Widget cột phải', 'nhanweb' ),
        'id' => 'right-widget-area',
        'description' => __( 'Vị trí widget cột bên phải', 'nhanweb' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    register_sidebar( array(
        'name' => __( 'Widget Footer', 'nhanweb' ),
        'id' => 'footer-widget-area',
        'description' => __( 'Vị trí widget ở cuối thang', 'nhanweb' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
/** Register sidebars by running nhanweb_widget() on the widgets_init hook. */
add_action( 'widgets_init', 'nhanweb_widget' );
 
class nhanweb_Aboutme extends WP_Widget
{
     function nhanweb_Aboutme(){
        $widget_ops = array('description' => 'Hiện thông tin giới thiệu tác giả');
        $control_ops = array('width' => 400, 'height' => 300);
        parent::WP_Widget(false,$name='NhanWeb About me',$widget_ops,$control_ops);
    }
    /*Creates the form for the widget in the back-end. */
    function form($instance){
        //Defaults
        $instance = wp_parse_args( (array) $instance, array('title'=>'', 'imagePath'=>'', 'aboutText'=>'') );
 
        $title = htmlspecialchars($instance['title']);
        $imagePath = htmlspecialchars($instance['imagePath']);
        $aboutText = htmlspecialchars($instance['aboutText']);
 
        # Title
        echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Tiêu đề:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
        # Image
        echo '<p><label for="' . $this->get_field_id('imagePath') . '">' . 'Ảnh:' . '</label><textarea cols="20" rows="2" class="widefat" id="' . $this->get_field_id('imagePath') . '" name="' . $this->get_field_name('imagePath') . '" >'. $imagePath .'</textarea></p>';  
        # About Text
        echo '<p><label for="' . $this->get_field_id('aboutText') . '">' . 'Giới thiệu:' . '</label><textarea cols="20" rows="5" class="widefat" id="' . $this->get_field_id('aboutText') . '" name="' . $this->get_field_name('aboutText') . '" >'. $aboutText .'</textarea></p>';
    }
 
    /*Saves the settings. */
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = stripslashes($new_instance['title']);
        $instance['imagePath'] = stripslashes($new_instance['imagePath']);
        $instance['aboutText'] = stripslashes($new_instance['aboutText']);
 
        return $instance;
    }
     
    /* Displays the Widget in the front-end */
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Về tôi' : $instance['title']);
        $imagePath = empty($instance['imagePath']) ? '' : $instance['imagePath'];
        $aboutText = empty($instance['aboutText']) ? '' : $instance['aboutText'];
 
        echo $before_widget;
 
        if ( $title )
        echo $before_title . $title . $after_title;
        ?>  
        <div class="clearfix">
            <img src="<?php echo $imagePath; ?>" id="about-image" alt="about us image" />
            <p><?php echo($aboutText)?></p>
        </div>
        <?php
        echo $after_widget;
    }
 
}// end Widget_name class
 
function registernhanweb_AboutmeInit() {
  register_widget('nhanweb_Aboutme');
}
 
add_action('widgets_init', 'registernhanweb_AboutmeInit');



// Page navi www.Noface.info
function emm_paginate($args = null) {
$defaults = array(
'page' => null, 'pages' => null,
'range' => 3, 'gap' => 3, 'anchor' => 1,
'before' => '
', 'after' => '
',
'title' => __('Pages:'),
'nextpage' => __('»'), 'previouspage' => __('«'),
'echo' => 1
);
$r = wp_parse_args($args, $defaults);
extract($r, EXTR_SKIP);
if (!$page && !$pages) {
global $wp_query;
$page = get_query_var('paged');
$page = !empty($page) ? intval($page) : 1;
$posts_per_page = intval(get_query_var('posts_per_page'));
$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
}
$output = "";
if ($pages > 1) {
$output .= "$before$title";
$ellipsis = "...";
if ($page > 1 && !empty($previouspage)) {
$output .= "$previouspage";
}
$min_links = $range * 2 + 1;
$block_min = min($page - $range, $pages - $min_links);
$block_high = max($page + $range, $min_links);
$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;
if ($left_gap && !$right_gap) {
$output .= sprintf('%s%s%s',
emm_paginate_loop(1, $anchor),
$ellipsis,
emm_paginate_loop($block_min, $pages, $page)
);
}
else if ($left_gap && $right_gap) {
$output .= sprintf('%s%s%s%s%s',
emm_paginate_loop(1, $anchor),
$ellipsis,
emm_paginate_loop($block_min, $block_high, $page),
$ellipsis,
emm_paginate_loop(($pages - $anchor + 1), $pages)
);
}
else if ($right_gap && !$left_gap) {
$output .= sprintf('%s%s%s',
emm_paginate_loop(1, $block_high, $page),
$ellipsis,
emm_paginate_loop(($pages - $anchor + 1), $pages)
);
}
else {
$output .= emm_paginate_loop(1, $pages, $page);
}
if ($page < $pages && !empty($nextpage)) {
$output .= "$nextpage";
}
$output .= $after;
}
if ($echo) {
echo $output;
}
return $output;
}
function emm_paginate_loop($start, $max, $page = 0) {
$output = "";
for ($i = $start; $i <= $max; $i++) {
$output .= ($page === intval($i))
? "$i"
: "$i";
}
return $output;
}
add_action('init', 'codex_custom_init');
function codex_custom_init()
{
    $labels = array(
        'name' => _x('WordPress Portfolios Gallery', 'post type general name'),
        'singular_name' => _x('Portfolios', 'post type singular name'),
        'add_new' => _x('Add New', 'portfolio'),
        'add_new_item' => __('Add New Portfolio'),
        'edit_item' => __('Edit Portfolio'),
        'new_item' => __('New Portfolio'),
        'all_items' => __('All Portfolios'),
        'view_item' => __('View Portfolio'),
        'search_items' => __('Search Portfolios'),
        'not_found' =>  __('No portfolios found'),
        'not_found_in_trash' => __('No portfolios found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Portfolios'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true, //'rewrite' => array("slug" => "portfolios")
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','comments', 'custom-fields', 'trackbacks') //thumbnail, excerpt
  );
  register_post_type('portfolios',$args);
  register_taxonomy_for_object_type('post_tag', 'portfolios');
  register_taxonomy_for_object_type('category','portfolios');
}
/*Custom post type*/
  add_action('init', 'create_product_post_type');
  function create_product_post_type(){
    register_post_type('product',
      array(
        'labels'  =>  array(
          'name'  =>  __('Product'),
          'singular_name' =>  __('Product'),
          'add_new' =>  __('Add New'),
          'add_new_item'  =>  __('Add New Product'),
          'edit'  =>  __('Edit'),
          'edit_item' =>  __('Edit Product'),
          'new_item'  =>  __('New Product'),
          'view'  =>  __('View Product'),
          'view_item' =>  __('View Product'),
          'search_items' =>  __('Search Products'),
          'not_found' =>  __('No Products found'),
          'not_found_in_trash'  =>  __('No Products found in Trash')
        ),
        'public'  =>  true,
        'show_ui' =>  true,
        'publicy_queryable' =>  true,
        'exclude_from_search' =>  false,
        'menu_position' => 20,
        'menu_icon' =>  get_stylesheet_directory_uri(). '/images/product.png',
        'hierarchical'  => false,
        'query_var' =>  true,
        'supports'  =>  array(
          'title', 'editor', 'comments', 'author', 'excerpt', 'thumbnail',
          'custom-fields'
        ),
        'rewrite' =>  array('slug'  =>  'product', 'with_front' =>  false),
        //'taxonomies' =>  array('post_tag', 'category'),
        'can_export'  =>  true,
        //'register_meta_box_cb'  =>  'call_to_function_do_something',
        'description' =>  __('Product description here.')
      )
    );
  }

function dimox_breadcrumbs() {
 
  $delimiter = '»';
  $home = 'Home'; // chữ thay thế cho phần 'Home' link
  $before = '<span class="current">'; // thẻ html đằng trước mỗi link
 $after = '</span>'; // thẻ đằng sau mỗi link
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '</pre>
<div id="crumbs">';
 
 global $post;
 $homeLink = get_bloginfo('url');
 echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
 if ( is_category() ) {
 global $wp_query;
 $cat_obj = $wp_query->get_queried_object();
 $thisCat = $cat_obj->term_id;
 $thisCat = get_category($thisCat);
 $parentCat = get_category($thisCat->parent);
 if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
 echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
 } elseif ( is_day() ) {
 echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
 echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
 echo $before . get_the_time('d') . $after;
 
 } elseif ( is_month() ) {
 echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
 echo $before . get_the_time('F') . $after;
 
 } elseif ( is_year() ) {
 echo $before . get_the_time('Y') . $after;
 
 } elseif ( is_single() && !is_attachment() ) {
 if ( get_post_type() != 'post' ) {
 $post_type = get_post_type_object(get_post_type());
 $slug = $post_type->rewrite;
 echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 } else {
 $cat = get_the_category(); $cat = $cat[0];
 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
 echo $before . get_the_title() . $after;
 }
 
 } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
 $post_type = get_post_type_object(get_post_type());
 echo $before . $post_type->labels->singular_name . $after;
 
 } elseif ( is_attachment() ) {
 $parent = get_post($post->post_parent);
 $cat = get_the_category($parent->ID); $cat = $cat[0];
 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
 echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 
 } elseif ( is_page() && !$post->post_parent ) {
 echo $before . get_the_title() . $after;
 
 } elseif ( is_page() && $post->post_parent ) {
 $parent_id = $post->post_parent;
 $breadcrumbs = array();
 while ($parent_id) {
 $page = get_page($parent_id);
 $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
 $parent_id = $page->post_parent;
 }
 $breadcrumbs = array_reverse($breadcrumbs);
 foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 
 } elseif ( is_search() ) {
 echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
 } elseif ( is_tag() ) {
 echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
 } elseif ( is_author() ) {
 global $author;
 $userdata = get_userdata($author);
 echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
 } elseif ( is_404() ) {
 echo $before . 'Error 404' . $after;
 }
 
 if ( get_query_var('paged') ) {
 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
 echo __('Page') . ' ' . get_query_var('paged');
 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
 }
 
 echo '</div>
<pre>';
 
  }
} // end dimox_breadcrumbs()
//add_action('init', 'dimox_breadcrumbs');