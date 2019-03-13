<?php

if(!function_exists('depot_mikado_header_top_menu_logo_area_styles')) {
	/**
	 * Generates styles for menu area
	 */
	function depot_mikado_header_top_menu_logo_area_styles() {


		$menu_area_height = depot_mikado_options()->getOptionValue('menu_area_height');

		if($menu_area_height !== '') {
			echo depot_mikado_dynamic_css('.mkd-header-top-menu .mkd-page-header .mkd-logo-area', array('margin-top' => $menu_area_height.'px'));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_header_top_menu_logo_area_styles');
}