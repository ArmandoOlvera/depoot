<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) {
	vc_set_as_theme(true);
}

/**
 * Change path for overridden templates
 */
if(function_exists('vc_set_shortcodes_templates_dir')) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists('depot_mikado_configure_visual_composer_frontend_editor') ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function depot_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if(function_exists('vc_disable_frontend')){
			vc_disable_frontend();
		}
	}

	add_action('vc_after_init', 'depot_mikado_configure_visual_composer_frontend_editor');
}

if (!function_exists('depot_mikado_vc_row_map')) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function depot_mikado_vc_row_map() {

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'param_name' => 'row_content_width',
			'heading' => esc_html__('Mikado Row Content Width', 'depot'),
			'value' => array(
				esc_html__('Full Width', 'depot') => 'full-width',
				esc_html__('In Grid', 'depot') => 'grid'
			)
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'param_name' => 'anchor',
			'heading' => esc_html__('Mikado Anchor ID', 'depot'),
			'description' => esc_html__('For example "home"', 'depot')
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading' => esc_html__('Mikado Content Aligment', 'depot'),
			'value' => array(
				esc_html__('Default', 'depot') => '',
				esc_html__('Left', 'depot') => 'left',
				esc_html__('Center', 'depot') => 'center',
				esc_html__('Right', 'depot') => 'right'
			)
		));

		/*** Row Inner ***/

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'param_name' => 'row_content_width',
			'heading' => esc_html__('Mikado Row Content Width', 'depot'),
			'value' => array(
				esc_html__('Full Width', 'depot') => 'full-width',
				esc_html__('In Grid', 'depot') => 'grid'
			)
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'param_name' => 'content_text_aligment',
			'heading' => esc_html__('Mikado Content Aligment', 'depot'),
			'value' => array(
				esc_html__('Default', 'depot') => '',
				esc_html__('Left', 'depot') => 'left',
				esc_html__('Center', 'depot') => 'center',
				esc_html__('Right', 'depot') => 'right'
			)
		));
	}

	add_action('vc_after_init', 'depot_mikado_vc_row_map');
}