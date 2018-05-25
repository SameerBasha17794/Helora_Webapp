<?php if ( function_exists( 'get_option_tree') ) {
              $theme_options = get_option('option_tree');  
              } ?>
<footer>

  <?php $show_widget = get_option_tree('show_widget', $theme_options); 
        if ( $show_widget == 'Yes') {?>
      <div class="container">
        <div class="row">
          <div class="widgetscontainer">
          <!-- Widget Area 1 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer First") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 2 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Second") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 3 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Third") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 4 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Fourth") ) : ?>
            <?php endif; ?>
          </div>
          </div>

        </div>
      </div>
        <?php } ?>
        <?php $show_copyright = get_option_tree('show_copyright', $theme_options); 
        if ( $show_copyright == 'Yes') {?>
      <div class="bg-color footer-copyright fixed-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-section"><p><?php echo $copyright_text = get_option_tree('copyright_text', $theme_options); ?></p></div>
            </div>
          </div>
        </div>
      </div>
        <?php } ?>
     <?php $show_logo_area = get_option_tree('show_logo_area', $theme_options); 
        if ( $show_logo_area == 'Yes') {?>
        <div class="bottom-company">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                <div class="footerlogo"><a href="#" class="logo">
                <?php $footer_logo = get_option_tree('footer_logo_upload', $theme_options); if (!empty($footer_logo)) {?> 
                <img src="<?php echo $footer_logo = get_option_tree('footer_logo_upload', $theme_options);?>" alt="<?php bloginfo('name'); ?>" class="footer-logo" /></a>
                <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo.jpg" alt="Medicom" class="footer-logo" /></a>
                <?php } ?>
                </div>
                <div class="bottom-company-text"><p><?php $footer_text = get_option_tree('company_text', $theme_options); echo $footer_text; ?></p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </footer>
</div>


    <?php wp_footer() ?> 
  </body>
</html>