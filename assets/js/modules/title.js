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
