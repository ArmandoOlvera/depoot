<?php

if(!function_exists('depot_mikado_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function depot_mikado_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_theme_version_class');
}

if(!function_exists('depot_mikado_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function depot_mikado_boxed_class($classes) {

        //is boxed layout turned on?
        if(depot_mikado_get_meta_field_intersect('boxed') == 'yes' && depot_mikado_get_meta_field_intersect('header_type') !== 'header-vertical') {
            $classes[] = 'mkd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_boxed_class');
}

if(!function_exists('depot_mikado_paspartu_class')) {
    /**
     * Function that adds classes on body for paspartu layout
     */
    function depot_mikado_paspartu_class($classes) {

        //is paspartu layout turned on?
        if(depot_mikado_get_meta_field_intersect('paspartu') === 'yes') {
            $classes[] = 'mkd-paspartu-enabled';

            if(depot_mikado_get_meta_field_intersect('disable_top_paspartu') === 'yes') {
                $classes[] = 'mkd-top-paspartu-disabled';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_paspartu_class');
}

if(!function_exists('depot_mikado_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function depot_mikado_smooth_page_transitions_class($classes) {

		$id = depot_mikado_get_page_id();

		if(depot_mikado_get_meta_field_intersect('smooth_page_transitions',$id) == 'yes') {
			$classes[] = 'mkd-smooth-page-transitions';

			if(depot_mikado_get_meta_field_intersect('page_transition_preloader',$id) == 'yes') {
				$classes[] = 'mkd-smooth-page-transitions-preloader';
			}

			if(depot_mikado_get_meta_field_intersect('page_transition_fadeout',$id) == 'yes') {
				$classes[] = 'mkd-smooth-page-transitions-fadeout';
			}

		}
        return $classes;
    }

    add_filter('body_class', 'depot_mikado_smooth_page_transitions_class');
}

if(!function_exists('depot_mikado_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function depot_mikado_content_initial_width_body_class($classes) {

        if(depot_mikado_options()->getOptionValue('initial_content_width')) {
            $classes[] = depot_mikado_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'depot_mikado_content_initial_width_body_class');
}