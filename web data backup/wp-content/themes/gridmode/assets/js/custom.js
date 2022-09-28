jQuery(document).ready(function($) {
    'use strict';

    if(gridmode_ajax_object.secondary_menu_active){
        $(".gridmode-nav-secondary .gridmode-secondary-nav-menu").addClass("gridmode-secondary-responsive-menu");

        $( ".gridmode-secondary-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".gridmode-nav-secondary .gridmode-secondary-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".gridmode-nav-secondary .gridmode-secondary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".gridmode-secondary-responsive-menu > li").removeClass("gridmode-secondary-menu-open");
            }
        });

        $( ".gridmode-secondary-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-secondary-menu-open");
            $(this).find(".children:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-secondary-menu-open");
        });

        $( "div.gridmode-secondary-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-secondary-menu-open");
        });
    }

    if(gridmode_ajax_object.primary_menu_active){
            // grab the initial top offset of the navigation 
            var gridmodestickyNavTop = $('.gridmode-primary-menu-container').offset().top;
            
            // our function that decides weather the navigation bar should have "fixed" css position or not.
            var gridmodestickyNav = function(){
                var gridmodescrollTop = $(window).scrollTop(); // our current vertical position from the top
                     
                // if we've scrolled more than the navigation, change its position to fixed to stick to top,
                // otherwise change it back to relative
                if(window.innerWidth > 1112) {
                    if (gridmodescrollTop > gridmodestickyNavTop) {
                        $('.gridmode-primary-menu-container').addClass('gridmode-fixed');
                    } else {
                        $('.gridmode-primary-menu-container').removeClass('gridmode-fixed'); 
                    }
                }
            };

            gridmodestickyNav();
            // and run it again every time you scroll
            $(window).on( "scroll", function() {
                gridmodestickyNav();
            });

            $(".gridmode-nav-primary .gridmode-primary-nav-menu").addClass("gridmode-primary-responsive-menu");

            $( ".gridmode-primary-responsive-menu-icon" ).on( "click", function() {
                $(this).next(".gridmode-nav-primary .gridmode-primary-nav-menu").slideToggle();
            });

            $(window).on( "resize", function() {
                if(window.innerWidth > 1112) {
                    $(".gridmode-nav-primary .gridmode-primary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                    $(".gridmode-primary-responsive-menu > li").removeClass("gridmode-primary-menu-open");
                }
            });

            $( ".gridmode-primary-responsive-menu > li" ).on( "click", function(event) {
                if (event.target !== this)
                return;
                $(this).find(".sub-menu:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-primary-menu-open");
                $(this).find(".children:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-primary-menu-open");
            });

            $( "div.gridmode-primary-responsive-menu > ul > li" ).on( "click", function(event) {
                if (event.target !== this)
                    return;
                $(this).find("ul:first").toggleClass('gridmode-submenu-toggle').parent().toggleClass("gridmode-primary-menu-open");
            });
    }

    if($(".gridmode-header-social-icon-search").length){
        $(".gridmode-header-social-icon-search").on('click', function (e) {
            e.preventDefault();
            //document.getElementById("gridmode-search-overlay-wrap").style.display = "block";
            $("#gridmode-search-overlay-wrap").fadeIn();
            const gridmode_focusableelements = 'button, [href], input';
            const gridmode_search_modal = document.querySelector('#gridmode-search-overlay-wrap');
            const gridmode_firstfocusableelement = gridmode_search_modal.querySelectorAll(gridmode_focusableelements)[0];
            const gridmode_focusablecontent = gridmode_search_modal.querySelectorAll(gridmode_focusableelements);
            const gridmode_lastfocusableelement = gridmode_focusablecontent[gridmode_focusablecontent.length - 1];
            document.addEventListener('keydown', function(e) {
              let isTabPressed = e.key === 'Tab' || e.keyCode === 9;
              if (!isTabPressed) {
                return;
              }
              if (e.shiftKey) {
                if (document.activeElement === gridmode_firstfocusableelement) {
                  gridmode_lastfocusableelement.focus();
                  e.preventDefault();
                }
              } else {
                if (document.activeElement === gridmode_lastfocusableelement) {
                  gridmode_firstfocusableelement.focus();
                  e.preventDefault();
                }
              }
            });
            gridmode_firstfocusableelement.focus();
        });
    }

    if($(".gridmode-search-closebtn").length){
        $(".gridmode-search-closebtn").on('click', function (e) {
            e.preventDefault();
            //document.getElementById("gridmode-search-overlay-wrap").style.display = "none";
            $("#gridmode-search-overlay-wrap").fadeOut();
        });
    }

    if(gridmode_ajax_object.fitvids_active){
        $(".entry-content, .widget").fitVids();
    }

    if(gridmode_ajax_object.backtotop_active){
        if($(".gridmode-scroll-top").length){
            var gridmode_scroll_button = $( '.gridmode-scroll-top' );
            gridmode_scroll_button.hide();

            $( window ).on( "scroll", function() {
                if ( $( window ).scrollTop() < 20 ) {
                    $( '.gridmode-scroll-top' ).fadeOut();
                } else {
                    $( '.gridmode-scroll-top' ).fadeIn();
                }
            } );

            gridmode_scroll_button.on( "click", function() {
                $( "html, body" ).animate( { scrollTop: 0 }, 300 );
                return false;
            } );
        }
    }

    if(gridmode_ajax_object.sticky_sidebar_active){
        $('.gridmode-main-wrapper, .gridmode-sidebar-one-wrapper').theiaStickySidebar({
            containerSelector: ".gridmode-content-wrapper",
            additionalMarginTop: 0,
            additionalMarginBottom: 0,
            minWidth: 960,
        });

        $(window).on( "resize", function() {
            $('.gridmode-main-wrapper, .gridmode-sidebar-one-wrapper').theiaStickySidebar({
                containerSelector: ".gridmode-content-wrapper",
                additionalMarginTop: 0,
                additionalMarginBottom: 0,
                minWidth: 960,
            });
        });
    }

});