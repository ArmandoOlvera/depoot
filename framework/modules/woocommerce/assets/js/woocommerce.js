(function($) {
    'use strict';

    var woocommerce = {};
    mkd.modules.woocommerce = woocommerce;

    woocommerce.mkdOnDocumentReady = mkdOnDocumentReady;
    woocommerce.mkdOnWindowLoad = mkdOnWindowLoad;
    woocommerce.mkdOnWindowResize = mkdOnWindowResize;
    woocommerce.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdInitQuantityButtons();
        mkdInitSelect2();
        mkdInitSingleProductLightbox();
	    mkdInitSingleProductImageSwitchLogic();
        mkdInitProductListFilter().init();
        mkdWishlistRefresh().init();
        mkdQuickViewGallery().init();
        mkdQuickViewSelect2();
        mkdAddingToCart();
        mkdAddingToWishlist();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
        mkdInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {}
    
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function mkdInitQuantityButtons() {
    
        $(document).on( 'click', '.mkd-quantity-minus, .mkd-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function mkdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }

        $(mkd.body).on('updated_shipping_method',function(){
            $('#calc_shipping_country').select2();
        });

        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }

        if($('.mkd-woo-single-page .variations select').length) {
            $('.mkd-woo-single-page .variations select').select2();
        }
    }

    /*
     ** Init Product Single Pretty Photo attributes
     */
    function mkdInitSingleProductLightbox() {
        var item = $('.mkd-woo-single-page .mkd-single-product-content .images .woocommerce-product-gallery__image');

        if(item.length) {
            item.each(function() {
                var thisItem = $(this).children('a');

                thisItem.attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

                if (typeof mkd.modules.common.mkdPrettyPhoto === "function") {
                    mkd.modules.common.mkdPrettyPhoto();
                }
            });
        }
    }

	/*
	 ** Init switch image logic for thumbnail and featured images on product single page
	 */
	function mkdInitSingleProductImageSwitchLogic() {
		if(mkd.body.hasClass('mkd-woo-single-switch-image')){
			
			var thumbnailImage = $('.mkd-woo-single-page .product .images .thumbnails > a'),
				featuredImage = $('.mkd-woo-single-page .product .images .woocommerce-main-image');
			
			if(featuredImage.length) {
				featuredImage.on('click', function() {
					if($('div.pp_overlay').length) {
						$.prettyPhoto.close();
					}
					if(mkd.body.hasClass('mkd-disable-thumbnail-prettyphoto')){
						mkd.body.removeClass('mkd-disable-thumbnail-prettyphoto');
					}
					if(featuredImage.children('.mkd-fake-featured-image').length){
						$('.mkd-fake-featured-image').stop().animate({'opacity': '0'}, 300, function() {
							$(this).remove();
						});
					}
				});
			}
			
			if(thumbnailImage.length) {
				thumbnailImage.each(function(){
					var thisThumbnailImage = $(this),
						thisThumbnailImageSrc = thisThumbnailImage.attr('href');
					
					thisThumbnailImage.on('click', function() {
						if(!mkd.body.hasClass('mkd-disable-thumbnail-prettyphoto')){
							mkd.body.addClass('mkd-disable-thumbnail-prettyphoto');
						}
						
						if($('div.pp_overlay').length) {
							$.prettyPhoto.close();
						}
						if(thisThumbnailImageSrc !== '' && featuredImage !== '') {
							if (featuredImage.children('.mkd-fake-featured-image').length) {
								$('.mkd-fake-featured-image').remove();
							}
							featuredImage.append('<img itemprop="image" class="mkd-fake-featured-image" src="' + thisThumbnailImageSrc + '" />');
						}
					});
				});
			}
		}
	}

    /*
     ** Init Product List Masonry Image Sizes
     */
    function mkdProductImageSizes(thisContainer) {

        var size = thisContainer.find('.mkd-pl-sizer').width();

        var defaultMasonryItem = thisContainer.find('.mkd-woo-image-normal-width');
        var largeWidthMasonryItem = thisContainer.find('.mkd-woo-image-large-width');
        var largeHeightMasonryItem = thisContainer.find('.mkd-woo-image-large-height');
        var largeWidthHeightMasonryItem = thisContainer.find('.mkd-woo-image-large-width-height');

        if(thisContainer.find('.mkd-landscape-size').length){
            size = size * 0.8;
        }
        defaultMasonryItem.css('height', size);

        if (mkd.windowWidth > 600) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }

	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function mkdInitProductListMasonryShortcode() {
		var container = $('.mkd-pl-holder.mkd-masonry-layout .mkd-pl-outer');

		if(container.length) {
			container.each(function(){
				var thisContainer = $(this);

                mkdProductImageSizes(thisContainer);
				thisContainer.waitForImages(function() {
					thisContainer.isotope({
						itemSelector: '.mkd-pli',
						resizable: false,
                        layoutMode: 'packery',
						masonry: {
							columnWidth: '.mkd-pl-sizer',
							gutter: '.mkd-pl-gutter'
						}
					});
					
					thisContainer.isotope('layout');
					
					thisContainer.css('opacity', 1);
				});
			});
		}
	}

	function mkdInitProductListFilter(){
		var productList = $('.mkd-pl-holder');
		var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.mkd-pl-categories a, .mkd-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
		}

		//used for replacing content after ajax call
        var mkdReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var mkdReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.mkd-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            mkdProductImageSizes(thisProductListInner);
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var mkdReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

		var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.mkd-pl-outer');

            var loadData = mkd.modules.common.getLoadMoreData(thisProductList),
				loader = thisProductList.find('.mkd-prl-loading');

            //store parameters in global object
            mkdReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

            loader.fadeIn();

            var ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadData, 'mkd_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: MikadoAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

					thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('mkd-masonry-layout')) {
                            mkdReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            mkdReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        mkdAddingToCart();
                        mkdAddingToWishlist();
					});

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(mkd.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }
		
        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.mkd-pl-ordering-outer h6'), thisProductList.find('.mkd-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.mkd-pl-categories-label'),thisProductList.find('.mkd-pl-categories-label').next('ul'));
                    });
                }
            },

        }
	}

    function mkdWishlistRefresh() {

        var initRefreshWishlist = function(){
            $.ajax({
                url: MikadoAjaxUrl,
                type: "POST",
                data: {
                    'action' : 'mkd_product_ajax_wishlist'
                },
                success:function(data) {


                    $('.mkd-wishlist-widget-holder .mkd-wishlist-items-number span').html(data['wishlist_count_products']);
                }
            });
        }

        return {
            init: function () {
                //trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
                $('body').on('added_to_wishlist',function(){
                    initRefreshWishlist();
                });

                //after product is removed from wishlist list
                $('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
                    setTimeout(function() {
                        initRefreshWishlist();
                    }, 2000);
                });
            }

        }

    }

    function mkdQuickViewGallery() {

        var initGallery = function(){
            var sliders = $('.mkd-quick-view-gallery.mkd-owl-slider');

            if (sliders.length) {
                sliders.each(function(){
                    var slider = $(this);
                    slider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: false,
                        smartSpeed: 600,
                        margin: 0,
                        center: false,
                        autoWidth: false,
                        animateIn : false,
                        animateOut : false,
                        dots: false,
                        nav: true,
                        navText: [
                            '<span class="mkd-prev-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                            '<span class="mkd-next-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-right"></span></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        }
                    });
                });
            }
        }

        return {
            init: function () {
                //trigger defined in yith-woocommerce-quick-view\assets\js\frontend.js, after quick view is returned
                $(document).on('qv_loader_stop',function(){
                    initGallery();

                    $('.yith-wcqv-wrapper').css('top', mkd.scroll+20); //positioning popup on screens smaller than ipad portrait
                });
            }
        }
    }

    function mkdQuickViewSelect2() {
        $(document).on('qv_loader_stop',function(){
            $('#yith-quick-view-modal select').select2();
        });
    }

    function mkdAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.click(function(){
                $(this).text(mkdGlobalVars.vars.mkdAddingToCartLabel);
            });
        }
    }

    function mkdAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.click(function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.mkd-pli').length) {
                    wishlistItem = wishlistButton.closest('.mkd-pli');            // product list shortcode
                } else if (wishlistButton.closest('.mkd-plc-item').length) {  
                    wishlistItem = wishlistButton.closest('.mkd-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('mkd-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('mkd-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('mkd-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('mkd-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

})(jQuery);