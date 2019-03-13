<?php

if ( ! function_exists('depot_mikado_mobile_header_options_map') ) {

	function depot_mikado_mobile_header_options_map() {

		$panel_mobile_header = depot_mikado_add_admin_panel(array(
			'title' => esc_html__('Mobile Header', 'depot'),
			'name'  => 'panel_mobile_header',
			'page'  => '_header_page'
		));

		$mobile_header_group = depot_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_header_group',
				'title' => esc_html__('Mobile Header Styles', 'depot')
			)
		);

		$mobile_header_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name' => 'mobile_header_row1'
			)
		);

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'textsimple',
				'label'       => esc_html__('Height', 'depot'),
				'parent'      => $mobile_header_row1,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'depot'),
				'parent'      => $mobile_header_row1
			));

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_header_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'depot'),
				'parent'      => $mobile_header_row1
			));

		$mobile_menu_group = depot_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_menu_group',
				'title' => esc_html__('Mobile Menu Styles', 'depot')
			)
		);

		$mobile_menu_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name' => 'mobile_menu_row1'
			)
		);

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'depot'),
				'parent'      => $mobile_menu_row1
			));

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'depot'),
				'parent'      => $mobile_menu_row1
			));

			depot_mikado_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Menu Item Separator Color', 'depot'),
				'parent'      => $mobile_menu_row1
			));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'depot'),
			'description' => esc_html__('Define logo height for screen size smaller than 1024px', 'depot'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'depot'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'depot'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		depot_mikado_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'depot')
		));

		$first_level_group = depot_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'first_level_group',
				'title' => esc_html__('1st Level Menu', 'depot'),
				'description' => esc_html__('Define styles for 1st level in Mobile Menu Navigation', 'depot')
			)
		);

		$first_level_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'depot'),
			'parent'      => $first_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'depot'),
			'parent'      => $first_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'depot'),
			'parent'      => $first_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'depot'),
			'parent'      => $first_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$first_level_row2 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2'
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'depot'),
			'parent'      => $first_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'depot'),
			'parent'      => $first_level_row2,
			'options'     => depot_mikado_get_text_transform_array()
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'depot'),
			'parent'      => $first_level_row2,
			'options'     => depot_mikado_get_font_style_array()
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'depot'),
			'parent'      => $first_level_row2,
			'options'     => depot_mikado_get_font_weight_array()
		));

		$first_level_row3 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row3'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'depot'),
				'default_value' => '',
				'parent' => $first_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = depot_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'second_level_group',
				'title' => esc_html__('Dropdown Menu', 'depot'),
				'description' => esc_html__('Define styles for drop down menu items in Mobile Menu Navigation', 'depot')
			)
		);

		$second_level_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'depot'),
			'parent'      => $second_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'depot'),
			'parent'      => $second_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'depot'),
			'parent'      => $second_level_row1
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'depot'),
			'parent'      => $second_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$second_level_row2 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2'
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'depot'),
			'parent'      => $second_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'depot'),
			'parent'      => $second_level_row2,
			'options'     => depot_mikado_get_text_transform_array()
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'depot'),
			'parent'      => $second_level_row2,
			'options'     => depot_mikado_get_font_style_array()
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'depot'),
			'parent'      => $second_level_row2,
			'options'     => depot_mikado_get_font_weight_array()
		));

		$second_level_row3 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row3'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_dropdown_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'depot'),
				'default_value' => '',
				'parent' => $second_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__('Mobile Menu Opener', 'depot')
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_title',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Title', 'depot'),
			'description' => esc_html__('Enter title for mobile menu navigation', 'depot'),
			'parent'      => $panel_mobile_header,
			'default_value' => esc_html__('Menu', 'depot'),
			'args' => array(
				'col_width' => 3
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'depot'),
			'parent'      => $panel_mobile_header
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'depot'),
			'parent'      => $panel_mobile_header
		));
	}

	add_action( 'depot_mikado_header_mobile_header_options_map', 'depot_mikado_mobile_header_options_map', 5);
}