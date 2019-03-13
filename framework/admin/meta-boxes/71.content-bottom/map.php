<?php

if(!function_exists('depot_mikado_map_content_bottom_meta')) {
    function depot_mikado_map_content_bottom_meta() {
        $content_bottom_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Content Bottom', 'depot'),
                'name' => 'content_bottom_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_enable_content_bottom_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Content Bottom Area', 'depot'),
                'description' => esc_html__('This option will enable Content Bottom area on pages', 'depot'),
                'parent' => $content_bottom_meta_box,
                'options' => depot_mikado_get_yes_no_select_array(),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        '' => '#mkd_mkd_show_content_bottom_meta_container',
                        'no' => '#mkd_mkd_show_content_bottom_meta_container'
                    ),
                    'show' => array(
                        'yes' => '#mkd_mkd_show_content_bottom_meta_container'
                    )
                )
            )
        );

        $show_content_bottom_meta_container = depot_mikado_add_admin_container(
            array(
                'parent' => $content_bottom_meta_box,
                'name' => 'mkd_show_content_bottom_meta_container',
                'hidden_property' => 'mkd_enable_content_bottom_area_meta',
                'hidden_values' => array('','no')
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_content_bottom_sidebar_custom_display_meta',
                'type' => 'selectblank',
                'default_value' => '',
                'label' => esc_html__('Sidebar to Display', 'depot'),
                'description' => esc_html__('Choose a content bottom sidebar to display', 'depot'),
                'options' => depot_mikado_get_custom_sidebars(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'type' => 'select',
                'name' => 'mkd_content_bottom_in_grid_meta',
                'default_value' => '',
                'label' => esc_html__('Display in Grid', 'depot'),
                'description' => esc_html__('Enabling this option will place content bottom in grid', 'depot'),
                'options' => depot_mikado_get_yes_no_select_array(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'type' => 'color',
                'name' => 'mkd_content_bottom_background_color_meta',
                'label' => esc_html__('Background Color', 'depot'),
                'description' => esc_html__('Choose a background color for content bottom area', 'depot'),
                'parent' => $show_content_bottom_meta_container
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_content_bottom_meta', 71);
}