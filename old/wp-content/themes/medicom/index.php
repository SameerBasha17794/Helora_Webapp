<?php
/* Template Name: Blog Template */  
	get_header();

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
<?php $blog_template = get_option_tree('blog_style',$theme_options);?>    	

	<!-- Blog Content Start -->	
		<div class="bg-color">
			<div class="container">
				<div class="row">
					<?php 
					if ( $blog_template == "big_thumbnail_right_sidebar" || $blog_template == ""): 
						get_template_part( 'includes/blog/blog', 'right-sidebar' ); 
  					elseif ( $blog_template == "two_column"): 
						get_template_part( 'includes/blog/blog', 'two-column' );
					elseif ( $blog_template == "full_width" ):
						get_template_part( 'includes/blog/blog', 'fullwidth');
					endif;
					?>
				</div>
			</div>
		</div>
   
</section>

<?php get_footer();?>