/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
    var gridmode_secondary_container, gridmode_secondary_button, gridmode_secondary_menu, gridmode_secondary_links, gridmode_secondary_i, gridmode_secondary_len;

    gridmode_secondary_container = document.getElementById( 'gridmode-secondary-navigation' );
    if ( ! gridmode_secondary_container ) {
        return;
    }

    gridmode_secondary_button = gridmode_secondary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridmode_secondary_button ) {
        return;
    }

    gridmode_secondary_menu = gridmode_secondary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridmode_secondary_menu ) {
        gridmode_secondary_button.style.display = 'none';
        return;
    }

    gridmode_secondary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridmode_secondary_menu.className.indexOf( 'nav-menu' ) ) {
        gridmode_secondary_menu.className += ' nav-menu';
    }

    gridmode_secondary_button.onclick = function() {
        if ( -1 !== gridmode_secondary_container.className.indexOf( 'gridmode-toggled' ) ) {
            gridmode_secondary_container.className = gridmode_secondary_container.className.replace( ' gridmode-toggled', '' );
            gridmode_secondary_button.setAttribute( 'aria-expanded', 'false' );
            gridmode_secondary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridmode_secondary_container.className += ' gridmode-toggled';
            gridmode_secondary_button.setAttribute( 'aria-expanded', 'true' );
            gridmode_secondary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridmode_secondary_links    = gridmode_secondary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridmode_secondary_i = 0, gridmode_secondary_len = gridmode_secondary_links.length; gridmode_secondary_i < gridmode_secondary_len; gridmode_secondary_i++ ) {
        gridmode_secondary_links[gridmode_secondary_i].addEventListener( 'focus', gridmode_secondary_toggleFocus, true );
        gridmode_secondary_links[gridmode_secondary_i].addEventListener( 'blur', gridmode_secondary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridmode_secondary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridmode-focus' ) ) {
                    self.className = self.className.replace( ' gridmode-focus', '' );
                } else {
                    self.className += ' gridmode-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridmode_secondary_container ) {
        var touchStartFn, gridmode_secondary_i,
            parentLink = gridmode_secondary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridmode_secondary_i;

                if ( ! menuItem.classList.contains( 'gridmode-focus' ) ) {
                    e.preventDefault();
                    for ( gridmode_secondary_i = 0; gridmode_secondary_i < menuItem.parentNode.children.length; ++gridmode_secondary_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridmode_secondary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridmode_secondary_i].classList.remove( 'gridmode-focus' );
                    }
                    menuItem.classList.add( 'gridmode-focus' );
                } else {
                    menuItem.classList.remove( 'gridmode-focus' );
                }
            };

            for ( gridmode_secondary_i = 0; gridmode_secondary_i < parentLink.length; ++gridmode_secondary_i ) {
                parentLink[gridmode_secondary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridmode_secondary_container ) );
} )();


( function() {
    var gridmode_headnavi_container, gridmode_headnavi_button, gridmode_headnavi_menu, gridmode_headnavi_links, gridmode_headnavi_i, gridmode_headnavi_len;

    gridmode_headnavi_container = document.getElementById( 'gridmode-headnavi-navigation' );
    if ( ! gridmode_headnavi_container ) {
        return;
    }

    gridmode_headnavi_button = gridmode_headnavi_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridmode_headnavi_button ) {
        return;
    }

    gridmode_headnavi_menu = gridmode_headnavi_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridmode_headnavi_menu ) {
        gridmode_headnavi_button.style.display = 'none';
        return;
    }

    gridmode_headnavi_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridmode_headnavi_menu.className.indexOf( 'nav-menu' ) ) {
        gridmode_headnavi_menu.className += ' nav-menu';
    }

    gridmode_headnavi_button.onclick = function() {
        if ( -1 !== gridmode_headnavi_container.className.indexOf( 'gridmode-toggled' ) ) {
            gridmode_headnavi_container.className = gridmode_headnavi_container.className.replace( ' gridmode-toggled', '' );
            gridmode_headnavi_button.setAttribute( 'aria-expanded', 'false' );
            gridmode_headnavi_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridmode_headnavi_container.className += ' gridmode-toggled';
            gridmode_headnavi_button.setAttribute( 'aria-expanded', 'true' );
            gridmode_headnavi_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridmode_headnavi_links    = gridmode_headnavi_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridmode_headnavi_i = 0, gridmode_headnavi_len = gridmode_headnavi_links.length; gridmode_headnavi_i < gridmode_headnavi_len; gridmode_headnavi_i++ ) {
        gridmode_headnavi_links[gridmode_headnavi_i].addEventListener( 'focus', gridmode_headnavi_toggleFocus, true );
        gridmode_headnavi_links[gridmode_headnavi_i].addEventListener( 'blur', gridmode_headnavi_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridmode_headnavi_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridmode-focus' ) ) {
                    self.className = self.className.replace( ' gridmode-focus', '' );
                } else {
                    self.className += ' gridmode-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridmode_headnavi_container ) {
        var touchStartFn, gridmode_headnavi_i,
            parentLink = gridmode_headnavi_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridmode_headnavi_i;

                if ( ! menuItem.classList.contains( 'gridmode-focus' ) ) {
                    e.preventDefault();
                    for ( gridmode_headnavi_i = 0; gridmode_headnavi_i < menuItem.parentNode.children.length; ++gridmode_headnavi_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridmode_headnavi_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridmode_headnavi_i].classList.remove( 'gridmode-focus' );
                    }
                    menuItem.classList.add( 'gridmode-focus' );
                } else {
                    menuItem.classList.remove( 'gridmode-focus' );
                }
            };

            for ( gridmode_headnavi_i = 0; gridmode_headnavi_i < parentLink.length; ++gridmode_headnavi_i ) {
                parentLink[gridmode_headnavi_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridmode_headnavi_container ) );
} )();

( function() {
    var gridmode_primary_container, gridmode_primary_button, gridmode_primary_menu, gridmode_primary_links, gridmode_primary_i, gridmode_primary_len;

    gridmode_primary_container = document.getElementById( 'gridmode-primary-navigation' );
    if ( ! gridmode_primary_container ) {
        return;
    }

    gridmode_primary_button = gridmode_primary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridmode_primary_button ) {
        return;
    }

    gridmode_primary_menu = gridmode_primary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridmode_primary_menu ) {
        gridmode_primary_button.style.display = 'none';
        return;
    }

    gridmode_primary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridmode_primary_menu.className.indexOf( 'nav-menu' ) ) {
        gridmode_primary_menu.className += ' nav-menu';
    }

    gridmode_primary_button.onclick = function() {
        if ( -1 !== gridmode_primary_container.className.indexOf( 'gridmode-toggled' ) ) {
            gridmode_primary_container.className = gridmode_primary_container.className.replace( ' gridmode-toggled', '' );
            gridmode_primary_button.setAttribute( 'aria-expanded', 'false' );
            gridmode_primary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridmode_primary_container.className += ' gridmode-toggled';
            gridmode_primary_button.setAttribute( 'aria-expanded', 'true' );
            gridmode_primary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridmode_primary_links    = gridmode_primary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridmode_primary_i = 0, gridmode_primary_len = gridmode_primary_links.length; gridmode_primary_i < gridmode_primary_len; gridmode_primary_i++ ) {
        gridmode_primary_links[gridmode_primary_i].addEventListener( 'focus', gridmode_primary_toggleFocus, true );
        gridmode_primary_links[gridmode_primary_i].addEventListener( 'blur', gridmode_primary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridmode_primary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridmode-focus' ) ) {
                    self.className = self.className.replace( ' gridmode-focus', '' );
                } else {
                    self.className += ' gridmode-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridmode_primary_container ) {
        var touchStartFn, gridmode_primary_i,
            parentLink = gridmode_primary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridmode_primary_i;

                if ( ! menuItem.classList.contains( 'gridmode-focus' ) ) {
                    e.preventDefault();
                    for ( gridmode_primary_i = 0; gridmode_primary_i < menuItem.parentNode.children.length; ++gridmode_primary_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridmode_primary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridmode_primary_i].classList.remove( 'gridmode-focus' );
                    }
                    menuItem.classList.add( 'gridmode-focus' );
                } else {
                    menuItem.classList.remove( 'gridmode-focus' );
                }
            };

            for ( gridmode_primary_i = 0; gridmode_primary_i < parentLink.length; ++gridmode_primary_i ) {
                parentLink[gridmode_primary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridmode_primary_container ) );
} )();