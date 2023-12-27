!(function (e) {
    "use strict";
    e('[data-toggle="tooltip"]').tooltip(),
        e("#navigation").menumaker({ title: "", format: "multitoggle" }),
        e("#clickserch").on("click", function () {
            e("#opensearch").fadeToggle("slow");
        }),
        e("#slider").owlCarousel({
      
            items: 1,
            margin: 0,
            nav: !0,
            dots: !1,
            loop: !0,
            smartSpeed: 1200,
            navText: ["<i class='icofont-long-arrow-left'></i>", "<i class='icofont-long-arrow-right'></i>"],
            autoplayHoverPause: !0,
        }),
        e("#slider3").owlCarousel({ animateOut: "fadeOut", animateIn: "fadeInRight", items: 1, margin: 0, nav: !1, dots: !0, loop: !0, smartSpeed: 1200, autoplayHoverPause: !0 }),
        e(function () {
            e(".show-video").videoPopup({ autoplay: 1, controlsColor: "white", showVideoInformations: 0, width: 1e3, customOptions: { rel: 0, end: 60 } });
        }),
        e(function () {
            e(".show-video1").videoPopup2({ autoplay: 1, controlsColor: "white", showVideoInformations: 0, width: 1e3, customOptions: { rel: 0, end: 60 } });
        }),
        e(function () {
            e(".video-popup").videoPopup3({ autoplay: 1, controlsColor: "white", showVideoInformations: 0, width: 1e3, customOptions: { rel: 0, end: 60 } });
        }),
        e(".bigplay").owlCarousel({
            animateOut: "fadeOut",
            animateIn: "fadeInRight",
            items: 1,
            margin: 0,
            nav: !0,
            loop: !0,
            smartSpeed: 1200,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            stagePadding: 0,
        }),
        e("#new-arrivle").owlCarousel({
            autoplay: !0,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 1 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 4 }, 1024: { items: 4 }, 1200: { items: 5 } },
        }),
        e("#popular-shows").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 1 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 4 }, 1024: { items: 4 }, 1200: { items: 5 } },
        }),
        e("#popular-shows1").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 1 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 4 }, 1024: { items: 4 }, 1200: { items: 5 } },
        }),
        e("#team").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 2 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 3 }, 1024: { items: 4 }, 1200: { items: 4 } },
        }),
        e("#team1").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 2 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 3 }, 1024: { items: 4 }, 1200: { items: 4 } },
        }),
        e("#slider-2").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !1,
            dots: !0,
            loop: !0,
            margin: 30,
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 1 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 4 }, 1024: { items: 4 }, 1200: { items: 5 } },
        }),
        e("#tvseries-shows").owlCarousel({
            autoplay: !1,
            autoplaySpeed: 600,
            nav: !0,
            dots: !1,
            loop: !0,
            margin: 30,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoplayHoverPause: !0,
            responsive: { 0: { items: 1 }, 480: { items: 1 }, 568: { items: 2 }, 668: { items: 2 }, 768: { items: 3 }, 992: { items: 4 }, 1024: { items: 4 }, 1200: { items: 5 } },
        }),
        e("#banner").owlCarousel({ animateOut: "fadeOut", animateIn: "fadeInRight", items: 1, margin: 5, dots: !0, loop: !0, smartSpeed: 1200, autoplayHoverPause: !0 }),
        e(".miniitem1").owlCarousel({
            animateOut: "fadeOut",
            animateIn: "fadeInRight",
            items: 1,
            margin: 0,
            nav: !0,
            dots: !1,
            loop: !0,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            smartSpeed: 1200,
            autoplayHoverPause: !0,
        }),
        e("#trailor").owlCarousel({ animateOut: "fadeOut", animateIn: "fadeInRight", items: 1, margin: 0, nav: !1, dots: !0, loop: !0, smartSpeed: 1200, autoplayHoverPause: !0 }),
        e("#trailor-img-slide").owlCarousel({ animateOut: "fadeOut", animateIn: "fadeInRight", items: 1, margin: 0, nav: !1, dots: !0, loop: !0, smartSpeed: 1200, autoplayHoverPause: !0 }),
        e(window).on("scroll", function () {
            e(this).scrollTop() > 300 ? e("#back-top").fadeIn() : e("#back-top").fadeOut();
        }),
        e("#back-top").on("click", function () {
            return e("html, body").animate({ scrollTop: 0 }, 1e3), !1;
        }),
        e("#catmenu li.active").addClass("open").children("ul").show(),
        e("#catmenu li.has-sub>a").on("click", function () {
            e(this).removeAttr("href");
            var a = e(this).parent("li");
            a.hasClass("open")
                ? (a.removeClass("open"), a.find("li").removeClass("open"), a.find("ul").slideUp(200))
                : (a.addClass("open"),
                  a.children("ul").slideDown(200),
                  a.siblings("li").children("ul").slideUp(200),
                  a.siblings("li").removeClass("open"),
                  a.siblings("li").find("li").removeClass("open"),
                  a.siblings("li").find("ul").slideUp(200));
        }),
        e("#hidden-cat").on("click", function () {
            e("#catmenu").stop().slideToggle(500);
        });
    new Swiper(".swiper-slides", {
        effect: "coverflow",
        initialSlide: 1,
        loop: !0,
        spaceBetween: 30,
        slidesPerView: 3,
        coverflowEffect: { rotate: 2, stretch: 2, depth: 0 },
        navigation: { nextEl: ".slide4-icon-left", prevEl: ".slide4-icon-right" },
        autoplay: { delay: 3e3 },
        breakpoints: {
            1450: { slidesPerView: 3, spaceBetween: 20 },
            1300: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 2, spaceBetween: 20 },
            990: { slidesPerView: 2, spaceBetween: 10 },
            861: { slidesPerView: 1 },
            768: { slidesPerView: 1 },
            640: { slidesPerView: 1, spaceBetween: 20 },
            320: { slidesPerView: 1, spaceBetween: 10 },
        },
    });
    e(function () {
        e("#slider-range").slider({
            range: !0,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function (a, i) {
                e("#amount").val("$" + i.values[0]), e("#amount2").val("$" + i.values[1]);
            },
        }),
            e("#amount").val("$" + e("#slider-range").slider("values", 0)),
            e("#amount2").val("$" + e("#slider-range").slider("values", 1));
    });
    var a = e(window);
    e("body"), e("header");
    a.on("load", function () {
        var a = e(".zmovo-preloader");
        a.find(".boxes").fadeOut(), a.delay(350).fadeOut("slow");
    });
})(jQuery);
