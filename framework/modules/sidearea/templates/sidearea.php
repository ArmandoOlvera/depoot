<section class="mkd-side-menu">
    <div class="mkd-side-area-inner">
        <div class="mkd-close-side-menu-holder">
            <a class="mkd-close-side-menu" href="#" target="_self">
                <span class="icon-arrows-remove"></span>
            </a>
        </div>
        <?php if(is_active_sidebar('sidearea')) {
            dynamic_sidebar('sidearea');
        } ?>
    </div>
    <div class="mkd-side-area-bottom">
        <?php if(is_active_sidebar('sideareabottom')) {
            dynamic_sidebar('sideareabottom');
        } ?>
    </div>
</section>