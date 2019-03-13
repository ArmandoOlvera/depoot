<?php

class DepotMikadoSearchOpener extends DepotMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_search_opener',
	        esc_html__('Mikado Search Opener', 'depot'),
	        array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'depot'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_size',
                'title'       => esc_html__('Icon Size (px)', 'depot'),
                'description' => esc_html__('Define size for search icon', 'depot')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_color',
                'title'       => esc_html__('Icon Color', 'depot'),
                'description' => esc_html__('Define color for search icon', 'depot')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_hover_color',
                'title'       => esc_html__('Icon Hover Color', 'depot'),
                'description' => esc_html__('Define hover color for search icon', 'depot')
            ),
	        array(
		        'type' => 'textfield',
		        'name' => 'search_icon_margin',
		        'title' => esc_html__('Icon Margin', 'depot'),
		        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'depot')
	        ),
            array(
	            'type'        => 'dropdown',
	            'name'        => 'show_label',
                'title'       => esc_html__('Enable Search Icon Text', 'depot'),
                'description' => esc_html__('Enable this option to show search text next to search icon in header', 'depot'),
                'options'     => depot_mikado_get_yes_no_select_array()
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
        global $depot_options, $depot_IconCollections;

	    $search_type_class    = 'mkd-search-opener mkd-icon-has-hover';
	    $styles = array();
	    $show_search_text     = $instance['show_label'] == 'yes' || $depot_options['enable_search_icon_text'] == 'yes' ? true : false;

	    if(!empty($instance['search_icon_size'])) {
		    $styles[] = 'font-size: '.intval($instance['search_icon_size']).'px';
	    }

	    if(!empty($instance['search_icon_color'])) {
		    $styles[] = 'color: '.$instance['search_icon_color'].';';
	    }

	    if (!empty($instance['search_icon_margin'])) {
		    $styles[] = 'margin: ' . $instance['search_icon_margin'].';';
	    }
	    ?>

	    <a <?php depot_mikado_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php depot_mikado_inline_style($styles); ?>
		    <?php depot_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <span class="mkd-search-opener-wrapper">
                <?php if(isset($depot_options['search_icon_pack'])) {
	                $depot_IconCollections->getSearchIcon($depot_options['search_icon_pack'], false);
                } ?>
	            <?php if($show_search_text) { ?>
		            <span class="mkd-search-icon-text"><?php esc_html_e('Search', 'depot'); ?></span>
	            <?php } ?>
            </span>
	    </a>
    <?php }
}