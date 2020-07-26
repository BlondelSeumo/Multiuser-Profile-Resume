! function(e) {
    "use strict";
    e(document).on("ready", function() {
        e(".post-slider").owlCarousel({
            loop: !0,
            responsiveClass: !0,
            margin: 50,
            nav: !1,
            dots: !1,
            autoplay: !0,
            autoplayTimeout: 4e3,
            smartSpeed: 1e3,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1,
                    nav: !1
                },
                768: {
                    items: 1
                },
                1170: {
                    items: 2
                }
            }
        }), e(".testimonials1").owlCarousel({
            loop: !0,
            margin: 0,
            responsiveClass: !0,
            nav: !1,
            dots: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            smartSpeed: 1e3,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1170: {
                    items: 1
                }
            }
        }), e(".features").owlCarousel({
            loop: !0,
            margin: 30,
            responsiveClass: !0,
            nav: !1,
            autoplay: !0,
            autoplayTimeout: 4e3,
            smartSpeed: 1e3,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        }), e(".clients").owlCarousel({
            loop: !0,
            margin: 10,
            nav: !1,
            autoplay: !0,
            autoplayTimeout: 4e3,
            smartSpeed: 1e3,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 3
                },
                768: {
                    items: 3
                },
                1170: {
                    items: 3
                }
            }
        }), e(".related-post").owlCarousel({
            loop: !0,
            margin: 30,
            responsiveClass: !0,
            nav: !1,
            autoplay: !0,
            autoplayTimeout: 4e3,
            smartSpeed: 1e3,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 2
                }
            }
        }), e(".count").counterUp({
            delay: 10,
            time: 3e3
        }), e(".video-popup").magnificPopup({
            type: "iframe"
        }), e(".primary-menu ul").slicknav(), e(".slicknav_menu").prepend('<a href="index.html"><img src="assets/images/logo.png" alt=""></a>'), e.scrollUp({
            scrollText: '<i class="pe-7s-angle-up"></i>',
            easingType: "linear",
            scrollSpeed: 900,
            animation: "fade"
        }), e(".single-service.box-1").prepend('<span class="line"></span><span class="line"></span><span class="line"></span><span class="line"></span>'), e(".accordion-content.in").siblings().addClass("active"), e(".accordion").find(".accordion-title").on("click", function() {
            e(".accordion").removeClass("active"), e(this).toggleClass("active"), e(this).next().slideToggle("fast"), e(".accordion-content").not(e(this).next()).slideUp("fast")
        }), e('.mainmenu-area a[href*="#"]').not('[href="#"]').not('[href="#0"]').on("click", function(a) {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var t = e(this.hash);
                (t = t.length ? t : e("[name=" + this.hash.slice(1) + "]")).length && (a.preventDefault(), e("html, body").animate({
                    scrollTop: t.offset().top
                }, 1e3, function() {
                    var a = e(t);
                    if (a.focus(), a.is(":focus")) return !1;
                    a.attr("tabindex", "-1"), a.focus()
                }))
            }
        }), (new WOW).init()
    }), e(window).load(function() {
        e(".preloader").fadeOut(1e3)
    });
    var a = e(".portfolio");
    e.fn.imagesLoaded && a.length > 0 && imagesLoaded(a, function() {
        a.isotope({
            itemSelector: ".portfolio-item",
            filter: "*"
        }), e(window).trigger("resize")
    }), e(".portfolio-filter").on("click", "a", function(t) {
        t.preventDefault(), e(this).parent().addClass("active").siblings().removeClass("active");
        var s = e(this).attr("data-filter");
        a.isotope({
            filter: s
        })
    }), e(".portfolio-gallery").each(function() {
        e(this).find(".popup-gallery").magnificPopup({
            type: "image",
            gallery: {
                enabled: !0
            }
        })
    }), e(".accordion > li:eq(0) a").addClass("active").next().slideDown(), e(".accordion a").on("click", function(a) {
        var t = e(this).closest("li").find("p");
        e(this).closest(".accordion").find("p").not(t).slideUp(), e(this).hasClass("active") ? e(this).removeClass("active") : (e(this).closest(".accordion").find("a.active").removeClass("active"), e(this).addClass("active")), t.stop(!1, !0).slideToggle(), a.preventDefault()
    }), e(document).ready(function() {
        e(document).on("keyup", "#user-name", function() {
            var a = e(this).val();
            e(".loader-bubble").show();
            var t = "home/check_username/" + a;
            return e.post(t, {
                data: "value",
                csrf_test_name: csrf_token
            }, function(a) {
                1 == a.st && (e(".loader-bubble").hide(), e("#name_available").slideDown(), e("#name_exist").hide(), e("#create-btn").prop("disabled", !1)), 2 == a.st && (e(".loader-bubble").hide(), e("#name_available").hide(), e("#name_exist").slideDown(), e("#create-btn").prop("disabled", !0))
            }, "json"), !1
        })
    }), e(document).ready(function() {
        e(document).on("submit", "#register-form", function() {
            return e.post(e("#register-form").attr("action"), e("#register-form").serialize(), function(e) {
                1 == e.st ? swal({
                    title: "Success",
                    text: "Your account has been created successfully",
                    type: "success",
                    confirmButtonText: e.btn,
                    showConfirmButton: !0
                }, function() {
                    window.location = e.url
                }) : 2 == e.st ? swal({
                    title: "Opps !",
                    text: "This Email Already Used",
                    type: "error",
                    showConfirmButton: !0
                }) : 3 == e.st ? swal({
                    title: "Opps !",
                    text: "Recaptcha is required",
                    type: "warning",
                    showConfirmButton: !0
                }) : 4 == e.st ? swal({
                    title: "Email Verification",
                    text: "We have sent a Verification link to your registared mail, Please check your inbox or spam folder.",
                    type: "warning",
                    showConfirmButton: !0
                }) : swal({
                    title: "Opps !",
                    text: "Password at least 4 digit",
                    type: "error",
                    showConfirmButton: !0
                })
            }, "json"), !1
        })
    })
}(jQuery);