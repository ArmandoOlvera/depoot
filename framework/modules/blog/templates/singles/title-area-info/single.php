<?php

depot_mikado_get_single_post_format_html($blog_single_type);

depot_mikado_get_module_template_part('templates/parts/single/author-info', 'blog');

depot_mikado_get_module_template_part('templates/parts/single/single-navigation', 'blog');

depot_mikado_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

depot_mikado_get_module_template_part('templates/parts/single/comments', 'blog');