<?php

if ( ! function_exists('depot_mikado_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function depot_mikado_reset_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset', 'depot'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = depot_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset', 'depot')
			)
		);

		depot_mikado_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Reset to Defaults', 'depot'),
			'description'	=> esc_html__('This option will reset all Select Options values to defaults', 'depot'),
			'parent'		=> $panel_reset
		));
	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_reset_options_map', 100 );
}