<?php
/**
 * Register widgetized areas, including two sidebars and widget-ready columns in the footer.
 *
 * To override nhanweb_widget() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function nhanweb_widget() {
	register_sidebar( array(
        'name' => __( 'Widget cột trái', 'nhanweb' ),
        'id' => 'left-widget-area',
        'description' => __( 'Vị trí widget cột bên trái', 'nhanweb' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
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
//---------------------------------------------------------------------------------------------

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
//---------------------------------------------------------------------------------------------
 
class right_ads extends WP_Widget
{
     function right_ads(){
        $widget_ops = array('description' => 'Hien thong tin flash quang cao');
        $control_ops = array('width' => 400, 'height' => 300);
        parent::WP_Widget(false,$name='Flash Ads right sidebar',$widget_ops,$control_ops);
    }
    /*Creates the form for the widget in the back-end. */
    function form($instance){
        //Defaults
        $instance = wp_parse_args( (array) $instance, array('title'=>'', 'flashPath'=>'', 'href_ads'=>'') );
 
        $title = htmlspecialchars($instance['title']);
        $flashPath = htmlspecialchars($instance['flashPath']);
        $href_ads = htmlspecialchars($instance['href_ads']);
 
        # Title
        echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Tiêu đề:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
        # Image
        echo '<p><label for="' . $this->get_field_id('flashPath') . '">' . 'Link Flash:' . '</label><input class="widefat" id="' . $this->get_field_id('flashPath') . '" name="' . $this->get_field_name('flashPath') . '" type="text" value="' . $flashPath . '" /></p>';  
        # About Text
        echo '<p><label for="' . $this->get_field_id('href_ads') . '">' . 'Link Web:' . '</label><input class="widefat" id="' . $this->get_field_id('href_ads') . '" name="' . $this->get_field_name('href_ads') . '" type="text" value="' . $href_ads . '" /></p>';
    }
 
    /*Saves the settings. */
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = stripslashes($new_instance['title']);
        $instance['flashPath'] = stripslashes($new_instance['flashPath']);
        $instance['href_ads'] = stripslashes($new_instance['href_ads']);
 
        return $instance;
    }
     
    /* Displays the Widget in the front-end */
    function widget($args, $instance){
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Về CTy' : $instance['title']);
        $flashPath = empty($instance['flashPath']) ? '' : $instance['flashPath'];
        $href_ads = empty($instance['href_ads']) ? '' : $instance['href_ads'];
 
        echo $before_widget;
 
        if ( $title )
        //echo $before_title . $title . $after_title;
        ?>  
        <div class="clearfix">
        <a target="blank" href="<?php echo $href_ads ?>"  >
        	<div>
			<object width="220" height="240"><param name="movie" value="<?php echo $flashPath ?>">
				<embed src="<?php echo $flashPath ?>" width="220" height="240">
				</embed></object></div>
            </a>	
        </div>
        <?php
        echo $after_widget;
    }
 
}// end Widget_name class
 
function register_right_ads_Init() {
  register_widget('right_ads');
}
 
add_action('widgets_init', 'register_right_ads_Init');
//---------------------------------------------------------------------------------------------

/*Custom post type*/
  add_action('init', 'create_xvideo_post_type');
  function create_xvideo_post_type(){
    register_post_type('xvideo',
      array(
        'labels'  =>  array(
          'name'  =>  __('xvideo'),
          'singular_name' =>  __('xvideo'),
          'add_new' =>  __('Add xvideo'),
          'add_new_item'  =>  __('Add New xvideo'),
          'edit'  =>  __('Edit'),
          'edit_item' =>  __('Edit xvideo'),
          'new_item'  =>  __('New xvideo'),
          'view'  =>  __('View xvideo'),
          'view_item' =>  __('View xvideo'),
          'search_items' =>  __('Search xvideo'),
          'not_found' =>  __('No xvideos found'),
          'not_found_in_trash'  =>  __('No xvideos found in Trash')
        ),
         'taxonomies' => array('category'),
        'public'  =>  true,
        'show_ui' =>  true,
        'publicy_queryable' =>  true,
        'exclude_from_search' =>  false,
        'menu_position' => 20,
        'menu_icon' =>  get_stylesheet_directory_uri(). '/images/product.png',
        'hierarchical'  => false,
        'query_var' =>  true,
        'supports'  =>  array(
          'title', 'editor',  'thumbnail',//'excerpt'
          
        ),
        'rewrite' =>  array('slug'  =>  'product', 'with_front' =>  false),
        //'taxonomies' =>  array('post_tag', 'category'),
        'can_export'  =>  true,
        //'register_meta_box_cb'  =>  'call_to_function_do_something',
        'description' =>  __('Xvideo description here.')
      )
    );
  }

//---------------------------------------------------------------------------------------------
 // custom field for post

add_action('add_meta_boxes', 'boot_add_xvideo_meta');

function boot_add_xvideo_meta() {
    add_meta_box('Add here:', 'Add link embed XVIDEO ', 'boot_show_xvideo_meta', 'xvideo');
}

function boot_show_xvideo_meta() {

    global $post;
    echo '<input type="hidden" name="boot_custom_meta_box_nonce" value= "' . wp_create_nonce(basename(__FILE__)) . '"/>';

    $link_embed = get_post_meta($post->ID, 'boot-field-embed', true);
    echo ' Link embed xvideo:<br/>
    	 <textarea name="boot-field-embed" rows="6" cols="50">'.$link_embed.'</textarea><br/>';
}

add_action('save_post', 'boot_save_custom_meta_box');

function boot_save_custom_meta_box($post_id) {
    global $custom_meta_fields;
    // verify nonce  
    if (!wp_verify_nonce($_POST['boot_custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;

    $link_embed = $_POST['boot-field-embed'];
    update_post_meta($post_id, 'boot-field-embed', $link_embed);
}
 