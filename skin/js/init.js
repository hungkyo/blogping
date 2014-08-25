$(function(){

  "use strict";
  
    // Preloader
  $( window ).load(function() {
      $("#loading-img").fadeOut();
      $("#preloader").delay(400).fadeOut("slow");
  });

  $(document).ready(function(){

    // Create launch date for ticker
    // Date below denotes 23 April, 2015

    // SVG Fallback for older browsers
    $(function() {
      if (!Modernizr.svg) {
        $(".logo img").attr('src', function(index, attr) {
          return attr.replace('svg', 'png');
        });
      }
    });

    // Placeholder initialise
    $('input, textarea').placeholder();

    // Add slideshow images here!!!!!!!
     $.backstretch([
        "skin/images/bg-30.jpg",
        "skin/images/bg-31.jpg",
        "skin/images/bg-28.jpg"
    ], {duration: 3000, fade: 750});

  });

});

