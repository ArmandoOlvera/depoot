<?php

foreach(glob(MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/header/custom-styles/*/*.php') as $options_load) {
	include_once $options_load;
}

if(!function_exists('depot_mikado_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function depot_mikado_header_top_bar_styles() {
    	$top_header_height = depot_mikado_options()->getOptionValue('top_bar_height');
        if(!empty($top_header_height)) {
            echo depot_mikado_dynamic_css('.mkd-top-bar', array('height' => depot_mikado_filter_px($top_header_height).'px'));
            echo depot_mikado_dynamic_css('.mkd-top-bar .mkd-logo-wrapper a', array('max-height' => depot_mikado_filter_px($top_header_height).'px'));
        }

		echo depot_mikado_dynamic_css('.mkd-top-bar-background', array('height' => depot_mikado_get_top_bar_background_height().'px'));

		if(depot_mikado_options()->getOptionValue('top_bar_in_grid') == 'yes') {
			$top_bar_grid_selector = '.mkd-top-bar .mkd-grid .mkd-vertical-align-containers';
			$top_bar_grid_styles   = array();
			if(depot_mikado_options()->getOptionValue('top_bar_grid_background_color') !== '') {
				$grid_background_color        = depot_mikado_options()->getOptionValue('top_bar_grid_background_color');
				$grid_background_transparency = 1;

				if(depot_mikado_options()->getOptionValue('top_bar_grid_background_transparency')) {
					$grid_background_transparency = depot_mikado_options()->getOptionValue('top_bar_grid_background_transparency');
				}

				$grid_background_color = depot_mikado_rgba_color($grid_background_color, $grid_background_transparency);
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}

			echo depot_mikado_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
		}

		$background_color = depot_mikado_options()->getOptionValue('top_bar_background_color');
		$border_color     = depot_mikado_options()->getOptionValue('top_bar_border_color');
		$top_bar_styles   = array();
		if($background_color !== '') {
			$background_transparency = 1;
			if(depot_mikado_options()->getOptionValue('top_bar_background_transparency') !== '') {
				$background_transparency = depot_mikado_options()->getOptionValue('top_bar_background_transparency');
			}

			$background_color                   = depot_mikado_rgba_color($background_color, $background_transparency);
			$top_bar_styles['background-color'] = $background_color;

			echo depot_mikado_dynamic_css('.mkd-top-bar-background', array('background-color'=>$background_color));
		}

		if(depot_mikado_options()->getOptionValue('top_bar_border') == 'yes' && $border_color != '') {
			$top_bar_styles['border-bottom'] = '1px solid '.$border_color;
		}

		echo depot_mikado_dynamic_css('.mkd-top-bar', $top_bar_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_header_top_bar_styles');
}

if(!function_exists('depot_mikado_header_menu_area_styles')) {
    /**
     * Generates styles for menu area
     */
    function depot_mikado_header_menu_area_styles() {

		$background_color = depot_mikado_options()->getOptionValue('menu_area_background_color');
		$background_color_transparency = depot_mikado_options()->getOptionValue('menu_area_background_transparency');
		$menu_area_height = depot_mikado_options()->getOptionValue('menu_area_height');
		$menu_area_shadow = depot_mikado_options()->getOptionValue('menu_area_shadow');
		$border = depot_mikado_options()->getOptionValue('menu_area_border');
		$border_color = depot_mikado_options()->getOptionValue('menu_area_border_color');

		$menu_area_in_grid = depot_mikado_options()->getOptionValue('menu_area_in_grid');
		$background_color_grid = depot_mikado_options()->getOptionValue('menu_area_grid_background_color');
		$background_color_transparency_grid = depot_mikado_options()->getOptionValue('menu_area_grid_background_transparency');
		$menu_area_shadow_grid = depot_mikado_options()->getOptionValue('menu_area_in_grid_shadow');
		$border_grid = depot_mikado_options()->getOptionValue('menu_area_in_grid_border');
		$border_color_grid = depot_mikado_options()->getOptionValue('menu_area_in_grid_border_color');

		$menu_area_styles = array();

		if($background_color !== '') {
			$menu_area_background_color = $background_color;
			$menu_area_background_transparency = 1;

			if($background_color_transparency !== '') {
				$menu_area_background_transparency = $background_color_transparency;
			}

			$menu_area_styles['background-color'] = depot_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
		}

		if($menu_area_height !== '') {
			$max_height = intval(depot_mikado_filter_px($menu_area_height) * 0.9).'px';
			echo depot_mikado_dynamic_css('.mkd-page-header .mkd-menu-area .mkd-logo-wrapper a', array('max-height' => $max_height));

			$menu_area_styles['height'] = depot_mikado_filter_px($menu_area_height).'px !important';
		}

		if($menu_area_shadow == 'yes') {
			$menu_area_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}

		if($border == 'yes') {
			$header_border_color = $border_color;

			if($header_border_color !== '') {
				$menu_area_styles['border-bottom'] = '1px solid '.$header_border_color;
			}
		}

		echo depot_mikado_dynamic_css('.mkd-page-header .mkd-menu-area', $menu_area_styles);

		$menu_area_grid_styles = array();

		if($menu_area_in_grid == 'yes' && $background_color_grid !== '') {
			$menu_area_grid_background_color = $background_color_grid;
			$menu_area_grid_background_transparency = 1;

			if($background_color_transparency_grid !== '') {
				$menu_area_grid_background_transparency = $background_color_transparency_grid;
			}

			$menu_area_grid_styles['background-color'] = depot_mikado_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
		}

		if($menu_area_shadow_grid == 'yes'){
			$menu_area_grid_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}

		if($menu_area_in_grid == 'yes' && $border_grid == 'yes') {

			$header_gird_border_color = $border_color_grid;

			if($header_gird_border_color !== '') {
				$menu_area_grid_styles['border-bottom'] = '1px solid '.$header_gird_border_color;
			}
		}

		echo depot_mikado_dynamic_css('.mkd-page-header .mkd-menu-area .mkd-grid .mkd-vertical-align-containers', $menu_area_grid_styles);

    }
    
    add_action('depot_mikado_style_dynamic', 'depot_mikado_header_menu_area_styles');
}

if(!function_exists('depot_mikado_header_logo_area_styles')) {
	/**
	 * Generates styles for menu area
	 */
	function depot_mikado_header_logo_area_styles() {

		$background_color = depot_mikado_options()->getOptionValue('logo_area_background_color');
		$background_color_transparency = depot_mikado_options()->getOptionValue('logo_area_background_transparency');
		$logo_area_height = depot_mikado_options()->getOptionValue('logo_area_height');
		$border = depot_mikado_options()->getOptionValue('logo_area_border');
		$border_color = depot_mikado_options()->getOptionValue('logo_area_border_color');

		$logo_area_in_grid = depot_mikado_options()->getOptionValue('logo_area_in_grid');
		$background_color_grid = depot_mikado_options()->getOptionValue('logo_area_grid_background_color');
		$background_color_transparency_grid = depot_mikado_options()->getOptionValue('logo_area_grid_background_transparency');
		$border_grid = depot_mikado_options()->getOptionValue('logo_area_in_grid_border');
		$border_color_grid = depot_mikado_options()->getOptionValue('logo_area_in_grid_border_color');

		$logo_area_styles = array();

		if($background_color !== '') {
			$logo_area_background_color = $background_color;
			$logo_area_background_transparency = 1;

			if($background_color_transparency !== '') {
				$logo_area_background_transparency = $background_color_transparency;
			}

			$logo_area_styles['background-color'] = depot_mikado_rgba_color($logo_area_background_color, $logo_area_background_transparency);
		}

		if($logo_area_height !== '') {
			$max_height = intval(depot_mikado_filter_px($logo_area_height) * 0.9).'px';
			echo depot_mikado_dynamic_css('.mkd-page-header .mkd-logo-area .mkd-logo-wrapper a', array('max-height' => $max_height));

			$logo_area_styles['height'] = depot_mikado_filter_px($logo_area_height).'px !important';
		}

		if($border == 'yes') {
			$header_border_color = $border_color;

			if($header_border_color !== '') {
				$logo_area_styles['border-bottom'] = '1px solid '.$header_border_color;
			}
		}

		echo depot_mikado_dynamic_css('.mkd-page-header .mkd-logo-area', $logo_area_styles);

		$logo_area_grid_styles = array();

		if($logo_area_in_grid == 'yes' && $background_color_grid !== '') {
			$logo_area_grid_background_color = $background_color_grid;
			$logo_area_grid_background_transparency = 1;

			if($background_color_transparency_grid !== '') {
				$logo_area_grid_background_transparency = $background_color_transparency_grid;
			}

			$logo_area_grid_styles['background-color'] = depot_mikado_rgba_color($logo_area_grid_background_color, $logo_area_grid_background_transparency);
		}

		if($logo_area_in_grid == 'yes' && $border_grid == 'yes') {

			$header_gird_border_color = $border_color_grid;

			if($header_gird_border_color !== '') {
				$logo_area_grid_styles['border-bottom'] = '1px solid '.$header_gird_border_color;
			}
		}

		echo depot_mikado_dynamic_css('.mkd-page-header .mkd-logo-area .mkd-grid .mkd-vertical-align-containers', $logo_area_grid_styles);

		if(depot_mikado_options()->getOptionValue('logo_wrapper_padding_header_centered') !== '') {
			echo depot_mikado_dynamic_css('.mkd-header-centered .mkd-logo-area .mkd-logo-wrapper', array('padding'=>depot_mikado_options()->getOptionValue('logo_wrapper_padding_header_centered')));
		}

	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_header_logo_area_styles');
}



if(!function_exists('depot_mikado_vertical_menu_styles')) {
	function depot_mikado_vertical_menu_styles() {
		$vertical_header_styles = array();

		$vertical_header_selectors = array(
			'.mkd-vertical-menu-area .mkd-vertical-area-background'
		);

		if(depot_mikado_options()->getOptionValue('vertical_header_background_color') !== '') {
			$vertical_header_styles['background-color'] = depot_mikado_options()->getOptionValue('vertical_header_background_color');
		}

		if(depot_mikado_options()->getOptionValue('vertical_header_background_image') !== '') {
			$vertical_header_styles['background-image'] = 'url('.depot_mikado_options()->getOptionValue('vertical_header_background_image').')';
		}

		if(depot_mikado_options()->getOptionValue('vertical_header_shadow') == 'yes') {
			$vertical_header_styles['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}

		if(depot_mikado_options()->getOptionValue('vertical_header_border') == 'yes') {

			$header_border_color = depot_mikado_options()->getOptionValue('vertical_header_border_color');

			if($header_border_color !== '') {
				$vertical_header_styles['border-right'] = '1px solid '.$header_border_color;
			}
		}

		echo depot_mikado_dynamic_css($vertical_header_selectors, $vertical_header_styles);
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_vertical_menu_styles');
}

if(!function_exists('depot_mikado_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function depot_mikado_sticky_header_styles() {
    	$background_color = depot_mikado_options()->getOptionValue('sticky_header_background_color');
	    $background_transparency = depot_mikado_options()->getOptionValue('sticky_header_transparency');
	    $border_color = depot_mikado_options()->getOptionValue('sticky_header_border_color');
	    $header_height = depot_mikado_options()->getOptionValue('sticky_header_height');
    	
        if(!empty($background_color)) {
            $header_background_color              = $background_color;
            $header_background_color_transparency = 1;
		
		    if($background_transparency !== '') {
                $header_background_color_transparency = $background_transparency;
            }

            echo depot_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder', array('background-color' => depot_mikado_rgba_color($header_background_color, $header_background_color_transparency)));
        }
	
	    if(!empty($border_color)) {
		    echo depot_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder', array('border-color' => $border_color));
        }
	
	    if(!empty($header_height)) {
            $height = depot_mikado_filter_px($header_height).'px';

            echo depot_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header', array('height' => $height));
            echo depot_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-logo-wrapper a', array('max-height' => $height));
        }
	
	    // sticky menu style
	
	    $menu_item_styles = depot_mikado_get_typography_styles('sticky');

        $menu_item_selector = array(
            '.mkd-main-menu.mkd-sticky-nav > ul > li > a'
        );

        echo depot_mikado_dynamic_css($menu_item_selector, $menu_item_styles);
	    
	
	    $hover_color = depot_mikado_options()->getOptionValue('sticky_hovercolor');
	    
        $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
            $menu_item_hover_styles['color'] = $hover_color;
        }

        $menu_item_hover_selector = array(
            '.mkd-main-menu.mkd-sticky-nav > ul > li:hover > a',
            '.mkd-main-menu.mkd-sticky-nav > ul > li.mkd-active-item > a'
        );

        echo depot_mikado_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_sticky_header_styles');
}

if(!function_exists('depot_mikado_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function depot_mikado_fixed_header_styles() {
	    $background_color = depot_mikado_options()->getOptionValue('fixed_header_background_color');
	    $background_transparency = depot_mikado_options()->getOptionValue('fixed_header_transparency');
	    $border_color = depot_mikado_options()->getOptionValue('fixed_header_border_bottom_color');
    	
    	$fixed_area_styles = array();
	    if(!empty($background_color)) {
            $fixed_header_background_color        = $background_color;
            $fixed_header_background_color_transparency = 1;
		
		    if($background_transparency !== '') {
                $fixed_header_background_color_transparency = $background_transparency;
            }

            $fixed_area_styles['background-color'] = depot_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        if(empty($background_color) && $background_transparency !== '') {
            $fixed_header_background_color        = '#fff';
            $fixed_header_background_color_transparency = $background_transparency;

            $fixed_area_styles['background-color'] = depot_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        if(empty($background_color) && $background_transparency == '') {
            $fixed_header_background_color        = '#fff';
            $fixed_header_background_color_transparency = 1;

            $fixed_area_styles['background-color'] = depot_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency) . '!important';
        }

        $selector = array(
            '.mkd-page-header .mkd-fixed-wrapper.fixed .mkd-menu-area'
        );

        echo depot_mikado_dynamic_css($selector, $fixed_area_styles);

        $fixed_area_holder_styles = array();
	
	    if(!empty($border_color)) {
            $fixed_area_holder_styles['border-bottom-color'] = $border_color;
        }

        $selector_holder = array(
            '.mkd-page-header .mkd-fixed-wrapper.fixed'
        );

        echo depot_mikado_dynamic_css($selector_holder, $fixed_area_holder_styles);
	
	    // fixed menu style
	    
	    $menu_item_styles = depot_mikado_get_typography_styles('fixed');
	
	    $menu_item_selector = array(
		    '.mkd-fixed-wrapper.fixed .mkd-main-menu > ul > li > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_selector, $menu_item_styles);
	
	    
	    $hover_color = depot_mikado_options()->getOptionValue('fixed_hovercolor');
	
	    $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
		    $menu_item_hover_styles['color'] = $hover_color;
	    }
	
	    $menu_item_hover_selector = array(
		    '.mkd-fixed-wrapper.fixed .mkd-main-menu > ul > li:hover > a',
		    '.mkd-fixed-wrapper.fixed .mkd-main-menu > ul > li.mkd-active-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_fixed_header_styles');
}

if(!function_exists('depot_mikado_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function depot_mikado_main_menu_styles() {
	
	    // main menu 1st level style
	    
	    $menu_item_styles = depot_mikado_get_typography_styles('menu');
	    $padding = depot_mikado_options()->getOptionValue('menu_padding_left_right');
	    $margin = depot_mikado_options()->getOptionValue('menu_margin_left_right');
	
	    if(!empty($padding)) {
		    $menu_item_styles['padding'] = '0 '.depot_mikado_filter_px($padding).'px';
	    }
	    if(!empty($margin)) {
		    $menu_item_styles['margin'] = '0 '.depot_mikado_filter_px($margin).'px';
	    }
	    
	    $menu_item_selector = array(
		    '.mkd-main-menu > ul > li > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_selector, $menu_item_styles);

        $background_color_dropdown = depot_mikado_options()->getOptionValue('dropdown_background_color');

        $background_transparency_dropdown = depot_mikado_options()->getOptionValue('dropdown_background_transparency');

        if ($background_transparency_dropdown === '') {
            $background_transparency_dropdown = 1;
        }

        $background_transparency_dropdown_rgba = depot_mikado_rgba_color($background_color_dropdown, $background_transparency_dropdown);

        $menu_dropdown_background_styles = array();
        if(!empty($background_color_dropdown)) {
            $menu_dropdown_background_styles['background-color'] = $background_transparency_dropdown_rgba;
        }

        $menu_dropdown_background_selector = array(
            '.mkd-drop-down .narrow .second .inner ul',
            '.mkd-drop-down .wide .second .inner',
			'.mkd-full-width-wide-menu .mkd-drop-down .wide .second'
        );

        echo depot_mikado_dynamic_css($menu_dropdown_background_selector, $menu_dropdown_background_styles);
	    
	    $hover_color = depot_mikado_options()->getOptionValue('menu_hovercolor');
	
	    $menu_item_hover_styles = array();
	    if(!empty($hover_color)) {
		    $menu_item_hover_styles['color'] = $hover_color;
	    }
	
	    $menu_item_hover_selector = array(
		    '.mkd-main-menu > ul > li > a:hover'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_hover_selector, $menu_item_hover_styles);
	    
	    $active_color = depot_mikado_options()->getOptionValue('menu_activecolor');
	
	    $menu_item_active_styles = array();
	    if(!empty($active_color)) {
		    $menu_item_active_styles['color'] = $active_color;
	    }
	
	    $menu_item_active_selector = array(
		    '.mkd-main-menu > ul > li.mkd-active-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_active_selector, $menu_item_active_styles);
	    
	    $light_hover_color = depot_mikado_options()->getOptionValue('menu_light_hovercolor');
	
	    $menu_item_light_hover_styles = array();
	    if(!empty($light_hover_color)) {
		    $menu_item_light_hover_styles['color'] = $light_hover_color;
	    }
	
	    $menu_item_light_hover_selector = array(
		    '.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header):not(.mkd-fixed-wrapper) .mkd-main-menu > ul > li > a:hover'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_light_hover_selector, $menu_item_light_hover_styles);
	    
	    $light_active_color = depot_mikado_options()->getOptionValue('menu_light_activecolor');
	
	    $menu_item_light_active_styles = array();
	    if(!empty($light_active_color)) {
		    $menu_item_light_active_styles['color'] = $light_active_color;
	    }
	
	    $menu_item_light_active_selector = array(
		    '.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header):not(.mkd-fixed-wrapper) .mkd-main-menu > ul > li.mkd-active-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_light_active_selector, $menu_item_light_active_styles);
	    
	    $dark_hover_color = depot_mikado_options()->getOptionValue('menu_dark_hovercolor');
	
	    $menu_item_dark_hover_styles = array();
	    if(!empty($dark_hover_color)) {
		    $menu_item_dark_hover_styles['color'] = $dark_hover_color;
	    }
	
	    $menu_item_dark_hover_selector = array(
		    '.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header):not(.mkd-fixed-wrapper) .mkd-main-menu > ul > li > a:hover'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_dark_hover_selector, $menu_item_dark_hover_styles);
	    
	    $dark_active_color = depot_mikado_options()->getOptionValue('menu_dark_activecolor');
	
	    $menu_item_dark_active_styles = array();
	    if(!empty($dark_active_color)) {
		    $menu_item_dark_active_styles['color'] = $dark_active_color;
	    }
	
	    $menu_item_dark_active_selector = array(
		    '.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header):not(.mkd-fixed-wrapper) .mkd-main-menu > ul > li.mkd-active-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($menu_item_dark_active_selector, $menu_item_dark_active_styles);
	
	    // main menu 2nd level style
	    
	    $dropdown_menu_item_styles = depot_mikado_get_typography_styles('dropdown');
	
	    $dropdown_menu_item_selector = array(
		    '.mkd-drop-down .second .inner > ul > li > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_menu_item_selector, $dropdown_menu_item_styles);
	    
	    $dropdown_hover_color = depot_mikado_options()->getOptionValue('dropdown_hovercolor');
	
	    $dropdown_menu_item_hover_styles = array();
	    if(!empty($dropdown_hover_color)) {
		    $dropdown_menu_item_hover_styles['color'] = $dropdown_hover_color . ' !important';
	    }
	
	    $dropdown_menu_item_hover_selector = array(
		    '.mkd-drop-down .second .inner > ul > li > a:hover',
            '.mkd-drop-down .second .inner > ul > li.current-menu-ancestor > a',
            '.mkd-drop-down .second .inner > ul > li.current-menu-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_menu_item_hover_selector, $dropdown_menu_item_hover_styles);
	
	    // main menu 2nd level wide style
	    
	    $dropdown_wide_menu_item_styles = depot_mikado_get_typography_styles('dropdown_wide');
	
	    $dropdown_wide_menu_item_selector = array(
		    '.mkd-drop-down .wide .second .inner > ul > li > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_wide_menu_item_selector, $dropdown_wide_menu_item_styles);
	
	    $dropdown_wide_hover_color = depot_mikado_options()->getOptionValue('dropdown_wide_hovercolor');
	
	    $dropdown_wide_menu_item_hover_styles = array();
	    if(!empty($dropdown_wide_hover_color)) {
		    $dropdown_wide_menu_item_hover_styles['color'] = $dropdown_wide_hover_color . ' !important';
	    }
	
	    $dropdown_wide_menu_item_hover_selector = array(
		    '.mkd-drop-down .wide .second .inner > ul > li > a:hover',
		    '.mkd-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a',
		    '.mkd-drop-down .wide .second .inner > ul > li.current-menu-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_wide_menu_item_hover_selector, $dropdown_wide_menu_item_hover_styles);
	
	    // main menu 3rd level style
	    
	    $dropdown_menu_item_styles_thirdlvl = depot_mikado_get_typography_styles('dropdown', '_thirdlvl');
	
	    $dropdown_menu_item_selector_thirdlvl = array(
		    '.mkd-drop-down .second .inner ul li ul li a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_menu_item_selector_thirdlvl, $dropdown_menu_item_styles_thirdlvl);
	
	    $dropdown_hover_color_thirdlvl = depot_mikado_options()->getOptionValue('dropdown_hovercolor_thirdlvl');
	
	    $dropdown_menu_item_hover_styles_thirdlvl = array();
	    if(!empty($dropdown_hover_color_thirdlvl)) {
		    $dropdown_menu_item_hover_styles_thirdlvl['color'] = $dropdown_hover_color_thirdlvl . ' !important';
	    }
	
	    $dropdown_menu_item_hover_selector_thirdlvl = array(
		    '.mkd-drop-down .second .inner ul li ul li a:hover',
            '.mkd-drop-down .second .inner ul li ul li.current-menu-ancestor > a',
            '.mkd-drop-down .second .inner ul li ul li.current-menu-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_menu_item_hover_selector_thirdlvl, $dropdown_menu_item_hover_styles_thirdlvl);
	
	    // main menu 3rd level wide style
	    
	    $dropdown_wide_menu_item_styles_thirdlvl = depot_mikado_get_typography_styles('dropdown_wide', '_thirdlvl');
	
	    $dropdown_wide_menu_item_selector_thirdlvl = array(
		    '.mkd-drop-down .wide .second .inner ul li ul li a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_wide_menu_item_selector_thirdlvl, $dropdown_wide_menu_item_styles_thirdlvl);
	    
	    $dropdown_wide_hover_color_thirdlvl = depot_mikado_options()->getOptionValue('dropdown_wide_hovercolor_thirdlvl');
	
	    $dropdown_wide_menu_item_hover_styles_thirdlvl = array();
	    if(!empty($dropdown_wide_hover_color_thirdlvl)) {
		    $dropdown_wide_menu_item_hover_styles_thirdlvl['color'] = $dropdown_wide_hover_color_thirdlvl . ' !important';
	    }
	
	    $dropdown_wide_menu_item_hover_selector_thirdlvl = array(
		    '.mkd-drop-down .wide .second .inner ul li ul li a:hover',
		    '.mkd-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a',
		    '.mkd-drop-down .wide .second .inner ul li ul li.current-menu-item > a'
	    );
	
	    echo depot_mikado_dynamic_css($dropdown_wide_menu_item_hover_selector_thirdlvl, $dropdown_wide_menu_item_hover_styles_thirdlvl);
	
	    // main menu dropdown holder style
	    
		$dropdown_top_position = depot_mikado_options()->getOptionValue('dropdown_top_position');
		
		$dropdown_styles = array();
		if($dropdown_top_position !== '') {
			$dropdown_styles['top'] = $dropdown_top_position.'%';
		}
		
		$dropdown_selector = array(
			'.mkd-page-header .mkd-drop-down .second'
		);
		
		echo depot_mikado_dynamic_css($dropdown_selector, $dropdown_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_main_menu_styles');
}

if(!function_exists('depot_mikado_vertical_main_menu_styles')) {
	/**
	 * Generates styles for vertical main main menu
	 */
	function depot_mikado_vertical_main_menu_styles() {
		$menu_holder_styles = array();

		if(depot_mikado_options()->getOptionValue('vertical_menu_top_margin') !== '') {
			$menu_holder_styles['margin-top'] = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('vertical_menu_top_margin')).'px';
		}
		if(depot_mikado_options()->getOptionValue('vertical_menu_bottom_margin') !== '') {
			$menu_holder_styles['margin-bottom'] = depot_mikado_filter_px(depot_mikado_options()->getOptionValue('vertical_menu_bottom_margin')).'px';
		}

		$menu_holder_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu'
		);

		echo depot_mikado_dynamic_css($menu_holder_selector, $menu_holder_styles);
		
		// vertical menu 1st level style
		
		$first_level_styles = depot_mikado_get_typography_styles('vertical_menu_1st');
		
		$first_level_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu > ul > li > a'
		);
		
		echo depot_mikado_dynamic_css($first_level_selector, $first_level_styles);
		
		$first_level_hover_styles = array();
		
		if(depot_mikado_options()->getOptionValue('vertical_menu_1st_hover_color') !== '') {
			$first_level_hover_styles['color'] = depot_mikado_options()->getOptionValue('vertical_menu_1st_hover_color');
		}
		
		$first_level_hover_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu > ul > li > a:hover',
			'.mkd-header-vertical .mkd-vertical-menu > ul > li > a.mkd-active-item',
			'.mkd-header-vertical .mkd-vertical-menu > ul > li > a.current-menu-ancestor'
		);

		echo depot_mikado_dynamic_css($first_level_hover_selector, $first_level_hover_styles);
		
		// vertical menu 2nd level style
		
		$second_level_styles = depot_mikado_get_typography_styles('vertical_menu_2nd');
		
		$second_level_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu .second .inner > ul > li > a'
		);
		
		echo depot_mikado_dynamic_css($second_level_selector, $second_level_styles);
		
		$second_level_hover_styles = array();

		if(depot_mikado_options()->getOptionValue('vertical_menu_2nd_hover_color') !== '') {
			$second_level_hover_styles['color'] = depot_mikado_options()->getOptionValue('vertical_menu_2nd_hover_color');
		}
		
		$second_level_hover_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu .second .inner > ul > li > a:hover',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner > ul > li.current_page_item > a',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner > ul > li.current-menu-item > a',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner > ul > li.current-menu-ancestor > a'
		);

		echo depot_mikado_dynamic_css($second_level_hover_selector, $second_level_hover_styles);
		
		// vertical menu 3rd level style
		
		$third_level_styles = depot_mikado_get_typography_styles('vertical_menu_3rd');
		
		$third_level_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu .second .inner ul li ul li a'
		);
		
		echo depot_mikado_dynamic_css($third_level_selector, $third_level_styles);
		
		
		$third_level_hover_styles = array();

		if(depot_mikado_options()->getOptionValue('vertical_menu_3rd_hover_color') !== '') {
			$third_level_hover_styles['color'] = depot_mikado_options()->getOptionValue('vertical_menu_3rd_hover_color');
		}
		
		$third_level_hover_selector = array(
			'.mkd-header-vertical .mkd-vertical-menu .second .inner ul li ul li a:hover',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner ul li ul li a.mkd-active-item',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner ul li ul li.current_page_item a',
			'.mkd-header-vertical .mkd-vertical-menu .second .inner ul li ul li.current-menu-item a'
		);

		echo depot_mikado_dynamic_css($third_level_hover_selector, $third_level_hover_styles);
	}

	add_action('depot_mikado_style_dynamic', 'depot_mikado_vertical_main_menu_styles');
}