<?php
    /*
    	Template Name: Blog: Masonry
    */
?>
<?php
$mkd_blog_type = 'masonry';
depot_mikado_include_blog_helper_functions('lists', $mkd_blog_type);
$mkd_holder_params = depot_mikado_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php depot_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="<?php echo esc_attr($mkd_holder_params['holder']); ?>">
        <?php do_action('depot_mikado_after_container_open'); ?>
        <div class="<?php echo esc_attr($mkd_holder_params['inner']); ?>">
	        <?php depot_mikado_get_blog($mkd_blog_type); ?>
	    </div>
	    <?php do_action('depot_mikado_before_container_close'); ?>
	</div>
	<?php do_action('depot_mikado_blog_list_additional_tags'); ?>
<?php get_footer(); ?>