/**
 * functions.js
 *
 * Handles the masonry on the blog section
 * Initializes masonry elements
 */


jQuery(window).load(function() {
    var $container = jQuery("#main");
    $container.imagesLoaded(function() {
	$container.masonry({
	    itemSelector: ".hentry",
	    isResizable: true,
	    isAnimated: true
		});
    });
});





