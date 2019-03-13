<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-heading">
            <?php depot_mikado_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-text-main">
                    <?php the_content(); ?>
                    <?php do_action('depot_mikado_single_link_pages'); ?>
                </div>
                <div class="mkd-post-info-bottom clearfix">
                    <?php depot_mikado_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>