<?php do_action('depot_mikado_before_top_navigation'); ?>
<div class="mkd-vertical-menu-outer">
    <div class="mkd-vertical-menu-inner">
        <nav class="mkd-vertical-menu mkd-vertical-dropdown-on-click">
            <?php
                wp_nav_menu(array(
                    'theme_location'  => 'vertical-navigation',
                    'container'       => '',
                    'container_class' => '',
                    'menu_class'      => '',
                    'menu_id'         => '',
                    'fallback_cb'     => 'top_navigation_fallback',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'walker'          => new DepotMikadoTopNavigationWalker()
                ));
            ?>
        </nav>
        <div class="mkd-vertical-area-top-widget-holder">
            <?php depot_mikado_get_header_vertical_widget_top_areas(); ?>
        </div>
    </div>
</div>
<?php do_action('depot_mikado_after_top_navigation'); ?>