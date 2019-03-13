<?php

if (!function_exists('depot_mikado_register_widgets')) {
	function depot_mikado_register_widgets() {
		$widgets = array(
			'DepotMikadoBlogListWidget',
			'DepotMikadoButtonWidget',
			'DepotMikadoImageWidget',
			'DepotMikadoImageSliderWidget',
			'DepotMikadoRawHTMLWidget',
			'DepotMikadoSearchOpener',
			'DepotMikadoSeparatorWidget',
			'DepotMikadoSideAreaOpener',
			'DepotMikadoSocialIconWidget'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
	
	add_action('widgets_init', 'depot_mikado_register_widgets');
}