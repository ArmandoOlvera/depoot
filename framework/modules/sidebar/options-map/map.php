<?php

if ( ! function_exists('depot_mikado_sidebar_options_map') ) {

	function depot_mikado_sidebar_options_map() {

		$sidebar_panel = depot_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'depot'),
				'name' => 'sidebar',
				'page' => '_page_page'
			)
		);
		
		depot_mikado_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'depot'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'depot'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'depot'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'depot'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'depot'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'depot'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'depot')
			)
		));
		
		$depot_custom_sidebars = depot_mikado_get_custom_sidebars();
		if(count($depot_custom_sidebars) > 0) {
			depot_mikado_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'depot'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'depot'),
				'parent' => $sidebar_panel,
				'options' => $depot_custom_sidebars
			));
		}
	}

	add_action('depot_mikado_page_options_map', 'depot_mikado_sidebar_options_map');
}