<?php 
if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
      }
      ?>
 <header id="medicom_header2" class="medicom-header2 medicom-header-large header-6">
 	<div class="container">
        <div class="row">
          <div class="col-md-12">
          <!-- Main Menu -->
          <nav class="navbar navbar-default header-6" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
                <a href="<?php echo home_url(); ?>"><?php if (!empty($theme_options['logo_upload'])){?>
                <img src="<?php echo $theme_options['logo_upload']?>" alt="<?php bloginfo('name'); ?>" class="logo" /></a>
                <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/medicom.png" alt="Medicom" class="logo" /></a>
                <?php } ?> 
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
                         
                         <?php          
                           wp_nav_menu(
                                  array(
                                      'theme_location'        => 'main_menu',
                                      'container'             => '',
                                      'container_class'       => false,
                                      'menu_class'            => 'nav navbar-nav navbar-right',
                                      'fallback_cb'           => 'false',
                                      'walker'                => new medicom_walker_main_menu()
                                  ));

                        	?>
          </div><!-- /.navbar-collapse -->
        </nav>
          </div>
        </div>
      </div>
    </header>