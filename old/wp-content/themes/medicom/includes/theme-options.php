<?php
add_action( 'admin_init', 'bliccaThemes_custom_theme_options' );
/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function bliccaThemes_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p><a href="http://wahabali.ticksy.com/">http://bliccathemes.ticksy.com</a></p>'
        )
      ),
      'sidebar'       => '<p><a href="http://wahabali.ticksy.com/">http://bliccathemes.ticksy.com</a></p>'
    ),
    'sections'        => array(
      array(
        'title'       => 'General Settings',
        'id'          => 'general_default'
      ),
      array(
        'title'       => 'Header Settings',
        'id'          => 'header_default'
      ),
      array(
        'title'       => 'Blog Settings',
        'id'          => 'blog_default'
      ),
      array(
        'title'       => 'Social Options',
        'id'          => 'social'
      ),
      array(
        'title'       => 'Footer Settings',
        'id'          => 'footer_default'
      ),
      array(
        'title'       => 'Font Settings',
        'id'          => 'font_settings_2'
      )         
    ),
    /* General Settings */
    'settings'        => array(
      array(
        'label'       => 'Favicon Upload',
        'id'          => 'favicon_upload',
        'type'        => 'upload',
        'desc'        => 'Upload a 16px x 16px .png or .gif image that will be your favicon.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Logo Upload',
        'id'          => 'logo_upload',
        'type'        => 'upload',
        'desc'        => 'Upload your logo image. (Best 200px x 44px)',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Caption Overlay',
        'id'          => 'overlay',
        'type'        => 'upload',
        'desc'        => 'Upload your image for caption image overlay.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Asset Color',
        'id'          => 'asset_color',
        'type'        => 'select',
        'desc'        => 'Select your asset color',
        'choices'     => array(
          array(
            'label'       => 'Blue',
            'value'       => 'main'
          ),
          array(
            'label'       => 'Red',
            'value'       => 'red'
          ),
          array(
            'label'       => 'Green',
            'value'       => 'green'
          ),
          array(
            'label'       => 'Orange',
            'value'       => 'orange'
          ),
          array(
            'label'       => 'Light Brown',
            'value'       => 'light-brown'
          ),
          array(
            'label'       => 'Purple',
            'value'       => 'purple'
          ),
          array(
            'label'       => 'Light Yellow',
            'value'       => 'light-yellow'
          ),
          array(
            'label'       => 'Yellow',
            'value'       => 'yellow'
          ),
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
    array(
        'label'       => 'Custom Asset Color',
        'id'          => 'custom_asset_color',
        'type'        => 'colorpicker',
        'desc'        => 'If you dont like our asset color, you can create your own color.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
     array(
        'label'       => 'Boxed Layout',
        'id'          => 'boxed_layout',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to enable fixed layout',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Background Image',
        'id'          => 'body_background',
        'type'        => 'upload',
        'desc'        => 'Upload image for body background.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Background Repeat',
        'id'          => 'background_repeat',
        'type'        => 'select',
        'desc'        => 'Select your background repeat',
        'choices'     => array(
          array(
            'label'       => 'No Repeat',
            'value'       => 'no-repeat'
          ),
          array(
            'label'       => 'Repeat',
            'value'       => 'repeat'
          ),
          array(
            'label'       => 'Repeat X',
            'value'       => 'repeat-x'
          ),
          array(
            'label'       => 'Repeat Y',
            'value'       => 'repeat-y'
          )
        ),
        'std'         => 'no-repeat',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
        ),
      array(
        'label'       => 'Disable Smooth Scroll',
        'id'          => 'disable_smooth_scrool',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to disable smooth scrool',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
  
      array(
        'label'       => 'Sidebar Widget Effect',
        'id'          => 'sidebar_effect',
        'type'        => 'select',
        'desc'        => 'Select your widget effect',
        'choices'     => array(
          array(
            'label'       => 'No Animation',
            'value'       => 'no_animation'
          ),
          array(
            'label'       => 'Special Effect 1',
            'value'       => 'blogeffect4-1 blindy'
          ),
          array(
            'label'       => 'Special Effect 2',
            'value'       => 'blogeffect5-1 blindy'
          ),
          array(
            'label'       => 'Special Effect 3',
            'value'       => 'blogeffect6-1 blindy'
          ),
          array(
            'label'       => 'Tada',
            'value'       => 'tadab-1 blindy'
          ),
          array(
            'label'       => 'Flip In X',
            'value'       => 'flipInX-1 blindy'
          ),
          array(
            'label'       => 'Flip In Y',
            'value'       => 'flipInY-1 blindy'
          ),
          array(
            'label'       => 'Fade In',
            'value'       => 'fadeIn-1 blindy'
          ),
          array(
            'label'       => 'Fade In Up',
            'value'       => 'fadeInUp-1 blindy'
          ),
          array(
            'label'       => 'Fade In Down',
            'value'       => 'fadeInDown-1 blindy'
          ),
          array(
            'label'       => 'Fade In Left',
            'value'       => 'fadeInLeft-1 blindy'
          ),
          array(
            'label'       => 'Fade In Right',
            'value'       => 'fadeInRight-1 blindy'
          ),
          array(
            'label'       => 'Fade In Up Big',
            'value'       => 'fadeInUpBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Down Big',
            'value'       => 'fadeInDownBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Left Big',
            'value'       => 'fadeInLeftBig-1 blindy'
          ),
          array(
            'label'       => 'Fade In Right Big',
            'value'       => 'fadeInRightBig-1 blindy'
          ),
          array(
            'label'       => 'Bounce In',
            'value'       => 'bounceIn-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Down',
            'value'       => 'bounceInDown-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Left',
            'value'       => 'bounceInLeft-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Right',
            'value'       => 'bounceInRight-1 blindy'
          ),
          array(
            'label'       => 'Rotate In',
            'value'       => 'rotateIn-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Left',
            'value'       => 'bounceInDownLeft-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Left',
            'value'       => 'rotateInDownLeft-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Down Right',
            'value'       => 'rotateInDownRight-1 blindy'
          ),
          array(
            'label'       => 'Rotate In Up Left',
            'value'       => 'bounceInUpLeft-1 blindy'
          ),
          array(
            'label'       => 'Bounce In Up Right',
            'value'       => 'bounceInUpRight-1 blindy'
          ),
          array(
            'label'       => 'Light Speen In',
            'value'       => 'lightSpeedIn-1 blindy'
          ),
          array(
            'label'       => 'Roll In',
            'value'       => 'bounceInUpRight-1 blindy'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
        ),
    array(
        'label'       => 'Custom CSS',
        'id'          => 'custom_css',
        'type'        => 'textarea-simple',
        'desc'        => 'If you want to customize main.css, paste your css code here. When you update the medicom, your custom css code does not disappear.',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
    array(
        'label'       => 'Google Analytics',
        'id'          => 'analytics',
        'type'        => 'textarea-simple',
        'desc'        => 'Paste your Google Analytics Code',
        'std'         => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      /* Header Settings */
      array(
        'label'       => 'Header Style',
        'id'          => 'header_style',
        'type'        => 'select',
        'desc'        => 'Select your header style from different options',
        'choices'     => array(
          array(
            'label'       => 'Header Style Classic',
            'value'       => 'header_style_1'
          ),
          array(
            'label'       => 'Header Style Plus',
            'value'       => 'header_style_2'
          ),
          array(
            'label'       => 'Header Style Easy',
            'value'       => 'header_style_8'
          ),
        ),
        'std'         => 'header_style_1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header_default'
      ),
      /* Blog Settings */
      array(
        'label'       => 'Blog Style',
        'id'          => 'blog_style',
        'type'        => 'select',
        'desc'        => 'Select your blog style from different options',
        'choices'     => array(
          array(
            'label'       => 'Big thumbnail with Right Sidebar',
            'value'       => 'big_thumbnail_right_sidebar'
          ),

          array(
            'label'       => 'Two Column with Right Sidebar',
            'value'       => 'two_column'
          ),
          array(
            'label'       => 'Two Column without Sidebar',
            'value'       => 'full_width'
          )
        ),
        'std'         => 'big_thumbnail_right_sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),
      array(
        'label'       => 'Blog Caption Background',
        'id'          => 'blog_bg',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),      
      array(
        'label'       => 'Default Blog Header',
        'id'          => 'blog_header',
        'type'        => 'text',
        'desc'        => 'Write a title for your blog header',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),array(
        'label'       => 'Default Blog Caption',
        'id'          => 'blog_caption',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_default'
      ),
      /* Social Settings*/
            array(
        'label'       => 'Twitter User Name',
        'id'          => 'twitter_user_name',
        'type'        => 'text',
        'desc'        => 'Twitter User Name that you want show latest tweet',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter Consumer Key',
        'id'          => 'consumer_key',
        'type'        => 'text',
        'desc'        => 'Your Twitter Consumer Key',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter Consumer Secret',
        'id'          => 'consumer_secret',
        'type'        => 'text',
        'desc'        => 'Your Twitter Consumer Secret',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter Access Token',
        'id'          => 'access_token',
        'type'        => 'text',
        'desc'        => 'Your Twitter Access Token',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter Access Token Secret',
        'id'          => 'access_token_secret',
        'type'        => 'text',
        'desc'        => 'Your Twitter Access Token Secret',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Your Social Network',
        'id'          => 'your_social_network',
        'type'        => 'textblock-titled',
        'desc'        => '<p>Paste the full url you\'d like the image to link</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Facebook',
        'id'          => 'social_facebook',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Flickr',
        'id'          => 'social_flickr',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Dribbble',
        'id'          => 'social_dribbble',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Google+',
        'id'          => 'social_google',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'LinkedIn',
        'id'          => 'social_linkedin',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Pinterest',
        'id'          => 'social_pinterest',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Digg',
        'id'          => 'social_digg',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Skype',
        'id'          => 'social_skype',
        'type'        => 'text',
        'desc'        => 'You should write as skype:username',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Twitter',
        'id'          => 'social_twitter',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Vimeo',
        'id'          => 'social_vimeo',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'YouTube',
        'id'          => 'social_youtube',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'RSS',
        'id'          => 'social_rss',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Stumbleupon',
        'id'          => 'social_stumbleupon',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
      array(
        'label'       => 'Yahoo',
        'id'          => 'social_yahoo',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),
    array(
        'label'       => 'Foursquare',
        'id'          => 'social_foursquare',
        'type'        => 'text',
        'desc'        => 'Full Url',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social'
      ),  
      /* Footer Section */  
       array(
        'label'       => 'Show Widget Section',
        'id'          => 'show_widget',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show widget section',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Show Copyright Section',
        'id'          => 'show_copyright',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show copyright section',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
       array(
        'label'       => 'Copyright Text',
        'id'          => 'copyright_text',
        'type'        => 'textarea-simple',
        'desc'        => '',
        'std'         => 'Copyright © 2013 medicom. All rights reserved.',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
      array(
        'label'       => 'Show Logo Area',
        'id'          => 'show_logo_area',
        'type'        => 'checkbox',
        'desc'        => 'Check if you want to show logo area',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
       array(
        'label'       => 'Footer Logo Upload',
        'id'          => 'footer_logo_upload',
        'type'        => 'upload',
        'desc'        => 'Upload your logo image. (Best 256px x 80px)',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
       array(
        'label'       => 'Company Text',
        'id'          => 'company_text',
        'type'        => 'textarea-simple',
        'desc'        => '',
        'std'         => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. the Lorem Ipsum has been the industry\'s standard dummy text ever since the you. Lorem Ipsum is simply dummy text of the printing and typesetting industry. the Lorem Ipsum has been the industry\'s standard dummy text ever since the you.',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_default'
      ),
    // Font Options
      array(
        'label'       => 'Body Typography',
        'id'          => 'body_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H1 Typography',
        'id'          => 'h1_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H2 Typography',
        'id'          => 'h2_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H3 Typography',
        'id'          => 'h3_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H4 Typography',
        'id'          => 'h4_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H5 Typography',
        'id'          => 'h5_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'H6 Typography',
        'id'          => 'h6_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'Header Logo Text',
        'id'          => 'header_logo_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      
      array(
        'label'       => 'Header Link',
        'id'          => 'header_link_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'Footer Title',
        'id'          => 'footer_title_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'Footer Content',
        'id'          => 'footer_p_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'Footer Copyright',
        'id'          => 'footer_copyright_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      ),
      array(
        'label'       => 'Sidebar Title',
        'id'          => 'sidebar_title_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font_settings_2'
      )        
      
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}

function filter_ot_recognized_font_families( $array, $field_id ) {

    $array = array(
      "Abel" => "Abel",
      "Abril Fatface" => "Abril Fatface",
      "Aclonica" => "Aclonica",
      "Acme" => "Acme",
      "Actor" => "Actor",
      "Adamina" => "Adamina",
      "Advent Pro" => "Advent Pro",
      "Aguafina Script" => "Aguafina Script",
      "Aladin" => "Aladin",
      "Aldrich" => "Aldrich",
      "Alegreya" => "Alegreya",
      "Alegreya SC" => "Alegreya SC",
      "Alex Brush" => "Alex Brush",
      "Alfa Slab One" => "Alfa Slab One",
      "Alice" => "Alice",
      "Alike" => "Alike",
      "Alike Angular" => "Alike Angular",
      "Allan" => "Allan",
      "Allerta" => "Allerta",
      "Allerta Stencil" => "Allerta Stencil",
      "Allura" => "Allura",
      "Almendra" => "Almendra",
      "Almendra SC" => "Almendra SC",
      "Amaranth" => "Amaranth",
      "Amatic SC" => "Amatic SC",
      "Amethysta" => "Amethysta",
      "Andada" => "Andada",
      "Andika" => "Andika",
      "Angkor" => "Angkor",
      "Annie Use Your Telescope" => "Annie Use Your Telescope",
      "Anonymous Pro" => "Anonymous Pro",
      "Antic" => "Antic",
      "Antic Didone" => "Antic Didone",
      "Antic Slab" => "Antic Slab",
      "Anton" => "Anton",
      "Arapey" => "Arapey",
      "Arbutus" => "Arbutus",
      "Architects Daughter" => "Architects Daughter",
      "Arimo" => "Arimo",
      "Arizonia" => "Arizonia",
      "Armata" => "Armata",
      "Artifika" => "Artifika",
      "Arvo" => "Arvo",
      "Asap" => "Asap",
      "Asset" => "Asset",
      "Astloch" => "Astloch",
      "Asul" => "Asul",
      "Atomic Age" => "Atomic Age",
      "Aubrey" => "Aubrey",
      "Audiowide" => "Audiowide",
      "Average" => "Average",
      "Averia Gruesa Libre" => "Averia Gruesa Libre",
      "Averia Libre" => "Averia Libre",
      "Averia Sans Libre" => "Averia Sans Libre",
      "Averia Serif Libre" => "Averia Serif Libre",
      "Bad Script" => "Bad Script",
      "Balthazar" => "Balthazar",
      "Bangers" => "Bangers",
      "Basic" => "Basic",
      "Battambang" => "Battambang",
      "Baumans" => "Baumans",
      "Bayon" => "Bayon",
      "Belgrano" => "Belgrano",
      "Belleza" => "Belleza",
      "Bentham" => "Bentham",
      "Berkshire Swash" => "Berkshire Swash",
      "Bevan" => "Bevan",
      "Bigshot One" => "Bigshot One",
      "Bilbo" => "Bilbo",
      "Bilbo Swash Caps" => "Bilbo Swash Caps",
      "Bitter" => "Bitter",
      "Black Ops One" => "Black Ops One",
      "Bokor" => "Bokor",
      "Bonbon" => "Bonbon",
      "Boogaloo" => "Boogaloo",
      "Bowlby One" => "Bowlby One",
      "Bowlby One SC" => "Bowlby One SC",
      "Brawler" => "Brawler",
      "Bree Serif" => "Bree Serif",
      "Bubblegum Sans" => "Bubblegum Sans",
      "Buda" => "Buda",
      "Buenard" => "Buenard",
      "Butcherman" => "Butcherman",
      "Butterfly Kids" => "Butterfly Kids",
      "Cabin" => "Cabin",
      "Cabin Condensed" => "Cabin Condensed",
      "Cabin Sketch" => "Cabin Sketch",
      "Caesar Dressing" => "Caesar Dressing",
      "Cagliostro" => "Cagliostro",
      "Calligraffitti" => "Calligraffitti",
      "Cambo" => "Cambo",
      "Candal" => "Candal",
      "Cantarell" => "Cantarell",
      "Cantata One" => "Cantata One",
      "Cardo" => "Cardo",
      "Carme" => "Carme",
      "Carter One" => "Carter One",
      "Caudex" => "Caudex",
      "Cedarville Cursive" => "Cedarville Cursive",
      "Ceviche One" => "Ceviche One",
      "Changa One" => "Changa One",
      "Chango" => "Chango",
      "Chau Philomene One" => "Chau Philomene One",
      "Chelsea Market" => "Chelsea Market",
      "Chenla" => "Chenla",
      "Cherry Cream Soda" => "Cherry Cream Soda",
      "Chewy" => "Chewy",
      "Chicle" => "Chicle",
      "Chivo" => "Chivo",
      "Coda" => "Coda",
      "Coda Caption" => "Coda Caption",
      "Codystar" => "Codystar",
      "Comfortaa" => "Comfortaa",
      "Coming Soon" => "Coming Soon",
      "Concert One" => "Concert One",
      "Condiment" => "Condiment",
      "Content" => "Content",
      "Contrail One" => "Contrail One",
      "Convergence" => "Convergence",
      "Cookie" => "Cookie",
      "Copse" => "Copse",
      "Corben" => "Corben",
      "Cousine" => "Cousine",
      "Coustard" => "Coustard",
      "Covered By Your Grace" => "Covered By Your Grace",
      "Crafty Girls" => "Crafty Girls",
      "Creepster" => "Creepster",
      "Crete Round" => "Crete Round",
      "Crimson Text" => "Crimson Text",
      "Crushed" => "Crushed",
      "Cuprum" => "Cuprum",
      "Cutive" => "Cutive",
      "Damion" => "Damion",
      "Dancing Script" => "Dancing Script",
      "Dangrek" => "Dangrek",
      "Dawning of a New Day" => "Dawning of a New Day",
      "Days One" => "Days One",
      "Delius" => "Delius",
      "Delius Swash Caps" => "Delius Swash Caps",
      "Delius Unicase" => "Delius Unicase",
      "Della Respira" => "Della Respira",
      "Devonshire" => "Devonshire",
      "Didact Gothic" => "Didact Gothic",
      "Diplomata" => "Diplomata",
      "Diplomata SC" => "Diplomata SC",
      "Doppio One" => "Doppio One",
      "Dorsa" => "Dorsa",
      "Dosis" => "Dosis",
      "Dr Sugiyama" => "Dr Sugiyama",
      "Droid Sans" => "Droid Sans",
      "Droid Sans Mono" => "Droid Sans Mono",
      "Droid Serif" => "Droid Serif",
      "Duru Sans" => "Duru Sans",
      "Dynalight" => "Dynalight",
      "EB Garamond" => "EB Garamond",
      "Eater" => "Eater",
      "Economica" => "Economica",
      "Electrolize" => "Electrolize",
      "Emblema One" => "Emblema One",
      "Emilys Candy" => "Emilys Candy",
      "Engagement" => "Engagement",
      "Enriqueta" => "Enriqueta",
      "Erica One" => "Erica One",
      "Esteban" => "Esteban",
      "Euphoria Script" => "Euphoria Script",
      "Ewert" => "Ewert",
      "Exo" => "Exo",
      "Expletus Sans" => "Expletus Sans",
      "Fanwood Text" => "Fanwood Text",
      "Fascinate" => "Fascinate",
      "Fascinate Inline" => "Fascinate Inline",
      "Federant" => "Federant",
      "Federo" => "Federo",
      "Felipa" => "Felipa",
      "Fjord One" => "Fjord One",
      "Flamenco" => "Flamenco",
      "Flavors" => "Flavors",
      "Fondamento" => "Fondamento",
      "Fontdiner Swanky" => "Fontdiner Swanky",
      "Forum" => "Forum",
      "Francois One" => "Francois One",
      "Fredericka the Great" => "Fredericka the Great",
      "Fredoka One" => "Fredoka One",
      "Freehand" => "Freehand",
      "Fresca" => "Fresca",
      "Frijole" => "Frijole",
      "Fugaz One" => "Fugaz One",
      "GFS Didot" => "GFS Didot",
      "GFS Neohellenic" => "GFS Neohellenic",
      "Galdeano" => "Galdeano",
      "Gentium Basic" => "Gentium Basic",
      "Gentium Book Basic" => "Gentium Book Basic",
      "Geo" => "Geo",
      "Geostar" => "Geostar",
      "Geostar Fill" => "Geostar Fill",
      "Germania One" => "Germania One",
      "Give You Glory" => "Give You Glory",
      "Glass Antiqua" => "Glass Antiqua",
      "Glegoo" => "Glegoo",
      "Gloria Hallelujah" => "Gloria Hallelujah",
      "Goblin One" => "Goblin One",
      "Gochi Hand" => "Gochi Hand",
      "Gorditas" => "Gorditas",
      "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
      "Graduate" => "Graduate",
      "Gravitas One" => "Gravitas One",
      "Great Vibes" => "Great Vibes",
      "Gruppo" => "Gruppo",
      "Gudea" => "Gudea",
      "Habibi" => "Habibi",
      "Hammersmith One" => "Hammersmith One",
      "Handlee" => "Handlee",
      "Hanuman" => "Hanuman",
      "Happy Monkey" => "Happy Monkey",
      "Henny Penny" => "Henny Penny",
      "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
      "Holtwood One SC" => "Holtwood One SC",
      "Homemade Apple" => "Homemade Apple",
      "Homenaje" => "Homenaje",
      "IM Fell DW Pica" => "IM Fell DW Pica",
      "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
      "IM Fell Double Pica" => "IM Fell Double Pica",
      "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
      "IM Fell English" => "IM Fell English",
      "IM Fell English SC" => "IM Fell English SC",
      "IM Fell French Canon" => "IM Fell French Canon",
      "IM Fell French Canon SC" => "IM Fell French Canon SC",
      "IM Fell Great Primer" => "IM Fell Great Primer",
      "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
      "Iceberg" => "Iceberg",
      "Iceland" => "Iceland",
      "Imprima" => "Imprima",
      "Inconsolata" => "Inconsolata",
      "Inder" => "Inder",
      "Indie Flower" => "Indie Flower",
      "Inika" => "Inika",
      "Irish Grover" => "Irish Grover",
      "Istok Web" => "Istok Web",
      "Italiana" => "Italiana",
      "Italianno" => "Italianno",
      "Jim Nightshade" => "Jim Nightshade",
      "Jockey One" => "Jockey One",
      "Jolly Lodger" => "Jolly Lodger",
      "Josefin Sans" => "Josefin Sans",
      "Josefin Slab" => "Josefin Slab",
      "Judson" => "Judson",
      "Julee" => "Julee",
      "Junge" => "Junge",
      "Jura" => "Jura",
      "Just Another Hand" => "Just Another Hand",
      "Just Me Again Down Here" => "Just Me Again Down Here",
      "Kameron" => "Kameron",
      "Karla" => "Karla",
      "Kaushan Script" => "Kaushan Script",
      "Kelly Slab" => "Kelly Slab",
      "Kenia" => "Kenia",
      "Khmer" => "Khmer",
      "Knewave" => "Knewave",
      "Kotta One" => "Kotta One",
      "Koulen" => "Koulen",
      "Kranky" => "Kranky",
      "Kreon" => "Kreon",
      "Kristi" => "Kristi",
      "Krona One" => "Krona One",
      "La Belle Aurore" => "La Belle Aurore",
      "Lancelot" => "Lancelot",
      "Lato" => "Lato",
      "League Script" => "League Script",
      "Leckerli One" => "Leckerli One",
      "Ledger" => "Ledger",
      "Lekton" => "Lekton",
      "Lemon" => "Lemon",
      "Lilita One" => "Lilita One",
      "Limelight" => "Limelight",
      "Linden Hill" => "Linden Hill",
      "Lobster" => "Lobster",
      "Lobster Two" => "Lobster Two",
      "Londrina Outline" => "Londrina Outline",
      "Londrina Shadow" => "Londrina Shadow",
      "Londrina Sketch" => "Londrina Sketch",
      "Londrina Solid" => "Londrina Solid",
      "Lora" => "Lora",
      "Love Ya Like A Sister" => "Love Ya Like A Sister",
      "Loved by the King" => "Loved by the King",
      "Lovers Quarrel" => "Lovers Quarrel",
      "Luckiest Guy" => "Luckiest Guy",
      "Lusitana" => "Lusitana",
      "Lustria" => "Lustria",
      "Macondo" => "Macondo",
      "Macondo Swash Caps" => "Macondo Swash Caps",
      "Magra" => "Magra",
      "Maiden Orange" => "Maiden Orange",
      "Mako" => "Mako",
      "Marck Script" => "Marck Script",
      "Marko One" => "Marko One",
      "Marmelad" => "Marmelad",
      "Marvel" => "Marvel",
      "Mate" => "Mate",
      "Mate SC" => "Mate SC",
      "Maven Pro" => "Maven Pro",
      "Meddon" => "Meddon",
      "MedievalSharp" => "MedievalSharp",
      "Medula One" => "Medula One",
      "Megrim" => "Megrim",
      "Merienda One" => "Merienda One",
      "Merriweather" => "Merriweather",
      "Metal" => "Metal",
      "Metamorphous" => "Metamorphous",
      "Metrophobic" => "Metrophobic",
      "Michroma" => "Michroma",
      "Miltonian" => "Miltonian",
      "Miltonian Tattoo" => "Miltonian Tattoo",
      "Miniver" => "Miniver",
      "Miss Fajardose" => "Miss Fajardose",
      "Modern Antiqua" => "Modern Antiqua",
      "Molengo" => "Molengo",
      "Monofett" => "Monofett",
      "Monoton" => "Monoton",
      "Monsieur La Doulaise" => "Monsieur La Doulaise",
      "Montaga" => "Montaga",
      "Montez" => "Montez",
      "Montserrat" => "Montserrat",
      "Moul" => "Moul",
      "Moulpali" => "Moulpali",
      "Mountains of Christmas" => "Mountains of Christmas",
      "Mr Bedfort" => "Mr Bedfort",
      "Mr Dafoe" => "Mr Dafoe",
      "Mr De Haviland" => "Mr De Haviland",
      "Mrs Saint Delafield" => "Mrs Saint Delafield",
      "Mrs Sheppards" => "Mrs Sheppards",
      "Muli" => "Muli",
      "Mystery Quest" => "Mystery Quest",
      "Neucha" => "Neucha",
      "Neuton" => "Neuton",
      "News Cycle" => "News Cycle",
      "Niconne" => "Niconne",
      "Nixie One" => "Nixie One",
      "Nobile" => "Nobile",
      "Nokora" => "Nokora",
      "Norican" => "Norican",
      "Nosifer" => "Nosifer",
      "Nothing You Could Do" => "Nothing You Could Do",
      "Noticia Text" => "Noticia Text",
      "Nova Cut" => "Nova Cut",
      "Nova Flat" => "Nova Flat",
      "Nova Mono" => "Nova Mono",
      "Nova Oval" => "Nova Oval",
      "Nova Round" => "Nova Round",
      "Nova Script" => "Nova Script",
      "Nova Slim" => "Nova Slim",
      "Nova Square" => "Nova Square",
      "Numans" => "Numans",
      "Nunito" => "Nunito",
      "Odor Mean Chey" => "Odor Mean Chey",
      "Old Standard TT" => "Old Standard TT",
      "Oldenburg" => "Oldenburg",
      "Oleo Script" => "Oleo Script",
      "Open Sans" => "Open Sans",
      "Open Sans Condensed" => "Open Sans Condensed",
      "Orbitron" => "Orbitron",
      "Original Surfer" => "Original Surfer",
      "Oswald" => "Oswald",
      "Over the Rainbow" => "Over the Rainbow",
      "Overlock" => "Overlock",
      "Overlock SC" => "Overlock SC",
      "Ovo" => "Ovo",
      "Oxygen" => "Oxygen",
      "PT Mono" => "PT Mono",
      "PT Sans" => "PT Sans",
      "PT Sans Caption" => "PT Sans Caption",
      "PT Sans Narrow" => "PT Sans Narrow",
      "PT Serif" => "PT Serif",
      "PT Serif Caption" => "PT Serif Caption",
      "Pacifico" => "Pacifico",
      "Parisienne" => "Parisienne",
      "Passero One" => "Passero One",
      "Passion One" => "Passion One",
      "Patrick Hand" => "Patrick Hand",
      "Patua One" => "Patua One",
      "Paytone One" => "Paytone One",
      "Permanent Marker" => "Permanent Marker",
      "Petrona" => "Petrona",
      "Philosopher" => "Philosopher",
      "Piedra" => "Piedra",
      "Pinyon Script" => "Pinyon Script",
      "Plaster" => "Plaster",
      "Play" => "Play",
      "Playball" => "Playball",
      "Playfair Display" => "Playfair Display",
      "Podkova" => "Podkova",
      "Poiret One" => "Poiret One",
      "Poller One" => "Poller One",
      "Poly" => "Poly",
      "Pompiere" => "Pompiere",
      "Pontano Sans" => "Pontano Sans",
      "Port Lligat Sans" => "Port Lligat Sans",
      "Port Lligat Slab" => "Port Lligat Slab",
      "Prata" => "Prata",
      "Preahvihear" => "Preahvihear",
      "Press Start 2P" => "Press Start 2P",
      "Princess Sofia" => "Princess Sofia",
      "Prociono" => "Prociono",
      "Prosto One" => "Prosto One",
      "Puritan" => "Puritan",
      "Quantico" => "Quantico",
      "Quattrocento" => "Quattrocento",
      "Quattrocento Sans" => "Quattrocento Sans",
      "Questrial" => "Questrial",
      "Quicksand" => "Quicksand",
      "Qwigley" => "Qwigley",
      "Radley" => "Radley",
      "Raleway" => "Raleway",
      "Rammetto One" => "Rammetto One",
      "Rancho" => "Rancho",
      "Rationale" => "Rationale",
      "Redressed" => "Redressed",
      "Reenie Beanie" => "Reenie Beanie",
      "Revalia" => "Revalia",
      "Ribeye" => "Ribeye",
      "Ribeye Marrow" => "Ribeye Marrow",
      "Righteous" => "Righteous",
      "Rochester" => "Rochester",
      "Rock Salt" => "Rock Salt",
      "Rokkitt" => "Rokkitt",
      "Ropa Sans" => "Ropa Sans",
      "Rosario" => "Rosario",
      "Rosarivo" => "Rosarivo",
      "Rouge Script" => "Rouge Script",
      "Ruda" => "Ruda",
      "Ruge Boogie" => "Ruge Boogie",
      "Ruluko" => "Ruluko",
      "Ruslan Display" => "Ruslan Display",
      "Russo One" => "Russo One",
      "Ruthie" => "Ruthie",
      "Sail" => "Sail",
      "Salsa" => "Salsa",
      "Sancreek" => "Sancreek",
      "Sansita One" => "Sansita One",
      "Sarina" => "Sarina",
      "Satisfy" => "Satisfy",
      "Schoolbell" => "Schoolbell",
      "Seaweed Script" => "Seaweed Script",
      "Sevillana" => "Sevillana",
      "Shadows Into Light" => "Shadows Into Light",
      "Shadows Into Light Two" => "Shadows Into Light Two",
      "Shanti" => "Shanti",
      "Share" => "Share",
      "Shojumaru" => "Shojumaru",
      "Short Stack" => "Short Stack",
      "Siemreap" => "Siemreap",
      "Sigmar One" => "Sigmar One",
      "Signika" => "Signika",
      "Signika Negative" => "Signika Negative",
      "Simonetta" => "Simonetta",
      "Sirin Stencil" => "Sirin Stencil",
      "Six Caps" => "Six Caps",
      "Slackey" => "Slackey",
      "Smokum" => "Smokum",
      "Smythe" => "Smythe",
      "Sniglet" => "Sniglet",
      "Snippet" => "Snippet",
      "Sofia" => "Sofia",
      "Sonsie One" => "Sonsie One",
      "Sorts Mill Goudy" => "Sorts Mill Goudy",
      "Special Elite" => "Special Elite",
      "Spicy Rice" => "Spicy Rice",
      "Spinnaker" => "Spinnaker",
      "Spirax" => "Spirax",
      "Squada One" => "Squada One",
      "Stardos Stencil" => "Stardos Stencil",
      "Stint Ultra Condensed" => "Stint Ultra Condensed",
      "Stint Ultra Expanded" => "Stint Ultra Expanded",
      "Stoke" => "Stoke",
      "Sue Ellen Francisco" => "Sue Ellen Francisco",
      "Sunshiney" => "Sunshiney",
      "Supermercado One" => "Supermercado One",
      "Suwannaphum" => "Suwannaphum",
      "Swanky and Moo Moo" => "Swanky and Moo Moo",
      "Syncopate" => "Syncopate",
      "Tangerine" => "Tangerine",
      "Taprom" => "Taprom",
      "Telex" => "Telex",
      "Tenor Sans" => "Tenor Sans",
      "The Girl Next Door" => "The Girl Next Door",
      "Tienne" => "Tienne",
      "Tinos" => "Tinos",
      "Titan One" => "Titan One",
      "Trade Winds" => "Trade Winds",
      "Trocchi" => "Trocchi",
      "Trochut" => "Trochut",
      "Trykker" => "Trykker",
      "Tulpen One" => "Tulpen One",
      "Ubuntu" => "Ubuntu",
      "Ubuntu Condensed" => "Ubuntu Condensed",
      "Ubuntu Mono" => "Ubuntu Mono",
      "Ultra" => "Ultra",
      "Uncial Antiqua" => "Uncial Antiqua",
      "UnifrakturCook" => "UnifrakturCook",
      "UnifrakturMaguntia" => "UnifrakturMaguntia",
      "Unkempt" => "Unkempt",
      "Unlock" => "Unlock",
      "Unna" => "Unna",
      "VT323" => "VT323",
      "Varela" => "Varela",
      "Varela Round" => "Varela Round",
      "Vast Shadow" => "Vast Shadow",
      "Vibur" => "Vibur",
      "Vidaloka" => "Vidaloka",
      "Viga" => "Viga",
      "Voces" => "Voces",
      "Volkhov" => "Volkhov",
      "Vollkorn" => "Vollkorn",
      "Voltaire" => "Voltaire",
      "Waiting for the Sunrise" => "Waiting for the Sunrise",
      "Wallpoet" => "Wallpoet",
      "Walter Turncoat" => "Walter Turncoat",
      "Wellfleet" => "Wellfleet",
      "Wire One" => "Wire One",
      "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
      "Yellowtail" => "Yellowtail",
      "Yeseva One" => "Yeseva One",
      "Yesteryear" => "Yesteryear",
      "Zeyada" => "Zeyada"
    );
  
  return $array;
  
}
add_filter( 'ot_recognized_font_families', 'filter_ot_recognized_font_families', 10, 2 );