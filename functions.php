<?php
include_once get_template_directory() . '/theme-includes.php';

if (!function_exists('depot_mikado_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function depot_mikado_styles() {

        //include theme's core styles
        wp_enqueue_style('depot_mikado_default_style', MIKADO_ROOT . '/style.css');
        wp_enqueue_style('depot_mikado_modules', MIKADO_ASSETS_ROOT . '/css/modules.min.css');

        depot_mikado_icon_collections()->enqueueStyles();

        wp_enqueue_style('wp-mediaelement');

        //is woocommerce installed?
        if (depot_mikado_is_woocommerce_installed()) {
            if (depot_mikado_load_woo_assets()) {

                //include theme's woocommerce styles
                wp_enqueue_style('depot_mikado_woo', MIKADO_ASSETS_ROOT . '/css/woocommerce.min.css');
            }
        }

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if (depot_mikado_load_woo_assets()) {
            $style_dynamic_deps_array = array('depot_mikado_woo', 'depot_mikado_woo_responsive');
        }

        if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css') && depot_mikado_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('depot_mikado_style_dynamic', MIKADO_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        } else if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css') && depot_mikado_is_css_folder_writable() && is_multisite()) {
	        wp_enqueue_style('depot_mikado_style_dynamic', MIKADO_ASSETS_ROOT.'/css/style_dynamic_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if (depot_mikado_is_responsive_on()) {
            wp_enqueue_style('depot_mikado_modules_responsive', MIKADO_ASSETS_ROOT . '/css/modules-responsive.min.css');

            //is woocommerce installed?
            if (depot_mikado_is_woocommerce_installed()) {
                if (depot_mikado_load_woo_assets()) {

                    //include theme's woocommerce responsive styles
                    wp_enqueue_style('depot_mikado_woo_responsive', MIKADO_ASSETS_ROOT . '/css/woocommerce-responsive.min.css');
                }
            }

            //include proper styles
            if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css') && depot_mikado_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('depot_mikado_style_dynamic_responsive', MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css'));
            } else if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css') && depot_mikado_is_css_folder_writable() && is_multisite()) {
	            wp_enqueue_style('depot_mikado_style_dynamic_responsive', MIKADO_ASSETS_ROOT.'/css/style_dynamic_responsive_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css', array(), filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. depot_mikado_get_multisite_blog_id() .'.css'));
            }
        }

        //include Visual Composer styles
        if (depot_mikado_visual_composer_installed()) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_styles');
}

if (!function_exists('depot_mikado_google_fonts_styles')) {
    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function depot_mikado_google_fonts_styles() {
        $font_simple_field_array = depot_mikado_options()->getOptionsByType('fontsimple');
        if (!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = depot_mikado_options()->getOptionsByType('font');
        if (!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);

        $google_font_weight_array = depot_mikado_options()->getOptionValue('google_font_weight');
        if (!empty($google_font_weight_array)) {
            $google_font_weight_array = array_slice(depot_mikado_options()->getOptionValue('google_font_weight'), 1);
        }

        $font_weight_str = '300,400';
        if (!empty($google_font_weight_array) && $google_font_weight_array !== '') {
            $font_weight_str = implode(',', $google_font_weight_array);
        }

        $google_font_subset_array = depot_mikado_options()->getOptionValue('google_font_subset');
        if (!empty($google_font_subset_array)) {
            $google_font_subset_array = array_slice(depot_mikado_options()->getOptionValue('google_font_subset'), 1);
        }

        $font_subset_str = 'latin-ext';
        if (!empty($google_font_subset_array) && $google_font_subset_array !== '') {
            $font_subset_str = implode(',', $google_font_subset_array);
        }

        //define available font options array
        $fonts_array = array();
        foreach ($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = depot_mikado_options()->getOptionValue($font_option);
            if (depot_mikado_is_font_option_valid($font_option_value) && !depot_mikado_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value . ':' . $font_weight_str;
                if (!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        $fonts_array = array_diff($fonts_array, array('-1:' . $font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts
        $default_font_string = 'Catamaran:' . $font_weight_str . '|Montserrat:' . $font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode($font_subset_str),
            );

            $depot_fonts = add_query_arg($fonts_full_list_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('depot_mikado_google_fonts', esc_url_raw($depot_fonts), array(), '1.0.0');

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode($font_subset_str),
            );
            $depot_fonts = add_query_arg($default_fonts_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('depot_mikado_google_fonts', esc_url_raw($depot_fonts), array(), '1.0.0');
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_google_fonts_styles');
}

if (!function_exists('depot_mikado_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function depot_mikado_scripts() {
        global $wp_scripts;

        //init theme core scripts
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('wp-mediaelement');

        // 3rd party JavaScripts that we used in our theme
        wp_enqueue_script('appear', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array('jquery'), false, true);
        wp_enqueue_script('modernizr', MIKADO_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array('jquery'), false, true);
        wp_enqueue_script('hoverIntent', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverIntent.min.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-plugin', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array('jquery'), false, true);
        wp_enqueue_script('countdown', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.countdown.min.js', array('jquery'), false, true);
        wp_enqueue_script('owl-carousel', MIKADO_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array('jquery'), false, true);
        wp_enqueue_script('parallax', MIKADO_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array('jquery'), false, true);
        wp_enqueue_script('easypiechart', MIKADO_ASSETS_ROOT . '/js/modules/plugins/easypiechart.js', array('jquery'), false, true);
        wp_enqueue_script('waypoints', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array('jquery'), false, true);
        wp_enqueue_script('chart', MIKADO_ASSETS_ROOT . '/js/modules/plugins/Chart.min.js', array('jquery'), false, true);
        wp_enqueue_script('counter', MIKADO_ASSETS_ROOT . '/js/modules/plugins/counter.js', array('jquery'), false, true);
        wp_enqueue_script('absoluteCounter', MIKADO_ASSETS_ROOT . '/js/modules/plugins/absoluteCounter.min.js', array('jquery'), false, true);
        wp_enqueue_script('fluidvids', MIKADO_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array('jquery'), false, true);
        wp_enqueue_script('prettyPhoto', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array('jquery'), false, true);
        wp_enqueue_script('nicescroll', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.nicescroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('ScrollToPlugin', MIKADO_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array('jquery'), false, true);
        wp_enqueue_script('waitforimages', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-easing-1.3', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array('jquery'), false, true);
        wp_enqueue_script('multiscroll', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.multiscroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('isotope', MIKADO_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array('jquery'), false, true);
        wp_enqueue_script('packery', MIKADO_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array('jquery'), false, true);

        if (depot_mikado_is_woocommerce_installed()) {
            wp_enqueue_script('select2');
        }

        //include google map api script
        $google_maps_api_key = depot_mikado_options()->getOptionValue('google_maps_api_key');
        if (!empty($google_maps_api_key)) {
            wp_enqueue_script('depot_mikado_google_map_api', '//maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), false, true);
        }

        wp_enqueue_script('depot_mikado_modules', MIKADO_ASSETS_ROOT . '/js/modules.min.js', array('jquery'), false, true);

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        //include Visual Composer script
        if (depot_mikado_visual_composer_installed()) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_scripts');
}

//defined content width variable
if (!isset($content_width)) $content_width = 1060;

if (!function_exists('depot_mikado_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function depot_mikado_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        add_theme_support('title-tag');

        //define thumbnail sizes
        add_image_size('depot_square', 550, 550, true);
        add_image_size('depot_landscape', 1100, 730, true);
        add_image_size('depot_portrait', 730, 1100, true);
        add_image_size('depot_huge', 1100, 1100, true);

        load_theme_textdomain('depot', get_template_directory() . '/languages');
    }

    add_action('after_setup_theme', 'depot_mikado_theme_setup');
}

if (!function_exists('depot_mikado_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function depot_mikado_is_responsive_on() {
        return depot_mikado_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if (!function_exists('depot_mikado_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function depot_mikado_rgba_color($color, $transparency) {
        if ($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = depot_mikado_hex2rgb($color);
            $rgba_color .= 'rgba(' . implode(', ', $rgb_color_array) . ', ' . $transparency . ')';

            return $rgba_color;
        }
    }
}

if (!function_exists('depot_mikado_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function depot_mikado_header_meta() { ?>

        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <?php if (is_singular() && pings_open(get_queried_object())) : ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php endif; ?>

    <?php }

    add_action('depot_mikado_header_meta', 'depot_mikado_header_meta');
}

if (!function_exists('depot_mikado_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to depot_mikado_header_meta action
     */
    function depot_mikado_user_scalable_meta() {
        //is responsiveness option is chosen?
        if (depot_mikado_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=yes">
        <?php }
    }

    add_action('depot_mikado_header_meta', 'depot_mikado_user_scalable_meta');
}

if (!function_exists('depot_mikado_smooth_page_transitions')) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to depot_mikado_after_body_tag action
	 */
	function depot_mikado_smooth_page_transitions() {
	    $id = depot_mikado_get_page_id();
		if(depot_mikado_get_meta_field_intersect('smooth_page_transitions',$id) === 'yes' && depot_mikado_get_meta_field_intersect('page_transition_preloader',$id) === 'yes') { ?>
			<div class="mkd-smooth-transition-loader mkd-mimic-ajax">
				<div class="mkd-st-loader">
					<div class="mkd-st-loader1">
						<?php depot_mikado_loading_spinners(); ?>
					</div>
				</div>
			</div>
		<?php }
	}
	
	add_action('depot_mikado_after_body_tag', 'depot_mikado_smooth_page_transitions', 10);
}

if (!function_exists('depot_mikado_back_to_top_button')) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to depot_mikado_after_header_area action
	 */
	function depot_mikado_back_to_top_button() {
		if (depot_mikado_options()->getOptionValue('show_back_button') == 'yes') { ?>
			<a id='mkd-back-to-top' href='#'>
                <span class="mkd-icon-stack">
                     <?php depot_mikado_icon_collections()->getBackToTopIcon('font_awesome');?>
                </span>
			</a>
		<?php }
	}
	
	add_action('depot_mikado_after_header_area', 'depot_mikado_back_to_top_button', 10);
}

if (!function_exists('depot_mikado_get_page_id')) {
    /**
     * Function that returns current page / post id.
     * Checks if current page is woocommerce page and returns that id if it is.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     * @see depot_mikado_is_woocommerce_installed()
     * @see depot_mikado_is_woocommerce_shop()
     */
    function depot_mikado_get_page_id() {
        if (depot_mikado_is_woocommerce_installed() && depot_mikado_is_woocommerce_shop()) {
            return depot_mikado_get_woo_shop_page_id();
        }

        if (depot_mikado_is_default_wp_template()) {
            return -1;
        }

        return get_queried_object_id();
    }
}

if (!function_exists('depot_mikado_get_multisite_blog_id')) {
    /**
     * Check is multisite and return blog id
     *
     * @return int
     */
    function depot_mikado_get_multisite_blog_id() {
        if(is_multisite()){
            return get_blog_details()->blog_id;
        }
    }
}

if (!function_exists('depot_mikado_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function depot_mikado_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if (!function_exists('depot_mikado_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function depot_mikado_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if ($shortcode) {
            //if content variable isn't past
            if ($content == '') {
                //take content from current post
                $page_id = depot_mikado_get_page_id();
                if (!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if (is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if (stripos($content, '[' . $shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if (!function_exists('depot_mikado_page_custom_style')) {
    /**
     * Function that print custom page style
     */
    function depot_mikado_page_custom_style() {
        $style = '';
        $style = apply_filters('depot_mikado_add_page_custom_style', $style);

        if ($style !== '') {
            wp_add_inline_style('depot_mikado_modules', $style);
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_page_custom_style');
}

if (!function_exists('depot_mikado_container_style')) {
    /**
     * Function that return container style
     */
    function depot_mikado_container_style($style) {
        $id = depot_mikado_get_page_id();
        $class_id = depot_mikado_get_page_id();
        if (depot_mikado_is_woocommerce_installed() && is_product()) {
            $class_id = get_the_ID();
        }

        $class_prefix = depot_mikado_get_unique_page_class($class_id);

        $container_selector = array(
            $class_prefix . ' .mkd-content .mkd-content-inner > .mkd-container',
            $class_prefix . ' .mkd-content .mkd-content-inner > .mkd-full-width',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_meta", true);

        if ($page_backgorund_color) {
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = depot_mikado_dynamic_css($container_selector, $container_class);
        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_container_style');
}

if (!function_exists('depot_mikado_boxed_style')) {

    /**
     * Function that return container style
     */

    function depot_mikado_boxed_style($style) {

        $id = depot_mikado_get_page_id();

        $class_prefix = depot_mikado_get_unique_page_class($id);

        $container_selector = array(
            $class_prefix . '.mkd-boxed .mkd-wrapper'
        );

        $container_style = array();

        if (get_post_meta($id, "mkd_boxed_meta", true) == 'yes') {
            $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_in_box_meta", true);
            $page_backgorund_image = get_post_meta($id, "mkd_boxed_background_image_meta", true);
            $page_backgorund_image_pattern = get_post_meta($id, "mkd_boxed_pattern_background_image_meta", true);
            $page_backgorund_attachment = get_post_meta($id, "mkd_boxed_background_image_attachment_meta", true);

            if ($page_backgorund_color) {
                $container_style['background-color'] = $page_backgorund_color;
            }

            if ($page_backgorund_image_pattern) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image_pattern . ')';
                $container_style['background-position'] = '0px 0px';
                $container_style['background-repeat'] = 'repeat';
            }

            if ($page_backgorund_image) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image . ')';
                $container_style['background-position'] = 'center 0px';
                $container_style['background-repeat'] = 'no-repeat';
            }

            if ($page_backgorund_attachment && $page_backgorund_image != '') {
                $container_style['background-attachment'] = $page_backgorund_attachment;
                if ($page_backgorund_attachment == 'fixed') {
                    $container_style['background-size'] = 'cover';
                } else {
                    $container_style['background-size'] = 'contain';
                }
            }
        }
        $current_style = depot_mikado_dynamic_css($container_selector, $container_style);

        $current_style = $current_style . $style;
        return $current_style;

    }

    add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_boxed_style');
}

if (!function_exists('depot_mikado_content_padding_top')) {
    /**
     * Function that return padding for content
     */
    function depot_mikado_content_padding_top($style) {
        $id = depot_mikado_get_page_id();
        $class_id = depot_mikado_get_page_id();
        if (depot_mikado_is_woocommerce_installed() && is_product()) {
            $class_id = get_the_ID();
        }

        $class_prefix = depot_mikado_get_unique_page_class($class_id);

        $current_style = '';

        $content_selector = array(
            $class_prefix . ' .mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
            $class_prefix . ' .mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );

        $content_class = array();

        $page_padding_top = get_post_meta($id, "mkd_page_content_top_padding", true);

        if ($page_padding_top !== '') {
            if (get_post_meta($id, "mkd_page_content_top_padding_mobile", true) == 'yes') {
                $content_class['padding-top'] = depot_mikado_filter_px($page_padding_top) . 'px !important';
            } else {
                $content_class['padding-top'] = depot_mikado_filter_px($page_padding_top) . 'px';
            }
            $current_style .= depot_mikado_dynamic_css($content_selector, $content_class);
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_content_padding_top');
}

if (!function_exists('depot_mikado_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function depot_mikado_get_unique_page_class($id) {
        $page_class = '';

        if (is_single()) {
            $page_class = '.postid-' . $id;
        } elseif ($id === depot_mikado_get_woo_shop_page_id()) {
            $page_class = '.archive';
        } elseif (is_home()) {
            $page_class .= '.home';
        } else {
            $page_class .= '.page-id-' . $id;
        }

        return $page_class;
    }
}

if (!function_exists('depot_mikado_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function depot_mikado_print_custom_css() {
        $custom_css = depot_mikado_options()->getOptionValue('custom_css');

        if (!empty($custom_css)) {
            wp_add_inline_style('depot_mikado_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_print_custom_css');
}

if (!function_exists('depot_mikado_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function depot_mikado_print_custom_js() {
        $custom_js = depot_mikado_options()->getOptionValue('custom_js');

        if (!empty($custom_js)) {
            wp_add_inline_script('depot_mikado_modules', $custom_js);
        }
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_print_custom_js');
}

if (!function_exists('depot_mikado_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function depot_mikado_get_global_variables() {
        $global_variables = array();

        $global_variables['mkdAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
        $global_variables['mkdElementAppearAmount'] = -100;
        $global_variables['mkdAddingToCartLabel'] = esc_html__('Adding to Cart...', 'depot');

        $global_variables = apply_filters('depot_mikado_js_global_variables', $global_variables);

        wp_localize_script('depot_mikado_modules', 'mkdGlobalVars', array(
            'vars' => $global_variables
        ));
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_get_global_variables');
}

if (!function_exists('depot_mikado_per_page_js_variables')) {
    /**
     * Outputs global JS variable that holds page settings
     */
    function depot_mikado_per_page_js_variables() {
        $per_page_js_vars = apply_filters('depot_mikado_per_page_js_vars', array());

        wp_localize_script('depot_mikado_modules', 'mkdPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'depot_mikado_per_page_js_variables');
}

if (!function_exists('depot_mikado_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function depot_mikado_content_elem_style_attr() {
        $styles = apply_filters('depot_mikado_content_elem_style_attr', array());

        depot_mikado_inline_style($styles);
    }
}

if (!function_exists('depot_mikado_open_graph')) {
    /*
     * Function that echoes open graph meta tags if enabled
     */
    function depot_mikado_open_graph() {

        if (depot_mikado_option_get_value('enable_open_graph') === 'yes') {

            // get the id
            $id = get_queried_object_id();

            // default type is article, override it with product if page is woo single product
            $type = 'article';
            $description = '';

            // check if page is generic wp page w/o page id
            if (depot_mikado_is_default_wp_template()) {
                $id = 0;
            }

            // check if page is woocommerce shop page
            if (depot_mikado_is_woocommerce_installed() && (function_exists('is_shop') && is_shop())) {
                $shop_page_id = get_option('woocommerce_shop_page_id');

                if (!empty($shop_page_id)) {
                    $id = $shop_page_id;
                    // set flag
                    $description = 'woocommerce-shop';
                }
            }

            if (function_exists('is_product') && is_product()) {
                $type = 'product';
            }

            // if id exist use wp template tags
            if (!empty($id)) {
                $url = get_permalink($id);
                $title = get_the_title($id);

                // apply bloginfo description to woocommerce shop page instead of first product item description
                if ($description === 'woocommerce-shop') {
                    $description = get_bloginfo('description');
                } else {
                    $description = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $id)));
                }

                // has featured image
                if (get_post_thumbnail_id($id) !== '') {
                    $image = wp_get_attachment_url(get_post_thumbnail_id($id));
                } else {
                    $image = depot_mikado_option_get_value('open_graph_image');
                }
            } else {
                global $wp;
                $url = esc_url(home_url(add_query_arg(array(), $wp->request)));
                $title = get_bloginfo('name');
                $description = get_bloginfo('description');
                $image = depot_mikado_option_get_value('open_graph_image');
            }

            ?>

            <meta property="og:url" content="<?php echo esc_url($url); ?>"/>
            <meta property="og:type" content="<?php echo esc_html($type); ?>"/>
            <meta property="og:title" content="<?php echo esc_html($title); ?>"/>
            <meta property="og:description" content="<?php echo esc_html($description); ?>"/>
            <meta property="og:image" content="<?php echo esc_url($image); ?>"/>

        <?php }
    }

    add_action('wp_head', 'depot_mikado_open_graph');
}

if (!function_exists('depot_mikado_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function depot_mikado_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('depot_mikado_core_plugin_installed')) {
    //is Mikado CPT installed?
    function depot_mikado_core_plugin_installed() {
        return defined('MIKADO_CORE_VERSION');
    }
}

if (!function_exists('depot_mikado_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function depot_mikado_visual_composer_installed() {
        //is Visual Composer installed?
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('depot_mikado_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function depot_mikado_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if (defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('depot_mikado_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function depot_mikado_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('depot_mikado_max_image_width_srcset')) {
    /**
     * Set max width for srcset to 1920
     *
     * @return int
     */
    function depot_mikado_max_image_width_srcset() {
        return 1920;
    }

    add_filter('max_srcset_image_width', 'depot_mikado_max_image_width_srcset');
}

if(!function_exists('depot_mikado_attachment_image_additional_fields')) {
	/**
	 *
	 * @param $form_fields array, fields to include in attachment form
	 * @param $post object, attachment record in database
	 *
	 * @return mixed
	 */
	function depot_mikado_attachment_image_additional_fields($form_fields, $post) {


		// ADDING IMAGE LINK FILED - START //

		$form_fields['attachment-image-link'] = array(
			'label' => 'Image Link',
			'input' => 'text',
			'application' => 'image',
			'exclusions'  => array( 'audio', 'video' ),
			'value' => get_post_meta($post->ID, 'attachment_image_link', true)
		);

		// ADDING IMAGE LINK FILED - END //

		// ADDING IMAGE TARGET FILED - START //

		$options_image_target = array(
			'_selft'            => esc_html__('Same Window', 'depot'),
			'_blank'       => esc_html__('New Window', 'depot'),
		);

		$html_image_target     = '';
		$selected_image_target = get_post_meta($post->ID, 'attachment_image_target', true);

		$html_image_target .= '<select name="attachments['.$post->ID.'][attachment-image-target]" class="attachment-image-target" data-setting="attachment-image-target">';
		// Browse and add the options
		foreach($options_image_target as $key => $value) {
			if($key == $selected_image_target) {
				$html_image_target .= '<option value="'.$key.'" selected>'.$value.'</option>';
			} else {
				$html_image_target .= '<option value="'.$key.'">'.$value.'</option>';
			}
		}

		$html_image_target .= '</select>';

		$form_fields['attachment-image-target'] = array(
			'label' => 'Image Target',
			'input' => 'html',
			'html'  => $html_image_target,
			'application' => 'image',
			'exclusions'  => array( 'audio', 'video' ),
			'value' => get_post_meta($post->ID, 'attachment_image_target', true)
		);

		// ADDING IMAGE TARGET FILED - END //

		return $form_fields;
	}

	add_filter('attachment_fields_to_edit', 'depot_mikado_attachment_image_additional_fields', 10, 2);

}

if(!function_exists('depot_mikado_attachment_image_additional_fields_save')) {
	/**
	 * Save values of Attachment Image sizes in media uploader
	 *
	 * @param $post array, the post data for database
	 * @param $attachment array, attachment fields from $_POST form
	 *
	 * @return mixed
	 */
	function depot_mikado_attachment_image_additional_fields_save($post, $attachment) {

		if(isset($attachment['attachment-image-link'])) {
			update_post_meta($post['ID'], 'attachment_image_link', $attachment['attachment-image-link']);
		}

		if(isset($attachment['attachment-image-target'])) {
			update_post_meta($post['ID'], 'attachment_image_target', $attachment['attachment-image-target']);
		}


		return $post;

	}

	add_filter('attachment_fields_to_save', 'depot_mikado_attachment_image_additional_fields_save', 10, 2);

}

if ( ! function_exists( 'depot_mikado_is_gutenberg_installed' ) ) {
	/**
	 * Function that checks if Gutenberg plugin installed
	 * @return bool
	 */
	function depot_mikado_is_gutenberg_installed() {
		return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
	}
}
