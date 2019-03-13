<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
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
</article>