				<?php
                $after = "";
                $item_count = 1;	
                 ?>
				<div class="col-sm-8 col-md-8 blog-wrapper">
					<div id="hebele" class="blog-style-two-column">
					    
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<!-- Loop Start -->

						<article class="post-item">
							<div class="blog-thumbnail">
								<?php 
									if ( has_post_format( 'video' )) {
											medicom_video('453');?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
										    <?php
									} 

									else if ( has_post_format( 'audio' )) {
											medicom_audio();
											?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<?php
									}

									else if ( has_post_format( 'gallery' )) {
											medicom_gallery($id);
											?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<?php
									}		
									else if (has_post_thumbnail()) { 
									  	$thumb = get_post_thumbnail_id(); 
									  	$image = vt_resize( $thumb, '', 805, 503, true );
									  	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
									  	$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true); 
									  	?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo $alt; ?>" />
									  	  <div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>	
									  	<?php } 
								?>
							</div>
							<div class="blog-content">
							<h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<p class="blog-meta"><?php echo __('By', 'medicom');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'medicom');?>: <?php the_tags( '', ', ', $after ); ?> | <?php echo __('Comments', 'medicom');?>: <a href="<?php comments_link(); ?>">
					<?php comments_number( __('0', 'medicom'), __('1', 'medicom'), __('%', 'medicom') ); ?></a></p>
							<?php if ( !is_search() ) { ?><p><?php if ($item_count % 2 == 1 ) { echo wp_trim_words( get_the_content(), 39 ); $item_count++; } else {  echo wp_trim_words( get_the_content(), 70 ); $item_count++; } ?></p><?php } ?>
							<span class="buton b_inherit buton-2 buton-mini"><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', 'medicom');?></a></span>
							</div>
						</article>
						<?php endwhile; else: ?>
						<p><?php echo __('Sorry, no posts matched your criteria.', 'medicom');?></p>
 						<?php endif; ?>
					</div><div class="clearfix"></div>
			    <div class="pagination-container">
				<?php medicom_pagination();
                ?></div>
				</div>
					<?php get_sidebar() ?>