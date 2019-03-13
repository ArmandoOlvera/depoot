<?php
$featured_image_size = isset($featured_image_size) ? $featured_image_size : 'full';
$image_gallery_val = get_post_meta( get_the_ID(), 'mkd_post_gallery_images_meta' , true );
?>
<?php if($image_gallery_val !== ""){ ?>
	<div class="mkd-post-image">
		<div class="mkd-blog-gallery mkd-owl-slider">
			<?php
			if($image_gallery_val != '' ) {
				$image_gallery_array = explode(',',$image_gallery_val);
			}
			if(isset($image_gallery_array) && count($image_gallery_array)!= 0):
				foreach($image_gallery_array as $gimg_id): ?>
					<div>
                        <?php if(depot_mikado_blog_item_has_link()) { ?>
                            <a itemprop="url" href="<?php the_permalink(); ?>">
                        <?php } ?>
                        <?php echo wp_get_attachment_image( $gimg_id, $featured_image_size ); ?>
                        <?php if(depot_mikado_blog_item_has_link()) { ?>
                            </a>
                        <?php } ?>
                    </div>
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
<?php } ?>