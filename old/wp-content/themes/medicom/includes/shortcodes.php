<?php
add_action( 'vc_before_init', 'medicom_init_shortcodes' );
function medicom_init_shortcodes() {
function medicom_absolute_image($atts) {
   extract(shortcode_atts ( array(
    'image' => '',
    'link' => '',
    'title' => '',
    'top' => '',
    'left' => '',
    'right' => '',
    'bottom' => '',
   ), 
   $atts));
                           
  $img_id = preg_replace('/[^\d]/', '', $image);
  $image_url = wp_get_attachment_image_src( $img_id, 'full');
  $image_url = $image_url[0];
  $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true); 
   if (!empty($top)) {
   $top = 'margin-top:'.$top.';';  
   }
   if (!empty($left)) {
   $left = 'margin-left:'.$left.';';  
   }
   if (!empty($right)) {
   $right = 'margin-right:'.$right.';';  
   }
   if (!empty($bottom)) {
   $bottom = 'margin-bottom:'.$bottom.';';  
   }
   $style = 'style = "'.$top.''.$bottom.''.$left.''.$right.'"';                 
   return '<div class="absolute_image" '.$style.'><div class="abs_image"><img src="'.$image_url.'" alt="'.$alt.'"><div class="abs_cover"><a href="'.$link.'"><i class="fa fa-eye"></i></a></div></div><p>'.$title.'</p></div>';
}
add_shortcode('medicom_absolute_image', 'medicom_absolute_image');
vc_map( array(
   "name" => __("Absolute Image", 'medicom'),
   "base" => "medicom_absolute_image",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
     
    array(
      "type" => "attach_image",
      "heading" => __("Image", "medicom"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "medicom")
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'medicom'),
        "param_name" => "link",
        "value" => __("http://", 'medicom'),
        "description" => __("Add Link to your image", "medicom")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "title",
        "description" => __("Add title for your image", "medicom")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Top", 'medicom'),
        "param_name" => "top",
        "description" => __("You can use px,% for your position of your image, leave blank if it's not necessary", "medicom")
    ),  
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Bottom", 'medicom'),
        "param_name" => "bottom",
        "description" => __("You can use px,% for your position of your image, leave blank if it's not necessary", "medicom")
    ),  
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Left", 'medicom'),
        "param_name" => "left",
        "description" => __("You can use px,% for your position of your image, leave blank if it's not necessary", "medicom")
    ),  
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Right", 'medicom'),
        "param_name" => "right",
        "description" => __("You can use px,% for your position of your image, leave blank if it's not necessary", "medicom")
    ),  

   )
) );                           
                           
function medicom_list_services($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'right', 
    ), 
   $atts));

   if ( $style == "left") {
    return '<div class="services_lists left">'.do_shortcode($content).'</div>';
   }

   else {
    return '<div class="services_lists right">'.do_shortcode($content).'</div>';
   }

}
add_shortcode('medicom_list_services', 'medicom_list_services');

vc_map( array(
   "name" => __("Services List", 'medicom'),
   "base" => "medicom_list_services",
   "class" => "",
   "content_element" => true,
   "as_parent" => array('only' => 'medicom_list_service'),
   "js_view" => 'VcColumnView',
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services List Style", 'medicom'),
        "param_name" => "style",
        "value" => array( __('Icons on Right', "medicom") => "right", __('Icons on Left', "medicom") => "left"),
        "description" => __("Choose your services list style", 'medicom')
    )

   )
) );

 function medicom_list_service($atts) {
   extract(shortcode_atts ( array(
    'style' => 'paddless', 
    'icon' => '',
    'header' => '',
    'subtitle' => '',
    'link' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));
    $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   if ( $style == "padding") {
    return '<div class="'.$animation.' services_list padElement animated"'.$mydelay.'><div class="list_icon"><a href="'.$link.'"><i class="'.$icon.'"></i></a></div><div class="list_title">'.$header.'<span>'.$subtitle.'</span></div></div>';
   }

   else {
    return '<div class="'.$animation.' services_list animated"'.$mydelay.'><div class="list_icon"><a href="'.$link.'"><i class="'.$icon.'"></i></a></div><div class="list_title">'.$header.'<span>'.$subtitle.'</span></div></div>';
   }

}
add_shortcode('medicom_list_service', 'medicom_list_service');

vc_map( array(
   "name" => __("List Element", 'medicom'),
   "base" => "medicom_list_service",
   "class" => "",
   "content_element" => true,
   "as_child" => array('only' => 'medicom_list_services'),
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services List Style", 'medicom'),
        "param_name" => "style",
        "value" => array( __('Without Padding', "medicom") => "paddless", __('With Padding', "medicom") => "padding"),
        "description" => __("Choose your services list style", 'medicom')
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Icon", 'medicom'),
        "param_name" => "icon",
        "value" => __("medicom-sandtime", 'medicom'),
        "description" => __("Add icon to your title. Write icon name e.g. icon-moon, medicom-imac, medicom-clock2, icon-beaker", "medicom")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of Services, example: EMERGENCY", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Subtitle", 'medicom'),
        "param_name" => "subtitle",
        "value" => __("Subtitle", 'medicom'),
        "description" => __("Subtitle of Services, example: If you need a doctor for to consectetuer", 'medicom')
    ),    
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'medicom'),
        "param_name" => "link",
        "value" => __("http://", 'medicom'),
        "description" => __("Add link to your service box", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );

class WPBakeryShortCode_medicom_list_services extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_medicom_list_service extends WPBakeryShortCode {
}
/**** Services ****/
function medicom_services($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'services-1', 
    'icon' => '',
    'header' => '',
    'link' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

   $readmore =  __( 'READ MORE', 'medicom' );
   $learnmore = __( 'Learn more', 'medicom');
   if ( $style == "services-1") {
   $icon_size = ' icon-4x';
   $caret = $add_buton = '';  
   }
   if ( $style == "services-2" || $style == "services-5") {
   $icon_size = ' icon-2x';
   $caret = $add_buton = '';  
   }
   if ( $style == "services-3" ) {
   $caret = '<b class="caret"></b>';
   $icon_size = ' icon-2x';
   $add_buton = '<span class="buton b_inherit buton-2 buton-mini">'.$readmore.'</span>';
   }
   if ( $style == "services-4" ) {
   $caret = $add_buton = '';
   $icon_size = '';
   return '<div class="'.$animation.' services-4 animated"'.$mydelay.'><div class="holder"><i class="'.$icon.'"></i></div><div class="services-4-content"><h4>'.$header.'</h4><p>'.do_shortcode($content).'</p><a href="'.$link.'">-'.$learnmore.'</a></div></div>';
   }
   if ( $style != "services-4") {
   return '<div class="'.$animation.' '.$style.' animated"'.$mydelay.'><a href="'.$link.'"><div class="holder"><i class="'.$icon.' '.$icon_size.'"></i></div></a>'.$caret.'<h4>'.$header.'</h4><p>'.do_shortcode($content).'</p>'.$add_buton.'</div>';
   }

}
add_shortcode('medicom_service', 'medicom_services');

vc_map( array(
   "name" => __("Services", 'medicom'),
   "base" => "medicom_service",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Style", 'medicom'),
        "param_name" => "style",
        "value" => array(__('Four Column Big', "medicom") => "services-1", __('Four Column Small', "medicom") => "services-2", __('Four Column Small with Background', "medicom") => "services-5",  __('Three Column', "medicom") => "services-3",  __('Two Column', "medicom") => "services-4"),
        "description" => __("Choose your services style", 'medicom')
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Icon", 'medicom'),
        "param_name" => "icon",
        "value" => __("medicom-sandtime", 'medicom'),
        "description" => __("Add icon to your title. Write icon name e.g. icon-moon, medicom-imac, medicom-clock2, icon-beaker", "medicom")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of Services", 'medicom')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'medicom'),
        "param_name" => "content",
        "value" => __("This is your Content", 'medicom'),
        "description" => __("Write Content of Services", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'medicom'),
        "param_name" => "link",
        "value" => __("http://", 'medicom'),
        "description" => __("Add link to your service box", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );
/********************************/
/* Home Page Recent Post Widget */
/********************************/
function medicom_homepost($atts, $content = null) {
   extract(shortcode_atts ( array(
      'header' => '',
      'animation' => 'no_animation',
      'post_count' => '3',
      'delay' => '',
      'r' => ''
    ), 
   $atts));

   $mydelay = $after =  '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   $item_count = 1;
      if ( $post_count == "") {
        $post_count = 3;
      }
        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => $post_count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>
        <div class="blog-widget">
            <h2 class="<?php echo $animation ?> entry-title animated"<?php echo $mydelay;?>><?php echo $header ?></h2>
        <div id="hebele" class="blog-style-two-column">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="post-item">
              <div class="blog-thumbnail">
                <?php 
                  if ( has_post_format( 'video' )) {
                      medicom_video('453');?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                        <?php
                  } 

                  else if ( has_post_format( 'audio' )) {
                      medicom_audio();
                      ?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <?php
                  }

                  else if ( has_post_format( 'gallery' )) {
                      medicom_gallery($id);
                      ?>
                      <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
                      <?php
                  }   
                  else if (has_post_thumbnail()) { 
                      $thumb = get_post_thumbnail_id(); 
                      $image = vt_resize( $thumb, '', 805, 503, true );
                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                      $alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
                      ?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title_attribute(); ?>" />
                        <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>  
                      <?php } 
                ?>
              </div>
              <div class="blog-content">
              <h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              <p class="blog-meta"><?php echo __('By', 'medicom');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'medicom');?>: <?php the_tags( '', ', ', $after ); ?> </p>
              <p><?php if ($item_count % 2 == 1 ) { echo wp_trim_words( get_the_content(), 39 ); $item_count++; } else {  echo wp_trim_words( get_the_content(), 70 ); $item_count++; } ?></p>
              <span class="buton b_inherit buton-2 buton-mini"><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', 'medicom');?></a></span>
              </div>
            </article>
        <?php endwhile; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('latepost', 'medicom_homepost');

vc_map( array(
   "name" => __("Homepage Recent Posts", 'medicom'),
   "base" => "latepost",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of HomePage Recent Posts Widget", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Post Number", 'medicom'),
        "param_name" => "post_count",
        "value" => __("3", 'medicom'),
        "description" => __("Number of Post that you want to show", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );
/*********************************/
/* Home Page Recent Post Widget2 */
/*********************************/
function medicom_homepost_image($atts, $content = null) {
   extract(shortcode_atts ( array(
      'header' => '',
      'animation' => '',
      'post_count' => '3',
      'delay' => '',
      'r' => ''
    ), 
   $atts));     
    wp_register_script( 'resize', get_template_directory_uri() . '/js/jquery.ba-throttle-debounce.min.js', array('jquery'), '', true);
    wp_enqueue_script('resize');   

   $mydelay = $after = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
      if ( $post_count == "") {
        $post_count = 3;
      }
        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => $post_count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>
        <div class="blog-widget">
            <h2 class="<?php echo $animation ?> entry-title animated"<?php echo $mydelay;?>><?php echo $header ?></h2>
        <div class="latest-post-slider">
          
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article <?php post_class('post-item')?>>
              <div class="blog-content">
              <?php 
                  if (has_post_thumbnail()) { 
                       the_post_thumbnail( 'thumbnail', array('class' => 'minithumbnail') );
                  } 
                ?><h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              <p class="blog-meta"><?php the_time( 'j F, Y - g:i:s')?></p>
              <p class="hidden-mini"><?php echo wp_trim_words( get_the_content(), 13 ); ?><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', 'medicom');?></a></p>   
              </div>
            </article>
        <?php endwhile; ?>

        </div>
        
        <div class="slide-pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>
    </div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('latepostwithimage', 'medicom_homepost_image');

vc_map( array(
   "name" => __("Homepage Recent Posts 2", 'medicom'),
   "base" => "latepostwithimage",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of HomePage Recent Posts Widget", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Post Number", 'medicom'),
        "param_name" => "post_count",
        "value" => __("3", 'medicom'),
        "description" => __("Number of Post that you want to show", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );
/********************************/
/*    Testimonial Slider        */
/********************************/
function medicom_max_testimonial($atts, $content = null) {
   extract(shortcode_atts ( array(
      'style' => 'bVersion',
      'header' => '',
      'animation' => 'no_animation',
      'r' => ''
    ), 
   $atts));

        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'testimonial') );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>

        <div class="<?php echo $animation ?> happyclients <?php echo $style ?> animated">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="happyclientslider">
                  <ul class="slides">
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li>
                      <div class="clients-say">
                        <h1><span><?php echo $header ?></span></h1>
                        <?php if (has_post_thumbnail() && $style == "sVersion" ) {echo the_post_thumbnail('full');} ?><p><?php echo get_the_content(); ?><?php if ( $style == "sVersion" ) { ?> <br><span class="clientname"><?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,</span><span class="job"><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span><?php } ?></p>
                        
                        <?php if ( $style != "sVersion" ) { ?>
                        <div class="clientphoto"> 
                        <?php if (has_post_thumbnail()) {echo the_post_thumbnail('full');} ?>
                        </div>
                        
                        <div class="byclient">
                        <p class="byclient">
                          <?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,<br><span><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span>
                        </p>
                        </div> 
                        <?php } ?>
                        <div class="clearfix"></div>
                      </div>
                    </li>
                  <?php endwhile; ?>
                </ul>              
              </div>
            </div>
          </div>
      </div>
  </div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('max_testi', 'medicom_max_testimonial');

vc_map( array(
   "name" => __("Testimonial Slider", 'medicom'),
   "base" => "max_testi",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
     
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Slider Type", 'medicom'),
        "param_name" => "style",
        "value" => array(__('Big Slider', "medicom") => "bVersion", __('Mini Slider', "medicom") => "sVersion"),
        "description" => __("Choose your animation.", 'medicom')                   
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of Testimonial Widget", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    )
   )
) );

/**** Medicom Actionbox ****/
function medicom_actionbox($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'style1',
    'header' => '',
    'buton_quantity' => '1',
    'buton_type' => '',
    'buton_title' => 'b_asset',
    'buton_title_2' => '',
    'link' => '',
    'link2' => '',
    'icon' => '',
    'animation' => 'no_animation',
    'delay'=> ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

   if ($buton_quantity == 2 && $buton_type == 'b_white') {
    $buton2 = '<span class="buton b_white buton-2 buton-small"><a href="'.$link2.'">'.$buton_title_2.'</a></span>';
   }
   else if ($buton_quantity == 2 && $buton_type == 'b_asset') {
    $buton2 = '<span class="buton b_black buton-2 buton-small"><a href="'.$link2.'">'.$buton_title_2.'</a></span>';
   }

   else {
    $buton2='';
   }

   if ($style == 'style1') {
   return '<div class="call-to-action"><h2 class="'.$animation.' animated"'.$mydelay.'>'.$header.'</h2><p class="'.$animation.' animated"'.$mydelay.'>'.do_shortcode($content).'</p><span class="buton '.$buton_type.' buton-2 buton-small"><a href="'.$link.'">'.$buton_title.'</a></span>'.$buton2.'</div>';
   }
   else {
      return '
      <div class="call-to-action-2">
      <a href="'.$link.'"><span class="buton b_white buton-2 buton-small pull-right"><i class="'.$icon.'"></i>'.$buton_title.'</span></a><h4 class="'.$animation.' animated"'.$mydelay.'>'.$header.'</h4>
      <p class="'.$animation.' animated"'.$mydelay.'>'.do_shortcode($content).'</p>
      </div>';

   }

}
add_shortcode('medicom_action', 'medicom_actionbox');

vc_map( array(
   "name" => __("Medicom Actionbox", 'medicom'),
   "base" => "medicom_action",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Actionbox Style", 'medicom'),
        "param_name" => "style",
        "value" => array(__('Actionbox 1', "medicom") => "style1",  __('Actionbox 2', "medicom") => "style2"),
        "description" => __("Choose your actionbox style", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'medicom'),
        "param_name" => "header",
        "value" => __("Title", 'medicom'),
        "description" => __("Title of Actionbox", 'medicom')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'medicom'),
        "param_name" => "content",
        "value" => __("This is your Content", 'medicom'),
        "description" => __("Write Content of Actionbox", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Icon", 'medicom'),
        "param_name" => "icon",
        "value" => __("medicom-sandtime", 'medicom'),
        "description" => __("Add icon to your button. Write icon name e.g. icon-moon, medicom-imac, medicom-clock2, icon-beaker", "medicom"),
        "dependency" => Array('element' => "style", 'value' => 'style2')
    ),    
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Style", 'medicom'),
        "param_name" => "buton_type",
        "value" => array(__('Asset', "medicom") => "b_asset",  __('White', "medicom") => "b_white"),
        "description" => __("Choose your buton style", 'medicom'),
        "dependency" => Array('element' => "style", 'value' => 'style1')
    ),

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Buton Quantity", 'medicom'),
        "param_name" => "buton_quantity",
        "value" => array(__('1', "medicom") => "1",  __('2', "medicom") => "2"),
        "description" => __("Choose your quantity", "medicom"),
        "dependency" => Array('element' => "style", 'value' => 'style1')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Title", 'medicom'),
        "param_name" => "buton_title",
        "value" => __("View More", 'medicom'),
        "description" => __("Add title to your button", 'medicom')
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'medicom'),
        "param_name" => "link",
        "value" => __("http://", 'medicom'),
        "description" => __("Add link to your button", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Title 2", 'medicom'),
        "param_name" => "buton_title_2",
        "value" => __("View More", 'medicom'),
        "description" => __("Add title to your button", 'medicom'),
        "dependency" => Array('element' => "buton_quantity", 'value' => array('2'))
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link 2", 'medicom'),
        "param_name" => "link2",
        "value" => __("http://", 'medicom'),
        "description" => __("Add link to your button", 'medicom'),
        "dependency" => Array('element' => "buton_quantity", 'value' => array('2'))
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );
/**********************/
/**** Medicom Team ****/
/**********************/
function medicom_team($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'nosocial',
    'pname' => '',
    'position' => '',
    'photo' => '',
    'linkedin_account' => '',
    'google_account' => '',
    'twitter_account' => '',
    'face_account' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));

   $mydelay = $all_social = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

  $img_id = preg_replace('/[^\d]/', '', $photo);
  $image_url = wp_get_attachment_image_src( $img_id, 'full');
  $image_url = $image_url[0];
  $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
   if ( !empty($linkedin_account)) {
    $linkedin_account = '<li class="team-holder m_link"><a href="'.$linkedin_account.'"><i class="fa fa-linkedin"></i></a></li>';
   }
   if ( !empty($google_account)) {
    $google_account = '<li class="team-holder m_google"><a href="'.$google_account.'"><i class="medicom-google"></i></a></li>';
   }
   if ( !empty($twitter_account)) {
    $twitter_account = '<li class="team-holder m_tweet"><a href="'.$twitter_account.'"><i class="medicom-tweet"></i></a></li>';
   }
   if ( !empty($face_account)) {
    $face_account = '<li class="team-holder m_facebook"><a href="'.$face_account.'"><i class="medicom-face"></i></a></li>';
   }
   
   if ( $style == "yesocial" ) {
   return '<div class="'.$animation.' medicom-team animated"'.$mydelay.'><img src="'.$image_url.'" alt="'.$alt.'"><div class="team-title"><ul class="team-social">'.$linkedin_account.''.$google_account.''.$twitter_account.''.$face_account.'</ul></div><div class="clearfix"></div></div>';
    }
   
   else {
   return '<div class="'.$animation.' medicom-team nosocial animated"'.$mydelay.'><div class="team-thumb"><img src="'.$image_url.'" alt="'.$alt.'"><ul class="team-social">'.$linkedin_account.''.$google_account.''.$twitter_account.''.$face_account.'</ul></div><div class="team-title"><div class="team-name"><p>   <span>'.$pname.'</span></p><p>'.$position.'</p></div></div><div class="clearfix"></div><div class="team-content"><p>'.do_shortcode($content).'</p></div></div>';   
    }
  
}
add_shortcode('m_team', 'medicom_team');
vc_map( array(
   "name" => __("Medicom Team", 'medicom'),
   "base" => "m_team",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Team Style", 'medicom'),
        "param_name" => "style",
        "value" => array(__('Style Without Social', "medicom") => "nosocial", __('Style With Social', "medicom") => "yesocial")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Name", 'medicom'),
        "param_name" => "pname",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Name", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Position", 'medicom'),
        "param_name" => "position",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Write person position/job", 'medicom')
    ),    
    array(
      "type" => "attach_image",
      "heading" => __("Photo", "medicom"),
      "param_name" => "photo",
      "value" => "",
      "description" => __("Select image from media library.", "medicom")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Linkedin", 'medicom'),
        "param_name" => "linkedin_account",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Linkedin Account URL", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Google", 'medicom'),
        "param_name" => "google_account",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Google Account URL", 'medicom')
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Facebook", 'medicom'),
        "param_name" => "face_account",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Facebook Account URL", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Twitter", 'medicom'),
        "param_name" => "twitter_account",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Twitter Account URL", 'medicom')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'medicom'),
        "param_name" => "content",
        "value" => __("This is your Content", 'medicom'),
        "description" => __("Something about me", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
   )
) );
/*********************************/
/*       Medicom Buttons          */
/*********************************/

function medicom_buttons($atts, $content = null) {
   extract(shortcode_atts ( array(
    'color' => 'b_blue', 
    'url' => '#',
    'transition' => 'buton-1',
    'b_size' => 'buton-mini'
    ), 
   $atts));
   return '<span class="buton '.$color.' '.$transition.' '.$b_size.'"><a href="'.$url.'">'.do_shortcode($content).'</a></span>';
}
add_shortcode('mbuttons', 'medicom_buttons');
vc_map( array(
   "name" => __("Medicom Buttons", 'medicom'),
   "base" => "mbuttons",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array( 
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Color", 'medicom'),
        "param_name" => "color",
        "value" => array( __('Blue', "medicom") => "b_blue", __('Red', "medicom") => "b_red", __('Green', "medicom") => "b_green-1", __('Orange', "medicom") => "b_orange-1-dark", __('Light Orange', "medicom") => "b_orange-1", __('Purple', "medicom") => 'b_purple', __('Grey', "medicom") => "b_grey", __('Dark Grey', "medicom") => "b_darkgrey-1"),
        "description" => __("Choose your button color.", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Buton Size", 'medicom' ),
        "param_name" => "b_size",
        "value" => array( __('XS', "medicom") => "buton-mini", __('Small', "medicom") => "buton-small", __('Medium', "medicom") => "buton-medium", __('Large', "medicom") => "buton-large"),
    ),  
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Transition", 'medicom'),
        "param_name" => "transition",
        "value" => array(__('Left to Right', "medicom") => "buton-1", __('Top to Bottom', "medicom") => "buton-2", __('Fade Effect', "medicom") => "buton-3", __('Middle to Side', "medicom") => "buton-4", __('Middle to Corners', "medicom") => "buton-5", __('Middle to Top', "medicom") => "buton-6", ),
        "description" => __("Choose your button effect.", 'medicom')
    ),
     array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'medicom'),
        "param_name" => "content",
        "value" => __("Awesome Button", 'medicom'),
        "description" => __("Text on buttons", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button link", 'medicom'),
        "param_name" => "url",
        "value" => "http://themeforest.net",
        "description" => __("Link of your button.", 'medicom')
    )
    )
    ) );

/**********************************/
/* Contact Widget for Custom Page */
/**********************************/
function medicom_template_contacts($atts) {
   extract(shortcode_atts ( array(
    'title' => '',
    'telephone' => '',
    'email' => '',
    'web' => '',
    'time' => '',
    'address' => '',
    'social' => ''
    ), 
   $atts));

   if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}

$contact_social = '';
if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_facebook', $theme_options).'"><div class="socialbox"><i class="medicom-face"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_twitter', $theme_options).'"><div class="socialbox"><i class="medicom-tweet"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_google', $theme_options).'"><div class="socialbox"><i class="medicom-google"></i></div></a>';
}

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_dribbble', $theme_options).'"><div class="socialbox"><i class="medicom-dribble"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_youtube', $theme_options).'"><div class="socialbox"><i class="medicom-youtube"></i></div></a>';
}

if ( get_option_tree('social_vimeo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_vimeo', $theme_options).'"><div class="socialbox"><i class="medicom-vine"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_linkedin', $theme_options).'"><div class="socialbox"><i class="fa fa-linkedin"></i></div></a>';
}

if ( get_option_tree('social_digg', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_digg', $theme_options).'"><div class="socialbox"><i class="medicom-digg"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a href="skype:'.get_option_tree('social_skype', $theme_options).'"><div class="socialbox"><i class="medicom-skype"></i></div></a>';
}

if ( get_option_tree('social_stumbleupon', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_stumbleupon', $theme_options).'"><div class="socialbox"><i class="medicom-stumbleupon"></i></div></a>';
}

if ( get_option_tree('social_pinterest', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_pinterest', $theme_options).'"><div class="socialbox"><i class="medicom-pinterest"></i></div></a>';
}

if ( get_option_tree('social_flickr', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_flickr', $theme_options).'"><div class="socialbox"><i class="medicom-flicker"></i></div></a>';
}

if ( get_option_tree('social_rss', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_rss', $theme_options).'"><div class="socialbox"><i class="medicom-rss"></i></div></a>';
}

if ( get_option_tree('social_yahoo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yahoo', $theme_options).'"><div class="socialbox"><i class="medicom-yahoo"></i></div></a>';
}
if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_foursquare', $theme_options).'"><div class="socialbox"><i class="fa fa-foursquare"></i></div></a>';
}

if ( get_option_tree('social_yelp', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yelp', $theme_options).'"><div class="socialbox"><i class="icomoon-yelp"></i></div></a>';
}
   if( $social == 'yes') {
    $social = $contact_social;
   }

   else {
    $social = '';
   }

   if(!empty($telephone)){
   $tel ='<i class="medicom-telephone pull-left widget-icon"></i><p>'.$telephone.'</p>';
   }

   if(!empty($email)){
   $mail ='<i class="medicom-envelope pull-left widget-icon"></i><p>'.$email.'</p>';
   }

   if(!empty($web)){
   $site ='<i class="medicom-globe pull-left widget-icon"></i><p><a href="http://'.$web.'">'.$web.'</a></p>';
   }

   if(!empty($time)){
   $zone ='<i class="medicom-clock pull-left widget-icon"></i><p>'.$time.'</p>';
   }

   if(!empty($telephone)){
   $adress ='<i class="medicom-direction pull-left widget-icon"></i><p>'.$address.'</p>';
   } 

   return '<div class="contact-info"><h3>'.$title.'</h3><div class="contact-widget">'.$tel.$mail.$site.$zone.$adress.'</div><div class="social-widget">'.$social.'</div></div>';
}
add_shortcode('template_contact', 'medicom_template_contacts');
vc_map( array(
   "name" => __("Contact Info", 'medicom'),
   "base" => "template_contact",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Title", 'medicom'),
        "param_name" => "title",
        "value" => __("fill this space", 'medicom')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Phone", 'medicom'),
        "param_name" => "telephone",
        "value" => __("fill this space", 'medicom')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("E-Mail", 'medicom'),
        "param_name" => "email",
        "value" => __("fill this space", 'medicom')
    ),    
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Url", 'medicom'),
        "param_name" => "web",
        "value" => __("fill this space", 'medicom'),
        "description" => __("Dont write http://, write your url starting with www.", 'medicom')

    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Business Hours", 'medicom'),
        "param_name" => "time",
        "value" => __("fill this space", 'medicom')
    ),
        array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Address", 'medicom'),
        "param_name" => "address",
        "value" => __("fill this space", 'medicom')
    ),
        array(
        "type" => 'checkbox',
        "heading" => __("Add your social", "medicom"),
        "param_name" => "social",
        "description" => __("Add your social to contact.", "medicom"),
        "value" => Array(__("Yes, please", "medicom") => 'yes')
    )    
    )
));
/****************************/
/*  TABLES CONTAINER&HEAD  */
/***************************/
function medicom_tables($atts, $content = null) {
    extract(shortcode_atts( array(
        'delay' => '',
        'animation' => 'no_animation'       
    ),
    $atts));

    $mydelay = '';
    if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
    }
    return '<div class="'.$animation.' medicom-table animated"'.$mydelay.'>'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'medicom_table', 'medicom_tables' );
vc_map( array(
   "name" => __("Medicom Price Tables", 'medicom'),
   "base" => "medicom_table",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array(
        "type" => "textarea_html",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'medicom'),
        "param_name" => "content",
        "value" => "",
        "description" => __("Click Row icon.", 'medicom')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'medicom'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "medicom") => "no_animation", __('Tada', "medicom") => "tadab-1 blind", __('Flip In X', "medicom") => "flipInX-1 blind", __('Flip In Y', "medicom") => "flipInY-1 blind", __('Fade In', "medicom") => "fadeIn-1 blind", __('Fade In Up', "medicom") => "fadeInUp-1 blind", __('Fade In Down', "medicom") => "fadeInDown-1 blind", __('Fade In Left', "medicom") => "fadeInLeft-1 blind", __('Fade In Right', "medicom") => "fadeInRight-1 blind", __('Fade In Up Big', "medicom") => "fadeInUpBig-1 blind", __('Fade In Down Big', "medicom") => "fadeInDownBig-1 blind", __('Fade In Left Big', "medicom") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "medicom") => "fadeInRightBig-1 blind", __('Bounce In', "medicom") => "bounceIn-1 blind", __('Bounce In Down', "medicom") => "bounceInDown-1 blind",  __('Bounce In Left', "medicom") => "bounceInLeft-1 blind", __('Bounce In Right', "medicom") => "bounceInRight-1 blind", __('Rotate In', "medicom") => "rotateIn-1 blind", __('Rotate In Down Left', "medicom") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "medicom") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "medicom") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "medicom") => "rotateInUpRight-1 blind", __('Light Speed In', "medicom") => "lightSpeedIn-1 blind", __('Roll In', "medicom") => "rollIn-1 blind", __('Special Effect 1', "medicom") => "blogeffect4-1 blind", __('Special Effect 2', "medicom") => "blogeffect5-1 blind", __('Special Effect 3', "medicom") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'medicom')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'medicom'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'medicom')
    )
    )
   ));

/****************************/
/*       TABLES ROW         */
/***************************/
function medicom_rows($atts, $content = null) {
  extract(shortcode_atts( array(
        'color' => '',
        'title' => ''
    ),
    $atts ));
  return '<div class="medicom-line '.$color.'"><p>'.$title.'<p>'.do_shortcode($content).'</div>';
}
add_shortcode('medicom_row', 'medicom_rows');
/****************************/
/*     TABLES PRICE ROW     */
/****************************/
function medicom_price_rows($atts) {
  extract(shortcode_atts( array(
        'color' => '',
        'price' => '',
        'title' => '',
        'subtitle' => '',
        'currency' => ''
    ),
    $atts ));
  return '<div class="price-line '.$color.'"><p>'.$title.'<p><p class="period">'.$subtitle.'</p><div class="price"><span class="mcurrency">'.$currency.'</span><span class="money">'.$price.'</span></div></div>';
}
add_shortcode('medicom_price_row', 'medicom_price_rows');


/*****************************/
/* ADD BUTTON TO WP EDITOR  */
/***************************/
add_action( 'init', 'medicom_tiny' );
function medicom_tiny() {
    add_filter( "mce_external_plugins", "medicom_add_buttons" );
    add_filter( 'mce_buttons', 'medicom_register_buttons' );
}
function medicom_add_buttons( $plugin_array ) {
    $plugin_array['medicom_tiny'] = get_template_directory_uri() . '/js/wpeditor.js';
    return $plugin_array;
}
function medicom_register_buttons( $buttons ) {
    array_push( $buttons, 'medicom_price_row', 'medicom_row', 'mbuttons' ); 
    return $buttons;
}
/*****************/
/*  Mini Social  */
/*****************/
function medicom_mini_social () {
$theme_options = get_option('option_tree');
$contact_social = '';

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_dribbble', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-dribble"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_google', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-google"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a href="skype:'.get_option_tree('social_skype', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-skype"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_youtube', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-youtube"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_twitter', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-tweet"></i></div></a>';
}

if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_facebook', $theme_options).'" target="_blank"><div class="social-box"><i class="medicom-face"></i></div></a>';
}

if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_foursquare', $theme_options).'" target="_blank"><div class="social-box"><i class="fa fa-foursquare"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_linkedin', $theme_options).'" target="_blank"><div class="social-box"><i class="fa fa-linkedin"></i></div></a>';
}

echo $contact_social;

}

/***********************/
/* Register Plugin CSS */
/***********************/

function medicom_plugin_style(){

   wp_enqueue_style( 'plugin_style', get_template_directory_uri().'/css/override.css' );

}
add_action('wp_footer', 'medicom_plugin_style');

/***************************************/
/* Divider */
/***************************************/
function medicom_dividers($atts) {
   extract(shortcode_atts ( array(
    'style' => 'horizontal_line', 
    ), 
   $atts));
   return '<div class="'.$style.'"></div>';
}
add_shortcode('medicom_dividers', 'medicom_dividers');
vc_map( array(
   "name" => __("Medicom Dividers", 'medicom'),
   "base" => "medicom_dividers",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Medicom Dividers", 'medicom'),
        "param_name" => "style",
        "value" => array( __('One Line', "medicom") => "horizontal_line", __('Three Line', "medicom") => "horizontal_threeline" ),
        "description" => __("Choose your divider.", 'medicom')
    )   
    ))
);


/***************************/
/*** Map Shortcode Address */
/***************************/
function map_config_option_text()
{}

function map_config_address(){
    printf(('<input type="text" id="map_config_address" name="map_config_address" value="%s" size="50"/>'), get_option('map_config_address'));
}

function map_config_infobox()
{
    printf(('<textarea name="map_config_infobox" id="map_config_infobox" cols="30" rows="3">%s</textarea>'), get_option('map_config_infobox'));
}

function map_config_zoom()
{
    printf(('<input name="map_config_zoom" id="map_config_zoom" value="%s" />'), get_option('map_config_zoom'));
}

function map_config_apikey() 
{
    printf(('<input name="map_config_apikey" id="map_config_apikey" value="%s" />'), get_option('map_config_apikey'));  
}
function map_config_menu(){

    add_settings_section('map_config', 'Map Configuration', 'map_config_option_text', 'general');
    add_settings_field('map_config_address', 'Address - Longitude and Lattitude', 'map_config_address', 'general', 'map_config');
    add_settings_field('map_config_infobox', 'Map InfoWindow', 'map_config_infobox', 'general', 'map_config');
    add_settings_field('map_config_zoom', 'Map Zoom Level', 'map_config_zoom', 'general', 'map_config');
    add_settings_field('map_config_apikey', 'Google Maps Api Key', 'map_config_apikey', 'general', 'map_config');    
}
add_action('admin_menu', 'map_config_menu');
function map_init()
{
    register_setting('general', 'map_config_address');
    register_setting('general', 'map_config_infobox');
    register_setting('general', 'map_config_zoom');
    register_setting('general', 'map_config_apikey');

}
add_action('admin_init', 'map_init');

function wpmap_map(){

    $googleapikey = 0;    
    $googleapikey = get_option('map_config_apikey');

    wp_register_script('google-maps', 'http://maps.googleapis.com/maps/api/js?key='.$googleapikey);
    wp_enqueue_script('google-maps');

    wp_register_script('map-css', get_template_directory_uri() . '/includes/map.js', '', '', true);
    wp_enqueue_script('map-css');

    $output = sprintf(('<div id="map-container" data-map-infowindow="%s" data-map-zoom="%s"></div>'),

        get_option('map_config_infobox'),
        get_option('map_config_zoom')

        );
    return $output;


}
add_shortcode('wpmap_map', 'wpmap_map');

function wpmap_directions(){

    $output = '<div id="dir-container" ></div>';
    return $output;

}
add_shortcode('wpmap_directions_container', 'wpmap_directions');

function wpmap_directions_input(){

    $address_to = get_option('map_config_address');
    $mapadress = __( 'Enter Your Address', 'medicom');
    $output = '<section id="directions" class="widget">
                <input id="from-input" type="text" value="" size="10" placeholder="'.$mapadress.'"/>
                <select class="hidden" onchange="" id="unit-input">
                    <option value="imperial" selected="selected">Imperial</option>
                    <option value="metric">Metric</option>
                </select>
                <input id="getDirections" type="button" value="Get Directions" onclick="WPmap.getDirections();"/>
                <input id="map-config-address" type="hidden" value="' . $address_to . '"/>
               </section>';
    return $output;
}
add_shortcode('wpmap_directions_input', 'wpmap_directions_input');
/***************************/
/* Visual Composer Updates */

/* Accordion Tabs Icon */
$setting_accordion = array (
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "medicom"),
      "param_name" => "title",
      "description" => __("Accordion section title.", "medicom")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Icon", "medicom"),
      "param_name" => "medicom_icon",
      "description" => __("Write a icon name for your title.", "medicom")
    )
    )
);
vc_map_update('vc_accordion_tab', $setting_accordion);


}