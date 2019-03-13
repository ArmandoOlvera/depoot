<?php

if( !function_exists('depot_mikado_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function depot_mikado_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'mkd-container';
        $params_list['inner'] = 'mkd-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'depot_mikado_blog_holder_params', 'depot_mikado_get_blog_holder_params' );
}

if( !function_exists('depot_mikado_get_blog_single_holder_classes') ) {
    /**
     * Function that generates blog holder classes for single blog page
     */
    function depot_mikado_get_blog_single_holder_classes($classes) {
        $sidebar_classes   = array();
        $sidebar_classes[] = 'mkd-grid-large-gutter';
	
	    $classes = $classes . ' ' . implode(' ', $sidebar_classes);
	    
        return $classes;
    }

    add_filter( 'depot_mikado_blog_single_holder_classes', 'depot_mikado_get_blog_single_holder_classes' );
}

if( !function_exists('depot_mikado_blog_part_params') ) {
    function depot_mikado_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h2';
        $part_params['link_tag'] = 'h5';
        $part_params['quote_tag'] = 'h5';

        return array_merge($params, $part_params);
    }

    add_filter( 'depot_mikado_blog_part_params', 'depot_mikado_blog_part_params' );
}