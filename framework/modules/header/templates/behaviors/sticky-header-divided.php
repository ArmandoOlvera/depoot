<?php do_action('depot_mikado_before_sticky_header'); ?>

    <div class="mkd-sticky-header">

        <?php do_action('depot_mikado_after_sticky_menu_html_open'); ?>
        <div class="mkd-sticky-holder">
            <?php if ($sticky_header_in_grid) : ?>
            <div class="mkd-grid">
                <?php endif; ?>
                <div class="mkd-vertical-align-containers">
                    <div class="mkd-position-left">
                        <div class="mkd-position-left-inner">
                            <?php depot_mikado_get_sticky_divided_left_main_menu('mkd-sticky-nav'); ?>
                        </div>
                    </div>
                    <div class="mkd-position-center">
                        <div class="mkd-position-center-inner">
                            <?php if (!$hide_logo) {
                                depot_mikado_get_logo('divided-sticky');
                            } ?>
                        </div>
                    </div>
                    <div class="mkd-position-right">
                        <div class="mkd-position-right-inner">
                            <?php depot_mikado_get_sticky_divided_right_main_menu('mkd-sticky-nav'); ?>
                            <div class="mkd-main-menu-widget-area">
                                <div class="mkd-main-menu-widget-area-inner">
                                    <?php depot_mikado_get_header_widget_menu_area(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($sticky_header_in_grid) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php do_action('depot_mikado_end_of_page_header_html'); ?>
    </div>

<?php do_action('depot_mikado_after_sticky_header'); ?>