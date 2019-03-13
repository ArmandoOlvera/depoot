<?php
	$attachment_meta = depot_mikado_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';
?>

<?php do_action('depot_mikado_before_mobile_logo'); ?>

<div class="mkd-mobile-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php depot_mikado_inline_style($logo_styles); ?>>
        <img itemprop="image" src="<?php echo esc_url($logo_image); ?>" <?php print $hwstring; ?> alt="<?php esc_html_e('mobile logo','depot'); ?>"/>
    </a>
</div>

<?php do_action('depot_mikado_after_mobile_logo'); ?>