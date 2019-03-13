<?php

if ( ! function_exists('depot_mikado_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function depot_mikado_footer_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__('Footer', 'depot'),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = depot_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'depot'),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Footer in Grid', 'depot'),
				'description' => esc_html__('Enabling this option will place Footer content in grid', 'depot'),
				'parent' => $footer_panel,
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Top', 'depot'),
				'description' => esc_html__('Enabling this option will show Footer Top area', 'depot'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = depot_mikado_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'parent' => $show_footer_top_container,
				'default_value' => '4',
				'label' => esc_html__('Footer Top Columns', 'depot'),
				'description' => esc_html__('Choose number of columns for Footer Top area', 'depot'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);

        depot_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Top Skin', 'depot'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'depot'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'depot'),
                    'light'    => esc_html__('Light', 'depot'),
                    'dark'     => esc_html__('Dark', 'depot')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

		depot_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label' => esc_html__('Footer Top Columns Alignment', 'depot'),
				'description' => esc_html__('Text Alignment in Footer Columns', 'depot'),
				'options' => array(
					''       => esc_html__('Default', 'depot'),
					'left'   => esc_html__('Left', 'depot'),
					'center' => esc_html__('Center', 'depot'),
					'right'  => esc_html__('Right', 'depot')
				),
				'parent' => $show_footer_top_container,
			)
		);

		depot_mikado_add_admin_field(array(
			'name' => 'footer_top_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'depot'),
			'description' => esc_html__('Set background color for top footer area', 'depot'),
			'parent' => $show_footer_top_container
		));

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom', 'depot'),
				'description' => esc_html__('Enabling this option will show Footer Bottom area', 'depot'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = depot_mikado_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => esc_html__('Footer Bottom Columns', 'depot'),
				'description' => esc_html__('Choose number of columns for Footer Bottom area', 'depot'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

        depot_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Bottom Skin', 'depot'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'depot'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'depot'),
                    'light'    => esc_html__('Light', 'depot'),
                    'dark'     => esc_html__('Dark', 'depot')
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

		depot_mikado_add_admin_field(array(
			'name' => 'footer_bottom_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'depot'),
			'description' => esc_html__('Set background color for bottom footer area', 'depot'),
			'parent' => $show_footer_bottom_container
		));
	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_footer_options_map', 8);
}