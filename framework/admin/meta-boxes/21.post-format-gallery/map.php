<?php

if(!function_exists('depot_mikado_map_post_gallery_meta')) {

    function depot_mikado_map_post_gallery_meta() {
        $gallery_post_format_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Gallery Post Format', 'depot'),
                'name' 	=> 'post_format_gallery_meta'
            )
        );

        depot_mikado_add_multiple_images_field(
            array(
                'name'        => 'mkd_post_gallery_images_meta',
                'label'       => esc_html__('Gallery Images', 'depot'),
                'description' => esc_html__('Choose your gallery images', 'depot'),
                'parent'      => $gallery_post_format_meta_box,
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_post_gallery_meta', 21);
}
