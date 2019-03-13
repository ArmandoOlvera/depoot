<?php
if(!function_exists('depot_mikado_header_sticky_options_map')) {

	function depot_mikado_header_sticky_options_map(){

		$panel_sticky_header = depot_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Sticky Header', 'depot'),
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-vertical-compact','header-top-menu')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => esc_html__('Scroll Amount for Sticky', 'depot'),
				'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis', 'depot'),
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Sticky Header in Grid', 'depot'),
				'description' => esc_html__('Enabling this option will put sticky header in grid', 'depot'),
				'parent' => $panel_sticky_header,
			)
		);

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'depot'),
			'description' => esc_html__('Choose a background color for header area', 'depot'),
			'parent' => $panel_sticky_header
		));

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => esc_html__('Background Transparency', 'depot'),
			'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'depot'),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_header_border_color',
			'type' => 'color',
			'label' => esc_html__('Border Color', 'depot'),
			'description' => esc_html__('Set border bottom color for header area', 'depot'),
			'parent' => $panel_sticky_header
		));

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => esc_html__('Sticky Header Height', 'depot'),
			'description' => esc_html__('Enter height for sticky header (default is 60px)', 'depot'),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$group_sticky_header_menu = depot_mikado_add_admin_group(array(
			'title' => esc_html__('Sticky Header Menu', 'depot'),
			'name' => 'group_sticky_header_menu',
			'parent' => $panel_sticky_header,
			'description' => esc_html__('Define styles for sticky menu items', 'depot')
		));

		$row1_sticky_header_menu = depot_mikado_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_sticky_header_menu
		));

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_color',
			'type' => 'colorsimple',
			'label' => esc_html__('Text Color', 'depot'),
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		depot_mikado_add_admin_field(array(
			'name' => 'sticky_hovercolor',
			'type' => 'colorsimple',
			'label' => esc_html__(esc_html__('Hover/Active Color', 'depot'), 'depot'),
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = depot_mikado_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_sticky_header_menu
		));

		depot_mikado_add_admin_field(
			array(
				'name' => 'sticky_google_fonts',
				'type' => 'fontsimple',
				'label' => esc_html__('Font Family', 'depot'),
				'default_value' => '-1',
				'parent' => $row2_sticky_header_menu,
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_font_size',
				'label' => esc_html__('Font Size', 'depot'),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_line_height',
				'label' => esc_html__('Line Height', 'depot'),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_text_transform',
				'label' => esc_html__('Text Transform', 'depot'),
				'default_value' => '',
				'options' => depot_mikado_get_text_transform_array(),
				'parent' => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = depot_mikado_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_sticky_header_menu
		));

		depot_mikado_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'depot'),
				'options' => depot_mikado_get_font_style_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'depot'),
				'options' => depot_mikado_get_font_weight_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'depot'),
				'default_value' => '',
				'parent' => $row3_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
	}

	add_action('depot_mikado_header_sticky_options_map', 'depot_mikado_header_sticky_options_map', 10, 1);
}