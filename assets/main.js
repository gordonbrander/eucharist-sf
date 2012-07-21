// This is the main JavaScript file for Eucharist. It requires the Twitter
// Bootstrap Carousel plugin.
// 
// Run on DOMReady...
jQuery(function ($) {
  // Bind carousel logic to `.carousel`.
  // <http://twitter.github.com/bootstrap/javascript.html#carousel>
  $('#carousel').carousel({
    interval: 7000,
    pause: 'hover'
  });
});