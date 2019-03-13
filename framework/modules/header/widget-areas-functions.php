<?php

if(!function_exists('depot_mikado_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function depot_mikado_register_top_header_areas() {

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Left Column', 'depot'),
            'id'            => 'mkd-top-bar-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the left side in top bar header', 'depot')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Middle Column', 'depot'),
            'id'            => 'mkd-top-bar-center',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the middle side in top bar header', 'depot')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Right Column', 'depot'),
            'id'            => 'mkd-top-bar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right side in top bar header', 'depot')
        ));
    }

    add_action('widgets_init', 'depot_mikado_register_top_header_areas');
}

if(!function_exists('depot_mikado_header_widget_areas')) {
    /**
     * Registers widget areas for header types
     */
    function depot_mikado_header_standard_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Header Widget Logo Area', 'depot'),
			'id'            => 'mkd-header-widget-logo-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-header-widget-logo-area">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear in the logo area', 'depot')
		));

		register_sidebar(array(
            'name'          => esc_html__('Header Widget Menu Area Right', 'depot'),
            'id'            => 'mkd-header-widget-menu-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-header-widget-menu-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear in the menu area', 'depot')
        ));
        register_sidebar(array(
            'name'          => esc_html__('Header Widget Menu Area Left', 'depot'),
            'id'            => 'mkd-header-widget-menu-area-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-header-widget-menu-area">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the left side in the menu area of Centered Header', 'depot')
        ));
    }

    add_action('widgets_init', 'depot_mikado_header_standard_widget_areas');
}

if(!function_exists('depot_mikado_header_vertical_widget_top_areas')) {
    /**
     * Registers widget areas for vertical header
     */
    function depot_mikado_header_vertical_widget_top_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Vertical Area Top', 'depot'),
            'id'            => 'mkd-vertical-area-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-vertical-area-widget-top">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear bellow menu items', 'depot')
        ));
    }

    add_action('widgets_init', 'depot_mikado_header_vertical_widget_top_areas');
}

if(!function_exists('depot_mikado_header_vertical_widget_areas')) {
	/**
	 * Registers widget areas for vertical header
	 */
	function depot_mikado_header_vertical_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Vertical Area', 'depot'),
			'id'            => 'mkd-vertical-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-vertical-area-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'depot')
		));
	}

	add_action('widgets_init', 'depot_mikado_header_vertical_widget_areas');
}

if(!function_exists('depot_mikado_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function depot_mikado_register_mobile_header_areas() {
        if(depot_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Mobile Header Widget Area', 'depot'),
                'id'            => 'mkd-mobile-menu-bottom',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-mobile-menu-bottom">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the bottom of mobile menu area', 'depot')
            ));
        }
    }

    add_action('widgets_init', 'depot_mikado_register_mobile_header_areas');
}

if(!function_exists('depot_mikado_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function depot_mikado_register_sticky_header_areas() {
		$id = depot_mikado_get_page_id();

        if(in_array(depot_mikado_get_meta_field_intersect('header_behaviour',$id), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Header Widget Area', 'depot'),
                'id'            => 'mkd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the sticky menu', 'depot')
            ));
        }
    }

    add_action('widgets_init', 'depot_mikado_register_sticky_header_areas');
}