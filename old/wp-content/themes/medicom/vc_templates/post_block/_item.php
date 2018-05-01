<?php
$block = $block_data[0];
$settings = $block_data[1];
?>
<?php if($block === 'title'): ?>
<h2 class="post-title">
    <?php echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->title, $settings[0], 'link_title') : $post->title ?>
</h2>
<?php elseif($block === 'image' && !empty($post->thumbnail)): ?>
<div class="post-thumb">
    <?php echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->thumbnail, $settings[0], 'link_image') : $post->thumbnail ?>
 
    <div class="isotope-overit"><a href="<?php echo $post->thumbnail_data['p_img_large'][0]; ?>" data-rel="prettyPhoto" class="prettyPhoto"><img src="<?php echo get_template_directory_uri();?>/img/plus-icon-hover.png"></a></div>
</div>
<?php elseif($block === 'text'): ?>
<div class="entry-content">
    <?php echo !empty($settings[0]) && $settings[0]==='text' ?  $post->content : $post->excerpt; ?>
</div>
<?php elseif($block === 'link'): ?>
<a href="<?php echo $post->link ?>" class="vc_read_more" title="<?php echo esc_attr(sprintf(__( 'Permalink to %s', "js_composer" ), $post->title_attribute)); ?>"<?php echo $this->link_target ?>><?php _e('Read more...', "js_composer") ?></a>
<?php endif; ?>