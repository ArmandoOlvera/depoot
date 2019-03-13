<?php
if(!function_exists('depot_mikado_header_logo_area_meta_options_map')) {

	function depot_mikado_header_logo_area_meta_options_map($header_meta_box){
		$logo_area_container = depot_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'mkd_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-standard','header-box','header-minimal','header-divided','header-tabbed','header-vertical','header-vertical-compact','header-vertical-closed')
			));


		depot_mikado_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name' => 'logo_area_style',
				'title' => esc_html__('Logo Area Style', 'depot')
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name' => 'mkd_disable_header_widget_logo_area_meta',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Disable Header Logo Area Widget', 'depot'),
				'description' => esc_html__('Enabling this option will hide widget area from the logo area', 'depot'),
				'parent' => $logo_area_container
			)
		);

		$depot_custom_sidebars = depot_mikado_get_custom_sidebars();
		if(count($depot_custom_sidebars) > 0) {
			depot_mikado_add_meta_box_field(array(
				'name' => 'mkd_custom_logo_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area for Logo Area', 'depot'),
				'description' => esc_html__('Choose custom widget area to display in header logo area"', 'depot'),
				'parent' => $logo_area_container,
				'options' => $depot_custom_sidebars
			));
		}

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_logo_area_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Logo Area In Grid', 'depot'),
			'description'   => esc_html__('Set menu area content to be in grid', 'depot'),
			'parent'        => $logo_area_container,
			'default_value' => '',
			'options'       => array(
				''    => esc_html__('Default', 'depot'),
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#mkd_logo_area_in_grid_container',
					'no'  => '#mkd_logo_area_in_grid_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#mkd_logo_area_in_grid_container'
				)
			)
		));

		$logo_area_in_grid_container = depot_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_in_grid_container',
			'parent'          => $logo_area_container,
			'hidden_property' => 'mkd_logo_area_in_grid_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));


		depot_mikado_add_meta_box_field(
			array(
				'name'        => 'mkd_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Grid Background Color', 'depot'),
				'description' => esc_html__('Set grid background color for logo area', 'depot'),
				'parent'      => $logo_area_in_grid_container
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'        => 'mkd_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Grid Background Transparency', 'depot'),
				'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'depot'),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_logo_area_in_grid_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Border', 'depot'),
			'description'   => esc_html__('Set border on grid logo area', 'depot'),
			'parent'        => $logo_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#mkd_logo_area_in_grid_border_container',
					'no'  => '#mkd_logo_area_in_grid_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#mkd_logo_area_in_grid_border_container'
				)
			)
		));

		$logo_area_in_grid_border_container = depot_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_in_grid_border_container',
			'parent'          => $logo_area_in_grid_container,
			'hidden_property' => 'mkd_logo_area_in_grid_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_logo_area_in_grid_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'depot'),
			'description' => esc_html__('Set border color for grid area', 'depot'),
			'parent'      => $logo_area_in_grid_border_container
		));


		depot_mikado_add_meta_box_field(
			array(
				'name'        => 'mkd_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Background Color', 'depot'),
				'description' => esc_html__('Choose a background color for logo area', 'depot'),
				'parent'      => $logo_area_container
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'        => 'mkd_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Transparency', 'depot'),
				'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'depot'),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_logo_area_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Logo Area Border', 'depot'),
			'description'   => esc_html__('Set border on logo area', 'depot'),
			'parent'        => $logo_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#mkd_logo_area_border_bottom_color_container',
					'no'  => '#mkd_logo_area_border_bottom_color_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#mkd_logo_area_border_bottom_color_container'
				)
			)
		));

		$logo_area_border_bottom_color_container = depot_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_border_bottom_color_container',
			'parent'          => $logo_area_container,
			'hidden_property' => 'mkd_logo_area_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_logo_area_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'depot'),
			'description' => esc_html__('Choose color of header bottom border', 'depot'),
			'parent'      => $logo_area_border_bottom_color_container
		));

		do_action('depot_mikado_header_logo_area_additional_meta_options',$logo_area_container);
	}
	add_action('depot_mikado_header_logo_area_meta_options_map', 'depot_mikado_header_logo_area_meta_options_map', 10, 1);
}