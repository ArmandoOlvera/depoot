<?php

require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.kses.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.layout1.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.layout2.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.layout3.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.optionsapi.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.framework.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.functions.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/lib/mkd.icons/mkd.icons.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/admin/options/mkd-options-setup.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/admin/meta-boxes/mkd-meta-boxes-setup.php";
require_once MIKADO_FRAMEWORK_ROOT_DIR."/modules/mkd-modules-loader.php";

if(!function_exists('depot_mikado_admin_scripts_init')) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function depot_mikado_admin_scripts_init() {

        /**
         * @see MikadoSkinAbstract::registerScripts - hooked with 10
         * @see MikadoSkinAbstract::registerStyles - hooked with 10
         */
        do_action('depot_mikado_admin_scripts_init');
	}

	add_action('admin_init', 'depot_mikado_admin_scripts_init');
}

if(!function_exists('depot_mikado_enqueue_admin_styles')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function depot_mikado_enqueue_admin_styles() {
		wp_enqueue_style('wp-color-picker');

        /**
         * @see MikadoSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('depot_mikado_enqueue_admin_styles');
	}
}

if(!function_exists('depot_mikado_enqueue_admin_scripts')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function depot_mikado_enqueue_admin_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script("mkd-dependence", get_template_directory_uri().'/framework/admin/assets/js/mkd-ui/mkd-dependence.js', array(), false, true);
        wp_enqueue_script("mkd-twitter-connect", get_template_directory_uri().'/framework/admin/assets/js/mkd-twitter-connect.js', array(), false, true);

        /**
         * @see MikadoSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('depot_mikado_enqueue_admin_scripts');
	}
}

if(!function_exists('depot_mikado_enqueue_meta_box_styles')) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function depot_mikado_enqueue_meta_box_styles() {
        global $post;
		wp_enqueue_style( 'wp-color-picker' );
        if($post->post_type == 'team-member'){
            wp_enqueue_style("mkd-jquery-ui", get_template_directory_uri().'/framework/admin/assets/css/jquery-ui/jquery-ui.css');
        }

        /**
         * @see MikadoSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('depot_mikado_enqueue_meta_box_styles');
	}
}

if(!function_exists('depot_mikado_enqueue_meta_box_scripts')) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function depot_mikado_enqueue_meta_box_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('mkd-dependence');

        /**
         * @see MikadoSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('depot_mikado_enqueue_meta_box_scripts');
	}
}

if(!function_exists('depot_mikado_enqueue_nav_menu_script')) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 * @param $hook string current page hook to check
	 */
	function depot_mikado_enqueue_nav_menu_script($hook) {
		if($hook == 'nav-menus.php') {
			wp_enqueue_script('mkd-nav-menu', get_template_directory_uri().'/framework/admin/assets/js/mkd-nav-menu.js');
			wp_enqueue_style('mkd-nav-menu', get_template_directory_uri().'/framework/admin/assets/css/mkd-nav-menu.css');
		}
	}

	add_action('admin_enqueue_scripts', 'depot_mikado_enqueue_nav_menu_script');
}

if(!function_exists('depot_mikado_enqueue_widgets_admin_script')) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 * @param $hook string current page hook to check
	 */
	function depot_mikado_enqueue_widgets_admin_script($hook) {
		if($hook == 'widgets.php') {
			wp_enqueue_script('mkd-dependence');
		}
	}

	add_action('admin_enqueue_scripts', 'depot_mikado_enqueue_widgets_admin_script');
}

if(!function_exists('depot_mikado_enqueue_styles_slider_taxonomy')) {
	/**
	 * Enqueue styles when on slider taxonomy page in admin
	 */
	function depot_mikado_enqueue_styles_slider_taxonomy() {
		if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'slides_category') {
			depot_mikado_enqueue_admin_styles();
		}
	}

	add_action('admin_print_scripts-edit-tags.php', 'depot_mikado_enqueue_styles_slider_taxonomy');
}

if(!function_exists('depot_mikado_init_theme_options_array')) {
	/**
	 * Function that merges $depot_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function depot_mikado_init_theme_options_array() {
        global $depot_options, $depot_Framework;

		$db_options = get_option('mkd_options_depot');

		//does mkd_options exists in db?
		if(is_array($db_options)) {
			//merge with default options
			$depot_options  = array_merge($depot_Framework->mkdOptions->options, get_option('mkd_options_depot'));
		} else {
			//options don't exists in db, take default ones
			$depot_options = $depot_Framework->mkdOptions->options;
		}
	}

	add_action('depot_mikado_after_options_map', 'depot_mikado_init_theme_options_array', 0);
}

if(!function_exists('depot_mikado_init_theme_options')) {
	/**
	 * Function that sets $depot_options variable if it does'nt exists
	 */
	function depot_mikado_init_theme_options() {
		global $depot_options;
		global $depot_Framework;
		if(isset($depot_options['reset_to_defaults'])) {
			if( $depot_options['reset_to_defaults'] == 'yes' ) delete_option( "mkd_options_depot");
		}

		if (!get_option("mkd_options_depot")) {
			add_option( "mkd_options_depot",
				$depot_Framework->mkdOptions->options
			);

			$depot_options = $depot_Framework->mkdOptions->options;
		}
	}
}

if(!function_exists('depot_mikado_register_theme_settings')) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function depot_mikado_register_theme_settings() {
		register_setting( 'depot_mikado_theme_menu', 'mkd_options' );
	}

	add_action('admin_init', 'depot_mikado_register_theme_settings');
}

if(!function_exists('depot_mikado_get_admin_tab')) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function depot_mikado_get_admin_tab(){
		return isset($_GET['page']) ? depot_mikado_strafter($_GET['page'],'tab') : NULL;
	}
}

if(!function_exists('depot_mikado_strafter')) {
	/**
	 * Function that returns string that comes after found string
	 * @param $string string where to search
	 * @param $substring string what to search for
	 * @return null|string string that comes after found string
	 */
	function depot_mikado_strafter($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false) {
			return NULL;
		}

		return(substr($string, $pos+strlen($substring)));
	}
}

if(!function_exists('depot_mikado_save_options')) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_mkd_save_options action.
	 */
	function depot_mikado_save_options() {
		global $depot_options;

		if(current_user_can('administrator')) {
			$_REQUEST = stripslashes_deep($_REQUEST);

	        unset($_REQUEST['action']);

	        check_ajax_referer('mkd_ajax_save_nonce', 'mkd_ajax_save_nonce');

			$depot_options = array_merge($depot_options, $_REQUEST);

			update_option( 'mkd_options_depot', $depot_options );

			do_action('depot_mikado_after_theme_option_save');
			echo "Saved";

			die();
		}
	}

	add_action('wp_ajax_depot_mikado_save_options', 'depot_mikado_save_options');
}

if(!function_exists('depot_mikado_meta_box_add')) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function depot_mikado_meta_box_add() {
		global $depot_Framework;
		
		foreach ($depot_Framework->mkdMetaBoxes->metaBoxes as $key=>$box ) {
			$hidden = false;
			if (!empty($box->hidden_property)) {
				foreach ($box->hidden_values as $value) {
					if (depot_mikado_option_get_value($box->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}

			if(is_string($box->scope)) {
				$box->scope = array($box->scope);
			}

			if(is_array($box->scope) && count($box->scope)) {
				foreach($box->scope as $screen) {
					add_meta_box(
						'mkd-meta-box-'.$key,
						$box->title,
                        'depot_mikado_render_meta_box',
						$screen,
						'advanced',
						'high',
						array( 'box' => $box)
					);

					if ($hidden) {
						add_filter('postbox_classes_'.$screen.'_mkd-meta-box-'.$key, 'depot_mikado_meta_box_add_hidden_class');
					}
				}
			}
		}

		if ( depot_mikado_is_gutenberg_installed() ) {
			depot_mikado_enqueue_meta_box_styles();
			depot_mikado_enqueue_meta_box_scripts();
		} else {
			
		add_action('admin_enqueue_scripts', 'depot_mikado_enqueue_meta_box_styles');
		add_action('admin_enqueue_scripts', 'depot_mikado_enqueue_meta_box_scripts');
		}
	}

	add_action('add_meta_boxes', 'depot_mikado_meta_box_add');
}

if(!function_exists('depot_mikado_meta_box_save')) {
	/**
	 * Function that saves meta box to postmeta table
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function depot_mikado_meta_box_save( $post_id, $post ) {
		global $depot_Framework;
		global $depot_IconCollections;

		$nonces_array = array();
		$meta_boxes = depot_mikado_framework()->mkdMetaBoxes->getMetaBoxesByScope($post->post_type);

		if(is_array($meta_boxes) && count($meta_boxes)) {
			foreach($meta_boxes as $meta_box) {
				$nonces_array[] = 'depot_mikado_meta_box_'.$meta_box->name.'_save';
			}
		}

		if(is_array($nonces_array) && count($nonces_array)) {
			foreach($nonces_array as $nonce) {
				if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
					return;
				}
			}
		}
		
		$postTypes = apply_filters('depot_mikado_meta_box_post_types_save', array('post', 'page'));

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!isset( $_POST[ '_wpnonce' ])) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!in_array($post->post_type, $postTypes)) {
			return;
		}

		foreach ($depot_Framework->mkdMetaBoxes->options as $key=>$box ) {

			if (isset($_POST[$key]) && trim($_POST[$key] !== '')) {

				$value = $_POST[$key];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}

		if ($portfolios) {
			update_post_meta( $post_id,  'mkd_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'mkd_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}

		if ($portfolio_images) {
			update_post_meta( $post_id,  'mkd_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id,  'mkd_portfolio_images' );
		}
	}

	add_action( 'save_post', 'depot_mikado_meta_box_save', 1, 2 );
}

if(!function_exists('depot_mikado_render_meta_box')) {
	/**
	 * Function that renders meta box
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function depot_mikado_render_meta_box($post, $metabox) {?>
		<div class="mkd-meta-box mkd-page">
			<div class="mkd-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field('depot_mikado_meta_box_'.$metabox['args']['box']->name.'_save', 'depot_mikado_meta_box_'.$metabox['args']['box']->name.'_save'); ?>
			</div>
		</div>
	<?php
	}
}

if(!function_exists('depot_mikado_meta_box_add_hidden_class')) {
	/**
	 * Function that adds class that will initially hide meta box
	 * @param array $classes array of classes
	 * @return array modified array of classes
	 */
	function depot_mikado_meta_box_add_hidden_class( $classes=array() ) {
		if( !in_array( 'mkd-meta-box-hidden', $classes ) )
			$classes[] = 'mkd-meta-box-hidden';

		return $classes;
	}
}

if(!function_exists('depot_mikado_remove_default_custom_fields')) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function depot_mikado_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters('depot_mikado_meta_box_post_types_remove', array( 'post', 'page')) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action('do_meta_boxes', 'depot_mikado_remove_default_custom_fields');
}

if(!function_exists('depot_mikado_generate_icon_pack_options')) {
    /**
     * Generates options HTML for each icon in given icon pack
     * Hooked to wp_ajax_update_admin_nav_icon_options action
     */
    function depot_mikado_generate_icon_pack_options() {
        global $depot_IconCollections;

        $html = '';
        $icon_pack = isset($_POST['icon_pack']) ? $_POST['icon_pack'] : '';
        $collections_object = $depot_IconCollections->getIconCollection($icon_pack);

        if($collections_object) {
            $icons = $collections_object->getIconsArray();
            if(is_array($icons) && count($icons)) {
                foreach ($icons as $key => $icon) {
                    $html .= '<option value="'.esc_attr($key).'">'.esc_html($key).'</option>';
                }
            }
        }

        print $html;
    }

    add_action('wp_ajax_update_admin_nav_icon_options', 'depot_mikado_generate_icon_pack_options');
}

if(!function_exists('depot_mikado_admin_notice')) {
    /**
     * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
     * @param $id string id of notice. It will be used to store notice dismis
     * @param $message string message to show to the user
     * @param $class string HTML class of notice
     * @param bool $is_dismisable whether notice is dismisable or not
     */
    function depot_mikado_admin_notice($id, $message, $class, $is_dismisable = true) {
        $is_dismised = get_user_meta(get_current_user_id(), 'dismis_'.$id);

        //if notice isn't dismissed
        if(!$is_dismised && is_admin()) {
            echo '<div style="display: block;" class="'.esc_attr($class).' is-dismissible notice">';
            echo '<p>';

            echo wp_kses_post($message);

            if($is_dismisable) {
                echo '<strong style="display: block; margin-top: 7px;"><a href="'.esc_url(add_query_arg('mkd_dismis_notice', $id)).'">'.esc_html__('Dismiss this notice', 'depot').'</a></strong>';
            }

            echo '</p>';
            echo '</div>';
        }
    }
}

if(!function_exists('depot_mikado_save_dismisable_notice')) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function depot_mikado_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['mkd_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['mkd_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'depot_mikado_save_dismisable_notice');
}

if(!function_exists('depot_mikado_hook_twitter_request_ajax')) {
    /**
     * Wrapper function for obtaining twitter request token.
     * Hooks to wp_ajax_mkd_twitter_obtain_request_token ajax action
     *
     * @see MikadoTwitterApi::obtainRequestToken()
     */
    function depot_mikado_hook_twitter_request_ajax() {
        MikadoTwitterApi::getInstance()->obtainRequestToken();
    }

    add_action('wp_ajax_mkd_twitter_obtain_request_token', 'depot_mikado_hook_twitter_request_ajax');
}

if (!function_exists('depot_mikado_comment')) {
    /**
     * Function which modify default wordpress comments
     *
     * @return comments html
     */
    function depot_mikado_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        global $post;

        $is_pingback_comment = $comment->comment_type == 'pingback';
        $is_author_comment  = $post->post_author == $comment->user_id;

        $comment_class = 'mkd-comment clearfix';

        if($is_author_comment) {
            $comment_class .= ' mkd-post-author-comment';
        }

        if($is_pingback_comment) {
            $comment_class .= ' mkd-pingback-comment';
        }
        ?>

        <li>
        <div class="<?php echo esc_attr($comment_class); ?>">
            <?php if(!$is_pingback_comment) { ?>
                <div class="mkd-comment-image"> <?php echo depot_mikado_kses_img(get_avatar($comment, 'thumbnail')); ?> </div>
            <?php } ?>
            <div class="mkd-comment-text">
                <?php
                edit_comment_link(esc_html__('edit','depot'));
                ?>
                <div class="mkd-comment-info">
                    <h4 class="mkd-comment-name">
                        <?php if($is_pingback_comment) { esc_html_e('Pingback:', 'depot'); } ?>
                        <?php echo wp_kses_post(get_comment_author_link()); ?><span class="mkd-comment-time-difference"><?php printf( esc_html__( '%s ago', 'depot' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
                    </h4>
                </div>
                <?php if(!$is_pingback_comment) { ?>
                    <div class="mkd-text-holder" id="comment-<?php echo comment_ID(); ?>">
                        <?php comment_text(); ?>
                    </div>
                <?php } ?>
                <span class="mkd-comment-reply"><?php comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('reply', 'depot'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
            </div>
        </div>
        <?php //li tag will be closed by WordPress after looping through child elements ?>
        <?php
    }
}
?>