<?php
namespace MikadoCore\CPT\Shortcodes\ProductListCarousel;

use MikadoCore\Lib;

class ProductListCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_product_list_carousel';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Product List - Carousel', 'depot'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list-carousel extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'depot'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_items',
						'heading'    => esc_html__('Space Between Items', 'depot'),
						'value'      => array(
							esc_html__('Normal', 'depot')   => 'normal',
							esc_html__('Small', 'depot')    => 'small',
							esc_html__('Tiny', 'depot')     => 'tiny',
							esc_html__('No Space', 'depot') => 'no'
						),
						'save_always' => true,
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order_by',
						'heading'     => esc_html__('Order By', 'depot'),
						'value'       => array_flip(depot_mikado_get_query_order_by_array()),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'depot'),
						'value'       => array_flip(depot_mikado_get_query_order_array()),
						'save_always' => true
					),
					array(
	                    'type'       => 'dropdown',
	                    'param_name' => 'taxonomy_to_display',
	                    'heading'    => esc_html__('Choose Sorting Taxonomy', 'depot'),
	                    'value'      => array(
							esc_html__('Category', 'depot') => 'category',
							esc_html__('Tag', 'depot')      => 'tag',
							esc_html__('Id', 'depot')       => 'id'
	                    ),
	                    'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'depot')
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'param_name'  => 'taxonomy_values',
	                    'heading'     => esc_html__('Enter Taxonomy Values', 'depot'),
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'depot')
	                ),
	                array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Image Proportions', 'depot'),
						'param_name' => 'image_size',
						'value'      => array(
							esc_html__('Default', 'depot')        => '',
							esc_html__('Original', 'depot')       => 'full',
							esc_html__('Square', 'depot')         => 'square',
							esc_html__('Landscape', 'depot')      => 'landscape',
							esc_html__('Portrait', 'depot')       => 'portrait',
							esc_html__('Medium', 'depot')         => 'medium',
							esc_html__('Large', 'depot')          => 'large',
							esc_html__('Shop Catalog', 'depot')   => 'shop_catalog',
							esc_html__('Shop Single', 'depot')    => 'shop_single',
							esc_html__('Shop Thumbnail', 'depot') => 'shop_thumbnail'
						)
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'number_of_visible_items',
						'heading'    => esc_html__('Number Of Visible Items', 'depot'),
						'value'      => array(
							esc_html__('One', 'depot')   => '1',
							esc_html__('Two', 'depot')   => '2',
							esc_html__('Three', 'depot') => '3',
							esc_html__('Four', 'depot')  => '4',
							esc_html__('Five', 'depot')  => '5',
							esc_html__('Six', 'depot')   => '6'
						),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'slider_loop',
						'heading'     => esc_html__('Enable Slider Loop', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'slider_autoplay',
						'heading'     => esc_html__('Enable Slider Autoplay', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'slider_speed',
						'heading'     => esc_html__('Slider Speed', 'depot'),
						'description' => esc_html__('Default value is 5000 (ms)', 'depot'),
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'slider_speed_animation',
						'heading'     => esc_html__('Slider Slide Animation', 'depot'),
						'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'depot'),
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'		  => 'dropdown',
						'param_name'  => 'slider_navigation',
						'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_navigation_skin',
						'heading'    => esc_html__('Slider Navigation Skin', 'depot'),
						'value'      => array(
							esc_html__('Default', 'depot') => 'default',
							esc_html__('Light', 'depot')   => 'light'
						),
						'dependency'  => array('element' => 'slider_navigation', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'		  => 'dropdown',
						'param_name'  => 'slider_pagination',
						'heading'	  => esc_html__('Enable Slider Pagination', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'save_always' => true,
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_pagination_skin',
						'heading'    => esc_html__('Slider Pagination Skin', 'depot'),
						'value'      => array(
							esc_html__('Default', 'depot') => 'default',
							esc_html__('Light', 'depot')   => 'light'
						),
						'dependency'  => array('element' => 'slider_pagination', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'slider_pagination_pos',
						'heading'    => esc_html__('Slider Pagination Position', 'depot'),
						'value'      => array(
							esc_html__('Below Carousel', 'depot')  => 'bellow-slider',
							esc_html__('Inside Carousel', 'depot') => 'inside-slider'
						),
						'dependency'  => array('element' => 'slider_pagination', 'value' => array('yes')),
						'group'       => esc_html__('Slider Settings', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_title',
						'heading'     => esc_html__('Display Title', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__('Title Tag', 'depot'),
						'value'       => array_flip(depot_mikado_get_title_tag(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_transform',
						'heading'     => esc_html__('Title Text Transform', 'depot'),
						'value'       => array_flip(depot_mikado_get_text_transform_array(true)),
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_category',
						'heading'     => esc_html__('Display Category', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_excerpt',
						'heading'     => esc_html__('Display Excerpt', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__('Excerpt Length', 'depot'),
						'description' => esc_html__('Number of characters', 'depot'),
						'dependency'  => array('element' => 'display_excerpt', 'value' => array('yes')),
						'group'	      => esc_html__('Product Info Style', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_rating',
						'heading'     => esc_html__('Display Rating', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'depot')
					)
				)
		) );

	}
	public function render($atts, $content = null) {
		$default_atts = array(
            'number_of_posts' 		  => '8',
            'space_between_items'	  => '',
            'order_by' 				  => 'date',
            'order' 				  => 'ASC',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
			'number_of_visible_items' => '1',
			'slider_loop'		      => 'yes',
			'slider_autoplay'		  => 'yes',
			'slider_speed'		      => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'	      => 'yes',
			'slider_navigation_skin'  => 'default',
			'slider_pagination'	      => 'yes',
			'slider_pagination_skin'  => 'default',
			'slider_pagination_pos'   => 'bellow-slider',
            'display_title' 		  => 'yes',
            'title_tag'				  => 'h4',
            'title_transform'		  => '',
			'display_category'        => 'no',
			'display_excerpt'		  => 'no',
			'excerpt_length' 		  => '20',
			'display_rating' 		  => 'no',
			'display_price' 		  => 'yes',
            'display_button' 		  => 'yes',
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['holder_data'] = $this->getProductListCarouselDataAttributes($params);
		$params['class_name'] = 'plc';
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = depot_mikado_get_woo_shortcode_module_template_part('templates/product-list-carousel', 'product-list-carousel', '', $params);
		
		return $html;
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';
		
		$columnsSpace = !empty($params['space_between_items']) ? 'mkd-'.$params['space_between_items'].'-space' : 'mkd-normal-space';
		
		$carouselClasses = $this->getCarouselClasses($params);
		
		$holderClasses .= ' '. $columnsSpace . ' ' . $carouselClasses;
		
		return $holderClasses;
	}
	
	/**
	 * Generates carousel classes for product list holder
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getCarouselClasses($params){
		$carouselClasses = '';
		
		if(!empty($params['slider_navigation_skin'])) {
			$carouselClasses .= ' mkd-plc-nav-'.$params['slider_navigation_skin'].'-skin';
		}
		
		if(!empty($params['slider_pagination_pos'])) {
			$carouselClasses .= ' mkd-plc-pag-'.$params['slider_pagination_pos'];
		}
		
		if(!empty($params['slider_pagination_skin'])) {
			$carouselClasses .= ' mkd-plc-pag-'.$params['slider_pagination_skin'].'-skin';
		}
		
		return $carouselClasses;
	}
	
    /**
     * Return all data that product list carousel needs
     *
     * @param $params
     * @return array
     */
    private function getProductListCarouselDataAttributes($params) {
	    $slider_data = array();
	
	    $slider_data['data-number-of-items']        = !empty($params['number_of_visible_items']) ? $params['number_of_visible_items'] : '1';
	    $slider_data['data-enable-loop']            = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
	    $slider_data['data-enable-autoplay']        = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
	    $slider_data['data-slider-speed']           = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
	    $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
	    $slider_data['data-enable-navigation']      = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $slider_data['data-enable-pagination']      = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
	
	    return $slider_data;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		$queryArray = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['order_by'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
	}
	
	/**
	 * Return Style for Title
	 *
	 * @param $params
	 * @return string
	 */
	public function getTitleStyles($params) {
		$styles = array();
		
		if (!empty($params['title_transform'])) {
			$styles[] = 'text-transform: '.$params['title_transform'];
		}
		
		return implode(';', $styles);
	}
}