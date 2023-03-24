(function ($) {
"use strict";

    var ShyinuAddonsGlobal = function ($scope, $) {

        // Js Start
        $('[data-background]').each(function() {
            $(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
        });
        // Js End

    };
    var StickySection = function ($scope, $) {

        // Js Start
        var link = $('.chart-product-text-body').data('link');
        $(".chart-product-text-body").click( function() {
            window.location.href=link;
        });
        // Js End

    };

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', ShyinuAddonsGlobal);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons_ad_block.default', adblocklist);
        }
        else {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', ShyinuAddonsGlobal);
            //elementorFrontend.hooks.addAction('frontend/element_ready/shyinuaddons_ad_block.default', adblocklist);
        }
    });
console.log('addon js loaded');
})(jQuery);