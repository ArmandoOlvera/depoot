<div class="mkd-blog-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<div class="mkd-bl-wrapper">
		<ul class="mkd-blog-list">
			<div class="mkd-bl-grid-sizer"></div>
			<div class="mkd-bl-grid-gutter"></div>
			<?php
	            if($query_result->have_posts()):
	                while ($query_result->have_posts()) : $query_result->the_post();
	                    depot_mikado_get_module_template_part('shortcodes/blog-list/layout-collections/'.$type, 'blog', '', $params);
	                endwhile;
	            else:
	                depot_mikado_get_module_template_part('templates/parts/no-posts', 'blog', '', $params);
	            endif;
			
                wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php depot_mikado_get_module_template_part('templates/parts/pagination/'.$params['pagination_type'], 'blog', '', $params); ?>
</div>