<?php

if (!function_exists('depot_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function depot_mikado_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'depot'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'depot'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkd-widget-title-holder"><h5 class="mkd-widget-title">',
            'after_title' => '</h5></div>'
        ));
    }

    add_action('widgets_init', 'depot_mikado_register_sidebars', 1);
}

if (!function_exists('depot_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates DepotMikadoSidebar object
     */
    function depot_mikado_add_support_custom_sidebar() {
        add_theme_support('DepotMikadoSidebar');
        if (get_theme_support('DepotMikadoSidebar')) new DepotMikadoSidebar();
    }

    add_action('after_setup_theme', 'depot_mikado_add_support_custom_sidebar');
}