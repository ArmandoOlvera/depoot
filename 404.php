<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * depot_mikado_header_meta hook
     *
     * @see depot_mikado_header_meta() - hooked with 10
     * @see depot_mikado_user_scalable_meta - hooked with 10
     */
    do_action('depot_mikado_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * depot_mikado_after_body_tag hook
	 *
	 * @see depot_mikado_get_side_area() - hooked with 10
	 * @see depot_mikado_smooth_page_transitions() - hooked with 10
	 */
	do_action('depot_mikado_after_body_tag'); ?>
	
	<div class="mkd-wrapper mkd-404-page">
	    <div class="mkd-wrapper-inner">
		    <?php depot_mikado_get_header(); ?>
		    
			<div class="mkd-content" <?php depot_mikado_content_elem_style_attr(); ?>>
	            <div class="mkd-content-inner">
					<div class="mkd-page-not-found">
						<?php
							$mkd_title_image_404 = depot_mikado_options()->getOptionValue('404_page_title_image');
							$mkd_title_404       = depot_mikado_options()->getOptionValue('404_title');
							$mkd_subtitle_404    = depot_mikado_options()->getOptionValue('404_subtitle');
							$mkd_text_404        = depot_mikado_options()->getOptionValue('404_text');
							$mkd_button_label    = depot_mikado_options()->getOptionValue('404_back_to_home');
						?>

						<?php if (!empty($mkd_title_image_404)) { ?>
							<div class="mkd-404-title-image"><img src="<?php echo esc_url($mkd_title_image_404); ?>" alt="<?php esc_html_e('404 Title Image', 'depot'); ?>" /></div>
						<?php } ?>

                        <span class="mkd-icon-shortcode mkd-normal">
                        <i class="mkd-icon-linear-icon lnr lnr-sad mkd-icon-element" style=""></i>
                        </span>

						<h2 class="mkd-page-not-found-title">
							<?php if(!empty($mkd_title_404)) {
								echo esc_html($mkd_title_404);
							} else {
								esc_html_e('404 ERROR', 'depot');
							} ?>
						</h2>

						<h3 class="mkd-page-not-found-subtitle">
							<?php if(!empty($mkd_subtitle_404)){
								echo esc_html($mkd_subtitle_404);
							} else {
								esc_html_e('', 'depot');
							} ?>
						</h3>

						<p class="mkd-page-not-found-text">
							<?php if(!empty($mkd_text_404)){
								echo esc_html($mkd_text_404);
							} else {
								esc_html_e('The page requested couldn\'t be found. This could be a spelling error 
in the URL or a removed page.', 'depot');
							} ?>
						</p>

						<?php
							$mkd_params = array();
							$mkd_params['text'] = !empty($mkd_button_label) ? $mkd_button_label : esc_html__('GO BACK TO THE HOMEPAGE', 'depot');
							$mkd_params['link'] = esc_url(home_url('/'));
							$mkd_params['target'] = '_self';
							$mkd_params['size'] = 'large';

						echo depot_mikado_execute_shortcode('mkd_button',$mkd_params);?>
					</div>
				</div>	
			</div>
		</div>
	</div>
    <?php get_footer(); ?>
</body>
</html>