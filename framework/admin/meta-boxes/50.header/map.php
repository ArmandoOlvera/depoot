<?php

foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/50.header/*/*.php') as $meta_box_load) {
	include_once $meta_box_load;
}

if(!function_exists('depot_mikado_map_header_meta')) {
    function depot_mikado_map_header_meta() {
        $header_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Header', 'depot'),
                'name' => 'header_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_header_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Header Type', 'depot'),
                'description' => esc_html__('Select header type layout', 'depot'),
                'parent' => $header_meta_box,
                'options' => array(
					''                         => esc_html__('', 'depot'),
					'header-standard'          => esc_html__('Standard Header', 'depot'),
					'header-standard-extended' => esc_html__('Standard Extended Header', 'depot'),
					'header-box'               => esc_html__('"In The Box" Header', 'depot'),
					'header-minimal'           => esc_html__('Minimal Header', 'depot'),
					'header-divided'           => esc_html__('Divided Header', 'depot'),
					'header-centered'          => esc_html__('Centered Header', 'depot'),
					'header-tabbed'            => esc_html__('Tabbed Header', 'depot'),
					'header-top-menu'          => esc_html__('Top Menu Header', 'depot'),
					'header-vertical'          => esc_html__('Vertical Header', 'depot'),
					'header-vertical-compact'  => esc_html__('Vertical Compact Header', 'depot'),
					'header-vertical-closed'   => esc_html__('Vertical Closed Header', 'depot')
                ),
				'args'          => array(
					"dependence" => true,
					'show' => array(
						'header-standard'          => '#mkd_top_header_container,#mkd_menu_area_container,#mkd_menu_area_position_header_standard_container',
						'header-standard-extended' => '#mkd_top_header_container,#mkd_logo_area_container, #mkd_menu_area_container',
						'header-box'               => '#mkd_top_header_container,#mkd_menu_area_container',
						'header-minimal'           => '#mkd_top_header_container,#mkd_menu_area_container',
						'header-divided'           => '#mkd_top_header_container,#mkd_menu_area_container',
						'header-centered'          => '#mkd_top_header_container,#mkd_logo_area_container, #mkd_menu_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta, #mkd_menu_area_position_header_centered_container',
						'header-tabbed'            => '#mkd_top_header_container,#mkd_menu_area_container',
						'header-top-menu'          => '#mkd_logo_area_container,#mkd_menu_area_container',
						'header-vertical'          => '#mkd_header_vertical_area_meta_container',
						'header-vertical-compact'  => '#mkd_header_vertical_area_meta_container',
						'header-vertical-closed'   => '#mkd_header_vertical_area_meta_container'
					),
					'hide' => array(
						''						   => '#mkd_logo_area_container, #mkd_menu_area_container,#mkd_header_vertical_area_meta_container, #mkd_menu_area_position_header_centered_container',
						'header-standard'          => '#mkd_logo_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container, #mkd_menu_area_position_header_centered_container',
						'header-standard-extended' => '#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-box'               => '#mkd_logo_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-minimal'           => '#mkd_logo_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-divided'           => '#mkd_logo_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-centered'          => '#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container',
						'header-tabbed'            => '#mkd_logo_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-top-menu'          => '#mkd_top_header_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta,#mkd_header_vertical_area_meta_container,#mkd_menu_area_position_header_standard_container, #mkd_menu_area_position_header_centered_container',
						'header-vertical'          => '#mkd_top_header_container,#mkd_logo_area_container, #mkd_menu_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta',
						'header-vertical-compact'  => '#mkd_top_header_container,#mkd_logo_area_container, #mkd_menu_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta',
						'header-vertical-closed'   => '#mkd_top_header_container,#mkd_logo_area_container, #mkd_menu_area_container,#mkd_mkd_logo_wrapper_padding_header_centered_meta',
					)
				)
            )
        );

		depot_mikado_add_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'mkd_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__('Choose Header behaviour', 'depot'),
				'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'depot'),
				'options'         => array(
					''                                => '',
					'no-behavior'                     => esc_html__('No Behavior', 'depot'),
					'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'depot'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'depot'),
					'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'depot')
				),
				'hidden_property' => 'mkd_header_type_meta',
				'hidden_value'    => '',
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						''                                => '',
						'sticky-header-on-scroll-up'      => '',
						'sticky-header-on-scroll-down-up' => '#mkd_mkd_sticky_amount_container_meta_container',
						'no-behavior'                     => ''
					),
					'hide'       => array(
						''                                => '#mkd_mkd_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-up'      => '#mkd_mkd_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-down-up' => '',
						'no-behavior'                     => '#mkd_mkd_sticky_amount_container_meta_container'
					)
				)
			)
		);

		$sticky_amount_container = depot_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'mkd_sticky_amount_container_meta_container',
				'hidden_property' => 'mkd_header_behaviour_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('', 'no-behavior', 'sticky-header-on-scroll-up, fixed-on-scroll'),
			)
		);

			depot_mikado_add_meta_box_field(
				array(
					'name'            => 'mkd_scroll_amount_for_sticky_meta',
					'type'            => 'text',
					'label'           => esc_html__('Scroll amount for sticky header appearance', 'depot'),
					'description'     => esc_html__('Define scroll amount for sticky header appearance', 'depot'),
					'parent'          => $sticky_amount_container,
					'args'            => array(
						'col_width' => 2,
						'suffix'    => 'px'
					)
				)
			);

		depot_mikado_add_meta_box_field(
			array(
				'name' => 'mkd_header_style_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Skin', 'depot'),
				'description' => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'depot'),
				'parent' => $header_meta_box,
				'options' => array(
					'' => esc_html__('Default', 'depot'),
					'light-header' => esc_html__('Light', 'depot'),
					'dark-header' => esc_html__('Dark', 'depot')
				)
			)
		);

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_sticky_header_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Sticky Header In Grid', 'depot'),
                'description'   => esc_html__('Set sticky header content to be in grid', 'depot'),
                'parent'        => $header_meta_box,
                'default_value' => '',
                'options'       => array(
                    ''    => esc_html__('Default', 'depot'),
                    'no'  => esc_html__('No', 'depot'),
                    'yes' => esc_html__('Yes', 'depot')
                ),
            )
        );

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_enable_wide_menu_background_meta',
				'type'          => 'select',
				'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'depot'),
				'description'   => esc_html__('Enabling this option will show full width background for wide dropdown type', 'depot'),
				'parent'        => $header_meta_box,
				'default_value' => '',
				'options'       => array(
					''    => esc_html__('', 'depot'),
					'no'  => esc_html__('No', 'depot'),
					'yes' => esc_html__('Yes', 'depot')
				),
			)
		);

		//top area
		do_action('depot_mikado_header_top_area_meta_options_map',$header_meta_box);

		//logo area
		do_action('depot_mikado_header_logo_area_meta_options_map',$header_meta_box);

		//menu area
		do_action('depot_mikado_header_menu_area_meta_options_map',$header_meta_box);

		//vertical area
		do_action('depot_mikado_header_vertical_area_meta_options_map',$header_meta_box);
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_header_meta', 50);
}