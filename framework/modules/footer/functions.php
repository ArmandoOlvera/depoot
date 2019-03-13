<?php

if (!function_exists('depot_mikado_register_footer_sidebar')) {
	
	function depot_mikado_register_footer_sidebar() {
		
		register_sidebar(array(
			'name' => esc_html__('Footer Top Column 1', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the first column of top footer area', 'depot'),
			'id' => 'footer_top_column_1',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h4 class="mkd-widget-title">',
			'after_title' => '</h4></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Top Column 2', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the second column of top footer area', 'depot'),
			'id' => 'footer_top_column_2',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h4 class="mkd-widget-title">',
			'after_title' => '</h4></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Top Column 3', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the third column of top footer area', 'depot'),
			'id' => 'footer_top_column_3',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h4 class="mkd-widget-title">',
			'after_title' => '</h4></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Top Column 4', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the fourth column of top footer area', 'depot'),
			'id' => 'footer_top_column_4',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-4 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h4 class="mkd-widget-title">',
			'after_title' => '</h4></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Bottom Left Column', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the left column of bottom footer area', 'depot'),
			'id' => 'footer_bottom_column_1',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h2 class="mkd-widget-title">',
			'after_title' => '</h2></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Bottom Middle Column', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the middle column of bottom footer area', 'depot'),
			'id' => 'footer_bottom_column_2',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h2 class="mkd-widget-title">',
			'after_title' => '</h2></div>'
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer Bottom Right Column', 'depot'),
			'description'   => esc_html__('Widgets added here will appear in the right column of bottom footer area', 'depot'),
			'id' => 'footer_bottom_column_3',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-widget-title-holder"><h2 class="mkd-widget-title">',
			'after_title' => '</h2></div>'
		));
	}
	
	add_action('widgets_init', 'depot_mikado_register_footer_sidebar');
}

if (!function_exists('depot_mikado_get_footer')) {
	/**
	 * Loads footer HTML
	 */
	function depot_mikado_get_footer() {
		$parameters          = array();
		$page_id             = depot_mikado_get_page_id();
		$disable_footer_meta = get_post_meta($page_id, 'mkd_disable_footer_meta', true);
		
		$parameters['display_footer']        = $disable_footer_meta === 'yes' ? false : true;
		$parameters['display_footer_top']    = depot_mikado_show_footer_top();
		$parameters['display_footer_bottom'] = depot_mikado_show_footer_bottom();
		
		depot_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
	}
	
	add_action('depot_mikado_get_footer_template', 'depot_mikado_get_footer');
}

if(!function_exists('depot_mikado_show_footer_top')){
	/**
	 * Check footer top showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function depot_mikado_show_footer_top(){
		$footer_top_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = (depot_mikado_get_meta_field_intersect('show_footer_top') === 'yes') ? true : false;
		
		//check footer columns.If they are empty, disable footer top
		$columns_flag = false;
		for($i = 1; $i <= 4; $i++){
			$footer_columns_id = 'footer_top_column_'.$i;
			if(is_active_sidebar($footer_columns_id)) {
				$columns_flag = true;
				break;
			}
		}
		
		if($option_flag && $columns_flag){
			$footer_top_flag = true;
		}
		
		return $footer_top_flag;
	}
}

if(!function_exists('depot_mikado_show_footer_bottom')){
	/**
	 * Check footer bottom showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function depot_mikado_show_footer_bottom(){
		$footer_bottom_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = (depot_mikado_get_meta_field_intersect('show_footer_bottom') === 'yes') ? true : false;
		
		//check footer columns.If they are empty, disable footer bottom
		$columns_flag = false;
		for($i = 1; $i <= 3; $i++){
			$footer_columns_id = 'footer_bottom_column_'.$i;
			if(is_active_sidebar($footer_columns_id)) {
				$columns_flag = true;
				break;
			}
		}
		
		if($option_flag && $columns_flag){
			$footer_bottom_flag = true;
		}
		
		return $footer_bottom_flag;
	}
}

if (!function_exists('depot_mikado_get_content_bottom_area')) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function depot_mikado_get_content_bottom_area() {
		
		$parameters = array();
		
		//Current page id
		$id = depot_mikado_get_page_id();
		
		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = depot_mikado_get_meta_field_intersect('enable_content_bottom_area', $id);
		
		if ($parameters['content_bottom_area'] === 'yes') {
			
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = depot_mikado_get_meta_field_intersect('content_bottom_sidebar_custom_display', $id);
			//Content bottom area in grid
			$parameters['grid_class'] = (depot_mikado_get_meta_field_intersect('content_bottom_in_grid', $id)) === 'yes' ? 'mkd-grid' : 'mkd-full-width';
			
			$parameters['content_bottom_style'] = array();
			
			//Content bottom area background color
			$background_color = depot_mikado_get_meta_field_intersect('content_bottom_background_color', $id);
			if ($background_color !== '') {
				$parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
			}
			
			if(is_active_sidebar($parameters['content_bottom_area_sidebar'])){
				depot_mikado_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);
			}
		}
	}
}

if (!function_exists('depot_mikado_get_footer_top')) {
	/**
	 * Return footer top HTML
	 */
	function depot_mikado_get_footer_top() {
        $id = depot_mikado_get_page_id();
		$parameters = array();
        $parameters['footer_in_grid'] = (depot_mikado_get_meta_field_intersect('footer_in_grid') === 'yes') ? true : false;
		
		//get number of top footer columns
		$parameters['footer_top_columns'] = depot_mikado_options()->getOptionValue('footer_top_columns');
		
		//get footer top grid/full width class
		$parameters['footer_top_grid_class'] = (depot_mikado_get_meta_field_intersect('footer_in_grid') === 'yes') ? 'mkd-grid' : 'mkd-full-width';
		
		//get footer top other classes
		$footer_top_classes = array();
		
			//footer alignment
			$footer_top_alignment = depot_mikado_options()->getOptionValue('footer_top_columns_alignment');
			$footer_top_classes[] = !empty($footer_top_alignment) ? 'mkd-footer-top-alignment-'.esc_attr($footer_top_alignment) : '';

            //Footer Top skin
            $footer_top_skin = depot_mikado_get_meta_field_intersect('footer_top_skin', $id);
            if ($footer_top_skin !== '') {
                $footer_top_classes[] = 'mkd-' . $footer_top_skin;
            }
		
		$footer_top_classes   = apply_filters('depot_mikado_footer_top_classes', $footer_top_classes);
		
		$parameters['footer_top_classes'] = implode(' ', $footer_top_classes);

        $parameters['use_custom_widgets'] = get_post_meta($id, 'show_footer_custom_widget_areas', true);
		
		depot_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
	}
}

if (!function_exists('depot_mikado_get_footer_bottom')) {
	/**
	 * Return footer bottom HTML
	 */
	function depot_mikado_get_footer_bottom() {
        $id = depot_mikado_get_page_id();
		$parameters = array();
        $parameters['footer_in_grid'] = (depot_mikado_get_meta_field_intersect('footer_in_grid') === 'yes') ? true : false;
		
		//get number of bottom footer columns
		$parameters['footer_bottom_columns'] = depot_mikado_options()->getOptionValue('footer_bottom_columns');
		
		//get footer bottom grid/full width class
		$parameters['footer_bottom_grid_class'] = (depot_mikado_get_meta_field_intersect('footer_in_grid') === 'yes') ? 'mkd-grid' : 'mkd-full-width';
		
		//get footer bottom other classes
		$footer_bottom_classes = array();

        //Footer Bottom skin
        $footer_bottom_skin = depot_mikado_get_meta_field_intersect('footer_bottom_skin', $id);
        if ($footer_bottom_skin !== '') {
            $footer_bottom_classes[] = 'mkd-' . $footer_bottom_skin;
        }

		$footer_bottom_classes = apply_filters('depot_mikado_footer_bottom_classes', $footer_bottom_classes);
		
		$parameters['footer_bottom_classes'] = implode(' ', $footer_bottom_classes);

        $parameters['use_custom_widgets'] = get_post_meta($id, 'show_footer_custom_widget_areas', true);
		
		depot_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
	}
}

if (!function_exists('depot_mikado_footer_page_styles')) {
    /**
     * @param $styles
     *
     * @return array
     */
    function depot_mikado_footer_page_styles($styles) {
        $id = depot_mikado_get_page_id();

        $top_background_color = get_post_meta($id, 'mkd_footer_top_background_color_meta', true);

        $bottom_background_color = get_post_meta($id, 'mkd_footer_bottom_background_color_meta', true);

        $page_prefix = depot_mikado_get_unique_page_class($id);

        $current_style = '';


        //Footer Top background color
        if ($top_background_color !== '') {

            $footer_top_bg_color_selectors = array(
                'body' . $page_prefix . ' footer.mkd-page-footer .mkd-footer-top-holder'
            );

            $footer_top_bg_color_styles = array(
                'background-color' => $top_background_color
            );

            $current_style .= depot_mikado_dynamic_css($footer_top_bg_color_selectors, $footer_top_bg_color_styles);
        }

        //Footer Bottom background color
        if ($bottom_background_color !== '') {

            $footer_bottom_bg_color_selectors = array(
                'body' . $page_prefix . ' footer.mkd-page-footer .mkd-footer-bottom-holder'
            );

            $footer_bottom_bg_color_styles = array(
                'background-color' => $bottom_background_color
            );

            $current_style .= depot_mikado_dynamic_css($footer_bottom_bg_color_selectors, $footer_bottom_bg_color_styles);
        }

        $current_style = $current_style . $styles;

        return $current_style;
    }

    add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_footer_page_styles');
}