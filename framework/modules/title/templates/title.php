<?php do_action('depot_mikado_before_page_title'); ?>
<div class="mkd-title <?php echo depot_mikado_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
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
                        <?php switch ($type){
                            case 'standard': ?>
                                <?php if(depot_mikado_get_title_text() !== '') { ?>
                                    <<?php echo esc_attr($title_tag); ?> class="mkd-page-title entry-title" <?php depot_mikado_inline_style($title_color); ?>><span><?php depot_mikado_title_text(); ?></span></<?php echo esc_attr($title_tag); ?>>
                                <?php } ?>
                                <?php if($has_subtitle){ ?>
                                    <span class="mkd-subtitle" <?php depot_mikado_inline_style($subtitle_color); ?>><span><?php depot_mikado_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if($enable_breadcrumbs){ ?>
                                    <div class="mkd-breadcrumbs-holder"> <?php depot_mikado_custom_breadcrumbs(); ?></div>
                                <?php } ?>
                            <?php break;
                            case 'breadcrumb': ?>
                                <div class="mkd-breadcrumbs-holder"> <?php depot_mikado_custom_breadcrumbs(); ?></div>
                            <?php break;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php do_action('depot_mikado_after_page_title'); ?>
