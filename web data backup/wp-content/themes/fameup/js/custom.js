(function($) {
  "use strict";
/* =================================
===        home -slider        ====
=================================== */
function homemain() {
  var homemain = new Swiper('.homemain', {
    direction: 'horizontal',
    loop: true,
    autoplay: true,
    slidesPerView: 1,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },

  });              
}
homemain(); 

/* =================================
===        Home-orderd-slider        ====
=================================== */
function orderdslider() {
  const orderdslider = new Swiper('.orderdslider', {
    slidesPerView: 1,
    autoplay: false,
    loop: true,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
  },

  });              
}
orderdslider(); 
/* =================================
===        home -slider-two        ====
=================================== */
function homemainTwo() {
  var Homemains = new Swiper('.homemain.two', {
    slidesPerView: 1,
    autoplay: false,
    loop: true,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
  },

  });              
}
homemainTwo(); 
/* =================================
===        home -slider -three       ====
=================================== */

function homemainThree() {
  var Homemainthree = new Swiper('.homemain.three', {
    direction: 'horizontal',
    loop: true,
    autoplay: false,
    spaceBetween: 0,
    slidesPerView: 1,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },

  });              
}
homemainThree(); 
/* =================================
===        home -slider-four        ====
=================================== */

function colmnslider() {
  var swiper = new Swiper(".thumbs-slider", {
    
    spaceBetween: 60,
    slidesPerView: 1,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 40,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
  }
  });
  var swiper2 = new Swiper(".thumbs-slider2", {
    loop: true,
    spaceBetween: 0,
    autoplay: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    
    thumbs: {
      swiper: swiper,
    },
  });
}
colmnslider(); 
/* =================================
===        home -slider-five       ====
=================================== */
function centerslider() {
    var swiperc = new Swiper(".center-slider", {
      slidesPerView: "auto",
      centeredSlides: true,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  
}
centerslider(); 
/* =================================
===        home -slider-two        ====
=================================== */

function featuredcat() {
  var featuredcat  = new Swiper('.featured_cat_slider', {
    slidesPerView: 1,
    autoplay: false,
    loop: true,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
  },

  });              
}
featuredcat();
function colmnthree() {
  var colmnthree  = new Swiper('.colmnthree', {
    slidesPerView: 1,
    autoplay: false,
    loop: true,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
  },

  });              
}
colmnthree(); 


function marquee() {
  jQuery('.marquee').marquee({
   speed: 50,
  direction: 'left',
  delayBeforeStart: 0,
  duplicated: true,
  pauseOnHover: true,
  startVisible: true
   });
 }
 marquee();
/* =================================
===         SCROLL TOP       ====
=================================== */
jQuery(".bs_upscr").hide(); 
function taupr() {
  jQuery(window).on('scroll', function() {
    if ($(this).scrollTop() > 500) {
        $('.bs_upscr').fadeIn();
    } else {
      $('.bs_upscr').fadeOut();
    }
  });   
  $('a.bs_upscr').on('click', function()  {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
}    
taupr();
/* =================================
===         WOW        ====
=================================== */
function WOWf() {
  new WOW().init();
}
WOWf();

})(jQuery);