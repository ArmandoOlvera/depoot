<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php
	    /**
	     * depot_mikado_header_meta hook
	     *
	     * @see depot_mikado_header_meta() - hooked with 10
	     * @see depot_mikado_user_scalable_meta() - hooked with 10
	     */
	    do_action('depot_mikado_header_meta');

	    wp_head(); ?>
    </head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php
		/**
		 * depot_mikado_after_body_tag hook
		 *
		 * @see depot_mikado_get_side_area() - hooked with 10
		 * @see depot_mikado_smooth_page_transitions() - hooked with 10
		 */
		do_action('depot_mikado_after_body_tag'); ?>

		<div class="mkd-wrapper">
			<div class="mkd-wrapper-inner">
				<div class="mkd-content">
		            <div class="mkd-content-inner">
						<div class="mkd-full-width">
							<div class="mkd-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>