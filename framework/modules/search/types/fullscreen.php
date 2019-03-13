<?php

if( !function_exists('depot_mikado_search_body_class') ) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function depot_mikado_search_body_class($classes) {

        $classes[] = 'mkd-fullscreen-search';
        $classes[] = 'mkd-search-fade';

        return $classes;

    }

    add_filter('body_class', 'depot_mikado_search_body_class');
}

if ( ! function_exists('depot_mikado_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function depot_mikado_get_search() {
        depot_mikado_load_search_template();
    }

    add_action('depot_mikado_before_page_header', 'depot_mikado_get_search', 9);
}

if ( ! function_exists('depot_mikado_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function depot_mikado_load_search_template() {
        depot_mikado_get_module_template_part('templates/types/fullscreen', 'search');
    }
}