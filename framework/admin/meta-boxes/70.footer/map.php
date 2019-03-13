<?php

if(!function_exists('depot_mikado_map_footer_meta')) {
    function depot_mikado_map_footer_meta() {
        $footer_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Footer', 'depot'),
                'name' => 'footer_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_disable_footer_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Footer for this Page', 'depot'),
                'description' => esc_html__('Enabling this option will hide footer on this page', 'depot'),
                'parent' => $footer_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_show_footer_top_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Top', 'depot'),
                'description' => esc_html__('Enabling this option will show Footer Top area', 'depot'),
                'parent' => $footer_meta_box,
                'options' => depot_mikado_get_yes_no_select_array()
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkd_footer_top_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Skin', 'depot'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'depot'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'depot'),
                    'light'    => esc_html__('Light', 'depot'),
                    'dark'     => esc_html__('Dark', 'depot')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
            'name' => 'mkd_footer_top_background_color_meta',
            'type' => 'color',
            'label' => esc_html__('Footer Top Background Color', 'depot'),
            'description' => esc_html__('Set background color for top footer area', 'depot'),
            'parent' => $footer_meta_box
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_show_footer_bottom_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Bottom', 'depot'),
                'description' => esc_html__('Enabling this option will show Footer Bottom area', 'depot'),
                'parent' => $footer_meta_box,
                'options' => depot_mikado_get_yes_no_select_array()
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkd_footer_bottom_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Bottom Skin', 'depot'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'depot'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'depot'),
                    'light'    => esc_html__('Light', 'depot'),
                    'dark'     => esc_html__('Dark', 'depot')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_footer_bottom_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Footer Bottom Background Color', 'depot'),
                'description' => esc_html__('Set background color for bottom footer area', 'depot'),
                'parent' => $footer_meta_box
            ));

        depot_mikado_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkd_footer_in_grid_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer in Grid', 'depot'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'depot'),
                'options'       => array(
                    ''    => esc_html__('Default', 'depot'),
                    'yes' => esc_html__('Yes', 'depot'),
                    'no'  => esc_html__('No', 'depot')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $depot_custom_sidebars = depot_mikado_get_custom_sidebars();
        depot_mikado_add_meta_box_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_custom_widget_areas',
                'default_value' => 'no',
                'label'         => esc_html__('Use Custom Widget Areas in Footer', 'depot'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_footer_custom_widget_areas'
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $show_footer_custom_widget_areas = depot_mikado_add_admin_container(
            array(
                'name'            => 'footer_custom_widget_areas',
                'hidden_property' => 'show_footer_custom_widget_areas',
                'hidden_value'    => 'no',
                'parent'          => $footer_meta_box
            )
        );

        $top_cols_num = 4;

        for ($i = 1; $i <= $top_cols_num; $i++) {

            depot_mikado_add_meta_box_field(array(
                'name'        => 'mkd_footer_top_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Top Column ', 'depot') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Top Column ', 'depot') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $depot_custom_sidebars
            ));

        }

        $bottom_cols_num = 3;

        for ($i = 1; $i <= $bottom_cols_num; $i++) {

            depot_mikado_add_meta_box_field(array(
                'name'        => 'mkd_footer_bottom_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Bottom Column ', 'depot') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Bottom Column ', 'depot') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $depot_custom_sidebars
            ));

        }


    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_footer_meta', 70);
}