<aside class="mkd-sidebar">
    <?php
        $mkd_sidebar = depot_mikado_get_sidebar();
    
        if (is_active_sidebar($mkd_sidebar)) {
            dynamic_sidebar($mkd_sidebar);
        }
    ?>
</aside>