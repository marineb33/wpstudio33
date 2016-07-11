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