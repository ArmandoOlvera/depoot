<?php
namespace MikadoCore\CPT\Shortcodes\ProductList;

use MikadoCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkd_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Product List', 'depot'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'depot'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type'       => 'dropdown',
						'param_name' => 'type',
						'heading'    => esc_html__('Type', 'depot'),
						'value'      => array(
							esc_html__('Standard', 'depot') => 'standard',
							esc_html__('Masonry', 'depot')  => 'masonry'
						),
						'admin_label' => true
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_position',
						'heading'    => esc_html__('Product Info Position', 'depot'),
						'value'      => array(
							esc_html__('Info On Image Hover', 'depot') => 'info-on-image',
							esc_html__('Info Below Image', 'depot')    => 'info-below-image'
						),
						'admin_label' => true,
						'dependency'  => array('element' => 'type', 'value' => array('standard')),
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__('Number of Products', 'depot')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'number_of_columns',
                        'heading'    => esc_html__('Number of Columns', 'depot'),
                        'value'      => array(
							esc_html__('One', 'depot')   => '1',
							esc_html__('Two', 'depot')   => '2',
							esc_html__('Three', 'depot') => '3',
							esc_html__('Four', 'depot')  => '4',
							esc_html__('Five', 'depot')  => '5',
							esc_html__('Six', 'depot')   => '6'
                        ),
                        'save_always' => true
                    ),
                    array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_items',
						'heading'    => esc_html__('Space Between Items', 'depot'),
						'value'      => array(
							esc_html__('Large', 'depot')    => 'large',
							esc_html__('Normal', 'depot')   => 'normal',
							esc_html__('Small', 'depot')    => 'small',
							esc_html__('Tiny', 'depot')     => 'tiny',
							esc_html__('No Space', 'depot') => 'no'
						),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_ordering_filter',
						'heading'     => esc_html__('Show Ordering Filter', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, false)),
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'price_range',
						'heading'    => esc_html__('Price range for pricing filter', 'depot'),
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('yes')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__('Order By', 'depot'),
						'value'       => array_flip(depot_mikado_get_query_order_by_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__('Order', 'depot'),
						'value'       => array_flip(depot_mikado_get_query_order_array()),
						'save_always' => true,
						'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'show_category_filter',
						'heading'     => esc_html__('Show Category Filter', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, false)),
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'category_values',
						'heading'     => esc_html__('Enter Category Values', 'depot'),
						'description' => esc_html__('Separate values (category slugs) with a comma', 'depot'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
					),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'show_all_item_in_filter',
					'heading'     => esc_html__('Show "All" Item in Filter', 'depot'),
					'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
					'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
				),
					array(
	                    'type'       => 'dropdown',
	                    'param_name' => 'taxonomy_to_display',
	                    'heading'    => esc_html__('Choose Sorting Taxonomy', 'depot'),
	                    'value' => array(
							esc_html__('Category', 'depot') => 'category',
							esc_html__('Tag', 'depot')      => 'tag',
							esc_html__('Id', 'depot')       => 'id'
	                    ),
	                    'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'depot'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
	                    'type'        => 'textfield',
	                    'param_name'  => 'taxonomy_values',
	                    'heading'     => esc_html__('Enter Taxonomy Values', 'depot'),
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'depot'),
						'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
	                ),
	                array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__('Image Proportions', 'depot'),
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
						'type'        => 'dropdown',
						'param_name'  => 'display_title',
						'heading'     => esc_html__('Display Title', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'product_info_skin',
						'heading'    => esc_html__('Product Info Skin', 'depot'),
						'value'      => array(
							esc_html__('Default', 'depot')  => 'default',
							esc_html__('Light', 'depot') => 'light',
							esc_html__('Dark', 'depot') => 'dark'
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
						'group'	      => esc_html__('Product Info Style', 'depot')
					),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'product_info_hover_skin',
                        'heading'    => esc_html__('Product Info Hover Background Skin', 'depot'),
                        'value'      => array(
                            esc_html__('Light', 'depot') => 'light',
                            esc_html__('Dark', 'depot') => 'dark'
                        ),
                        'dependency'  => array('element' => 'info_position', 'value' => array('info-on-image')),
                        'group'	      => esc_html__('Product Info Style', 'depot')
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
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'display_price',
						'heading'     => esc_html__('Display Price', 'depot'),
						'value'       => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						'group'	      => esc_html__('Product Info', 'depot')
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'info_bottom_text_align',
						'heading'    => esc_html__('Product Info Text Alignment', 'depot'),
						'value'      => array(
							esc_html__('Default', 'depot')  => '',
							esc_html__('Left', 'depot') => 'left',
							esc_html__('Center', 'depot') => 'center',
							esc_html__('Right', 'depot') => 'right'
						),
						'dependency'  => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	      => esc_html__('Product Info Style', 'depot')
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'info_bottom_margin',
						'heading'    => esc_html__('Product Info Bottom Margin (px)', 'depot'),
						'dependency' => array('element' => 'info_position', 'value' => array('info-below-image')),
						'group'	     => esc_html__('Product Info Style', 'depot')
					)
				)
		) );
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'					  => 'standard',
			'info_position'			  => 'info-on-image',
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'space_between_items'	  => '',
            'show_ordering_filter'	  => 'no',
            'price_range'	  		  => '',
            'orderby' 				  => 'date',
            'order' 				  => 'ASC',
            'show_category_filter' 	  => 'no',
            'category_values' 	  	  => '',
			'show_all_item_in_filter' => 'yes',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
            'display_title' 		  => 'yes',
			'product_info_skin'       => '',
            'product_info_hover_skin' => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => '',
			'display_category'        => 'no',
            'display_excerpt' 		  => 'no',
            'excerpt_length' 		  => '20',
			'display_rating' 		  => 'yes',
			'display_price' 		  => 'yes',
			'info_bottom_text_align'  => '',
            'info_bottom_margin' 	  => ''
        );

		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];
		if($params['type'] == 'masonry'){
			$params['info_position'] = 'info-on-image';
		}
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['class_name'] = 'pli';
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['text_wrapper_styles'] = $this->getTextWrapperStyles($params);
		$params['categories_filter_list'] = $this->getProductCategoriesList($params);
		$params['ordering_filter_list'] = $this->getProductOrderingList($params);
		$params['pricing_filter_list'] = $this->getProductPricingList($params);
		$params['holder_data'] = $this->getHolderData($params);

		$params['category'] = ''; //used for ajax calling in category filter
		$params['meta_key'] = ''; //used for ajax calling in category filter
		$params['min_price'] = ''; //used for ajax calling in ordering filter
		$params['max_price'] = ''; //used for ajax calling in ordering filter

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = depot_mikado_get_woo_shortcode_module_template_part('templates/product-list-'.$params['type'], 'product-list', '', $params);
		
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

		$productListType = !empty($params['type']) ? 'mkd-'.$params['type'].'-layout' : 'mkd-standard-layout';

        $columnsSpace = !empty($params['space_between_items']) ? 'mkd-'.$params['space_between_items'].'-space' : 'mkd-normal-space';

        $columnNumber = $this->getColumnNumberClass($params);

		$infoPosition = !empty($params['info_position']) ? 'mkd-'.$params['info_position'] : 'mkd-info-on-image';
		
		$productInfoClasses = !empty($params['product_info_skin']) ? 'mkd-product-info-'.$params['product_info_skin'] : '';

        $productInfoHoverClasses = !empty($params['product_info_hover_skin']) ? 'mkd-product-info-hover-'.$params['product_info_hover_skin'] : '';

        $holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $infoPosition . ' ' . $productInfoClasses . ' ' . $productInfoHoverClasses;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){

        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'mkd-one-column';
                break;
            case 2:
                $columnsNumber = 'mkd-two-columns';
                break;
            case 3:
                $columnsNumber = 'mkd-three-columns';
                break;
            case 4:
                $columnsNumber = 'mkd-four-columns';
                break;
            case 5:
                $columnsNumber = 'mkd-five-columns';
                break;
            case 6:
                $columnsNumber = 'mkd-six-columns';
                break;        
            default:
                $columnsNumber = 'mkd-four-columns';
                break;
        }

        return $columnsNumber;
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
			'orderby' => $params['orderby'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' && $params['show_category_filter'] == 'no') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' && $params['show_category_filter'] == 'no') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' && $params['show_category_filter'] == 'no') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }


		//used for ajax calling in ordering filter
        if($params['show_ordering_filter'] == 'yes') {
			unset($queryArray['orderby'], $queryArray['order']);

			if ($params['meta_key'] !== ''){
				$queryArray['orderby'] = $params['orderby'];
				$queryArray['order'] = $params['order'];
				$queryArray['meta_key'] = $params['meta_key'];
			}

			if($params['min_price'] !== '' || $params['max_price'] !== ''){
				$queryArray['meta_query'] = array(
					array(
						'key' => '_price',
						'value' => array($params['min_price'], $params['max_price']),
						'compare' => 'BETWEEN',
						'type' => 'NUMERIC'
					),
				);
			}
		}

        //used for ajax calling in category filter
        if($params['show_category_filter'] == 'yes'){
        	if($params['category_values'] !== '' && $params['category'] == '') {
				$queryArray['product_cat'] = $params['category_values'];
			}else {
				$queryArray['product_cat'] = $params['category'];
			}
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

    /**
     * Return Style for Text Wrapper Holder
     *
     * @param $params
     * @return string
     */
	public function getTextWrapperStyles($params) {
	    $styles = array();
	
	    if (!empty($params['info_bottom_text_align'])) {
		    $styles[] = 'text-align: '.$params['info_bottom_text_align'];
	    }
		
        if ($params['info_bottom_margin'] !== '') {
	        $styles[] = 'margin-bottom: '.depot_mikado_filter_px($params['info_bottom_margin']).'px';
        }

		return implode(';', $styles);
    }

	/**
	 * Return product categories
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductCategoriesList($params) {
		$category_html = '';

		if($params['show_category_filter'] == 'yes') {
			$taxonomy = 'product_cat';
			$orderby = 'name';
			$show_count = 0;      // 1 for yes, 0 for no
			$pad_counts = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title = '';
			$empty = 0;
			$parent = 0;

			$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty,
				'parent' => $parent
			);

			$all_categories_string = '';
			if($params['category_values'] == ''){

				$all_categories = get_categories($args);

			}else{
				$all_categories = array();
				$categories = explode(',',$params['category_values']);
				foreach ($categories as $cat){
					$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
					$all_categories_string .= $cat.',';
				}
			}

			if($params['show_all_item_in_filter'] == 'yes') {
				$category_html .= '<li><a class="mkd-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All', 'depot') . '</a></li>';
			}
			foreach ($all_categories as $cat) {
				if($cat != ''){
					$category_html .= '<li><a class="mkd-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

					$termchildren = get_term_children( $cat->term_id, 'product_cat' );

					if(!empty($termchildren)){
						foreach ( $termchildren as $child ) {
							$cat = get_term_by( 'id', $child, 'product_cat' );
							$category_html .= '<li><a class="mkd-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
						}
					}
				}
			}
		}

		return $category_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductOrderingList($params) {
		$sorting_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$orderby_options = apply_filters('woocommerce_catalog_orderby', array(
				'menu_order' => esc_html__('Default', 'depot'),
				'popularity' => esc_html__('Popularity', 'depot'),
				'rating' => esc_html__('Average rating', 'depot'),
				'newness' => esc_html__('Newness', 'depot'),
				'price' => esc_html__('Price: Low to High', 'depot'),
				'price-desc' => esc_html__('Price: High to Low', 'depot')
			));

			if (get_option('woocommerce_enable_review_rating') === 'no') {
				unset($orderby_options['rating']);
			}

			foreach ($orderby_options as $key => $value) {
				$sorting_list_html .= '<li><a class="mkd-no-smooth-transitions" data-ordering="'. $key .'" href="#">'. $value .'</a></li>';
			}
		}

		return $sorting_list_html;
	}

	/**
	 * Return products sort by
	 *
	 * * @param $params
	 * @return string
	 */
	public function getProductPricingList($params) {
		$pricing_list_html = '';

		if($params['show_ordering_filter'] == 'yes') {
			$range = $params['price_range'] !== '' ? $params['price_range'] : 10;
			$value = 0;

			$pricing_list_html .= '<li><a data-minPrice="" data-maxPrice="" href="#">' . esc_html__('All', 'depot') . '</a></li>';
			for ($i = 1; $i <= 5; $i++){
				if($i !== 5){
					$pricing_list_html .= '<li><a data-minPrice="'. $value .'" data-maxPrice="'. ($value+$range) .'" href="#">'. get_woocommerce_currency_symbol().$value .'-'.get_woocommerce_currency_symbol().($value+$range). '</a></li>';

				}else{
					$pricing_list_html .= '<li><a data-minPrice="'. ($value) .'" data-maxPrice="'.(100000000000).'" href="#">'. ($value).get_woocommerce_currency_symbol(). '+</a></li>';
				}

				$value += $range;
			}

		}

		return $pricing_list_html;
	}

	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderData($params){
		$dataString = '';
		unset($params['categories_filter_list'], $params['ordering_filter_list'], $params['pricing_filter_list'] );
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-'.$new_key.'="'.esc_attr($value).'"';
			}
		}

		return $dataString;
	}
}