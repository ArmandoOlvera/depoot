<?php

if(!function_exists('depot_mikado_map_sidebar_meta')) {
    function depot_mikado_map_sidebar_meta() {
        $mkd_sidebar_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'team-member'),
                'title' => esc_html__('Sidebar', 'depot'),
                'name' => 'sidebar_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_sidebar_layout_meta',
                'type'        => 'select',
                'label'       => esc_html__('Layout', 'depot'),
                'description' => esc_html__('Choose the sidebar layout', 'depot'),
                'parent'      => $mkd_sidebar_meta_box,
                'options'     => array(
                    ''			        => esc_html__('Default', 'depot'),
                    'no-sidebar'		=> esc_html__('No Sidebar', 'depot'),
                    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'depot'),
                    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'depot'),
                    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'depot'),
                    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'depot')
                )
            )
        );

        $mkd_custom_sidebars = depot_mikado_get_custom_sidebars();
        if(count($mkd_custom_sidebars) > 0) {
            depot_mikado_add_meta_box_field(array(
                'name' => 'mkd_custom_sidebar_area_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Widget Area in Sidebar', 'depot'),
                'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'depot'),
                'parent' => $mkd_sidebar_meta_box,
                'options' => $mkd_custom_sidebars
            ));
        }
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_sidebar_meta', 31);
}