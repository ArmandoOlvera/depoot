<li class="mkd-blog-slider-item">
    <div class="mkd-blog-slider-item-inner">
        <div class="mkd-item-image clearfix">
            <a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size); ?>
            </a>
        </div>
        <div class="mkd-item-text-wrapper">
            <div class="mkd-item-text-holder">
                <div class="mkd-item-text-holder-inner">
                    <?php if($post_info_date == 'yes' || $post_info_category == 'yes' || $post_info_author == 'yes' || $post_info_comments == 'yes'){ ?>
                        <div class="mkd-item-info-section">
                            <?php depot_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                            <?php depot_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params); ?>
                            <?php depot_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params); ?>
                            <?php depot_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                        </div>
                    <?php } ?>

                    <<?php echo esc_attr( $title_tag)?> itemprop="name" class="mkd-item-title entry-title">
                        <a itemprop="url" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>

                    <div class="mkd-section-button-holder">
                        <?php depot_mikado_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>