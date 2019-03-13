<?php do_action('depot_mikado_before_mobile_header'); ?>

	<header class="mkd-mobile-header">
		<div class="mkd-mobile-header-inner">
			<?php do_action('depot_mikado_after_mobile_header_html_open') ?>
			<div class="mkd-mobile-header-holder">
				<div class="mkd-grid">
					<div class="mkd-vertical-align-containers">
						<?php if($show_logo) : ?>
						<div class="mkd-position-left">
							<div class="mkd-position-left-inner">
								<?php depot_mikado_get_mobile_logo(); ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="mkd-position-right">
							<div class="mkd-position-right-inner">
								<?php if($show_navigation_opener) : ?>
									<div class="mkd-mobile-menu-opener">
										<a href="javascript:void(0)">
										<?php if(!empty($mobile_menu_title)) { ?>
										<h5 class="mkd-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
									<?php } ?>
											<span class="mkd-mobile-opener-icon-holder">
												<i class="fa fa-bars"></i>
											</span>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!-- close .mkd-vertical-align-containers -->
				</div>
			</div>
		</div>
		<div class="mkd-mobile-side-area">
			<div class="mkd-close-mobile-side-area-holder">
				<span aria-hidden="true" class="icon_close"></span>
			</div>
			<div class="mkd-mobile-side-area-inner">
				<?php depot_mikado_get_mobile_nav(); ?>
			</div>
			<?php if(is_active_sidebar('mkd-mobile-menu-bottom')) {
				dynamic_sidebar('mkd-mobile-menu-bottom');
			} ?>
		</div>
	</header> <!-- close .mkd-mobile-header -->

<?php do_action('depot_mikado_after_mobile_header'); ?>