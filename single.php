<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php
        $mkd_blog_single_type = depot_mikado_get_meta_field_intersect('blog_single_type');
        depot_mikado_include_blog_helper_functions('singles', $mkd_blog_single_type);
		//Action added for applying module specific filters that couldn't be applied on init
		do_action('depot_mikado_blog_single_loaded');
        $mkd_holder_params = depot_mikado_get_holder_params_blog();

        $module_title = isset($mkd_holder_params['module_title']) ? $mkd_holder_params['module_title'] : false;
        $module_title_layout = isset($mkd_holder_params['module_title_layout']) ? $mkd_holder_params['module_title_layout'] : "";
        ?>

        <?php depot_mikado_get_title($module_title, 'blog', $module_title_layout); ?>
            <?php get_template_part('slider'); ?>
            <div class="<?php echo esc_attr($mkd_holder_params['holder']); ?>">
                <?php do_action('depot_mikado_after_container_open'); ?>
                <div class="<?php echo esc_attr($mkd_holder_params['inner']); ?>">
                    <?php depot_mikado_get_blog_single($mkd_blog_single_type); ?>
                </div>
            <?php do_action('depot_mikado_before_container_close'); ?>
            </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>