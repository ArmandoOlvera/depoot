<?php

if ( ! function_exists('depot_mikado_fullscreen_menu_options_map')) {

	function depot_mikado_fullscreen_menu_options_map() {

		$fullscreen_panel = depot_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Fullscreen Menu', 'depot'),
				'name'            => 'panel_fullscreen_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-vertical',
					'header-divided',
					'header-centered',
					'header-tabbed',
					'header-vertical-compact',
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => esc_html__('Fullscreen Menu Overlay Animation', 'depot'),
				'description' => esc_html__('Choose animation type for fullscreen menu overlay', 'depot'),
				'options' => array(
					'fade-push-text-right' => esc_html__('Fade Push Text Right', 'depot'),
					'fade-push-text-top' => esc_html__('Fade Push Text Top', 'depot'),
					'fade-text-scaledown' => esc_html__('Fade Text Scaledown', 'depot')
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Fullscreen Menu in Grid', 'depot'),
				'description' => esc_html__('Enabling this option will put fullscreen menu content in grid', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => esc_html__('Fullscreen Menu Alignment', 'depot'),
				'description' => esc_html__('Choose alignment for fullscreen menu content', 'depot'),
				'options' => array(
					'' => esc_html__('Default', 'depot'),
					'left' => esc_html__('Left', 'depot'),
					'center' => esc_html__('Center', 'depot'),
					'right' => esc_html__('Right', 'depot')
				)
			)
		);

		$background_group = depot_mikado_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => esc_html__('Background', 'depot'),
				'description' => esc_html__('Select a background color and transparency for fullscreen menu (0 = fully transparent, 1 = opaque)', 'depot')
			)
		);

		$background_group_row = depot_mikado_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'label' => esc_html__('Background Color', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'label' => esc_html__('Background Transparency', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'label' => esc_html__('Background Image', 'depot'),
				'description' => esc_html__('Choose a background image for fullscreen menu background', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'label' => esc_html__('Pattern Background Image', 'depot'),
				'description' => esc_html__('Choose a pattern image for fullscreen menu background', 'depot')
			)
		);

		//1st level style group
		$first_level_style_group = depot_mikado_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => esc_html__('1st Level Style', 'depot'),
				'description' => esc_html__('Define styles for 1st level in Fullscreen Menu', 'depot')
			)
		);

		$first_level_style_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => esc_html__('Hover Text Color', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => esc_html__('Active Text Color', 'depot'),
			)
		);

		$first_level_style_row3 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = depot_mikado_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'depot'),
				'options' => depot_mikado_get_font_style_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'depot'),
				'options' => depot_mikado_get_font_weight_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'depot'),
				'options' => depot_mikado_get_text_transform_array()
			)
		);

		//2nd level style group
		$second_level_style_group = depot_mikado_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => esc_html__('2nd Level Style', 'depot'),
				'description' => esc_html__('Define styles for 2nd level in Fullscreen Menu', 'depot')
			)
		);

		$second_level_style_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'depot'),
			)
		);

		$second_level_style_row2 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = depot_mikado_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'depot'),
				'options' => depot_mikado_get_font_style_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'depot'),
				'options' => depot_mikado_get_font_weight_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'depot'),
				'options' => depot_mikado_get_text_transform_array()
			)
		);

		$third_level_style_group = depot_mikado_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => esc_html__('3rd Level Style', 'depot'),
				'description' => esc_html__('Define styles for 3rd level in Fullscreen Menu', 'depot')
			)
		);

		$third_level_style_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'depot'),
			)
		);

		$third_level_style_row2 = depot_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'depot'),
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = depot_mikado_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'depot'),
				'options' => depot_mikado_get_font_style_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'depot'),
				'options' => depot_mikado_get_font_weight_array()
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'depot'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'depot'),
				'options' => depot_mikado_get_text_transform_array()
			)
		);

		$icon_colors_group = depot_mikado_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => esc_html__('Full Screen Menu Icon Style', 'depot'),
				'description' => esc_html__('Define styles for Fullscreen Menu Icon', 'depot')
			)
		);

		$icon_colors_row1 = depot_mikado_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => esc_html__('Color', 'depot'),
			)
		);
		
		depot_mikado_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => esc_html__('Hover Color', 'depot'),
			)
		);
	}

	add_action('depot_mikado_header_options_map', 'depot_mikado_fullscreen_menu_options_map', 17);
}