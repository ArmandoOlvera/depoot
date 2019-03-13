<?php do_action('depot_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <div class="mkd-title <?php echo depot_mikado_title_classes(array(), $module); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <?php if(!empty($title_background_image_src)) { ?>
            <div class="mkd-title-image">
                <img itemprop="image" src="<?php echo esc_url($title_background_image_src); ?>" alt="<?php esc_html_e('Title Image', 'depot'); ?>" />
            </div>
        <?php } ?>
        <div class="mkd-title-holder" <?php depot_mikado_inline_style($title_holder_height); ?>>
            <div class="mkd-container clearfix">
                <div class="mkd-container-inner">
                    <div class="mkd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="mkd-title-subtitle-holder-inner">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php do_action('depot_mikado_after_page_title'); ?>