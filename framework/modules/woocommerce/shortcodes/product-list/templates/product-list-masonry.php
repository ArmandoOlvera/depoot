<div class="mkd-pl-holder <?php echo esc_attr($holder_classes) ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php if($query_result->have_posts()){ ?>
        <?php echo depot_mikado_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
		<?php echo depot_mikado_get_woo_shortcode_module_template_part('templates/parts/ordering-filter', 'product-list', '', $params); ?>
        <div class="mkd-prl-loading">
            <span class="mkd-prl-loading-msg"><?php esc_html_e('Loading...', 'depot') ?></span>
        </div>
        <div class="mkd-pl-outer">
            <div class="mkd-pl-sizer"></div>
            <div class="mkd-pl-gutter"></div>
            <?php while ($query_result->have_posts()) : $query_result->the_post();
                echo depot_mikado_get_woo_shortcode_module_template_part('templates/parts/' . $params['info_position'], 'product-list', '', $params);
                endwhile;
			?>
        </div>
	<?php }else {
		depot_mikado_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
	}
	wp_reset_postdata();
	?>
</div>