<?php

class DepotMikadoButtonWidget extends DepotMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkd_button_widget',
			esc_html__('Mikado Button Widget', 'depot'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'depot'))
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__('Type', 'depot'),
				'options' => array(
					'solid'   => esc_html__('Solid', 'depot'),
					'outline' => esc_html__('Outline', 'depot'),
					'simple'  => esc_html__('Simple', 'depot')
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'size',
				'title'   => esc_html__('Size', 'depot'),
				'options' => array(
					'small'  => esc_html__('Small', 'depot'),
					'medium' => esc_html__('Medium', 'depot'),
					'large'  => esc_html__('Large', 'depot'),
					'huge'   => esc_html__('Huge', 'depot')
				),
				'description' => esc_html__('This option is only available for solid and outline button type', 'depot')
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__('Text', 'depot'),
				'default' => esc_html__('Button Text', 'depot')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__('Link', 'depot')
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__('Link Target', 'depot'),
				'options' => depot_mikado_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__('Color', 'depot')
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__('Hover Color', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__('Background Color', 'depot'),
				'description' => esc_html__('This option is only available for solid button type', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__('Hover Background Color', 'depot'),
				'description' => esc_html__('This option is only available for solid button type', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__('Border Color', 'depot'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__('Hover Border Color', 'depot'),
				'description' => esc_html__('This option is only available for solid and outline button type', 'depot')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__('Margin', 'depot'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'depot')
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {
		$params = '';

		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget mkd-button-widget">';
			echo do_shortcode("[mkd_button $params]"); // XSS OK
		echo '</div>';
	}
}