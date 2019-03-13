<?php

if(!function_exists('depot_mikado_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function depot_mikado_get_vc_version() {
		if(depot_mikado_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}