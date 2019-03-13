<?php

if (!function_exists('depot_mikado_search_opener_icon_size')) {
	function depot_mikado_search_opener_icon_size() {
		$icon_size = depot_mikado_options()->getOptionValue('header_search_icon_size');
		
		if (!empty($icon_size)) {
			echo depot_mikado_dynamic_css('.mkd-search-opener', array(
				'font-size' => depot_mikado_filter_px($icon_size) . 'px'
			));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_search_opener_icon_size');
}

if (!function_exists('depot_mikado_search_opener_icon_colors')) {
	function depot_mikado_search_opener_icon_colors() {
		$icon_color       = depot_mikado_options()->getOptionValue('header_search_icon_color');
		$icon_hover_color = depot_mikado_options()->getOptionValue('header_search_icon_hover_color');
		
		if (!empty($icon_color)) {
			echo depot_mikado_dynamic_css('.mkd-search-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo depot_mikado_dynamic_css('.mkd-search-opener:hover', array(
				'color' => $icon_hover_color
			));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_search_opener_icon_colors');
}

if (!function_exists('depot_mikado_search_opener_text_styles')) {
	function depot_mikado_search_opener_text_styles() {
		$item_styles = depot_mikado_get_typography_styles('search_icon_text');
		
		$item_selector = array(
			'.mkd-search-icon-text'
		);
		
		echo depot_mikado_dynamic_css($item_selector, $item_styles);
		
		$text_hover_color = depot_mikado_options()->getOptionValue('search_icon_text_color_hover');
		
		if (!empty($text_hover_color)) {
			echo depot_mikado_dynamic_css('.mkd-search-opener:hover .mkd-search-icon-text', array(
				'color' => $text_hover_color
			));
		}
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_search_opener_text_styles');
}