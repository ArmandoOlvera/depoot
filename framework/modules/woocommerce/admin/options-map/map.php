<?php

if ( ! function_exists('depot_mikado_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function depot_mikado_woocommerce_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'depot'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = depot_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'depot')
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'depot'),
			'default_value'	=> 'mkd-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'depot'),
			'options'		=> array(
				'mkd-woocommerce-columns-3' => esc_html__('3 Columns', 'depot'),
				'mkd-woocommerce-columns-4' => esc_html__('4 Columns', 'depot')
			),
			'parent'      	=> $panel_product_list,
		));
		
		depot_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'depot'),
			'default_value'	=> 'mkd-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'depot'),
			'options'		=> array(
				'mkd-woo-normal-space' => esc_html__('Normal', 'depot'),
				'mkd-woo-small-space'  => esc_html__('Small', 'depot'),
				'mkd-woo-no-space'     => esc_html__('No Space', 'depot')
			),
			'parent'      	=> $panel_product_list,
		));
		
		depot_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'depot'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'depot'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'depot'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'depot')
			),
			'parent'      	=> $panel_product_list,
		));

		depot_mikado_add_admin_field(array(
			'name'        	=> 'mkd_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'depot'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'depot'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        	=> 'mkd_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'depot'),
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'       => depot_mikado_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = depot_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'depot')
			)
		);
		
			depot_mikado_add_admin_field(array(
				'name'          => 'woo_enable_single_thumb_featured_switch',
				'type'          => 'yesno',
				'label'         => esc_html__('Switch Featured Image on Thumbnail Click', 'depot'),
				'description'   => esc_html__('Enabling this option will switch featured image with thumbnail image on thumbnail click', 'depot'),
				'default_value' => 'yes',
				'parent'        => $panel_single_product
			));
			
			depot_mikado_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'depot'),
				'default_value' => 'on-left-side',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'depot'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'depot')
				),
				'parent'        => $panel_single_product
			));

			depot_mikado_add_admin_field(array(
				'name'        	=> 'mkd_single_product_title_tag',
				'type'        	=> 'select',
				'label'       	=> esc_html__('Single Product Title Tag', 'depot'),
				'default_value'	=> 'h3',
				'description' 	=> '',
				'options'       => depot_mikado_get_title_tag(),
				'parent'      	=> $panel_single_product,
			));

            depot_mikado_add_admin_field(
                array(
                    'type' => 'select',
                    'name' => 'show_title_area_woo',
                    'default_value' => '',
                    'label'       => esc_html__('Show Title Area', 'depot'),
                    'description' => esc_html__('Enabling this option will show title area on single post pages', 'depot'),
                    'parent'      => $panel_single_product,
                    'options' => array(
                        '' => esc_html__('Default', 'depot'),
                        'yes' => esc_html__('Yes', 'depot'),
                        'no' => esc_html__('No', 'depot')
                    ),
                    'args' => array(
                        'col_width' => 3
                    )
                )
            );

		/**
		 * DropDown Cart Widget Settings
		 */
		$panel_dropdown_cart = depot_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_dropdown_cart',
				'title' => esc_html__('Dropdown Cart Widget', 'depot')
			)
		);

			depot_mikado_add_admin_field(array(
				'name'        	=> 'mkd_woo_dropdown_cart_description',
				'type'        	=> 'text',
				'label'       	=> esc_html__('Cart Description', 'depot'),
				'default_value'	=> '',
				'description' 	=> esc_html__('Enter dropdown cart description', 'depot'),
				'parent'      	=> $panel_dropdown_cart
			));
	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_woocommerce_options_map', 14);
}