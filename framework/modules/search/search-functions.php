<?php

if( !function_exists('depot_mikado_load_search') ) {
    function depot_mikado_load_search() {

        $search_type = 'fullscreen';
        $search_type = depot_mikado_options()->getOptionValue('search_type');

        if ( depot_mikado_active_widget( false, false, 'mkd_search_opener' ) ) {
            include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('init', 'depot_mikado_load_search');
}