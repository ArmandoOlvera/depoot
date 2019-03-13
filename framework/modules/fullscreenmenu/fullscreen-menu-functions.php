<?php

if(!function_exists('depot_mikado_register_full_screen_menu_nav')) {
    function depot_mikado_register_full_screen_menu_nav() {
	    register_nav_menus(
		    array(
			    'popup-navigation' => esc_html__('Fullscreen Navigation', 'depot')
		    )
	    );
    }

	add_action('after_setup_theme', 'depot_mikado_register_full_screen_menu_nav');
}

if ( !function_exists('depot_mikado_register_full_screen_menu_sidebars') ) {

	function depot_mikado_register_full_screen_menu_sidebars() {

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Top', 'depot'),
			'id' => 'fullscreen_menu_above',
			'description' => esc_html__('This widget area is rendered above fullscreen menu', 'depot'),
			'before_widget' => '<div class="%2$s mkd-fullscreen-menu-above-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="mkd-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Bottom', 'depot'),
			'id' => 'fullscreen_menu_below',
			'description' => esc_html__('This widget area is rendered below fullscreen menu', 'depot'),
			'before_widget' => '<div class="%2$s mkd-fullscreen-menu-below-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="mkd-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));
	}

	add_action('widgets_init', 'depot_mikado_register_full_screen_menu_sidebars');
}

if(!function_exists('depot_mikado_fullscreen_menu_body_class')) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function depot_mikado_fullscreen_menu_body_class($classes) {

		if ( depot_mikado_get_meta_field_intersect('header_type') == 'header-minimal') {

			$classes[] = 'mkd-' . depot_mikado_options()->getOptionValue('fullscreen_menu_animation_style');
		}

		return $classes;
	}

	add_filter('body_class', 'depot_mikado_fullscreen_menu_body_class');
}

if ( !function_exists('depot_mikado_get_full_screen_menu') ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function depot_mikado_get_full_screen_menu() {

		if ( depot_mikado_get_meta_field_intersect('header_type') == 'header-minimal') {

			$parameters = array(
				'fullscreen_menu_in_grid' => depot_mikado_options()->getOptionValue('fullscreen_in_grid') === 'yes' ? true : false
			);

			depot_mikado_get_module_template_part('templates/fullscreen-menu', 'fullscreenmenu', '', $parameters);
		}
	}
	
	add_action('depot_mikado_after_header_area', 'depot_mikado_get_full_screen_menu', 10);
}