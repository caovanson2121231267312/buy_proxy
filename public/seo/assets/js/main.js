(function ($) {
  $(document).ready(function () {

  ////////////////////////////////////////////////////

  ////////////////////////////////////////////////////
	// 03. Search Js
	$(".search-open-btn").on("click", function () {
		$(".search__popup").addClass("search-opened");
	});
		
	$(".search-close-btn").on("click", function () {
		$(".search__popup").removeClass("search-opened");
	});


  //========== HEADER ACTIVE STRATS ============= //
 var windowOn = $(window);
 windowOn.on('scroll', function () {
   var scroll = windowOn.scrollTop();
   if (scroll < 100) {
     $("#vl-header-sticky").removeClass("header-sticky");
   } else {
     $("#vl-header-sticky").addClass("header-sticky");
   }
 });
 
//========== HEADER ACTIVE ENDS ============= //

//========== PRICING AREA ============= //
$("#ce-toggle").click(function (event) {
  $(".plan-toggle-wrap").toggleClass("active");
});

$("#ce-toggle").change(function () {
  if ($(this).is(":checked")) {
    $(".tab-content #yearly").hide();
    $(".tab-content #monthly").show();
  } else {
    $(".tab-content #yearly").show();
    $(".tab-content #monthly").hide();
  }
});

//========== MOBILE MENU STARTS ============= //
  var vlMenuWrap = $('.vl-mobile-menu-active > ul').clone();
  var vlSideMenu = $('.vl-offcanvas-menu nav');
  vlSideMenu.append(vlMenuWrap);
  if ($(vlSideMenu).find('.sub-menu, .vl-mega-menu').length != 0) {
    $(vlSideMenu).find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>');
  }

  var sideMenuList = $('.vl-offcanvas-menu nav > ul > li button.vl-menu-close, .vl-offcanvas-menu nav > ul li.has-dropdown > a');
  $(sideMenuList).on('click', function (e) {
    console.log(e);
    e.preventDefault();
    if (!($(this).parent().hasClass('active'))) {
      $(this).parent().addClass('active');
      $(this).siblings('.sub-menu, .vl-mega-menu').slideDown();
    } else {
      $(this).siblings('.sub-menu, .vl-mega-menu').slideUp();
      $(this).parent().removeClass('active');
    }
  });


$(".vl-offcanvas-toggle").on('click',function(){
  $(".vl-offcanvas").addClass("vl-offcanvas-open");
  $(".vl-offcanvas-overlay").addClass("vl-offcanvas-overlay-open");
});

$(".vl-offcanvas-close-toggle,.vl-offcanvas-overlay").on('click', function(){
  $(".vl-offcanvas").removeClass("vl-offcanvas-open");
  $(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
});

//========== MOBILE MENU ENDS ============= //
  

    {
      function animateElements() {
        $('.progressbar').each(function () {
          var elementPos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
          var percent = $(this).find('.circle').attr('data-percent');
          var percentage = parseInt(percent, 10) / parseInt(100, 10);
          var animate = $(this).data('animate');
          if (elementPos < topOfWindow + $(window).height() - 10 && !animate) {
            $(this).data('animate', true);
            $(this).find('.circle').circleProgress({
              startAngle: -Math.PI / 2,
              value: percent / 100,
              size: 80,
              thickness: 5,
              emptyFill: "#E7E6F1",
              fill: {
                color: '#0778F9'
              }
            }).on('circle-animation-progress', function (event, progress, stepValue) {
              $(this).find('div').text((stepValue*100).toFixed() + "%");
            }).stop();
          }
        });
      }
    
      // Show animated elements
      animateElements();
      $(window).scroll(animateElements);
    };
     // sticky header active
     if ($("#header").length > 0) {
      $(window).on("scroll", function (event) {
        var scroll = $(window).scrollTop();
        if (scroll < 1) {
          $("#header").removeClass("sticky");
        } else {
          $("#header").addClass("sticky");
        }
      });
    }

          //Aos animation active
            AOS.init({
              offset: 100,
              duration: 400,
              easing: "ease-in-out",
              anchorPlacement: "top-bottom",
              disable: "mobile",
              once: false,
            });


            //Video poppup
            if ($(".play-btn").length > 0) {
              $(".play-btn").magnificPopup({
                type: "iframe",
              });
            };

              // page-progress
              var progressPath = document.querySelector(".progress-wrap path");
              var pathLength = progressPath.getTotalLength();
              progressPath.style.transition = progressPath.style.WebkitTransition =
                "none";
              progressPath.style.strokeDasharray = pathLength + " " + pathLength;
              progressPath.style.strokeDashoffset = pathLength;
              progressPath.getBoundingClientRect();
              progressPath.style.transition = progressPath.style.WebkitTransition =
                "stroke-dashoffset 10ms linear";
              var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength) / height;
                progressPath.style.strokeDashoffset = progress;
              };
              updateProgress();
              $(window).scroll(updateProgress);
              var offset = 50;
              var duration = 550;
              jQuery(window).on("scroll", function () {
                if (jQuery(this).scrollTop() > offset) {
                  jQuery(".progress-wrap").addClass("active-progress");
                } else {
                  jQuery(".progress-wrap").removeClass("active-progress");
                }
              });
              jQuery(".progress-wrap").on("click", function (event) {
                event.preventDefault();
                jQuery("html, body").animate({ scrollTop: 0 }, duration);
                return false;
              });

              //product colors
              const colors = $(".accordion1 .accordion-item");
              colors.on("click", function () {
                $(".accordion1 .accordion-item").removeClass("active");
                $(this).addClass("active");
              });

              //product colors
              const colors2 = $(".accordion2 .accordion-item");
              colors2.on("click", function () {
                $(".accordion2 .accordion-item").removeClass("active");
                $(this).addClass("active");
              });

              //select colors
              const select1 = $("select1");
              select1.on("click", function () {
                $("select1").removeClass("active");
                $(this).addClass("active");
              });

              //tes1 active
              const tes1 = $(".controls li");
              tes1.on("click", function () {
                $(".controls li").removeClass("active");
                $(this).addClass("active");
              });

              $("#ce-toggle1").click(function (event) {
                $(".plan-toggle-wrap1").toggleClass("active");
              });
              
              $("#ce-toggle1").change(function () {
                if ($(this).is(":checked")) {
                  $(".tab-content #yearly1").hide();
                  $(".tab-content #monthly1").show();
                } else {
                  $(".tab-content #yearly1").show();
                  $(".tab-content #monthly1").hide();
                }
              });



      //brands slider 1
      $('.brands-slider1').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [
          {
            breakpoint: 769,
            settings: {
              arrows: false,
              centerMode: false,
              centerPadding: "40px",
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: false,
              centerPadding: "40px",
              slidesToShow: 1,
            },
          },
        ],

      });


 // testimonial 1 //
$(".testimonial-horizental-slider2").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: ".slider-boxarea2",
  dots: false,
  arrows: false,
  centerMode: false,
  focusOnSelect: true,
  loop: true,
  autoplay: false,
  autoplaySpeed:2000,
  infinite: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$(".slider-boxarea2").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  autoplay:false,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:true,
  asNavFor: ".testimonial-horizental-slider2",
  infinite: true,
  prevArrow: $('.next-arrow'),
  nextArrow: $('.prev-arrow'),
});



//testimonial 2
$(".tes2-slider").slick({
  margin: "30",
  slidesToShow: 1,
  arrows: true,
  centerMode: false,
  loop: true,
  centerMode: false,
  prevArrow: $(".tes2-prev-arrow"),
  nextArrow: $(".tes2-next-arrow"),
  draggable: true,
  fade: false,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
  ],
});

//testimonial 2
$(".tes6-slider").slick({
  margin: "30",
  slidesToShow: 1,
  arrows: true,
  centerMode: false,
  loop: true,
  centerMode: false,
  prevArrow: $(".tes6-prev-arrow"),
  nextArrow: $(".tes6-next-arrow"),
  draggable: true,
  fade: false,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
  ],
});



//testimonial 3
$(".tes3-slider").slick({
  margin: "30",
  slidesToShow: 3,
  arrows: true,
  centerMode: false,
  loop: true,
  centerMode: false,
  prevArrow: $(".tes3-prev-arrow"),
  nextArrow: $(".tes3-next-arrow"),
  draggable: true,
  fade: false,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: "40px",
        slidesToShow: 1,
      },
    },
  ],
});


  //testimonial 2 slider
  $(".tes9-slider").slick({
    margin: "30",
    slidesToShow: 1,
    arrows: false,
    centerMode: true,
    dots: false,
    loop: true,
    centerMode: false,
    draggable: true,
    autoplay: true,
    autoplaySpeed: 4000,
    fade: false,
    fadeSpeed: 1000,
    dots: true,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
    ],
  });


  //testimonial 2 slider
  $(".tes10-slider").slick({
    margin: "30",
    slidesToShow: 1,
    arrows: false,
    centerMode: true,
    dots: false,
    loop: true,
    centerMode: false,
    draggable: true,
    autoplay: true,
    autoplaySpeed: 4000,
    fade: false,
    fadeSpeed: 1000,
    dots: true,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
    ],
  });


          
  });

    //preloader
    $(window).on("load", function (event) {
      setTimeout(function () {
        $(".preloader").fadeToggle();
      }, 500);
    });

    	/* Text Effect Animation */
	if ($('.text-anime-style-1').length) {
		let staggerAmount 	= 0.05,
			translateXValue = 0,
			delayValue 		= 0.5,
		   animatedTextElements = document.querySelectorAll('.text-anime-style-1');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.words, {
				duration: 1,
				delay: delayValue,
				x: 20,
				autoAlpha: 0,
				stagger: staggerAmount,
				scrollTrigger: { trigger: element, start: "top 85%" },
				});
		});		
	}
	
	if ($('.text-anime-style-2').length) {				
		let	 staggerAmount 		= 0.05,
			 translateXValue	= 20,
			 delayValue 		= 0.5,
			 easeType 			= "power2.out",
			 animatedTextElements = document.querySelectorAll('.text-anime-style-2');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.chars, {
					duration: 1,
					delay: delayValue,
					x: translateXValue,
					autoAlpha: 0,
					stagger: staggerAmount,
					ease: easeType,
					scrollTrigger: { trigger: element, start: "top 85%"},
				});
		});		
	}
	
	if ($('.text-anime-style-3').length) {		
		let	animatedTextElements = document.querySelectorAll('.text-anime-style-3');
		
		 animatedTextElements.forEach((element) => {
			//Reset if needed
			if (element.animation) {
				element.animation.progress(1).kill();
				element.split.revert();
			}

			element.split = new SplitText(element, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});
			gsap.set(element, { perspective: 400 });

			gsap.set(element.split.chars, {
				opacity: 0,
				x: "50",
			});

			element.animation = gsap.to(element.split.chars, {
				scrollTrigger: { trigger: element,	start: "top 95%" },
				x: "0",
				y: "0",
				rotateX: "0",
				opacity: 1,
				duration: 1,
				ease: Back.easeOut,
				stagger: 0.02,
			});
		});		
	}


  // btn_theme
  $(function() {
    $('.theme-btn1')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.learn1_active1')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

   // btn_theme
   $(function() {
    $('.learn2_active2')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.theme-btn2')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });


  // btn_theme
  $(function() {
    $('.btn_theme3')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme4')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme5')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme6')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme7')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme8')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme9')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme10')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme11')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme12')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });



  $('select').niceSelect();

            
})(jQuery);
    

// SWIPER SLIDER //
document.addEventListener("DOMContentLoaded", function () {
  var swiper3 = new Swiper(".swiper-thumb2", {
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });
  var swiper4 = new Swiper(".swiper-testimonial-2", {
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    thumbs: {
      swiper: swiper3,
    },
  });
});



document.addEventListener("DOMContentLoaded", () => {
  // Safe checks for elements to avoid errors
  const categories = document.querySelectorAll(".category");

  // Check if categories exist before adding event listeners
  if (categories.length > 0) {
    categories.forEach((category) => {
      category.addEventListener("click", () => {
        categories.forEach((cat) => cat.classList.remove("active"));
        category.classList.add("active");
      });
    });
  }

});



const slider = document.getElementById('balance-slider');
const selectedValue = document.getElementById('selectedValue');

if (slider && selectedValue) {
  // Function to update the background gradient
  function updateSliderBackground() {
    const value = slider.value;
    const max = slider.max;
    const percentage = (value / max) * 100;
    slider.style.background = `linear-gradient(to right, Navy ${percentage}%, #e0e0e0 ${percentage}%)`;
  }

  // Event listener for slider input
  slider.addEventListener('input', function () {
    selectedValue.textContent = this.value;
    updateSliderBackground();
  });

  // Initialize the slider background on page load
  updateSliderBackground();
}