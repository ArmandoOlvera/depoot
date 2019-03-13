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