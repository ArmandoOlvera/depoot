<?php

if (!function_exists('depot_mikado_logo_meta_box_map')) {
    function depot_mikado_logo_meta_box_map() {

        $logo_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'mkd-team-member'),
                'title' => esc_html__('Logo', 'depot'),
                'name'  => 'logo_meta'
            )
        );


        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_logo_image_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Default', 'depot'),
                'description'   => esc_html__('Choose a default logo image to display ', 'depot'),
                'parent'        => $logo_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_logo_image_dark_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Dark', 'depot'),
                'description'   => esc_html__('Choose a default logo image to display ', 'depot'),
                'parent'        => $logo_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_logo_image_light_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Light', 'depot'),
                'description'   => esc_html__('Choose a default logo image to display ', 'depot'),
                'parent'        => $logo_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_logo_image_sticky_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Sticky', 'depot'),
                'description'   => esc_html__('Choose a default logo image to display ', 'depot'),
                'parent'        => $logo_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_logo_image_mobile_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Mobile', 'depot'),
                'description'   => esc_html__('Choose a default logo image to display ', 'depot'),
                'parent'        => $logo_meta_box
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_logo_meta_box_map');
}