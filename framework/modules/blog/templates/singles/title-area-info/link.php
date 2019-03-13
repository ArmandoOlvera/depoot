<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-text-main">
                    <div class="mkd-post-mark">
                        <span class="fa fa-link mkd-link-mark"></span>
                    </div>
                    <?php depot_mikado_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mkd-post-additional-content">
        <?php the_content(); ?>
    </div>
    <div class="mkd-post-info-bottom clearfix">
        <?php depot_mikado_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
    </div>
</article>