<?php

if(!function_exists('depot_mikado_header_register_main_navigation')) {
    /**
     * Registers main navigation
     */
    function depot_mikado_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'depot'),
                'vertical-navigation' => esc_html__('Vertical Navigation', 'depot'),
				'vertical-compact-navigation' => esc_html__('Vertical Compact Navigation', 'depot'),
                'divided-left-navigation' => esc_html__('Divided Left Navigation', 'depot'),
                'divided-right-navigation' => esc_html__('Divided Right Navigation', 'depot'),
                'mobile-navigation' => esc_html__('Mobile Navigation', 'depot')
            )
        );
    }

    add_action('after_setup_theme', 'depot_mikado_header_register_main_navigation');
}

if(!function_exists('depot_mikado_is_top_bar_transparent')) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function depot_mikado_is_top_bar_transparent() {
        $top_bar_enabled = depot_mikado_is_top_bar_enabled();

        $top_bar_bg_color = depot_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = depot_mikado_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists('depot_mikado_is_top_bar_completely_transparent')) {
    function depot_mikado_is_top_bar_completely_transparent() {
        $top_bar_enabled = depot_mikado_is_top_bar_enabled();

        $top_bar_bg_color = depot_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = depot_mikado_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists('depot_mikado_is_top_bar_enabled')) {
    function depot_mikado_is_top_bar_enabled() {
        $top_bar_enabled = depot_mikado_get_meta_field_intersect('top_bar') === 'yes';
		if(depot_mikado_get_meta_field_intersect('header_type', depot_mikado_get_page_id()) === 'header-box'){
			$top_bar_enabled = true;
		}

        return $top_bar_enabled;
    }
}

if(!function_exists('depot_mikado_get_top_bar_height')) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function depot_mikado_get_top_bar_height() {
        if(depot_mikado_is_top_bar_enabled()) {
            $top_bar_height = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('top_bar_height'));

            return $top_bar_height !== '' ? intval($top_bar_height) : 55;
        }

        return 0;
    }
}

if(!function_exists('depot_mikado_get_top_bar_background_height')) {
	/**
	 * Returns top bar background height
	 *
	 * @return bool|int|void
	 */
	function depot_mikado_get_top_bar_background_height() {

		$top_bar_height = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('top_bar_height'));
		$header_height = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('menu_area_height'));

		if($top_bar_height == ''){
			$top_bar_height = 55;
		}
		if($header_height == ''){
			$header_height = 90;
		}

		$top_bar_background_height = round($top_bar_height) + round($header_height / 2);
		
		return $top_bar_background_height;
	}
}

if(!function_exists('depot_mikado_get_sticky_header_height')) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function depot_mikado_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if((depot_mikado_get_meta_field_intersect('header_type') === 'header-standard' || depot_mikado_get_meta_field_intersect('header_type') === 'header-divided') && in_array(depot_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;
    }
}

if(!function_exists('depot_mikado_get_sticky_header_height_of_complete_transparency')) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function depot_mikado_get_sticky_header_height_of_complete_transparency() {

        if((depot_mikado_get_meta_field_intersect('header_type') === 'header-standard' || depot_mikado_get_meta_field_intersect('header_type') === 'header-divided')) {
            $stickyHeaderTransparent = depot_mikado_options()->getOptionValue('sticky_header_background_color') !== '' && depot_mikado_options()->getOptionValue('sticky_header_transparency') === '0';

            if($stickyHeaderTransparent) {
                return 0;
            } else {
                $sticky_header_height = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('sticky_header_height'));

                return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
            }
        }

        return 0;
    }
}

if(!function_exists('depot_mikado_get_sticky_scroll_amount')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function depot_mikado_get_sticky_scroll_amount() {

		//sticky menu scroll amount
		if(depot_mikado_options()->getOptionValue('header_type') !== 'header-vertical' &&
			depot_mikado_options()->getOptionValue('header_type') !== 'header-vertical-compact' &&
			in_array(depot_mikado_get_meta_field_intersect('header_behaviour', depot_mikado_get_page_id()), array(
				'sticky-header-on-scroll-up',
				'sticky-header-on-scroll-down-up'
			))
		) {

			$sticky_scroll_amount = depot_mikado_filter_px(depot_mikado_get_meta_field_intersect('scroll_amount_for_sticky'));

			return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
		}

        return 0;
    }
}