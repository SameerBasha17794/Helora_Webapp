<?php
if (is_user_logged_in()){
  wp_redirect( home_url() );
  exit;
  }
  else {
?>

<?php 
/* Template Name: Login */ 
?> 
<?php get_header();?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="medicom-waypoint">  
    <div class="caption" <?php medicom_caption_image($id); ?>>
       <h1><?php the_title(); ?></h1>
       <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
    </div>
  <!-- Page Content Start -->
    <?php the_content(); ?>

  <!-- Login form -->
    <div class="login-page-login-form">
      <?php wp_login_form( $args ); ?> 
    </div>
   <!-- Login form END -->

    <?php if (comments_open()){ ?>    
    <div class="bg-color white"><div class="container"><div class="row"><div class="col-md-9">    
        <div id="comment" class="comments-wrapper">
              <?php comments_template(); ?>
        </div>
    </div></div></div></div>
    <?php } ?>
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>
<?php } ?>