(function($) {
    "use strict";

    window.mkd = {};
    mkd.modules = {};

    mkd.scroll = 0;
    mkd.window = $(window);
    mkd.document = $(document);
    mkd.windowWidth = $(window).width();
    mkd.windowHeight = $(window).height();
    mkd.body = $('body');
    mkd.html = $('html, body');
    mkd.htmlEl = $('html');
    mkd.menuDropdownHeightSet = false;
    mkd.defaultHeaderStyle = '';
    mkd.minVideoWidth = 1500;
    mkd.videoWidthOriginal = 1280;
    mkd.videoHeightOriginal = 720;
    mkd.videoRatio = 1.61;

    mkd.mkdOnDocumentReady = mkdOnDocumentReady;
    mkd.mkdOnWindowLoad = mkdOnWindowLoad;
    mkd.mkdOnWindowResize = mkdOnWindowResize;
    mkd.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(mkd.body.hasClass('mkd-dark-header')){ mkd.defaultHeaderStyle = 'mkd-dark-header';}
        if(mkd.body.hasClass('mkd-light-header')){ mkd.defaultHeaderStyle = 'mkd-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkd.windowWidth = $(window).width();
        mkd.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
        mkd.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case mkd.body.hasClass('mkd-grid-1300'):
            mkd.boxedLayoutWidth = 1350;
            break;
        case mkd.body.hasClass('mkd-grid-1200'):
            mkd.boxedLayoutWidth = 1250;
            break;
        case mkd.body.hasClass('mkd-grid-1000'):
            mkd.boxedLayoutWidth = 1050;
            break;
        case mkd.body.hasClass('mkd-grid-800'):
            mkd.boxedLayoutWidth = 850;
            break;
        default :
            mkd.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    mkd.modules.common = common;

    common.mkdFluidVideo = mkdFluidVideo;
    common.mkdEnableScroll = mkdEnableScroll;
    common.mkdDisableScroll = mkdDisableScroll;
    common.mkdOwlSlider = mkdOwlSlider;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.mkdPrettyPhoto = mkdPrettyPhoto;

    common.mkdOnDocumentReady = mkdOnDocumentReady;
    common.mkdOnWindowLoad = mkdOnWindowLoad;
    common.mkdOnWindowResize = mkdOnWindowResize;
    common.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
	    mkdIconWithHover().init();
	    mkdIEversion();
	    mkdInitAnchor().init();
	    mkdInitBackToTop();
	    mkdBackButtonShowHide();
	    mkdInitSelfHostedVideoPlayer();
	    mkdSelfHostedVideoSize();
	    mkdFluidVideo();
	    mkdOwlSlider();
	    mkdPreloadBackgrounds();
	    mkdPrettyPhoto();
        mkdInitCustomMenuDropdown();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
        mkdSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
        
    }
	
	/*
	 * IE version
	 */
	function mkdIEversion() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");
		
		if (msie > 0) {
			var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
			mkd.body.addClass('mkd-ms-ie'+version);
		}
		return false;
	}
	
	function mkdDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', mkdWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = mkdWheel;
		document.onkeydown = mkdKeydown;
	}
	
	function mkdEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', mkdWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function mkdWheel(e) {
		mkdPreventDefaultValue(e);
	}
	
	function mkdKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				mkdPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function mkdPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var mkdInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			
			$('.mkd-main-menu .mkd-active-item, .mkd-mobile-nav .mkd-active-item, .mkd-fullscreen-menu .mkd-active-item').removeClass('mkd-active-item');
			anchor.parent().addClass('mkd-active-item');
			
			$('.mkd-main-menu a, .mkd-mobile-nav a, .mkd-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			
			$('[data-mkd-anchor]').waypoint( function(direction) {
				if(direction === 'down') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
				}
			}, { offset: '50%' });
			
			$('[data-mkd-anchor]').waypoint( function(direction) {
				if(direction === 'up') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-mkd-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function($this) {
			var scrollAmount;
			var anchor = $('a');
			var hash = $this;
			if(hash !== "" && $('[data-mkd-anchor="' + hash + '"]').length > 0 ) {
				var anchoredElementOffset = $('[data-mkd-anchor="' + hash + '"]').offset().top;
				scrollAmount = $('[data-mkd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - mkdGlobalVars.vars.mkdAddForAdminBar;
				
				setActiveState(anchor);
				
				mkd.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function() {
					//change hash tag in url
					if(history.pushState) { history.pushState(null, null, '#'+hash); }
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offest
		 */
		var headerHeihtToSubtract = function(anchoredElementOffset){
			
			if(mkd.modules.header.behaviour === 'mkd-sticky-header-on-scroll-down-up') {
				mkd.modules.header.isStickyVisible = (anchoredElementOffset > mkd.modules.header.stickyAppearAmount);
			}
			
			if(mkd.modules.header.behaviour === 'mkd-sticky-header-on-scroll-up') {
				if((anchoredElementOffset > mkd.scroll)){
					mkd.modules.header.isStickyVisible = false;
				}
			}
			
			var headerHeight = mkd.modules.header.isStickyVisible ? mkdGlobalVars.vars.mkdStickyHeaderTransparencyHeight : mkdPerPageVars.vars.mkdHeaderTransparencyHeight;
			
			if(mkd.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function() {
			mkd.document.on("click", ".mkd-main-menu a, .mkd-fullscreen-menu a, .mkd-btn, .mkd-anchor, .mkd-mobile-nav a", function() {
				var scrollAmount;
				var anchor = $(this);
				var hash = anchor.prop("hash").split('#')[1];
				
				if(hash !== "" && $('[data-mkd-anchor="' + hash + '"]').length > 0 ) {
					
					var anchoredElementOffset = $('[data-mkd-anchor="' + hash + '"]').offset().top;
					scrollAmount = $('[data-mkd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - mkdGlobalVars.vars.mkdAddForAdminBar;
					
					setActiveState(anchor);
					
					mkd.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function() {
						//change hash tag in url
						if(history.pushState) { history.pushState(null, null, '#'+hash); }
					});
					return false;
				}
			});
		};
		
		return {
			init: function() {
				if($('[data-mkd-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function() { checkActiveStateOnLoad(); });
				}
			}
		};
	};
	
	function mkdInitBackToTop(){
		var backToTopButton = $('#mkd-back-to-top');
		backToTopButton.on('click',function(e){
			e.preventDefault();
			mkd.html.animate({scrollTop: 0}, mkd.window.scrollTop()/3, 'linear');
		});
	}
	
	function mkdBackButtonShowHide(){
		mkd.window.scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { mkdToTopButton('off'); } else { mkdToTopButton('on'); }
		});
	}
	
	function mkdToTopButton(a) {
		var b = $("#mkd-back-to-top");
		b.removeClass('off on');
		if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
	}
	
	function mkdInitSelfHostedVideoPlayer() {
		var players = $('.mkd-self-hosted-video');
		
		if(players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function mkdSelfHostedVideoSize(){
		var selfVideoHolder = $('.mkd-self-hosted-video-holder .mkd-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.mkd-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / mkd.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function mkdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function mkdSmoothTransition() {

        if (mkd.body.hasClass('mkd-smooth-page-transitions')) {

            //check for preload animation
            if (mkd.body.hasClass('mkd-smooth-page-transitions-preloader')) {
                var loader = $('body > .mkd-smooth-transition-loader.mkd-mimic-ajax');
                loader.fadeOut(500);
                $(window).bind("pageshow", function (event) {
                    if (event.originalEvent.persisted) {
                        loader.fadeOut(500);
                    }
                });
            }

            //check for fade out animation
            if(mkd.body.hasClass('mkd-smooth-page-transitions-fadeout')) {
                $('a').click(function (e) {
                    var a = $(this);

                    if ((a.parents('.mkd-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove') || a.hasClass('mkd-no-smooth-transitions')) {
                        return;
                    }

                    if (
                        e.which == 1 && // check if the left mouse button has been pressed
                        a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                        (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                        (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                        (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                    ) {
                        e.preventDefault();
                        $('.mkd-wrapper-inner, #multiscroll-nav').fadeOut(1000, function () {
                            window.location = a.attr('href');
                        });
                    }
                });
            }
        }
    }
	
	/*
	 *	Preload background images for elements that have 'mkd-preload-background' class
	 */
	function mkdPreloadBackgrounds(){
		var preloadBackHolder = $('.mkd-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('mkd-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('mkd-preload-background'); }); //make sure that mkd-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function mkdPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * return array
	 */
	function setLoadMoreAjaxData(container, action){
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdIconWithHover = function() {
		//get all icons on page
		var icons = $('.mkd-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};

    /**
     * Init Owl Carousel
     */
    function mkdOwlSlider() {
        var sliders = $('.mkd-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    numberOfItems = 1,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = true,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 600,
                    margin = 0,
                    center = false,
                    autoWidth = false,
                    animateIn = false, // keyframe css animation
                    animateOut = false, // keyframe css animation
                    navigation = true,
                    pagination = false;

                if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false) {
                    numberOfItems = slider.data('number-of-items');
                }
                if (slider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (slider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (slider.data('enable-autoplay-hover-pause') === 'no') {
                    autoplayHoverPause = false;
                }
                if (typeof slider.data('slider-speed') !== 'undefined' && slider.data('slider-speed') !== false) {
                    sliderSpeed = slider.data('slider-speed');
                }
                if (typeof slider.data('slider-speed-animation') !== 'undefined' && slider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = slider.data('slider-speed-animation');
                }
                if (typeof slider.data('slider-margin') !== 'undefined' && slider.data('slider-margin') !== false) {
                    margin = slider.data('slider-margin');
                }
                if(slider.parent().hasClass('mkd-normal-space')) {
                    margin = 30;
                } else if (slider.parent().hasClass('mkd-small-space')) {
                    margin = 20;
                } else if (slider.parent().hasClass('mkd-tiny-space')) {
                    margin = 10;
                }
                if (slider.data('enable-center') === 'yes') {
                    center = true;
                }
                if (slider.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof slider.data('slider-animate-in') !== 'undefined' && slider.data('slider-animate-in') !== false) {
                    animateIn = slider.data('slider-animate-in');
                }
                if (typeof slider.data('slider-animate-out') !== 'undefined' && slider.data('slider-animate-out') !== false) {
                    animateOut = slider.data('slider-animate-out');
                }
                if (slider.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (slider.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if(navigation && pagination) {
                    slider.addClass('mkd-slider-has-both-nav');
                }

                if (slideItemsNumber <= 1) {
                    loop       = false;
                    autoplay   = false;
                    navigation = false;
                    pagination = false;
                }

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2,
                    responsiveNumberOfItems3 = 3;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems2 = numberOfItems;
                    responsiveNumberOfItems3 = numberOfItems;
                }

                slider.owlCarousel({
                    items: numberOfItems,
                    loop: loop,
                    autoplay: autoplay,
                    autoplayHoverPause: autoplayHoverPause,
                    autoplayTimeout: sliderSpeed,
                    autoplaySpeed: 650,
                    margin: margin,
                    center: center,
                    autoWidth: autoWidth,
                    animateIn : animateIn,
                    animateOut : animateOut,
                    dots: pagination,
                    nav: navigation,
                    navText: [
                        '<span class="mkd-prev-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                        '<span class="mkd-next-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-right"></span></span>'
                    ],
                    responsive: {
                        0: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false,
                        },
                        680: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                        },
                        768: {
                            items: responsiveNumberOfItems2,
                            slideBy: responsiveNumberOfItems2,
                        },
                        1024: {
                            items: numberOfItems,
                            slideBy: numberOfItems,
                        }
                    },
                    onInitialize: function () {
                        slider.css('visibility', 'visible');
                    }
                });
            });
        }
    }

    function mkdInitCustomMenuDropdown() {

    	var menus = $('.mkd-sidebar .widget_nav_menu .menu');


        var dropdownOpeners,
            currentMenu;


        if (menus.length) {
            menus.each(function () {

                currentMenu = $(this);

                dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

                if (dropdownOpeners.length) {
                    dropdownOpeners.each(function () {
                        var currentDropdownOpener = $(this);

                        if (currentDropdownOpener.parent().hasClass('current-menu-parent')) {
                            currentDropdownOpener.addClass('mkd-custom-menu-active');
                        }

                        currentDropdownOpener.on('click', function (e) {
                            e.preventDefault();
                            var currentDropdownOpenerActive = $(this);
                            var dropdownToOpen = currentDropdownOpenerActive.parent().children('.sub-menu');

                            if (!currentDropdownOpenerActive.hasClass('mkd-custom-menu-active')) {

                                if (!$(this).parent().parent().hasClass('sub-menu')) { //if first level
                                    dropdownOpeners.each(function () {

                                        $(this).removeClass('mkd-custom-menu-active');
                                        $(this).parent().children('.sub-menu').slideUp();

                                    });
                                }

                                dropdownToOpen.slideDown();
                                currentDropdownOpenerActive.addClass('mkd-custom-menu-active');
                            }

                            else {
                                if ($(this).parent().parent().hasClass('sub-menu')) {
                                    dropdownToOpen.slideUp();
                                    currentDropdownOpenerActive.removeClass('mkd-custom-menu-active');
                                }
                            }
                        });
                    });
                }
            });
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    mkd.modules.blog = blog;

    blog.mkdOnDocumentReady = mkdOnDocumentReady;
    blog.mkdOnWindowLoad = mkdOnWindowLoad;
    blog.mkdOnWindowResize = mkdOnWindowResize;
    blog.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdInitAudioPlayer();
        mkdInitBlogMasonryGallery();
        mkdInitBlogMasonry();
        mkdInitBlogListMasonry();
	    mkdInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
	    mkdInitBlogPagination().init();
	    mkdInitBlogListShortcodePagination().init();
        mkdInitBlogMasonryGalleryAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdInitBlogMasonry();
	    mkdInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
	    mkdInitBlogPagination().scroll();
	    mkdInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function mkdInitAudioPlayer() {
        var players = $('audio.mkd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function mkdResizeBlogItems(size,container){

        if(container.hasClass('mkd-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.mkd-post-size-default'),
                largeWidthMasonryItem = container.find('.mkd-post-size-large-width'),
                largeHeightMasonryItem = container.find('.mkd-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.mkd-post-size-large-width-height');

			if (mkd.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function mkdInitBlogMasonry() {
	    var holder = $('.mkd-blog-holder.mkd-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.mkd-blog-holder-inner'),
                    size = thisHolder.find('.mkd-blog-masonry-grid-sizer').width();
			    
                mkdResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.mkd-blog-masonry-grid-gutter',
						    columnWidth: '.mkd-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function mkdInitBlogChequered(){
        var container = $('.mkd-blog-holder.mkd-blog-chequered');
        var masonry = container.children('.mkd-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.mkd-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }


    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function mkdInitBlogMasonryGallery() {
        var blogList = $('.mkd-blog-holder.mkd-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.mkd-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.mkd-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                mkdInitBlogMasonryGalleryAppear();
            });
        }
    }
	
	/**
	 *  Init Blog Slider shortcode
	 */
	function mkdInitBlogSlider() {
		var blogSlider = $('.mkd-blog-slider-holder .mkd-blog-slider');
		
		if(blogSlider.length) {
			blogSlider.each(function(){
				var thisSlider = $(this);
				
				thisSlider.owlCarousel({
					responsive : {
						0: {
							loop: true,
							items: 1,
							center: false,
							margin: 0,
							dots: true,
							nav: false
						},
						1025: {
							loop: true,
							items: 2,
							startPosition: 1,
							center: true,
							margin: 15,
							dots: true,
							nav: true,
							navText: [
								'<span class="mkd-prev-icon"><span class="arrow arrow_left"></span></span>',
								'<span class="mkd-next-icon"><span class="arrow arrow_right"></span></span>'
							]
						}
					}
				});
			});
		}
	}

    /**
     *  Animate blog masonry gallery type
     */
    function mkdInitBlogMasonryGalleryAppear() {
        var blogList = $('.mkd-blog-holder.mkd-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.mkd-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('mkd-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('mkd-appeared');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function mkdInitBlogNarrowAppear() {
        var blogList = $('.mkd-blog-holder.mkd-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.mkd-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('mkd-appeared');
                    },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('mkd-appeared');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function mkdInitBlogPagination(){
		var holder = $('.mkd-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.mkd-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - mkdGlobalVars.vars.mkdAddForAdminBar;
			
			if(!thisHolder.hasClass('mkd-blog-pagination-infinite-scroll-started') && mkd.scroll + mkd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.mkd-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('mkd-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('mkd-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.mkd-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('mkd-showing');
				
				var ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'depot_mikado_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: MikadoAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('mkd-blog-type-masonry')){
								mkdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                mkdResizeBlogItems(thisHolderInner.find('.mkd-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								mkdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								mkdInitAudioPlayer();
								mkd.modules.common.mkdOwlSlider();
								mkd.modules.common.mkdFluidVideo();
                                mkdInitBlogNarrowAppear();
                                mkdInitBlogMasonryGalleryAppear();
                                mkdInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('mkd-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('mkd-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.mkd-blog-pag-load-more').hide();
			}
		};
		
		var mkdInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var mkdInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkd-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('mkd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function mkdInitBlogListMasonry() {
		var holder = $('.mkd-blog-list-holder.mkd-bl-masonry');

		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.mkd-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkd-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.mkd-bl-grid-gutter',
							columnWidth: '.mkd-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function mkdInitBlogListShortcodePagination(){
		var holder = $('.mkd-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.mkd-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.mkd-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - mkdGlobalVars.vars.mkdAddForAdminBar;
			
			if(!thisHolder.hasClass('mkd-bl-pag-infinite-scroll-started') && mkd.scroll + mkd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.mkd-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('mkd-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('mkd-bl-pag-infinite-scroll')) {
				thisHolder.addClass('mkd-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.mkd-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('mkd-bl-pag-standard-blog-list')) {
					loadingItem.addClass('mkd-showing mkd-standard-pag-trigger');
					thisHolder.addClass('mkd-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('mkd-showing');
				}
				
				var ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'depot_mikado_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: MikadoAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('mkd-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('mkd-bl-pag-standard-blog-list')) {
							mkdInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('mkd-bl-masonry')){
									mkdInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									mkdInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('mkd-bl-masonry')){
									mkdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									mkdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('mkd-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('mkd-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.mkd-blog-pag-load-more').hide();
			}
		};
		
		var mkdInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.mkd-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.mkd-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.mkd-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.mkd-bl-pag-next a');
			
			standardPagNumericItem.removeClass('mkd-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('mkd-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var mkdInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisHolder.removeClass('mkd-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var mkdInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisHolder.removeClass('mkd-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var mkdInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var mkdInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkd-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('mkd-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('mkd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('mkd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function($) {
    "use strict";

    var header = {};
    mkd.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = '';

    header.mkdOnDocumentReady = mkdOnDocumentReady;
    header.mkdOnWindowLoad = mkdOnWindowLoad;
    header.mkdOnWindowResize = mkdOnWindowResize;
    header.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdHeaderBehaviour();
        mkdSideArea();
        mkdSideAreaScroll();
        mkdFullscreenMenu();
        mkdInitMobileNavigation();
        mkdMobileHeaderBehavior();
        mkdSetDropDownMenuPosition();
        mkdDropDownMenu();    
        mkdSearch();
        mkdVerticalMenu().init();
        mkdInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
        mkdSetDropDownMenuPosition();
        mkdInitDividedHeaderMenu();
        mkdInitStickyDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
        mkdInitDividedHeaderMenu();
        mkdInitStickyDividedHeaderMenu();
        mkdInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {
        
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdHeaderBehaviour() {

        var header = $('.mkd-page-header'),
	        stickyHeader = $('.mkd-sticky-header'),
            fixedHeaderWrapper = $('.mkd-fixed-wrapper');
        
        var revSliderHeight =  0;
        if ($('.mkd-slider').length) {
            revSliderHeight = $('.mkd-slider').outerHeight();
        }

        var headerMenuAreaOffset = $('.mkd-page-header').find('.mkd-fixed-wrapper').length ? $('.mkd-page-header').find('.mkd-fixed-wrapper').offset().top - mkdGlobalVars.vars.mkdAddForAdminBar : 0;
		
        var stickyAppearAmount;
        var headerAppear;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight + mkdGlobalVars.vars.mkdStickyHeaderHeight;

                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else {
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-down-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-down-up';

                if(mkdPerPageVars.vars.mkdStickyScrollAmount !== 0){
                    mkd.modules.header.stickyAppearAmount = mkdPerPageVars.vars.mkdStickyScrollAmount;
                } else {
                    mkd.modules.header.stickyAppearAmount = mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight + revSliderHeight;
                }

                headerAppear = function(){
                    if(mkd.scroll < mkd.modules.header.stickyAppearAmount) {
                        mkd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else{
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case mkd.body.hasClass('mkd-fixed-on-scroll'):
                mkd.modules.header.behaviour = 'mkd-fixed-on-scroll';
                var headerFixed = function(){

                    if(mkd.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.outerHeight());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function mkdSideArea() {

        var wrapper = $('.mkd-wrapper'),
            sideMenuButtonOpen = $('a.mkd-side-menu-button-opener'),
            cssClass = 'mkd-right-side-menu-opened';

        wrapper.prepend('<div class="mkd-cover"/>');

        var sideAreaClose = function() {
            mkd.body.removeClass(cssClass);
            sideMenuButtonOpen.removeClass('opened');
        }

        var sideAreaOpen = function() {
            sideMenuButtonOpen.addClass('opened');
            mkd.body.addClass(cssClass);

            $('.mkd-wrapper .mkd-cover').click(function() {
                mkd.body.removeClass('mkd-right-side-menu-opened');
                sideMenuButtonOpen.removeClass('opened');
            });

            var currentScroll = $(window).scrollTop();
            $(window).scroll(function() {
                if(Math.abs(mkd.scroll - currentScroll) > 400){
                    sideAreaClose();
                }
            });
        }

        $('a.mkd-side-menu-button-opener').click(function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {
                sideAreaOpen();
            }
        });

        $('a.mkd-close-side-menu').click(function(e) {
            e.preventDefault();

            if(sideMenuButtonOpen.hasClass('opened')) {
                sideAreaClose();
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function mkdSideAreaScroll(){

        var sideMenu = $('.mkd-side-area-inner');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Sticky Divided Header Menu
     */
    function mkdInitStickyDividedHeaderMenu(){
        if(mkd.body.hasClass('mkd-header-divided')){
            //get left side menu width
            var menuArea = $('.mkd-sticky-header'),
                menuAreaWidth = menuArea.width(),
	            menuAreaItem = $('.mkd-main-menu > ul > li > a'),
	            menuItemPadding = 0,
	            logoArea = menuArea.find('.mkd-logo-wrapper .mkd-normal-logo'),
	            logoAreaWidth = 0;

            if(menuArea.children('.mkd-grid').length) {
                menuAreaWidth = menuArea.children('.mkd-grid').outerWidth();
            }

	        if(menuAreaItem.length) {
		        menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
	        }

	        if(logoArea.length) {
		        logoAreaWidth = logoArea.width() / 2;
	        }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.mkd-sticky-header .mkd-position-left').width(menuAreaLeftRightSideWidth);
			$('.mkd-sticky-header .mkd-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            mkdDropDownMenu();
            mkdSetDropDownMenuPosition();

        }
    }

    /**
     * Init Divided Header Menu
     */
    function mkdInitDividedHeaderMenu(){
        if(mkd.body.hasClass('mkd-header-divided')){
            //get left side menu width
            var menuArea = $('.mkd-menu-area'),
                menuAreaWidth = menuArea.width(),
                menuAreaItem = $('.mkd-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.mkd-logo-wrapper .mkd-normal-logo'),
                logoAreaWidth = 0;

            if(menuArea.children('.mkd-grid').length) {
                menuAreaWidth = menuArea.children('.mkd-grid').outerWidth();
            }

            if(menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if(logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.mkd-menu-area .mkd-position-left').width(menuAreaLeftRightSideWidth);
            $('.mkd-menu-area .mkd-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            mkdDropDownMenu();
            mkdSetDropDownMenuPosition();

        }
    }

    /**
     * Init Tabbed Header Menu
     */
    function mkdInitTabbedHeaderMenu(){
        if(mkd.body.hasClass('mkd-header-tabbed')){

            var centerHeaderArea = $('.mkd-position-center'),
                leftHeaderAreaWidth = $('.mkd-position-left').width(),
                rightHeaderAreaWidth = $('.mkd-position-right').width(),
                headerAreaPadding = 40; //20px on both side of header

            centerHeaderArea.width(mkd.windowWidth - leftHeaderAreaWidth - rightHeaderAreaWidth - headerAreaPadding);
            centerHeaderArea.css('opacity',1);
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function mkdFullscreenMenu() {

        if ($('a.mkd-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.mkd-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".mkd-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.mkd-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.mkd-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.mkd-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.mkd-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.mkd-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(mkd.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(mkd.windowHeight);
            });

            if (mkd.body.hasClass('mkd-fade-push-text-right')) {
                cssClass = 'mkd-push-nav-right';
                fadeRight = true;
            } else if (mkd.body.hasClass('mkd-fade-push-text-top')) {
                cssClass = 'mkd-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('mkd-fm-opened')) {
                    popupMenuOpener.addClass('mkd-fm-opened');
                    mkd.body.addClass('mkd-fullscreen-menu-opened');
                    mkd.body.removeClass('mkd-fullscreen-fade-out').addClass('mkd-fullscreen-fade-in');
                    mkd.body.removeClass(cssClass);
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('mkd-fm-opened');
                            mkd.body.removeClass('mkd-fullscreen-menu-opened');
                            mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                            mkd.body.addClass(cssClass);
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                            $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('mkd-fm-opened');
                    mkd.body.removeClass('mkd-fullscreen-menu-opened');
                    mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                    mkd.body.addClass(cssClass);
                    if(!mkd.body.hasClass('page-template-full_screen-php')){
                        mkd.modules.common.mkdEnableScroll();
                    }
                    $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {
                    var submenu = thisItemParent.find('> ul.sub_menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
	                    thisItemParent.removeClass('open_sub');
                    } else {
	                    thisItemParent.addClass('open_sub');
                        submenu.slideDown(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which == 1) {
                        popupMenuOpener.removeClass('mkd-fm-opened');
                        mkd.body.removeClass('mkd-fullscreen-menu-opened');
                        mkd.body.removeClass('mkd-fullscreen-fade-in').addClass('mkd-fullscreen-fade-out');
                        mkd.body.addClass(cssClass);
                        $("nav.mkd-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        mkd.modules.common.mkdEnableScroll();
                    }
                }else{
                    return false;
                }
            });
        }
    }

    function mkdInitMobileNavigation() {
        var navigationOpener = $('.mkd-mobile-header .mkd-mobile-menu-opener, .mkd-close-mobile-side-area-holder');
        var navigationHolder = $('.mkd-mobile-header .mkd-mobile-side-area');
        var dropdownOpener = $('.mkd-mobile-nav .mobile_arrow, .mkd-mobile-nav h6, .mkd-mobile-nav a.mkd-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.hasClass('opened')) {
                    navigationHolder.removeClass('opened');
                } else {
                    navigationHolder.addClass('opened');
                }
            });

            navigationHolder.find('.mkd-mobile-side-area-inner').niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('mkd-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('mkd-opened');
                            openerParent.siblings().removeClass('mkd-opened');
                            openerParent.siblings().children('ul').slideUp(animationSpeed);
                        }
                    }

                });
            });
        }

        $('.mkd-mobile-nav a, .mkd-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdMobileHeaderBehavior() {
        if(mkd.body.hasClass('mkd-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                mobileHeader = $('.mkd-mobile-header'),
                mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + mkdGlobalVars.vars.mkdAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('mkd-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.mkd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function mkdSetDropDownMenuPosition(){

        var menuItems = $(".mkd-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = mkd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(mkd.body.hasClass('mkd-boxed')){
                menuItemFromLeft = mkd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - mkd.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function mkdDropDownMenu() {

        var menu_items = $('.mkd-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();
                    
                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!mkd.body.hasClass('mkd-full-width-wide-menu')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (mkd.windowWidth - 2 * (mkd.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    }else{
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', mkd.windowWidth);

                        }
                    }
                }

                if(!mkd.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(mkd.body.hasClass('mkd-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 300, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 150, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('mkd-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('mkd-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.mkd-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        mkd.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function mkdSearch() {

        var searchOpener = $('a.mkd-search-opener'),
            searchForm,
            searchClose,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( mkd.body.hasClass( 'mkd-fullscreen-search' ) ) {

                var fullscreenSearchFade;

                searchClose = $( '.mkd-fullscreen-search-close' );
                fullscreenSearchFade = true;
                mkdFullscreenSearch( fullscreenSearchFade);

            } else if ( mkd.body.hasClass( 'mkd-slide-from-header-bottom' ) ) {

                mkdSearchSlideFromHeaderBottom();

            } else if ( mkd.body.hasClass( 'mkd-search-covers-header' ) ) {

                mkdSearchCoversHeader();

            } else if ( mkd.body.hasClass( 'mkd-search-slides-from-window-top' ) ) {

                searchForm = $('.mkd-search-slide-window-top');
                searchClose = $('.mkd-search-close');
                mkdSearchWindowTop();
            }
        }

        /**
         * Search slides from window top type of search
         */
        function mkdSearchWindowTop() {

            searchOpener.click( function(e) {
                e.preventDefault();

                var yPos = 0;
                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }

                if ( searchForm.height() == "0") {
                    $('.mkd-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    mkd.body.addClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    mkd.body.removeClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() != '0' && mkd.scroll > 50 ) {
                        mkd.body.removeClass('mkd-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.click(function(e){
                    e.preventDefault();
                    mkd.body.removeClass('mkd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });

            });
        }

        /**
         * Search covers header type of search
         */
        function mkdSearchCoversHeader() {

            searchOpener.click(function (e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.mkd-search-cover .mkd-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if ($(this).closest('.mkd-grid').length) {
                    searchForm = $(this).closest('.mkd-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else {
                    searchForm = $(this).closest('.mkd-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ($(this).closest('.mkd-sticky-header').length > 0) {
                    searchForm = $(this).closest('.mkd-sticky-header').children().first();
                    searchFormLandmark = searchForm;
                }
                if ($(this).closest('.mkd-mobile-header').length > 0) {
                    searchForm = $(this).closest('.mkd-mobile-header').children().children().first();
                    searchFormLandmark = searchForm.parent();
                }

                //Find search form position in header and height
                if (searchFormLandmark.parent().hasClass('mkd-logo-area')) {
                    searchFormHeight = mkdGlobalVars.vars.mkdLogoAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('mkd-top-bar')) {
                    searchFormHeight = mkdGlobalVars.vars.mkdTopBarHeight;
                } else if (searchFormLandmark.parent().hasClass('mkd-menu-area')) {
                    searchFormHeight = mkdGlobalVars.vars.mkdMenuAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('mkd-sticky-header')) {
                    searchFormHeight = mkdGlobalVars.vars.mkdStickyHeaderTransparencyHeight;
                } else if (searchFormLandmark.parent().hasClass('mkd-mobile-header')) {
                    searchFormHeight = $('.mkd-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.mkd-search-cover input[type="text"]').focus();
                $('.mkd-search-close, .content, footer').click(function (e) {
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function () {
                    searchForm.stop(true).fadeOut(450);
                });
            });

        }

        /**
         * Search slide from header bottom type of search
         */
        function mkdSearchSlideFromHeaderBottom() {
	
	        searchOpener.click( function() {
		        var thisItem = $(this);

                var boxed = 0;
                if(mkd.body.hasClass('mkd-boxed') && mkd.windowWidth > 1024){
                    boxed = $('.mkd-wrapper-inner').offset().left;
                }

                var searchIconPosition = parseInt(mkd.windowWidth - thisItem.offset().left - thisItem.outerWidth() - boxed);

		        if(!mkd.body.hasClass('mkd-search-opened')){
			        mkd.body.addClass('mkd-search-opened');
			        if(thisItem.parents('.mkd-fixed-wrapper').length) {
				        thisItem.parents('.mkd-fixed-wrapper').find('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.mkd-sticky-header.header-appear').length) {
				        thisItem.parents('.mkd-sticky-header.header-appear').find('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.mkd-logo-area').length) {
				        thisItem.parents('.mkd-page-header').find('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.mkd-menu-area').children('.mkd-slide-from-header-bottom-holder').length) {
                        thisItem.parents('.mkd-menu-area').children('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
                    } else if (thisItem.parents('.mkd-page-header').children('.mkd-slide-from-header-bottom-holder').length) {
				        thisItem.parents('.mkd-page-header').children('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.mkd-mobile-header').length) {
				        thisItem.parents('.mkd-mobile-header').find('.mkd-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        }
			        setTimeout(function(){
				        $('.mkd-slide-from-header-bottom-holder input').focus();
			        },400);
		        } else {
                    mkd.body.removeClass('mkd-search-opened');
                    $('.mkd-slide-from-header-bottom-holder').fadeOut(0);
                }
	        });

            $(document).mouseup(function (e) {
                var container = $(".mkd-search-opener, .mkd-slide-from-header-bottom-holder");
                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    if(mkd.body.hasClass('mkd-search-opened')){
                        mkd.body.removeClass('mkd-search-opened');
                        $('.mkd-slide-from-header-bottom-holder').fadeOut(0);
                    }
                }
            });

	        //Close on escape
	        $(document).keyup(function(e){
		        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                    if(mkd.body.hasClass('mkd-search-opened')){
                        mkd.body.removeClass('mkd-search-opened');
                        $('.mkd-slide-from-header-bottom-holder').fadeOut(0);
                    }
		        }
	        });
        }

        /**
         * Fullscreen search fade
         */
        function mkdFullscreenSearch( fade) {

            var searchHolder = $( '.mkd-fullscreen-search-holder');

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false,
                    closeTop = 0,
                    closeLeft = 0;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    closeTop = $(this).find('.mkd-search-opener-wrapper').offset().top;
                    closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'mkd-animate' ) ) {
                        mkd.body.removeClass('mkd-fullscreen-search-opened');
                        mkd.body.addClass( 'mkd-search-fade-out' );
                        mkd.body.removeClass( 'mkd-search-fade-in' );
                        searchHolder.removeClass( 'mkd-animate' );
                        setTimeout(function(){
                            searchHolder.find('.mkd-search-field').val('');
                            searchHolder.find('.mkd-search-field').blur();
                        },300);
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdEnableScroll();
                        }
                    } else {
                        mkd.body.addClass('mkd-fullscreen-search-opened');
                        setTimeout(function(){
                            searchHolder.find('.mkd-search-field').focus();
                        },900);
                        mkd.body.removeClass('mkd-search-fade-out');
                        mkd.body.addClass('mkd-search-fade-in');
                        searchHolder.addClass('mkd-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - mkd.scroll,
                                'left' : closeLeft
                            });
                        }
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        mkd.body.removeClass('mkd-fullscreen-search-opened');
                        searchHolder.removeClass('mkd-animate');
                        setTimeout(function(){
                            searchHolder.find('.mkd-search-field').val('');
                            searchHolder.find('.mkd-search-field').blur();
                        },300);
                        mkd.body.removeClass('mkd-search-fade-in');
                        mkd.body.addClass('mkd-search-fade-out');
                        if(!mkd.body.hasClass('page-template-full_screen-php')){
                            mkd.modules.common.mkdEnableScroll();
                        }
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".mkd-form-holder-inner");
                        if (!container.is(e.target) && container.has(e.target).length === 0)  {
                            e.preventDefault();
                            mkd.body.removeClass('mkd-fullscreen-search-opened');
                            searchHolder.removeClass('mkd-animate');
                            setTimeout(function(){
                                searchHolder.find('.mkd-search-field').val('');
                                searchHolder.find('.mkd-search-field').blur();
                            },300);
                            mkd.body.removeClass('mkd-search-fade-in');
                            mkd.body.addClass('mkd-search-fade-out');
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                        }
                    });

                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            mkd.body.removeClass('mkd-fullscreen-search-opened');
                            searchHolder.removeClass('mkd-animate');
                            setTimeout(function(){
                                searchHolder.find('.mkd-search-field').val('');
                                searchHolder.find('.mkd-search-field').blur();
                            },300);
                            mkd.body.removeClass('mkd-search-fade-in');
                            mkd.body.addClass('mkd-search-fade-out');
                            if(!mkd.body.hasClass('page-template-full_screen-php')){
                                mkd.modules.common.mkdEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.mkd-fullscreen-search-holder .mkd-search-field').focus(function(){
                $('.mkd-fullscreen-search-holder .mkd-field-holder .mkd-line').css("width","100%");
            });

            $('.mkd-fullscreen-search-holder .mkd-search-field').blur(function(){
                $('.mkd-fullscreen-search-holder .mkd-field-holder .mkd-line').css("width","0");
            });
        }
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var mkdVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.mkd-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has mkd-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.mkd-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.mkd-vertical-menu');

            dropdownFloat();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .second, > ul');

                menuItems.each(function () {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;

                    if (Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (elementToExpand.hasClass('mkd-float-open')) {
                                elementToExpand.removeClass('mkd-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if (!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('mkd-float-open');
                                }

                                elementToExpand.addClass('mkd-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function () {
                                elementToExpand.addClass('mkd-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function () {
                                elementToExpand.removeClass('mkd-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 100
                        });
                    }
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.mkd-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.mkd-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(mkd.body.hasClass('mkd-header-vertical-closed')) {
                        initHiddenVerticalArea();
                    }

                }
            }
        };
    };

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    mkd.modules.title = title;

    title.mkdOnDocumentReady = mkdOnDocumentReady;
    title.mkdOnWindowLoad = mkdOnWindowLoad;
    title.mkdOnWindowResize = mkdOnWindowResize;
    title.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
	    initTitleFullHeight();
	    mkdParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {
	    initTitleFullHeight();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {

    }

    /*
     **	Title image with parallax effect
     */
    function mkdParallaxTitle(){
        if($('.mkd-title.mkd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.mkd-title.mkd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.mkd-title.mkd-has-parallax-background.mkd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(mkd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(mkd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});
            });
        }
    }
	
	function initTitleFullHeight() {
		var title = $('.mkd-title');
		
		if(title.length > 0 && title.hasClass('mkd-title-full-height')) {
			var titleHolder = title.find('.mkd-title-holder');
			var titleMargin = parseInt($('.mkd-content').css('margin-top'));
			var titleHolderPadding = parseInt(titleHolder.css('padding-top'));
			if(mkd.windowWidth > 1024) {
				if(titleMargin < 0) {
					title.css("height", mkd.windowHeight);
					title.attr("data-height", mkd.windowHeight);
					titleHolder.css("height", mkd.windowHeight);
					if(titleHolderPadding > 0) {
						titleHolder.css("height", mkd.windowHeight - mkdGlobalVars.vars.mkdMenuAreaHeight);
					}
				} else {
					title.css("height", mkd.windowHeight - mkdGlobalVars.vars.mkdMenuAreaHeight);
					title.attr("data-height", mkd.windowHeight - mkdGlobalVars.vars.mkdMenuAreaHeight);
					titleHolder.css("height", mkd.windowHeight - mkdGlobalVars.vars.mkdMenuAreaHeight);
				}
			} else {
				title.css("height", mkd.windowHeight - mkdGlobalVars.vars.mkdMobileHeaderHeight);
				title.attr("data-height", mkd.windowHeight - mkdGlobalVars.vars.mkdMobileHeaderHeight);
				titleHolder.css("height", mkd.windowHeight - mkdGlobalVars.vars.mkdMobileHeaderHeight);
			}
		}
	}

})(jQuery);

(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitAccordions();
    });
	
	/**
	 * Init accordions shortcode
	 */
	function mkdInitAccordions(){
		var accordion = $('.mkd-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkd-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkd-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.mkd-title-holder'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitAnimationHolder();
	});
	
	/*
	 *	Init animation holder shortcode
	 */
	function mkdInitAnimationHolder(){
		
		var elements = $('.mkd-grow-in, .mkd-fade-in-down, .mkd-element-from-fade, .mkd-element-from-left, .mkd-element-from-right, .mkd-element-from-top, .mkd-element-from-bottom, .mkd-flip-in, .mkd-x-rotate, .mkd-z-rotate, .mkd-y-translate, .mkd-fade-in, .mkd-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdButton().init();
	});
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdButton = function() {
		//all buttons on the page
		var buttons = $('.mkd-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('border-color'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
/**
 * Cards Gallery shortcode
 */
(function($) {
    'use strict';

    $(window).load(function(){
        mkdCardsGallery();
    });



/**
 * Cards Gallery shortcode
 */
function mkdCardsGallery() {
    if ($('.mkd-cards-gallery-holder').length) {
        $('.mkd-cards-gallery-holder').each(function () {
            var gallery = $(this);
            var cards = gallery.find('.card');
            cards.each(function () {
                var card = $(this);
                card.click(function () {
                    if (!cards.last().is(card)) {
                        card.addClass('out animating').siblings().addClass('animating-siblings');
                        card.detach();
                        card.insertAfter(cards.last());
                        setTimeout(function () {
                            card.removeClass('out');
                        }, 200);
                        setTimeout(function () {
                            card.removeClass('animating').siblings().removeClass('animating-siblings');
                        }, 1200);
                        cards = gallery.find('.card');
                        return false;
                    }
                });
            });

            if (gallery.hasClass('mkd-bundle-animation') && !mkd.htmlEl.hasClass('touch')) {
                gallery.appear(function () {
                    gallery.addClass('mkd-appeared');
                    gallery.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
                        $(this).addClass('mkd-animation-done');
                    });
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        });
    }
}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitClientsCarousel();
	});
	
	/**
	 * Init clients carousel shortcode
	 */
	function mkdInitClientsCarousel(){
		var carouselHolder = $('.mkd-clients-carousel-holder');
		
		if(carouselHolder.length){
			carouselHolder.each(function(){
				
				var thisCarouselHolder = $(this),
					thisCarousel = thisCarouselHolder.children('.mkd-cc-inner'),
					numberOfItems = 4,
					autoplay = true,
					autoplayTimeout = 5000,
					loop = true,
					speed = 650;
				
				if (typeof thisCarousel.data('number-of-items') !== 'undefined' && thisCarousel.data('number-of-items') !== false) {
					numberOfItems = parseInt(thisCarousel.data('number-of-items'));
				}
				
				if (typeof thisCarousel.data('autoplay') !== 'undefined' && thisCarousel.data('autoplay') !== false) {
					autoplay = thisCarousel.data('autoplay');
				}
				
				if (typeof thisCarousel.data('autoplay-timeout') !== 'undefined' && thisCarousel.data('autoplay-timeout') !== false) {
					autoplayTimeout = thisCarousel.data('autoplay-timeout');
				}
				
				if (typeof thisCarousel.data('loop') !== 'undefined' && thisCarousel.data('loop') !== false) {
					loop = thisCarousel.data('loop');
				}
				
				if (typeof thisCarousel.data('speed') !== 'undefined' && thisCarousel.data('speed') !== false) {
					speed = thisCarousel.data('speed');
				}
				
				if(numberOfItems === 1) {
					autoplay = false;
					loop = false;
				}
				
				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3;
				
				if (numberOfItems < 3) {
					responsiveNumberOfItems1 = numberOfItems;
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}
				
				thisCarousel.owlCarousel({
					items: numberOfItems,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplayHoverPause:true,
					loop: loop,
					smartSpeed: speed,
					nav: false,
					dots: false,
					responsive: {
						0: {
							items: responsiveNumberOfItems1,
						},
						600: {
							items: responsiveNumberOfItems2
						},
						768: {
							items: responsiveNumberOfItems3,
						},
						1025: {
							items: numberOfItems
						}
					}
				});

				thisCarousel.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitCountdown();
	});
	
	/**
	 * Countdown Shortcode
	 */
	function mkdInitCountdown() {
		var countdowns = $('.mkd-countdown'),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitCounter();
	});
	
	/**
	 * Counter Shortcode
	 */
	function mkdInitCounter() {
		var counterHolder = $('.mkd-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.mkd-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('mkd-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitElementsHolderResponsiveStyle();
	});
	
	/*
	 **	Elements Holder responsive style
	 */
	function mkdInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.mkd-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.mkd-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.mkd-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.mkd-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.mkd-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.mkd-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.mkd-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
						if(mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.mkd-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css" data-type="depot_mikado_shortcodes_custom_css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(window).load(function(){
		mkdInitFrameSlider();
	});
	
	/*
	 **	Init Frame Slider shortcode
	 */
	function mkdInitFrameSlider() {
		var sliders = $('.mkd-frame-slider-holder');
		
		if (sliders.length) {
			sliders.each(function() {
				var sliderHolder = $(this),
					slider = sliderHolder.children('.mkd-fs-slides');
				
				slider.owlCarousel({
					loop: true,
					nav: false,
					dots: false,
					center: true,
					responsive: {
						0: {
							items: 1,
							margin: 0,
							autoWidth: false
						},
						681: {
							items: 3,
							margin: 36,
							autoWidth: true
						},
						1441: {
							items: 5,
							margin: 36,
							autoWidth: true
						}
					}
				});
				
				slider.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdShowGoogleMap();
	});
	
	/*
	 **	Show Google Map
	 */
	function mkdShowGoogleMap(){
		var googleMap = $('.mkd-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "mkd-map-"+ uniqueId;
				
				mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		var mapStyles = [
			{
				stylers: [
					{hue: color },
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];
		
		var googleMapStyleId;
		
		if(customMapStyle === 'yes'){
			googleMapStyleId = 'mkd-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Mikado Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkd-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('mkd-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			mkdInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function mkdInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdIcon().init();
	});
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdIcon = function() {
		//get all icons on page
		var icons = $('.mkd-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('mkd-icon-animation')) {
				icon.appear(function() {
					icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
				}, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.mkd-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitIconList().init();
	});
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var mkdInitIconList = function() {
		var iconList = $('.mkd-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('mkd-appeared');
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitImageGallery();
	});
	
	/**
	 * Init image gallery shortcode
	 */
	function mkdInitImageGallery() {
		var galleries = $('.mkd-image-gallery');
		
		if (galleries.length) {
			galleries.each(function () {
				var gallery = $(this).find('.mkd-ig-slider'),
					numberOfItems = gallery.data('number-of-visible-items'),
					autoplay = gallery.data('autoplay'),
					animation = (gallery.data('animation') === 'slide') ? false : gallery.data('animation'),
					navigation = (gallery.data('navigation') === 'yes'),
					pagination = (gallery.data('pagination') === 'yes');
				
				//Responsive breakpoints
				var items = numberOfItems;
				
				var responsiveItems1 = 4;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (items < 3) {
					responsiveItems1 = items;
					responsiveItems2 = items;
				}
				
				if (items < 2) {
					responsiveItems3 = items;
				}
				
				gallery.owlCarousel({
					autoplay: true,
					autoplayTimeout: autoplay * 1000,
					loop: true,
					smartSpeed: 600,
					animateIn : animation, //fade, fadeUp, backSlide, goDown
					nav: navigation,
					dots: pagination,
					navText: [
						'<span class="mkd-prev-icon"><span class="mkd-icon-arrow ion-ios-arrow-thin-left"></span></span>',
						'<span class="mkd-next-icon"><span class="mkd-icon-arrow ion-ios-arrow-thin-right"></span></span>'
					],
					responsive:{
						1201:{
							items: items
						},
						769:{
							items: responsiveItems1
						},
						601:{
							items: responsiveItems2
						},
						481:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					}
				});
				
				gallery.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitItemShowcase();
	});
	
	/**
	 * Init item showcase shortcode
	 */
	function mkdInitItemShowcase() {
		var itemShowcase = $('.mkd-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.mkd-is-left'),
					rightItems = thisItemShowcase.find('.mkd-is-right'),
					itemImage = thisItemShowcase.find('.mkd-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='mkd-is-item-holder mkd-is-left-holder' />");
				rightItems.wrapAll( "<div class='mkd-is-item-holder mkd-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('mkd-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(mkd.windowWidth > 1200) {
									itemAppear('.mkd-is-left-holder .mkd-is-item');
									itemAppear('.mkd-is-right-holder .mkd-is-item');
								} else {
									itemAppear('.mkd-is-item');
								}
							});
					},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('mkd-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
        mkdInitMessages();
        mkdInitMessageHeight();
    });

/*
 **	Function to close message shortcode
 */
function mkdInitMessages(){
    var message = $('.mkd-message');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            thisMessage.find('.mkd-close').click(function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(500);
            });
        });
    }
}

/*
 **	Init message height
 */
function mkdInitMessageHeight(){
    var message = $('.mkd-message.mkd-with-icon');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            var textHolderHeight = thisMessage.find('.mkd-message-text-holder').height();
            var iconHolderHeight = thisMessage.find('.mkd-message-icon-holder').height();

            if(textHolderHeight > iconHolderHeight) {
                thisMessage.find('.mkd-message-icon-holder').height(textHolderHeight);
            } else {
                thisMessage.find('.mkd-message-text-holder').height(iconHolderHeight);
            }
        });
    }
}

})(jQuery);
(function($) {
    'use strict';
	
    $(window).load(function() {
	    mkdInitParallax();
	    if(mkd.body.hasClass('wpb-js-composer')) {
		    window.vc_rowBehaviour(); //call vc row behavior on load, this is for parallax on row since it is not loaded after some other shortcodes are loaded
	    }
    });
	
	/*
	 ** Init parallax shortcode
	 */
	function mkdInitParallax(){
		var parallaxHolder = $('.mkd-parallax-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					speed = parallaxElement.data('parallax-speed')*0.4;
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitPieChart();
	});
	
	/**
	 * Init Pie Chart shortcode
	 */
	function mkdInitPieChart() {
		var pieChartHolder = $('.mkd-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.mkd-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.mkd-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitProgressBars();
	});
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdInitProgressBars(){
		var progressBar = $('.mkd-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.mkd-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					mkdInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.mkd-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitTabs();
	});
	
	/*
	 **	Init tabs shortcode
	 */
	function mkdInitTabs(){
		var tabs = $('.mkd-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.mkd-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkd-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		mkdInitVerticalSplitSlider();
	});
	
	/*
	 **	Vertical Split Slider
	 */
	function mkdInitVerticalSplitSlider() {
		var slider = $('.mkd-vertical-split-slider');
		
		if (slider.length) {
			if (mkd.body.hasClass('mkd-vss-initialized')) {
				mkd.body.removeClass('mkd-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(mkd.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (mkd.body.hasClass('mkd-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (mkd.body.hasClass('mkd-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.mkd-vss-ms-section',
				leftSelector: '.mkd-vss-ms-left',
				rightSelector: '.mkd-vss-ms-right',
                loopTop: true,
                loopBottom: true,
				afterRender: function () {
					mkdCheckVerticalSplitSectionsForHeaderStyle($('.mkd-vss-ms-left .mkd-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					mkd.body.addClass('mkd-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if(contactForm7.length) {

					contactForm7.each(function(){
					var thisForm = $(this);
					
					thisForm.find('.wpcf7-submit').off().on('click', function(e){
						e.preventDefault();
						wpcf7.submit(thisForm);
					});
					});
				}
 
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="mkd-vss-responsive"></div>'),
						leftSide = slider.find('.mkd-vss-ms-left > div'),
						rightSide = slider.find('.mkd-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.mkd-vss-responsive .mkd-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'mkd-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof mkdButton === "function") {
						mkdButton().init();
					}
					
					if (typeof mkdInitElementsHolderResponsiveStyle === "function") {
						mkdInitElementsHolderResponsiveStyle();
					}
					
					if (typeof mkdShowGoogleMap === "function") {
						mkdShowGoogleMap();
					}
					
					if (typeof mkdInitProgressBars === "function") {
						mkdInitProgressBars();
					}
					
					if (typeof mkdInitTestimonials === "function") {
						mkdInitTestimonials();
					}
				},
				onLeave: function (index, nextIndex, direction) {
					mkdCheckVerticalSplitSectionsForHeaderStyle($($('.mkd-vss-ms-left .mkd-vss-ms-section')[$(".mkd-vss-ms-left .mkd-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (mkd.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (mkd.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function mkdCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			mkd.body.removeClass('mkd-light-header mkd-dark-header').addClass('mkd-' + default_header_style + '-header');
		} else {
			mkd.body.removeClass('mkd-light-header mkd-dark-header');
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitMasonryGallery();
    });
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function mkdInitMasonryGallery(){
		var galleryHolder = $('.mkd-masonry-gallery-holder'),
			gallery = galleryHolder.children('.mkd-mg-inner'),
			gallerySizer = gallery.children('.mkd-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.mkd-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkd-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.mkd-mg-grid-gutter',
							columnWidth: '.mkd-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.mkd-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.mkd-mg-rectangle-landscape'),
			square_big = holder.find('.mkd-mg-square-big'),
			square_small = holder.find('.mkd-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    mkd.modules.portfolio = portfolio;

    portfolio.mkdOnDocumentReady = mkdOnDocumentReady;
    portfolio.mkdOnWindowLoad = mkdOnWindowLoad;
    portfolio.mkdOnWindowResize = mkdOnWindowResize;
    portfolio.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdOnDocumentReady() {
        mkdInitPortfolioSlider();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdOnWindowLoad() {
        mkdInitPortfolioMasonry();
        mkdInitPortfolioFilter();
        initPortfolioSingleMasonry();
        mkdInitPortfolioListAnimation();
	    mkdInitPortfolioPagination().init();
        mkdPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdOnWindowResize() {
        mkdInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdOnWindowScroll() {
	    mkdInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function mkdInitPortfolioListAnimation(){
        var portList = $('.mkd-portfolio-list-holder.mkd-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.mkd-pl-inner'),
                	articles = thisPortList.find('article'),
                    rewindCalc = 0,
                    cycle = 0,
                    delay = 250,
                    yOffset = mkdGlobalVars.vars.mkdElementAppearAmount;

                articles.each(function() {
                    var article = $(this);

                    if (article.offset().top == articles.first().offset().top) { //find the number of articles in the same row
                        rewindCalc ++;
                    }

                    article.appear(function(){
                        if (cycle == rewindCalc) {
                            cycle = 0;
                        }

                        setTimeout(function(){
    		            	showItem(article);
                        }, cycle*delay);

                        cycle++;
                    }, {accX: 0, accY: yOffset});
                });
            });

			//show item function
			var showItem = function(article) {
				article.addClass('mkd-item-show');

				article.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				    article.addClass('mkd-item-shown');
				});
			}
        }
    }

    /**
     * Initializes portfolio list
     */
    function mkdInitPortfolioMasonry(){
        var portList = $('.mkd-portfolio-list-holder.mkd-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.mkd-pl-inner'),
                    size = thisPortList.find('.mkd-pl-grid-sizer').width();
                
                mkdResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.mkd-pl-grid-gutter',
                        columnWidth: '.mkd-pl-grid-sizer'
                    }
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function mkdResizePortfolioItems(size,container){

        if(container.hasClass('mkd-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.mkd-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.mkd-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.mkd-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.mkd-pl-masonry-large-width-height');

            if (mkd.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function mkdInitPortfolioFilter(){
        var filterHolder = $('.mkd-portfolio-list-holder .mkd-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.mkd-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.mkd-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('mkd-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.mkd-pl-filter:first').addClass('mkd-pl-current');
	            
	            if(thisPortListHolder.hasClass('mkd-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.mkd-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.mkd-pl-filter').removeClass('mkd-pl-current');
                    thisFilter.addClass('mkd-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        mkdInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.mkd-pl-inner').isotope({ filter: filterValue });
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function mkdInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {

        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.mkd-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = mkd.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'mkd_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.mkd-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('mkd-showing mkd-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: MikadoAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                mkdResizePortfolioItems(thisPortListInner.find('.mkd-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('mkd-showing mkd-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('mkd-showing mkd-filter-trigger');
                            mkdInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function mkdInitPortfolioPagination(){
		var portList = $('.mkd-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.mkd-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.mkd-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - mkdGlobalVars.vars.mkdAddForAdminBar;
			
			if(!thisPortList.hasClass('mkd-pl-infinite-scroll-started') && mkd.scroll + mkd.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.mkd-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('mkd-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
				thisPortList.addClass('mkd-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkd.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.mkd-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('mkd-pl-pag-standard')) {
					loadingItem.addClass('mkd-showing mkd-standard-pag-trigger');
					thisPortList.addClass('mkd-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('mkd-showing');
				}
				
				var ajaxData = mkd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'mkd_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: MikadoAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('mkd-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('mkd-pl-pag-standard')) {
							mkdInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkd-pl-masonry')){
                                    mkdResizePortfolioItems(thisPortListInner.find('.mkd-pl-grid-sizer').width(), thisPortList);
									mkdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('mkd-pl-gallery') && thisPortList.hasClass('mkd-pl-has-filter')) {
									mkdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									mkdInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkd-pl-masonry')){
									mkdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('mkd-pl-gallery') && thisPortList.hasClass('mkd-pl-has-filter')) {
									mkdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else {
									mkdInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('mkd-pl-infinite-scroll-started')) {
							thisPortList.removeClass('mkd-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.mkd-pl-load-more-holder').hide();
			}
		};
		
		var mkdInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.mkd-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.mkd-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.mkd-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.mkd-pl-pag-next a');
			
			standardPagNumericItem.removeClass('mkd-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('mkd-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var mkdInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisPortList.removeClass('mkd-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdInitPortfolioListAnimation();
			}, 400);
		};
		
		var mkdInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing mkd-standard-pag-trigger');
			thisPortList.removeClass('mkd-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			mkdInitPortfolioListAnimation();
		};
		
		var mkdInitAppendIsotopeNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkd-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdInitPortfolioListAnimation();
			}, 400);
		};
		
		var mkdInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkd-showing');
			thisPortListInner.append(responseHtml);
			mkdInitPortfolioListAnimation();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkd-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkd-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkd-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}

    /**
     * Initializes portfolio slider
     */
    function mkdInitPortfolioSlider(){
        var portSlider = $('.mkd-portfolio-slider-holder');
	
	    if(portSlider.length) {
		    portSlider.each(function () {
			    var thisPortSlider = $(this),
				    portHolder = thisPortSlider.children('.mkd-portfolio-list-holder'),
				    portSlider = portHolder.children('.mkd-pl-inner'),
				    numberOfItems = 4,
				    margin = 0,
				    marginLabel,
				    sliderSpeed = 5000,
				    loop = true,
				    padding = false,
				    navigation = true,
				    pagination = true;
			
			    if (typeof portHolder.data('number-of-columns') !== 'undefined' && portHolder.data('number-of-columns') !== false) {
				    numberOfItems = portHolder.data('number-of-columns');
			    }
			
			    if (typeof portHolder.data('space-between-items') !== 'undefined' && portHolder.data('space-between-items') !== false) {
				    marginLabel = portHolder.data('space-between-items');
				
				    if (marginLabel === 'normal') {
                        margin = 30;
                    } else if (marginLabel === 'small') {
					    margin = 20;
				    } else if (marginLabel === 'tiny') {
                        margin = 10;
                    } else {
					    margin = 0;
				    }
			    }
			
			    if (typeof portHolder.data('slider-speed') !== 'undefined' && portHolder.data('slider-speed') !== false) {
				    sliderSpeed = portHolder.data('slider-speed');
			    }
			    if (typeof portHolder.data('enable-loop') !== 'undefined' && portHolder.data('enable-loop') !== false && portHolder.data('enable-loop') === 'no') {
				    loop = false;
			    }
			    if (typeof portHolder.data('enable-padding') !== 'undefined' && portHolder.data('enable-padding') !== false && portHolder.data('enable-padding') === 'yes') {
				    padding = true;
			    }
			    if (typeof portHolder.data('enable-navigation') !== 'undefined' && portHolder.data('enable-navigation') !== false && portHolder.data('enable-navigation') === 'no') {
				    navigation = false;
			    }
			    if (typeof portHolder.data('enable-pagination') !== 'undefined' && portHolder.data('enable-pagination') !== false && portHolder.data('enable-pagination') === 'no') {
				    pagination = false;
			    }
			
			    var responsiveNumberOfItems1 = 1,
				    responsiveNumberOfItems2 = 2,
				    responsiveNumberOfItems3 = 3;
			
			    if (numberOfItems < 3) {
				    responsiveNumberOfItems1 = numberOfItems;
				    responsiveNumberOfItems2 = numberOfItems;
				    responsiveNumberOfItems3 = numberOfItems;
			    }
			
			    portSlider.owlCarousel({
				    items: numberOfItems,
				    margin: margin,
				    loop: loop,
				    autoplay: true,
				    autoplayTimeout: sliderSpeed,
				    autoplayHoverPause: true,
				    smartSpeed: 800,
				    nav: navigation,
				    navText: [
					    '<span class="mkd-prev-icon"><span class="mkd-icon-arrow icon-arrows-left"></span></span>',
					    '<span class="mkd-next-icon"><span class="mkd-icon-arrow icon-arrows-right"></span></span>'
				    ],
				    dots: pagination,
				    responsive: {
					    0: {
						    items: responsiveNumberOfItems1,
						    stagePadding: 0
					    },
					    600: {
						    items: responsiveNumberOfItems2
					    },
					    768: {
						    items: responsiveNumberOfItems3
					    },
					    1024: {
						    items: numberOfItems
					    }
				    }
			    });
			
			    thisPortSlider.css('opacity', '1');
		    });
	    }
    }

    var mkdPortfolioSingleFollow = function() {

        var info = $('.mkd-follow-portfolio-info .mkd-portfolio-single-holder .mkd-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.mkd-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .mkd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                        var marginTop = mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {
                    	
                        if(mkd.scroll + headerHeight + infoHolderHeight <  mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .mkd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .mkd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else{
                            info.stop().animate({
                            	marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init : function() {
                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.mkd-portfolio-single-holder .mkd-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.mkd-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.mkd-ps-grid-gutter',
                    columnWidth: '.mkd-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    // mkdInitTeamSlider();
    });
	
	/**
	 * Init team slider shortcode
	 */
	function mkdInitTeamSlider() {
		var teamSliders = $('.mkd-team-slider-holder');
		
		if (teamSliders.length) {
			teamSliders.each(function () {
				
				var thisTeamSlider = $(this),
					teamHolder = thisTeamSlider.children('.mkd-team-list-holder'),
					teamSlider = teamHolder.children('.mkd-tl-inner');
				
				var dots = (teamHolder.data('dots') == 'yes');
				
				var numberOfItems = teamHolder.data('number_of_items');
				
				var responsiveItems1 = numberOfItems;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (numberOfItems > 4) {
					responsiveItems1 = 4;
				}
				
				if(numberOfItems < 3) {
					responsiveItems2 = numberOfItems;
				}
				
				if (numberOfItems < 2) {
					responsiveItems3 = numberOfItems;
				}
				
				if (numberOfItems === 1) {
					responsiveItems4 = numberOfItems;
				}
				
				teamSlider.owlCarousel({
					dots: dots,
					nav: false,
					items: numberOfItems,
					responsive:{
						1200:{
							items: numberOfItems
						},
						1024:{
							items: responsiveItems1
						},
						769:{
							items: responsiveItems2
						},
						601:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					},
					onInitialized: function() {
						teamSlider.css({'opacity': 1});
					}
				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    mkdInitTestimonials();
    });

	/**
	 * Init testimonials shortcode
	 */
	function mkdInitTestimonials(){
		var testimonialsHolder = $('.mkd-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){
				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.mkd-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('number-visible') !== 'undefined' && testimonials.data('number-visible') !== false) {
					numberOfItems = parseInt(testimonials.data('number-visible'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems1 = numberOfItems;
                    responsiveNumberOfItems2 = numberOfItems;
                }

				testimonials.owlCarousel({
					items: numberOfItems,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
                    responsive: {
						0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        769: {
                            items: responsiveNumberOfItems2
                        },
                        1025: {
                            items: numberOfItems
                        }
                    },
					navText: [
						'<span class="mkd-prev-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-left"></span></span>',
						'<span class="mkd-next-icon"><span class="mkd-icon-linear-icon lnr lnr-arrow-right"></span></span>'
					]
				});
				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
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