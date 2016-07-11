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