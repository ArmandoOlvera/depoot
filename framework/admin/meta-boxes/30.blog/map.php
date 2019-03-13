<?php

if(!function_exists('depot_mikado_map_blog_meta')) {
    function depot_mikado_map_blog_meta() {
        $mkd_blog_categories = array();
        $categories = get_categories();
        foreach($categories as $category) {
            $mkd_blog_categories[$category->slug] = $category->name;
        }

        $blog_meta_box = depot_mikado_add_meta_box(
            array(
                'scope' => array('page'),
                'title' => esc_html__('Blog', 'depot'),
                'name' => 'blog_meta'
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_blog_category_meta',
                'type'        => 'selectblank',
                'label'       => esc_html__('Blog Category', 'depot'),
                'description' => esc_html__('Choose category of posts to display (leave empty to display all categories)', 'depot'),
                'parent'      => $blog_meta_box,
                'options'     => $mkd_blog_categories
            )
        );

        depot_mikado_add_meta_box_field(
            array(
                'name'        => 'mkd_show_posts_per_page_meta',
                'type'        => 'text',
                'label'       => esc_html__('Number of Posts', 'depot'),
                'description' => esc_html__('Enter the number of posts to display', 'depot'),
                'parent'      => $blog_meta_box,
                'options'     => $mkd_blog_categories,
                'args'        => array("col_width" => 3)
            )
        );

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_masonry_layout_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'depot'),
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'depot'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'depot'),
                'in-grid'   => esc_html__('In Grid', 'depot'),
                'full-width' => esc_html__('Full Width', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_masonry_number_of_columns_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Number of Columns', 'depot'),
            'description' => esc_html__('Set number of columns for your masonry blog lists', 'depot'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'depot'),
                'two'   => esc_html__('2 Columns', 'depot'),
                'three' => esc_html__('3 Columns', 'depot'),
                'four'  => esc_html__('4 Columns', 'depot'),
                'five'  => esc_html__('5 Columns', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_masonry_space_between_items_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Space Between Items', 'depot'),
            'description' => esc_html__('Set space size between posts for your masonry blog lists', 'depot'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''        => esc_html__('Default', 'depot'),
                'normal'  => esc_html__('Normal', 'depot'),
                'small'   => esc_html__('Small', 'depot'),
                'tiny'    => esc_html__('Tiny', 'depot'),
                'no'      => esc_html__('No Space', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_list_featured_image_proportion_meta',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'depot'),
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'depot'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''		   => esc_html__('Default', 'depot'),
                'fixed'    => esc_html__('Fixed', 'depot'),
                'original' => esc_html__('Original', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(array(
            'name'        => 'mkd_blog_pagination_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Pagination Type', 'depot'),
            'description' => esc_html__('Choose a pagination layout for Blog Lists', 'depot'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                => esc_html__('Default', 'depot'),
                'standard'		  => esc_html__('Standard', 'depot'),
                'load-more'		  => esc_html__('Load More', 'depot'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'depot'),
                'no-pagination'   => esc_html__('No Pagination', 'depot')
            )
        ));

        depot_mikado_add_meta_box_field(
            array(
                'type' => 'text',
                'name' => 'mkd_number_of_chars_meta',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Excerpt', 'depot'),
                'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'depot'),
                'parent' => $blog_meta_box,
                'args' => array(
                    'col_width' => 3
                )
            )
        );



    }

    add_action('depot_mikado_meta_boxes_map', 'depot_mikado_map_blog_meta', 30);
}