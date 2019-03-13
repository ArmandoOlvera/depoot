<div class="mkd-plc-holder <?php echo esc_attr($holder_classes) ?>">
	<div class="mkd-plc-outer mkd-owl-slider" <?php echo depot_mikado_get_inline_attrs($holder_data); ?>>
		<?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
			<div class="mkd-plc-item">
				<div class="mkd-plc-image-outer">
					<div class="mkd-plc-image">
						<?php depot_mikado_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
					</div>
					<div class="mkd-plc-text">
						<div class="mkd-plc-text-outer">
							<div class="mkd-plc-text-inner">
								<?php do_action('depot_mikado_woocommerce_info_below_image_hover'); ?>
							</div>
						</div>
					</div>
					<a class="mkd-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
                <div class="mkd-plc-text-wrapper">
					<?php depot_mikado_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

					<?php depot_mikado_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>

					<?php depot_mikado_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>

					<?php depot_mikado_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>

					<?php depot_mikado_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

					<?php depot_mikado_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
                </div>
			</div>
		<?php endwhile;	else:
			depot_mikado_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
		endif;
			wp_reset_postdata();
		?>
	</div>
</div>