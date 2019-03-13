<?php
	$attachment_meta = depot_mikado_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

	if(!empty($logo_image_dark)) {
		$attachment_meta_dark = depot_mikado_get_attachment_meta_from_url($logo_image_dark);
		$hwstring_dark = !empty($attachment_meta_dark) ? image_hwstring($attachment_meta_dark['width'], $attachment_meta_dark['height']) : '';
	}

	if(!empty($logo_image_light)) {
		$attachment_meta_light = depot_mikado_get_attachment_meta_from_url( $logo_image_light );
		$hwstring_light = !empty($attachment_meta_light) ? image_hwstring($attachment_meta_light['width'], $attachment_meta_light['height']) : '';
	}
?>

<?php do_action('depot_mikado_before_site_logo'); ?>

<div class="mkd-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php depot_mikado_inline_style($logo_styles); ?>>
        <img itemprop="image" class="mkd-normal-logo" src="<?php echo esc_url($logo_image); ?>" <?php print $hwstring; ?> alt="<?php esc_html_e('logo','depot'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img itemprop="image" class="mkd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" <?php print $hwstring_dark; ?> alt="<?php esc_html_e('dark logo','depot'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img itemprop="image" class="mkd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" <?php print $hwstring_light; ?> alt="<?php esc_html_e('light logo','depot'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('depot_mikado_after_site_logo'); ?>