(function($) {
    "use strict";

    window.mkdf = {};
    mkdf.modules = {};

    mkdf.scroll = 0;
    mkdf.window = $(window);
    mkdf.document = $(document);
    mkdf.windowWidth = $(window).width();
    mkdf.windowHeight = $(window).height();
    mkdf.body = $('body');
    mkdf.html = $('html, body');
    mkdf.menuDropdownHeightSet = false;
    mkdf.defaultHeaderStyle = '';
    mkdf.minVideoWidth = 1500;
    mkdf.videoWidthOriginal = 1280;
    mkdf.videoHeightOriginal = 720;
    mkdf.videoRatio = 1.61; // golden ration for video
    mkdf.boxedLayoutWidth = 1180;
    
    $(document).ready(function(){
        mkdf.scroll = $(window).scrollTop();
    });


    $(window).resize(function() {
        mkdf.windowWidth = $(window).width();
        mkdf.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        mkdf.scroll = $(window).scrollTop();
    });

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    mkdf.modules.common = common;

    common.mkdfIsTouchDevice = mkdfIsTouchDevice;
    common.mkdfDisableSmoothScrollForMac = mkdfDisableSmoothScrollForMac;
    common.mkdfInitAudioPlayer = mkdfInitAudioPlayer;
    common.mkdfPostGallerySlider = mkdfPostGallerySlider;
    common.mkdfFluidVideo = mkdfFluidVideo;
    common.mkdfPreloadBackgrounds = mkdfPreloadBackgrounds;
    common.mkdfEnableScroll = mkdfEnableScroll;
    common.mkdfDisableScroll = mkdfDisableScroll;
    common.mkdfWheel = mkdfWheel;
    common.mkdfKeydown = mkdfKeydown;
    common.mkdfPreventDefaultValue = mkdfPreventDefaultValue;
    common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
    common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
    common.mkdfInitBackToTop = mkdfInitBackToTop;
    common.mkdfBackButtonShowHide = mkdfBackButtonShowHide;
    common.mkdfAccessPress = mkdfAccessPress;
    

	$(document).ready(function() {
        mkdfIsTouchDevice();
        mkdfDisableSmoothScrollForMac();
        mkdfInitAudioPlayer();
		mkdfFluidVideo();
        mkdfPostGallerySlider();
        mkdfPreloadBackgrounds();
        mkdfInitElementsAnimations();
        mkdfInitAnchor().init();
        mkdfInitVideoBackground();
        mkdfInitVideoBackgroundSize();
        mkdfInitSelfHostedVideoPlayer();
		mkdfSelfHostedVideoSize();
        mkdfInitBackToTop();
        mkdfBackButtonShowHide();
        mkdfPostRatings().init();
        mkdfAccessPress();
	});

	$(window).resize(function() {
		mkdfInitVideoBackgroundSize();
		mkdfSelfHostedVideoSize();
	});

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function mkdfIsTouchDevice() {
        if(Modernizr.touch && !mkdf.body.hasClass('mkdf-no-animations-on-touch')) {
            mkdf.body.addClass('mkdf-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function mkdfDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
            mkdf.body.removeClass('mkdf-smooth-scroll');
        }
    }

	function mkdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function mkdfInitAudioPlayer() {

        var players = $('audio.mkdf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /*
    **  Init gallery post slider 
    */
    function mkdfPostGallerySlider(){

        var bsHolder = $('.mkdf-pg-slider');

        if(bsHolder.length){
            bsHolder.each(function(){
                var thisBsHolder = $(this);

                thisBsHolder.flexslider({
                    selector: ".mkdf-pg-slides",
                    animation: "fade",
                    controlNav: false,
                    directionNav: true,
                    prevText: "<i class='mkdf-pg-ion-icon ion-ios-arrow-back'></i>",
                    nextText: "<i class='mkdf-pg-ion-icon ion-ios-arrow-forward'></i>",
                    slideshowSpeed: 6000,
                    animationSpeed: 400,  
                });
            });
        }
    }

    /*
     *	Preload background images for elements that have 'mkdf-preload-background' class
     */
    function mkdfPreloadBackgrounds(){

        $(".mkdf-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('mkdf-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('mkdf-preload-background'); }); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    /*
     *	Start animations on elements
     */
    function mkdfInitElementsAnimations(){

        var touchClass = $('.mkdf-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
            clasess,
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var element = $(this);

                clasess = element.attr('class').split(/\s+/);
                animationClass = clasess[1];

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

    /*
     **	Anchor functionality
     */
    var mkdfInitAnchor = mkdf.modules.common.mkdfInitAnchor = function() {

        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function(anchor){

            $('.mkdf-main-menu .mkdf-active-item, .mkdf-mobile-nav .mkdf-active-item, .mkdf-vertical-menu .mkdf-active-item, .mkdf-fullscreen-menu .mkdf-active-item').removeClass('mkdf-active-item');
            anchor.parent().addClass('mkdf-active-item');

            $('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-vertical-menu a, .mkdf-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function(){

            $('[data-mkdf-anchor]').waypoint( function(direction) {
                if(direction === 'down') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
                }
            }, { offset: '50%' });

            $('[data-mkdf-anchor]').waypoint( function(direction) {
                if(direction === 'up') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
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

            if(hash !== "" && $('[data-mkdf-anchor="'+hash+'"]').length > 0){
                //triggers click which is handled in 'anchorClick' function
                $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function(anchoredElementOffset){

            var headerHeight = mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function() {
            mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-btn, .mkdf-anchor", function() {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if(hash !== "" && $('[data-mkdf-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                    var anchoredElementOffset = $('[data-mkdf-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-mkdf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                    setActiveState(anchor);

                    mkdf.html.stop().animate({
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
                if($('[data-mkdf-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function() { checkActiveStateOnLoad(); });
                }
            }
        };

    };

    /*
     **	Video background initialization
     */
    function mkdfInitVideoBackground(){

        $('.mkdf-section .mkdf-video-wrap .mkdf-video').mediaelementplayer({
            enableKeyboard: false,
            iPadUseNativeControls: false,
            pauseOtherPlayers: false,
            // force iPhone's native controls
            iPhoneUseNativeControls: false,
            // force Android's native controls
            AndroidUseNativeControls: false
        });

        //mobile check
        if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
            mkdfInitVideoBackgroundSize();
            $('.mkdf-section .mkdf-mobile-video-image').show();
            $('.mkdf-section .mkdf-video-wrap').remove();
        }
    }

    /*
     **	Calculate video background size
     */
    function mkdfInitVideoBackgroundSize(){

        $('.mkdf-section .mkdf-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.mkdf-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.mkdf-section').outerHeight();
            mkdf.minVideoWidth = mkdf.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / mkdf.videoWidthOriginal;
            var scaleV = sectionHeight / mkdf.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * mkdf.videoWidthOriginal < mkdf.minVideoWidth) {scale = mkdf.minVideoWidth / mkdf.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * mkdf.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * mkdf.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });
    }

    function mkdfDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = mkdfWheel;
        document.onkeydown = mkdfKeydown;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfWheel(e) {
        mkdfPreventDefaultValue(e);
    }

    function mkdfKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                mkdfPreventDefaultValue(e);
                return;
            }
        }
    }

    function mkdfPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function mkdfInitSelfHostedVideoPlayer() {

        var players = $('.mkdf-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function mkdfSelfHostedVideoSize(){

		$('.mkdf-self-hosted-video-holder .mkdf-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / mkdf.videoRatio;

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

    function mkdfToTopButton(a) {
        
        var b = $("#mkdf-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function mkdfBackButtonShowHide(){
        mkdf.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { mkdfToTopButton('off'); } else { mkdfToTopButton('on'); }
        });
    }

    function mkdfInitBackToTop(){
        var backToTopButton = $('#mkdf-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop()/3, 'linear');
        });
    }

    /**
     * Object that sets ratings for blog single
     * @returns {{init: Function}} function that initializes blog single ratings functionality
     */
    var mkdfPostRatings = mkdf.modules.common.mkdfPostRatings = function(){

        // get all stars for rating
        var ratings = $('.mkdf-ratings-stars-inner'),
            messageHolder = $('.mkdf-ratings-message-holder'),
            ratingsMessage = messageHolder.children('.mkdf-rating-message'),
            ratingsValue = messageHolder.children('.mkdf-rating-value'),
            thisPost = $('.single-post article'),
            ratingId,
            thisPostId,
            postData;

        thisPostId = (thisPost.length)? thisPost.attr('id').match(/\d+/)[0] : '';

        /**
         * Function that triggers set ratings functionality
         */
        var mkdfPostRatingsEvent = function () {
            ratings.children().hover(
                function () {
                    if(!ratings.hasClass('mkdf-ratings-rated')) {
                        ratingId = ($(this).attr('id').match(/\d+/)[0]);
                        ratings.children().each(function () {
                            if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                                $(this).addClass('mkdf-hover-rating-star');
                            } else {
                                $(this).removeClass('mkdf-hover-rating-star');
                            }
                        });
                    }
                },
                function () {
                    if(!ratings.hasClass('mkdf-ratings-rated')) {
                        ratings.children().each(function () {
                            $(this).removeClass('mkdf-hover-rating-star');
                        });
                    }
                });

            ratings.children().click(function(){
                if(!ratings.hasClass('mkdf-ratings-rated')) {

                    ratingId = ($(this).attr('id').match(/\d+/)[0]);

                    ratings.children().each(function () {
                        if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                            $(this).addClass('mkdf-active-rating-star');
                        } else {
                            $(this).removeClass('mkdf-active-rating-star');
                        }
                    });
                    ratings.addClass('mkdf-ratings-rated');

                    postData = {
                        action: 'chillnews_mikado_post_rating_ajax_function',
                        postID: thisPostId,
                        value: ratingId
                    };
                    
                    $.ajax({
                        type: 'POST',
                        data: postData,
                        url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                        success: function (data) {
                            var response = $.parseJSON(data);
                            ratingsMessage.html(response.rateAnswer);
                            ratingsMessage.fadeIn();
                            ratingsValue.html("Current rate is: " + response.newCount);
                            ratingsValue.fadeIn();
                        }
                    });
                }
            })
        };

        return {
            init : function() {
                if (ratings.length) {
                    ratings.each(function () {
                        mkdfPostRatingsEvent();
                    });
                }
            }
        };
    };

    /*
    * Access press hover calcs
    */
    function mkdfAccessPress() {
        var accessPress = $('.mkdf-apsc-custom-style-enabled .widget_apsc_widget');
        if (accessPress.length) {
            accessPress.each(function(){
                var socialIcon = $(this).find('.social-icon');
                socialIcon.each(function(){
                    var thisSocialIcon =  $(this);
                    thisSocialIcon.find('i').clone().appendTo(thisSocialIcon).addClass('mkdf-additional-icon');
                });
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.mkdfInitMobileNavigation = mkdfInitMobileNavigation;
    header.mkdfMobileHeaderBehavior = mkdfMobileHeaderBehavior;
    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfSetWideMenuPosition = mkdfSetWideMenuPosition;
    header.mkdfDropDownMenu = mkdfDropDownMenu;
    header.mkdfSearch = mkdfSearch;

    $(document).ready(function() {
        mkdfHeaderBehaviour();
        mkdfInitMobileNavigation();
        mkdfMobileHeaderBehavior();
        mkdfSearch();
    });

    $(window).load(function() {
        mkdfDropDownMenu();
    });

    $(window).resize(function() {
        mkdfDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {

        var header = $('.mkdf-page-header');
        var stickyHeader = $('.mkdf-sticky-header');
        var stickyAppearAmount;

        var fixedHeaderWrapper = $('.mkdf-fixed-wrapper');
        var headerMenuAreaOffset = $('.mkdf-page-header').find('.mkdf-fixed-wrapper').length ? $('.mkdf-page-header').find('.mkdf-fixed-wrapper').offset().top: null;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    }else {
                        mkdf.modules.header.isStickyVisible = true;
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
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-down-up';
                stickyAppearAmount = mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0 ? mkdfPerPageVars.vars.mkdfStickyScrollAmount : mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight;
                mkdf.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(mkdf.scroll < stickyAppearAmount) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    }else{
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, when viewport hits header's top position it remains fixed
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.header.behaviour = 'mkdf-fixed-on-scroll';
                //vars
                var cycle = '',
                    menuArea = fixedHeaderWrapper.find('.mkdf-menu-area'),
                    leftHeaderArea = fixedHeaderWrapper.find('.mkdf-position-left'),
                    fixedLogoHolder = fixedHeaderWrapper.find('.mkdf-fixed-logo-holder'),
                    rightWidgetArea = fixedHeaderWrapper.find('.mkdf-position-right'),
                    widgetSearchForm = fixedHeaderWrapper.find('.mkdf-search-menu-holder'),
                    searchInput = widgetSearchForm.find('input'),
                    searchInputPadding = searchInput.css('padding'),
                    searchInputBorder = searchInput.css('border'),
                    searchInputWidth = searchInput.outerWidth(),
                    searchSubmit = widgetSearchForm.find('.mkdf-search-submit'),
                    contentArea = $('.mkdf-page-header .mkdf-menu-area > div'),
                    pageContentAreaWidth = contentArea.outerWidth(),
                    pageContentAreaLeftOffset = contentArea.offset().left;
                //calcs    
                    fixedLogoHolder.animate({opacity:1},300);
                    fixedLogoHolder.css({'width':searchInputWidth});
                    fixedLogoHolder.find('.mkdf-logo-wrapper a').css({height:24});
                //if search disabled 
                    if (!widgetSearchForm.length) {
                        menuArea.css({'width':pageContentAreaWidth});
                    }
                //logic    
                var headerFixed = function(){
                    if(mkdf.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('mkdf-fixed'); //initial state
                        if (widgetSearchForm.length) {
                            menuArea.css({'width':'auto','left':0});
                        }
                        if(fixedHeaderWrapper.hasClass('mkdf-transition-done')) {
                            leftHeaderArea.css({left:0, paddingLeft:0});
                            setTimeout(function(){
                                mkdfSetDropDownMenuPosition();
                                mkdfSetWideMenuPosition();
                            }, 500);
                        } 
                        fixedHeaderWrapper.removeClass('mkdf-transition-done');
                        header.css('margin-bottom',0);
                        rightWidgetArea.css({right:0});
                        searchInput.css({width:searchInputWidth, padding:searchInputPadding, border:searchInputBorder});
                        searchSubmit.removeClass('mkdf-toggle');
                        searchSubmit.removeClass('mkdf-search-field-opened');
                        cycle = 0; //reset cycle

                    } else{
                        cycle++;
                        fixedHeaderWrapper.addClass('mkdf-fixed'); //fixed
                        if (widgetSearchForm.length) {
                            if(mkdf.body.hasClass('mkdf-boxed')) {
                                fixedHeaderWrapper.css({'width':$('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth()});                                
                                menuArea.css({'width':pageContentAreaWidth-parseInt(searchInputWidth)-$('.mkdf-search-submit').outerWidth()+80+'px'});
                                if (mkdf.windowWidth < 1200){
                                    fixedHeaderWrapper.css({'margin-left': '-25px'});
                                    menuArea.css({'width':pageContentAreaWidth-parseInt(searchInputWidth)-$('.mkdf-search-submit').outerWidth()+50+'px'});
                                }
                            } else {
                                menuArea.css({'width':pageContentAreaWidth-parseInt(searchInputWidth)-$('.mkdf-search-submit').outerWidth()+'px'});
                                menuArea.css({'left':-(parseInt(searchInputWidth)+$('.mkdf-search-submit').outerWidth())/2+'px'});
                            }
                        }
                        searchSubmit.addClass('mkdf-toggle');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                        if (cycle == 1) { //do only once
                            headerFixedTransitions();
                            setTimeout(function(){
                                mkdfSetDropDownMenuPosition();
                                mkdfSetWideMenuPosition();
                            }, 500);
                        }
                    }
                };

                var headerFixedTransitions = function() {
                    if (fixedHeaderWrapper.hasClass('mkdf-fixed') && !fixedHeaderWrapper.hasClass('mkdf-transition-done') ) {
                          fixedHeaderWrapper.addClass('mkdf-transition-done'); //trigger function only once
                        if (fixedHeaderWrapper.find('.mkdf-position-right').length){
                            rightWidgetArea.css({right:-parseInt(searchInputWidth)-$('.mkdf-search-submit').outerWidth()+'px'});
                            leftHeaderArea.css({left:fixedLogoHolder.outerWidth()+'px'});
                            searchInput.css({'width':'0','padding':'0','border':'0'});   
                        }
                    }
                };

                var mkdfSearchClick = function() {
                    if(searchSubmit.hasClass('mkdf-toggle') && fixedHeaderWrapper.hasClass('mkdf-fixed')) {
                        searchSubmit.unbind('click');
                        searchSubmit.bind('click'); // reset number of clicks
                        searchSubmit.on('click',function(event){
                            if(!searchSubmit.hasClass('mkdf-search-field-opened') && searchSubmit.hasClass('mkdf-toggle')) {
                                    event.preventDefault();
                                    var searchFixedWidth = 160;
                                    searchInput.css({width:searchFixedWidth, padding:searchInputPadding, border:searchInputBorder});
                                    searchInput.focus();
                                    searchSubmit.addClass('mkdf-search-field-opened');
                            } else {
                                if(searchInput.val() === '' && searchSubmit.hasClass('mkdf-toggle')) {
                                    event.preventDefault();
                                    searchSubmit.removeClass('mkdf-search-field-opened');
                                    searchInput.blur();
                                    searchInput.css({'width':'0','padding':'0','border':'0'});
                                    searchInput.val('');
                                }                    
                            }
                        });
                        $(document).on('keyup',function(e){
                            if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                                if(mkdf.scroll > headerMenuAreaOffset){
                                    searchInput.blur();
                                    searchInput.val('');
                                    searchInput.css({'width':'0','padding':'0','border':'0'});
                                    searchSubmit.removeClass('mkdf-search-field-opened');
                                    searchSubmit.addClass('mkdf-search-field-closed');
                                }
                            }
                        });
                    }
                };

                var mkdfMenuAppear = function() {
                    var mainMenu = $('.mkdf-main-menu');
                    if(mainMenu.length){
                        var menuItems =  mainMenu.find('> ul > li'),
                            itemNumber = mainMenu.find('> ul > li').length;
                        if(itemNumber > 7 && itemNumber < 10) {
                            mainMenu.find('> ul > li > a').css('padding','0 18px');
                            setTimeout(function(){
                               menuItems.animate({opacity:1},100);
                            },300);
                        }
                        else if(itemNumber >= 10){
                            mainMenu.find('> ul > li > a').css('padding','0 10px');
                            setTimeout(function(){
                               menuItems.animate({opacity:1},100);
                            },300);
                        } else {
                            setTimeout(function(){
                               menuItems.animate({opacity:1},100);
                            });
                        }
                        
                    }
                };

                //if initially scrolled
                headerFixed();
                mkdfMenuAppear();
                setTimeout(function(){
                    mkdfSetDropDownMenuPosition();
                    mkdfSetWideMenuPosition();
                }, 500);
                if (mkdf.scroll > headerMenuAreaOffset) {
                    mkdfSearchClick();
                }

                $(window).scroll(function() {
                    headerFixed();
                    if (mkdf.scroll > headerMenuAreaOffset) {
                        mkdfSearchClick();
                    }
                });

                $(window).resize(function() {
                    mkdfMenuAppear();
                });

                break;
        }
    }
    

    function mkdfInitMobileNavigation() {
        var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener');
        var navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-nav');
        var dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h6, .mkdf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if(dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('mkdf-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('mkdf-opened');
                    }
                });
            });
        }

        $('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdfMobileHeaderBehavior() {
        if(mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.mkdf-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkdf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('mkdf-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
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
    function mkdfSetDropDownMenuPosition(){

        var menuItems = $(".mkdf-drop-down > ul > li.mkdf-menu-narrow");
        menuItems.each( function(i) {

            var browserWidth = mkdf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if(mkdf.body.hasClass('mkdf-boxed')){
                menuItemFromLeft = mkdf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - mkdf.boxedLayoutWidth)/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.mkdf-menu-sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.mkdf-menu-second').addClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').addClass('right');
            } else {
                $(this).find('.mkdf-menu-second').removeClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').removeClass('right');
            }
        });
    }

    function mkdfSetWideMenuPosition() {

        var browserWidth = mkdf.windowWidth;
        var menu_items = $('.mkdf-drop-down.mkdf-default-nav > ul > li.mkdf-menu-wide');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');
                dropDownSecondDiv.css('left','0'); //reinit left offset for fixed header transition
                var dropdown = $(this).find('.mkdf-menu-inner > ul');
                var dropdownWidth = dropdown.outerWidth();
                var dropdownPosition = dropdown.offset().left;
                var left_position = 0;


                if(!$(this).hasClass('mkdf-menu-left-position') && !$(this).hasClass('mkdf-menu-right-position')) {
                    left_position = dropdownPosition - (browserWidth - dropdownWidth)/2;
                    dropDownSecondDiv.css('left', -left_position);
                    dropDownSecondDiv.css('width', dropdownWidth);
                }
            }
        });
    }

    function mkdfDropDownMenu() {

        var menu_items = $('.mkdf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');

                if($(menu_items[i]).hasClass('mkdf-menu-wide')) {
                    if($(menu_items[i]).data('wide_background_image') !== '' && $(menu_items[i]).data('wide_background_image') !== undefined){
                        var wideBackgroundImageSrc = $(menu_items[i]).data('wide_background_image');
                        dropDownSecondDiv.find('> .mkdf-menu-inner > ul').css('background-image', 'url('+wideBackgroundImageSrc+')');
                    }
                }

                if(!mkdf.menuDropdownHeightSet) {
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
                    $(menu_items[i]).mouseenter(function() {
                        dropDownSecondDiv.css({'height': $(menu_items[i]).data('original_height'), 'opacity': '0'});
                        dropDownSecondDiv.stop().animate({
                            'opacity': '1'
                        }, 0, function() {
                            dropDownSecondDiv.addClass('mkdf-drop-down-start');
                        });
                    }).mouseleave(function() {
                        if(mkdfBlockToHideMenu(dropDownSecondDiv)){
                            dropDownSecondDiv.stop().animate({
                                'height': '0px',
                                'opacity': '0'
                            }, 0, function() {
                                dropDownSecondDiv.removeClass('mkdf-drop-down-start');
                            });
                        }
                    });
                }
            }
        });

        $('.mkdf-drop-down ul li.mkdf-menu-wide ul li a').on('click', function() {
            var $this = $(this);
            setTimeout(function() {
                $this.mouseleave();
            }, 500);
        });

        mkdf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function mkdfSearch() {

        var searchOpener = $('a.mkdf-search-opener');

        searchOpener.click( function(e) {
            e.preventDefault();

            if(!mkdf.body.hasClass('mkdf-search-open')){
                mkdf.body.addClass('mkdf-search-open');
            } else {
                mkdf.body.removeClass('mkdf-search-open');
            }

            searchOpener.parent().children('.mkdf-search-widget-holder').slideToggle();
        });
    }

    /**
     * Block Menu to be hidden
     */
    function mkdfBlockToHideMenu(holder){
        // if posts pagination is not active
        return (holder.find('.mkdf-post-pag-active').length === 0);
    }

})(jQuery);
(function($) {
    'use strict';

    var shortcodes = {};

    mkdf.modules.shortcodes = shortcodes;

    shortcodes.mkdfInitTabs = mkdfInitTabs;
    shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
    shortcodes.mkdfExpandingVideoPost = mkdfExpandingVideoPost;
    shortcodes.mkdfBlockTwo = mkdfBlockTwo;
    shortcodes.mkdfBreakingNews = mkdfBreakingNews;
    shortcodes.mkdfPostClassicSlider = mkdfPostClassicSlider;
    shortcodes.mkdfPostInteractiveSlider = mkdfPostInteractiveSlider;
    shortcodes.mkdfPostSplitSlider = mkdfPostSplitSlider;
    shortcodes.mkdfStickySidebarWidget = mkdfStickySidebarWidget;
    shortcodes.mkdfInitSelect2StyleWooCommerce = mkdfInitSelect2StyleWooCommerce;

    $(document).ready(function() {
        mkdfIcon().init();
		mkdfInitTabs();
        mkdfButton().init();
		mkdfCustomFontResize();
        mkdfExpandingVideoPost();
        mkdfBlockTwo();
        mkdfBreakingNews();
        mkdfPostClassicSlider();
        mkdfPostInteractiveSlider();
        mkdfPostSplitSlider();
        mkdfSocialIconWidget().init();
        mkdfPostPagination().init();
        mkdfInitSelect2StyleWooCommerce();
        mkdfPostLayoutTabWidget().init();
        mkdfPostLayoutHovers();
        mkdfInitQuantityButtons();
    });

    $(window).resize(function(){
		mkdfCustomFontResize();
    });

    $(window).load(function(){
        mkdfStickySidebarWidget().init();
    });

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function() {
        //get all icons on page
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
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

                var iconElement = icon.find('.mkdf-icon-element');
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

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.mkdf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /*
    **	Init tabs shortcode
    */
    function mkdfInitTabs(){

       var tabs = $('.mkdf-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                if(!thisTabs.hasClass('mkdf-ptw-holder')) {
                    thisTabs.children('.mkdf-tab-container').each(function(index){
                        index = index + 1;

                        var that = $(this),
                            link = that.attr('id');

                        var navItem = -1;
                        if(that.parent().find('.mkdf-tabs-nav li').hasClass('mkdf-tabs-title-holder')){
                            index = index + 1;

                            if(that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder .mkdf-tabs-title-image').length) {
                                that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder').children('.mkdf-tabs-title-image:first-child').addClass('mkdf-active-tab-image');
                            }
                        }
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child('+index+') a');

                        var navLink = navItem.attr('href');

                            link = '#'+link;

                            if(link.indexOf(navLink) > -1) {
                                navItem.attr('href',link);
                            }
                    });
                }

                thisTabs.tabs({
                    activate: function() {
                        thisTabs.find('.mkdf-tabs-nav li').each(function(){
                            var thisTab = $(this);

                            if(thisTab.hasClass('ui-tabs-active')) {
                                var activeTab = thisTab.index();

                                if(thisTab.parent().find('.mkdf-tabs-title-image').length) {
                                    thisTab.parent().find('.mkdf-tabs-title-image').removeClass('mkdf-active-tab-image');
                                    thisTab.parent().find('.mkdf-tabs-title-image:nth-child('+activeTab+')').addClass('mkdf-active-tab-image');
                                }
                            }
                        });
                    }
                });
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function() {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

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
         * Initializes button icon hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function(button) {
            if(!button.hasClass('mkdf-btn-outline') && (typeof button.data('icon-hover-bg-color') !== 'undefined' || typeof button.data('icon-hover-bg-color') !== 'undefined')) {
                if(typeof button.data('icon-bg-color') !== 'undefined'){
                    button.children('.mkdf-btn-icon-element').css('background-color', button.data('icon-bg-color'));
                }

                var changeButtonIconBg = function(event) {
                    event.data.button.children('.mkdf-btn-icon-element').css('background-color', event.data.color);
                };

                var originalIconBgColor = (typeof button.data('icon-bg-color') !== 'undefined') ? button.data('icon-bg-color'): 'transparent';
                var hoverIconBgColor = (typeof button.data('icon-hover-bg-color') !== 'undefined') ? button.data('icon-hover-bg-color') : 'transparent';

                button.on('mouseenter', { button: button, color: hoverIconBgColor }, changeButtonIconBg);
                button.on('mouseleave', { button: button, color: originalIconBgColor }, changeButtonIconBg);
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

                var originalBorderColor = button.css('border-color');
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
                        buttonIconHoverBgColor($(this));
                    });
                }
            }
        };
    };

	/*
	**	Custom Font resizing
	*/
	function mkdfCustomFontResize(){
		var customFont = $('.mkdf-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (mkdf.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (mkdf.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (mkdf.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (mkdf.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (mkdf.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && mkdf.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && mkdf.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **  Init video image shortcode
     */
    function mkdfExpandingVideoPost(){

        var videoImageHolder = $('.mkdf-evp-holder');

        if(videoImageHolder.length){
            videoImageHolder.each(function(){
                var thisVideoImageHolder = $(this);

                thisVideoImageHolder.find('.mkdf-evp-image').show();
                var fullImageHeight = thisVideoImageHolder.find('.mkdf-evp-image').height();
                thisVideoImageHolder.find('.mkdf-evp-image').hide();
                var currentImageHeight = thisVideoImageHolder.find('.mkdf-evp-image-inner').height();
                var backgroundImage = thisVideoImageHolder.find('.mkdf-evp-image-inner').css('background-image');

                thisVideoImageHolder.children('.mkdf-evp-image-holder').click(function(e){
                    e.preventDefault();

                    $(this).find('.mkdf-evp-image img').css({'height': currentImageHeight});
                    $(this).children('.mkdf-evp-image-inner').css('background-image','none');
                    $(this).find('.mkdf-evp-image-text').css('display','none');

                    thisVideoImageHolder.find('.mkdf-evp-image').fadeIn().find('img').stop().animate({'height': fullImageHeight}, 500, function() {
                        setTimeout(function(){
                            var videoSource = '';

                            thisVideoImageHolder.children('.mkdf-evp-video-holder').fadeIn();

                            if(thisVideoImageHolder.children('.mkdf-evp-video-holder').find('iframe').length){
                                videoSource = thisVideoImageHolder.children('.mkdf-evp-video-holder').find('iframe').attr('src')+'&amp;autoplay=1;';
                                thisVideoImageHolder.children('.mkdf-evp-video-holder').find('iframe').attr('src',videoSource);
                            } else if (thisVideoImageHolder.children('.mkdf-evp-video-holder').find('video').length) {
                                mkdfExpandingVideoPostSize();
                                thisVideoImageHolder.children('.mkdf-evp-video-holder').find('video.mkdf-self-hosted-video').get(0).play();
                            }
                        }, 300);
                    });

                    thisVideoImageHolder.find('.mkdf-evp-video-close').click(function(e){
                        e.preventDefault();

                        thisVideoImageHolder.children('.mkdf-evp-video-holder').fadeOut();

                        thisVideoImageHolder.find('.mkdf-evp-image img').stop().animate({'height': currentImageHeight}, 500, function() {
                            thisVideoImageHolder.find('.mkdf-evp-image-inner').css({'background-image': backgroundImage});
                            thisVideoImageHolder.find('.mkdf-evp-image-text').css({'display': 'inline-block'});
                            thisVideoImageHolder.find('.mkdf-evp-image').css({'display': 'none'});

                            if (thisVideoImageHolder.children('.mkdf-evp-video-holder').find('video').length) {
                                thisVideoImageHolder.children('.mkdf-evp-video-holder').find('video.mkdf-self-hosted-video').currentTime = 0;
                            }
                        });
                    });
                });
            });
        }
    }

    function mkdfExpandingVideoPostSize(){

        $('.mkdf-evp-holder .mkdf-video-wrap').each(function(){
            var thisVideo = $(this);

            var videoWidth = thisVideo.parents('.mkdf-evp-holder').width();
            var videoHeight = videoWidth / 1.61; //1.61 golden ratio

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

    /*
     **  Init post list slider shortcode
     */
    function mkdfBlockTwo(){

        var BlockTwoHolder = $('.mkdf-pb-two-holder .mkdf-bnl-inner');

        if(BlockTwoHolder.length){
            BlockTwoHolder.each(function(){
                var thisBlockTwoHolder = $(this);
                var thisBlockNonFeaturedHolder = thisBlockTwoHolder.find('.mkdf-post-block-part.mkdf-pb-two-non-featured');
                var thisBlockFeaturedHolder = thisBlockTwoHolder.find('.mkdf-post-block-part.mkdf-pb-two-featured');
                var currentItemPosition = thisBlockTwoHolder.find('.mkdf-post-block-part.mkdf-pb-two-non-featured > .mkdf-post-item:first-child').index()+1; // +1 is because index start from 0 and list from 1
                var activeItemClass = 'mkdf-block-three-active-item';

                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                thisBlockNonFeaturedHolder.children('.mkdf-post-item:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child('+currentItemPosition+')').fadeIn(150);

                thisBlockNonFeaturedHolder.find('a').click(function(e){
                    e.preventDefault();

                    currentItemPosition = $(this).parents('.mkdf-pb-two-non-featured > .mkdf-post-item').index()+1; // +1 is because index start from 0 and list from 1

                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').fadeOut(150);
                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').removeClass(activeItemClass);
                    thisBlockNonFeaturedHolder.children('.mkdf-post-item').removeClass(activeItemClass);


                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                    var BlockTwoTime = setTimeout(function(){
                        thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child('+currentItemPosition+')').fadeIn(150);
                        clearTimeout(BlockTwoTime);
                    },150);
                    thisBlockNonFeaturedHolder.children('.mkdf-post-item:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                });
            });
        }
    }

    /*
    **  Init breaking news
    */
    function mkdfBreakingNews(){

        var bnHolder = $('.mkdf-bn-holder');

        if(bnHolder.length){
            bnHolder.each(function(){
                var thisBnHolder = $(this);

                thisBnHolder.css('display','inline-block');

                var slideshowSpeed = (thisBnHolder.data('slideshowSpeed') !== '' && thisBnHolder.data('slideshowSpeed') !== undefined) ? thisBnHolder.data('slideshowSpeed') : 3000;
                var animationSpeed = (thisBnHolder.data('animationSpeed') !== '' && thisBnHolder.data('animationSpeed') !== undefined) ? thisBnHolder.data('animationSpeed') : 400;

                thisBnHolder.flexslider({
                    selector: ".mkdf-bn-text",
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    maxItems: 1,
                    allowOneSlide: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed
                });
            });
        }
    }

    /*
     **  Init classic slider
    */
    function mkdfPostClassicSlider(){

        var classicSlider = $('.mkdf-psc-holder');

        if(classicSlider.length){
            classicSlider.each(function(){
                var thisSliderHolder = $(this),
                    control = false,
                    directionNav = false;

                switch (thisSliderHolder.data('display_control')){
                    case 'paging': control = true; break;
                    case 'thumbnails': control = "thumbnails"; break;
                    case 'no': control = false; break;
                }

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';

                thisSliderHolder.css('opacity','1');

                thisSliderHolder.flexslider({
                    selector: ".mkdf-psc-slide",
                    animation: "fade",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>", 
                    directionNav: directionNav,
                    prevText: "<span class='ion-ios-arrow-back'></span>",
                    nextText: "<span class='ion-ios-arrow-forward'></span>",
                    maxItems: 1,
                    slideshowSpeed: 4000,
                    animationSpeed: 400,
                    start: function() {
                        mkdfAddPostClassicSliderThumbInfo(thisSliderHolder);
                    },
                });
            });
        }
    }

    /*
     **  Add thumb category and title for classic slider
    */
    function mkdfAddPostClassicSliderThumbInfo(thisSliderHolder){

        var postTitle = '';
        var postCategories = '';
        var postTitleHTML = '';
        var postCategoriesHTML = '';

        if(thisSliderHolder.find('.mkdf-psc-slide').length && thisSliderHolder.children('.flex-control-thumbs').length) {
            thisSliderHolder.find('.mkdf-psc-slide').each(function(i){
                var thisSlide = $(this);
                var thumbHTML = '';
                i++;

                postTitle = (thisSlide.data('posttitle') !== '' && thisSlide.data('posttitle') !== undefined) ? thisSlide.data('posttitle') : '';
                postCategories = (thisSlide.data('postcategory') !== '' && thisSlide.data('postcategory') !== undefined) ? thisSlide.data('postcategory') : '';
            
                if(postTitle !== '') {
                    var excerpt = postTitle.substring(0, 16);
                    postTitleHTML = '<h5 class="mkdf-psc-thumb-title">'+excerpt+'</h5>';
                }

                if(postCategories !== '') {
                    postCategoriesHTML = '<span class="mkdf-psc-thumb-categories">'+postCategories+'</span>';
                } 

                if(postTitleHTML !== '' || postCategoriesHTML !== '') {
                    thisSliderHolder.children('.flex-control-nav').find('li:nth-child('+i+') img').wrap('<span class="mkdf-psc-thumb-inner"></span>');
                    thumbHTML = postTitleHTML + postCategoriesHTML;    
                }

                if (thumbHTML !== '') {
                    thisSliderHolder.children('.flex-control-nav').find('li:nth-child('+i+') .mkdf-psc-thumb-inner').append(thumbHTML);
                }
            });
        }
    }

    /*
     **  Init interactive slider
    */
    function mkdfPostInteractiveSlider(){

        var interactiveSlider = $('.mkdf-psi-holder');

        if(interactiveSlider.length){
            interactiveSlider.each(function(){
                var thisSliderHolder = $(this),
                    thisSliderThumbs,
                    directionNav = false;

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';

                thisSliderHolder.flexslider({
                    selector: ".mkdf-psi-slide",
                    animation: "fade",
                    controlNav: "thumbnails",
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-ios-arrow-back'></span>",
                    nextText: "<span class='ion-ios-arrow-forward'></span>",
                    maxItems: 1,
                    slideshowSpeed: 5000,
                    animationSpeed: 400,
                    start: function() {
                        mkdfAddPostInteractiveSliderThumbInfo(thisSliderHolder);
                        mkdfAddPositionForTitle(thisSliderHolder);
                        mkdfAddPositionForNavigation(thisSliderHolder);
                        thisSliderThumbs = thisSliderHolder.find('.flex-control-thumbs');
                        mkdfAddActiveThumbState(thisSliderThumbs);
                        thisSliderHolder.css('opacity','1');
                    },
                    after: function(){
                        mkdfAddActiveThumbState(thisSliderThumbs);
                    },
                });

                $(window).resize(function(){
                    mkdfAddPositionForTitle(thisSliderHolder);
                    mkdfAddPositionForNavigation(thisSliderHolder);
                });

            });
        }
    }

    /*
     **  Add thumb category, title, date and author for interactive slider
    */
    function mkdfAddPostInteractiveSliderThumbInfo(thisSliderHolder){

        var postTitle = '';
        var postCategories = '';
        var postDate = '';
        var postAuthor = '';
        var postTitleHTML = '';
        var postCategoriesHTML = '';

        if(thisSliderHolder.find('.mkdf-psi-slide').length && thisSliderHolder.children('.flex-control-thumbs').length) {
            thisSliderHolder.find('.mkdf-psi-slide').each(function(i){
                var thisSlide = $(this);
                var thumbHTML = '';
                var postInfoHTML = '';
                i++;

                postTitle = (thisSlide.data('posttitle') !== undefined && thisSlide.data('posttitle') !== '') ? thisSlide.data('posttitle') : '';
                postCategories = (thisSlide.data('postcategory') !== undefined && thisSlide.data('postcategory') !== '') ? thisSlide.data('postcategory') : '';
                postDate = (thisSlide.data('postdate') !== undefined && thisSlide.data('postdate') !== '') ? thisSlide.data('postdate') : '';
                postAuthor = (thisSlide.data('postauthor') !== undefined && thisSlide.data('postauthor') !== '') ? thisSlide.data('postauthor') : '';

                if(postTitle !== '') {
                    postTitleHTML = '<h5 class="mkdf-psi-thumb-title">' + postTitle + '</h5>';
                }

                if(postCategories !== '') {
                    postCategoriesHTML = '<span class="mkdf-psi-thumb-categories">' + postCategories + '</span>';
                }

                if(postDate !== '' || postAuthor !== '') {

                    postInfoHTML += '<div class="mkdf-psi-info-section" >';

                    if (postDate !== '') {
                        postInfoHTML += '<span class="mkdf-psi-thumb-date">' + postDate + '</span>';
                    }

                    if (postAuthor !== '') {
                        postInfoHTML += '<span class="mkdf-psi-thumb-author">' + postAuthor + '</span>';
                    }

                    postInfoHTML += '</div>';
                }

                if(postTitleHTML !== '' || postCategoriesHTML !== '' || postDateHTML !== '' || postAuthorHTML !== '') {
                    thisSliderHolder.children('.flex-control-nav').find('li:nth-child(' + i + ') img').wrap('<div class="mkdf-psi-thumb-inner"><div class="mkdf-psi-thumb-image-holder"><div class="mkdf-psi-thumb-image-inner"></div></div></div>');
                    thumbHTML = postTitleHTML + postCategoriesHTML + postInfoHTML;
                }

                if (thumbHTML !== '') {
                    thisSliderHolder.children('.flex-control-nav').find('li:nth-child(' + i + ') .mkdf-psi-thumb-inner').append(thumbHTML);
                }
            });
        }
    }

    /*
     **  Add active state for thumb
     */
    function mkdfAddActiveThumbState(thisSliderThumbs){

        var activeThumbImage;

        thisSliderThumbs.children('li').removeClass('mkdf-psi-active-thumb');
        activeThumbImage = thisSliderThumbs.find('img.flex-active');
        activeThumbImage.parent().parent().parent().parent().addClass('mkdf-psi-active-thumb');

    }

    /*
     **  Add position for title witch depends of thumb size
     */
    function mkdfAddPositionForTitle(thisSliderHolder){

        var thumbnailHeight;

        if(thisSliderHolder.find('.mkdf-psi-slide').length && thisSliderHolder.children('.flex-control-thumbs').length) {
            thumbnailHeight = thisSliderHolder.find('.flex-control-thumbs').height() + 36 + 8; // 36 is half height of image(absolute positioned), 8 is space beteween title and thumbnails
            thisSliderHolder.find('.mkdf-psi-content').css('bottom',thumbnailHeight+'px');

        }
    }

    /*
     **  Add position for navigation arrows witch depends of thumb size
     */
    function mkdfAddPositionForNavigation(thisSliderHolder){

        var thumbnailHeight;

        if(thisSliderHolder.find('.mkdf-psi-slide').length && thisSliderHolder.children('.flex-control-thumbs').length) {
            thumbnailHeight = thisSliderHolder.find('.flex-control-thumbs').height()-13; /* -13px is to deleted actice thumb */
            thisSliderHolder.find('.flex-direction-nav > li > a').css('margin-top',thumbnailHeight/-2+'px');

        }
    }

    /*
     **  Init split slider
     */
    function mkdfPostSplitSlider(){

        var splitSlider = $('.mkdf-pss-holder');

        if(splitSlider.length){
            splitSlider.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.children('.mkdf-bnl-outer'),
                    control = false,
                    directionNav = false;

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';
                control = thisSliderHolder.data('display_paging') == 'yes';

                thisSlider.flexslider({
                    selector: ".mkdf-split-item",
                    animation: "fade",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-ios-arrow-back'></span>",
                    nextText: "<span class='ion-ios-arrow-forward'></span>",
                    maxItems: 1,
                    slideshowSpeed: 4000,
                    animationSpeed: 400,
                    start: function() {
                        setTimeout(function(){
                            mkdfSetMinHeightSplitSliderSizes(thisSliderHolder);
                            mkdfSetPostSplitSliderArrowPosition(thisSliderHolder);
                            thisSlider.css('opacity','1');
                        }, 200);
                    },
                });

                $(window).resize(function(){
                    mkdfSetMinHeightSplitSliderSizes(thisSliderHolder);
                });

                function mkdfSetMinHeightSplitSliderSizes(thisSliderHolder){
                    var minHeight = 0;
                    thisSliderHolder.find('.mkdf-split-item').each(function(){
                        if(minHeight < $(this).height()){
                            minHeight = $(this).height();
                        }
                    });

                    thisSliderHolder.find('.mkdf-split-holder').css('min-height', minHeight+'px');
                }
            });
        }
    }

    /*
     **  Set arrows navigation position for split slider
    */
    function mkdfSetPostSplitSliderArrowPosition(thisSliderHolder){

        var sliderHolder = thisSliderHolder;
        var navigationMargin = 0;

        if(sliderHolder.find('.flex-control-nav').length){
            navigationMargin = sliderHolder.find('.flex-control-nav li').height()/2+2; //2 is half od thumb navigation top margin 4px
        }

        if(sliderHolder.find('.flex-direction-nav').length){
            sliderHolder.find('.flex-direction-nav li a').css({'margin-top': -navigationMargin, 'opacity': '1'});
        }
    }

    /*
     **  Init sticky sidebar widget
     */
    function mkdfStickySidebarWidget(){

        var sswHolder = $('.mkdf-widget-sticky-sidebar');
        var headerHeightOffset = 0;
        var widgetTopOffset = 0;
        var widgetTopPosition = 0;
        var sidebarHeight = 0;
        var sidebarWidth = 0;
        var objectsCollection = [];

        function addObjectItems() {
            if (sswHolder.length){
                sswHolder.each(function(){
                    var thisSswHolder = $(this);

                    widgetTopOffset = thisSswHolder.offset().top;
                    widgetTopPosition = thisSswHolder.position().top;

                    if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                        sidebarHeight = thisSswHolder.parents('aside.mkdf-sidebar').outerHeight();
                    } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                        var sidebarShortcodeHolder = thisSswHolder.parents('.wpb_widgetised_column');
                        sidebarHeight = sidebarShortcodeHolder.parent('.wpb_wrapper').outerHeight();
                    }
                    
                    if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                        sidebarWidth = thisSswHolder.parents('aside.mkdf-sidebar').width();
                    } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                        sidebarWidth = thisSswHolder.parents('.wpb_widgetised_column').width();
                    }

                    objectsCollection.push({'object': thisSswHolder, 'offset': widgetTopOffset, 'position': widgetTopPosition, 'height': sidebarHeight, 'width': sidebarWidth});
                });
            }
        }

        function initStickySidebarWidget() {

            if (objectsCollection.length){
                $.each(objectsCollection, function(i){

                    var thisSswHolder = objectsCollection[i]['object'];
                    var thisWidgetTopOffset = objectsCollection[i]['offset'];
                    var thisWidgetTopPosition = objectsCollection[i]['position'];
                    var thisSidebarHeight = objectsCollection[i]['height'];
                    var thisSidebarWidth = objectsCollection[i]['width'];

                    if (mkdf.body.hasClass('mkdf-fixed-on-scroll')) {
                        headerHeightOffset = 42;
                        if ($('.mkdf-fixed-wrapper').hasClass('mkdf-fixed')) {
                            headerHeightOffset = $('.mkdf-fixed-wrapper.mkdf-fixed').height();
                        }
                    } else {
                        headerHeightOffset = $('.mkdf-page-header').height();
                    }

                    if (mkdf.windowWidth > 1024) {

                        var widgetBottomMargin = 35;
                        var sidebarPosition = -(thisWidgetTopPosition - headerHeightOffset - 10);
                        var stickySidebarHeight = thisSidebarHeight - thisWidgetTopPosition - widgetBottomMargin;
                        var stickySidebarRowHolderHeight = 0;
                        if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                            if(thisSswHolder.parents('.mkdf-content-has-sidebar').children('.mkdf-content-right-from-sidebar').length) {
                                stickySidebarRowHolderHeight = thisSswHolder.parents('.mkdf-content-has-sidebar').children('.mkdf-content-right-from-sidebar').outerHeight();
                            } else {
                                stickySidebarRowHolderHeight = thisSswHolder.parents('.mkdf-content-has-sidebar').children('.mkdf-content-left-from-sidebar').outerHeight();
                            }
                        } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                            stickySidebarRowHolderHeight = thisSswHolder.parents('.vc_row').height();
                        }

                        //move sidebar up when hits the end of section row
                        var rowSectionEndInViewport = thisWidgetTopOffset - headerHeightOffset - thisWidgetTopPosition - mkdfGlobalVars.vars.mkdfTopBarHeight + stickySidebarRowHolderHeight;

                        if ((mkdf.scroll >= thisWidgetTopOffset - headerHeightOffset) && thisSidebarHeight < stickySidebarRowHolderHeight) {
                            if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                                if(thisSswHolder.parents('aside.mkdf-sidebar').hasClass('mkdf-sticky-sidebar-appeared')) {
                                    thisSswHolder.parents('aside.mkdf-sidebar.mkdf-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                                } else {
                                    thisSswHolder.parents('aside.mkdf-sidebar').addClass('mkdf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                                }
                            } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                if(thisSswHolder.parents('.wpb_widgetised_column').hasClass('mkdf-sticky-sidebar-appeared')) {
                                    thisSswHolder.parents('.wpb_widgetised_column.mkdf-sticky-sidebar-appeared').css({'top': sidebarPosition+'px'});
                                } else {
                                    thisSswHolder.parents('.wpb_widgetised_column').addClass('mkdf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px', 'width': thisSidebarWidth, 'margin-top': '-10px'}).animate({'margin-top': '0'}, 200);
                                }
                            }

                            if (mkdf.scroll + stickySidebarHeight >= rowSectionEndInViewport) {
                                if (thisSswHolder.parents('aside.mkdf-sidebar').length) {

                                    thisSswHolder.parents('aside.mkdf-sidebar.mkdf-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-widgetBottomMargin-headerHeightOffset+'px'});
                                
                                } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                    
                                    thisSswHolder.parents('.wpb_widgetised_column.mkdf-sticky-sidebar-appeared').css({'position': 'absolute', 'top': stickySidebarRowHolderHeight-stickySidebarHeight+sidebarPosition-widgetBottomMargin-headerHeightOffset+'px'});
                                }
                            } else {
                                if (thisSswHolder.parents('aside.mkdf-sidebar').length) {

                                    thisSswHolder.parents('aside.mkdf-sidebar.mkdf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px'});

                                } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                    
                                    thisSswHolder.parents('.wpb_widgetised_column.mkdf-sticky-sidebar-appeared').css({'position': 'fixed', 'top': sidebarPosition+'px'});
                                }
                            }
                        } else {

                            if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                                thisSswHolder.parents('aside.mkdf-sidebar').removeClass('mkdf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                            } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                                thisSswHolder.parents('.wpb_widgetised_column').removeClass('mkdf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                            }
                        }
                    } else {
                        if (thisSswHolder.parents('aside.mkdf-sidebar').length) {
                            thisSswHolder.parents('aside.mkdf-sidebar').removeClass('mkdf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        } else if (thisSswHolder.parents('.wpb_widgetised_column').length) {
                            thisSswHolder.parents('.wpb_widgetised_column').removeClass('mkdf-sticky-sidebar-appeared').css({'position': 'relative', 'top': '0',  'width': 'auto'});
                        }
                    }
                });
            }
        }

        return {
            init: function() {
                addObjectItems();

                initStickySidebarWidget();
                
                $(window).scroll(function(){
                    initStickySidebarWidget();
                });
            }
        }
    }

    /**
     * Object that represents post pagination
     * @returns {{init: Function}} function that initializes post pagination functionality
     */
    var mkdfPostPagination = mkdf.modules.shortcodes.mkdfPostPagination = function(){

        // get all post with load more
        var blogBlockWithPaginationLoadMore = $('.mkdf-post-pag-load-more');
        var blogBlockWithPaginationPrevNext = $('.mkdf-post-pag-np-horizontal');
        var blogBlockWithPaginationInfinitive = $('.mkdf-post-pag-infinite');

        $('.mkdf-post-item').addClass('mkdf-active-post-page');

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostLoadMoreEvent = function (thisBlock) {
            var thisBlockShowLoadMoreHolder = thisBlock.children('.mkdf-bnl-navigation-holder'),
                thisBlockShowLoadMore = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more'),
                thisBlockShowLoadMoreLoading = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more-loading'),
                thisBlockShowLoadMoreButton = thisBlockShowLoadMore.children(),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockShowLoadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                thisBlockShowLoadMore.hide();
                thisBlockShowLoadMoreLoading.css('display', 'inline-block');

                blockData.paged = blockData.next_page;

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if(response.showNextPage === true){
                            blockData.next_page++;
                            thisBlock.waitForImages(function(){
                                if(isBlockItem) {
                                    blogBlockOuter.append(response.html);
                                }
                                else{
                                    blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                                } // Append the new content

                                setTimeout(function() {
                                    postAjaxCallback(thisBlock);
                                }, 100); // to prevent adding class before adding response html via after
                            });

                            if(blockData.max_pages > (blockData.paged)){
                                thisBlockShowLoadMore.show();
                                thisBlockShowLoadMoreLoading.hide();
                            }
                            else{
                                thisBlockShowLoadMoreHolder.hide();
                            }
                        }
                    }
                });
            });
        };

        /**
         * Function that triggers next prev functionality
         */
        var mkdfPostNextPrevEvent = function (thisBlock) {
            var thisBlockPostPrevNextButton = thisBlock.children('.mkdf-bnl-navigation-holder').find('a'),
                thisBlockSliderPaging = thisBlock.find('.mkdf-bnl-slider-paging'),
                thisBlockAjaxPreloader = thisBlock.children('.mkdf-post-ajax-preloader'),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                setActivePaging(thisBlockSliderPaging, blockData.paged);
            }

            thisBlockPostPrevNextButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                blockData.paged = getClickedButton($(this), blockData);
                if(blockData.paged === false){
                    return;
                }

                if(!setAjaxLoading(thisBlock, true)){
                    return;
                }

                if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                    setActivePaging(thisBlockSliderPaging, blockData.paged);
                }

                thisBlockAjaxPreloader.show();

                if (!isBlockItem) {
                    blogBlockOuter.children('.mkdf-bnl-inner').children('.mkdf-post-item').addClass('mkdf-removed-post-page');
                }

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page = blockData.paged + 1;
                            blockData.prev_page = blockData.paged - 1;
                            thisBlock.waitForImages(function () {

                                if (isBlockItem) {
                                    blogBlockOuter.html(response.html);
                                }
                                else {
                                    blogBlockOuter.children('.mkdf-bnl-inner').children('.mkdf-post-item:last').after(response.html);
                                    thisBlock.find('.mkdf-removed-post-page').remove();
                                }// Append the new content

                                setTimeout(function(){
                                    thisBlock.css('min-height', '');
                                    thisBlockAjaxPreloader.hide();
                                    setAjaxLoading(thisBlock, false);
                                    postAjaxCallback(thisBlock);
                                }, 400);
                            });
                        }
                    }
                });
            });

            function setAjaxLoading(thisBlock, start) {
                if(start){
                    if(!thisBlock.hasClass('mkdf-post-pag-active')) {
                        thisBlock.css('min-height', thisBlock.height());
                        thisBlock.addClass('mkdf-post-pag-active');
                        return true;
                    }
                    else{
                        return false;
                    }
                }

                else if(!start && thisBlock.hasClass('mkdf-post-pag-active')) {
                    thisBlock.removeClass('mkdf-post-pag-active');
                }

                return true;
            }

            function getClickedButton(thisButton, blockData) {
                if (thisButton.hasClass('mkdf-bnl-nav-next') && blockData.next_page <= blockData.max_pages) {
                    return blockData.next_page;
                }
                else if (thisButton.hasClass('mkdf-bnl-nav-prev') && blockData.prev_page > 0) {
                    return blockData.prev_page;
                }
                else if (thisButton.hasClass('mkdf-paging-button-holder')) {
                    return thisBlockSliderPaging.children('a').index(thisButton) + 1;
                }
                else {
                    return false;
                }
            }

            function setActivePaging(pagingHolder, number) {
                pagingHolder.children('a').removeClass('mkdf-bnl-paging-active');
                pagingHolder.children('a:nth-child(' + number + ')').addClass('mkdf-bnl-paging-active');
            }
        };

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostInfinitiveEvent = function (thisBlock) {
            var blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                blockData = mkdfPostData(thisBlock),
                isBlockItem = isBlock(thisBlock);

            mkdf.window.scroll(function () {

                if(!thisBlock.hasClass('mkdf-ajax-infinite-started') &&(blockData.next_page <= blockData.max_pages) && ((mkdf.window.height() + mkdf.window.scrollTop()) > (blogBlockOuter.offset().top + blogBlockOuter.height()))) {

                    thisBlock.addClass('mkdf-ajax-infinite-started');
                    blockData.paged = blockData.next_page;

                    $.ajax({
                        type: 'POST',
                        data: blockData,
                        url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                        success: function (data) {
                            var response = $.parseJSON(data);
                            if (response.showNextPage === true) {
                                blockData.next_page++;
                                thisBlock.waitForImages(function () {
                                    if(isBlockItem) {
                                        blogBlockOuter.append(response.html);
                                    }
                                    else{
                                        blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                                    } // Append the new content

                                    setTimeout(function() {
                                        postAjaxCallback(thisBlock);
                                    }, 100); // to prevent adding class before adding response html via after

                                    thisBlock.removeClass('mkdf-ajax-infinite-started');
                                });
                            }
                        }
                    });
                }
            });
        };

        function isBlock($thisblock){
            return($thisblock.hasClass("mkdf-pb-one-holder") || $thisblock.hasClass("mkdf-pb-two-holder"));
        }

        function postAjaxCallback(thisBlock) {

            thisBlock.find('.mkdf-post-item').addClass('mkdf-active-post-page');

            if(thisBlock.parent().hasClass('widget')) {
                mkdf.modules.header.mkdfDropDownMenu();
                thisBlock.parent().parent().css('height', '');
            }
            mkdfBlockTwo();

            var sswHolderShortcode = $('.wpb_widgetised_column');
            var sswHolder = $('aside.mkdf-sidebar');

            if(sswHolderShortcode.length) {
                sswHolderShortcode.css({'position': 'relative', 'top': '0', 'width': 'auto', 'margin-top': '0'});
                if(sswHolderShortcode.hasClass('mkdf-sticky-sidebar-appeared')){
                    sswHolderShortcode.removeClass('mkdf-sticky-sidebar-appeared');
                }

                setTimeout(function(){
                    mkdfStickySidebarWidget().init();
                }, 100);
            } else if (sswHolder.length) {
                sswHolder.css({'position': 'relative', 'top': '0', 'width': 'auto', 'margin-top': '0'});
                if(sswHolder.hasClass('mkdf-sticky-sidebar-appeared')){
                    sswHolder.removeClass('mkdf-sticky-sidebar-appeared');
                }
                
                setTimeout(function(){
                    mkdfStickySidebarWidget().init();
                }, 100);
            }

            mkdfPostLayoutHovers();
        }

        return {
            init : function() {
                if (blogBlockWithPaginationLoadMore.length) {
                    blogBlockWithPaginationLoadMore.each(function () {
                        mkdfPostLoadMoreEvent($(this));
                    });
                }
                if (blogBlockWithPaginationPrevNext.length) {
                    blogBlockWithPaginationPrevNext.each(function () {
                        mkdfPostNextPrevEvent($(this));
                    });
                }
                if (blogBlockWithPaginationInfinitive.length) {
                    blogBlockWithPaginationInfinitive.each(function () {
                        mkdfPostInfinitiveEvent($(this));
                    });
                }
            }
        };
    };

    /*
     * Init pagination - load more
     * @returns object with data parameters
     */

    function mkdfPostData(container) {

        var myObj = container.data();
        myObj.action = 'chillnews_mikado_list_ajax';

        return myObj;
    }

    /**
     * Object that represents post layout tabs widget
     * @returns {{init: Function}} function that initializes post layout tabs widget functionality
     */
    var mkdfPostLayoutTabWidget = mkdf.modules.shortcodes.mkdfPostLayoutTabWidget = function(){

        var layoutTabsWidget = $('.mkdf-plw-tabs');


        var mkdfPostLayoutTabWidgetEvent = function (thisWidget) {
            var plwTabsHolder = thisWidget.find('.mkdf-plw-tabs-tabs-holder');
            var plwTabsContent = thisWidget.find('.mkdf-plw-tabs-content-holder');
            var currentItemPosition = plwTabsHolder.children('.mkdf-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

            setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

            plwTabsHolder.find('a').mouseover(function (e) {
                e.preventDefault();

                currentItemPosition = $(this).parents('.mkdf-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

                setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
            });
        };

        function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition){
            var activeItemClass = 'mkdf-plw-tabs-active-item';

            plwTabsContent.children('.mkdf-plw-tabs-content').removeClass(activeItemClass);
            plwTabsHolder.children('.mkdf-plw-tabs-tab').removeClass(activeItemClass);

            var height = plwTabsContent.children('.mkdf-plw-tabs-content:nth-child('+currentItemPosition+')').addClass(activeItemClass).height();
            plwTabsContent.css('min-height',height+'px');
            plwTabsHolder.children('.mkdf-plw-tabs-tab:nth-child('+currentItemPosition+')').addClass(activeItemClass);
        }

        return {
            init : function() {
                if (layoutTabsWidget.length) {
                    layoutTabsWidget.each(function () {
                        mkdfPostLayoutTabWidgetEvent($(this));
                    });
                }
            },

        };
    };

    function mkdfInitSelect2StyleWooCommerce() {

        if ($('.woocommerce-ordering .orderby').length || $('#calc_shipping_country').length) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();
        }
    }

    /*
    * Post layout hovers
    */

    function mkdfPostLayoutHovers() {
        //post layouts 1,2,3,5,7,8
        var layoutItems = $('.mkdf-pt-one-item, .mkdf-pt-two-item, .mkdf-pt-three-item, .mkdf-pt-five-item, .mkdf-pt-seven-item, .mkdf-pt-eight-item, .mkdf-pt-nine-item');
        if (layoutItems.length) {
            layoutItems.each(function(){
                var thisItem = $(this),
                    link = thisItem.find('.mkdf-pt-link, .mkdf-image-link');
                link.mouseenter(function(){
                    thisItem.addClass('mkdf-item-hovered');
                });
                link.mouseleave(function(){
                    thisItem.removeClass('mkdf-item-hovered');
                });
            });
        }
       
    }

    /*
     * Show quantity +/- functionality
     */

    function mkdfInitQuantityButtons() {

       $(document).on( 'click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkdf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkdf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
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

})(jQuery);