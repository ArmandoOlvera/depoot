<?php
$mkd_sidebar_layout = depot_mikado_sidebar_layout();

get_header();
depot_mikado_get_title();
?>
<div class="mkd-container">
    <?php do_action('depot_mikado_after_container_open'); ?>
    <div class="mkd-container-inner clearfix">
        <div class="mkd-container">
            <?php do_action('depot_mikado_after_container_open'); ?>
            <div class="mkd-container-inner">
	            <div class="mkd-grid-row">
		            <div <?php echo depot_mikado_get_content_sidebar_class(); ?>>
                        <div class="mkd-search-page-holder">
                            <form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-page-form" method="get">
                                <h2 class="mkd-search-title"><?php esc_html_e('Search results:', 'depot'); ?></h2>
                                <div class="mkd-form-holder">
                                    <div class="mkd-column-left">
                                        <input type="text" name="s" class="mkd-search-field" autocomplete="off" value="" placeholder="<?php esc_html_e('Type here', 'depot'); ?>"/>
                                    </div>
                                    <div class="mkd-column-right">
                                        <button type="submit" class="mkd-search-submit"><span class="icon_search"></span></button>
                                    </div>
                                </div>
                                <div class="mkd-search-label">
                                    <?php esc_html_e("If you are not happy with the results below please do another search", "depot"); ?>
                                </div>
                            </form>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="mkd-post-content">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="mkd-post-image">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="mkd-post-title-area <?php if (!has_post_thumbnail()) { echo esc_attr('mkd-no-thumbnail'); } ?>">
                                            <div class="mkd-post-title-area-inner">
                                                <h4 itemprop="name" class="mkd-post-title entry-title">
                                                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <?php
                                                $mkd_my_excerpt = get_the_excerpt();
                                                if ($mkd_my_excerpt != '') { ?>
                                                    <p itemprop="description" class="mkd-post-excerpt"><?php echo esc_html($mkd_my_excerpt); ?></p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <p class="mkd-blog-no-posts"><?php esc_html_e('No posts were found.', 'depot'); ?></p>
                            <?php endif; ?>
                            <?php
                                if ( get_query_var('paged') ) { $mkd_paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $mkd_paged = get_query_var('page'); }
                                else { $mkd_paged = 1; }

                                $mkd_params['max_num_pages'] = depot_mikado_get_max_number_of_pages();
                                $mkd_params['paged'] = $mkd_paged;
                                depot_mikado_get_module_template_part('templates/parts/pagination/standard', 'blog', '', $mkd_params);
                            ?>
                        </div>
                        <?php do_action('depot_mikado_page_after_content'); ?>
                    </div>
		            <?php if($mkd_sidebar_layout !== 'no-sidebar') { ?>
			            <div <?php echo depot_mikado_get_sidebar_holder_class(); ?>>
				            <?php get_sidebar(); ?>
			            </div>
		            <?php } ?>
                </div>
				<?php do_action('depot_mikado_before_container_close'); ?>
            </div>
        </div>
    </div>
    <?php do_action('depot_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>