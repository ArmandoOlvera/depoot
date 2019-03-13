<?php

if (!function_exists('depot_mikado_social_options_map')) {

    function depot_mikado_social_options_map() {

        depot_mikado_add_admin_page(
            array(
                'slug' => '_social_page',
                'title' => esc_html__('Social Networks', 'depot'),
                'icon' => 'fa fa-share-alt'
            )
        );

        /**
         * Enable Social Share
         */
        $panel_social_share = depot_mikado_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_share',
            'title' => esc_html__('Enable Social Share', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Social Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow social share on networks of your choice', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_social_networks, #mkd_panel_show_social_share_on'
            ),
            'parent' => $panel_social_share
        ));

        $panel_show_social_share_on = depot_mikado_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_show_social_share_on',
            'title' => esc_html__('Show Social Share On', 'depot'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_post',
            'default_value' => 'no',
            'label' => esc_html__('Posts', 'depot'),
            'description' => esc_html__('Show Social Share on Blog Posts', 'depot'),
            'parent' => $panel_show_social_share_on
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_page',
            'default_value' => 'no',
            'label' => esc_html__('Pages', 'depot'),
            'description' => esc_html__('Show Social Share on Pages', 'depot'),
            'parent' => $panel_show_social_share_on
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_portfolio-item',
            'default_value' => 'no',
            'label' => esc_html__('Portfolio Item', 'depot'),
            'description' => esc_html__('Show Social Share for Portfolio Items', 'depot'),
            'parent' => $panel_show_social_share_on
        ));

        if (depot_mikado_is_woocommerce_installed()) {
            depot_mikado_add_admin_field(array(
                'type' => 'yesno',
                'name' => 'enable_social_share_on_product',
                'default_value' => 'no',
                'label' => esc_html__('Product', 'depot'),
                'description' => esc_html__('Show Social Share for Product Items', 'depot'),
                'parent' => $panel_show_social_share_on
            ));
        }

        /**
         * Social Share Networks
         */
        $panel_social_networks = depot_mikado_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_networks',
            'title' => esc_html__('Social Networks', 'depot'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        /**
         * Facebook
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'facebook_title',
            'title' => esc_html__('Share on Facebook', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_facebook_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via Facebook', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_facebook_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_facebook_share_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_facebook_share_container',
            'hidden_property' => 'enable_facebook_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'facebook_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_facebook_share_container
        ));

        /**
         * Twitter
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'twitter_title',
            'title' => esc_html__('Share on Twitter', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_twitter_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via Twitter', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_twitter_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_twitter_share_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_twitter_share_container',
            'hidden_property' => 'enable_twitter_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'twitter_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_twitter_share_container
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'text',
            'name' => 'twitter_via',
            'default_value' => '',
            'label' => esc_html__('Via', 'depot'),
            'parent' => $enable_twitter_share_container
        ));

        /**
         * Google Plus
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'google_plus_title',
            'title' => esc_html__('Share on Google Plus', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_google_plus_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via Google Plus', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_google_plus_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_google_plus_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_google_plus_container',
            'hidden_property' => 'enable_google_plus_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'google_plus_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_google_plus_container
        ));

        /**
         * Linked In
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'linkedin_title',
            'title' => esc_html__('Share on LinkedIn', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_linkedin_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via LinkedIn', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_linkedin_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_linkedin_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_linkedin_container',
            'hidden_property' => 'enable_linkedin_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'linkedin_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_linkedin_container
        ));

        /**
         * Tumblr
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'tumblr_title',
            'title' => esc_html__('Share on Tumblr', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_tumblr_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via Tumblr', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_tumblr_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_tumblr_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_tumblr_container',
            'hidden_property' => 'enable_tumblr_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'tumblr_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_tumblr_container
        ));

        /**
         * Pinterest
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'pinterest_title',
            'title' => esc_html__('Share on Pinterest', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_pinterest_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via Pinterest', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_pinterest_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_pinterest_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_pinterest_container',
            'hidden_property' => 'enable_pinterest_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'pinterest_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_pinterest_container
        ));

        /**
         * VK
         */
        depot_mikado_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'vk_title',
            'title' => esc_html__('Share on VK', 'depot')
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_vk_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'depot'),
            'description' => esc_html__('Enabling this option will allow sharing via VK', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_vk_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_vk_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_vk_container',
            'hidden_property' => 'enable_vk_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'vk_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'depot'),
            'parent' => $enable_vk_container
        ));

        if (defined('MIKADO_TWITTER_FEED_VERSION')) {
            $twitter_panel = depot_mikado_add_admin_panel(array(
                'title' => esc_html__('Twitter', 'depot'),
                'name' => 'panel_twitter',
                'page' => '_social_page'
            ));

            depot_mikado_add_admin_twitter_button(array(
                'name' => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if (defined('MIKADO_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = depot_mikado_add_admin_panel(array(
                'title' => esc_html__('Instagram', 'depot'),
                'name' => 'panel_instagram',
                'page' => '_social_page'
            ));

            depot_mikado_add_admin_instagram_button(array(
                'name' => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }

        /**
         * Open Graph
         */
        $panel_open_graph = depot_mikado_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_open_graph',
            'title' => esc_html__('Open Graph', 'depot'),
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_open_graph',
            'default_value' => 'no',
            'label' => esc_html__('Enable Open Graph', 'depot'),
            'description' => esc_html__('Enabling this option will allow usage of Open Graph protocol on your site', 'depot'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_open_graph_container'
            ),
            'parent' => $panel_open_graph
        ));

        $enable_open_graph_container = depot_mikado_add_admin_container(array(
            'name' => 'enable_open_graph_container',
            'hidden_property' => 'enable_open_graph',
            'hidden_value' => 'no',
            'parent' => $panel_open_graph
        ));

        depot_mikado_add_admin_field(array(
            'type' => 'image',
            'name' => 'open_graph_image',
            'default_value' => MIKADO_ASSETS_ROOT . '/img/open_graph.jpg',
            'label' => esc_html__('Default Share Image', 'depot'),
            'parent' => $enable_open_graph_container,
            'description' => esc_html('Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'depot'),
        ));

    }

    add_action('depot_mikado_options_map', 'depot_mikado_social_options_map', 11);
}