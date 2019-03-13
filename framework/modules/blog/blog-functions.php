<?php

/**

 * FUNCTIONS LIST
 * 1)  @see depot_mikado_include_blog_helper_functions
 * 2)  @see depot_mikado_get_archive_blog_list_layout
 * 3)  @see depot_mikado_get_holder_params_blog
 * 4)  @see depot_mikado_get_blog
 * 5)  @see depot_mikado_get_blog_type
 * 6)  @see depot_mikado_get_blog_query
 * 7)  @see depot_mikado_get_blog_list_holder_classes
 * 8)  @see depot_mikado_get_blog_holder_data_params
 * 9)  @see depot_mikado_set_ajax_url
 * 10) @see depot_mikado_blog_load_more
 * 11) @see depot_mikado_get_post_format_html
 * 12) @see depot_mikado_single_link_pages
 * 13) @see depot_mikado_get_blog_single
 * 14) @see depot_mikado_get_blog_single_type
 * 15) @see depot_mikado_get_single_post_format_html
 * 16) @see depot_mikado_text_crop
 * 17) @see depot_mikado_excerpt
 * 18) @see depot_mikado_excerpt_length
 * 19) @see depot_mikado_post_has_read_more
 * 20) @see depot_mikado_modify_read_more_link
 * 21) @see depot_mikado_get_blog_related_post_type
 * 22) @see depot_mikado_get_blog_related_posts
 * 23) @see depot_mikado_blog_shortcode_load_more
 * 24) @see depot_mikado_get_user_custom_fields
 * 25) @see depot_mikado_blog_item_has_link
 * 26) @see depot_mikado_get_blog_module
 * 27) @see depot_mikado_return_post_format
 * 28) @see depot_mikado_return_has_media
 * 29) @see depot_mikado_blog_single_title_module
 * 30) @see depot_mikado_full_height_title_class

**/

if( !function_exists('depot_mikado_include_blog_helper_functions') ) {
	/**
	 * Function which include blog helper function file
	 */
	function depot_mikado_include_blog_helper_functions($module, $type) {
		include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/blog/templates/'. $module .'/' . $type . '/helper.php';
	}
}

if( !function_exists('depot_mikado_get_archive_blog_list_layout') ) {
	/**
	 * Function which return archive blog list layout
	 */
	function depot_mikado_get_archive_blog_list_layout() {
		$blog_layout = depot_mikado_options()->getOptionValue('blog_list_type');
		
		return $blog_layout;
	}
}

if( !function_exists('depot_mikado_get_holder_params_blog') ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 *
	 * @return array
	 */
	function depot_mikado_get_holder_params_blog() {
		$params = array();

        /**
         * Available parameters for holder params
         * -holder
         * -inner
         * -module_title
         * -module_title_layout
         *
         */
        $params = apply_filters('depot_mikado_blog_holder_params', $params);

		return $params;
	}
}

if( !function_exists('depot_mikado_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function depot_mikado_get_blog($type) {
		$holder_classes = '';
		$holder_classes = apply_filters('depot_mikado_blog_holder_classes', $holder_classes);
		$sidebar_layout = depot_mikado_sidebar_layout();
		
		$params = array(
			'holder_classes' => $holder_classes,
			'sidebar_layout' => $sidebar_layout,
			'blog_type'      => $type
		);
		
		depot_mikado_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}
}

if( !function_exists('depot_mikado_get_blog_type') ) {
	/**
	 * Function which create query for blog lists
	 * @param $type type of list that is loaded
	 * @return blog list template
	 */
	function depot_mikado_get_blog_type($type) {
        $blog_query = depot_mikado_get_blog_query();
		$paged = isset($blog_query->query['paged']) ? $blog_query->query['paged'] : 1;
		$max_num_pages = $blog_query->max_num_pages;
		
        $blog_classes = depot_mikado_get_blog_list_holder_classes($type);
        $blog_data_params = depot_mikado_get_blog_holder_data_params($type);
		
		$params = array(
			'blog_query'        => $blog_query,
			'paged'             => $paged,
			'max_num_pages'     => $max_num_pages,
			'blog_type'         => $type,
			'blog_classes'      => $blog_classes,
            'blog_data_params'  => $blog_data_params
		);

		depot_mikado_get_module_template_part('templates/lists/' .  $type . '/list', 'blog', '', $params);
	}
}

if(!function_exists('depot_mikado_get_blog_query')){
	/**
	* Function which create query for blog lists
	*
	* @return wp query object
	*/
	function depot_mikado_get_blog_query(){
		$id = depot_mikado_get_page_id();
		$category = esc_attr(get_post_meta($id, "mkd_blog_category_meta", true));
		$number_of_posts_per_page = get_post_meta($id, "mkd_show_posts_per_page_meta", true);
		$post_number = esc_attr(get_option('posts_per_page'));
		
		if(!empty($number_of_posts_per_page)){
			$post_number = esc_attr($number_of_posts_per_page);
		}
		
		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'paged'          => $paged,
			'category_name'  => $category,
			'posts_per_page' => $post_number
		);
		
		$blog_query = new WP_Query($query_array);
		if(is_archive()) {
			global $wp_query;
			$blog_query = $wp_query;
		}
		
		return $blog_query;
	}
}

if(!function_exists('depot_mikado_get_max_number_of_pages')) {
    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function depot_mikado_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value

        if($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }
}

if(!function_exists('depot_mikado_get_blog_list_holder_classes')){
	/**
	 * Function set blog list classes
	 * @param $type - type of blog list that is passing
	 * @return array - array of classes
	 */
	function depot_mikado_get_blog_list_holder_classes($type){
		$blog_classes   = array();
		$blog_classes[] = 'mkd-blog-holder';
		$blog_classes[] = 'mkd-blog-' . $type;
		
		$pagination_type = depot_mikado_get_meta_field_intersect('blog_pagination_type');
		if(!empty($pagination_type)) {
			$blog_classes[] = 'mkd-blog-pagination-' . $pagination_type;
		}
        $masonry_type = depot_mikado_get_meta_field_intersect('blog_list_featured_image_proportion');
        if(!empty($masonry_type)) {
            $blog_classes[] = 'mkd-masonry-images-' . $masonry_type;
        }
		
		$blog_classes = apply_filters('depot_mikado_blog_list_classes', $blog_classes);
		
		return implode(' ', $blog_classes);
	}
}

if(!function_exists('depot_mikado_get_blog_holder_data_params')){
	/**
	 * Function which set data params on blog holder div
	 *
	 * @param $type - type of blog list that is loaded
	 * @return array - array of data parameters
	 */
	function depot_mikado_get_blog_holder_data_params($type){
		$current_query = depot_mikado_get_blog_query();
		$paged = isset($current_query->query['paged']) ? $current_query->query['paged'] : 1;
		
		$data_params = array();
		$data_return_string = '';
		$data_params['data-blog-type'] = $type;
		
		$posts_number = get_option('posts_per_page');
		$posts_per_page_meta = get_post_meta(get_the_ID(), "mkd_show_posts_per_page_meta", true);
		if(!empty($posts_per_page_meta)){
			$posts_number = esc_attr($posts_per_page_meta);
		}
		
		$category = get_post_meta(depot_mikado_get_page_id(), 'mkd_blog_category_meta', true);
		
		//set data params
		$data_params['data-next-page'] = $paged+1;
		$data_params['data-max-num-pages'] =  $current_query->max_num_pages;
		$data_params['data-post-number'] = $posts_number;
		
		if(!empty($category)){
			$data_params['data-category'] = $category;
		}
		
		if(is_archive()){
			
			if(is_category()){
				$cat_id = get_queried_object_id();
				$data_params['data-archive-category'] = $cat_id;
			}
			
			if(is_author()){
				$author_id = get_queried_object_id();
				$data_params['data-archive-author'] = $author_id;
			}
			
			if(is_tag()){
				$current_tag_id = get_queried_object_id();
				$data_params['data-archive-tag'] = $current_tag_id;
			}
			
			if(is_date()){
				$day  = get_query_var('day');
				$month = get_query_var('monthnum');
				$year = get_query_var('year');
				
				$data_params['data-archive-day'] = $day;
				$data_params['data-archive-month'] = $month;
				$data_params['data-archive-year'] = $year;
			}
		}
		
		foreach($data_params as $key => $value) {
			if ($key !== '') {
				$data_return_string .= $key.'= '.esc_attr($value).' ';
			}
		}
		
		return $data_return_string;
	}
}

if(!function_exists('depot_mikado_set_ajax_url')){
	/**
	 * load themes ajax functionality
	 */
	function depot_mikado_set_ajax_url() {
		echo '<script type="application/javascript">var MikadoAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	
	add_action('wp_enqueue_scripts', 'depot_mikado_set_ajax_url');
}

if(!function_exists('depot_mikado_blog_load_more')){
	
	function depot_mikado_blog_load_more(){
		$return_obj = array();
		$paged = $post_number = $category = $blog_type = '';
		$archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';
		
		if (!empty($_POST['nextPage'])) {
			$paged = $_POST['nextPage'];
		}
		if (!empty($_POST['postNumber'])) {
			$post_number = $_POST['postNumber'];
		}
		if (!empty($_POST['category'])) {
			$category = $_POST['category'];
		}
		if (!empty($_POST['blogType'])) {
			$blog_type = $_POST['blogType'];
		}
		if (!empty($_POST['archiveCategory'])) {
			$archive_category = $_POST['archiveCategory'];
		}
		if (!empty($_POST['archiveAuthor'])) {
			$archive_author = $_POST['archiveAuthor'];
		}
		if (!empty($_POST['archiveTag'])) {
			$archive_tag = $_POST['archiveTag'];
		}
		if (!empty($_POST['archiveDay'])) {
			$archive_day = $_POST['archiveDay'];
		}
		if (!empty($_POST['archiveMonth'])) {
			$archive_month = $_POST['archiveMonth'];
		}
		if (!empty($_POST['archiveYear'])) {
			$archive_year = $_POST['archiveYear'];
		}
		
		$html = '';
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'paged'          => $paged,
			'posts_per_page' => $post_number,
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if(!empty($category)) {
			$query_array['category_name'] = $category;
		}
		
		if(!empty($archive_category)) {
			$query_array['cat'] = $archive_category;
		}
		
		if(!empty($archive_author)) {
			$query_array['author'] = $archive_author;
		}
		
		if(!empty($archive_tag)) {
			$query_array['tag'] = $archive_tag;
		}
		
		if($archive_day !== '' && $archive_month !== '' && $archive_year !== '') {
			$query_array['day'] = $archive_day;
			$query_array['monthnum'] = $archive_month;
			$query_array['year'] = $archive_year;
		}
		
		$query_results = new \WP_Query($query_array);

        include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/blog/templates/lists/' . $blog_type . '/helper.php';

		if($query_results->have_posts()):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= depot_mikado_get_post_format_html($blog_type, 'yes');
			endwhile;
		else:
			$html .= depot_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode($return_obj); exit;
	}

    add_action('wp_ajax_nopriv_depot_mikado_blog_load_more', 'depot_mikado_blog_load_more');
    add_action( 'wp_ajax_depot_mikado_blog_load_more', 'depot_mikado_blog_load_more' );
}

if( !function_exists('depot_mikado_get_post_format_html') ) {
	/**
	 * Function which return html for post formats
	 * @param $type
	 * @param $ajax
	 * @return post hormat template
	 */
	function depot_mikado_get_post_format_html($type = "", $ajax = '') {

        $post_format = depot_mikado_return_post_format();

		$params = array();
		$params['blog_template_type'] = $type;
		$params['post_format']		  = $post_format;

        $post_classes = array();
        $post_classes[] = depot_mikado_return_has_media() ? 'mkd-post-has-media' : 'mkd-post-no-media';
        $params['post_classes'] = $post_classes;

         /*
         * Available parameters for template parts
         * -featured_image_size
         * -title_tag
         * -link_tag
         * -quote_tag
         * -share_type
         *
         */
        $params['part_params']        = apply_filters('depot_mikado_blog_part_params', array());

		if($ajax == ''){
			depot_mikado_get_module_template_part('templates/lists/' . $type . '/post', 'blog', $post_format, $params);
		}
		if($ajax == 'yes'){
			return depot_mikado_get_blog_module_template_part('templates/lists/' . $type . '/post', $post_format, $params);
		}
	}
}

if( !function_exists('depot_mikado_single_link_pages') ) {
    /**
     * Function which return parts on single.php which are just below content
     *
     * @return single.php html
     */
    function depot_mikado_single_link_pages() {

        $args_pages = array(
            'before'           => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
            'after'            => '</div></div>',
            'link_before'      => '<span>'. esc_html__('Page ', 'depot'),
            'link_after'       => '</span>',
            'pagelink'         => '%'
        );

        wp_link_pages($args_pages);
    }
    
    add_action('depot_mikado_single_link_pages', 'depot_mikado_single_link_pages');
}

if(!function_exists('depot_mikado_get_blog_single')) {
	/**
	 * Function which return holder for single posts
	 *
     * @param type - type of single layout
	 * @return single holder.php template
	 */
	function depot_mikado_get_blog_single($type) {
		$sidebar_layout = depot_mikado_sidebar_layout();
		
		$holder_classes = $sidebar_layout !== 'no-sidebar' ? 'mkd-content-has-sidebar' : '';
		$holder_classes = apply_filters('depot_mikado_blog_single_holder_classes', $holder_classes);
		
		$params = array(
			'holder_classes'        => $holder_classes,
			'sidebar_layout'        => $sidebar_layout,
			'blog_single_type'      => $type,
			'blog_single_classes'   => 'mkd-blog-single-'.$type
		);

		depot_mikado_get_module_template_part('templates/singles/holder', 'blog', '', $params);
	}
}

if( !function_exists('depot_mikado_get_blog_single_type') ) {
    /**
     * Function which create query for blog lists
     * @param $type type of list that is loaded
     * @return blog list template
     */
    function depot_mikado_get_blog_single_type($type) {

        $params = array();
        $params['blog_single_type'] = $type;
        /*
         * Available parameters for info parts
         * -related_posts_image_size
         *
         */
        $params['single_info_params'] = apply_filters('depot_mikado_blog_single_info_params', array());

        depot_mikado_get_module_template_part('templates/singles/'.$type.'/single', 'blog', '', $params);
    }
}

if( !function_exists('depot_mikado_get_single_post_format_html') ) {
	/**
	 * Function return all parts on single.php page
	 *
	 * @param $type - type of blog single layout
	 * @return single.php html
	 */
	function depot_mikado_get_single_post_format_html($type) {
        $post_format = depot_mikado_return_post_format();
		$params = array();
        /*
         * Available parameters for template parts
         * -featured_image_size
         * -title_tag
         * -link_tag
         * -quote_tag
         * -share type
         *
         */
        $params['part_params']  = apply_filters('depot_mikado_blog_part_params', array());

        depot_mikado_get_module_template_part('templates/singles/'.$type.'/'.$post_format, 'blog', '', $params);
	}
}

if(!function_exists('depot_mikado_text_crop')) {
    /**
     * Function that cuts plain text to the number of words supplied
     *
     */
    function depot_mikado_text_crop($text, $word_count = 45, $suffix = true) {

        $text = trim($text);
        $word_count = (int) $word_count;
        $suffix = (bool) $suffix;

        //explode current text to words
        $text_word_array    = explode (' ', $text);

        // Filter out all empty words
        $text_word_array = array_filter($text_word_array, function($text_word_array_item) { return trim($text_word_array_item) != ''; });

        // Real word count
        $text_word_array_count = count ($text_word_array);

        //cut down that array based on the number of the words option
        $text_word_array    = array_slice ($text_word_array, 0, $word_count);

        //and finally implode words together
        $cropped_text       = implode (' ', $text_word_array);

        // adds three dots only if it is needed
        if ($suffix && $text_word_array_count > $word_count) $cropped_text .= '...';

        return $cropped_text;
    }
}

if(!function_exists('depot_mikado_excerpt')) {
    /**
     * Function that cuts post excerpt to the number of word based on previosly set global
     * variable $word_count, which is defined in mkd_set_blog_word_count function.
     *
     * @param $length - default excerpt length
     *
     * @return string - formatted excerpt
     *
     * It current post has read more tag set it will return content of the post, else it will return post excerpt
     *
     */
    function depot_mikado_excerpt($length) {
        global $post;

        if(post_password_required()) {
            echo get_the_password_form();
        }

        //does current post has read more tag set?
        elseif(depot_mikado_post_has_read_more()) {
            global $more;

            //override global $more variable so this can be used in blog templates
            $more = 0;
            return get_the_content(true);
        }

        $number_of_chars = depot_mikado_get_meta_field_intersect('number_of_chars', depot_mikado_get_page_id());
        $word_count = $length !== '' ? $length : $number_of_chars;

        //is word count set to something different that 0?
        if($word_count > 0) {

            //if post excerpt field is filled take that as post excerpt, else that content of the post
            $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

            //remove leading dots if those exists
            $clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

            //if clean excerpt has text left
            if($clean_excerpt !== '') {
                //explode current excerpt to words
                $excerpt_word_array = explode (' ', $clean_excerpt);

                //cut down that array based on the number of the words option
                $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

                //and finally implode words together
                $excerpt 			= implode (' ', $excerpt_word_array);

                //is excerpt different than empty string?
                if($excerpt !== '') {
                    return rtrim(wp_kses_post($excerpt));
                }
            }
            return "";
        }
        else {
            return "";
        }
    }
}

if (!function_exists('depot_mikado_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @return int changed value
	 */
	function depot_mikado_excerpt_length() {
		$numb_of_chars = depot_mikado_options()->getOptionValue('number_of_chars');
		
		return $numb_of_chars !== '' ? $numb_of_chars : 45;
	}

	add_filter( 'excerpt_length', 'depot_mikado_excerpt_length', 999 );
}

if(!function_exists('depot_mikado_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function depot_mikado_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if (!function_exists('depot_mikado_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function depot_mikado_modify_read_more_link() {
		$link = '<div class="mkd-more-link-container">';
        if(depot_mikado_core_plugin_installed()) {
            $link .= depot_mikado_get_button_html(array(
                'link' => get_permalink() . '#more-' . get_the_ID(),
                'text' => esc_html__('Continue reading', 'depot')
            ));
        } else {
            $link .='<a itemprop="url" href="' . get_permalink() . '#more-' . get_the_ID() . '" target="_self" class="mkd-btn mkd-btn-large mkd-btn-solid">';
            $link .= '<span class="mkd-btn-text">';
            $link .= esc_html__('Continue reading', 'depot');
            $link .= '</span></a>';
        }

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'depot_mikado_modify_read_more_link');
}

if ( ! function_exists('depot_mikado_get_blog_related_post_type')) {
    /**
     * Function for returning latest posts types
     *
     * @param $post_id
     * @param array $options
     * @return WP_Query
     */
    function depot_mikado_get_blog_related_post_type($post_id, $options = array()) {
        $tags = get_the_tags($post_id);
        //Get categories
        $categories = get_the_category($post_id);

        $tag_ids = array();
        if ($tags) {
            foreach ($tags as $tag) {
                $tag_ids[] = $tag->term_id;
            }
        }

        $category_ids = array();
        if ($categories) {
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
        }

        $hasRelatedByTag = false;

        if ($tag_ids) {
            $related_by_tag = depot_mikado_get_blog_related_posts($post_id, $tag_ids, 'tag', $options);

            if (!empty($related_by_tag->posts)) {
                $hasRelatedByTag = true;

                return $related_by_tag;
            }
        }

        if ($categories && !$hasRelatedByTag) {
            $related_by_category = depot_mikado_get_blog_related_posts($post_id, $category_ids, 'category', $options);

            if (!empty($related_by_category->posts)) {
                return $related_by_category;
            }
        }
    }
}

if ( ! function_exists('depot_mikado_get_blog_related_posts') ) {
    /**
     * Function for related posts
     *
     * @param $post_id - Post ID
     * @param $term_ids - Category or Tag IDs
     * @param $slug - term slug for WP_Query
     * @param array $options
     * @return WP_Query
     */
    function depot_mikado_get_blog_related_posts($post_id, $term_ids, $slug, $options = array()) {
        //Query options
        $posts_per_page = -1;

        //Override query options
        extract($options);

        $args = array(
            'post_status'    => 'publish',
            'post__not_in'   => array($post_id),
            $slug . '__in'   => $term_ids,
            'order'          => 'DESC',
            'orderby'        => 'date',
            'posts_per_page' => $posts_per_page
        );

        $related_posts = new WP_Query($args);

        return $related_posts;
    }
}

if(!function_exists('depot_mikado_blog_shortcode_load_more')){

    function depot_mikado_blog_shortcode_load_more(){
        $params = array();

        if(!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);

                    $params[$setAllLettersToLowercase] = $value;
                }
            }
        }

		$this_object = new \MikadoCore\CPT\Shortcodes\BlogList\BlogList();

        $query_array = $this_object->generateQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $params['this_object'] = $this_object;

	    ob_start();
	    
        if($query_results->have_posts()):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                depot_mikado_get_module_template_part('shortcodes/blog-list/layout-collections/'.$params['type'], 'blog', '', $params);
            endwhile;
        else:
            depot_mikado_get_module_template_part('templates/parts/no-posts', 'blog', '', $params);
        endif;
	    
	    $html = ob_get_contents();
	
	    ob_end_clean();
	    
	    wp_reset_postdata();

        $return_obj = array(
            'html' => $html,
        );
	    
        echo json_encode($return_obj); exit;
    }

    add_action('wp_ajax_nopriv_depot_mikado_blog_shortcode_load_more', 'depot_mikado_blog_shortcode_load_more');
    add_action( 'wp_ajax_depot_mikado_blog_shortcode_load_more', 'depot_mikado_blog_shortcode_load_more' );
}

if(!function_exists('depot_mikado_get_user_custom_fields')) {
	/**
	 * Function returns links and icons for author social networks
	 *
	 * return array
	 */
	function depot_mikado_get_user_custom_fields() {
		
		$user_social_array    = array();
		$social_network_array = array(
			'facebook',
			'twitter',
			'linkedin',
			'instagram',
			'pinterest',
			'tumblr',
			'googleplus'
		);
		
		foreach($social_network_array as $network) {
			if(get_the_author_meta($network) !== '') {
				$$network                    = array(
					'link'  => get_the_author_meta($network),
					'class' => 'social_'.$network.' mkd-author-social-'.$network.' mkd-author-social-icon'
				);
				$user_social_array[$network] = $$network;
			}
		}
		
		return $user_social_array;
	}
}

if(!function_exists('depot_mikado_blog_item_has_link')) {
	/**
	 * Function returns true/false depends is single post or in loop
	 *
	 * return boolean
	 */
	function depot_mikado_blog_item_has_link() {
		$is_link = (is_single() && (get_the_ID() === depot_mikado_get_page_id())) ? false : true;

		return $is_link;
	}
}

if(!function_exists('depot_mikado_get_blog_module')) {
    /**
     * Function returns single/list depending is single post or in loop
     *
     * return string
     */
    function depot_mikado_get_blog_module() {
        $module = (is_single() && (get_the_ID() === depot_mikado_get_page_id())) ? 'single' : 'list';

        return $module;
    }
}

if( !function_exists('depot_mikado_return_post_format') ) {
    /**
     * Function return all parts on single.php page
     *
     * @return string with post format
     */
    function depot_mikado_return_post_format() {
        $post_format = get_post_format();

        $supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
        if (in_array($post_format, $supported_post_formats)) {
            $post_format = $post_format;
        } else {
            $post_format = 'standard';
        }

        return $post_format;
    }
}

if( !function_exists('depot_mikado_return_has_media') ) {
    /**
     * Function return all parts on single.php page
     *
     * @return string with post format
     */
    function depot_mikado_return_has_media() {
        $post_format = get_post_format();

        switch ($post_format):
            case "video":
                return get_post_meta(get_the_ID(), 'mkd_post_video_custom_meta', true) !== '' || get_post_meta(get_the_ID(), 'mkd_post_video_link_meta', true) !== '';
                break;
            case "audio":
                return get_post_meta(get_the_ID(), 'mkd_post_audio_custom_meta', true) !== '' || get_post_meta(get_the_ID(), 'mkd_post_audio_link_meta', true) !== '';
                break;
            case "gallery":
                return get_post_meta(get_the_ID(), 'mkd_post_gallery_images_meta', true) !== '';
                break;
            case "quote":
                return get_post_meta(get_the_ID(), 'mkd_post_quote_text_meta', true) !== '';
                break;
            case "link":
                return get_post_meta(get_the_ID(), 'mkd_post_link_link_meta', true) !== '';
                break;
            default:
                return get_post_meta(get_the_ID(), 'mkd_blog_list_featured_image_meta', true) !== '' || has_post_thumbnail();
                break;

        endswitch;
    }
}

if( !function_exists('depot_mikado_blog_single_title_module') ) {
	/**
	 * Function that replaces title image with single post featured image on single post page
	 *
	 * @see depot_mikado_get_title() from title-functions.php file for list of available params
	 *
	 * @param array - array of default title values
	 *
	 * @return array of overridden values
	 */
	function depot_mikado_blog_single_title_module($params) {

		$default_params = $params;
		//module title fields
		$module_title_background_image = '';
		$module_title_background_image_width = '';
		$module_title_background_image_src = '';

		//check if title area is visible on single post, from global options, or page itself
		$show_title_area_blog_single = depot_mikado_get_meta_field_intersect('show_title_area_blog', get_the_ID());
		if($show_title_area_blog_single !== '') {
			$blog_single_title_area_visible = $show_title_area_blog_single === 'yes' ? true : false;
			$default_params['show_title_area'] = $blog_single_title_area_visible;
		}

		$show_title_img = true;
		//is title image hidden for current page?
		if (get_post_meta(get_the_ID(), 'mkd_hide_background_image_meta', true) == 'yes') {
			$show_title_img = false;
		}

		//Check if title background image on page is set. Otherwise use single post featured image.
		$background_image = '';
		$title_area_background_image_meta = get_post_meta(get_the_ID(), 'mkd_title_area_background_image_meta', true);
		if (empty($title_area_background_image_meta)) {
			$background_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
			$module_title_background_image_src = $background_image;
		}

		if (!empty($background_image)) {
			//check for background image width
			$background_image_width = '';
			$background_image_width_dimensions_array = depot_mikado_get_image_dimensions($background_image);
			if (count($background_image_width_dimensions_array)) {
				$background_image_width = $background_image_width_dimensions_array['width'];
			}

			//is responsive image is set for current page?
			$is_img_responsive = depot_mikado_get_meta_field_intersect('title_area_background_image_responsive', get_the_ID());

			if ($is_img_responsive == 'no' && $show_title_img) { //no need for those styles if image is set to be responsive
				if (!empty($background_image)) {
					$module_title_background_image = 'background-image:url(' . esc_url($background_image) . ');';
				}
				if (!empty($background_image_width)) {
					$module_title_background_image_width = 'data-background-width="' . esc_attr($background_image_width) . '"';
				}
			}

			$default_params['title_background_image'] = $module_title_background_image;
			$default_params['title_background_image_width'] = $module_title_background_image_width;
			$default_params['title_background_image_src'] = $module_title_background_image_src;
		}

		return $default_params;
	}

}

if(!function_exists('depot_mikado_full_height_title_class')) {
    /**
     * Function that adds class on title holder if full height title option is enabled for single post page
     *
     * @see depot_mikado_title_classes() in filter-functions.php
     *
     * @param $classes array of classes
     *
     * @return array changed array of classes
     */
    function depot_mikado_full_height_title_class($classes) {

        $full_height_title_area_meta = depot_mikado_get_meta_field_intersect('full_height_title_area_blog', get_the_ID());
        $classes[] = $full_height_title_area_meta == 'yes' ? 'mkd-title-full-height' : "";

        return $classes;
    }

    add_filter('depot_mikado_title_classes', 'depot_mikado_full_height_title_class');
}

if(!function_exists('depot_mikado_post_has_thumbnail')) {
	/**
	 * Function that adds class on title holder if full height title option is enabled for single post page
	 *
	 * @see depot_mikado_title_background_image_classes() in filter-functions.php
	 *
	 * @param $title_img string with title image url
	 *
	 * @return string with image
	 */
	function depot_mikado_post_has_thumbnail($title_img) {

		if(has_post_thumbnail()) {
			$title_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
		}

		return $title_img;
	}
}