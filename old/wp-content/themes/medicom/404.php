<?php get_header();?>

<section class="medicom-waypoint">  
<div class="error-page">
  <div class="container">
    <div class="row">
<p><span><strong><?php echo __('404', 'medicom');?></strong> <?php echo __('Something went wrong here!', 'medicom');?></span><br>
            <?php echo __('Oops! Sorry, an error has occured. Requested page not found!', 'medicom');?></p>
    <span class="buton b_asset buton-2 buton-large"><a href="<?php echo home_url(); ?>"><?php echo __('GET ME BACK TO HOME PAGE', 'medicom');?></a></span>
    </div>
  </div>
</div>
</section>
<?php get_footer();?>

