<?php 
/* Template Name: Home Template */ 
?>
<?php get_header(); ?>

<section class="medicom-waypoint">

    <?php while ( have_posts() ) : the_post(); ?>
 		<div class="container"><div class="row"><div class="col-md-12 bt-reset-pd">
				<?php the_content(); ?>
	  	</div></div></div>			
	<?php endwhile; // end of the loop. ?>

</section>
<?php get_footer(); ?> 