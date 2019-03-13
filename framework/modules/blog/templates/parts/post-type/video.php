<?php
$video_type = get_post_meta( get_the_ID(), "mkd_video_type_meta", true );
$has_video_link = get_post_meta(get_the_ID(), "mkd_post_video_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "mkd_post_video_link_meta", true) !== '';
?>
<?php if($has_video_link) { ?>
<div class="mkd-blog-video-holder">
    <?php
    if ( $video_type == 'social_networks' ) {
        $videolink = get_post_meta( get_the_ID(), "mkd_post_video_link_meta", true );
        $embed     = wp_oembed_get( $videolink );
        print $embed;
    } else if ( $video_type == 'self' ) { ?>
        <div class="mkd-self-hosted-video-holder">
            <div class="mkd-video-wrap">
                <video class="mkd-self-hosted-video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" preload="auto">
                    <?php if(($meta_temp_mp4 = get_post_meta(get_the_ID(), "mkd_post_video_custom_meta", true)) != "") { ?> <source type="video/mp4" src="<?php echo esc_url($meta_temp_mp4);  ?>"> <?php } ?>
                    <object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/assets/js/flashmediaelement.swf'); ?>">
                        <param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/assets/js/flashmediaelement.swf'); ?>" />
                        <param name="flashvars" value="controls=true&file=<?php echo esc_url($meta_temp_mp4);  ?>" />
                        <img itemprop="image" src="<?php echo esc_url($meta_temp_image);  ?>" width="1920" height="800" title="<?php esc_attr_e('No video playback capabilities', 'depot'); ?>" alt="<?php esc_html_e('video thumb','depot'); ?>" />
                    </object>
                </video>
            </div>
        </div>
    <?php } ?>
</div>
<?php } ?>