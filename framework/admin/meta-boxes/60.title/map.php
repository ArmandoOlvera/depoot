<?php

if(!function_exists('depot_mikado_map_title_meta')) {
    function depot_mikado_map_title_meta() {
        $title_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Title', 'depot'),
                'name' => 'title_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_show_title_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'depot'),
                'description' => esc_html__('Disabling this option will turn off page title area', 'depot'),
                'parent' => $title_meta_box,
                'options' => depot_mikado_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "#mkd_mkd_show_title_area_meta_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_show_title_area_meta_container",
                        "no" => "",
                        "yes" => "#mkd_mkd_show_title_area_meta_container"
                    )
                )
            )
        );

        $show_title_area_meta_container = depot_mikado_add_admin_container(
            array(
                'parent' => $title_meta_box,
                'name' => 'mkd_show_title_area_meta_container',
                'hidden_property' => 'mkd_show_title_area_meta',
                'hidden_value' => 'no'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Area Type', 'depot'),
                'description' => esc_html__('Choose title type', 'depot'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'standard' => esc_html__('Standard', 'depot'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'depot')
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_type_meta_container",
                        "standard" => "#mkd_mkd_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = depot_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_title_area_type_meta_container',
                'hidden_property' => 'mkd_title_area_type_meta',
                'hidden_value' => 'breadcrumb'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Breadcrumbs', 'depot'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area', 'depot'),
                'parent' => $title_area_type_meta_container,
                'options' => depot_mikado_get_yes_no_select_array()
            )
        );



        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_vertical_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Vertical Alignment', 'depot'),
                'description' => esc_html__('Specify title vertical alignment', 'depot'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'header_bottom' => esc_html__('From Bottom of Header', 'depot'),
                    'window_top' => esc_html__('From Window Top', 'depot')
                )
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Horizontal Alignment', 'depot'),
                'description' => esc_html__('Specify title horizontal alignment', 'depot'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'left' => esc_html__('Left', 'depot'),
                    'center' => esc_html__('Center', 'depot'),
                    'right' => esc_html__('Right', 'depot')
                )
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_title_tag_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Tag', 'depot'),
                'parent' => $title_area_type_meta_container,
                'options' => depot_mikado_get_title_tag(true)
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_text_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Color', 'depot'),
                'description' => esc_html__('Choose a color for title text', 'depot'),
                'parent' => $show_title_area_meta_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color', 'depot'),
                'description' => esc_html__('Choose a background color for title area', 'depot'),
                'parent' => $show_title_area_meta_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Hide Background Image', 'depot'),
                'description' => esc_html__('Enable this option to hide background image in title area', 'depot'),
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = depot_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_hide_background_image_meta_container',
                'hidden_property' => 'mkd_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_meta',
                'type' => 'image',
                'label' => esc_html__('Background Image', 'depot'),
                'description' => esc_html__('Choose an Image for title area', 'depot'),
                'parent' => $hide_background_image_meta_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Responsive Image', 'depot'),
                'description' => esc_html__('Enabling this option will make Title background image responsive', 'depot'),
                'parent' => $hide_background_image_meta_container,
                'options' => depot_mikado_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                        "no" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        $title_area_background_image_responsive_meta_container = depot_mikado_add_admin_container(
            array(
                'parent' => $hide_background_image_meta_container,
                'name' => 'mkd_title_area_background_image_responsive_meta_container',
                'hidden_property' => 'mkd_title_area_background_image_responsive_meta',
                'hidden_value' => 'yes'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_parallax_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Image in Parallax', 'depot'),
                'description' => esc_html__('Enabling this option will make Title background image parallax', 'depot'),
                'parent' => $title_area_background_image_responsive_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'no' => esc_html__('No', 'depot'),
                    'yes' => esc_html__('Yes', 'depot'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'depot')
                )
            )
        );

        depot_mikado_add_meta_box_field(array(
            'name' => 'mkd_title_area_height_meta',
            'type' => 'text',
            'label' => esc_html__('Height', 'depot'),
            'description' => esc_html__('Set a height for Title Area', 'depot'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name' => 'mkd_title_area_subtitle_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__('Subtitle Text', 'depot'),
            'description' => esc_html__('Enter your subtitle text', 'depot'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 6
            )
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_subtitle_color_meta',
                'type' => 'color',
                'label' => esc_html__('Subtitle Color', 'depot'),
                'description' => esc_html__('Choose a color for subtitle text', 'depot'),
                'parent' => $show_title_area_meta_container
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_title_meta', 60);
}