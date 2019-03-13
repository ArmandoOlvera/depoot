<?php

if(!function_exists('depot_mikado_map_general_meta')) {

    function depot_mikado_map_general_meta() {

        $general_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('General', 'depot'),
                'name' => 'general_meta'
            )
        );

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'depot' ),
				'parent'        => $general_meta_box,
				'options'     => depot_mikado_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#mkd_page_transitions_container_meta",
						"no"  => "#mkd_page_transitions_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#mkd_page_transitions_container_meta"
					)
				)
			)
		);

		$page_transitions_container_meta = depot_mikado_add_admin_container(
			array(
				'parent'          => $general_meta_box,
				'name'            => 'page_transitions_container_meta',
				'hidden_property' => 'mkd_smooth_page_transitions_meta',
				'hidden_values'   => array('','no')
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_page_transition_preloader_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Preloading Animation', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'depot' ),
				'parent'        => $page_transitions_container_meta,
				'options'     => depot_mikado_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#mkd_page_transition_preloader_container_meta",
						"no"  => "#mkd_page_transition_preloader_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#mkd_page_transition_preloader_container_meta"
					)
				)
			)
		);

		$page_transition_preloader_container_meta = depot_mikado_add_admin_container(
			array(
				'parent'          => $page_transitions_container_meta,
				'name'            => 'page_transition_preloader_container_meta',
				'hidden_property' => 'mkd_page_transition_preloader_meta',
				'hidden_values'   => array('','no')
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'   => 'mkd_smooth_pt_bgnd_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'depot' ),
				'parent' => $page_transition_preloader_container_meta
			)
		);

		$group_pt_spinner_animation_meta = depot_mikado_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation_meta',
				'title'       => esc_html__( 'Loader Style', 'depot' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'depot' ),
				'parent'      => $page_transition_preloader_container_meta
			)
		);

		$row_pt_spinner_animation_meta = depot_mikado_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation_meta',
				'parent' => $group_pt_spinner_animation_meta
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'mkd_smooth_pt_spinner_type_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'depot' ),
				'parent'        => $row_pt_spinner_animation_meta,
				'options'       => array(
					'rotate_circles'        => esc_html__( 'Rotate Circles', 'depot' ),
					'pulse'                 => esc_html__( 'Pulse', 'depot' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'depot' ),
					'cube'                  => esc_html__( 'Cube', 'depot' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'depot' ),
					'stripes'               => esc_html__( 'Stripes', 'depot' ),
					'wave'                  => esc_html__( 'Wave', 'depot' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'depot' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'depot' ),
					'atom'                  => esc_html__( 'Atom', 'depot' ),
					'clock'                 => esc_html__( 'Clock', 'depot' ),
					'mitosis'               => esc_html__( 'Mitosis', 'depot' ),
					'lines'                 => esc_html__( 'Lines', 'depot' ),
					'fussion'               => esc_html__( 'Fussion', 'depot' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'depot' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'depot' )
				)
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'mkd_smooth_pt_spinner_color_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'depot' ),
				'parent'        => $row_pt_spinner_animation_meta
			)
		);

		depot_mikado_add_meta_box_field(
			array(
				'name'          => 'mkd_page_transition_fadeout_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'depot' ),
				'options'     => depot_mikado_get_yes_no_select_array(),
				'parent'        => $page_transitions_container_meta

			)
		);

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_page_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Page Background Color', 'depot'),
                'description' => esc_html__('Choose background color for page content', 'depot'),
                'parent' => $general_meta_box
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_page_slider_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => esc_html__('Slider Shortcode', 'depot'),
                'description' => esc_html__('Paste your slider shortcode here', 'depot'),
                'parent' => $general_meta_box
            )
        );

        $mkd_content_padding_group = depot_mikado_add_admin_group(array(
            'name' => 'content_padding_group',
            'title' => esc_html__('Content Style', 'depot'),
            'description' => esc_html__('Define styles for Content area', 'depot'),
            'parent' => $general_meta_box
        ));

        $mkd_content_padding_row = depot_mikado_add_admin_row(array(
            'name' => 'mkd_content_padding_row',
            'next' => true,
            'parent' => $mkd_content_padding_group
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_page_content_top_padding',
                'type' => 'textsimple',
                'default_value' => '',
                'label' => esc_html__('Content Top Padding', 'depot'),
                'parent' => $mkd_content_padding_row,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_page_content_top_padding_mobile',
                'type' => 'selectsimple',
                'label' => esc_html__('Set this top padding for mobile header', 'depot'),
                'parent' => $mkd_content_padding_row,
                'options' => depot_mikado_get_yes_no_select_array(false)
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_page_comments_meta',
                'type' => 'select',
                'label' => esc_html__('Show Comments', 'depot'),
                'description' => esc_html__('Enabling this option will show comments on your page', 'depot'),
                'parent' => $general_meta_box,
                'options' => depot_mikado_get_yes_no_select_array()
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_boxed_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Boxed Layout', 'depot'),
                'parent'        => $general_meta_box,
                'options'     => array(
                    '' => '',
                    'yes' => esc_html__('Yes', 'depot'),
                    'no' => esc_html__('No', 'depot'),
                ),
                'args'          => array(
                    "dependence" => true,
                    'show' => array(
                        '' => '',
                        'yes' => '#mkd_mkd_boxed_container_meta',
                        'no' => '',

                    ),
                    'hide' => array(
                        '' => '#mkd_mkd_boxed_container_meta',
                        'yes' => '',
                        'no' => '#mkd_mkd_boxed_container_meta',
                    )
                )
            )
        );

        $boxed_container = depot_mikado_add_admin_container(
            array(
                'parent'            => $general_meta_box,
                'name'              => 'mkd_boxed_container_meta',
                'hidden_property'   => 'mkd_boxed_meta',
                'hidden_values'     => array('','no')
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_page_background_color_in_box_meta',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'depot'),
                'description' => esc_html__('Choose the page background color outside box.', 'depot'),
                'parent'      => $boxed_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_boxed_pattern_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'depot'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'depot'),
                'parent'      => $boxed_container
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_boxed_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'depot'),
                'description' => esc_html__('Choose an image to be displayed in background', 'depot'),
                'parent'      => $boxed_container,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_boxed_background_image_attachment_meta',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'depot'),
                'description'   => esc_html__('Choose background image attachment if background image option is set', 'depot'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => esc_html__('Fixed', 'depot'),
                    'scroll' => esc_html__('Scroll', 'depot')
                )
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_general_meta', 10);
}