<?php

if ( ! function_exists('depot_mikado_header_centered_map') ) {

	function depot_mikado_header_centered_map($parent) {
		depot_mikado_add_admin_field(
			array(
				'parent'        => $parent,
				'type'          => 'text',
				'name'          => 'logo_wrapper_padding_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Logo Padding', 'depot'),
				'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'depot'),
				'args'          => array(
					'col_width' => 3
				),
				'hidden_property' => 'header_type',
				'hidden_values' => array('header-standard','header-standard-extended','header-box','header-minimal','header-divided','header-tabbed','header-vertical','header-vertical-compact')
			)
		);

	}

	add_action( 'depot_mikado_header_logo_area_additional_options', 'depot_mikado_header_centered_map');
}