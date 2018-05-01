<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js"> <![endif]-->
  <head>
     <?php if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
      } ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
    <meta name="author" content="bliccathemes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if (!empty($theme_options['favicon_upload'])){?>
        <link rel="shortcut icon" href="<?php echo $theme_options['favicon_upload']; ?>" />
    <?php } ?>
    <?php wp_head(); ?>
    <!--[if IE 7]>
      <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
    <![endif]-->
	<?php $analytics = get_option_tree('analytics', $theme_options);
	if ( $analytics != "") {
		echo $analytics;
	}
	?>	
  </head>
  <body <?php body_class('off'); ?>>
    <div id="medicom-layout">
    <!-- Top Section -->
    <!-- Header -->
        <?php $header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            get_template_part( 'includes/header/header', '1' ); 
          elseif ( $header_style == "header_style_2" ):
            get_template_part( 'includes/header/header', '2');
          elseif ( $header_style == "header_style_8" ):
            get_template_part( 'includes/header/header', '8');
          endif;
        ?>