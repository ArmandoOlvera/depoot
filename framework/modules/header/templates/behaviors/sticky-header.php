<?php do_action('depot_mikado_before_sticky_header'); ?>

<div class="mkd-sticky-header">
    <?php do_action( 'depot_mikado_after_sticky_menu_html_open' ); ?>
    <div class="mkd-sticky-holder">
    <?php if($sticky_header_in_grid) : ?>
        <div class="mkd-grid">
            <?php endif; ?>
            <div class=" mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(!$hide_logo) {
                            depot_mikado_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <?php if($menu_area_position == 'center') { ?>
                    <div class="mkd-position-center">
                        <div class="mkd-position-center-inner">
                            <?php depot_mikado_get_sticky_menu('mkd-sticky-nav');; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if($menu_area_position != 'center') { ?>
						    <?php depot_mikado_get_sticky_menu('mkd-sticky-nav'); ?>
                        <?php } ?>
                        <div class="mkd-main-menu-widget-area">
                            <div class="mkd-main-menu-widget-area-inner">
                                <?php if(is_active_sidebar('mkd-sticky-right')) : ?>
                                    <?php dynamic_sidebar('mkd-sticky-right'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('depot_mikado_end_of_page_header_html'); ?>
</div>

<?php do_action('depot_mikado_after_sticky_header'); ?>