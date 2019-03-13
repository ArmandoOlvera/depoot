<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="mkd-tags-holder">
    <div class="mkd-tags">
        <?php the_tags('', ' ', ''); ?>
    </div>
</div>
<?php } ?>