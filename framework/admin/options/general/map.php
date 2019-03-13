<?php

if ( ! function_exists('depot_mikado_general_options_map') ) {
    /**
     * General options page
     */
    function depot_mikado_general_options_map() {

        depot_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'depot'),
                'icon'  => 'fa fa-institution'
            )
        );

		$panel_logo = depot_mikado_add_admin_panel(
			array(
				'page' => '',
				'name' => 'panel_logo',
				'title' => esc_html__('Logo', 'depot')
			)
		);

		depot_mikado_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__('Hide Logo', 'depot'),
				'description' => esc_html__('Enabling this option will hide logo image', 'depot'),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkd_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = depot_mikado_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Default', 'depot'),
				'parent' => $hide_logo_container
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_dark.png",
				'label' => esc_html__('Logo Image - Dark', 'depot'),
				'parent' => $hide_logo_container
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label' => esc_html__('Logo Image - Light', 'depot'),
				'parent' => $hide_logo_container
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Sticky', 'depot'),
				'parent' => $hide_logo_container
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Mobile', 'depot'),
				'parent' => $hide_logo_container
			)
		);


        $panel_appearance_style = depot_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_appearance',
                'title' => esc_html__('Appearance', 'depot')
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Google Font Family', 'depot'),
                'description'   => esc_html__('Choose a default Google font for your site', 'depot'),
                'parent' => $panel_appearance_style
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'depot'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = depot_mikado_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'depot'),
                'description'   => esc_html__('Choose additional Google font for your site', 'depot'),
                'parent'        => $additional_google_fonts_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'depot'),
                'description'   => esc_html__('Choose additional Google font for your site', 'depot'),
                'parent'        => $additional_google_fonts_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'depot'),
                'description'   => esc_html__('Choose additional Google font for your site', 'depot'),
                'parent'        => $additional_google_fonts_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'depot'),
                'description'   => esc_html__('Choose additional Google font for your site', 'depot'),
                'parent'        => $additional_google_fonts_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'depot'),
                'description'   => esc_html__('Choose additional Google font for your site', 'depot'),
                'parent'        => $additional_google_fonts_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name' => 'google_font_weight',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Style & Weight', 'depot'),
                'description' => esc_html__('Choose a default Google font weights for your site. Impact on page load time', 'depot'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    '100'       => esc_html__('100 Thin', 'depot'),
                    '100italic' => esc_html__('100 Thin Italic', 'depot'),
                    '200'       => esc_html__('200 Extra-Light', 'depot'),
                    '200italic' => esc_html__('200 Extra-Light Italic', 'depot'),
                    '300'       => esc_html__('300 Light', 'depot'),
                    '300italic' => esc_html__('300 Light Italic', 'depot'),
                    '400'       => esc_html__('400 Regular', 'depot'),
                    '400italic' => esc_html__('400 Regular Italic', 'depot'),
                    '500'       => esc_html__('500 Medium', 'depot'),
                    '500italic' => esc_html__('500 Medium Italic', 'depot'),
                    '600'       => esc_html__('600 Semi-Bold', 'depot'),
                    '600italic' => esc_html__('600 Semi-Bold Italic', 'depot'),
                    '700'       => esc_html__('700 Bold', 'depot'),
                    '700italic' => esc_html__('700 Bold Italic', 'depot'),
                    '800'       => esc_html__('800 Extra-Bold', 'depot'),
                    '800italic' => esc_html__('800 Extra-Bold Italic', 'depot'),
                    '900'       => esc_html__('900 Ultra-Bold', 'depot'),
                    '900italic' => esc_html__('900 Ultra-Bold Italic', 'depot')
                )
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name' => 'google_font_subset',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Subset', 'depot'),
                'description' => esc_html__('Choose a default Google font subsets for your site', 'depot'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    'latin' => esc_html__('Latin', 'depot'),
                    'latin-ext' => esc_html__('Latin Extended', 'depot'),
                    'cyrillic' => esc_html__('Cyrillic', 'depot'),
                    'cyrillic-ext' => esc_html__('Cyrillic Extended', 'depot'),
                    'greek' => esc_html__('Greek', 'depot'),
                    'greek-ext' => esc_html__('Greek Extended', 'depot'),
                    'vietnamese' => esc_html__('Vietnamese', 'depot')
                )
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => esc_html__('First Main Color', 'depot'),
                'description'   => esc_html__('Choose the most dominant theme color. Default color is #00bbb3', 'depot'),
                'parent'        => $panel_appearance_style
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'depot'),
                'description'   => esc_html__('Choose the background color for page content. Default color is #ffffff', 'depot'),
                'parent'        => $panel_appearance_style
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => esc_html__('Text Selection Color', 'depot'),
                'description'   => esc_html__('Choose the color users see when selecting text', 'depot'),
                'parent'        => $panel_appearance_style
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'depot'),
                'description'   => '',
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_boxed_container"
                )
            )
        );

        $boxed_container = depot_mikado_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'depot'),
                'description'   => esc_html__('Choose the page background color outside box', 'depot'),
                'parent'        => $boxed_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Image', 'depot'),
                'description'   => esc_html__('Choose an image to be displayed in background', 'depot'),
                'parent'        => $boxed_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Pattern', 'depot'),
                'description'   => esc_html__('Choose an image to be used as background pattern', 'depot'),
                'parent'        => $boxed_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'depot'),
                'description'   => esc_html__('Choose background image attachment', 'depot'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => esc_html__('Fixed', 'depot'),
                    'scroll'    => esc_html__('Scroll', 'depot')
                )
            )
        );
        
        depot_mikado_add_admin_field(
            array(
                'name'          => 'paspartu',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Passepartout', 'depot'),
                'description'   => esc_html__('Enabling this option will display passepartout around site content', 'depot'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_paspartu_container"
                )
            )
        );

        $paspartu_container = depot_mikado_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'paspartu_container',
                'hidden_property'   => 'paspartu',
                'hidden_value'      => 'no'
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'paspartu_color',
                'type'          => 'color',
                'label'         => esc_html__('Passepartout Color', 'depot'),
                'description'   => esc_html__('Choose passepartout color, default value is #ffffff', 'depot'),
                'parent'        => $paspartu_container
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name' => 'paspartu_width',
                'type' => 'text',
                'label' => esc_html__('Passepartout Size', 'depot'),
                'description' => esc_html__('Enter size amount for passepartout', 'depot'),
                'parent' => $paspartu_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        depot_mikado_add_admin_field(
            array(
                'parent' => $paspartu_container,
                'type' => 'yesno',
                'default_value' => 'no',
                'name' => 'disable_top_paspartu',
                'label' => esc_html__('Disable Top Passepartout', 'depot')
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'mkd-grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'depot'),
                'description'   => esc_html__('Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'depot'),
                'parent'        => $panel_appearance_style,
                'options'       => array(
                    'mkd-grid-1100' => esc_html__('1100px', 'depot'),
                    'mkd-grid-1300' => esc_html__('1300px - default', 'depot'),
                    'mkd-grid-1200' => esc_html__('1200px', 'depot'),
                    'mkd-grid-1000' => esc_html__('1000px', 'depot'),
                    'mkd-grid-800'  => esc_html__('800px', 'depot')
                )
            )
        );

        $panel_settings = depot_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behaviour', 'depot')
            )
        );

		depot_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'depot' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_page_transitions_container"
				)
			)
		);

		$page_transitions_container = depot_mikado_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'depot' ),
				'parent'        => $page_transitions_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_page_transition_preloader_container"
				)
			)
		);

		$page_transition_preloader_container = depot_mikado_add_admin_container(
			array(
				'parent'          => $page_transitions_container,
				'name'            => 'page_transition_preloader_container',
				'hidden_property' => 'page_transition_preloader',
				'hidden_value'    => 'no'
			)
		);


		depot_mikado_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'depot' ),
				'parent' => $page_transition_preloader_container
			)
		);

		$group_pt_spinner_animation = depot_mikado_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'depot' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'depot' ),
				'parent'      => $page_transition_preloader_container
			)
		);

		$row_pt_spinner_animation = depot_mikado_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'depot' ),
				'parent'        => $row_pt_spinner_animation,
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

		depot_mikado_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'depot' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

		depot_mikado_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'depot' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'depot' ),
				'parent'        => $page_transitions_container
			)
		);

        depot_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'depot'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'depot'),
                'parent'        => $panel_settings
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'depot'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'depot'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = depot_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'depot')
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom CSS', 'depot'),
                'description'   => esc_html__('Enter your custom CSS here', 'depot'),
                'parent'        => $panel_custom_code
            )
        );

        depot_mikado_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom JS', 'depot'),
                'description'   => esc_html__('Enter your custom Javascript here', 'depot'),
                'parent'        => $panel_custom_code
            )
        );
	
	    $panel_google_api = depot_mikado_add_admin_panel(
		    array(
			    'page'  => '',
			    'name'  => 'panel_google_api',
			    'title' => esc_html__('Google API', 'depot')
		    )
	    );
	
	    depot_mikado_add_admin_field(
		    array(
			    'name'        => 'google_maps_api_key',
			    'type'        => 'text',
			    'label'       => esc_html__('Google Maps Api Key', 'depot'),
			    'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'depot'),
			    'parent'      => $panel_google_api
		    )
	    );
    }

    add_action( 'depot_mikado_options_map', 'depot_mikado_general_options_map', 1);
}