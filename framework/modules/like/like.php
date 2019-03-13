<?php

class DepotMikadoLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_depot_mikado_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_depot_mikado_like', array( $this, 'ajax'));
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	function enqueue_scripts() {
		wp_enqueue_script( 'mkd-like', MIKADO_ASSETS_ROOT . '/js/modules/plugins/like.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'mkd-like', 'mkdLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('mkd-like-', '', $_POST['likes_id']);
			$post_id = substr($post_id, 0, -4);
			$type    = isset($_POST['type']) ? $_POST['type'] : '';

			echo wp_kses($this->like_post($post_id, $type, 'update'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}

		//get
		else {
			$post_id = str_replace('mkd-like-', '', $_POST['likes_id']);
			$post_id = substr($post_id, 0, -4);
            $type    = isset($_POST['type']) ? $_POST['type'] : '';

			echo wp_kses($this->like_post($post_id, $type, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $type = '', $action = 'get'){
		if(!is_numeric($post_id)) return;


		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_mkd-like', true);
                $like_label = $like_count !== '1' ? esc_html__('likes','depot') : esc_html__('like','depot');

				if(isset($_COOKIE['mkd-like_'. $post_id])){
                    if($type == 'portfolio-single') {
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }else{
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }

                } else {
                    if($type == 'portfolio-single') {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    } else {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                    }
                }

				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_mkd-like', $like_count, true);
                    $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';

                    if($type == 'portfolio-single') {

                        $icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
                    }
				}

                if($type == 'portfolio-single') {
                    $return_value = $icon . "<span>" . $like_count . "</span><span>" . $like_label . "</span>";
                    return $return_value;
                } else {
                    $return_value = $icon . "<span>" . $like_count . "</span>";
                    return $return_value;
                }
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_mkd-like', true);
                $like_label = $like_count !== '0' ? esc_html__('likes','depot') : esc_html__('like','depot');

				$like_count++;

				update_post_meta($post_id, '_mkd-like', $like_count);
				setcookie('mkd-like_'. $post_id, $post_id, time()*20, '/');

                    if($type == 'portfolio-single') {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                        $return_value = $icon . "<span>" . $like_count . "</span><span>" . $like_label . "</span>";

                        $return_value .= '</span>';
                    } else {
                        $icon = '<i class="icon_heart" aria-hidden="true"></i>';
                        $return_value = $icon . "<span>" . $like_count . "</span>";

                        $return_value .= '</span>';
                    }

					return $return_value;

				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'mkd-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'depot');
		if( isset($_COOKIE['mkd-like_'. $post->ID]) ){
			$class = 'mkd-like liked';
			$title = esc_html__('You already like this!', 'depot');
		}

		return '<a href="#" class="'. $class .'" id="mkd-like-'. $post->ID .'-'. $rand_number.'" title="'. $title .'">'. $output .'</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){

		$class = 'mkd-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'depot');
		if( isset($_COOKIE['mkd-like_'. $portfolio_project_id]) ){
			$class = 'mkd-like liked';
			$title = esc_html__('You already like this!', 'depot');
		}

		return '<a class="'. $class .'" data-type="portfolio_list" id="mkd-like-'. $portfolio_project_id .'-'. $rand_number.'" title="'. $title .'"></a>';
	}

    public function add_like_portfolio_single() {
        global $post;

        $output = $this->like_post($post->ID, 'portfolio-single');

        $class = 'mkd-like';
        $rand_number = rand(100, 999);
        $title = esc_html__('Like this', 'depot');
        if(isset($_COOKIE['mkd-like_'.$post->ID])) {
            $class = 'mkd-like liked';
            $title = esc_html__('You already liked this!', 'depot');
        }

        return '<a href="#" class="'.$class.'" data-type="portfolio-single" id="mkd-like-'.$post->ID .'-'. $rand_number.'" title="'. $title.'">'.$output.'</a>';
    }
}

if (!function_exists('depot_mikado_create_like')) {
    function depot_mikado_create_like() {
        DepotMikadoLike::get_instance();
    }

    add_action('after_setup_theme', 'depot_mikado_create_like');
}