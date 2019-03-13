<li class="mkd-bl-item clearfix">
	<div class="mkd-bli-inner">
        <?php depot_mikado_get_module_template_part('templates/parts/image', 'blog', '', $params); ?>

        <div class="mkd-bli-content">
            <?php if ($post_info_date == 'yes') { ?>
                <?php depot_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
            <?php } ?>
            <?php depot_mikado_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
            <?php
            if($post_info_section == 'yes') { ?>
                <div class="mkd-bli-info">
                    <?php
                    if ($post_info_category == 'yes') {
                        depot_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
                    }
                    if ($post_info_author == 'yes') {
                        depot_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
                    }
                    if ($post_info_comments == 'yes') {
                        depot_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $params);
                    }
                    if ($post_info_like == 'yes') {
                        depot_mikado_get_module_template_part('templates/parts/post-info/like', 'blog', '', $params);
                    }
                    if ($post_info_share == 'yes') {
                        depot_mikado_get_module_template_part('templates/parts/post-info/share', 'blog', '', $params);
                    }
                    ?>
                </div>
            <?php } ?>
            <div class="mkd-bli-excerpt">
                <?php depot_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $params); ?>
                <?php depot_mikado_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
            </div>
        </div>
	</div>
</li>