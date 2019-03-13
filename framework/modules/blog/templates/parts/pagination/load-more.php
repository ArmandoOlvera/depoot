<?php if($max_num_pages > 1) { ?>
	<div class="mkd-blog-pag-loading">
		<div class="mkd-blog-pag-bounce1"></div>
		<div class="mkd-blog-pag-bounce2"></div>
		<div class="mkd-blog-pag-bounce3"></div>
	</div>
	<div class="mkd-blog-pag-load-more">
		<?php
        if(depot_mikado_core_plugin_installed()) {
			echo depot_mikado_get_button_html(
                apply_filters(
                    'depot_mikado_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Load more', 'depot')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="mkd-btn mkd-btn-large mkd-btn-solid">
                <span class="mkd-btn-text">
                    <?php echo esc_html__('Load more', 'depot'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
<?php }