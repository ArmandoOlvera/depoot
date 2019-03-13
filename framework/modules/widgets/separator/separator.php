<?php

class DepotMikadoSeparatorWidget extends DepotMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_separator_widget',
	        esc_html__('Mikado Separator Widget', 'depot'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'depot'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'name' => 'type',
                'title' => esc_html__('Type', 'depot'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'depot'),
                    'full-width' => esc_html__('Full Width', 'depot')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'position',
                'title' => esc_html__('Position', 'depot'),
                'options' => array(
                    'center' => esc_html__('Center', 'depot'),
                    'left' => esc_html__('Left', 'depot'),
                    'right' => esc_html__('Right', 'depot')
                )
            ),
            array(
                'type' => 'dropdown',
                'name' => 'border_style',
                'title' => esc_html__('Style', 'depot'),
                'options' => array(
                    'solid' => esc_html__('Solid', 'depot'),
                    'dashed' => esc_html__('Dashed', 'depot'),
                    'dotted' => esc_html__('Dotted', 'depot')
                )
            ),
            array(
                'type' => 'textfield',
                'name' => 'color',
                'title' => esc_html__('Color', 'depot')
            ),
            array(
                'type' => 'textfield',
                'name' => 'width',
                'title' => esc_html__('Width', 'depot')
            ),
            array(
                'type' => 'textfield',
                'name' => 'thickness',
                'title' => esc_html__('Thickness (px)', 'depot')
            ),
            array(
                'type' => 'textfield',
                'name' => 'top_margin',
                'title' => esc_html__('Top Margin', 'depot')
            ),
            array(
                'type' => 'textfield',
                'name' => 'bottom_margin',
                'title' => esc_html__('Bottom Margin', 'depot')
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
        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkd-separator-widget">';
            echo do_shortcode("[mkd_separator $params]"); // XSS OK
        echo '</div>';
    }
}