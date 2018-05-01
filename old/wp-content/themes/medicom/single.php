<?php get_header(); 

if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
if(isset($theme_options['blog_header'])) { /* dont */ }
    else { $theme_options['blog_header'] = "Set from Theme Option"; }
    if(isset($theme_options['blog_caption'])) { /*dont */ }
    else { $theme_options['blog_caption'] = "Set from Theme Option"; }  
?>
<section class="medicom-waypoint">
	<div class="caption">
          <h1><?php if ( is_search() ) : // Only display for Search?>
		        <?php printf( __( 'Search Results for: %s', 'medicom' ), '<span>' . get_search_query() . '</span>' ); ?> 
			    <?php else: echo $theme_options['blog_header']; ?><?php endif; ?></h1>
          <p><?php echo $theme_options['blog_caption']; ?></p>
      </div>
	<!-- Content Start -->	
		<div class="bg-color">
			<div class="container">
				<div class="row">
					<?php if ( function_exists( 'get_option_tree') ) {
       				$theme_options = get_option('option_tree');  
      				} ?>
					<?php $blog_template = get_option_tree('blog_style',$theme_options);
					if ( $blog_template == "big_thumbnail_right_sidebar" || $blog_template == "" || $blog_template == "two_column" || $blog_template == "full_width"): 
						get_template_part( 'includes/single/single', 'right' ); 
					elseif ( $blog_template == "big_thumbnail_left_sidebar"): 
						get_template_part( 'includes/single/single', 'left' );
					endif;
					?>
				</div>
			</div>
		</div>
</section>
<?php get_footer();?>