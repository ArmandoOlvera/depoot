<?php

if ( ! function_exists('depot_mikado_sidearea_options_map') ) {

	function depot_mikado_sidearea_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'depot'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = depot_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'depot'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = depot_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'depot'),
				'description' => esc_html__('Define styles for Side Area icon', 'depot')
			)
		);

		$side_area_icon_style_row1 = depot_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'depot')
			)
		);

		$side_area_icon_style_row2 = depot_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'depot'),
				'description' => esc_html__('Enter a width for Side Area', 'depot'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'depot'),
				'description' => esc_html__('Choose a background color for Side Area', 'depot')
			)
		);
		
		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'depot'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'depot'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'depot'),
				'description' => esc_html__('Choose text alignment for side area', 'depot'),
				'options' => array(
					'' => esc_html__('Default', 'depot'),
					'left' => esc_html__('Left', 'depot'),
					'center' => esc_html__('Center', 'depot'),
					'right' => esc_html__('Right', 'depot')
				)
			)
		);
	}

	add_action('depot_mikado_options_map', 'depot_mikado_sidearea_options_map', 4);
}