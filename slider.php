<?php
do_action('depot_mikado_before_slider_action');

$mkd_slider_shortcode = get_post_meta(depot_mikado_get_page_id(), 'mkd_page_slider_meta', true);
if (!empty($mkd_slider_shortcode)) { ?>
	<div class="mkd-slider">
		<div class="mkd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($mkd_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php }

do_action('depot_mikado_after_slider_action');
?>