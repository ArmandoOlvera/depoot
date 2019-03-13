<?php

if(!function_exists('depot_mikado_map_woocommerce_meta')) {
    function depot_mikado_map_woocommerce_meta() {
        $woocommerce_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'depot'),
                'name' => 'woo_product_meta'
            )
        );

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'depot'),
            'description' => esc_html__('Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'depot'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'mkd-woo-image-normal-width'		 => esc_html__('Default', 'depot'),
				'mkd-woo-image-large-width'        => esc_html__('Large width', 'depot'),
				'mkd-woo-image-large-height'       => esc_html__('Large height', 'depot'),
				'mkd-woo-image-large-width-height' => esc_html__('Large width/height', 'depot'),
            )
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'depot'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'depot'),
                'parent'        => $woocommerce_meta_box,
                'options'       => depot_mikado_get_yes_no_select_array()
            )
        );

		depot_mikado_add_meta_box_field(array(
			'name'        => 'mkd_single_product_new_meta',
			'type'        => 'select',
			'label'       => esc_html__('Enable New Product Mark', 'depot'),
			'description' => esc_html__('Enabling this option will show new product mark on your product lists and product single', 'depot'),
			'parent'      => $woocommerce_meta_box,
			'options'     => array(
				'no'  => esc_html__('No', 'depot'),
				'yes' => esc_html__('Yes', 'depot')
			)
		));
    }
	
    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_woocommerce_meta', 99);
}