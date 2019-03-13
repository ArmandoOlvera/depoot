<?php

if(depot_mikado_is_yith_wcwl_install()) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-conf.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-functions.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-hooks.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/widgets/yith-wishlist.php';
}