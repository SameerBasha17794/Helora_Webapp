				<?php
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
								   <div class="blog-date"><span class="day"><?php the_time('j')?></span><span class="monthyear"><?php the_time('M, Y')?></span><div class="comment-count"><a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?php comments_number( __('0', 'medicom'), __('1', 'medicom'), __('%', 'medicom') ); ?></a></div></div>
									<h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
									<p class="blog-meta"><?php echo __('By', 'medicom');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'medicom');?>: <?php the_tags( '', ', ', $after ); ?></p>
									<p class="blog-intro"><?php echo get_the_excerpt(); ?><br><span class="buton b_inherit buton-2 buton-mini"><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', 'medicom');?></a></span></p>
							</div>
						</article>
						<?php endwhile; else: ?>
						<p><?php echo __('Sorry, no posts matched your criteria.', 'medicom');?></p>
 						<?php endif; ?>
					</div>
			    <div class="pagination-container">
				<?php medicom_pagination();
                ?></div>
				</div>
					<?php get_sidebar() ?>