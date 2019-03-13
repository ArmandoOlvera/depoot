<?php

if ( ! function_exists('depot_mikado_header_centered_meta_map') ) {

	function depot_mikado_header_centered_meta_map($parent) {
		depot_mikado_add_meta_box_field(
			array(
				'parent'        => $parent,
				'type'          => 'text',
				'name'          => 'mkd_logo_wrapper_padding_header_centered_meta',
				'default_value' => '',
				'label'         => esc_html__('Logo Padding', 'depot'),
				'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'depot'),
				'args'          => array(
					'col_width' => 3
				),
				'hidden_property' => 'mkd_header_type_meta',
				'hidden_values' => array('','header-standard','header-standard-extended','header-box','header-minimal','header-divided','header-tabbed','header-vertical','header-vertical-compact')
			)
		);

	}

	add_action( 'depot_mikado_header_logo_area_additional_meta_options', 'depot_mikado_header_centered_meta_map',10,1);
}