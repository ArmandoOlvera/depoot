<form role="search" method="get" class="searchform" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="s"><?php esc_html_e('Search for:', 'depot'); ?></label>
    <div class="input-holder clearfix">
        <input type="search" class="search-field" placeholder="<?php esc_html_e('Enter your keyword...', 'depot'); ?>" value="" name="s" title="<?php esc_html_e('Search for:', 'depot'); ?>"/>
        <button type="submit" id="searchsubmit"><span class="icon_search"></span></button>
    </div>
</form>