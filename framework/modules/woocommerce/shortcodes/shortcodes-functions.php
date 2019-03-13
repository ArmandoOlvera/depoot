<?php

if(!function_exists('depot_mikado_include_woocommerce_shortcodes')) {
	function depot_mikado_include_woocommerce_shortcodes() {
		foreach(glob(MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

	}
	
	if(depot_mikado_core_plugin_installed()) {
		add_action('mkd_core_action_include_shortcodes_file', 'depot_mikado_include_woocommerce_shortcodes');
	}
}