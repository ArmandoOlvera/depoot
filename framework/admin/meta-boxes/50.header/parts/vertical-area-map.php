<?php
if(!function_exists('depot_mikado_header_vertical_area_meta_options_map')) {

	function depot_mikado_header_vertical_area_meta_options_map($header_meta_box){
		$header_vertical_area_meta_container = depot_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_meta_container',
				'hidden_property' => 'mkd_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-standard','header-extended','header-box','header-minimal','header-divided','header-centered','header-tabbed')
			)
		);

		depot_mikado_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name' => 'vertical_area_style',
				'title' => esc_html__('Vertical Area Style', 'depot')
			)
		);

		$depot_custom_sidebars = depot_mikado_get_custom_sidebars();
		if(count($depot_custom_sidebars) > 0) {
			depot_mikado_add_meta_box_field(array(
				'name' => 'mkd_custom_vertical_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area in Vertical area', 'depot'),
				'description' => esc_html__('Choose custom widget area to display in vertical menu"', 'depot'),
				'parent' => $header_vertical_area_meta_container,
				'options' => $depot_custom_sidebars
			));
		}

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_vertical_header_background_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'depot'),
			'description' => esc_html__('Set background color for vertical menu', 'depot'),
			'parent'      => $header_vertical_area_meta_container
		));

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Background Image', 'depot'),
				'description'   => esc_html__('Set background image for vertical menu', 'depot'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Disable Background Image', 'depot'),
				'description'   => esc_html__('Enabling this option will hide background image in Vertical Menu', 'depot'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_vertical_header_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Shadow', 'depot'),
			'description'   => esc_html__('Set shadow on vertical menu', 'depot'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			)
		));

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_vertical_header_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Vertical Area Border', 'depot'),
			'description'   => esc_html__('Set border on vertical area', 'depot'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#mkd_vertical_header_border_container',
					'no'  => '#mkd_vertical_header_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#mkd_vertical_header_border_container'
				)
			)
		));

		$vertical_header_border_container = depot_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'vertical_header_border_container',
			'parent'          => $header_vertical_area_meta_container,
			'hidden_property' => 'mkd_vertical_header_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_vertical_header_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'depot'),
			'description' => esc_html__('Choose color of border', 'depot'),
			'parent'      => $vertical_header_border_container
		));

		depot_mikado_add_meta_box_field(array(
			'name'          => 'mkd_vertical_header_center_content_meta',
			'type'          => 'select',
			'label'         => esc_html__('Center Content', 'depot'),
			'description'   => esc_html__('Set content in vertical center', 'depot'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			)
		));
	}
	add_action('depot_mikado_header_vertical_area_meta_options_map', 'depot_mikado_header_vertical_area_meta_options_map', 10, 1);
}