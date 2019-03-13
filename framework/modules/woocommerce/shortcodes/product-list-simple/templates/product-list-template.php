<div class="mkd-pls-holder <?php echo esc_attr($holder_classes) ?>">
    <ul class="mkd-pls-inner">
        <?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
            <li class="mkd-pls-item">
                <div class="mkd-pls-image">
                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php depot_mikado_get_module_template_part('templates/parts/image-simple', 'woocommerce', '', $params); ?>
                    </a>    
                </div>
                <div class="mkd-pls-text">
                    <?php depot_mikado_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
    
                    <?php depot_mikado_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
    
                    <?php depot_mikado_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
                </div>
            </li>
        <?php endwhile; else: ?>
            <li class="mkd-pls-messsage">
                <?php depot_mikado_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params); ?>
            </li>
        <?php endif;
            wp_reset_postdata();
        ?>
    </ul>
</div>