<?php
if(!function_exists('depot_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function depot_mikado_design_styles() {
	    $font_family = depot_mikado_options()->getOptionValue('google_fonts');
	    if (!empty($font_family) && depot_mikado_is_font_option_valid($font_family)){
		    echo depot_mikado_dynamic_css('body', array('font-family' => depot_mikado_get_font_option_val($font_family)));
		}

		$first_main_color = depot_mikado_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
				'a',
				'a:hover',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'p a',
				'p a:hover',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'mark',
				'.mkd-comment-holder .mkd-comment-text .comment-edit-link:hover',
				'.mkd-comment-holder .mkd-comment-text .comment-reply-link:hover',
				'.mkd-comment-holder .mkd-comment-text .replay:hover',
				'.mkd-comment-holder .mkd-comment-text #cancel-comment-reply-link',
				'.mkd-comment-holder .mkd-comment-text #cancel-comment-reply-link:hover',
				'#respond input[type=text]',
				'#respond textarea',
				'.post-password-form input[type=password]',
				'#respond input[type=text]:focus',
				'#respond textarea:focus',
				'.post-password-form input[type=password]:focus',
				'.wpcf7-form-control.wpcf7-date:focus',
				'.wpcf7-form-control.wpcf7-number:focus',
				'.wpcf7-form-control.wpcf7-quiz:focus',
				'.wpcf7-form-control.wpcf7-select:focus',
				'.wpcf7-form-control.wpcf7-text:focus',
				'.wpcf7-form-control.wpcf7-textarea:focus',
				'.mkd-owl-slider .owl-nav .mkd-next-icon',
				'.mkd-owl-slider .owl-nav .mkd-prev-icon',
				'.mkd-404-page .mkd-page-not-found .mkd-icon-shortcode',
				'.mkd-main-menu>ul>li>a',
				'.mkd-header-vertical-closed .mkd-vertical-menu ul li a',
				'.mkd-header-vertical-closed .mkd-vertical-menu ul li a .mkd-menu-featured-icon',
				'.mkd-header-vertical-compact .mkd-vertical-menu .mkd-menu-featured-icon',
				'.mkd-header-vertical .mkd-vertical-menu ul li a',
				'.mkd-header-vertical .mkd-vertical-menu ul li a .mkd-menu-featured-icon',
				'.mkd-page-footer .widget div.mkd-widget-title-holder .mkd-widget-title',
				'.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover',
				'.mkd-search-opener',
				'.mkd-search-page-holder .mkd-search-page-form .mkd-form-holder .mkd-search-submit:hover',
				'.mkd-search-page-holder article.sticky .mkd-post-title-area h3 a',
				'.mkd-search-cover .mkd-search-close a:hover',
				'.mkd-fullscreen-search-holder .mkd-search-submit:hover',
				'.mkd-fullscreen-search-opened::-webkit-input-placeholder',
				'.mkd-fullscreen-search-opened:-moz-placeholder',
				'.mkd-fullscreen-search-opened::-moz-placeholder',
				'.mkd-fullscreen-search-opened:-ms-input-placeholder',
				'.mkd-blog-holder article.sticky .mkd-post-title a',
				'.mkd-blog-holder.mkd-blog-masonry article .mkd-post-read-more-button a i',
				'.mkd-blog-holder.mkd-blog-masonry article .mkd-post-info-bottom .mkd-post-info-author a:hover',
				'.mkd-blog-holder.mkd-blog-masonry article .mkd-post-info-bottom .mkd-blog-like:hover i:first-child',
				'.mkd-blog-holder.mkd-blog-masonry article .mkd-post-info-bottom .mkd-blog-like:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-masonry article .mkd-post-info-bottom .mkd-post-info-comments-holder:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-masonry article.format-link .mkd-post-mark .mkd-link-mark',
				'.mkd-blog-holder.mkd-blog-masonry article.format-quote .mkd-post-mark .mkd-quote-mark',
				'.mkd-blog-holder.mkd-blog-narrow article .mkd-post-info.mkd-section-bottom .mkd-post-info-author a:hover',
				'.mkd-blog-holder.mkd-blog-narrow article .mkd-post-info.mkd-section-bottom .mkd-blog-like:hover i:first-child',
				'.mkd-blog-holder.mkd-blog-narrow article .mkd-post-info.mkd-section-bottom .mkd-blog-like:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-narrow article .mkd-post-info.mkd-section-bottom .mkd-post-info-comments-holder:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-standard-date-on-side article .mkd-post-date-inner .mkd-post-date-day',
				'.mkd-blog-holder.mkd-blog-standard-date-on-side article .mkd-post-date-inner .mkd-post-date-month',
				'.mkd-blog-holder.mkd-blog-standard-date-on-side article .mkd-post-title a:hover',
				'.mkd-blog-holder.mkd-blog-standard-date-on-side article .mkd-post-info>div a:hover',
				'.mkd-blog-holder.mkd-blog-standard-date-on-side article.format-quote .mkd-quote-author',
				'.mkd-blog-holder.mkd-blog-standard article .mkd-post-info-bottom .mkd-post-info-author a:hover',
				'.mkd-blog-holder.mkd-blog-standard article .mkd-post-info-bottom .mkd-blog-like:hover i:first-child',
				'.mkd-blog-holder.mkd-blog-standard article .mkd-post-info-bottom .mkd-blog-like:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-standard article .mkd-post-info-bottom .mkd-post-info-comments-holder:hover span:first-child',
				'.mkd-blog-holder.mkd-blog-standard article.format-quote .mkd-post-mark .mkd-quote-mark',
				'.mkd-blog-holder.mkd-blog-standard article.format-quote .mkd-post-title a',
				'.mkd-author-description .mkd-author-description-text-holder .mkd-author-name a',
				'.mkd-author-description .mkd-author-description-text-holder .mkd-author-name a:hover',
				'.mkd-author-description .mkd-author-description-text-holder .mkd-author-social-icons a:hover',
				'.mkd-blog-pagination ul li a.mkd-pag-active',
				'.mkd-blog-pagination ul li a:hover',
				'.mkd-bl-standard-pagination ul li.mkd-bl-pag-active a',
				'.mkd-blog-pagination ul li.mkd-pag-first a:hover',
				'.mkd-blog-pagination ul li.mkd-pag-last a:hover',
				'.mkd-blog-pagination ul li.mkd-pag-next a:hover',
				'.mkd-blog-pagination ul li.mkd-pag-prev a:hover',
				'.mkd-blog-pag-loading',
				'.mkd-blog-single-navigation .mkd-blog-single-next:hover',
				'.mkd-blog-single-navigation .mkd-blog-single-prev:hover',
				'.mkd-blog-list-holder.mkd-bl-masonry .mkd-post-read-more-button a i',
				'.mkd-blog-list-holder.mkd-bl-standard .mkd-bli-excerpt .mkd-post-read-more-button a i',
				'.mkd-blog-slider-holder .owl-nav .owl-next:hover .mkd-next-icon',
				'.mkd-blog-slider-holder .owl-nav .owl-next:hover .mkd-prev-icon',
				'.mkd-blog-slider-holder .owl-nav .owl-prev:hover .mkd-next-icon',
				'.mkd-blog-slider-holder .owl-nav .owl-prev:hover .mkd-prev-icon',
				'.mkd-blog-slider-holder .owl-nav .mkd-next-icon',
				'.mkd-blog-slider-holder .owl-nav .mkd-prev-icon',
				'.mkd-blog-holder.mkd-blog-single.mkd-blog-single-standard article .mkd-post-info-top>div a:hover',
				'.mkd-blog-holder.mkd-blog-single.mkd-blog-single-standard article .mkd-post-info-bottom .mkd-post-info-bottom-left>div a:hover',
				'.mkd-blog-holder.mkd-blog-single.mkd-blog-single-standard article.format-quote .mkd-post-mark .mkd-quote-mark',
				'.mkd-blog-holder.mkd-blog-single.mkd-blog-single-standard article.format-quote .mkd-post-title',
				'.mkd-blog-single-title-area-empty article.format-link .mkd-post-mark .mkd-link-mark',
				'.mkd-blog-single-title-area-empty article.format-quote .mkd-post-mark .mkd-quote-mark',
				'.mkd-blog-single-title-area-empty article.format-quote .mkd-post-title',
				'.mkd-blog-single-title-area-info article.format-link .mkd-post-mark .mkd-link-mark',
				'.mkd-blog-single-title-area-info article.format-quote .mkd-post-mark .mkd-quote-mark',
				'.mkd-blog-single-title-area-info article.format-quote .mkd-post-title',
				'footer .widget ul li a:hover',
				'footer .widget #wp-calendar tfoot a:hover',
				'footer .widget.widget_search .input-holder button:hover',
				'footer .widget.widget_tag_cloud a:hover',
				'.mkd-side-menu .widget ul li a:hover',
				'.mkd-side-menu .widget #wp-calendar tfoot a:hover',
				'.mkd-side-menu .widget.widget_search .input-holder button:hover',
				'.mkd-side-menu .widget.widget_tag_cloud a:hover',
				'aside.mkd-sidebar div.widget div.mkd-widget-title-holder .mkd-widget-title',
				'.wpb_widgetised_column .widget ul li a',
				'aside.mkd-sidebar .widget ul li a',
				'.wpb_widgetised_column .widget #wp-calendar tfoot a',
				'aside.mkd-sidebar .widget #wp-calendar tfoot a',
				'.widget ul li a',
				'.widget #wp-calendar tfoot a',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-standard li .mkd-tweet-text a',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-standard li .mkd-tweet-text a:hover',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-standard li .mkd-tweet-text span',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-slider li .mkd-twitter-icon i',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-slider li .mkd-tweet-text a',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-slider li .mkd-tweet-text a:hover',
				'.widget.widget_mkd_twitter_widget .mkd-twitter-widget.mkd-twitter-slider li .mkd-tweet-text span',
				'body .pp_pic_holder #pp_full_res .pp_inline',
				'body .pp_pic_holder a.pp_arrow_next:hover',
				'body .pp_pic_holder a.pp_arrow_previous:hover',
				'body .pp_pic_holder a.pp_next:hover',
				'body .pp_pic_holder a.pp_previous:hover',
				'body .pp_pic_holder a.pp_close:hover',
				'.mkd-main-menu .menu-item-language .submenu-languages a:hover',
				'.mkd-accordion-holder span.mkd-title-holder',
				'.mkd-accordion-holder.mkd-ac-boxed.mkd-white-skin .mkd-title-holder.ui-state-active',
				'.mkd-accordion-holder.mkd-ac-boxed.mkd-white-skin .mkd-title-holder.ui-state-default.ui-state-hover',
				'blockquote .mkd-icon-quotations-holder',
				'blockquote .mkd-blockquote-text',
				'blockquote .mkd-blockquote-text span',
				'.mkd-btn.mkd-btn-outline',
				'.mkd-countdown .countdown-row .countdown-section .countdown-amount',
				'.mkd-countdown .countdown-row .countdown-section .countdown-period',
				'.mkd-countdown.mkd-dark-skin .countdown-row .countdown-section .countdown-amount',
				'.mkd-countdown.mkd-dark-skin .countdown-row .countdown-section .countdown-period',
				'.mkd-icon-list-holder .mkd-il-icon-holder>*',
				'.mkd-image-gallery .owl-nav .owl-next:hover .mkd-next-icon',
				'.mkd-image-gallery .owl-nav .owl-next:hover .mkd-prev-icon',
				'.mkd-image-gallery .owl-nav .owl-prev:hover .mkd-next-icon',
				'.mkd-image-gallery .owl-nav .owl-prev:hover .mkd-prev-icon',
				'.mkd-image-gallery .owl-nav .mkd-next-icon',
				'.mkd-image-gallery .owl-nav .mkd-prev-icon',
				'.mkd-item-showcase-holder .mkd-is-icon:hover .mkd-icon-element',
				'.mkd-message .mkd-message-inner a.mkd-close',
				'.mkd-pie-chart-holder .mkd-pc-percentage .mkd-pc-percent',
				'.mkd-price-item .mkd-pi-inner ul li:before',
				'.mkd-price-table .mkd-pt-inner ul li.mkd-pt-title-holder',
				'.mkd-price-table .mkd-pt-inner ul li.mkd-pt-title-holder .mkd-pt-title',
				'.mkd-price-table .mkd-pt-inner ul li.mkd-pt-subtitle-holder',
				'.mkd-price-table .mkd-pt-inner ul li.mkd-pt-content ul li:before',
				'.mkd-social-share-holder.mkd-list li a',
				'.mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown-opener .social_share',
				'.mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown-opener:hover',
				'.mkd-tabs.mkd-tabs-standard .mkd-tabs-nav li a',
				'.mkd-tabs.mkd-tabs-boxed .mkd-tabs-nav li a',
				'.mkd-tabs.mkd-tabs-simple .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs.mkd-tabs-simple .mkd-tabs-nav li.ui-state-hover a',
				'.mkd-tabs.mkd-tabs-vertical .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs.mkd-tabs-vertical .mkd-tabs-nav li.ui-state-hover a',
				'#multiscroll-nav ul li a.active:before',
				'#multiscroll-nav ul li a:hover:before',
				'.mkd-video-button-holder .mkd-video-button-play',
				'.mkd-pl-filter-holder ul li span',
				'.mkd-pl-standard-pagination ul li a:hover',
				'.mkd-pl-standard-pagination ul li.mkd-pl-pag-active a',
				'.mkd-pl-standard-pagination ul li.mkd-pl-pag-next a',
				'.mkd-pl-standard-pagination ul li.mkd-pl-pag-prev a',
				'.mkd-pl-loading',
				'.mkd-portfolio-slider-holder .owl-nav .owl-next:hover .mkd-next-icon',
				'.mkd-portfolio-slider-holder .owl-nav .owl-next:hover .mkd-prev-icon',
				'.mkd-portfolio-slider-holder .owl-nav .owl-prev:hover .mkd-next-icon',
				'.mkd-portfolio-slider-holder .owl-nav .owl-prev:hover .mkd-prev-icon',
				'.mkd-portfolio-slider-holder .owl-nav .mkd-next-icon',
				'.mkd-portfolio-slider-holder .owl-nav .mkd-prev-icon',
				'.mkd-portfolio-list-holder.mkd-pl-gallery-overlay article .mkd-pli-text .mkd-pli-category-holder a:hover',
				'.mkd-portfolio-single-holder.mkd-ps-gallery-layout .mkd-ps-social-info-holder .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-gallery-layout .mkd-ps-social-info-holder .mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-huge-images-layout .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-huge-images-layout .mkd-ps-info-item.mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-images-layout .mkd-ps-social-info-holder .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-images-layout .mkd-ps-social-info-holder .mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-masonry-layout .mkd-ps-social-info-holder .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-masonry-layout .mkd-ps-social-info-holder .mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-slider-layout .mkd-ps-social-info-holder .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-slider-layout .mkd-ps-social-info-holder .mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-small-gallery-layout .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-small-gallery-layout .mkd-ps-info-item.mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-small-images-layout .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-small-images-layout .mkd-ps-info-item.mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-small-masonry-layout .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-small-masonry-layout .mkd-ps-info-item.mkd-ps-social-share:before',
				'.mkd-portfolio-single-holder.mkd-ps-small-slider-layout .mkd-portfolio-single-likes a span',
				'.mkd-portfolio-single-holder.mkd-ps-small-slider-layout .mkd-ps-info-item.mkd-ps-social-share:before',
				'.mkd-ps-navigation .mkd-ps-next .mkd-single-nav-title-holder .mkd-single-nav-title',
				'.mkd-ps-navigation .mkd-ps-prev .mkd-single-nav-title-holder .mkd-single-nav-title',
				'.mkd-ps-navigation .mkd-ps-next a .mkd-ps-nav-mark',
				'.mkd-ps-navigation .mkd-ps-prev a .mkd-ps-nav-mark',
				'.mkd-testimonials-holder .owl-nav .owl-next:hover .mkd-next-icon',
				'.mkd-testimonials-holder .owl-nav .owl-next:hover .mkd-prev-icon',
				'.mkd-testimonials-holder .owl-nav .owl-prev:hover .mkd-next-icon',
				'.mkd-testimonials-holder .owl-nav .owl-prev:hover .mkd-prev-icon',
				'.mkd-testimonials-holder .owl-nav .mkd-next-icon',
				'.mkd-testimonials-holder .owl-nav .mkd-prev-icon',
				'.mkd-woocommerce-page.woocommerce-cart .woocommerce>form table.cart tr.cart_item td.product-remove a:hover',
				'.mkd-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions button[type=submit]',
				'.mkd-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions input[type=submit]',
				'.mkd-woocommerce-page.woocommerce-cart .cart-collaterals table th',
				'.mkd-woocommerce-page.woocommerce-cart .cart-collaterals tr.order-total td',
				'.mkd-woocommerce-page .cart-empty',
				'.mkd-woocommerce-page.woocommerce-order-received .woocommerce ul.order_details li strong',
				'.woocommerce .mkd-new-product',
				'.woocommerce .mkd-onsale',
				'.woocommerce .mkd-out-of-stock',
				'.mkd-woocommerce-page .woocommerce-error>a:hover',
				'.mkd-woocommerce-page .woocommerce-info>a:hover',
				'.mkd-woocommerce-page .woocommerce-message>a:hover',
				'.mkd-woocommerce-page .woocommerce-info .showcoupon:hover',
				'.woocommerce-pagination .page-numbers li a.current',
				'.woocommerce-pagination .page-numbers li a:hover',
				'.woocommerce-pagination .page-numbers li span.current',
				'.woocommerce-pagination .page-numbers li span:hover',
				'.mkd-woo-view-all-pagination a:hover',
				'.woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-minus:hover',
				'.woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-plus:hover',
				'div.woocommerce .mkd-quantity-buttons .mkd-quantity-minus:hover',
				'div.woocommerce .mkd-quantity-buttons .mkd-quantity-plus:hover',
				'.woocommerce-page .mkd-content label',
				'div.woocommerce label',
				'.select2-container .select2-choice:hover',
				'.select2-container .select2-choice:hover .select2-arrow',
				'.select2-drop .select2-results .select2-highlighted',
				'.mkd-woocommerce-page .mkd-content .variations .reset_variations',
				'.mkd-woocommerce-page .mkd-content table.group_table a:hover',
				'.mkd-woocommerce-page.woocommerce-account .mkd-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li.is-active a',
				'.mkd-woocommerce-page.woocommerce-account .mkd-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li:hover a',
				'.mkd-woocommerce-page.woocommerce-account .woocommerce form.edit-account fieldset>legend',
				'.mkd-woocommerce-page.woocommerce-account .woocommerce table.shop_table th',
				'.mkd-woocommerce-page.woocommerce-account .vc_row .woocommerce form.login p label:not(.inline)',
				'.mkd-content .woocommerce.add_to_cart_inline del',
				'.mkd-content .woocommerce.add_to_cart_inline ins',
				'.mkd-woo-single-page .mkd-single-product-summary div[itemprop=offers] .price',
				'.mkd-woo-single-page .mkd-single-product-summary .mkd-single-product-share-wish .mkd-woo-social-share-holder>span',
				'.mkd-woo-single-page .mkd-single-product-summary .product_meta>span',
				'.mkd-woo-single-page .mkd-single-product-summary .product_meta>span a:hover',
				'.mkd-woo-single-page .mkd-single-product-summary p.stock.in-stock',
				'.mkd-woo-single-page .mkd-single-product-summary p.stock.out-of-stock',
				'.mkd-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a:before',
				'.mkd-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a.active:after',
				'.mkd-shopping-cart-holder .mkd-header-cart .mkd-cart-icon-text',
				'.mkd-shopping-cart-holder .mkd-header-cart:hover',
				'.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-subtotal-holder>*',
				'.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-cart-description .mkd-cart-description-inner span',
				'.widget.woocommerce.widget_layered_nav ul li.chosen a',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .price_slider_amount button',
				'.widget.woocommerce.widget_products ul li .amount',
				'.widget.woocommerce.widget_recently_viewed_products ul li .amount',
				'.widget.woocommerce.widget_top_rated_products ul li .amount',
				'.widget.woocommerce.widget_product_search .woocommerce-product-search button:hover',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-white-skin',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-dark-skin:hover',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-image-outer .mkd-plc-image .mkd-plc-new-product',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-image-outer .mkd-plc-image .mkd-plc-onsale',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-image-outer .mkd-plc-image .mkd-plc-out-of-stock',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-excerpt',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-add-to-cart a:hover',
				'.mkd-pl-holder .mkd-prl-loading .mkd-prl-loading-msg',
				'.mkd-pl-holder .mkd-pl-categories ul li a.active',
				'.mkd-pl-holder .mkd-pl-categories ul li a:hover',
				'.mkd-pl-holder .mkd-pli .mkd-pli-excerpt',
				'.mkd-pl-holder .mkd-pli-inner .mkd-pli-image .mkd-pli-new-product',
				'.mkd-pl-holder .mkd-pli-inner .mkd-pli-image .mkd-pli-onsale',
				'.mkd-pl-holder .mkd-pli-inner .mkd-pli-image .mkd-pli-out-of-stock',
				'.mkd-pl-holder.mkd-info-below-image .mkd-pli .mkd-pli-text-wrapper .mkd-pli-add-to-cart a:hover',
				'.mkd-pl-holder.mkd-info-on-image:not(.mkd-product-info-light) .mkd-pli-category',
				'.mkd-pl-holder.mkd-info-on-image:not(.mkd-product-info-light) .mkd-pli-excerpt',
				'.mkd-pl-holder.mkd-info-on-image:not(.mkd-product-info-light) .mkd-pli-price',
				'.mkd-pl-holder.mkd-info-on-image:not(.mkd-product-info-light) .mkd-pli-rating',
				'.mkd-pl-holder.mkd-product-info-dark .mkd-pli-inner .mkd-pli-text-inner .mkd-pli-category',
				'.mkd-pl-holder.mkd-product-info-dark .mkd-pli-inner .mkd-pli-text-inner .mkd-pli-excerpt',
				'.mkd-pl-holder.mkd-product-info-dark .mkd-pli-inner .mkd-pli-text-inner .mkd-pli-price',
				'.mkd-pl-holder.mkd-product-info-dark .mkd-pli-inner .mkd-pli-text-inner .mkd-pli-rating',
				'.mkd-pl-holder.mkd-product-info-dark .mkd-pli-inner .mkd-pli-text-inner .mkd-pli-title',
				'#yith-quick-view-modal #yith-quick-view-content .summary .variations .reset_variations',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .variations .reset_variations',
				'#yith-quick-view-modal #yith-quick-view-content .summary table.group_table a:hover',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary table.group_table a:hover',
				'#yith-quick-view-modal #yith-quick-view-content .summary div[itemprop=offers] .price',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary div[itemprop=offers] .price',
				'#yith-quick-view-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
				'#yith-quick-view-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
				'#yith-quick-view-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .mkd-woo-social-share-holder>span',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .mkd-single-product-share-wish .mkd-woo-social-share-holder>span',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'#yith-quick-view-modal #yith-quick-view-content .summary p.stock.in-stock',
				'#yith-quick-view-modal #yith-quick-view-content .summary p.stock.out-of-stock',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.in-stock',
				'.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.out-of-stock',
				'#yith-quick-view-modal #yith-quick-view-close',
				'.yith-quick-view.yith-modal #yith-quick-view-close',
				'.woocommerce table.wishlist_table tbody tr td.product-remove a:hover',
				'.woocommerce table.wishlist_table tbody tr td.product-add-to-cart a',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
				'.mkd-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after',
				'.mkd-wishlist-widget-holder a'
            );

	        $color_important_selector = array(
				'.mkd-fullscreen-menu-opener.mkd-fm-opened',
				'.mkd-fullscreen-menu-opener:hover',
				'.mkd-btn.mkd-btn-simple:not(.mkd-btn-custom-hover-color):hover'
	        );

            $background_color_selector = array(
				'.mkd-st-loader .pulse',
				'.mkd-st-loader .double_pulse .double-bounce1',
				'.mkd-st-loader .double_pulse .double-bounce2',
				'.mkd-st-loader .cube',
				'.mkd-st-loader .rotating_cubes .cube1',
				'.mkd-st-loader .rotating_cubes .cube2',
				'.mkd-st-loader .stripes>div',
				'.mkd-st-loader .wave>div',
				'.mkd-st-loader .two_rotating_circles .dot1',
				'.mkd-st-loader .two_rotating_circles .dot2',
				'.mkd-st-loader .five_rotating_circles .container1>div',
				'.mkd-st-loader .five_rotating_circles .container2>div',
				'.mkd-st-loader .five_rotating_circles .container3>div',
				'.mkd-st-loader .lines .line1',
				'.mkd-st-loader .lines .line2',
				'.mkd-st-loader .lines .line3',
				'.mkd-st-loader .lines .line4',
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkd-owl-slider .owl-dots .owl-dot.active span',
				'.mkd-owl-slider .owl-dots .owl-dot:hover span',
				'#mkd-back-to-top>span',
				'.mkd-header-vertical-closed .mkd-vertical-menu-area .mkd-vertical-area-opener .mkd-vertical-area-opener-line',
				'.mkd-header-vertical-closed .mkd-vertical-menu-area .mkd-vertical-area-opener .mkd-vertical-area-opener-line:before',
				'.mkd-header-vertical-closed .mkd-vertical-menu-area .mkd-vertical-area-opener .mkd-vertical-area-opener-line:after',
				'.mkd-mobile-header .mkd-mobile-menu-opener a .mkd-mo-lines .mkd-mo-line',
				'.mkd-page-footer .mkd-footer-bottom-holder',
				'.mkd-page-footer .mkd-footer-top-holder',
				'.mkd-blog-holder article.format-audio .mkd-blog-audio-holder .mejs-container',
				'.mkd-blog-holder article.format-audio .mkd-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
				'.mkd-blog-holder article.format-audio .mkd-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.mkd-blog-pag-loading>div',
				'.mkd-bl-loading>div',
				'.mkd-blog-slider-holder .owl-dots .owl-dot.active span',
				'.mkd-blog-slider-holder .owl-dots .owl-dot:hover span',
				'.widget.mkd-image-slider-widget .owl-dots .owl-dot.active span',
				'body .pp_overlay',
				'.mkd-page-footer .widget_icl_lang_sel_widget #lang_sel ul ul',
				'.mkd-page-footer .widget_icl_lang_sel_widget #lang_sel_click ul ul',
				'.mkd-top-bar .widget_icl_lang_sel_widget #lang_sel ul ul',
				'.mkd-top-bar .widget_icl_lang_sel_widget #lang_sel_click ul ul',
				'.mkd-accordion-holder.mkd-ac-boxed .mkd-title-holder.ui-state-active',
				'.mkd-accordion-holder.mkd-ac-boxed .mkd-title-holder.ui-state-hover',
				'.mkd-btn.mkd-btn-solid',
				'.mkd-dropcaps.mkd-circle',
				'.mkd-dropcaps.mkd-square',
				'.mkd-image-gallery .owl-dots .owl-dot.active span',
				'.mkd-image-gallery .owl-dots .owl-dot:hover span',
				'.mkd-message',
				'.mkd-mobile-slider-holder .mkd-ms-inner .owl-dots .owl-dot span',
				'.mkd-progress-bar.mkd-progress-bar-dark .mkd-pb-content-holder .mkd-pb-content',
				'.mkd-progress-bar.mkd-progress-bar-default .mkd-pb-content-holder .mkd-pb-content',
				'.mkd-tabs.mkd-tabs-standard .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs.mkd-tabs-standard .mkd-tabs-nav li.ui-state-hover a',
				'.mkd-tabs.mkd-tabs-boxed .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs.mkd-tabs-boxed .mkd-tabs-nav li.ui-state-hover a',
				'#multiscroll-nav ul li a.active',
				'#multiscroll-nav ul li a:hover',
				'.mkd-masonry-gallery-holder .mkd-mg-item.mkd-mg-simple.mkd-mg-skin-dark .mkd-mg-item-inner',
				'.mkd-pl-loading>div',
				'.mkd-portfolio-slider-holder .owl-dots .owl-dot.active span',
				'.mkd-portfolio-slider-holder .owl-dots .owl-dot:hover span',
				'.mkd-team-slider-holder .mkd-tl-inner .owl-dots .owl-dot.active span',
				'.mkd-team-slider-holder .mkd-tl-inner .owl-dots .owl-dot:hover span',
				'.mkd-testimonials-holder .owl-dots .owl-dot.active span',
				'.mkd-testimonials-holder .owl-dots .owl-dot:hover span',
				'.mkd-woocommerce-page.woocommerce-cart .cart-collaterals .woocommerce-shipping-calculator button:hover',
				'.woocommerce-page .mkd-content a.added_to_cart .wc-forward:not(.added_to_cart):not(.checkout-button)',
				'.woocommerce-page .mkd-content a.button',
				'.woocommerce-page .mkd-content button[type=submit]',
				'.woocommerce-page .mkd-content input[type=submit]',
				'div.woocommerce a.added_to_cart .wc-forward:not(.added_to_cart):not(.checkout-button)',
				'div.woocommerce a.button',
				'div.woocommerce button[type=submit]',
				'div.woocommerce input[type=submit]',
				'div.woocommerce>.single-product .woocommerce-tabs ul.tabs>li.active a',
				'div.woocommerce>.single-product .woocommerce-tabs ul.tabs>li.active a:after',
				'.mkd-woo-single-page .woocommerce-tabs ul.tabs>li.active a',
				'.mkd-woo-single-page .woocommerce-tabs ul.tabs>li.active a:after',
				'.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-view-cart',
				'.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-view-cart:hover',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
				'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-dark-skin',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-white-skin:hover',
				'.mkd-pl-holder .mkd-pli-inner .mkd-pli-text-inner .mkd-yith-wcqv-holder .yith-wcqv-button',
				'.mkd-plc-holder .mkd-plc-item .mkd-plc-text-inner .mkd-yith-wcqv-holder .yith-wcqv-button',
				'ul.products>.product .mkd-pl-inner .mkd-pl-text-inner .mkd-yith-wcqv-holder .yith-wcqv-button',
				'.mkd-st-loader .mitosis .ball',
				'.mkd-st-loader .fussion .ball',
				'.mkd-st-loader .fussion .ball-1',
				'.mkd-st-loader .fussion .ball-2',
				'.mkd-st-loader .fussion .ball-3',
				'.mkd-st-loader .fussion .ball-4',
				'.mkd-st-loader .wave_circles .ball',
				'.mkd-st-loader .pulse_circles .ball',
				'.mkd-header-vertical-compact .mkd-vertical-menu>ul>li:hover'
            );

            $border_color_selector = array(
				'.mkd-st-loader .pulse_circles .ball',
				'.mkd-owl-slider .owl-dots .owl-dot.active span',
				'.mkd-owl-slider .owl-dots .owl-dot:hover span',
				'#mkd-back-to-top>span',
				'.mkd-search-page-holder .mkd-search-page-form .mkd-form-holder .mkd-search-field:focus',
				'.mkd-blog-slider-holder .owl-dots .owl-dot.active span',
				'.mkd-blog-slider-holder .owl-dots .owl-dot:hover span',
				'.mkd-accordion-holder.mkd-ac-boxed .mkd-title-holder.ui-state-active',
				'.mkd-image-gallery .owl-dots .owl-dot.active span',
				'.mkd-image-gallery .owl-dots .owl-dot:hover span',
				'.mkd-message',
				'.mkd-mobile-slider-holder .mkd-ms-inner .owl-dots .owl-dot span',
				'.mkd-tabs.mkd-tabs-standard .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs.mkd-tabs-standard .mkd-tabs-nav li.ui-state-hover a',
				'.mkd-portfolio-slider-holder .owl-dots .owl-dot.active span',
				'.mkd-portfolio-slider-holder .owl-dots .owl-dot:hover span',
				'.mkd-team-slider-holder .mkd-tl-inner .owl-dots .owl-dot.active span',
				'.mkd-team-slider-holder .mkd-tl-inner .owl-dots .owl-dot:hover span',
				'.mkd-testimonials-holder .owl-dots .owl-dot.active span',
				'.mkd-testimonials-holder .owl-dots .owl-dot:hover span',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-dark-skin',
				'.mkd-product-info .mkd-pi-add-to-cart .mkd-btn.mkd-btn-solid.mkd-white-skin:hover',
				'.mkd-blog-holder article.format-audio .mkd-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-float .mejs-time-float-corner'
            );

            echo depot_mikado_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo depot_mikado_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo depot_mikado_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo depot_mikado_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }

        $page_background_color = depot_mikado_options()->getOptionValue('page_background_color');
		if (!empty($page_background_color)) {
			$background_color_selector = array(
				'.mkd-wrapper-inner',
				'.mkd-content'
			);
			echo depot_mikado_dynamic_css($background_color_selector, array('background-color' => $page_background_color));
		}

		$selection_color = depot_mikado_options()->getOptionValue('selection_color');
		if (!empty($selection_color)) {
			echo depot_mikado_dynamic_css('::selection', array('background' => $selection_color));
			echo depot_mikado_dynamic_css('::-moz-selection', array('background' => $selection_color));
		}

		$boxed_background_style = array();
	    $boxed_page_background_color = depot_mikado_options()->getOptionValue('page_background_color_in_box');
		if (!empty($boxed_page_background_color)) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
	
	    $boxed_page_background_image = depot_mikado_options()->getOptionValue('boxed_background_image');
		if (!empty($boxed_page_background_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_image).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}
	
	    $boxed_page_background_pattern_image = depot_mikado_options()->getOptionValue('boxed_pattern_background_image');
		if (!empty($boxed_page_background_pattern_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_pattern_image).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}
	
	    $boxed_page_background_attachment = depot_mikado_options()->getOptionValue('boxed_background_image_attachment');
		if (!empty($boxed_page_background_attachment)) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		echo depot_mikado_dynamic_css('.mkd-boxed .mkd-wrapper', $boxed_background_style);

        $paspartu_style = array();
	    $paspartu_color = depot_mikado_options()->getOptionValue('paspartu_color');
        if (!empty($paspartu_color)) {
            $paspartu_style['background-color'] = $paspartu_color;
        }
	
	    $paspartu_width = depot_mikado_options()->getOptionValue('paspartu_width');
        if ($paspartu_width !== '') {
            $paspartu_style['padding'] = $paspartu_width.'%';
        }

        echo depot_mikado_dynamic_css('.mkd-paspartu-enabled .mkd-wrapper', $paspartu_style);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_design_styles');
}

if(!function_exists('depot_mikado_content_styles')) {
    /**
     * Generates content custom styles
     */
    function depot_mikado_content_styles() {
        $content_style = array();
	    
	    $padding_top = depot_mikado_options()->getOptionValue('content_top_padding');
	    if ($padding_top !== '') {
            $content_style['padding-top'] = depot_mikado_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );

        echo depot_mikado_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
	    
	    $padding_top_in_grid = depot_mikado_options()->getOptionValue('content_top_padding_in_grid');
	    if ($padding_top_in_grid !== '') {
            $content_style_in_grid['padding-top'] = depot_mikado_filter_px($padding_top_in_grid).'px';
        }

        $content_selector_in_grid = array(
            '.mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
        );

        echo depot_mikado_dynamic_css($content_selector_in_grid, $content_style_in_grid);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_content_styles');
}

if (!function_exists('depot_mikado_h1_styles')) {

    function depot_mikado_h1_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h1_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h1_margin_bottom');
	    
	    $item_styles = depot_mikado_get_typography_styles('h1');
	    
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	    
	    $item_selector = array(
		    'h1'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h1_styles');
}

if (!function_exists('depot_mikado_h2_styles')) {

    function depot_mikado_h2_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h2_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h2_margin_bottom');
	
	    $item_styles = depot_mikado_get_typography_styles('h2');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h2'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h2_styles');
}

if (!function_exists('depot_mikado_h3_styles')) {

    function depot_mikado_h3_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h3_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h3_margin_bottom');
	
	    $item_styles = depot_mikado_get_typography_styles('h3');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h3'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h3_styles');
}

if (!function_exists('depot_mikado_h4_styles')) {

    function depot_mikado_h4_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h4_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h4_margin_bottom');
	
	    $item_styles = depot_mikado_get_typography_styles('h4');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h4'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h4_styles');
}

if (!function_exists('depot_mikado_h5_styles')) {

    function depot_mikado_h5_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h5_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h5_margin_bottom');
	
	    $item_styles = depot_mikado_get_typography_styles('h5');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h5'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h5_styles');
}

if (!function_exists('depot_mikado_h6_styles')) {

    function depot_mikado_h6_styles() {
	    $margin_top = depot_mikado_options()->getOptionValue('h6_margin_top');
	    $margin_bottom = depot_mikado_options()->getOptionValue('h6_margin_bottom');
	
	    $item_styles = depot_mikado_get_typography_styles('h6');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = depot_mikado_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = depot_mikado_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h6'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_h6_styles');
}

if (!function_exists('depot_mikado_text_styles')) {

    function depot_mikado_text_styles() {
	    $item_styles = depot_mikado_get_typography_styles('text');
	
	    $item_selector = array(
		    'p'
	    );
	
	    echo depot_mikado_dynamic_css($item_selector, $item_styles);
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_text_styles');
}

if (!function_exists('depot_mikado_link_styles')) {

    function depot_mikado_link_styles() {
        $link_styles = array();

        if(depot_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = depot_mikado_options()->getOptionValue('link_color');
        }
        if(depot_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = depot_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(depot_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = depot_mikado_options()->getOptionValue('link_fontweight');
        }
        if(depot_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = depot_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo depot_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_link_styles');
}

if (!function_exists('depot_mikado_link_hover_styles')) {

    function depot_mikado_link_hover_styles() {
        $link_hover_styles = array();

        if(depot_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = depot_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(depot_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = depot_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo depot_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(depot_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = depot_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo depot_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('depot_mikado_style_dynamic', 'depot_mikado_link_hover_styles');
}

if (!function_exists('depot_mikado_smooth_page_transition_styles')) {

	function depot_mikado_smooth_page_transition_styles($style) {
		$id = depot_mikado_get_page_id();
		$loader_style = array();
		$current_style = '';

		if(depot_mikado_get_meta_field_intersect('smooth_pt_bgnd_color',$id) !== '') {
			$loader_style['background-color'] = depot_mikado_get_meta_field_intersect('smooth_pt_bgnd_color',$id);
		}

		$loader_selector = array('.mkd-smooth-transition-loader');

		if (!empty($loader_style)) {
			$current_style .= depot_mikado_dynamic_css($loader_selector, $loader_style);
		}

		$spinner_style = array();

		if(depot_mikado_get_meta_field_intersect('smooth_pt_spinner_color',$id) !== '') {
			$spinner_style['background-color'] = depot_mikado_get_meta_field_intersect('smooth_pt_spinner_color',$id);
		}

		$spinner_selectors = array(
			'.mkd-st-loader .mkd-rotate-circles > div',
			'.mkd-st-loader .pulse',
			'.mkd-st-loader .double_pulse .double-bounce1',
			'.mkd-st-loader .double_pulse .double-bounce2',
			'.mkd-st-loader .cube',
			'.mkd-st-loader .rotating_cubes .cube1',
			'.mkd-st-loader .rotating_cubes .cube2',
			'.mkd-st-loader .stripes > div',
			'.mkd-st-loader .wave > div',
			'.mkd-st-loader .two_rotating_circles .dot1',
			'.mkd-st-loader .two_rotating_circles .dot2',
			'.mkd-st-loader .five_rotating_circles .container1 > div',
			'.mkd-st-loader .five_rotating_circles .container2 > div',
			'.mkd-st-loader .five_rotating_circles .container3 > div',
			'.mkd-st-loader .atom .ball-1:before',
			'.mkd-st-loader .atom .ball-2:before',
			'.mkd-st-loader .atom .ball-3:before',
			'.mkd-st-loader .atom .ball-4:before',
			'.mkd-st-loader .clock .ball:before',
			'.mkd-st-loader .mitosis .ball',
			'.mkd-st-loader .lines .line1',
			'.mkd-st-loader .lines .line2',
			'.mkd-st-loader .lines .line3',
			'.mkd-st-loader .lines .line4',
			'.mkd-st-loader .fussion .ball',
			'.mkd-st-loader .fussion .ball-1',
			'.mkd-st-loader .fussion .ball-2',
			'.mkd-st-loader .fussion .ball-3',
			'.mkd-st-loader .fussion .ball-4',
			'.mkd-st-loader .wave_circles .ball',
			'.mkd-st-loader .pulse_circles .ball'
		);

		if (!empty($spinner_style)) {
			$current_style .= depot_mikado_dynamic_css($spinner_selectors, $spinner_style);
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('depot_mikado_add_page_custom_style', 'depot_mikado_smooth_page_transition_styles');
}