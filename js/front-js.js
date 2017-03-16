( function( $ ) {
	"use strict";

Reveal.initialize({
	width: "100%",
	height: "100%",
	margin: 0,
// // Display controls in the bottom right corner
    controls: true,
//     // Display a presentation progress bar
    progress: true,
//     // Display the page number of the current slide
//     slideNumber: false,
//     // Push each slide change to the browser history
//     history: false,
//     // Enable keyboard shortcuts for navigation
//     keyboard: true,
//     // Enable the slide overview mode
//     overview: true,
//     // Vertical centering of slides
//     center: true,
//     // Enables touch navigation on devices with touch input
//     touch: true,
//     // Loop the presentation
// 		loop: false,
//     // Change the presentation direction to be RTL
//     rtl: false,
//     // Randomizes the order of slides each time the presentation loads
//     shuffle: false,
//     // Turns fragments on and off globally
//     fragments: true,
//     // Flags if the presentation is running in an embedded mode,
//     // i.e. contained within a limited portion of the screen
//     embedded: false,
//     // Flags if we should show a help overlay when the questionmark
//     // key is pressed
//     help: true,
//     // Flags if speaker notes should be visible to all viewers
     // showNotes: true,
//     // Number of milliseconds between automatically proceeding to the
//     // next slide, disabled when set to 0, this value can be overwritten
//     // by using a data-autoslide attribute on your slides
    // if (php_vars.enable_autoslide)
    // autoSlide: 15000,
//     // Stop auto-sliding after user input
    // autoSlideStoppable: true,
//     // Use this method for navigation when auto-sliding
//     autoSlideMethod: Reveal.navigateNext,
//     // Enable slide navigation via mouse wheel
    mouseWheel: true,
//     // Hides the address bar on mobile devices
//     hideAddressBar: true,
//     // Opens links in an iframe preview overlay
//     previewLinks: false,
//     // Transition style
    transition: 'concave', // default/none/fade/slide/convex/concave/zoom
//     // Transition speed
    transitionSpeed: 'slow', // default/fast/slow
//     // Transition style for full page slide backgrounds
    // backgroundTransition: 'fade', // none/fade/slide/convex/concave/zoom
//     // Number of slides away from the current that are visible
//     viewDistance: 3,
//     // Parallax background image
//     parallaxBackgroundImage: '', // e.g. "'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg'"
//     // Parallax background size
//     parallaxBackgroundSize: '', // CSS syntax, e.g. "2100px 900px"
//     // Number of pixels to move the parallax background per slide
//     // - Calculated automatically unless specified
//     // - Set to 0 to disable movement along an axis
//     parallaxBackgroundHorizontal: null,
//     parallaxBackgroundVertical: null
});

	// make sure not to hide reveal container because of .fade class added to our reveal container
	var reveal = $('.poa-reveal');
		reveal.css({opacity: '1'});

	// preloader
	var preloader =	$('#poa-plugin-preloader');
	setTimeout(function() {
		preloader.animate({opacity: '0.5', top: '-200vh'}, 3000);
	}, 3000);
	setTimeout(function() {
		preloader.css({display: 'none'});
	}, 10000);


	// navigation
	$("#main-nav-button").on('click', function() {
		switchMenu($(this), $('#main-nav-container'), $("#sandwich"));
	});
	// $("#slides-nav-button").on('click', function() {
	// 	switchMenu($(this), $('#slides-nav-container'), $("#slides-sandwich"));
	// });

	// hide controls on html5 video
	$("video").on('hover', function(event) {
		if( event.type === "mouseenter" ) {
		    $(this).attr("controls", "");

		} else if( event.type === "mouseleave" ) {
		    $(this).removeAttr("controls");
		}
	});


// включаю показ автослайдов (autoslide switch on: see )
if (php_vars.enable_autoslide == 1) {

	var time = 0;
	php_vars.autoslide_time != null ? time = php_vars.autoslide_time : time = 15000;
	// time = parseInt(time * 1000);

	Reveal.configure({ autoSlide: time });
}

// включаю показ автослайдов (autoslide switch on: see )
if (php_vars.loop_presentation == 1) {
	Reveal.configure({ loop: 'true' });
}

if (php_vars.transition != 0) {
	Reveal.configure({ transition: php_vars.transition });
}


// do not allow to autoplay all videos at once
var all_iframes = $('.iframe');
all_iframes.each( function(index) {
	var iframes_src = $(this).attr('src');
	iframes_src = iframes_src.concat('&autoplay=0');
	$(this).attr('src', iframes_src);
} );


// check for autoplay for just loaded slide
var currSlide = Reveal.getCurrentSlide();
var currIframe = $('#iframe-' + currSlide.id);

if ( currIframe.attr('data-autoplay') == '1' ) {
	setVideoAutoplay(currIframe);
}

Reveal.addEventListener( 'slidechanged', function( event ) {
	var cur_id = event.currentSlide.id;
	var video = $('#fullscreen-video-' + cur_id);

	var currIframe = $('#iframe-' + cur_id);
	if ( currIframe.attr('data-autoplay') == '1' ) {
		setVideoAutoplay(currIframe);
	}
	if (window.history.replaceState) {
	   //prevents browser from storing history with each change:
	   window.history.pushState({}, null, '#/' + cur_id);
	}

} );

function setVideoAutoplay(currIframe) {

	var currIframeSrc = currIframe.attr('src');
	currIframeSrc = currIframeSrc.replace('autoplay=0', 'autoplay=1');

	currIframe.attr({'src': currIframeSrc});
}

function switchMenu(button, container, sandwich) {
	if (container.css('opacity') == '0') {
		setTimeout(function(){
			container.css({'display': 'block'});
		}, 300);
		container.animate({'opacity': '1'}, 600);

		sandwich.addClass("active");
		return false;
	}
	else {
		sandwich.removeClass("active");

		container.animate({'opacity': '0'}, 300);
		setTimeout(function(){
			container.css({'display': 'none'});
		}, 300);
	}
}

// // when page is reloaded define last url segment
// var lastSegment = lastUrlSegment();
// var section = '';
// // last segment may be empty if this is first visit to webpage
// isEmptyString(lastSegment) ? section = 'section1' : section = lastSegment;

// var current_menu = $('#top_main_nav').find('a[title="' + section + '"]');

// Reveal.addEventListener( 'slidechanged', function( event ) {
// 	// highlight current menu item when slides change
// 	// this section works only when page doesn't reloads

// 	// below just available events 
//     // event.previousSlide, event.currentSlide, event.indexh, event.indexv
//     var cur_id = event.currentSlide.id;

// 	cur_id == '' ? cur_id = 'section1' : cur_id = cur_id;
// 		// console.log(current_menu.attr('title') + " = " + cur_id);

// 	// var fsv = $('#' + cur_id + ' #fullscreen-video');
// 	// fsvMove(fsv);

// 	$.each( $('#top_main_nav').find('a'), function (key, value) {

// 		if ( current_menu.attr('title') != cur_id ) {
// 			current_menu.parent('li.menu-item').removeClass('menu-item-active');
// 			current_menu = $('#top_main_nav').find('a[title="' + cur_id + '"]');

// 			if (window.history.replaceState) {
// 			   //prevents browser from storing history with each change:
// 			   window.history.pushState({}, null, '#/' + cur_id);
// 			}
// 		}
// 	} );

// 	current_menu.parent('li.menu-item').addClass('menu-item-active');
// } );

function fsvMove(fsv) {

	fsv.css({'top': '-50px'});
	console.log(fsv.css('top'));

	if (fsv.css('top') == 'auto' || fsv.css('top') == '-50px') {
		goDown(fsv);
	}
	function goDown(fsv) {
		fsv.animate({top: '50px', left: '50px'}, 9000, function() {
			goUp(fsv);
		});
	}
	function goUp(fsv) {
		fsv.animate({top: '-50px', left: '-50px'}, 9000, function() {
			goDown(fsv);
		});
	}
}

function lastUrlSegment() {
	var url = window.location.href;
	var lastSegment = url.split('/').pop();
	return lastSegment;
}

function isEmptyString (value) {
  return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}


} )( jQuery );