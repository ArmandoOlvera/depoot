<?php

if(!function_exists('depot_mikado_get_title')) {
    /**
     *
     * @param boolean module_title - use module title
     * @param string module - module that has specifict title layout
     * @param string type - type of title layout inside specific module
     *
     * Loads title area HTML
     */
    function depot_mikado_get_title($module_title = false, $module = '', $layout = '') {
        $id = depot_mikado_get_page_id();

		if((depot_mikado_is_product_category() || depot_mikado_is_product_tag()) && depot_mikado_get_woo_shop_page_id()) {
			$id = depot_mikado_get_woo_shop_page_id();
		}

        extract(depot_mikado_title_area_height());
        extract(depot_mikado_title_area_background());

        //check if title area is visible on page first, then in the options, modules have priority
        $show_title_area = depot_mikado_get_meta_field_intersect('show_title_area', $id) == 'yes' ? true : false;
        if(!empty($module)) {
            $show_title_area_meta = depot_mikado_get_meta_field_intersect('show_title_area_'.$module, $id);
            if(!empty($show_title_area_meta)) {
                $show_title_area = $show_title_area_meta == 'yes' ? true : false;
            }
        }

        if(depot_mikado_is_woocommerce_installed() && is_singular('product')) {
            $woo_title_meta = get_post_meta(get_the_ID(), 'mkd_show_title_area_woo_meta', true);
            if(empty($woo_title_meta)) {
                $woo_title_main = depot_mikado_options()->getOptionValue('show_title_area_woo');
                if(!empty($woo_title_main)) {
                    $show_title_area = $woo_title_main == 'yes' ? true : false;
                }
            }
            else {
                $show_title_area = $woo_title_meta == 'yes' ? true : false;
            }
        }

        if($show_title_area) {

            //check for title type on page first, then in options
            $type = depot_mikado_get_meta_field_intersect('title_area_type', $id);

            //check if breadcrumbs are enabled on page first, then in options
            $enable_breadcrumbs_meta = depot_mikado_get_meta_field_intersect('title_area_enable_breadcrumbs', $id);
            $enable_breadcrumbs = $enable_breadcrumbs_meta == 'yes' ? true : false;

            //check title tag value
            $title_tag_meta = depot_mikado_get_meta_field_intersect('title_area_title_tag', $id);
            $title_tag = !empty($title_tag_meta) ? $title_tag_meta : 'h1';

            //check if title color is set on page
            $title_color_meta = get_post_meta($id, 'mkd_title_text_color_meta', true);
            $title_color = !empty($title_color_meta) ? 'color:' . esc_attr($title_color_meta) . ';' : '';

            //check if subtitle color is set on page
            $subtitle_color_meta = get_post_meta($id, 'mkd_subtitle_color_meta', true);
            $subtitle_color = !empty($subtitle_color_meta) ? 'color:' . esc_attr($subtitle_color_meta) . ';' : '';

            $parameters = array(
                'module' => $module,
                'layout' => $layout,
                'show_title_area' => $show_title_area,
                'type' => $type,
                'enable_breadcrumbs' => $enable_breadcrumbs,
                'title_height' => $title_height,
                'title_holder_height' => $title_holder_height,
                'title_subtitle_holder_padding' => $title_subtitle_holder_padding,
                'title_background_color' => $title_background_color,
                'title_background_image' => $title_background_image,
                'title_background_image_width' => $title_background_image_width,
                'title_background_image_src' => $title_background_image_src,
                'has_subtitle' => get_post_meta($id, "mkd_title_area_subtitle_meta", true) != "" ? true : false,
                'title_tag' => $title_tag,
                'title_color' => $title_color,
                'subtitle_color' => $subtitle_color
            );
            $parameters = apply_filters('depot_mikado_title_area_height_params', $parameters);

            if ($module_title && $module != '') {
                depot_mikado_get_module_template_part('templates/titles/title', $module, $layout, $parameters);
            } else {
                depot_mikado_get_module_template_part('templates/title', 'title', $layout, $parameters);
            }
        }
    }
}

if(!function_exists('depot_mikado_get_title_text')) {
    /**
     * Function that returns current page title text. Defines depot_mikado_title_text filter
     * @return string current page title text
     *
     * @see is_tag()
     * @see is_date()
     * @see is_author()
     * @see is_category()
     * @see is_home()
     * @see is_search()
     * @see is_404()
     * @see get_queried_object_id()
     * @see depot_mikado_is_woocommerce_installed()
     */
    function depot_mikado_get_title_text() {

        $id = depot_mikado_get_page_id();
        $title 	= '';

        //is current page tag archive?
        if (is_tag()) {
            //get title of current tag
            $title = single_term_title("", false).esc_html__(' Tag', 'depot');
        }

        //is current page date archive?
        elseif (is_date()) {
            //get current date archive format
            $title = get_the_time('F Y');
        }

        //is current page author archive?
        elseif (is_author()) {
            //get current author name
            $title = esc_html__('Author:', 'depot') . " " . get_the_author();
        }

        //us current page category archive
        elseif (is_category()) {
            //get current page category title
            $title = single_cat_title('', false);
        }

        //is current page blog post page and front page? Latest posts option is set in Settings -> Reading
        elseif (is_home() && is_front_page()) {
            //get site name from options
            $title = get_option('blogname');
        }

        //is current page search page?
        elseif (is_search()) {
            //get title for search page
            $title = esc_html__('Search results for: ', 'depot') . get_search_query();
        }

        //is single post page
        elseif (is_singular('post')) {
	        //get title for single post page
	        $title = depot_mikado_options()->getOptionValue('blog_single_title_in_title_area') == 'yes' ? get_the_title($id) : esc_html__('Blog', 'depot');
        }

        //is current page 404?
        elseif (is_404()) {
            //is 404 title text set in theme options?
	        $title_404 = depot_mikado_options()->getOptionValue('404_title');
	        $title = !empty($title_404) ? $title_404 : esc_html__('404 - Page not found', 'depot');
        }

        //is WooCommerce installed and is shop or single product page?
        elseif(depot_mikado_is_woocommerce_installed() && (depot_mikado_is_woocommerce_shop() || is_singular('product'))) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            //get shop page and get it's title if set
            $shop = get_post($shop_id);
            if(isset($shop->post_title) && $shop->post_title !== '') {
                $title = $shop->post_title;
            }
        }

        //is WooCommerce installed and is current page product archive page?
        elseif(depot_mikado_is_woocommerce_installed() && (is_product_category() || is_product_tag())) {
            global $wp_query;

            //get current taxonomy and it's name and assign to title
            $tax 			= $wp_query->get_queried_object();
            $category_title = $tax->name;
            $title 			= $category_title;
        }

        //is current page some archive page?
        elseif (is_archive()) {
            $title = esc_html__('Archive','depot');
        }

        //current page is regular page
        else {
            $title = get_the_title($id);
        }

        $title = apply_filters('depot_mikado_title_text', $title);

        return $title;
    }
}

if(!function_exists('depot_mikado_title_text')) {
    /**
     * Function that echoes title text.
     *
     * @see depot_mikado_get_title_text()
     */
    function depot_mikado_title_text() {
        echo depot_mikado_get_title_text();
    }
}

if(!function_exists('depot_mikado_subtitle_text')) {
    /**
     * Function that echoes subtitle text.
     */
    function depot_mikado_subtitle_text() {
        $id = depot_mikado_get_page_id();
        $subtitle 	= '';

        if(($meta_temp = get_post_meta($id, "mkd_title_area_subtitle_meta", true)) != ""){
            $subtitle = wp_kses_post($meta_temp);
        }

        echo esc_html($subtitle);
    }
}

if(!function_exists('depot_mikado_custom_breadcrumbs')) {
    /**
     * Function that renders breadcrumbs
     */
    function depot_mikado_custom_breadcrumbs() {
        global $post;

        $output = "";
        $homeLink = esc_url(home_url('/'));
        $pageid = depot_mikado_get_page_id();
        $bread_style = "";

        if(($meta_temp = get_post_meta($pageid, "mkd_title_breadcrumb_color_meta", true)) != ""){
            $bread_style="color:". $meta_temp;
        }

        $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="mkd-delimiter" '.depot_mikado_get_inline_style($bread_style).'>&nbsp; / &nbsp;</span>'; // delimiter between crumbs
        $home = esc_html__('Home', 'depot'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="mkd-current" '.depot_mikado_get_inline_style($bread_style).'>'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        if (is_home() && !is_front_page()) {
            $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner" itemprop="breadcrumb"><a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' <a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">'. get_the_title($pageid) .'</a></div></div>';

        } elseif(is_home()) {
            $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner" itemprop="breadcrumb">'.$before.$home.$after.'</div></div>';
        }

        elseif(is_front_page()) {
            if ($showOnHome == 1) $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner" itemprop="breadcrumb"><a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a></div></div>';
        }

        else {

            $output .= '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner" itemprop="breadcrumb"><a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a>' . $delimiter;

            if ( is_category() || (depot_mikado_is_woocommerce_installed() && depot_mikado_is_product_category())) {
                $thisCat = get_category(get_query_var('cat'), false);
                if (isset($thisCat->parent) && $thisCat->parent != 0) $output .= get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter);
                $output .= $before . single_cat_title('', false) . $after;

            } elseif (is_tax('portfolio-category')) {
                $portfolio_category = wp_get_post_terms(get_the_ID(), 'portfolio-category');
                $portfolio_category = $portfolio_category[0];
                
                if(!empty($portfolio_category)) {
                    if (isset($portfolio_category->parent) && $portfolio_category->parent != 0) $output .= get_category_parents($portfolio_category->parent, TRUE, ' ' . $delimiter);
                    $output .= $before . $portfolio_category->name . $after;
                }

            } elseif (is_tax('portfolio-tag')) {
                $portfolio_tag = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
                $portfolio_tag = $portfolio_tag[0];
    
                if(!empty($portfolio_tag)) {
                    $output .= $before . $portfolio_tag->name . $after;
                }

            } elseif ( is_search() ) {
                $output .= $before . esc_html__('Search results for ', 'depot') . '"' . get_search_query() . '"' . $after;

            } elseif ( is_day() ) {
                $output .= '<a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                $output .= '<a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
                $output .= $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                $output .= '<a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                $output .= $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                $output .= $before . get_the_time('Y') . $after;

            } elseif ( depot_mikado_is_woocommerce_installed() && is_singular('product') ){
                $product = wc_get_product( get_the_ID() );
                if(get_option('woocommerce_shop_page_id')){
                    $output .= '<a itemprop="url" '. depot_mikado_get_inline_style($bread_style) .' href="' . get_permalink(get_option('woocommerce_shop_page_id')) . '">' . get_the_title(get_option('woocommerce_shop_page_id')) . '</a>' . $delimiter;
                }


				if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
					if(!empty($product) && wc_get_product_category_list( $product->get_id())) {
						$output .= wc_get_product_category_list( $product->get_id(), ', ' ) . $delimiter;
					}
				} else {
					if(!empty($product) && $product->get_categories()) {
						$output .= $product->get_categories(', ') . $delimiter;
					}
				}

                if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

            } elseif ( is_singular('portfolio-item') ) {
                $portfolio_categories = wp_get_post_terms($pageid, 'portfolio-category');

                if (!empty($portfolio_categories) && count($portfolio_categories)) {
                    foreach($portfolio_categories as $cat) {
                        $output .= '<a itemprop="url" href="'. get_term_link($cat->term_id) .'">'.$cat->name.'</a>' . $delimiter;
                    }
                }

                if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {

                    if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter);
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    $output .= $cats;
                    if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
                }

            } elseif ( is_attachment() ) {
                if($post->post_parent) {
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    if($cat) {
                        $cat = $cat[0];
                        $output .= get_category_parents($cat, TRUE, ' ' . $delimiter);
                    }
                    $output .= '<a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';

                    if ($showCurrent == 1) $output .= $delimiter . $before . get_the_title() . $after;

                } else {
                    if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
                }

            } elseif ( is_page() ) {
                if($post->post_parent) {
                    $parent_ids = array();
                    $parent_ids[] = $post->post_parent;

                    foreach($parent_ids as $parent_id) {
                        $output .= '<a itemprop="url" '.depot_mikado_get_inline_style($bread_style).' href="' . get_the_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a>' . $delimiter;
                    }
                }

                if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

            } elseif ( is_tag() ) {
                $output .= $before . esc_html__('Posts tagged ','depot') .'"' . single_tag_title('', false) . '"' . $after;

            } elseif ( is_author() ) {
                $author_id = get_query_var('author');
                $output .= $before . esc_html__('Articles posted by ','depot') . get_the_author_meta('display_name', $author_id) . $after;

            } elseif ( is_404() ) {
                $output .= $before . esc_html__('Error 404','depot') . $after;

            } elseif(depot_mikado_is_woocommerce_installed() && depot_mikado_is_woocommerce_shop()){
                $shop_id = get_option('woocommerce_shop_page_id');
                $output .= $before .  get_the_title($shop_id) . $after;
            }

            if ( get_query_var('paged') ) {

                $output .= $before . " (" . esc_html__('Page', 'depot') . ' ' . get_query_var('paged') . ")" . $after;
            }

            $output .= '</div></div>';
        }

        echo wp_kses($output, array(
            'div' => array(
                'id' => true,
                'class' => true,
                'style' => true
            ),
            'span' => array(
                'class' => true,
                'id' => true,
                'style' => true
            ),
            'a' => array(
                'class' => true,
                'id' => true,
                'href' => true,
                'style' => true
            )
        ));
    }
}

if(!function_exists('depot_mikado_get_title_area_height_default_value')) {
    /**
     * Function that returns title height
     **/
    function depot_mikado_get_title_area_height_default_value() {
		$id = depot_mikado_get_page_id();

		if((depot_mikado_is_product_category() || depot_mikado_is_product_tag()) && depot_mikado_get_woo_shop_page_id()) {
			$id = depot_mikado_get_woo_shop_page_id();
		}

        $title_height = 325;

        if (depot_mikado_get_meta_field_intersect('title_area_type', $id) == 'breadcrumb') {
			$title_height = 100;
		}


        return apply_filters('depot_mikado_title_area_height_default_value', $title_height);
    }
}

if(!function_exists('depot_mikado_get_title_area_height')) {
    /**
     * Function that returns title height
     **/
    function depot_mikado_get_title_area_height() {
		$id = depot_mikado_get_page_id();

		if((depot_mikado_is_product_category() || depot_mikado_is_product_tag()) && depot_mikado_get_woo_shop_page_id()) {
			$id = depot_mikado_get_woo_shop_page_id();
		}

		$title_height_meta = depot_mikado_get_meta_field_intersect('title_area_height', $id);
	
	    $title_height = !empty($title_height_meta) ? $title_height_meta : depot_mikado_get_title_area_height_default_value();

        return apply_filters('depot_mikado_title_area_height', $title_height);
    }
}

if(!function_exists('depot_mikado_get_title_content_padding')) {
    /**
     * Function that returns title content pading
     **/
    function depot_mikado_get_title_content_padding() {
        return apply_filters('depot_mikado_title_content_padding', 0);
    }
}

if(!function_exists('depot_mikado_title_area_height')) {
    /**
     * Function that returns title height and padding to be applied in template
     **/

    function depot_mikado_title_area_height() {
		$id = depot_mikado_get_page_id();
        $title_height_and_padding = array();
        $title_height          = depot_mikado_get_title_area_height();
        $header_height_padding = depot_mikado_get_title_content_padding();
        $title_holder_height = '';
        $title_subtitle_holder_padding = '';

		if((depot_mikado_is_product_category() || depot_mikado_is_product_tag()) && depot_mikado_get_woo_shop_page_id()) {
			$id = depot_mikado_get_woo_shop_page_id();
		}

        //is responsive image is set for current page?
	    $is_img_responsive = depot_mikado_get_meta_field_intersect('title_area_background_image_responsive', $id);
	
	    //check title area vertical alignment
	    $title_vertical_alignment = depot_mikado_get_meta_field_intersect('title_area_vertical_alignment', $id);

        //we need to define title height only when aligning text bellog header and when image isn't responsive
        if($is_img_responsive !== 'yes' && $title_vertical_alignment == 'header_bottom') {
            $title_holder_height = 'height:'.$title_height.'px;';
        }
        
        //we need to add padding-top property only if we are aligning title text from bellow header
        if($title_vertical_alignment == 'header_bottom' && !empty($header_height_padding)) {
            if($is_img_responsive == 'yes') {
                $title_subtitle_holder_padding = 'padding-top: '.$header_height_padding.'px;';
            } else {
                $title_holder_height .= 'padding-top: '.$header_height_padding.'px;';
            }
        }

        //increase title height for the height of header transparent parts
        $title_height_and_padding['title_height'] = 'height:'.($title_height + $header_height_padding).'px;';
        $title_height_and_padding['title_holder_height'] = $title_holder_height;
        $title_height_and_padding['title_subtitle_holder_padding'] = $title_subtitle_holder_padding;
	    
        return $title_height_and_padding;
    }
}

if(!function_exists('depot_mikado_title_area_background')) {
    /**
     * Function that returns title background style be applied in template
     * @param  string module - string with name of module that is calling title
     *
     * @return array
     **/
    function depot_mikado_title_area_background() {
        $id = depot_mikado_get_page_id();
        $show_title_img = true;
        $title_area_background = array();
        $title_background_color = '';
        $title_background_image = '';
        $title_background_image_width = '';
        $title_background_image_src = '';

		if((depot_mikado_is_product_category() || depot_mikado_is_product_tag()) && depot_mikado_get_woo_shop_page_id()) {
			$id = depot_mikado_get_woo_shop_page_id();
		}

        //is title image hidden for current page?
        if(get_post_meta($id, "mkd_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }
	
	    //is responsive image is set for current page?
	    $is_img_responsive = depot_mikado_get_meta_field_intersect('title_area_background_image_responsive', $id);

        //check if background color is set on page or in options
	    $background_color = depot_mikado_get_meta_field_intersect('title_area_background_color', $id);

        //check if background image is set on page or in options
        $background_image = depot_mikado_get_meta_field_intersect('title_area_background_image', $id);

        //check for background image width
        $background_image_width = "";
        if(!empty($background_image)) {
            $background_image_width_dimensions_array = depot_mikado_get_image_dimensions($background_image);
            if (count($background_image_width_dimensions_array)) {
                $background_image_width = $background_image_width_dimensions_array["width"];
            }
        }

        //generate styles
        if(!empty($background_color)){$title_background_color = 'background-color:'.$background_color.';';}
	    
        if($is_img_responsive == 'no' && $show_title_img){ //no need for those styles if image is set to be responsive
            if(!empty($background_image)){$title_background_image = 'background-image:url('.esc_url($background_image).');';}
            if(!empty($background_image_width)){$title_background_image_width = 'data-background-width="'.esc_attr($background_image_width).'"';}
        }
        
        if($show_title_img && !empty($background_image)) {
            $title_background_image_src = $background_image;
        }

        $title_area_background['title_background_color'] = $title_background_color;
        $title_area_background['title_background_image'] = $title_background_image;
        $title_area_background['title_background_image_width'] = $title_background_image_width;
        $title_area_background['title_background_image_src'] = $title_background_image_src;
	    
        return $title_area_background;
    }
}