<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'mkd_product_featured_image_size', true);
if(empty($masonry_image_size)) {
	$masonry_image_size = '';
}

$text_wrapper_class = '';
if($display_price == 'no' && $display_rating == 'no'){
    $text_wrapper_class .= 'mkd-no-rating-price';
}
?>
<div class="mkd-pli <?php echo esc_html($masonry_image_size); ?>">
	<div class="mkd-pli-inner">
		<div class="mkd-pli-image">
			<?php depot_mikado_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="mkd-pli-text">
			<div class="mkd-pli-text-outer">
				<div class="mkd-pli-text-inner">
					<?php do_action('depot_mikado_woocommerce_info_below_image_hover'); ?>
				</div>
			</div>
		</div>
		<a class="mkd-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="mkd-pli-text-wrapper <?php echo esc_html($text_wrapper_class); ?>" <?php echo depot_mikado_get_inline_style($text_wrapper_styles); ?>>
		<?php depot_mikado_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
		
		<?php depot_mikado_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
		
		<?php depot_mikado_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
		
		<?php depot_mikado_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
		
		<?php depot_mikado_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

		<?php depot_mikado_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
	</div>
</div>