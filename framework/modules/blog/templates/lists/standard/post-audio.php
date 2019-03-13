<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-heading">
            <?php depot_mikado_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
            <?php depot_mikado_get_module_template_part('templates/parts/post-type/audio', 'blog', '', $part_params); ?>
        </div>
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-info-top">
                    <?php depot_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="mkd-post-text-main">
                    <?php depot_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php depot_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('depot_mikado_single_link_pages'); ?>
                </div>
                <div class="mkd-post-info-bottom clearfix">
                    <div class="mkd-post-info-bottom-left">
                        <?php depot_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                        <?php depot_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                        <?php depot_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    </div>
                    <div class="mkd-post-info-bottom-right">
                        <?php depot_mikado_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>