$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $("header").addClass("sticky");
    } else {
      $("header").removeClass("sticky");
    }
  });

  var windowsize = $(window).width();

  $(window).scroll(function () {
    if (windowsize < 640) {
      if ($(this).scrollTop() > 50) {
        $(".backHome").addClass("sticky");
      } else {
        $(".backHome").removeClass("sticky");
      }
    }
  });

  lightGallery(document.getElementById("animated-thumbnails-gallery"), {
    thumbnail: true,
    plugins: [lgThumbnail],
    mobileSettings: [
      {
        showCloseIcon: true,
      },
    ],
  });

  $(".vault-slider").slick({
    slidesToShow: 3,
    arrows: true,
    speed: 1000,
    responsive: [
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
          autoplay: true,
          autoPlaySpeed: 1500,
          arrows: false,
        },
      },
    ],
  });

  $(".lineup-slider").slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    arrows: true,
    speed: 1000,
    responsive: [
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".news-listing").slick({
    slidesToShow: 3,
    arrows: true,
    speed: 1000,
    responsive: [
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
          autoplay: true,
          autoPlaySpeed: 1500,
          arrows: false,
        },
      },
    ],
  });

  $(".tabItem a").on("click", function () {
    $(".lineup-slider").slick("unslick");

    let tabValue = $(this).attr("data-tab");
    $(".tabItem").removeClass("current");
    $(".tab-content").removeClass("current");
    $(this).parent().addClass("current");
    $("#" + tabValue).addClass("current");
    $(".lineup-slider").slick({
      slidesToShow: 5,
      slidesToScroll: 5,
      arrows: true,
      speed: 1000,
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });

  $(".stages-slider").slick({
    slidesToShow: 1,
    speed: 1000,
    arrows: true,
    responsive: [
      {
        breakpoint: 500,
        settings: {
          // autoplay:true,
          autoPlaySpeed: 1500,
        },
      },
    ],
  });

  $(".mobile-ham").click(function () {
    $("nav").addClass("show-menu");
  });
  $(".mob-menuClose").click(function () {
    $("nav").removeClass("show-menu");
  });

  $(".partnerBtn").magnificPopup({
    type: "inline",
    preloader: false,
    focus: "#name",
  });

  $(".scrollDwn").click(function () {
    $(".scrollDwn").removeClass("active");
    $("nav").removeClass("show-menu");
    $(this).addClass("active");
    var hgt = $(this).attr("rel");
    if ($(window).width() > 640) {
      var mis = 100;
    } else {
      var mis = 50;
    }
    $("html,body").animate(
      {
        scrollTop: $("section#" + hgt).offset().top - mis,
      },
      2000
    );
  });

  $(".popup-youtube").magnificPopup({
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false,
  });

  $("#load").hide();
});
