<?php

//top header bar
add_action('depot_mikado_before_page_header', 'depot_mikado_get_header_top');

//mobile header
add_action('depot_mikado_after_page_header', 'depot_mikado_get_mobile_header');