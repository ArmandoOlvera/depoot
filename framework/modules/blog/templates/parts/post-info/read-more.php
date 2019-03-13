<div class="mkd-post-read-more-button">
<?php
    if(depot_mikado_core_plugin_installed()) {
        echo depot_mikado_get_button_html(
            apply_filters(
                'depot_mikado_blog_template_read_more_button',
                array(
                    'type' => 'simple',
                    'size' => 'medium',
                    'link' => get_the_permalink(),
                    'text' => esc_html__('Learn more', 'depot'),
                    'custom_class' => 'mkd-blog-list-button',
                    'icon_pack' => 'linear_icons',
                    'linear_icon' => 'lnr-arrow-right'
                )
            )
        );
    } else { ?>
        <a itemprop="url" href="<?php echo esc_attr(get_the_permalink()); ?>" target="_self" class="mkd-btn mkd-btn-medium mkd-btn-simple mkd-blog-list-button">
            <span class="mkd-btn-text">
                <?php echo esc_html__('Learn more', 'depot'); ?>
            </span>
        </a>
<?php } ?>
</div>
