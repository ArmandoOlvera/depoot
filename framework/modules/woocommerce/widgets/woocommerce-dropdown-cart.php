<?php
class DepotMikadoWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkd_woocommerce_dropdown_cart',
			esc_html__('Mikado Woocommerce Dropdown Cart', 'depot'),
			array( 'description' => esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'depot' ), )
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'type'		  => 'textfield',
				'name'		  => 'woocommerce_dropdown_cart_margin',
				'title'       => esc_html__('Icon Margin', 'depot'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'depot')
			),
			array(
                'type' => 'dropdown',
                'name' => 'woocommerce_enable_cart_info',
                'title' => esc_html__('Enable Cart Info', 'depot'),
                'options' => depot_mikado_get_yes_no_select_array(false),
                'description' => esc_html__('Enabling this option will show cart info (products number and price) at the right side of dropdown cart icon', 'depot')
            ),
		);
    }

    /**
     * Generate widget form based on $params attribute
     *
     * @param array $instance
     *
     * @return null
     */
    public function form($instance) {
        if(is_array($this->params) && count($this->params)) {
            foreach($this->params as $param_array) {
                $param_name    = $param_array['name'];
                ${$param_name} = isset($instance[$param_name]) ? esc_attr($instance[$param_name]) : '';
            }

            foreach($this->params as $param) {
                switch($param['type']) {
                    case 'textfield':
                        ?>
                        <p>
                            <label for="<?php echo esc_attr($this->get_field_id($param['name'])); ?>"><?php echo
                                esc_html($param['title']); ?>:</label>
                            <input class="widefat" id="<?php echo esc_attr($this->get_field_id($param['name'])); ?>" name="<?php echo esc_attr($this->get_field_name($param['name'])); ?>" type="text" value="<?php echo esc_attr(${$param['name']}); ?>"/>
                            <?php if(!empty($param['description'])) : ?>
                                <span class="mkd-field-description"><?php echo esc_html($param['description']); ?></span>
                            <?php endif; ?>
                        </p>
                        <?php
                        break;
                    case 'dropdown':
                        ?>
                        <p>
                            <label for="<?php echo esc_attr($this->get_field_id($param['name'])); ?>"><?php echo
                                esc_html($param['title']); ?>:</label>
                            <?php if(isset($param['options']) && is_array($param['options']) && count($param['options'])) { ?>
                                <select class="widefat" name="<?php echo esc_attr($this->get_field_name($param['name'])); ?>" id="<?php echo esc_attr($this->get_field_id($param['name'])); ?>">
                                    <?php foreach($param['options'] as $param_option_key => $param_option_val) {
                                        $option_selected = '';
                                        if(${$param['name']} == $param_option_key) {
                                            $option_selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo esc_attr($option_selected); ?> value="<?php echo esc_attr($param_option_key); ?>"><?php echo esc_attr($param_option_val); ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <?php if(!empty($param['description'])) : ?>
                                <span class="mkd-field-description"><?php echo esc_html($param['description']); ?></span>
                            <?php endif; ?>
                        </p>

                        <?php
                        break;    
                }
            }
        } else { ?>
            <p><?php esc_html_e('There are no options for this widget.', 'depot'); ?></p>
        <?php }
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
		
		global $woocommerce;
		
		$icon_styles = array();

		if ($instance['woocommerce_dropdown_cart_margin'] !== '') {
			$icon_styles[] = 'padding: ' . $instance['woocommerce_dropdown_cart_margin'];
		}

		$icon_class = 'mkd-cart-info-is-disabled';

		if (!empty($instance['woocommerce_enable_cart_info']) && $instance['woocommerce_enable_cart_info'] === 'yes') {
			$icon_class = 'mkd-cart-info-is-active';
		}

		$cart_description = depot_mikado_options()->getOptionValue('mkd_woo_dropdown_cart_description');
		?>
		<div class="mkd-shopping-cart-holder <?php echo esc_html($icon_class); ?>" <?php depot_mikado_inline_style($icon_styles) ?>>
			<div class="mkd-shopping-cart-inner">
				<?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
				<a itemprop="url" class="mkd-header-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
                    <span class="mkd-cart-icon-text"><?php esc_html_e('CART', 'depot'); ?></span>
					<span class="mkd-cart-info">
						<span class="mkd-cart-info-total"><?php echo '('.wp_kses($woocommerce->cart->get_cart_subtotal(), array('span' => array('class' => true,'id' => true))).')'; ?></span>
					</span>			
				</a>
				<?php if ( !$cart_is_empty ) : ?>
					<div class="mkd-shopping-cart-dropdown">
						<ul>
							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
								$_product = $cart_item['data'];
								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}
								// Get price
								if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
								} else {
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
								}
								?>
								<li>
									<div class="mkd-item-image-holder">
										<a itemprop="url" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
											<?php echo wp_kses($_product->get_image(), array(
												'img' => array(
												'src' => true,
												'width' => true,
												'height' => true,
												'class' => true,
												'alt' => true,
												'title' => true,
												'id' => true
												)
											)); ?>
										</a>
									</div>
									<div class="mkd-item-info-holder">
										<h5 itemprop="name" class="mkd-product-title"><a itemprop="url" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>"><?php echo apply_filters('depot_mikado_woo_widget_cart_product_title', $_product->get_title(), $_product ); ?></a></h5>
										<span class="mkd-quantity"><?php echo esc_html($cart_item['quantity']); ?></span>
										<?php echo apply_filters( 'depot_mikado_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
										<?php echo apply_filters( 'depot_mikado_woo_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'depot') ), $cart_item_key ); ?>
									</div>
								</li>
							<?php endforeach; ?>
							<div class="mkd-cart-bottom">
								<div class="mkd-subtotal-holder clearfix">
									<span class="mkd-total"><?php esc_html_e( 'TOTAL:', 'depot' ); ?></span>
									<span class="mkd-total-amount">
										<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
											'span' => array(
											'class' => true,
											'id' => true
											)
										)); ?>
									</span>
								</div>
								<?php if(!empty($cart_description)) { ?>
									<div class="mkd-cart-description">
										<div class="mkd-cart-description-inner">
											<span><?php echo esc_html($cart_description); ?></span>
										</div>
									</div>
								<?php } ?>
								<div class="mkd-btn-holder clearfix">
									<a itemprop="url" href="<?php echo esc_url(wc_get_cart_url()); ?>" class="mkd-view-cart" data-title="<?php esc_html_e('VIEW CART','depot'); ?>"><span><?php esc_html_e('VIEW CART','depot'); ?></span></a>
								</div>
                                <div class="mkd-btn-holder clearfix">
                                    <a itemprop="url" href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="mkd-view-cart" data-title="<?php esc_html_e('CHECKOUT','depot'); ?>"><span><?php esc_html_e('CHECKOUT','depot'); ?></span></a>
                                </div>
							</div>
						</ul>
					</div>
				<?php else : ?>
					<div class="mkd-shopping-cart-dropdown">
						<ul>
							<li class="mkd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'depot' ); ?></li>
						</ul>
					</div>
				<?php endif; ?>
			</div>	
		</div>
		<?php
	}
}

add_action('widgets_init', function () {
 register_widget( "DepotMikadoWoocommerceDropdownCart" );
});


if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'depot_mikado_woocommerce_header_add_to_cart_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'depot_mikado_woocommerce_header_add_to_cart_fragment' );
}

function depot_mikado_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$cart_description = depot_mikado_options()->getOptionValue('mkd_woo_dropdown_cart_description');

	ob_start();

	?>

	<div class="mkd-shopping-cart-inner">
		<?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
		<a itemprop="url" class="mkd-header-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
			<span class="mkd-cart-icon-text"><?php esc_html_e('CART', 'depot'); ?></span>
			<span class="mkd-cart-info">
				<span class="mkd-cart-info-total"><?php echo '('.wp_kses($woocommerce->cart->get_cart_subtotal(), array('span' => array('class' => true,'id' => true))).')'; ?></span>
			</span>	
		</a>
		<?php if ( !$cart_is_empty ) : ?>
			<div class="mkd-shopping-cart-dropdown">
				<ul>
					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product = $cart_item['data'];
						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}
						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
						?>
						<li>
							<div class="mkd-item-image-holder">
								<a itemprop="url" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
									<?php echo wp_kses($_product->get_image(), array(
										'img' => array(
										'src' => true,
										'width' => true,
										'height' => true,
										'class' => true,
										'alt' => true,
										'title' => true,
										'id' => true
										)
									)); ?>
								</a>
							</div>
							<div class="mkd-item-info-holder">
								<h5 itemprop="name" class="mkd-product-title"><a itemprop="url" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>"><?php echo apply_filters('depot_mikado_woo_widget_cart_product_title', $_product->get_title(), $_product ); ?></a></h5>
								<span class="mkd-quantity"><?php echo esc_html($cart_item['quantity']); ?></span>
								<?php echo apply_filters( 'depot_mikado_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								<?php echo apply_filters( 'depot_mikado_woo_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'depot') ), $cart_item_key ); ?>
							</div>
						</li>
					<?php endforeach; ?>
					<div class="mkd-cart-bottom">
						<div class="mkd-subtotal-holder clearfix">
							<span class="mkd-total"><?php esc_html_e( 'TOTAL:', 'depot' ); ?></span>
							<span class="mkd-total-amount">
								<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
									'span' => array(
									'class' => true,
									'id' => true
									)
								)); ?>
							</span>
						</div>
						<?php if(!empty($cart_description)) { ?>
							<div class="mkd-cart-description">
								<div class="mkd-cart-description-inner">
									<span><?php echo esc_html($cart_description); ?></span>
								</div>
							</div>
						<?php } ?>
						<div class="mkd-btn-holder clearfix">
							<a itemprop="url" href="<?php echo esc_url(wc_get_cart_url()); ?>" class="mkd-view-cart" data-title="<?php esc_html_e('VIEW CART','depot'); ?>"><span><?php esc_html_e('VIEW CART','depot'); ?></span></a>
						</div>
                        <div class="mkd-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="mkd-view-cart" data-title="<?php esc_html_e('CHECKOUT','depot'); ?>"><span><?php esc_html_e('CHECKOUT','depot'); ?></span></a>
                        </div>
					</div>
				</ul>
			</div>
		<?php else : ?>
			<div class="mkd-shopping-cart-dropdown">
				<ul>
					<li class="mkd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'depot' ); ?></li>
				</ul>
			</div>
		<?php endif; ?>
	</div>

	<?php
	$fragments['div.mkd-shopping-cart-inner'] = ob_get_clean();

	return $fragments;
}
?>