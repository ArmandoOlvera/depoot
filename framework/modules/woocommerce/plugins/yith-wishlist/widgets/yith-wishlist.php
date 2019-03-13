<?php
class DepotMikadoYithWishlist extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkd_woocommerce_yith_wishlist',
			esc_html__('Mikado Woocommerce Wishlist', 'depot'),
			array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'depot' ), )
		);
	}

    /**
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach($this->params as $param) {
            $param_name = $param['name'];

            $instance[$param_name] = sanitize_text_field($new_instance[$param_name]);
        }

        return $instance;
    }

	public function widget( $args, $instance ) {
		extract( $args );
		
		global $yith_wcwl;

		?>
		<div class="mkd-wishlist-widget-holder">
            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="mkd-wishlist-widget-link">
                <span class="mkd-wishlist-widget-icon"><i class="icon_heart_alt"></i></span>
                <span class="mkd-wishlist-items-number">(<span><?php echo yith_wcwl_count_products(); ?></span>)</span>
            </a>
		</div>
		<?php
	}
}

add_action('widgets_init', function () {
    register_widget( "DepotMikadoYithWishlist" );
});

?>