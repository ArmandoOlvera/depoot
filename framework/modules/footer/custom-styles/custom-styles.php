<?php

if(!function_exists('depot_mikado_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function depot_mikado_footer_top_general_styles() {
        $item_styles = array();
        $background_color = depot_mikado_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo depot_mikado_dynamic_css('footer.mkd-page-footer .mkd-footer-top-holder', $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_footer_top_general_styles');
}

if(!function_exists('depot_mikado_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function depot_mikado_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = depot_mikado_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

        echo depot_mikado_dynamic_css('footer.mkd-page-footer .mkd-footer-bottom-holder', $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_footer_bottom_general_styles');
}