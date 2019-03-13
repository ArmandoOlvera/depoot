<?php if($show_category_filter == 'yes'){ ?>
<div class="mkd-pl-categories">
    <h6 class="mkd-pl-categories-label"><?php esc_html_e('Categories','depot'); ?></h6>
	<ul>
        <?php print $categories_filter_list; ?>
    </ul>
</div>
<?php } ?>