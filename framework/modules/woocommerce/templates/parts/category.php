<?php

if($display_category === 'yes') {
	$product = depot_mikado_return_woocommerce_global_variable();

	if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
		$product_categories = wc_get_product_category_list( $product->get_id(), ', ' );
	} else {
		$product_categories = $product->get_categories(', ');
	}

	if (!empty($product_categories)) { ?>
		<p class="mkd-<?php echo esc_attr($class_name); ?>-category"><?php print $product_categories; ?></p>
	<?php } ?>
<?php } ?>