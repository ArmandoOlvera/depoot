<?php

if (!function_exists('depot_mikado_title_area_typography_style')) {

    function depot_mikado_title_area_typography_style(){

        // title default/small style
	    
	    $item_styles = depot_mikado_get_typography_styles('page_title');
	
	    $item_selector = array(
		    '.mkd-title .mkd-title-holder .mkd-page-title'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
	
	    // subtitle style
	
	    $item_styles = depot_mikado_get_typography_styles('page_subtitle');
	
	    $item_selector = array(
		    '.mkd-title .mkd-title-holder .mkd-subtitle'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
	
	    // breadcrumb style
	
	    $item_styles = depot_mikado_get_typography_styles('page_breadcrumb');
	
	    $item_selector = array(
		    '.mkd-title .mkd-title-holder .mkd-breadcrumbs a',
		    '.mkd-title .mkd-title-holder .mkd-breadcrumbs span'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
	    

	    $breadcrumb_hover_color = depot_mikado_options()->getOptionValue('page_breadcrumb_hovercolor');
	    
        $breadcrumb_hover_styles = array();
        if(!empty($breadcrumb_hover_color)) {
            $breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
        }

        $breadcrumb_hover_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover'
        );

        echo depot_mikado_dynamic_css($breadcrumb_hover_selector, $breadcrumb_hover_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_title_area_typography_style');
}