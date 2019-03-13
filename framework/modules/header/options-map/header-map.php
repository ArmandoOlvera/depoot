<?php

foreach(glob(MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/header/options-map/*/*.php') as $options_load) {
	include_once $options_load;
}

if ( ! function_exists('depot_mikado_header_options_map') ) {

	function depot_mikado_header_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => esc_html__('Header', 'depot'),
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = depot_mikado_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => esc_html__('Header', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => esc_html__('Choose Header Type', 'depot'),
				'description' => esc_html__('Select the type of header you would like to use', 'depot'),
				'options' => array(
					'header-standard'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-standard.png',
						'label' => esc_html__('Standard', 'depot')
					),
					'header-minimal'           => array(
						'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-minimal.png',
						'label' => esc_html__('Minimal', 'depot')
					),
					'header-divided'           => array(
						'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-divided.png',
						'label' => esc_html__('Divided', 'depot')
					),
					'header-centered'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-centered.png',
						'label' => esc_html__('Centered', 'depot')
					),
					'header-vertical'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT.'/admin/assets/img/header-vertical.png',
						'label' => esc_html__('Vertical', 'depot')
					)
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard'          => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header,#mkd_menu_area_position_header_standard_container',
						'header-standard-extended' => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_logo_area_container,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-box'               => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-minimal'           => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_panel_fullscreen_menu,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-divided'           => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-centered'          => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_logo_area_container,#mkd_logo_wrapper_padding_header_centered,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-top-menu'		   => '#mkd_menu_area_container,#mkd_logo_area_container,#mkd_panel_main_menu',
						'header-tabbed'            => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-vertical'          => '#mkd_vertical_area_container,#mkd_panel_vertical_main_menu',
						'header-vertical-compact'  => '#mkd_vertical_area_container,#mkd_panel_vertical_main_menu',
						'header-vertical-closed'   => '#mkd_vertical_area_container,#mkd_panel_vertical_main_menu',
					),
					'hide' => array(
						'header-standard'          => '#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu',
						'header-standard-extended' => '#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-box'               => '#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-minimal'           => '#mkd_logo_area_container,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-divided'           => '#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-centered'          => '#mkd_panel_fullscreen_menu,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-top-menu'		   => '#mkd_top_header_container,#mkd_panel_fullscreen_menu,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_fixed_header,#mkd_menu_area_position_header_standard_container',
						'header-tabbed'            => '#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_vertical_area_container,#mkd_panel_vertical_main_menu,#mkd_menu_area_position_header_standard_container',
						'header-vertical'          => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-vertical-compact'  => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
						'header-vertical-closed'  => '#mkd_top_header_container,#mkd_header_behaviour,#mkd_menu_area_container,#mkd_logo_area_container,#mkd_panel_fullscreen_menu,#mkd_logo_wrapper_padding_header_centered,#mkd_panel_main_menu,#mkd_panel_sticky_header,#mkd_panel_fixed_header',
					)
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'fixed-on-scroll',
				'label' => esc_html__('Choose Header Behaviour', 'depot'),
				'description' => esc_html__('Select the behaviour of header when you scroll down to page', 'depot'),
				'options' => array(
					'sticky-header-on-scroll-up' => esc_html__('Sticky on scroll up', 'depot'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scroll up/down', 'depot'),
					'fixed-on-scroll' => esc_html__('Fixed on scroll', 'depot')
				),
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-vertical','header-vertical-compact','header-vertical-closed','header-top-menu')
			)
		);

		/***************** Top Header Layout - start **********************/

		do_action('depot_mikado_header_top_options_map', $panel_header);

		/***************** Top Header Layout - end **********************/
		
		/***************** Header Skin Options -start ********************/
		
			depot_mikado_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'select',
					'name' => 'header_style',
					'default_value' => '',
					'label' => esc_html__('Header Skin', 'depot'),
					'description' => esc_html__('Choose a predefined header style for header elements (logo, main menu, side menu opener...)', 'depot'),
					'options' => array(
						'' => esc_html__('Default', 'depot'),
						'light-header' => esc_html__('Light', 'depot'),
						'dark-header' => esc_html__('Dark', 'depot')
					)
				)
			);
		/***************** Header Skin Options - end ********************/

		/***************** Logo Area Style - start **********************/
		do_action('depot_mikado_header_logo_area_options_map', $panel_header);
		/***************** Logo Area Style - end **********************/

		/***************** Menu Area Style - start **********************/
		do_action('depot_mikado_header_menu_area_options_map', $panel_header);
		/***************** Menu Area Style - end **********************/

		/***************** Vertical Header Layout *****************/
		do_action('depot_mikado_header_vertical_options_map', $panel_header);
		/***************** Vertical Header Layout *****************/

		/***************** Full Screen Menu Style - start **********************/
		do_action('depot_mikado_header_options_map');
		/***************** Full Screen Menu Style - end **********************/

        /***************** Sticky Header Layout *******************/
		do_action('depot_mikado_header_sticky_options_map');
		/***************** Sticky Header Layout *******************/	

		/***************** Fixed Header Layout ********************/
		do_action('depot_mikado_header_fixed_options_map');
		/***************** Fixed Header Layout ********************/	

		/******************* Main Menu Layout *********************/
		do_action('depot_mikado_header_main_navigation_options_map');
        /******************* Main Menu Layout *********************/

		/****************** Vertical Main Menu Layout ********************/
		do_action('depot_mikado_header_vertical_navigation_options_map');
		/****************** Vertical Main Menu Layout ********************/

		/****************** Vertical Main Menu Layout ********************/
		do_action('depot_mikado_header_mobile_header_options_map');
		/****************** Vertical Main Menu Layout ********************/

	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_header_options_map', 3);
}