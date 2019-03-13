<?php

class DepotMikadoBlogListWidget extends DepotMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_blog_list_widget',
            esc_html__('Mikado Blog List Widget', 'depot'),
            array( 'description' => esc_html__( 'Display a list of your blog posts', 'depot'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__('Widget Title', 'depot')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'type',
                'title'   => esc_html__('Type', 'depot'),
                'options' => array(
                    'simple'  => esc_html__('Simple', 'depot'),
                    'minimal' => esc_html__('Minimal', 'depot')
                )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_posts',
                'title' => esc_html__('Number of Posts', 'depot')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'space_between_columns',
                'title'   => esc_html__('Space Between items', 'depot'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'depot'),
                    'small'  => esc_html__('Small', 'depot'),
                    'tiny'   => esc_html__('Tiny', 'depot'),
                    'no'     => esc_html__('No Space', 'depot')
                )
            ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order_by',
		        'title'   => esc_html__('Order By', 'depot'),
		        'options' => depot_mikado_get_query_order_by_array()
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'order',
		        'title'   => esc_html__('Order', 'depot'),
		        'options' => depot_mikado_get_query_order_array()
	        ),
            array(
                'type'        => 'textfield',
                'name'        => 'category',
                'title'       => esc_html__('Category Slug', 'depot'),
                'description' => esc_html__('Leave empty for all or use comma for list', 'depot')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__('Title Tag', 'depot'),
                'options' => depot_mikado_get_title_tag(true)
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_transform',
                'title'   => esc_html__('Title Text Transform', 'depot'),
                'options' => depot_mikado_get_text_transform_array(true)
            ),
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

        $instance['post_info_section'] = 'yes';
        $instance['number_of_columns'] = '1';

        // Filter out all empty params
        $instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

        //generate shortcode params
        foreach($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        $available_types = array('simple', 'classic');

        if (!in_array($instance['type'], $available_types)) {
            $instance['type'] = 'simple';
        }

        echo '<div class="widget mkd-blog-list-widget">';
            if(!empty($instance['widget_title'])) {
                print $args['before_title'].$instance['widget_title'].$args['after_title'];
            }

            echo do_shortcode("[mkd_blog_list $params]"); // XSS OK
        echo '</div>';
    }
}