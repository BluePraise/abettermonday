$(document).ready( function () {
  var responsive_viewport = $(window).width();

  /* if is below 768px */
  if (responsive_viewport < 768) {
    $('.menu-toggle').on( 'click', function() {
      $( '.nav-menu' ).toggleClass( 'toggled-on' );
      $( '.site-header' ).toggleClass( 'shadow-on' );
      	console.log("hellow");
    } );
  }
});