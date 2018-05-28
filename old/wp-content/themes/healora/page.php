<?php get_header();?>

<?php while ( have_posts() ) : the_post(); ?>    
<section class="medicom-waypoint">
      <div class="caption" <?php medicom_caption_image($id); ?>>

      <!-- Custom - show custom title in page header -->
      <?php if (is_page('register')) { ?>
        <h1 style="font-weight: 500;"><strong>Add</strong> our Network<br><strong>Expand</strong> Your Practice</h1>
      <?php } else if (is_page('members')) { ?>
        <h1>Doctors</h1>
      <?php } else if (is_page('geo-search')) { ?>

      <?php $currentCategory = $_GET['field_2']; ?>
        <h1>Searched for:<br><?php echo $currentCategory; ?></h1>

      <?php } else if (bp_is_member()) { ?>
        <h1><?php echo xprofile_get_field_data('First Name', bp_get_member_user_id()); ?> <?php echo xprofile_get_field_data('Last Name', bp_get_member_user_id()); ?></h1>

      <?php } else { ?>
          <h1><?php the_title(); ?></h1>
      <?php } ?>
      <!-- Custom END -->

          <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
      </div>
	<!-- Page Content Start -->
  	  <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
				  <?php the_content(); ?>
		      </div>
		    </div>
	     </div>
	     </div>

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