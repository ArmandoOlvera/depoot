<?php

if(!function_exists('depot_mikado_map_post_link_meta')) {
    function depot_mikado_map_post_link_meta() {
        $link_post_format_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Link Post Format', 'depot'),
                'name' => 'post_format_link_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_post_link_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Link', 'depot'),
                'description' => esc_html__('Enter link', 'depot'),
                'parent'      => $link_post_format_meta_box,

            )
        );


    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_post_link_meta', 24);
}