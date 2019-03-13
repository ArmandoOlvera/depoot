<?php
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-functions.php';

if (depot_mikado_is_woocommerce_installed()) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/admin/options-map/map.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/admin/meta-boxes/woocommerce-meta-boxes.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-template-hooks.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-config.php';
	
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/shortcodes-functions.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/widgets/woocommerce-dropdown-cart.php';

	foreach(glob(MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/plugins/*/load.php') as $plugin_load) {
		include_once $plugin_load;
	}
}