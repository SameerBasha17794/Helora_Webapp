<?php get_header();?>
	
<section class="medicom-waypoint">
	
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