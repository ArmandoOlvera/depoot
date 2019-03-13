<?php

if(!function_exists('depot_mikado_is_yith_wishlist_installed')) {
	function depot_mikado_is_yith_wishlist_installed() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('depot_mikado_woocommerce_wishlist_shortcode')) {
	function depot_mikado_woocommerce_wishlist_shortcode() {

		if(depot_mikado_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

if(!function_exists('mkd_product_ajax_wishlist')) {
	function mkd_product_ajax_wishlist(){

		$data = array(
			'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0
		);
		wp_send_json($data); exit;
	}

	add_action('wp_ajax_mkd_product_ajax_wishlist', 'mkd_product_ajax_wishlist');
	add_action('wp_ajax_nopriv_mkd_product_ajax_wishlist', 'mkd_product_ajax_wishlist');
}

