$(document).ready(function(){
    
    
    
    /*// Slick Slider
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '0px',
        nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
        prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',
        responsive: [
            {
                breakpoint: 580,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });*/
    
    
    
    /*// Magnific Popup
    $(".obokash-video").magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });
    

    
});*/


// Scroll Smooth
$(function(){
   var scroll = new SmoothScroll('a[href*="#ss-"]'); 
});



//For Class Replacement on Scroll
//$(function() {
//    //caches a jQuery object containing the header element
//    var header = $(".header-area");
//    $(window).scroll(function() {
//        var scroll = $(window).scrollTop();
//
//        if (scroll >= 5) {
//            header.removeClass('header-area').addClass("darkHeader");
//        } else {
//            header.removeClass("darkHeader").addClass('header-area');
//        }
//    });
//});



////For Image Replacement on Scroll
//$(function() {
//    //caches a jQuery object containing the header element
//    var nav = $(".navbar");
//    $(window).scroll(function() {
//        var scroll = $(window).scrollTop();
//
//        if (scroll >= 5) {
//            nav.find('img').attr('src', 'assets/img/client-1.png');
//        } else {
//            nav.find('img').attr('src', 'assets/img/abokash-logo.png');
//        }
//    });
//});



//For Add Class
$(function() {
    //caches a jQuery object containing the header element
    var header = $(".header-area");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 5) {
            header.addClass("fixed-menu-bg");
        } else {
            header.removeClass("fixed-menu-bg");
        }
    });
});



$('button.navbar-toggler').click( function(){
//    if ( $(this).hasClass('current') ) {
//        $(this).removeClass('current');
//    } else {
//        $('li a.current').removeClass('current');
//        $(this).addClass('current');    
//    }
    
    
    if ( $('header').hasClass('header-area-bg') ) {
        $('header').removeClass('header-area-bg');
    } else {
        $('header').addClass('header-area-bg');
    }
});

// Load More: Load 6 More Items
$(function () {
    $("div.col-md-2").slice(0, 12).show();
    $("#load-more-products").on('click', function (e) {
        e.preventDefault();
        $("div.col-md-2:hidden").slice(0, 6).slideDown();
        if ($("div.col-md-2:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
    });
});
});