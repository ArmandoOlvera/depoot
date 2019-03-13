<?php

if ( ! function_exists('depot_mikado_blog_options_map') ) {

	function depot_mikado_blog_options_map() {

		depot_mikado_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'depot'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = depot_mikado_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'depot')
			)
		);

		depot_mikado_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'depot'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'depot'),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'masonry'               => esc_html__('Blog: Masonry', 'depot'),
				'masonry-gallery'       => esc_html__('Blog: Masonry Gallery', 'depot'),
                'standard'              => esc_html__('Blog: Standard', 'depot'),
			)
		));

		depot_mikado_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'depot'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'depot'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
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
			depot_mikado_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'depot'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'depot'),
				'parent' => $panel_blog_lists,
				'options' => depot_mikado_get_custom_sidebars()
			));
		}

        depot_mikado_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'depot'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'depot'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'depot'),
                'full-width' => esc_html__('Full Width', 'depot')
            )
        ));
		
		depot_mikado_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'depot'),
			'default_value' => 'four',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'depot'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'depot'),
				'three' => esc_html__('3 Columns', 'depot'),
				'four'  => esc_html__('4 Columns', 'depot'),
				'five'  => esc_html__('5 Columns', 'depot')
			)
		));
		
		depot_mikado_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'depot'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'depot'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'depot'),
				'small'   => esc_html__('Small', 'depot'),
				'tiny'    => esc_html__('Tiny', 'depot'),
				'no'      => esc_html__('No Space', 'depot')
			)
		));

        depot_mikado_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'depot'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'depot'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'depot'),
                'original' => esc_html__('Original', 'depot')
            )
        ));

		depot_mikado_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'depot'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'depot'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'depot'),
				'load-more'		  => esc_html__('Load More', 'depot'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'depot'),
				'no-pagination'   => esc_html__('No Pagination', 'depot')
			)
		));
	
		depot_mikado_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'depot'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'depot'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = depot_mikado_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'depot')
			)
		);

        depot_mikado_add_admin_field(array(
            'name'        => 'blog_single_type',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'depot'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'depot'),
            'default_value' => 'standard',
            'parent'      => $panel_blog_single,
            'options'     => array(
                'standard'              => esc_html__('Standard', 'depot'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'depot'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'depot')
            )
        ));

		depot_mikado_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'depot'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'depot'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'depot'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'depot'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'depot'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'depot'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'depot'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'depot')
			)
		));

		if(count($depot_custom_sidebars) > 0) {
			depot_mikado_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'depot'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'depot'),
				'parent' => $panel_blog_single,
				'options' => depot_mikado_get_custom_sidebars()
			));
		}
		
		depot_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'depot'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'depot'),
				'parent'      => $panel_blog_single,
                'options' => array(
                    '' => esc_html__('Default', 'depot'),
                    'yes' => esc_html__('Yes', 'depot'),
                    'no' => esc_html__('No', 'depot')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		
		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'full_height_title_area_blog',
				'default_value' => 'no',
				'label'       => esc_html__('Full Height Title', 'depot'),
				'description' => esc_html__('Enabling this option will show standard title area in full height on single post pages', 'depot'),
				'parent'      => $panel_blog_single,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'depot'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'depot'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		depot_mikado_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'depot'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'depot'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		depot_mikado_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'depot'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'depot'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'depot'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'depot'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_mkd_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = depot_mikado_add_admin_container(
			array(
				'name' => 'mkd_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'depot'),
				'description' => esc_html__('Limit your navigation only through current category', 'depot'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'depot'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'depot'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_mkd_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = depot_mikado_add_admin_container(
			array(
				'name' => 'mkd_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'depot'),
				'description' => esc_html__('Enabling this option will show author email', 'depot'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		depot_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'depot'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'depot'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'depot_mikado_options_map', 'depot_mikado_blog_options_map', 9);
}