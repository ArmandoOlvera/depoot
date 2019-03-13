<?php

if(!function_exists('depot_mikado_map_post_quote_meta')) {
    function depot_mikado_map_post_quote_meta() {
        $quote_post_format_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Quote Post Format', 'depot'),
                'name' 	=> 'post_format_quote_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_post_quote_text_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Text', 'depot'),
                'description' => esc_html__('Enter Quote text', 'depot'),
                'parent'      => $quote_post_format_meta_box,

            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_post_quote_author_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Author', 'depot'),
                'description' => esc_html__('Enter Quote author', 'depot'),
                'parent'      => $quote_post_format_meta_box,
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_post_quote_meta', 25);
}