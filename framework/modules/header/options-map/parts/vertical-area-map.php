<?php
if(!function_exists('depot_mikado_header_vertical_options_map')) {

	function depot_mikado_header_vertical_options_map($panel_header){


		$vertical_area_container = depot_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'vertical_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-standard','header-extended','header-box','header-minimal','header-divided','header-centered','header-tabbed','header-top-menu')
			)
		);

		depot_mikado_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Vertical Area Style', 'depot')
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'vertical_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'depot'),
			'description' => esc_html__('Set background color for vertical menu', 'depot'),
			'parent'      => $vertical_area_container
		));

		depot_mikado_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Background Image', 'depot'),
				'description'   => esc_html__('Set background image for vertical menu', 'depot'),
				'parent'        => $vertical_area_container
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__('Shadow', 'depot'),
				'description'   => esc_html__('Set shadow on vertical header', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $vertical_area_container,
				'type' => 'yesno',
				'name' => 'vertical_header_border',
				'default_value' => 'no',
				'label' => esc_html__('Vertical Area Border', 'depot'),
				'description' => esc_html__('Set border on vertical area', 'depot'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_vertical_header_shadow_border_container'
				)
			)
		);

		$vertical_header_shadow_border_container = depot_mikado_add_admin_container(
			array(
				'parent' => $vertical_area_container,
				'name' => 'vertical_header_shadow_border_container',
				'hidden_property' => 'vertical_header_border',
				'hidden_value' => 'no'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $vertical_header_shadow_border_container,
				'type' => 'color',
				'name' => 'vertical_header_border_color',
				'default_value' => '',
				'label' => esc_html__('Border Color', 'depot'),
				'description' => esc_html__('Set border color for vertical area', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__('Center Content', 'depot'),
				'description'   => esc_html__('Set content in vertical center', 'depot'),
			)
		);


		do_action('depot_mikado_header_vertical_area_additional_options', $panel_header);
	}
	add_action('depot_mikado_header_vertical_options_map', 'depot_mikado_header_vertical_options_map');
}