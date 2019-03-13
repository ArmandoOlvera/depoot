<?php
$image_proportion = depot_mikado_get_meta_field_intersect('blog_list_featured_image_proportion', depot_mikado_get_page_id());
$image_proportion_value = get_post_meta(get_the_ID(), 'mkd_blog_masonry_gallery_' . $image_proportion .'_dimensions_meta', true);

if (isset($image_proportion_value) && $image_proportion_value !== '') {
    $size = $image_proportion_value !== '' ? $image_proportion_value : 'default';
    $post_classes[] = 'mkd-post-size-'. $size;
}
else {
    $size = 'default';
    $post_classes[] = 'mkd-post-size-default';
}
if($image_proportion == 'original') {
    $part_params['featured_image_size'] = 'full';
}
else {
    switch ($size):
        case 'default':
            $part_params['featured_image_size'] = 'depot_square';
            break;
        case 'large-width':
            $part_params['featured_image_size'] = 'depot_landscape';
            break;
        case 'large-height':
            $part_params['featured_image_size'] = 'depot_portrait';
            break;
        case 'large-width-height':
            $part_params['featured_image_size'] = 'depot_huge';
            break;
        default:
            $part_params['featured_image_size'] = 'depot_square';
            break;
    endswitch;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkd-post-content">
        <?php depot_mikado_get_module_template_part('templates/parts/image', 'blog', '', $part_params); ?>
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-info">
                    <?php depot_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php depot_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <?php depot_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <?php depot_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                <div class="mkd-post-info">
                    <?php depot_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
        <a itemprop="url" class="mkd-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
    </div>
</article>