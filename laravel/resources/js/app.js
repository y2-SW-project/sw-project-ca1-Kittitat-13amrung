console.log("script loaded");

require('./bootstrap');

$( window ).on( "load", () => {
    $(window).scroll( function() {
        if($(this).scrollTop() >= 100) {
            console.log("test")
           $('.nav-header').addClass('nav-header-transition'); 
           $('.nav-header a').addClass('nav-text-transition'); 
        } else {
            $('.nav-header').removeClass('nav-header-transition');
            $('.nav-header a').removeClass('nav-text-transition'); 
        }
    });
});