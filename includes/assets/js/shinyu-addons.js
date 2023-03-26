(function ($) {
"use strict";

    var ShyinuAddonsGlobal = function ($scope, $) {

        // Js Start
        $('[data-background]').each(function() {
            $(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
        });
        // Js End

    };
    var ShyinuAddonsSldeShow = function ($scope, $) {
        $scope.find('.shinyu-home-banner').each(function () {
            var settings = $(this).data('shyinu');
            // Js Start
            var swipergrid = new Swiper(".bannerSwiper", {
                slidesPerView: 1,
                //spaceBetween: 30,
                loop: true,
                autoplay: false,
                navigation: {
                    nextEl: ".next",
                    prevEl: ".prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                // breakpoints: {
                //     345: {
                //         slidesPerView: 1,
                //         spaceBetween: 20,
                //     },
                //     525: {
                //         slidesPerView: 1,
                //         spaceBetween: 20,
                //     },
                //     768: {
                //         slidesPerView: 2,
                //         spaceBetween: 40,
                //     },
                //     992: {
                //         slidesPerView: 4,
                //         spaceBetween: 40,
                //     },
                // },
            });
            // Js End
        });
    };
    var ShyinuAddonsProject = function ($scope, $) {
        $scope.find('.project-presale').each(function () {
            var settings = $(this).data('shyinu');
            // Js Start
            var swipergrid = new Swiper(".project-swiper-container", {
                slidesPerView: 1,
                //spaceBetween: 30,
                loop: true,
                autoplay: false,
                // navigation: {
                //     nextEl: ".next",
                //     prevEl: ".prev",
                // },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                // breakpoints: {
                //     345: {
                //         slidesPerView: 1,
                //         spaceBetween: 20,
                //     },
                //     525: {
                //         slidesPerView: 1,
                //         spaceBetween: 20,
                //     },
                //     768: {
                //         slidesPerView: 2,
                //         spaceBetween: 40,
                //     },
                //     992: {
                //         slidesPerView: 4,
                //         spaceBetween: 40,
                //     },
                // },
            });
            // Js End
        });
    };

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', ShyinuAddonsGlobal);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons-slideshow.default', ShyinuAddonsSldeShow);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons-projectpresale.default', ShyinuAddonsProject);
        }
        else {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', ShyinuAddonsGlobal);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons-slideshow.default', ShyinuAddonsSldeShow);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons-projectpresale.default', ShyinuAddonsProject);
        }
    });
console.log('addon js loaded');
})(jQuery);