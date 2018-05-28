<?php 
/* Template Name: VC LeftSidebar */ 
?> 
<?php get_header();?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="medicom-waypoint">  
  	<div class="caption" <?php medicom_caption_image($id); ?>>
       <h1><?php the_title(); ?></h1>
       <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
    </div>
  <!-- Page Content Start -->
    <div class="container"><div class="row">
    <?php get_sidebar() ?>
    <div class="col-md-8">
    <?php the_content(); ?>

    <?php if (comments_open()){ ?>    
    <div class="bg-color white"><div class="container"><div class="row"><div class="col-md-9">    
        <div id="comment" class="comments-wrapper">
              <?php comments_template(); ?>
        </div>
    </div></div></div></div>
    <?php } ?>
    </div>
    
    </div></div>
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>