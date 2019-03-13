<?php

if(!function_exists('depot_mikado_disable_wpml_css')) {
    function depot_mikado_disable_wpml_css() {
	    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }

	add_action('after_setup_theme', 'depot_mikado_disable_wpml_css');
}