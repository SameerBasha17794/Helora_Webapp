<?php
/***************************/
/* OPTIONTREE FRAMEWORK    */
/***************************/

add_filter( 'ot_show_pages', '__return_false' );

add_filter( 'ot_theme_mode', '__return_true' );

include_once( 'option-tree/ot-loader.php' );

include_once( 'includes/theme-options.php' );

/************************/
/* Dynamic CSS */
/************************/

include ('css/options.php');

if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}
/******************/
/*Register Scripts*/
/******************/
function medicom_script($theme_options) {
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2-respond-1.1.0.min.js', array( 'jquery' ));
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_register_script( 'jui', get_template_directory_uri() . '/js/jquery-ui.js', array( 'jquery' ), '', true );  
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );  
    wp_register_script( 'imagesload', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), '', true);
    wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '', true);
    wp_register_script( 'smootscroll', get_template_directory_uri() . '/js/SmoothScroll.js', array('jquery'), '', true);
    wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);
      
    wp_enqueue_script('jquery');   
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jui');
    wp_enqueue_script('bootstrap'); 
    wp_enqueue_script('imagesload');
    wp_enqueue_script('plugins');
    $smoothy = get_option_tree('disable_smooth_scrool',$theme_options);
    if ($smoothy != 'Yes' ) {
    wp_enqueue_script('smootscroll');
    }
    wp_enqueue_script('main');

    }
add_action( "wp_enqueue_scripts", "medicom_script" );
/***********************/
/* Register medicom CSS */
/**********************/
function medicom_styles($theme_options) {
    wp_register_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css');
    wp_register_style('font', get_template_directory_uri(). '/css/font-awesome.min.css');
    wp_register_style('pretty', get_template_directory_uri(). '/css/prettyPhoto.css');
    wp_register_style('flex', get_template_directory_uri(). '/css/flexslider.css');
    wp_register_style('icon', get_template_directory_uri(). '/css/icons.css');
    wp_register_style('main', get_template_directory_uri(). '/css/main.css');
    wp_register_style('animate', get_template_directory_uri(). '/css/animate.css');

    wp_register_style('visual', get_template_directory_uri(). '/css/vc_extend.css');
    $asset = get_option_tree('asset_color',$theme_options);
    if($asset != 'main'){
    wp_register_style('asset', get_template_directory_uri().'/css/'.$asset.'.css');
    }

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('font');  
    wp_enqueue_style('pretty'); 
    wp_enqueue_style('flex');
    wp_enqueue_style('icon'); 
    wp_enqueue_style('main'); 
    wp_enqueue_style('animate');

    wp_enqueue_style('visual');
    if($asset != 'main'){
    wp_enqueue_style('asset');
    } 
}
add_action('wp_enqueue_scripts', 'medicom_styles');

/***********************/
/* Register Style CSS  */
/***********************/
function medicom_child() {
    wp_register_style('child', get_stylesheet_uri() );
    wp_enqueue_style('child');
}
add_action('wp_enqueue_scripts', 'medicom_child', 22);
/********************/
/* Content Width    */
/*******************/   
if ( ! isset( $content_width ) ) $content_width = 1170;

/*****************/
/*** Thumbnail ***/
/*****************/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 805, 503, true );
/*****************/
/*    FEED      */
/*****************/
add_theme_support( 'automatic-feed-links' );

/******************************/
/* Multiple Image for Gallery */
/*****************************/

if (class_exists('MultiPostThumbnails')) {

new MultiPostThumbnails(array(
'label' => 'Secondary Image',
'id' => 'secondary-image',
'post_type' => 'post'
 ) );

new MultiPostThumbnails(array(
'label' => 'Third Image',
'id' => 'third-image',
'post_type' => 'post'
 ) );

new MultiPostThumbnails(array(
'label' => 'Fourth Image',
'id' => 'fourth-image',
'post_type' => 'post'
 ) );

new MultiPostThumbnails(array(
'label' => 'Fifth Image',
'id' => 'fifth-image',
'post_type' => 'post'
 ) );

new MultiPostThumbnails(array(
'label' => 'Sixth Image',
'id' => 'last-image',
'post_type' => 'post'
 ) );
 }

/*************************/
/* Thumbnail need these */
/************************/
include ('functions/function-vt-resize.php');

/**********************/
/*** Custom Post Type */
/**********************/
include ('includes/custom-post-type.php');

/**************************/
/*** Blog intro length ***/
/*************************/
function medicom_custom_excerpt_length( $length ) {
    return 90;
}

add_filter( 'excerpt_length', 'medicom_custom_excerpt_length', 999 );

/*********************/
/* Load Text Domain */
/*********************/

load_theme_textdomain('medicom', get_template_directory().'/languages');


/**************************/
/*    Include Plugins     */
/**************************/
 
require_once get_template_directory() . "/plugins/install.php";

/**********************/
/*---Register Menus---*/
/*********************/
function medicom_register_my_menus() {
register_nav_menus(
array(
'main_menu' => 'Main Menu'
)
);
}
add_action( 'init', 'medicom_register_my_menus' );
?>
<?php 
/******************************/
/* Register Walker for Main Menu */
/******************************/
class medicom_sweet_custom_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'medicom_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'medicom_scm_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'medicom_scm_edit_walker'), 10, 2 );

	} // end constructor
	
	
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function medicom_scm_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->extra_class = get_post_meta( $menu_item->ID, '_menu_item_extra_class', true );
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function medicom_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-extra_class'] ) && is_array( $_REQUEST['menu-item-extra_class']) ) {
	        $extra_class_value = $_REQUEST['menu-item-extra_class'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_extra_class', $extra_class_value );
	    }
	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function medicom_scm_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}
// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new medicom_sweet_custom_menu();
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $_wp_nav_menu_max_depth;
	   
	    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	    ob_start();
	    $item_id = esc_attr( $item->ID );
	    $removed_args = array(
	        'action',
	        'customlink-tab',
	        'edit-menu-item',
	        'menu-item',
	        'page-tab',
	        '_wpnonce',
	    );
	
	    $original_title = '';
	    if ( 'taxonomy' == $item->type ) {
	        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	        if ( is_wp_error( $original_title ) )
	            $original_title = false;
	    } elseif ( 'post_type' == $item->type ) {
	        $original_object = get_post( $item->object_id );
	        $original_title = $original_object->post_title;
	    }
	
	    $classes = array(
	        'menu-item menu-item-depth-' . $depth,
	        'menu-item-' . esc_attr( $item->object ),
	        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
	    );
	
	    $title = $item->title;
	
	    if ( ! empty( $item->_invalid ) ) {
	        $classes[] = 'menu-item-invalid';
	        /* translators: %s: title of menu item which is invalid */
	        $title = sprintf( __( '%s (Invalid)' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)'), $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;
	
	    ?>
	    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
	                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
	                    ?>"><?php _e( 'Edit Menu Item' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
	                        <?php _e( 'URL' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Navigation Label' ); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Title Attribute' ); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e( 'Open link in a new window/tab' ); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
	                    <?php _e( 'CSS Classes (optional)' ); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
	                    <?php _e( 'Link Relationship (XFN)' ); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
	                    <?php _e( 'Description' ); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
	                </label>
	            </p>        
	            <?php
	            /* New fields insertion starts here */
	            ?>      
	            <p class="field-custom description description-wide">
	                <label for="edit-menu-item-extra_class-<?php echo $item_id; ?>">
	                    <?php _e( 'Extra Class' ); ?><br />
	                    <input type="text" id="edit-menu-item-extra_class-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-extra_class[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->extra_class ); ?>" />
	                </label>
	            </p>
	            <?php
	            /* New fields insertion ends here */
	            ?>
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
	                echo wp_nonce_url(
	                    add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                    ),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
	            </div>
	
	            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
	            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
	            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
	            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
	            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
	            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
	        </div><!-- .menu-item-settings-->
	        <ul class="menu-item-transport"></ul>
	    <?php
	    
	    $output .= ob_get_clean();

	    }
}

class medicom_walker_main_menu extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
function start_lvl( &$output, $depth=0, $args=array() ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        
        ( $display_depth % 2  ? 'dropdown-menu' : '' ),
        ( $display_depth >=2 ? 'dropdown-menu' : '' )
        );
    $class_names = implode( ' ', $classes );         

    
   
    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	

}

// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(),$current_object_id = 0) {
    $mainSite = home_url();
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'firstitem' : '' ),
        ( $depth >=2 ? '' : '' ),
        ( $depth % 2 ? '' : '' ),
        
    );
    $depth_class_names = esc_attr( implode( '', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $item->extra_class . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
    $attributes .= ' class="menu-link"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

}
}


/*******************************/
/* Wordpress Widgets&Sidebar   */
/*******************************/
/******************************/
/* Sidebar */
/******************************/
function medicom_sidebar() {
$theme_options = get_option('option_tree');
$seffect = get_option_tree('sidebar_effect',$theme_options);    
register_sidebar(array(
'name'          => __( 'Main Sidebar', 'medicom' ),
'id'            => 'sidebar-1',
'before_widget' => '<div class="'.$seffect.' sidebar-widget animated">',
'after_widget'  => '</div>',
'before_title'  => '<h2>',
'after_title'   => '</h2>',
));
}
add_action( 'widgets_init', 'medicom_sidebar' );

/******************************/
/* Footer Area Widget */
/******************************/
function medicom_widget() {

register_sidebar( array(
        'name' => __( 'Footer First', 'medicom' ),
        'id' => 'footer-first',
        'description' => __( 'Widget area for your footer', 'medicom' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><span>',
        'after_title' => '</span></h4>',
    ) );

register_sidebar( array(
        'name' => __( 'Footer Second', 'medicom' ),
        'id' => 'footer-second',
        'description' => __( 'Widget area for your footer', 'medicom' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><span>',
        'after_title' => '</span></h4>',
    ) );

register_sidebar( array(
        'name' => __( 'Footer Third', 'medicom' ),
        'id' => 'footer-third',
        'description' => __( 'Widget area for your footer', 'medicom' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><span>',
        'after_title' => '</span></h4>',
    ) );

register_sidebar( array(
        'name' => __( 'Footer Fourth', 'medicom' ),
        'id' => 'footer-fourth',
        'description' => __( 'Widget area for your footer', 'medicom' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><span>',
        'after_title' => '</span></h4>',
    ) );
}
add_action( 'widgets_init', 'medicom_widget' );

/*****************************/
/*    MEDICOM RECENT POST      */
/*****************************/
class Medicom_Recent_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site", 'medicom') );
        parent::__construct('medicom-recent-posts', __('Medicom Recent Posts', 'medicom'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'medicom') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 3;
        

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="popular-post-widget">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="popular-post">
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if (has_post_thumbnail()) {echo the_post_thumbnail('thumbnail');} ?></a>
                <h4><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h4>
                <p class="popular-date"><?php echo __('Posted ', 'medicom'); echo get_the_date(); ?></p>
                
            </article>
        <?php endwhile; ?>
        </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'medicom' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'medicom' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "Medicom_Recent_Posts" );' ) );

/**********************/
/*    Social Widget   */
/**********************/
function medicom_footer_social() {
if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}

$contact_social = '';
if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_facebook', $theme_options).'"><div class="socialbox"><i class="medicom-face"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_twitter', $theme_options).'"><div class="socialbox"><i class="medicom-tweet"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_google', $theme_options).'"><div class="socialbox"><i class="medicom-google"></i></div></a>';
}

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_dribbble', $theme_options).'"><div class="socialbox"><i class="medicom-dribble"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_youtube', $theme_options).'"><div class="socialbox"><i class="medicom-youtube"></i></div></a>';
}

if ( get_option_tree('social_vimeo', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_vimeo', $theme_options).'"><div class="socialbox"><i class="medicom-vine"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_linkedin', $theme_options).'"><div class="socialbox"><i class="fa fa-linkedin"></i></div></a>';
}

if ( get_option_tree('social_digg', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_digg', $theme_options).'"><div class="socialbox"><i class="medicom-digg"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="skype:'.get_option_tree('social_skype', $theme_options).'"><div class="socialbox"><i class="medicom-skype"></i></div></a>';
}

if ( get_option_tree('social_stumbleupon', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_stumbleupon', $theme_options).'"><div class="socialbox"><i class="medicom-stumbleupon"></i></div></a>';
}

if ( get_option_tree('social_pinterest', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_pinterest', $theme_options).'"><div class="socialbox"><i class="medicom-pinterest"></i></div></a>';
}

if ( get_option_tree('social_flickr', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_flickr', $theme_options).'"><div class="socialbox"><i class="medicom-flicker"></i></div></a>';
}

if ( get_option_tree('social_rss', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_rss', $theme_options).'"><div class="socialbox"><i class="medicom-rss"></i></div></a>';
}

if ( get_option_tree('social_yahoo', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_yahoo', $theme_options).'"><div class="socialbox"><i class="medicom-yahoo"></i></div></a>';
}
if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a target= "_blank" href="'.get_option_tree('social_foursquare', $theme_options).'"><div class="socialbox"><i class="fa fa-foursquare"></i></div></a>';
} 

echo $contact_social;
} 

/****************************/
/*  MEDICOM POPULAR TAG LIST  */
/***************************/
class medicom_popular_tag extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'text_area_content', 'description' => __( "Add most used tags to Widget Area", 'medicom') );
        parent::__construct('medicom_tag_cloud', __('Medicom Tag Cloud', 'medicom'), $widget_ops);  
    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title !="" ) echo $before_title . $title . $after_title; ?>
            <div class="medicom-tag-cloud">
               <?php wp_tag_cloud('unit=px&smallest=13&largest=13&number=10&format=list'); ?>
            </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
    }   

        function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = strip_tags($instance['title']);
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'medicom'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "medicom_popular_tag" );' ) );

/**********************/
/* MEDICOM GET IN TOUCH */
/**********************/
class medicom_get_in_touch extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'text_area_content', 'description' => __( "Get In Touch Widget for Footer", 'medicom') );
        parent::__construct('medicom_get_in_touch', __('Get In Touch Widget for Footer', 'medicom'), $widget_ops);
        $this->alt_option_name = 'medicom_get_in_touch_content';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_text_footer', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Text Box' : $instance['title'], $instance, $this->id_base);
        $content = apply_filters( 'widget_text', empty( $instance['content'] ) ? '' : $instance['content'], $instance );
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        
            <div class="contact-widget">
                <?php echo !empty( $instance['filter'] ) ? wpautop( $content ) : $content; ?>
            </div>
        
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_text_footer', $cache, 'widget');
    }   

function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        if ( current_user_can('unfiltered_html') )
            $instance['content'] =  $new_instance['content'];
        else
            $instance['content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['content']) ) ); // wp_filter_post_kses() expects slashed
        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_text_footer', 'widget');
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '' ) );
        $title = strip_tags($instance['title']);
        $content = esc_textarea($instance['content']);
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'medicom'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'medicom'); ?></label></p>
<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "medicom_get_in_touch" );' ) );

/*********************************/
/*           Comment             */
/*********************************/
if ( ! function_exists( 'medicom_comment' ) ) :
function medicom_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'medicom' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'medicom' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="media">
                    <div class="pull-left">            
                        <?php echo get_avatar( $comment, 64 ); ?>
                    </div>
                    <div class="media-body">
                    <?php printf( __( '%s', 'medicom' ), sprintf( '<h5 class="media-heading"><span>%s</span></h5>', get_comment_author_link() ) ); ?>
                    <p class="comment-date">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                        <?php
                            /* translators: 1: date, 2: time */
                            printf( __( '%1$s at %2$s', 'medicom' ), get_comment_date(), get_comment_time() ); ?>
                        </time></a>
                    </p>
                    <p><?php comment_text(); ?></p>
                    <p class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> <?php edit_comment_link( __( '(Edit)', 'medicom' ), ' ' );
                    ?><span>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'medicom' ); ?></em>
                    <?php endif; ?>
                    </div>
            
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for medicom_comment()

/*** Comment Form ***/
function medicom_alter_comment_form_fields(){
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(
        'author' => '<div class="col-md-4 form-group">'  .
                    '<input id="author" class="required form-control" name="author" type="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />'.'</div>',
        'email'  => '<div class="col-md-4 form-group">' .
                    '<input id="email" class="required form-control" name="email" type="text" placeholder="Email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div>',
        'url'    => '<div class="col-md-4 form-group">' .
                    '<input id="url" class="form-control" name="url" type="text" placeholder="URL" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/>'.'</div>',
    );
    return $fields;
}

add_filter('comment_form_default_fields','medicom_alter_comment_form_fields');

function medicom_defaults_comment_form($defaults) {
$defaults['comment_field'] = '<div class="clearfix"></div><div class="col-md-12 form-group"><textarea class="required form-control" rows="11" id="comment" name="comment" aria-required="true"></textarea></div>';
$defaults['comment_notes_after'] = "";
$defaults['comment_notes_before'] = "";
$defaults['label_submit'] = __('SUBMIT', 'medicom');
$defaults['title_reply'] = __('Leave a <span>Reply</span>', 'medicom');
    return $defaults;
}
add_filter('comment_form_defaults','medicom_defaults_comment_form');
/********************************/
/*         Pagination           */
/********************************/
function medicom_pagination($pages = '', $range = 4)
{  
    global $wp_query;

                        $big = 999999999; // need an unlikely integer

                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'type'         => 'list'
                        ) );
}

function medicom_custom_nextpage_links($defaults) {
$args = array(
'before' => '<div class="pagination-container"><div class="post-pagination">',
'after' => '</div></div>',
'link_before'      => '<span>',
'link_after'       => '</span>'
);
$r = wp_parse_args($args, $defaults);
return $r;
}
add_filter('wp_link_pages_args','medicom_custom_nextpage_links');

/*******************************/
/* Add Gallery to Wordpress  */
/*******************************/
    add_action('init', 'medicom_create_gallery');
    function medicom_create_gallery() {
        $args = array(
            'label' => 'Gallery',
            'singular_label' => 'gallery',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
          	'taxonomies' => array('post_tag'),
            'supports' => array('title', 'editor', 'thumbnail')
        );
        register_post_type('gallery',$args);
        register_taxonomy("gallery-category", array("gallery"), array("hierarchical" => true, "label" => "Gallery Category", "singular_label" => "gallery_category", "rewrite" => true));
    }

/*********************************/
/* Add Testimonial to Wordpress  */
/*********************************/
    add_action('init', 'medicom_create_testimonial');
    function medicom_create_testimonial() {
        $args = array(
            'label' => 'Testimonial',
            'singular_label' => 'testimonial',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'register_meta_box_cb' => 'add_testimonial_metaboxes' 
        );
        register_post_type('testimonial',$args);
    }

    function add_testimonial_metaboxes() {
    add_meta_box('testimonial_project', 'Project', 'testimonial_project', 'testimonial', 'side', 'default');
    }

    function testimonial_project() {
    global $post;
    
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="testimonialmeta_noncename" id="testimonialmeta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    // Get the link data if its already been entered
    $clientname = get_post_meta($post->ID, '_clientname', true);
    $job = get_post_meta($post->ID, '_job', true);
    // Echo out the field
    echo '<p>Name:</p>';
    echo '<input type="text" name="_clientname" value="' . $clientname  . '" class="widefat" />';
    echo '<p>Job:</p>';
    echo '<input type="text" name="_job" value="' . $job  . '" class="widefat" />';
    }

    // Save the Metabox Data

    function save_testimonial_data($post_id, $post) {
    
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( isset($_POST['testimonialmeta_noncename']) && !wp_verify_nonce( $_POST['testimonialmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $testimonial_meta = array();
    if ( isset($_POST['_clientname'])) {
    $testimonial_meta['_clientname'] = $_POST['_clientname']; }
    if ( isset($_POST['_job'])) {
    $testimonial_meta['_job'] = $_POST['_job']; }
    // Add values of $testimonial_meta as custom fields
    
    foreach ($testimonial_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
    }

add_action('save_post', 'save_testimonial_data', 1, 2); // save the custom fields
/***********************/
/* Twitter Widget      */
/**********************/
function twitter_medicom() {
$theme_options = get_option('option_tree');
$access_token = get_option_tree('access_token',$theme_options);
$access_token_secret = get_option_tree('access_token_secret',$theme_options);
$consumer_key = get_option_tree('consumer_key',$theme_options);
$consumer_secret = get_option_tree('consumer_secret',$theme_options);
$twitter_user_name = get_option_tree('twitter_user_name',$theme_options);

// Setting our Authentication Variables that we got after creating an application
$settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
);

// We are using GET Method to Fetch the latest tweets.
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// Set your screen_name to your twitter screen name. Also set the count to the number of tweets you want to be fetched. Here we are fetching 5 latest tweets.
$getfield = '?screen_name='.$twitter_user_name.'&count=3';
$requestMethod = 'GET';

// Making an object to access our library class
$twitter = new TwitterAPIExchange($settings);
$store = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
// Since the returned result is in json format, we need to decode it             
  $result = json_decode($store);

// After decoding, we have an standard object array, so we can print each tweet into a list item.
  $multi_array = objectToArray($result);
  if( !empty($multi_array)) {
 foreach($multi_array as $key => $value ){
   
// The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // The Text you want to filter for urls
    $text = $value["text"];

    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $text, $url)) {

           // make the urls hyper links
           echo '<div class="twitter-widget"><div class="tweet"><i class="medicom-tweet icon-2x pull-left bird"></i><p>'. preg_replace($reg_exUrl, "<a href='$url[0]'>{$url[0]}</a> ", $text) . '</p></div></div>';

    } else {

           // if no urls in the text just return the text
           echo '<div class="twitter-widget"><div class="tweet"><i class="medicom-tweet icon-2x pull-left bird"></i><p>'. $text . '</p></div></div>';

    }
 }
}
}

/**********************/
/* Twitter Widget */
/**********************/
class medicom_twitter_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'text_area_content', 'description' => __( "Twitter Widget", 'medicom') );
        parent::__construct('twitter_widget', __('Twitter Widget', 'medicom'), $widget_ops);
        $this->alt_option_name = 'mukam_twittery';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_text_footer', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Text Box' : $instance['title'], $instance, $this->id_base);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        
            <?php echo twitter_medicom(); ?>
        
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_text_footer', $cache, 'widget');
    }   

function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_text_footer', 'widget');
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
        
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'medicom'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "medicom_twitter_widget" );' ) );
/*********************************/
/* CUSTOM PAGE BUILDER ELEMENT * /
/********************************/
if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
include ('includes/shortcodes.php');
}

/***********************************/
/* OVERRIDE VISUAL COMPOSER TITLE  */
/***********************************/
add_filter('wpb_widget_title', 'medicom_override_widget_title', 10, 2);
function medicom_override_widget_title($output = '', $params = array('')) {
  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
  return '<h2 class="entry-title'.$extraclass.'">'.$params['title'].'</h2>';
}
/*****************************/
/* ADD CAPTION IMAGE TO PAGE */
/*****************************/
function medicom_caption_image ($id) {
    if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
		}
    $thumb_id = get_post_thumbnail_id($id);
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url = $thumb_url_array[0];
    $overlay ="";
    $medicom_overlay = get_option_tree('overlay',$theme_options);
    if (isset($medicom_overlay)) {
      if(!empty($medicom_overlay)) {
    $overlay = 'url('.$medicom_overlay.')';
        }
    }
    else {
    $overlay = 'url('.get_template_directory_uri().'/img/blue-overlay.png)';
    }
    if (has_post_thumbnail()) { 
    $background = 'style="background: '.$overlay.' repeat, url('.$thumb_url.') no-repeat center;"';
    echo $background;
    }
    else {
    $background = 'style="background: '.$overlay.';"';
    echo $background;
    }
}