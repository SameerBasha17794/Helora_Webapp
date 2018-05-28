<?php
function option_tree_theme_setup2() {
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
  $theme_options = get_option('option_tree');
}

$all_css = $overridecss = $loadgooglefonts = $keys = "";
$boxedtest = get_option_tree('boxed_layout',$theme_options);
    if ( $boxedtest == "Yes" ) {
  $all_css = $all_css . "#medicom-layout { width: 1170px; margin: 0 auto; } #medicom-layout header{ left: auto; right:auto; max-width: 1170px;  margin-left: auto; margin-right: auto;  } .medicom-header .col-md-12 { padding-left: 0; padding-right: 0; }
  
@media (max-width: 1200px) {
#medicom-layout { width: 992px; }  
#medicom-layout header{ left: auto; right:auto; margin-left: auto; margin-right: auto; max-width: 992px; } 
}

@media (min-width: 768px) and (max-width: 992px) {
#medicom-layout { width: 768px; }  
#medicom-layout header{ left: auto; right:auto; margin-left: auto; margin-right: auto; max-width: 768px; } 
}

@media (max-width: 767px) {
#medicom-layout { width: auto; margin-right: auto; margin-left: auto; padding: 0 10px; overflow: hidden;}
#medicom-layout header{ left: auto; right:auto; margin-left: auto; margin-right: auto; max-width: 100%; } 
}

@media (max-width: 480px) {
#medicom-layout { width: auto; margin-right: auto; margin-left: auto; padding: 0;overflow: hidden; }
#medicom-layout header{ left: auto; right:auto; margin-left: auto; margin-right: auto; max-width: 100%; } 
}";  
}

$bodybackground = get_option_tree('body_background', $theme_options);
$background_repeat = get_option_tree('background_repeat', $theme_options);
if( $bodybackground != "" ) {
  $all_css = $all_css . "body { background: url({$bodybackground}) {$background_repeat}; }"; 
}

$blogyback = get_option_tree('blog_bg', $theme_options);
if ( $blogyback != "" ) {
  $all_css = $all_css . ".blog .caption, .single-post .caption { background-image: url({$blogyback}); }";   
}
  //
  // Fonts  
  //
  $body_fonts =  ot_get_option('body_font');
  $h1_fonts =  ot_get_option( 'h1_font' );
  $h2_fonts =  ot_get_option( 'h2_font' );
  $h3_fonts =  ot_get_option( 'h3_font' );
  $h4_fonts =  ot_get_option( 'h4_font' );
  $h5_fonts =  ot_get_option( 'h5_font' );
  $h6_fonts =  ot_get_option( 'h6_font' );
  $header_logo_fonts =  ot_get_option( 'header_logo_font' );
  $header_link_fonts =  ot_get_option( 'header_link_font' );
  $footer_title_fonts =  ot_get_option( 'footer_title_font' );
  $footer_p_fonts =  ot_get_option( 'footer_p_font' );
  $footer_copyright_fonts =  ot_get_option( 'footer_copyright_font' );
  $sidebar_title_fonts = ot_get_option( 'sidebar_title_font' );
  
  //class
  $arrayleng = 0;
  $diziclass = array ( "body", "h1", "h2", "h3", "h4", "h5", "h6", ".header-1 .logo-text", ".header-1 .navbar-nav>li>a", "footer h4", ".footer-widget p", ".footer-widget a", ".copyright-section", ".sidebar-widget h3" );

  //options
  $bliccaThemes_font_set = array( $body_fonts, $h1_fonts, $h2_fonts, $h3_fonts, $h4_fonts, $h5_fonts, $h6_fonts, $header_logo_fonts, $header_link_fonts, $footer_title_fonts, $footer_p_fonts, $footer_copyright_fonts, $sidebar_title_fonts );
  
  //css
  $bliccaThemes_user_fonts = array();
  $temp_google_fonts = 'Source Sans Pro';
 
  foreach( $bliccaThemes_font_set as $temp_font_set )
    {
      
      $temp_css_all = "";
      
      if ( !empty($temp_font_set['font-family']) ) {
            if (in_array($temp_font_set["font-family"], $bliccaThemes_user_fonts)) {
                $temp_css_all = $temp_css_all . 'font-family: "' . $temp_font_set['font-family'] . '";'; 
            }
          
            else {
                $bliccaThemes_user_fonts[] = $temp_font_set['font-family'];
                $user_font = str_replace(' ', '+', $temp_font_set['font-family']);
                
                $temp_google_fonts = $temp_google_fonts . ',' . $user_font;
                
                $temp_css_all = $temp_css_all . 'font-family: "' . $temp_font_set['font-family'] . '";'; 
            }
          
        }
      
      if ( !empty($temp_font_set['font-size'] ) ){
          $temp_css_all = $temp_css_all . 'font-size: ' . $temp_font_set['font-size'] . ';';
      }
          
      if ( !empty($temp_font_set['font-style'] ) ){
          $temp_css_all = $temp_css_all . 'font-style: ' . $temp_font_set['font-style'] . ';';
      }

      if ( !empty($temp_font_set['font-variant'] ) ){
          $temp_css_all = $temp_css_all . 'font-variant: ' . $temp_font_set['font-variant'] . ';';
      }

      if ( !empty($temp_font_set['font-weight'] ) ){
          $temp_css_all = $temp_css_all . 'font-weight: ' . $temp_font_set['font-weight'] . ';';
      }

      if ( !empty($temp_font_set['letter-spacing'] ) ){
          $temp_css_all = $temp_css_all . 'letter-spacing: ' . $temp_font_set['letter-spacing'] . ';';
      } 

      if ( !empty($temp_font_set['line-height'] ) ){
          $temp_css_all = $temp_css_all . 'line-height: ' . $temp_font_set['line-height'] . ';';
      }
      
      if ( !empty($temp_font_set['text-decoration'] ) ){
          $temp_css_all = $temp_css_all . 'text-decoration: ' . $temp_font_set['text-decoration'] . ';';
      }      
          
      if ( !empty($temp_font_set['text-transform'] ) ){
          $temp_css_all = $temp_css_all . 'text-transform: ' . $temp_font_set['text-transform'] . ';';
      }
      
      if ( !empty($temp_css_all) ) {
                  
          $all_css = $all_css . ' ' . $diziclass[$arrayleng] . ' { ' . $temp_css_all . ' } ';
      }
      $arrayleng++;
    }

if ( !empty ($theme_options['custom_asset_color']) ) {
    $all_css = $all_css . " 
  span {color:{$theme_options['custom_asset_color']};}
a, a:hover {color:{$theme_options['custom_asset_color']};}
.navbar-default .navbar-nav>li.firstitem.current-menu-item>a, .navbar-default .navbar-nav>li.firstitem.current-menu-parent>a {background-color: {$theme_options['custom_asset_color']};}
.medicom-header.header-2:before {background:{$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a,.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:hover,.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-item>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a,.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:hover,.header-2 .navbar-default .navbar-nav>.firstitem.current-menu-parent>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-2 .navbar-default .navbar-nav>.open>a,.header-2 .navbar-default .navbar-nav>.open>a:hover,.header-2 .navbar-default .navbar-nav>.open>a:focus {background-color: {$theme_options['custom_asset_color']};}
.header-2 .dropdown-menu>li>a:hover, .header-2 .dropdown-menu>li>a:focus {color: {$theme_options['custom_asset_color']}; }
.header-2 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-6 span {color: {$theme_options['custom_asset_color']};}
.header-6 .dropdown-menu {border-top: 4px solid {$theme_options['custom_asset_color']};}
.header-6 .dropdown-menu>li>a:hover, .header-6 .dropdown-menu>li>a:focus{color:{$theme_options['custom_asset_color']};}
.header-1 .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {color:{$theme_options['custom_asset_color']};}
.header-1 .dropdown-menu{border-top: 6px solid {$theme_options['custom_asset_color']};}
.multi .dropdown-menu ul li a:hover {color:{$theme_options['custom_asset_color']};}
button.search-icon{background:{$theme_options['custom_asset_color']};}
.fullstyle{background:{$theme_options['custom_asset_color']};}
.asset-bg{background: {$theme_options['custom_asset_color']};}
.teal-highlight{background: {$theme_options['custom_asset_color']};}
.widget_nav_menu h2, .menu-widget h4 {background-color: {$theme_options['custom_asset_color']};}
.widget_nav_menu ul li:hover, .menu-widget ul li:hover {color: {$theme_options['custom_asset_color']};}
ul.sub-menu li:hover a,ul.sub-menu li:active{color:{$theme_options['custom_asset_color']};}
.b_asset {background: {$theme_options['custom_asset_color']};}
.b_blue {background: {$theme_options['custom_asset_color']};}
.b_inherit { background: {$theme_options['custom_asset_color']};}
.b_teal { background: {$theme_options['custom_asset_color']};}
.page-numbers>.current>a,.page-numbers>.current>span, .page-numbers>.current>a:hover, .page-numbers>.current>span:hover, .page-numbers>.current>a:focus, .page-numbers>.current>span:focus {background: {$theme_options['custom_asset_color']};border-color: {$theme_options['custom_asset_color']};}
.page-numbers .current, .page-numbers .current:hover {background: {$theme_options['custom_asset_color']};border-color: {$theme_options['custom_asset_color']};}
.list-none i {color:{$theme_options['custom_asset_color']};}
.tabs-classic .nav-tabs>li.active>a, .tabs-classic .nav-tabs>li.active>a:hover, .tabs-classic .nav-tabs>li.active>a:focus, .tabs-classic .nav-tabs>li>a:hover {color: {$theme_options['custom_asset_color']};}
.services-1:hover {background: {$theme_options['custom_asset_color']};}
.services-1:hover .holder {color: {$theme_options['custom_asset_color']};}
.services-2:hover {background: {$theme_options['custom_asset_color']};}
.services-2:hover .holder {background: {$theme_options['custom_asset_color']};}
.services-3:hover h4 {color: {$theme_options['custom_asset_color']};}
.services-3:hover .holder {background: {$theme_options['custom_asset_color']};}
.services-3:hover .caret {border-top: 12px solid {$theme_options['custom_asset_color']};}
.services-3:hover .b_inherit {background: {$theme_options['custom_asset_color']};}
.services-4 .holder{background-color: {$theme_options['custom_asset_color']};}
.services-5:hover .holder {color: {$theme_options['custom_asset_color']};border: 6px double {$theme_options['custom_asset_color']};}
.medicom-table .back-inherit {background: {$theme_options['custom_asset_color']};}
.medicom-table .b_inherit {background: {$theme_options['custom_asset_color']};}
.asset-bg .call-to-action a{color: {$theme_options['custom_asset_color']};}
.carousel-container li:hover .latest-item  {-webkit-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};-moz-box-shadow:0px 7px 0px {$theme_options['custom_asset_color']};box-shadow:0px 7px 0px {$theme_options['custom_asset_color']};}
.blog-widget .disabled {background: {$theme_options['custom_asset_color']};}
.blog-widget .slide-pagination a.disabled, .blog-widget .slide-pagination a:hover {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-title a:hover {color: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-thumbnail {position: relative; border-bottom: 4px solid {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-type-logo {border-bottom: 5px solid {$theme_options['custom_asset_color']};}
.blog-wrapper .half-round {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .social-widget a:hover .socialbox{background: {$theme_options['custom_asset_color']};}
.blog-style-2 .blog-date {background: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-categories ul li.current-cat a {color: {$theme_options['custom_asset_color']};}
.blog-wrapper .blog-categories ul li a:hover {color: {$theme_options['custom_asset_color']};}
.blog-style-two-column .blog-date {background: {$theme_options['custom_asset_color']};}
.blog-style-3 .blog-date {background: {$theme_options['custom_asset_color']};}
.sidebar-widget h2 {color: {$theme_options['custom_asset_color']};}
.sidebar-widget .popular-post h4 a:hover {color: {$theme_options['custom_asset_color']};}
.sidebar-widget ul li a:hover i {color: {$theme_options['custom_asset_color']};}
.sidebar-widget ul li a:hover {color: {$theme_options['custom_asset_color']};}
.sidebar-widget .medicom-tag-cloud ul li:hover a {border: 1px solid {$theme_options['custom_asset_color']}; color: {$theme_options['custom_asset_color']};}
.sidebar-widget .subscribe-mini .b_inherit {background: {$theme_options['custom_asset_color']};}
#wp-calendar tbody td a{color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #next {color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #prev {color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #next a{color: {$theme_options['custom_asset_color']};}
#wp-calendar tfoot #prev a{color: {$theme_options['custom_asset_color']};}
.portfolio-style-1-filter ul li.active {color:{$theme_options['custom_asset_color']};}
.portfolio-style-1-filter ul li:hover {color: {$theme_options['custom_asset_color']};}
.portfolio-style-1 .portfolio-content {border-bottom: 4px solid {$theme_options['custom_asset_color']};}
.portfolio-style-1 .portfolio-meta:hover .holder {background: {$theme_options['custom_asset_color']};}
.portfolio-style-1 .portfolio-meta:hover .project-meta, .project-meta a:hover {color: {$theme_options['custom_asset_color']};}
.portfolio-style-3 .portfolio-item-3:hover {-webkit-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};-moz-box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};box-shadow: 0px 7px 0px {$theme_options['custom_asset_color']};}
.html_carousel div.slide .blog-date {background: {$theme_options['custom_asset_color']};}
.html_carousel .nextprev .slidebox:hover {background: {$theme_options['custom_asset_color']};}
.contact-info .social-widget a:hover .socialbox{border-color:{$theme_options['custom_asset_color']};}
.contact-info .social-widget a:hover .socialbox i{color: {$theme_options['custom_asset_color']};}
.bottom-section {background: {$theme_options['custom_asset_color']};}
footer h4 {position: relative;color: {$theme_options['custom_asset_color']};}
footer h4 span {border-bottom: 1px solid {$theme_options['custom_asset_color']};}
.footer-widget ul li:hover:before {color: {$theme_options['custom_asset_color']};}
.footer-widget ul li a:hover {color: {$theme_options['custom_asset_color']} ;}
.footer-widget .twitter-widget .bird {color: {$theme_options['custom_asset_color']};}
.footer-widget .medicom-tag-cloud ul li:hover a { background: {$theme_options['custom_asset_color']};}
.footer-widget .social-widget a:hover .socialbox{border-color:{$theme_options['custom_asset_color']};}
.footer-widget .social-widget a:hover .socialbox i{color: {$theme_options['custom_asset_color']};}
.custom-categories ul li.active a { color: {$theme_options['custom_asset_color']};}
.custom-categories ul li a:hover { color: {$theme_options['custom_asset_color']};}
.wpb_accordion_header i {color: {$theme_options['custom_asset_color']};}
.flex-control-paging li a.flex-active {background: {$theme_options['custom_asset_color']} !important;}
.entry-title {color: {$theme_options['custom_asset_color']} !important;}
h4.wpb_pie_chart_heading {color: {$theme_options['custom_asset_color']} !important;}
.ui-datepicker-header{background: {$theme_options['custom_asset_color']} !important;}
.medicom-feature-list li i{background: {$theme_options['custom_asset_color']} !important;}
.wpb_toggle.wpb_toggle_title_active { color: {$theme_options['custom_asset_color']} !important; }
.wpb_toggle.wpb_toggle_title_active:before {background: {$theme_options['custom_asset_color']} !important; }
.ui-icon-triangle-1-s:before {color: {$theme_options['custom_asset_color']} !important;}
.ui-icon-triangle-1-e:before {color: {$theme_options['custom_asset_color']} !important;}
.tablepress tfoot th, .tablepress thead th {background-color: {$theme_options['custom_asset_color']} !important;}
.services_lists .services_list .list_icon:hover i{color:{$theme_options['custom_asset_color']} !important; }
h2.tablepress-table-name {color: {$theme_options['custom_asset_color']} !important;}
.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus{background-color: {$theme_options['custom_asset_color']};}
.item-box:hover {border-color: {$theme_options['custom_asset_color']};}
.titleBorder{color:{$theme_options['custom_asset_color']}}
.bigP h1{color:{$theme_options['custom_asset_color']}}
.services-4 .services-4-content a{color:{$theme_options['custom_asset_color']}}";
}
if ( !empty ($theme_options['custom_css'])) {
    $all_css = $all_css . "{$theme_options['custom_css']}";
}

  $all_fonts = $temp_google_fonts;
  define('googlefonts', $all_fonts);
  define('bliccaThemes_custom', $all_css);
  function bliccaThemes_user_style() {
    wp_add_inline_style( 'custom_style', bliccaThemes_custom);
  }
  add_action('wp_enqueue_scripts', 'bliccaThemes_user_style', 21);

  /***********************/
  /* Register Custom CSS */
  /***********************/
  function bliccaThemes_style() {
      wp_enqueue_style( 
              'custom_style',
              get_template_directory_uri() . '/css/options.css' 
      );
      $site_parameters = array(
    'theme_directory' => get_template_directory_uri(), 'theme_fonts' => googlefonts
    );
    wp_localize_script( 'main', 'SiteParameters', $site_parameters );      
  }
  
  add_action( 'wp_enqueue_scripts', 'bliccaThemes_style', 20 );  
}
add_action( 'after_setup_theme', 'option_tree_theme_setup2' );