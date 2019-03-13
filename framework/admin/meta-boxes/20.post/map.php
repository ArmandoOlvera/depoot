<?php

/*** Post Settings ***/

if(!function_exists('depot_mikado_map_post_meta')) {
    function depot_mikado_map_post_meta() {

        $post_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Post', 'depot'),
                'name' => 'post-meta'
            )
        );

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_single_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'depot'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'depot'),
            'default_value' => 'standard',
            'parent'      => $post_meta_box,
            'options'     => array(
                ''		                => esc_html__('Default', 'depot'),
                'standard'              => esc_html__('Standard', 'depot'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'depot'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'depot')
            )
        ));
	
	    depot_mikado_add_meta_box_field(array(
		    'name'        => 'mkd_blog_single_sidebar_layout_meta',
		    'type'        => 'select',
		    'label'       => esc_html__('Sidebar Layout', 'depot'),
		    'description' => esc_html__('Choose a sidebar layout for Blog single page', 'depot'),
		    'default_value'	=> '',
		    'parent'      => $post_meta_box,
		    'options'     => array(
			    ''		            => esc_html__('Default', 'depot'),
			    'no-sidebar'		=> esc_html__('No Sidebar', 'depot'),
			    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'depot'),
			    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'depot'),
			    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'depot'),
			    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'depot')
		    )
	    ));
	
	    $depot_custom_sidebars = depot_mikado_get_custom_sidebars();
	    if(count($depot_custom_sidebars) > 0) {
		    depot_mikado_add_meta_box_field(array(
			    'name' => 'mkd_blog_single_custom_sidebar_area_meta',
			    'type' => 'selectblank',
			    'label' => esc_html__('Sidebar to Display', 'depot'),
			    'description' => esc_html__('Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'depot'),
			    'parent' => $post_meta_box,
			    'options' => depot_mikado_get_custom_sidebars()
		    ));
	    }

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_blog_list_featured_image_meta',
                'type' => 'image',
                'label' => esc_html__('Blog List Image', 'depot'),
                'description' => esc_html__('Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'depot'),
                'parent' => $post_meta_box
            )
        );

        depot_mikado_add_meta_box_field(array(
            'name' => 'mkd_blog_masonry_gallery_fixed_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Fixed Proportion', 'depot'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in fixed proportion', 'depot'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'depot'),
                'large-width' => esc_html__('Large Width', 'depot'),
                'large-height' => esc_html__('Large Height', 'depot'),
                'large-width-height' => esc_html__('Large Width/Height', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name' => 'mkd_blog_masonry_gallery_original_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Original Proportion', 'depot'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in original proportion', 'depot'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'depot'),
                'large-width' => esc_html__('Large Width', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_show_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'depot'),
                'description' => esc_html__('Enabling this option will show title area on your single post page', 'depot'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'yes' => esc_html__('Yes', 'depot'),
                    'no' => esc_html__('No', 'depot')
                )
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_full_height_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Full Height Title', 'depot'),
                'description' => esc_html__('Enabling this option will show title area in full height on your single post page standard title', 'depot'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'yes' => esc_html__('Yes', 'depot'),
                    'no' => esc_html__('No', 'depot')
                )
            )
        );
    }
    
    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_post_meta', 20);
}
