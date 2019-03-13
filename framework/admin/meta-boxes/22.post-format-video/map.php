<?php

if(!function_exists('depot_mikado_map_post_video_meta')) {
    function depot_mikado_map_post_video_meta() {
        $video_post_format_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Video Post Format', 'depot'),
                'name' 	=> 'post_format_video_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_video_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Video Type', 'depot'),
                'description' => esc_html__('Choose video type', 'depot'),
                'parent'      => $video_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Video Service', 'depot'),
                    'self' => esc_html__('Self Hosted', 'depot')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#mkd_mkd_video_self_hosted_container',
                        'self' => '#mkd_mkd_video_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#mkd_mkd_video_embedded_container',
                        'self' => '#mkd_mkd_video_self_hosted_container')
                )
            )
        );

        $mkd_video_embedded_container = depot_mikado_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'mkd_video_embedded_container',
                'hidden_property' => 'mkd_video_type_meta',
                'hidden_value' => 'self'
            )
        );

        $mkd_video_self_hosted_container = depot_mikado_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'mkd_video_self_hosted_container',
                'hidden_property' => 'mkd_video_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_post_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video URL', 'depot'),
                'description' => esc_html__('Enter Video URL', 'depot'),
                'parent'      => $mkd_video_embedded_container,
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_post_video_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video MP4', 'depot'),
                'description' => esc_html__('Enter video URL for MP4 format', 'depot'),
                'parent'      => $mkd_video_self_hosted_container,
            )
        );
    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_post_video_meta', 22);
}