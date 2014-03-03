/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Adds a top margin to the footer if the sidebar widget area is higher
	 * than the rest of the page, to help the footer always visually clear
	 * the sidebar.
	 */
	$( function() {
		if ( body.is( '.sidebar' ) ) {
			var sidebar   = $( '#secondary .widget-area' ),
			    secondary = ( 0 == sidebar.length ) ? -40 : sidebar.height(),
			    margin    = $( '#tertiary .widget-area' ).height() - $( '#content' ).height() - secondary;

			if ( margin > 0 && _window.innerWidth() > 999 )
				$( '#colophon' ).css( 'margin-top', margin + 'px' );
		}
	} );


	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.twentythirteen', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

/**
 * Enables menu toggle for small screens.
 */
( function() {
    var nav = $( '.navbar' ), button, menu;
    if ( ! nav )
        return;

    button = nav.find( '.menu-toggle' );
    if ( ! button )
        return;

    // Hide button if menu is missing or empty.
    menu = nav.find( '.nav-menu' );

    if ( ! menu || ! menu.children().length ) {
        button.hide();
        return;
    }

	 // var responsive_viewport = $(window).width();

  //   /* if is below 768px */
  //   if (responsive_viewport < 768) {
  //     $( '.menu-toggle' ).on( 'click', function() {
  //         $( '.nav-menu' ).toggleClass( 'toggled-on' );
  //       } );
	 //    }
	  if (responsive_viewport > 1030) {

    }

} )();

( function() {
	commentform = $('.comment-form');

	$('.comment-reply-title').on('click',
  	 function(){
      $('form').show();
  });

} )();

	/**
	 * Arranges footer widgets vertically.
	 */
	if ( $.isFunction( $.fn.masonry ) ) {
		var columnWidth = body.is( '.sidebar' ) ? 228 : 245;

		$( '#secondary .widget-area' ).masonry( {
			itemSelector: '.widget',
			columnWidth: columnWidth,
			gutterWidth: 20,
			isRTL: body.is( '.rtl' )
		} );
	}
} )( jQuery );