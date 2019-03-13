<?php do_action('depot_mikado_before_page_header'); ?>
<aside class="mkd-vertical-menu-area mkd-with-scroll">
    <div class="mkd-vertical-menu-area-inner">
        <div class="mkd-vertical-area-background"></div>
        <?php if(!$hide_logo) {
            depot_mikado_get_logo();
        } ?>
        <?php depot_mikado_get_vertical_main_menu('compact'); ?>
        <div class="mkd-vertical-area-widget-holder">
			<?php depot_mikado_get_header_vertical_widget_areas(); ?>
        </div>
    </div>
</aside>
<?php do_action('depot_mikado_after_page_header'); ?>