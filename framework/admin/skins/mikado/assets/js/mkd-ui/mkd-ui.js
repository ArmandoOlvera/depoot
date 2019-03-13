(function($){
    $(document).ready(function() {
        //plugins init goes here
        mkdInitSelectChange();
        mkdInitSwitch();
        mkdInitTooltips();
        mkdInitColorpicker();
        mkdInitRangeSlider();
        mkdInitMediaUploader();
        mkdInitGalleryUploader();
        if ($('.mkd-page-form').length > 0) {
            mkdInitAjaxForm();
            mkdScrollToAnchor();
            mkdScrollToAnchorSelect();
            mkdAnchorSelectOnLoad();
            initTopAnchorHolderSize();
            mkdCheckVisibilityOfAnchorButtons();
            mkdCheckVisibilityOfAnchorOptions();
            mkdCheckAnchorsOnDependencyChange();
            mkdCheckOptionAnchorsOnDependencyChange();
            mkdChangedInput();
            mkdFixHeaderAndTitle();
            totop_button();
            backButtonShowHide();
            backToTop();
            mkdInitSelectPicker();
        }
        mkdInitPortfolioImagesVideosBox();
        mkdInitPortfolioMediaAcc();
        mkdInitPortfolioItemsBox();
        mkdInitPortfolioItemAcc();
        mkdInitSlideElementItemAcc();
        mkdInitSlideElementItemsBox();
        mkdInitDatePicker();
		mkdShowHidePostFormats();
        mkdPageTemplatesMetaBoxDependency();
        mkdRepeater();
	    mkdImportOptions();
	    mkdImportCustomSidebars();
	    mkdImportWidgets();
    });

    function mkdFixHeaderAndTitle () {
        var pageHeader 				= $('.mkd-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
        var pageTitle				= $('.mkd-page-title-holder');
        var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
        var tabsNavWrapper			= $('.mkd-tabs-navigation-wrapper');
        var tabsNavWrapperTop		= pageHeaderHeight;
        var tabsContentWrapper	    = $('.mkd_ajax_form');
        var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

        $(window).on('scroll load', function() {
            if($(window).scrollTop() >= pageHeaderTopPosition) {
                pageHeader.addClass('mkd-header-fixed');
                pageTitle.addClass('mkd-page-title-fixed').css('top', pageTitleTopPosition);
                tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
                tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
            } else {
                pageHeader.removeClass('mkd-header-fixed');
                pageTitle.removeClass('mkd-page-title-fixed').css('top', 0);
                tabsNavWrapper.css('marginTop', 0);
                tabsContentWrapper.css('marginTop', 0);
            }
        });
    }

    function initTopAnchorHolderSize() {
        function initTopSize() {
            $('.mkd-top-section-holder-inner').css({
                'width' : $('.mkd-top-section-holder').width()
            });
            $('.mkd-page-title-holder').css({
                'width' : $('.mkd-page-section-title:visible').outerWidth()- 2*parseInt($('.mkd-page-title-holder').css('marginLeft'))
            });
        };
        initTopSize();

        $(window).on('resize', function() {
            initTopSize();
        });
    }

    function mkdScrollToAnchor () {
        $('#anchornav a').click( function() {
            mkdScrollToPanel($(this).attr('href'));
        });
    }

    function mkdScrollToAnchorSelect() {
        var selectAnchor = $('#mkd-select-anchor');
        selectAnchor.on('change', function() {
            var selectAnchor = $('option:selected', selectAnchor);

            if(typeof selectAnchor.data('anchor') !== 'undefined') {
                mkdScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function mkdAnchorSelectOnLoad() {
        var currentPanel = window.location.hash;
        if(currentPanel) {
            var selectAnchor = $('#mkd-select-anchor');
            var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();

            if(currentOption) {
                currentOption.attr('selected', 'selected');
            }
        }
    }

    function mkdScrollToPanel(panel) {
        var pageHeader 				= $('.mkd-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageTitle				= $('.mkd-page-title-holder');
        var pageTitleHeight			= pageTitle.outerHeight();

        var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }

    function totop_button(a) {
        "use strict";

        var b = $("#back_to_top");
        b.removeClass("off on");
        if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
    }

    function backButtonShowHide(){
        "use strict";

        $(window).scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
        });
    }

    function backToTop(){
        "use strict";

        $(document).on('click','#back_to_top',function(){
            $('html, body').animate({
                scrollTop: $('html').offset().top}, 1000);
            return false;
        });
    }
    
    function mkdChangedInput () {
        $('.mkd-tabs-content form.mkd_ajax_form:not(.mkd-import-page-holder):not(.mkd-backup-options-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
            $('.mkd-input-change').addClass('yes');
        });
        $('.mkd-tabs-content form.mkd_ajax_form:not(.mkd-import-page-holder):not(.mkd-backup-options-page-holder) .field.switch label:not(.selected)').click( function() {
            $('.mkd-input-change').addClass('yes');
        });
        $(window).on('beforeunload', function () {
            if ($('.mkd-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });
        $('.mkd-tabs-content form.mkd_ajax_form:not(.mkd-import-page-holder):not(.mkd-backup-options-page-holder) #anchornav input').click(function() {
            if ($('.mkd-input-change.yes').length) {
                $('.mkd-input-change.yes').removeClass('yes');
            }
            $('.mkd-changes-saved').addClass('yes');
            setTimeout(function(){$('.mkd-changes-saved').removeClass('yes');}, 3000);
        });
    }

    function mkdCheckVisibilityOfAnchorButtons () {
        $('.mkd-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#anchornav a').each ( function() {
                if ($(this).attr('href') == '#'+$panelID) {
                    $(this).parent().hide();//hide <li>s
                }
            });
        })
    }

    function mkdCheckVisibilityOfAnchorOptions() {
        $('.mkd-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#mkd-select-anchor option').each ( function() {
                if ($(this).data('anchor') == '#'+$panelID) {
                    $(this).hide();//hide <li>s
                }
            });
        })
    }

    function mkdGetArrayOfHiddenElements(changedElement) {
        var hidden_elements_string = changedElement.data('hide');
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function mkdGetArrayOfShownElements(changedElement) {
        //check for links to show
        var shown_elements_string = changedElement.data('show');
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }
	
	function mkdGetArrayOfHiddenElementsSelectBox(changedElement,changedElementValue) {
        var hidden_elements_string = changedElement.data('hide-'+changedElementValue);
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function mkdGetArrayOfShownElementsSelectBox(changedElement,changedElementValue) {
        //check for links to show
        var shown_elements_string = changedElement.data('show-'+changedElementValue);
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }
	
    function mkdCheckAnchorsOnDependencyChange(){
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = mkdGetArrayOfHiddenElements($(this));
            shown_elements_array  = mkdGetArrayOfShownElements($(this));

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#anchornav a').each ( function() {

                    if ($(this).attr('href') == value) {
                        $(this).parent().hide();//hide <li>s
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#anchornav a').each ( function() {
                    if ($(this).attr('href') == value) {
                        $(this).parent().show();//show <li>s
                    }
                });
            });
        });
        
		$(document).on('change','.mkd-form-element.dependence',function(){
            hidden_elements_array = mkdGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = mkdGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#anchornav a').each ( function() {

                    if ($(this).attr('href') == value) {
                        $(this).parent().hide();//hide <li>s
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#anchornav a').each ( function() {
                    if ($(this).attr('href') == value) {
                        $(this).parent().show();//show <li>s
                    }
                });
            });
        });
    }

    function mkdCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = mkdGetArrayOfHiddenElements($(this));
            shown_elements_array  = mkdGetArrayOfShownElements($(this));

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#mkd-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#mkd-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#mkd-select-anchor').selectpicker('refresh');
        });
		
		$(document).on('change','.mkd-form-element.dependence',function(){
            hidden_elements_array = mkdGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = mkdGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#mkd-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#mkd-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#mkd-select-anchor').selectpicker('refresh');
        });
    }
    
    function mkdInitSelectChange() {
        $('select.dependence').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value.replace(/ /g, '');
            $($(this).data('hide-'+valueSelected)).fadeOut();
            $($(this).data('show-'+valueSelected)).fadeIn();
        });
    }

    function mkdInitSwitch() {
        $(".cb-enable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-disable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', true);
            $('.checkboxhidden_yesno',parent).val("yes");
            $('.checkboxhidden_onoff',parent).val("on");
            $('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_follow");
            $('.checkboxhidden_zeroone',parent).val("1");
            $('.checkboxhidden_imagevideo',parent).val("image");
            $('.checkboxhidden_yesempty',parent).val("yes");
            $('.checkboxhidden_flagpost',parent).val("post");
            $('.checkboxhidden_flagpage',parent).val("page");
            $('.checkboxhidden_flagmedia',parent).val("attachment");
            $('.checkboxhidden_flagportfolio',parent).val("portfolio_page");
            $('.checkboxhidden_flagproduct',parent).val("product");
        });
        $(".cb-disable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-enable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', false);
            $('.checkboxhidden_yesno',parent).val("no");
            $('.checkboxhidden_onoff',parent).val("off");
            $('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_no_follow");
            $('.checkboxhidden_zeroone',parent).val("0");
            $('.checkboxhidden_imagevideo',parent).val("video");
            $('.checkboxhidden_yesempty',parent).val("");
            $('.checkboxhidden_flagpost',parent).val("");
            $('.checkboxhidden_flagpage',parent).val("");
            $('.checkboxhidden_flagmedia',parent).val("");
            $('.checkboxhidden_flagportfolio',parent).val("");
            $('.checkboxhidden_flagproduct',parent).val("");
        });
        $(".cb-enable.dependence").click(function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
        $(".cb-disable.dependence").click(function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
    }

    function mkdInitTooltips() {
        $('.mkd-tooltip').tooltip();
    }

    function mkdInitColorpicker() {
        $('.mkd-page .my-color-field').wpColorPicker({
            change:    function( event, ui ) {
                $('.mkd-input-change').addClass('yes');
            }
        });
    }

    /**
     * Function that initializes
     */
    function mkdInitRangeSlider() {
        if($('.mkd-slider-range').length) {

            $('.mkd-slider-range').each(function() {
                var Link = $.noUiSlider.Link;

                var start       = 0;            //starting position of slider
                var min         = 0;            //minimal value
                var max         = 100;          //maximal value of slider
                var step        = 1;            //number of steps to snap to
                var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
                var prefix      = '';           //prefix to the serialized value that is written field
                var postfix     = '';           //postfix to the serialized value that is written to field
                var thousand    = '';           //separator for thousand
                var decimals    = 2;            //number of decimals
                var mark        = '.';          //decimal separator

                //is data-start attribute set for current instance?
                if($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
                    start = $(this).data('start');
                    if (start == "1.00") start = 1;
                    if(parseInt(start) == start){
                        start = parseInt(start);
                    }
                }

                //is data-min attribute set for current instance?
                if($(this).data('min') != null && $(this).data('min') !== "") {
                    min = $(this).data('min');
                }

                //is data-max attribute set for current instance?
                if($(this).data('max') != null && $(this).data('max') !== "") {
                    max = $(this).data('max');
                }

                //is data-step attribute set for current instance?
                if($(this).data('step') != null && $(this).data('step') !== "") {
                    step = $(this).data('step');
                }

                //is data-orientation attribute set for current instance?
                if($(this).data('orientation') != null && $(this).data('orientation') !== "") {
                    //define available orientations
                    var availableOrientations = ['horizontal', 'vertical'];

                    //is data-orientation value in array of available orientations?
                    if(availableOrientations.indexOf($(this).data('orientation'))) {
                        orientation = $(this).data('orientation');
                    }
                }

                //is data-prefix attribute set for current instance?
                if($(this).data('prefix') != null && $(this).data('prefix') !== "") {
                    prefix = $(this).data('prefix');
                }

                //is data-postfix attribute set for current instance?
                if($(this).data('postfix') != null && $(this).data('postfix') !== "") {
                    postfix = $(this).data('postfix');
                }

                //is data-thousand attribute set for current instance?
                if($(this).data('thousand') != null && $(this).data('thousand') !== "") {
                    thousand = $(this).data('thousand');
                }

                //is data-decimals attribute set for current instance?
                if($(this).data('decimals') != null && $(this).data('decimals') !== "") {
                    decimals = $(this).data('decimals');
                }

                //is data-mark attribute set for current instance?
                if($(this).data('mark') != null && $(this).data('mark') !== "") {
                    mark = $(this).data('mark');
                }

                $(this).noUiSlider({
                    start: start,
                    step: step,
                    orientation: orientation,
                    range: {
                        'min': min,
                        'max': max
                    },
                    serialization: {
                        lower: [
                            new Link({
                                target: $(this).prev('.mkd-slider-range-value')
                            })
                        ],
                        format: {
                            // Set formatting
                            thousand: thousand,
                            postfix: postfix,
                            prefix: prefix,
                            decimals: decimals,
                            mark: mark
                        }
                    }
                }).on({
                    change: function(){
                        $('.mkd-input-change').addClass('yes');
                    }
                });
            });
        }
    }

    function mkdInitMediaUploader() {
        if($('.mkd-media-uploader').length) {
            $('.mkd-media-uploader').each(function() {
                var fileFrame;
                var uploadUrl;
                var uploadHeight;
                var uploadWidth;
                var uploadImageHolder;
                var attachment;
                var removeButton;

                //set variables values
                uploadUrl           = $(this).find('.mkd-media-upload-url');
                uploadHeight        = $(this).find('.mkd-media-upload-height');
                uploadWidth        = $(this).find('.mkd-media-upload-width');
                uploadImageHolder   = $(this).find('.mkd-media-image-holder');
                removeButton        = $(this).find('.mkd-media-remove-btn');

                if (uploadImageHolder.find('img').attr('src') != "") {
                    removeButton.show();
                    mkdInitMediaRemoveBtn(removeButton);
                }

                $(this).on('click', '.mkd-media-upload-btn', function() {
                    //if the media frame already exists, reopen it.
                    if (fileFrame) {
                        fileFrame.open();
                        return;
                    }

                    //create the media frame
                    fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: $(this).data('frame-title'),
                        button: {
                            text: $(this).data('frame-button-text')
                        },
                        multiple: false
                    });

                    //when an image is selected, run a callback
                    fileFrame.on( 'select', function() {
                        attachment = fileFrame.state().get('selection').first().toJSON();
                        removeButton.show();
                        mkdInitMediaRemoveBtn(removeButton);
                        //write to url field and img tag
                        if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                            uploadUrl.val(attachment.url);
                            if (attachment.sizes.thumbnail)
                                uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                            else
                                uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        } else if (attachment.hasOwnProperty('url')) {
                            uploadUrl.val(attachment.url);
                            uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        }

                        //write to hidden meta fields
                        if(attachment.hasOwnProperty('height')) {
                            uploadHeight.val(attachment.height);
                        }

                        if(attachment.hasOwnProperty('width')) {
                            uploadWidth.val(attachment.width);
                        }
                        $('.mkd-input-change').addClass('yes');
                    });

                    //open media frame
                    fileFrame.open();
                });
            });
        }

        function mkdInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.mkd-media-image-holder').hide();
                btn.siblings('.mkd-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.mkd-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    function mkdInitGalleryUploader() {
        var $mkd_upload_button = jQuery('.mkd-gallery-upload-btn');
        var $mkd_clear_button = jQuery('.mkd-gallery-clear-btn');

        wp.media.customlibEditGallery1 = {
            frame: function() {
                if ( this._frame )
                    return this._frame;

                var selection = this.select();

                this._frame = wp.media({
                    id: 'mkd-portfolio-image-gallery',
                    frame: 'post',
                    state: 'gallery-edit',
                    title: wp.media.view.l10n.editGalleryTitle,
                    editing: true,
                    multiple: true,
                    selection: selection
                });

                this._frame.on('update', function() {

                    var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    // Need to get all the attachment ids for gallery
                    var ids = library.pluck('id');

                    $input_gallery_items.val(ids);

                    jQuery.ajax({
                        type: "post",
                        url: ajaxurl,
                        data: "action=depot_mikado_gallery_upload_get_images&ids=" + ids,
                        success: function(data) {
                            $thumbs_wrap.empty().html(data);
                        }
                    });
                });

                return this._frame;
            },

            init: function() {
                $mkd_upload_button.click(function(event) {
                    $thumbs_wrap = $(this).parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    wp.media.customlibEditGallery1.frame().open();
                });

                $mkd_clear_button.click(function(event) {
                    $thumbs_wrap = $mkd_upload_button.parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    $thumbs_wrap.empty();
                    $input_gallery_items.val("");
                });
            },

            // Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
            // in wp-includes/js/media-editor.js.source.html
            select: function() {
                var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
                    defaultPostId = wp.media.gallery.defaults.id,
                    attachments, selection;

                // Bail if we didn't match the shortcode or all of the content.
                if (!shortcode)
                    return;

                // Ignore the rest of the match object.
                shortcode = shortcode.shortcode;

                if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                    shortcode.set('id', defaultPostId);

                attachments = wp.media.gallery.attachments(shortcode);
                selection = new wp.media.model.Selection(attachments.models, {
                    props: attachments.props.toJSON(),
                    multiple: true
                });

                selection.gallery = attachments.gallery;

                // Fetch the query's attachments, and then break ties from the
                // query to allow for sorting.
                selection.more().done(function() {
                    // Break ties with the query.
                    selection.props.set({
                        query: false
                    });
                    selection.unmirror();
                    selection.props.unset('orderby');
                });

                return selection;
            }
        };
        $(wp.media.customlibEditGallery1.init);
    }

    function mkdInitPortfolioItemAcc() {
        //remove portfolio item
        $(document).on('click', '.remove-portfolio-item', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkd-portfolio-additional-item').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    mkdSetIdOnRemoveItem($(this),i+1);
                });
                //hide expand all button if all items are removed
                noPortfolioItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noPortfolioItemShown();
        function noPortfolioItemShown()  {
            if($('.mkd-portfolio-additional-item').length == 0){
                $('.mkd-toggle-all-item').hide();
            }
        }

        //expand all additional sidebar items on click on 'expand all' button
        $(document).on('click', '.mkd-toggle-all-item', function(event) {
            event.preventDefault();
            $('.mkd-portfolio-additional-item').each(function(i){

                var $toggleContent = $(this).find('.mkd-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for portfolio additional sidebar items
        $(document).on('click', '.mkd-portfolio-additional-item .mkd-portfolio-toggle-holder', function(event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.mkd-toggle-all-item', function(event) {
            event.preventDefault();
            $(this).hide();
        });

        function checkExpandAllBtn() {
            if($('.mkd-portfolio-additional-item .mkd-portfolio-toggle-content:hidden').length == 0){
                $('.mkd-toggle-all-item').hide();
            }else{
                $('.mkd-toggle-all-item').show();
            }
        }
    }

    function mkdInitPortfolioItemsBox() {
        var mkd_portfolio_additional_item = $('.mkd-portfolio-additional-item-holder').clone().html();
        $portfolio_item = '<div class="mkd-portfolio-additional-item" rel="">'+ mkd_portfolio_additional_item +'</div>';

        $('.mkd-portfolio-add a.mkd-add-item').click(function (event) {
            event.preventDefault();
            $(this).parent().before($($portfolio_item).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkd-portfolio-additional-item').length;
            $(this).parent().siblings('.mkd-portfolio-additional-item:last').attr('rel',portfolio_num);
            mkdSetIdOnAddItem($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });
    }

    function mkdSetIdOnAddItem(addButton,portfolio_num){
        addButton.siblings('.mkd-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    function mkdSetIdOnRemoveItem(portfolio,portfolio_num){
        if(portfolio_num == undefined){
            var portfolio_num = portfolio.attr('rel');
        }else{
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+portfolio_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }
    
    function mkdInitPortfolioMediaAcc() {
        //remove portfolio media
        $(document).on('click', '.remove-portfolio-media', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkd-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    mkdSetIdOnRemoveMedia($(this),i+1);
                });
                //hide expand all button if all medias are removed
                noPortfolioMedia()
            });  return false;
        });

        //hide 'expand all' button if there is no media
        noPortfolioMedia();
        function noPortfolioMedia() {
            if($('.mkd-portfolio-media').length == 0){
                $('.mkd-toggle-all-media').hide();
            }
        }

        //expand all portfolio medias (video and images) onClick on 'expand all' button
        $(document).on('click','.mkd-toggle-all-media', function(event) {
            event.preventDefault();
            $('.mkd-portfolio-media').each(function(i){

                var $toggleContent = $(this).find('.mkd-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-media');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }

            });        return false;
        });
        //toggle for portfolio media (images or videos)
        $(document).on('click', '.mkd-portfolio-media .mkd-portfolio-toggle-holder', function(event) {
            event.preventDefault();
            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-media');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $(this).next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllMediaBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.mkd-toggle-all-media', function(event) {
            event.preventDefault();
            $(this).hide();
        });
        function checkExpandAllMediaBtn() {
            if($('.mkd-portfolio-media .mkd-portfolio-toggle-content:hidden').length == 0){
                $('.mkd-toggle-all-media').hide();
            }else{
                $('.mkd-toggle-all-media').show();
            }
        }
    }
    
    function mkdInitPortfolioImagesVideosBox() {
        var mkd_portfolio_images = $('.mkd-hidden-portfolio-images').clone().html();
        $portfolio_image = '<div class="mkd-portfolio-images mkd-portfolio-media" rel="">'+ mkd_portfolio_images +'</div>';
        var mkd_portfolio_videos = $('.mkd-hidden-portfolio-videos').clone().html();

        $portfolio_videos = '<div class="mkd-portfolio-videos mkd-portfolio-media" rel="">'+ mkd_portfolio_videos +'</div>';
        $('a.mkd-add-image').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_image).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkd-portfolio-media').length;
            $(this).parent().siblings('.mkd-portfolio-media:last').attr('rel',portfolio_num);
            mkdInitMediaUploaderAdded($(this).parent());
            mkdSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $('a.mkd-add-video').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_videos).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkd-portfolio-media').length;
            $(this).parent().siblings('.mkd-portfolio-media:last').attr('rel',portfolio_num);
            mkdInitMediaUploaderAdded($(this).parent());
            mkdSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $(document).on('click', '.mkd-remove-last-row-media', function(event) {
            event.preventDefault();
            $(this).parent().prev().fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkd-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    mkdSetIdOnRemoveMedia($(this),i+1);
                });
            });
        });
        mkdShowHidePorfolioImageVideoType();
        $(document).on('change', 'select.mkd-portfoliovideotype', function(e) {
            mkdShowHidePorfolioImageVideoType();
        });
    }

    function mkdSetIdOnAddMedia(addButton,portfolio_num){
        addButton.siblings('.mkd-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });

        mkdShowHidePorfolioImageVideoType();
    }

    function mkdSetIdOnRemoveMedia(portfolio,portfolio_num){
        if(portfolio_num == undefined){
            var portfolio_num = portfolio.attr('rel');
        }else{
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+portfolio_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    function mkdShowHidePorfolioImageVideoType(){
        $('.mkd-portfoliovideotype').each(function(i){
            var $selected = $(this).val();

            if($selected == "self"){
                $(this).parent().parent().parent().find('.mkd-video-id-holder').hide();
                $(this).parent().parent().parent().parent().find('.mkd-media-uploader').show();
                $(this).parent().parent().parent().find('.mkd-video-self-hosted-path-holder').show();
            }else{
                $(this).parent().parent().parent().find('.mkd-video-id-holder').show();
                $(this).parent().parent().parent().parent().find('.mkd-media-uploader').hide();
                $(this).parent().parent().parent().find('.mkd-video-self-hosted-path-holder').hide();
            }
        });
    }

    function mkdInitMediaUploaderAdded(addButton) {
        addButton.siblings('.mkd-portfolio-media:last, .mkd-slide-element-additional-item:last').find('.mkd-media-uploader').each(function(){
            var fileFrame;
            var uploadUrl;
            var uploadHeight;
            var uploadWidth;
            var uploadImageHolder;
            var attachment;
            var removeButton;

            //set variables values
            uploadUrl           = $(this).find('.mkd-media-upload-url');
            uploadHeight        = $(this).find('.mkd-media-upload-height');
            uploadWidth        = $(this).find('.mkd-media-upload-width');
            uploadImageHolder   = $(this).find('.mkd-media-image-holder');
            removeButton        = $(this).find('.mkd-media-remove-btn');

            if (uploadImageHolder.find('img').attr('src') != "") {
                removeButton.show();
                mkdInitMediaRemoveBtn(removeButton);
            }

            $(this).on('click', '.mkd-media-upload-btn', function() {
                //if the media frame already exists, reopen it.
                if (fileFrame) {
                    fileFrame.open();
                    return;
                }

                //create the media frame
                fileFrame = wp.media.frames.fileFrame = wp.media({
                    title: $(this).data('frame-title'),
                    button: {
                        text: $(this).data('frame-button-text')
                    },
                    multiple: false
                });

                //when an image is selected, run a callback
                fileFrame.on( 'select', function() {
                    attachment = fileFrame.state().get('selection').first().toJSON();
                    removeButton.show();
                    mkdInitMediaRemoveBtn(removeButton);
                    //write to url field and img tag
                    if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                        uploadUrl.val(attachment.url);
                        if (attachment.sizes.thumbnail)
                            uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                        else
                            uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    } else if (attachment.hasOwnProperty('url')) {
                        uploadUrl.val(attachment.url);
                        uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    }

                    //write to hidden meta fields
                    if(attachment.hasOwnProperty('height')) {
                        uploadHeight.val(attachment.height);
                    }

                    if(attachment.hasOwnProperty('width')) {
                        uploadWidth.val(attachment.width);
                    }
                    $('.mkd-input-change').addClass('yes');
                });

                //open media frame
                fileFrame.open();
            });
        });

        function mkdInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.mkd-media-image-holder').hide();
                btn.siblings('.mkd-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.mkd-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    /**
        Slide elements script - start
    */
    function mkdInitSlideElementItemAcc() {
        //remove slide-element item
        $(document).on('click', '.remove-slide-element-item', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing slide-element image, set new rel numbers and set new ids/names
                $('.mkd-slide-element-additional-item').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    mkdSetIdOnRemoveElement($(this),i+1);
                });
                //hide expand all button if all items are removed
                noSlideElementItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noSlideElementItemShown();
        function noSlideElementItemShown()  {
            if($('.mkd-slide-element-additional-item').length == 0){
                $('.mkd-toggle-all-item').hide();
            }
        }

        //expand all additional items on click on 'expand all' button
        $(document).on('click', '.mkd-toggle-all-item', function(event) {
            event.preventDefault();
            $('.mkd-slide-element-additional-item').each(function(i){

                var $toggleContent = $(this).find('.mkd-slide-element-toggle-content');
                var $this = $(this).find('.toggle-slide-element-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for slide-element item
        $(document).on('click', '.mkd-slide-element-additional-item .mkd-slide-element-toggle-holder', function(event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-slide-element-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.mkd-toggle-all-item', function(event) {
            event.preventDefault();
            $(this).hide();
        });

        //reveal only the fields for custom positioning of elements
        $(document).on('change', '#mkd_mkd_slide_holder_elements_alignment select', function(event) {
            var meta_box = $(this).parents('#mkd-meta-box-mkd_slides_elements');
            if ($(this).find('option:selected').attr('value') == 'custom') {
                meta_box.find('.mkd-slide-element-custom-only').slideDown(300);
                meta_box.find('.mkd-slide-element-all-but-custom').slideUp(300);
            }
            else {
                meta_box.find('.mkd-slide-element-all-but-custom').slideDown(300);
                meta_box.find('.mkd-slide-element-custom-only').slideUp(300);
            }
        });

        //reveal only the fields for certain type of the element
        $(document).on('change', '.mkd-slide-element-type-selector', function(event) {
            var type_fields_holders = $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-element-type-fields');
            type_fields_holders.not('.mkd-setf-'+$(this).find('option:selected').attr('value')).slideUp(300);
            type_fields_holders.filter('.mkd-setf-'+$(this).find('option:selected').attr('value')).slideDown(300);
        });

        // reveal advanced text options
        $(document).on('change', '.mkd-slide-element-options-selector-text', function(event) {
            if ($(this).find('option:selected').attr('value') == 'advanced') {
                $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-elements-advanced-text-options').slideDown(300);
                $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-elements-simple-text-options').slideUp(300);
            }
            else {
                $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-elements-advanced-text-options').slideUp(300);
                $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-elements-simple-text-options').slideDown(300);
            }
        });

        // reveal responsive text options
        $(document).on('change', '.mkd-slide-element-responsive-selector', function(event) {
            if ($(this).find('option:selected').attr('value') == 'yes') {
                $(this).parents('.mkd-slide-element-type-fields').find('.mkd-slide-element-scale-factors').slideDown(300);
            }
            else {
                $(this).parents('.mkd-slide-element-type-fields').find('.mkd-slide-element-scale-factors').slideUp(300);
            }
        });

        // reveal responsive element options
        $(document).on('change', '.mkd-slide-element-responsiveness-selector', function(event) {
            if ($(this).find('option:selected').attr('value') == 'stages') {
                $(this).closest('.row').siblings('.mkd-slide-responsive-scale-factors').slideDown(300);
            }
            else {
                $(this).closest('.row').siblings('.mkd-slide-responsive-scale-factors').slideUp(300);
            }
        });

        //update the default screen width in elements
        $(document).on('change keyup', "input[name='mkd_slide_elements_default_width']", function(event) {
            $(this).parents('#mkd-meta-box-mkd_slides_elements').find('.mkd-slide-dynamic-def-width').html($(this).attr('value'));
        });

        // reveal proper icon picker
        $(document).on('change', '.mkd-slide-element-button-icon-pack', function(event) {
            var icon_pack = $(this).find('option:selected').attr('value');
            if (icon_pack == 'no_icon') {
                $(this).parents('.mkd-slide-element-additional-item').find('.mkd-slide-element-button-icon-collection').slideUp(300);
            }
            else {
                $(this)
                .parents('.mkd-slide-element-additional-item')
                .find('.mkd-slide-element-button-icon-collection.'+icon_pack).slideDown(300)
                .siblings('.mkd-slide-element-button-icon-collection').slideUp(300);
            }
        });

        function checkExpandAllBtn() {
            if($('.mkd-slide-element-additional-item .mkd-slide-element-toggle-content:hidden').length == 0){
                $('.mkd-toggle-all-item').hide();
            }else{
                $('.mkd-toggle-all-item').show();
            }
        }
    }

    function mkdInitSlideElementItemsBox() {
        $('.mkd-slide-element-add a.mkd-add-item').click(function (event) {
            var mkd_slide_element = $('.mkd-slide-element-additional-item-holder').clone().html();
            $slide_element = '<div class="mkd-slide-element-additional-item" rel="">'+ mkd_slide_element +'</div>';
            event.preventDefault();
            $(this).parent().before($($slide_element).hide().fadeIn(500));
            mkdInitMediaUploaderAdded($(this).parent());
            var elem_num = $(this).parent().siblings('.mkd-slide-element-additional-item').length;
            var item = $(this).parent().siblings('.mkd-slide-element-additional-item:last');
            item.attr('rel',elem_num);
            item.find('.wp-picker-container').each(function() {
                var picker = $(this);
                var input = picker.find('input[type="text"]');
                picker.before('<input type="text" id="'+ input.attr('id') +'" name="'+ input.attr('name') +'" value="" class="my-color-field"/>').remove();
            });
            item.find('.my-color-field').wpColorPicker();
            mkdSetIdOnAddElement($(this).parent(),elem_num);
            $(this).parent().prev().find('.number').text(elem_num);
        });
    }

    function mkdSetIdOnAddElement(addButton,elem_num){
        addButton.siblings('.mkd-slide-element-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+elem_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    function mkdSetIdOnRemoveElement(element,elem_num){
        if(elem_num == undefined){
            var elem_num = element.attr('rel');
        }else{
            var elem_num = elem_num;
        }

        element.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+elem_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    /**
        Slide elements script - end
    */
    function mkdInitAjaxForm() {
        $('#mkd_top_save_button').click( function() {
            $('.mkd_ajax_form').submit();
            if ($('.mkd-input-change.yes').length) {
                $('.mkd-input-change.yes').removeClass('yes');
            }
            $('.mkd-changes-saved').addClass('yes');
            setTimeout(function(){$('.mkd-changes-saved').removeClass('yes');}, 3000);
            return false;
        });
        $(document).delegate(".mkd_ajax_form", "submit", function (a) {
            var b = $(this);
            var c = {
                action: "depot_mikado_save_options"
            };
            jQuery.ajax({
                url: ajaxurl,
                cache: !1,
                type: "POST",
                data: jQuery.param(c, !0) + "&" + b.serialize()
            }), a.preventDefault(), a.stopPropagation()
        })
    }

    function mkdInitDatePicker() {
        $( ".mkd-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
    }
    function mkdInitSelectPicker() {
        $(".mkd-selectpicker").selectpicker();
    }

	function mkdShowHidePostFormats(){
        $('input[name="post_format"]').each(function(){
            var id = $(this).attr('id');
            if(id !== '' && id !== undefined) {
                var metaboxName = id.replace(/-/g, '_');
                $('#mkd-meta-box-'+ metaboxName +'_meta').hide(); 
            }
        });
        
        var selectedId = $("input[name='post_format']:checked").attr("id");
        if(selectedId !== '' && selectedId !== undefined) {
            var selected = selectedId.replace(/-/g, '_');
            $('#mkd-meta-box-' + selected + '_meta').fadeIn();    
        }

        $("input[name='post_format']").change(function() {
            mkdShowHidePostFormats();
        });
	}

    function mkdPageTemplatesMetaBoxDependency(){
        if($('#page_template').length) {
            var selected = $('#page_template').val();
            var template_name_parts = selected.split("-");

            if (template_name_parts[0] !== 'blog') {
                $('#mkd-meta-box-blog-meta').hide();
            } else {
                $('#mkd-meta-box-blog-meta').show();
            }
            $('select[name="page_template"]').change(function () {
                mkdPageTemplatesMetaBoxDependency();
            });
        }
    }

    function mkdRepeater(){
        var addNew = $('.mkd-repeater-add .mkd-clone'); // add new button
        var removeBtn = $('.mkd-clone-remove');
        if (addNew.length) {
            $('.mkd-repeater-fields-holder').each(function(){
                var thisHolderRows = $(this).find('.mkd-repeater-fields-row');
                if(thisHolderRows.length == 1 && thisHolderRows.find(':input').val() == ''){
                    thisHolderRows.hide();
                }
            });
            addNew.on('click', function (e) {
                e.preventDefault();
                var thisAddNew = $(this);
                var append = true; // flag for showing or appending new row
                var fieldsHolder = thisAddNew.parent().siblings('.mkd-repeater-fields-holder'); // container of all rows - parent to append new row
                var rows = fieldsHolder.find('.mkd-repeater-fields-row');
                if (rows.length == 1 && rows.css('display') == 'none') {
                    rows.show();
                    append = false;
                }
                if (append) {
                    var rowIndex = thisAddNew.data('count'); // number of rows for changing id stored as data of add new button
                    var firstChild = rows.eq(0).clone(); // clone first row
                    var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
                    var mediaUploader = false; // flag for initializing media uploader - calling wpColorPicker

                    firstChild.find('.mkd-repeater-field').each(function () {

                            var thisField = $(this);
                            var id = thisField.attr('id');
                            if (typeof id !== 'undefined') {
                                thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
                            }
                            thisField.find(':input').each(function () {
                                var thisInput = $(this);
                                if (thisInput.hasClass('my-color-field')) { // if input type is color picker
                                    thisInput.parents('.wp-picker-container').html(thisInput); // overwrite added html with field html- wpColorPicker adds it on initialization
                                    colorPicker = true;
                                }
                                else if (thisInput.hasClass('mkd-media-upload-url')) {// if input type is media uploader
                                    mediaUploader = true;
                                    var btn = thisInput.parent().siblings('.mkd-media-remove-btn');
                                    mkdInitMediaRemoveBtn(btn); // get and init new remove btn
                                    btn.trigger('click'); // trigger click to reset values
                                }
                                thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
                                if(thisInput.is(':radio')){
                                    thisInput.val(fieldsHolder.find(':radio').length);
                                }
                            });
                        }
                    );

                    thisAddNew.data('count', rowIndex + 1); //increase number of rows
                    firstChild.appendTo(fieldsHolder); // append html
                    removeRow($('.mkd-clone-remove'));
                    if (colorPicker) { // reinit colorpickers
                        $('.mkd-page .my-color-field').wpColorPicker();
                    }
                    if (mediaUploader) {
                        // deregister click on all media buttons (multiple frames will be opened otherwise)
                        $('.mkd-media-uploader').off('click', '.mkd-media-upload-btn');
                        mkdInitMediaUploader();
                    }
                }
            });
        }
        
        if (removeBtn.length) {
            removeRow(removeBtn);
        }

        function removeRow(removeBtn){
            removeBtn.on('click', function (e) {
                e.preventDefault();
                var thisRemoveBtn = $(this);
                var parentRow = thisRemoveBtn.parents('.mkd-repeater-fields-row');
                if (parentRow.is(':first-child') && thisRemoveBtn.parents('.mkd-repeater-fields-holder').find('.mkd-repeater-fields-row').length == 1) {
                    parentRow.find(':input').val('').removeAttr('checked').removeAttr('selected');
                    parentRow.hide();
                } else if(!parentRow.is(':first-child')) {
                    parentRow.remove();
                }
            });
        }
    }

	function mkdImportOptions(){
		if($('.mkd-backup-options-page-holder').length) {
			var mkdImportBtn = $('#mkd-import-theme-options-btn');
			mkdImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Options now?')) {
					mkdImportBtn.blur();
					mkdImportBtn.text('Please wait');
					var importValue = $('#import_theme_options').val();
					var importNonce = $('#mkd_import_theme_options_secret').val();
					var data = {
						action: 'depot_mikado_import_theme_options',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								mkdImportBtn.text('Import');
								$('.mkd-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}

	function mkdImportCustomSidebars(){

		if($('.mkd-backup-options-page-holder').length) {
			var mkdImportBtn = $('#mkd-import-custom-sidebars-btn');
			mkdImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
					mkdImportBtn.blur();
					mkdImportBtn.text('Please wait');
					var importValue = $('#import_custom_sidebars').val();
					var importNonce = $('#mkd_import_custom_sidebars_secret').val();
					var data = {
						action: 'mkd_core_import_custom_sidebars',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								mkdImportBtn.text('Import');
								$('.mkd-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	function mkdImportWidgets(){

		if($('.mkd-backup-options-page-holder').length) {
			var mkdImportBtn = $('#mkd-import-widgets-btn');
			mkdImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Widgets now?')) {
					mkdImportBtn.blur();
					mkdImportBtn.text('Please wait');
					var importValue = $('#import_widgets').val();
					var importNonce = $('#mkd_import_widgets_secret').val();
					var data = {
						action: 'mkd_core_import_widgets',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								mkdImportBtn.text('Import');
								$('.mkd-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
})(jQuery);
