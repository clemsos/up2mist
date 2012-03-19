jQuery(function($) {
	// init 
	
	// pause all carousel
	$('.carousel').carousel('pause');

})// end function jQuery



jQuery( document ).ready( function( $ ) {
	console.log('script.js loaded')


	// stop carousel auto-rotate
	$('.carousel').mouseenter(function() {
	    $(this).carousel('pause');
	}).mouseleave(function() {
	    $(this).carousel('pause');
	}); 
	

})// end window load
