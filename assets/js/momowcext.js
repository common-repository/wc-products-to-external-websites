/*global jQuery */
/**
 * Javascript file for loading products
 */
(function ($, undefined) {
    'use strict';
    $.fn.momoWcExtDisplay = function (args) {
        var defaults = {
            endpoint: '',
            loading_text: 'Products Loading ...... '
        };
        var options = $.extend({}, defaults, args);
        if (options.endpoint === undefined) {
            return;
        }

        var $productBox = this;
        var loader = '<style type="text/css">';
        loader += ".loader, .loader p{text-align:center;}";
        loader += ".loader .momo_wcext_line{display: inline-block;width: 15px;height: 15px;border-radius: 15px;background-color: #4b9cdb;margin:5px;}";
        loader += ".loader .momo_wcext_line:nth-last-child(1) {animation: loadingA 1.5s 1s infinite;}";
        loader += ".loader .momo_wcext_line:nth-last-child(2) {animation: loadingA 1.5s .5s infinite;}";
        loader += ".loader .momo_wcext_line:nth-last-child(3) {animation: loadingA 1.5s 0s infinite;}";
        loader += "@keyframes loadingA { 0 {height: 15px;} 50% {height: 35px;} 100% {height: 15px;} }";
        loader += '</style>';
        loader += '<div class="loader">';
        loader += '<p>' + options.loading_text + '</p>';
        loader += '<div class="momo_wcext_line"></div>';
        loader += '<div class="momo_wcext_line"></div>';
        loader += '<div class="momo_wcext_line"></div>';
        loader += '</div>';
        $productBox.html(loader);
        $.getJSON(options.endpoint, options, function (data) {
            var style = data.styles;
            var otype = options.type;
            if ('momo-category-products' === otype) {
                otype = 'momo-multiple-products';
            }
            $productBox.html('<style type="text/css">' + style + '</style>');
            $productBox.append('<div class="momo_wcext_global_container ' + otype + '">' + data.products + '</div>');
        });
    };
}(jQuery));