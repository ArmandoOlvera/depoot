<?php
if(!function_exists('depot_mikado_header_top_area_meta_options_map')) {

	function depot_mikado_header_top_area_meta_options_map($header_meta_box){

		$top_header_container = depot_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'mkd_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-top-menu','header-vertical','header-vertical-compact','header-vertical-closed')
			));

		depot_mikado_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name' => 'top_area_style',
				'title' => esc_html__('Top Area', 'depot')
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name' => 'mkd_top_bar_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Top Bar', 'depot'),
				'description' => esc_html__('Enabling this option will show header top bar area', 'depot'),
				'parent' => $top_header_container,
				'options' => depot_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkd_top_bar_container_no_style',
						'no'  => '#mkd_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkd_top_bar_container_no_style'
					)
				)
			)
		);

		$top_bar_container = depot_mikado_add_admin_container_no_style(array(
			'name'            => 'top_bar_container_no_style',
			'parent'          => $top_header_container,
			'hidden_property' => 'mkd_top_bar_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('','no')
		));

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_top_bar_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar In Grid', 'depot'),
			'description'   => esc_html__('Set top bar content to be in grid', 'depot'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			)
		));

		depot_mikado_add_meta_box_field(array(
			'name'    => 'mkd_top_bar_skin_meta',
			'type'    => 'select',
			'label'   => esc_html__('Top Bar Skin', 'depot'),
			'options' => array(
				''      => esc_html__('Default', 'depot'),
				'light' => esc_html__('White', 'depot'),
				'dark'  => esc_html__('Black', 'depot'),
				'gray'  => esc_html__('Gray', 'depot'),
			),
			'parent'  => $top_bar_container
		));

		depot_mikado_add_meta_box_field(array(
			'name'   => 'mkd_top_bar_background_color_meta',
			'type'   => 'color',
			'label'  => esc_html__('Top Bar Background Color', 'depot'),
			'parent' => $top_bar_container
		));

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_top_bar_background_transparency_meta',
			'type'        => 'text',
			'label'       => esc_html__('Top Bar Background Color Transparency', 'depot'),
			'description' => esc_html__('Set top bar background color transparenct. Value should be between 0 and 1', 'depot'),
			'parent'      => $top_bar_container,
			'args'        => array(
				'col_width' => 3
			)
		));

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_top_bar_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar Border', 'depot'),
			'description'   => esc_html__('Set border on top bar', 'depot'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#mkd_top_bar_border_container',
					'no'  => '#mkd_top_bar_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#mkd_top_bar_border_container'
				)
			)
		));

		$top_bar_border_container = depot_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'top_bar_border_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'mkd_top_bar_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_top_bar_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'depot'),
			'description' => esc_html__('Choose color for top bar border', 'depot'),
			'parent'      => $top_bar_border_container
		));
	}
	add_action('depot_mikado_header_top_area_meta_options_map', 'depot_mikado_header_top_area_meta_options_map', 10, 1);
}