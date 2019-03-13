<div class="mkd-blog-slider-holder">
    <ul class="mkd-blog-slider mkd-owl-slider" <?php echo depot_mikado_get_inline_attrs($slider_data); ?>>
        <?php
            if($query_result->have_posts()):
                while ($query_result->have_posts()) : $query_result->the_post();
                    depot_mikado_get_module_template_part('shortcodes/blog-slider/layout-collections/blog-slide', 'blog', '', $params);
                endwhile;
            else: ?>
                <div class="mkd-blog-slider-messsage">
                    <p><?php esc_html_e('No posts were found.', 'depot'); ?></p>
                </div>
            <?php endif;

            wp_reset_postdata();
        ?>
    </ul>
</div>
