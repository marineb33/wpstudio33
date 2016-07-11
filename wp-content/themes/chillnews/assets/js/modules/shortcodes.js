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