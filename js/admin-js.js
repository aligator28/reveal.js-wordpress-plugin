( function( $ ) {
	"use strict";

	$("#enable-nav").on('click', function() {
		$(this).is(':checked') ? $('#position-nav').css('display', 'block') :  $('#position-nav').css('display', 'none');
	});
	
} )( jQuery );