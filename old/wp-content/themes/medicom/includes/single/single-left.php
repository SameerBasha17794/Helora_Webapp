      	            <?php get_sidebar();
                    $after = "";	
                    ?>
					<div class="col-sm-8 col-md-8 blog-wrapper">
					<div class="blog-style-2">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<!-- Loop Start -->
						<article <?php post_class('blog-item') ?>>
							<div class="blog-thumbnail">
								<?php 
									if ( has_post_format( 'video' )) {
											medicom_video('453');?>
											<?php
									} 

									else if ( has_post_format( 'audio' )) {
											medicom_audio();
											?>
											<?php
									}

									else if ( has_post_format( 'gallery' )) {
											medicom_gallery($id);
											?>
											<?php
									}		
									else if (has_post_thumbnail()) { 
									  	$thumb = get_post_thumbnail_id(); 
									  	$image = vt_resize( $thumb, '', 805, 503, true );
									  	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
									  	$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true); 
									  	?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo $alt; ?>" />
									  	<?php } 
								?>
							</div>
							<div class="blog-content">
									<h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
									<p class="blog-meta"><?php echo __('By', 'medicom');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'medicom');?>: <?php the_tags( '', ', ', $after ); ?> | <?php echo __('Comments', 'medicom');?>: <a href="<?php comments_link(); ?>">
					<?php comments_number( __('0', 'medicom'), __('1', 'medicom'), __('%', 'medicom') ); ?></a> | <?php the_time(' F jS, Y') ?></p>
									<?php the_content(); ?>
							</div>
						</article>
						<?php endwhile; else: ?>
						<p><?php echo __('Sorry, no posts matched your criteria.', 'medicom');?></p>
 						<?php endif; ?>
 						<?php wp_link_pages(); ?>
					</div>
					<div id="comment" class="comments-wrapper">
							<?php comments_template(); ?>
					</div>
				</div>