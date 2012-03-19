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
	
	// add icons to menu 
	$('.home-but').find('a').prepend('<i class="icon-home"></i>');
	$('.tools-but').find('a').prepend('<i class="icon-signal"></i>');
	$('.reports-but').find('a').prepend('<i class="icon-book"></i>');
	$('.blog-but').find('a').prepend('<i class="icon-pencil"></i>');
	$('.about-but').find('a').prepend('<i class="icon-info-sign"></i>');
	
	

})// end window load
