<?php
if(!function_exists('depot_mikado_header_vertical_navigation_options_map')) {

	function depot_mikado_header_vertical_navigation_options_map($panel_header){
		$panel_vertical_main_menu = depot_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Vertical Main Menu', 'depot'),
				'name' => 'panel_vertical_main_menu',
				'page' => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-standard','header-extended','header-box','header-minimal','header-divided','header-centered','header-tabbed','header-top-menu')
			)
		);

		$drop_down_group = depot_mikado_add_admin_group(
			array(
				'parent' => $panel_vertical_main_menu,
				'name' => 'vertical_drop_down_group',
				'title' => esc_html__('Main Dropdown Menu', 'depot'),
				'description' => esc_html__('Set a style for dropdown menu', 'depot')
			)
		);

		$vertical_drop_down_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name' => 'mkd_drop_down_row1',
			)
		);

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_top_margin',
			'default_value'	=> '',
			'label'			=> esc_html__('Top Margin', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $vertical_drop_down_row1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_bottom_margin',
			'default_value'	=> '',
			'label'			=> esc_html__('Bottom Margin', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $vertical_drop_down_row1
		));

		$group_vertical_first_level = depot_mikado_add_admin_group(array(
			'name'			=> 'group_vertical_first_level',
			'title'			=> esc_html__('1st level', 'depot'),
			'description'	=> esc_html__('Define styles for 1st level menu', 'depot'),
			'parent'		=> $panel_vertical_main_menu
		));

		$row_vertical_first_level_1 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_first_level_1',
			'parent'	=> $group_vertical_first_level
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_1st_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'depot'),
			'parent'		=> $row_vertical_first_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_1st_hover_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Hover/Active Color', 'depot'),
			'parent'		=> $row_vertical_first_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_1st_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_first_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_1st_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_first_level_1
		));

		$row_vertical_first_level_2 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_first_level_2',
			'parent'	=> $group_vertical_first_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_1st_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'depot'),
			'options'		=> depot_mikado_get_text_transform_array(),
			'parent'		=> $row_vertical_first_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'vertical_menu_1st_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'depot'),
			'parent'		=> $row_vertical_first_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_1st_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'depot'),
			'options'		=> depot_mikado_get_font_style_array(),
			'parent'		=> $row_vertical_first_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_1st_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'depot'),
			'options'		=> depot_mikado_get_font_weight_array(),
			'parent'		=> $row_vertical_first_level_2
		));

		$row_vertical_first_level_3 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_first_level_3',
			'parent'	=> $group_vertical_first_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_1st_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_first_level_3
		));

		$group_vertical_second_level = depot_mikado_add_admin_group(array(
			'name'			=> 'group_vertical_second_level',
			'title'			=> esc_html__('2nd level', 'depot'),
			'description'	=> esc_html__('Define styles for 2nd level menu', 'depot'),
			'parent'		=> $panel_vertical_main_menu
		));

		$row_vertical_second_level_1 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_second_level_1',
			'parent'	=> $group_vertical_second_level
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_2nd_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'depot'),
			'parent'		=> $row_vertical_second_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_2nd_hover_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Hover/Active Color', 'depot'),
			'parent'		=> $row_vertical_second_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_2nd_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_second_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_2nd_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_second_level_1
		));

		$row_vertical_second_level_2 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_second_level_2',
			'parent'	=> $group_vertical_second_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_2nd_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'depot'),
			'options'		=> depot_mikado_get_text_transform_array(),
			'parent'		=> $row_vertical_second_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'vertical_menu_2nd_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'depot'),
			'parent'		=> $row_vertical_second_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_2nd_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'depot'),
			'options'		=> depot_mikado_get_font_style_array(),
			'parent'		=> $row_vertical_second_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_2nd_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'depot'),
			'options'		=> depot_mikado_get_font_weight_array(),
			'parent'		=> $row_vertical_second_level_2
		));

		$row_vertical_second_level_3 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_second_level_3',
			'parent'	=> $group_vertical_second_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_2nd_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_second_level_3
		));

		$group_vertical_third_level = depot_mikado_add_admin_group(array(
			'name'			=> 'group_vertical_third_level',
			'title'			=> esc_html__('3rd level', 'depot'),
			'description'	=> esc_html__('Define styles for 3rd level menu', 'depot'),
			'parent'		=> $panel_vertical_main_menu
		));

		$row_vertical_third_level_1 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_third_level_1',
			'parent'	=> $group_vertical_third_level
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_3rd_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color', 'depot'),
			'parent'		=> $row_vertical_third_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'vertical_menu_3rd_hover_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Hover/Active Color', 'depot'),
			'parent'		=> $row_vertical_third_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_3rd_font_size',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_third_level_1
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_3rd_line_height',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_third_level_1
		));

		$row_vertical_third_level_2 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_third_level_2',
			'parent'	=> $group_vertical_third_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_3rd_text_transform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform', 'depot'),
			'options'		=> depot_mikado_get_text_transform_array(),
			'parent'		=> $row_vertical_third_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'vertical_menu_3rd_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family', 'depot'),
			'parent'		=> $row_vertical_third_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_3rd_font_style',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style', 'depot'),
			'options'		=> depot_mikado_get_font_style_array(),
			'parent'		=> $row_vertical_third_level_2
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'vertical_menu_3rd_font_weight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight', 'depot'),
			'options'		=> depot_mikado_get_font_weight_array(),
			'parent'		=> $row_vertical_third_level_2
		));

		$row_vertical_third_level_3 = depot_mikado_add_admin_row(array(
			'name'		=> 'row_vertical_third_level_3',
			'parent'	=> $group_vertical_third_level,
			'next'		=> true
		));

		depot_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'vertical_menu_3rd_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing', 'depot'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_vertical_third_level_3
		));
	}

	add_action('depot_mikado_header_vertical_navigation_options_map', 'depot_mikado_header_vertical_navigation_options_map', 10, 1);
}