<?php
if(!function_exists('depot_mikado_header_menu_area_options_map')) {

	function depot_mikado_header_menu_area_options_map($panel_header){

		$menu_area_container = depot_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-vertical-compact','header-vertical-closed')
			)
		);

		depot_mikado_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Menu Area Style', 'depot')
			)
		);

        $menu_area_position_header_standard_container = depot_mikado_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_standard_container',
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-minimal','header-divided','header-centered')
            )
        );

            depot_mikado_add_admin_field(
                array(
                    'parent'		=> $menu_area_position_header_standard_container,
                    'type'			=> 'select',
                    'name'			=> 'menu_area_position_header_standard',
                    'default_value'	=> 'center',
                    'options' => array(
                        'center'	=> esc_html__('Center', 'depot'),
                        'right'		=> esc_html__('Right', 'depot'),
                    ),
                    'label'			=> esc_html__('Menu Area Position', 'depot'),
                    'description'	=> esc_html__('Set posistion of menu area for Standard Header Type', 'depot'),
                )
            );

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area In Grid', 'depot'),
				'description' => esc_html__('Set menu area content to be in grid', 'depot'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_container'
				)
			)
		);

		$menu_area_in_grid_container = depot_mikado_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_in_grid_container',
				'hidden_property' => 'menu_area_in_grid',
				'hidden_value' => 'no'
			)
		);

			depot_mikado_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'color',
					'name' => 'menu_area_grid_background_color',
					'default_value' => '',
					'label' => esc_html__('Grid Background Color', 'depot'),
					'description' => esc_html__('Set grid background color for menu area', 'depot'),
				)
			);

			depot_mikado_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'text',
					'name' => 'menu_area_grid_background_transparency',
					'default_value' => '',
					'label' => esc_html__('Grid Background Transparency', 'depot'),
					'description' => esc_html__('Set grid background transparency for menu area', 'depot'),
					'args' => array(
						'col_width' => 3
					)
				)
			);

			depot_mikado_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_shadow',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Shadow', 'depot'),
					'description' => esc_html__('Set shadow on grid area', 'depot')
				)
			);

			depot_mikado_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_border',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Border', 'depot'),
					'description' => esc_html__('Set border on grid area', 'depot'),
					'args' => array(
						'dependence' => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_container'
					)
				)
			);

			$menu_area_in_grid_border_container = depot_mikado_add_admin_container(
				array(
					'parent' => $menu_area_in_grid_container,
					'name' => 'menu_area_in_grid_border_container',
					'hidden_property' => 'menu_area_in_grid_border',
					'hidden_value' => 'no'
				)
			);

				depot_mikado_add_admin_field(
					array(
						'parent' => $menu_area_in_grid_border_container,
						'type' => 'color',
						'name' => 'menu_area_in_grid_border_color',
						'default_value' => '',
						'label' => esc_html__('Border Color', 'depot'),
						'description' => esc_html__('Set border color for menu area', 'depot'),
					)
				);

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'color',
				'name' => 'menu_area_background_color',
				'default_value' => '',
				'label' => esc_html__('Background color', 'depot'),
				'description' => esc_html__('Set background color for menu area', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_background_transparency',
				'default_value' => '',
				'label' => esc_html__('Background transparency', 'depot'),
				'description' => esc_html__('Set background transparency for menu area', 'depot'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_shadow',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Area Shadow', 'depot'),
				'description' => esc_html__('Set shadow on menu area', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_border',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Border', 'depot'),
				'description' => esc_html__('Set border on menu area', 'depot'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_container'
				)
			)
		);

		$menu_area_border_container = depot_mikado_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_border_container',
				'hidden_property' => 'menu_area_border',
				'hidden_value' => 'no'
			)
		);

			depot_mikado_add_admin_field(
				array(
					'parent' => $menu_area_border_container,
					'type' => 'color',
					'name' => 'menu_area_border_color',
					'default_value' => '',
					'label' => esc_html__('Border Color', 'depot'),
					'description' => esc_html__('Set border color for menu area', 'depot'),
				)
			);

		depot_mikado_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_height',
				'default_value' => '',
				'label' => esc_html__('Height', 'depot'),
				'description' => esc_html__('Enter header height', 'depot'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		do_action('depot_mikado_header_menu_area_additional_options', $panel_header);
	}

	add_action('depot_mikado_header_menu_area_options_map', 'depot_mikado_header_menu_area_options_map', 10, 1);
}