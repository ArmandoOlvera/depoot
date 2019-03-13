<?php

if( !function_exists('depot_mikado_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function depot_mikado_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'mkd-container';
        $params_list['inner'] = 'mkd-container-inner clearfix';

        $params_list['module_title'] = true;
        $params_list['module_title_layout'] = 'title-area-empty';

        return $params_list;
    }

    add_filter( 'depot_mikado_blog_holder_params', 'depot_mikado_get_blog_holder_params' );
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

if( !function_exists('depot_mikado_get_blog_single_title_height') ) {
    /**
     * Function that sets default title height for specific type of header
     *
     * @see depot_mikado_get_title_area_height_default_value() in title-functions.php
     *
     * @param int $height standard height value
     *
     * @return integer value of title height
     */
    function depot_mikado_get_blog_single_title_height($height) {
        if($height == depot_mikado_get_title_area_height_default_value()) {
            return 350;
        }

        return $height;
    }

    add_filter( 'depot_mikado_title_area_height', 'depot_mikado_get_blog_single_title_height' );
}

if(!function_exists('depot_mikado_blog_single_layout_title_class')) {
    /**
     * Function that adds class on title holder if full height title option is enabled for single post page
     * First filter is for applying class
     * Second filter is for overriding title values
     *
     * @see depot_mikado_title_classes() in filter-functions.php
     *
     * @param $classes array of classes
     *
     * @return array changed array of classes
     *
     */
    function depot_mikado_blog_single_layout_title_class($classes) {

        $classes[] = 'mkd-blog-single-title-area-empty';

        return $classes;
    }

    add_filter('depot_mikado_title_classes', 'depot_mikado_blog_single_layout_title_class');
}

if(!function_exists('depot_mikado_blog_single_layout_title_load')) {
    /**
     * Function that calls function for overriding title values
     *
     * @see depot_mikado_blog_single_title_module() in filter-functions.php
     *
     *
     */
    function depot_mikado_blog_single_layout_title_load() {

        add_filter('depot_mikado_title_area_height_params', 'depot_mikado_blog_single_title_module');
		add_filter('depot_mikado_title_image_exists', 'depot_mikado_post_has_thumbnail');
    }

    add_action('depot_mikado_blog_single_loaded', 'depot_mikado_blog_single_layout_title_load');
}
