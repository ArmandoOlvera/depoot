<?php

if(!function_exists('depot_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function depot_mikado_header_class($classes) {
		$id = depot_mikado_get_page_id();

		$header_type = depot_mikado_get_meta_field_intersect('header_type', $id);

        $classes[] = 'mkd-'.$header_type;

        if($header_type == 'header-standard' && depot_mikado_get_meta_field_intersect('menu_area_position_header_standard', $id) == 'right'){
			$classes[] = 'mkd-'.$header_type.'-right-position';
		}

		$disable_menu_area_shadow = depot_mikado_get_meta_field_intersect('menu_area_shadow',$id) == 'no';
		if($disable_menu_area_shadow) {
			$classes[] = 'mkd-menu-area-shadow-disable';
		}

		$disable_menu_area_grid_shadow = depot_mikado_get_meta_field_intersect('menu_area_in_grid_shadow',$id) == 'no';
		if($disable_menu_area_grid_shadow) {
			$classes[] = 'mkd-menu-area-in-grid-shadow-disable';
		}

		$disable_menu_area_border = depot_mikado_get_meta_field_intersect('menu_area_border',$id) == 'no';
		if($disable_menu_area_border) {
			$classes[] = 'mkd-menu-area-border-disable';
		}

		$disable_menu_area_grid_border = depot_mikado_get_meta_field_intersect('menu_area_in_grid_border',$id) == 'no';
		if($disable_menu_area_grid_border) {
			$classes[] = 'mkd-menu-area-in-grid-border-disable';
		}

		if(depot_mikado_get_meta_field_intersect('menu_area_in_grid',$id) == 'yes' &&
			depot_mikado_get_meta_field_intersect('menu_area_grid_background_color',$id) !== '' &&
			depot_mikado_get_meta_field_intersect('menu_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'mkd-header-menu-area-in-grid-padding';
		}

		$disable_logo_area_border = depot_mikado_get_meta_field_intersect('logo_area_border',$id) == 'no';
		if($disable_logo_area_border) {
			$classes[] = 'mkd-logo-area-border-disable';
		}

		$disable_logo_area_grid_border = depot_mikado_get_meta_field_intersect('logo_area_in_grid_border',$id) == 'no';
		if($disable_logo_area_grid_border) {
			$classes[] = 'mkd-logo-area-in-grid-border-disable';
		}

		if(depot_mikado_get_meta_field_intersect('logo_area_in_grid',$id) == 'yes' &&
			depot_mikado_get_meta_field_intersect('logo_area_grid_background_color',$id) !== '' &&
			depot_mikado_get_meta_field_intersect('logo_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'mkd-header-logo-area-in-grid-padding';
		}

		$disable_shadow_vertical = depot_mikado_get_meta_field_intersect('vertical_header_shadow',$id) == 'no';
		if($disable_shadow_vertical) {
			$classes[] = 'mkd-header-vertical-shadow-disable';
		}

		$disable_border_vertical = depot_mikado_get_meta_field_intersect('vertical_header_border',$id) == 'no';
		if($disable_border_vertical) {
			$classes[] = 'mkd-header-vertical-border-disable';
		}

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_header_class');
}

if(!function_exists('depot_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function depot_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkd-'.depot_mikado_get_meta_field_intersect('header_behaviour', depot_mikado_get_page_id());

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_header_behaviour_class');
}

if(!function_exists('depot_mikado_mobile_header_class')) {
    function depot_mikado_mobile_header_class($classes) {
        $classes[] = 'mkd-default-mobile-header';

        $classes[] = 'mkd-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_mobile_header_class');
}

if(!function_exists('depot_mikado_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function depot_mikado_menu_dropdown_appearance($classes) {
		$dropdown_menu_appearance = depot_mikado_options()->getOptionValue('menu_dropdown_appearance');
		
        if($dropdown_menu_appearance !== 'default'){
            $classes[] = 'mkd-'.$dropdown_menu_appearance;
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_menu_dropdown_appearance');
}

if (!function_exists('depot_mikado_full_width_wide_menu_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function depot_mikado_full_width_wide_menu_class($classes) {
		if (depot_mikado_get_meta_field_intersect('enable_wide_menu_background',depot_mikado_get_page_id()) === 'yes') {
			$classes[] = 'mkd-full-width-wide-menu';
		}

		return $classes;
	}

	add_filter('body_class', 'depot_mikado_full_width_wide_menu_class');
}

if (!function_exists('depot_mikado_header_skin_class')) {

    function depot_mikado_header_skin_class( $classes ) {
        $header_style     = depot_mikado_get_meta_field_intersect('header_style');
	    $header_style_404 = depot_mikado_options()->getOptionValue('404_header_style');
	    
        if(is_404() && !empty($header_style_404)) {
	        $classes[] = 'mkd-' . $header_style_404;
        } else if (!empty($header_style)) {
	        $classes[] = 'mkd-' . $header_style;
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_header_skin_class');
}

if(!function_exists('depot_mikado_header_global_js_var')) {
    function depot_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdTopBarHeight'] = depot_mikado_get_top_bar_height();
        $global_variables['mkdStickyHeaderHeight'] = depot_mikado_get_sticky_header_height();
        $global_variables['mkdStickyHeaderTransparencyHeight'] = depot_mikado_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('depot_mikado_js_global_variables', 'depot_mikado_header_global_js_var');
}

if(!function_exists('depot_mikado_header_per_page_js_var')) {
    function depot_mikado_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdStickyScrollAmount'] = depot_mikado_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('depot_mikado_per_page_js_vars', 'depot_mikado_header_per_page_js_var');
}

if(!function_exists('depot_mikado_get_top_bar_styles')) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function depot_mikado_get_top_bar_styles($styles) {
		$id            = depot_mikado_get_page_id();

		$class_id = depot_mikado_get_page_id();
		if(depot_mikado_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}
		$class_prefix  = depot_mikado_get_unique_page_class($class_id);

		$top_bar_style = array();

		$top_bar_bg_color = get_post_meta($id, 'mkd_top_bar_background_color_meta', true);
		$top_bar_border = get_post_meta($id, 'mkd_top_bar_border_meta', true);
		$top_bar_border_color = get_post_meta($id, 'mkd_top_bar_border_color_meta', true);

		$current_style = '';

		$top_bar_selector = array(
			$class_prefix.' .mkd-top-bar'
		);

		if($top_bar_bg_color !== '') {
			$top_bar_transparency = get_post_meta($id, 'mkd_top_bar_background_transparency_meta', true);
			if($top_bar_transparency === '') {
				$top_bar_transparency = 1;
			}
			$top_bar_style['background-color'] = depot_mikado_rgba_color($top_bar_bg_color, $top_bar_transparency);
		}

		if($top_bar_border == 'yes') {
			$top_bar_style['border-bottom'] = '1px solid '.$top_bar_border_color;
		}elseif($top_bar_border == 'no'){
			$top_bar_style['border-bottom'] = '0';
		}

		$current_style  .= depot_mikado_dynamic_css($top_bar_selector, $top_bar_style);

		$current_style = $current_style . $styles;

		return $current_style;
	}

	add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_get_top_bar_styles');
}

if(!function_exists('depot_mikado_top_bar_skin_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function depot_mikado_top_bar_skin_class($classes) {
		$id           = depot_mikado_get_page_id();
		$top_bar_skin = get_post_meta($id, 'mkd_top_bar_skin_meta', true);

		if(!empty($top_bar_skin)) {
			$classes[] = 'mkd-top-bar-'.$top_bar_skin;
		}

		return $classes;
	}

	add_filter('body_class', 'depot_mikado_top_bar_skin_class');
}

if(!function_exists('depot_mikado_top_bar_grid_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function depot_mikado_top_bar_grid_class($classes) {
		$id = depot_mikado_get_page_id();

		if(depot_mikado_get_meta_field_intersect('top_bar_in_grid', $id) == 'yes' &&
			depot_mikado_options()->getOptionValue('top_bar_grid_background_color') !== '' &&
			depot_mikado_options()->getOptionValue('top_bar_grid_background_transparency') !== '0') {
			$classes[] = 'mkd-top-bar-in-grid-padding';
		}
		
		return $classes;
	}

	add_filter('body_class', 'depot_mikado_top_bar_grid_class');
}