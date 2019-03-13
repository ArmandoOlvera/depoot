<?php do_action('depot_mikado_before_page_header'); ?>
<aside class="mkd-vertical-menu-area <?php echo esc_html($holder_class); ?>">
    <div class="mkd-vertical-menu-area-inner">
		<a href="#" class="mkd-vertical-area-opener"><span class="mkd-vertical-area-opener-line"></span></a>
        <div class="mkd-vertical-area-background"></div>
        <?php if(!$hide_logo) {
			depot_mikado_get_logo();
        } ?>
        <?php depot_mikado_get_vertical_main_menu(); ?>
        <div class="mkd-vertical-area-widget-holder">
			<?php depot_mikado_get_header_vertical_widget_areas(); ?>
        </div>
    </div>
</aside>
<div class="mkd-vertical-area-bottom-logo">
	<div class="mkd-vertical-area-bottom-logo-inner">
		<?php if(!$hide_logo) {
			depot_mikado_get_logo();
		} ?>
	</div>
</div>
<?php do_action('depot_mikado_after_page_header'); ?>