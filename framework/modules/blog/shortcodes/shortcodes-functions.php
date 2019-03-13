<?php

if(!function_exists('depot_mikado_include_blog_shortcodes')) {
	function depot_mikado_include_blog_shortcodes() {
		include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-list/blog-list.php';
		include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-slider/blog-slider.php';
	}
	
	if(depot_mikado_core_plugin_installed()) {
		add_action('mkd_core_action_include_shortcodes_file', 'depot_mikado_include_blog_shortcodes');
	}
}

if(!function_exists('depot_mikado_add_blog_shortcodes')) {
	function depot_mikado_add_blog_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\BlogList\BlogList',
			'MikadoCore\CPT\Shortcodes\BlogSlider\BlogSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	if(depot_mikado_core_plugin_installed()) {
		add_filter('mkd_core_filter_add_vc_shortcode', 'depot_mikado_add_blog_shortcodes');
	}
}