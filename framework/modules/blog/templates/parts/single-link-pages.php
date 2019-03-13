<?php
$args_pages = array(
    'before'           => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
    'after'            => '</div></div>',
    'link_before'      => '<span>'. esc_html__('Page ', 'depot'),
    'link_after'       => '</span>',
    'pagelink'         => '%'
);

wp_link_pages($args_pages);