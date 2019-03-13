<?php
$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
$excerpt = depot_mikado_excerpt($excerpt_length);
?>
<?php if($excerpt !== '') { ?>
    <div class="mkd-post-excerpt-holder">
        <p itemprop="description" class="mkd-post-excerpt">
            <?php echo wp_kses_post($excerpt); ?>
        </p>
    </div>
<?php } ?>
