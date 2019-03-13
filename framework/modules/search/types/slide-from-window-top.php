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

        $classes[] = 'mkd-search-slides-from-window-top';

        return $classes;

    }

    add_filter('body_class', 'depot_mikado_search_body_class');
}

if ( ! function_exists('depot_mikado_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function depot_mikado_get_search() {

        add_action( 'depot_mikado_after_header_menu_area_html_open', 'depot_mikado_load_search_template');
        if ( depot_mikado_is_responsive_on() ) {
            add_action( 'depot_mikado_after_mobile_header_html_open', 'depot_mikado_load_search_template');
        }
    }

    add_action('depot_mikado_before_page_header', 'depot_mikado_get_search', 9);
}

if ( ! function_exists('depot_mikado_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function depot_mikado_load_search_template() {

        $search_in_grid = depot_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false;
        $search_icon = '';
        $search_icon_close = '';
        if ( depot_mikado_options()->getOptionValue('search_icon_pack') !== '' ) {
            $search_icon = depot_mikado_icon_collections()->getSearchIcon( depot_mikado_options()->getOptionValue('search_icon_pack'), true );
            $search_icon_close = depot_mikado_icon_collections()->getSearchClose( depot_mikado_options()->getOptionValue('search_icon_pack'), true );
        }

        $parameters = array(
            'search_in_grid'		=> $search_in_grid,
            'search_icon'			=> $search_icon,
            'search_icon_close'		=> $search_icon_close
        );

        depot_mikado_get_module_template_part('templates/types/slide-from-window-top', 'search', '', $parameters);

    }
}