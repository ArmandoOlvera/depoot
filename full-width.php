<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$mkd_sidebar_layout  = depot_mikado_sidebar_layout();

get_header();
depot_mikado_get_title();
get_template_part('slider');
?>
<div class="mkd-full-width">
	<div class="mkd-full-width-inner">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="mkd-grid-row">
				<div <?php echo depot_mikado_get_content_sidebar_class(); ?>>
					<?php
					the_content();
					do_action('depot_mikado_page_after_content');
					?>
				</div>
				<?php if($mkd_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo depot_mikado_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>