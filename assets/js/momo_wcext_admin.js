/*global jQuery*/
/*global define */
/*global window */
/*global this*/
/*global location*/
/*global document*/
/*global momowcext_admin*/
/*global console*/
/*jslint this*/
/**
 * momowcext Admin Script
 */
jQuery(document).ready(function ($) {
    "use strict";
    function changeAdminTab(hash) {
        var mmtmsTable = $('.momo-be-tab-table');
        mmtmsTable.attr('data-tab', hash);
        mmtmsTable.find('.momo-be-admin-content.active').removeClass('active');
        var ul = mmtmsTable.find('ul.momo-be-main-tab');
        ul.find('li a').removeClass('active');
        $(ul).find('a[href=\\' + hash + ']').addClass('active');
        mmtmsTable.find(hash).addClass('active');
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
    }
    function doNothing() {
        var mmtmsTable = $('.momo-be-tab-table');
        mmtmsTable.attr('data-tab', '#momo-eo-ei-event_card');
        return;
    }
    function init() {
        var hash = window.location.hash;
        if (hash === '' || hash === 'undefined') {
            doNothing();
        } else {
            changeAdminTab(hash);
        }
        $('#momo-be-form .switch-input').each(function () {
            var toggleContainer = $(this).parents('.momo-be-toggle-container');
            var afteryes = toggleContainer.attr('momo-be-tc-yes-container');
            if ($(this).is(":checked")) {
                $('#' + afteryes).addClass('active');
            } else {
                $('#' + afteryes).removeClass('active');
            }
        });
    }
    init();
    $('body').on('change', '#momo-be-form  .switch-input', function () {
        var toggleContainer = $(this).parents('.momo-be-toggle-container');
        var afteryes = toggleContainer.attr('momo-be-tc-yes-container');
        if ($(this).is(":checked")) {
            $('#' + afteryes).addClass('active');
        } else {
            $('#' + afteryes).removeClass('active');
            $(this).val('off');
        }
    });
    $('.momo-be-tab-table').on('click', 'ul.momo-be-main-tab li a, a.momo-inside-page-link', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        changeAdminTab(href);
        window.location.hash = href;
    });
    /********** End Main Backed ****************/

    /**
     * Change Textarea Multiple Products
     */
    $.fn.changeTareaMproducts = function () {
        var $section = $(this);
        var $loading = $section.find('input[name="multiple_product_loading_text"]');
        var $number = $section.find('select[name="momowxext_multiple_product_count"]');
        var $textarea = $section.find('textarea');
        var $output = momowcext_admin.jquery_script
                    + "\n" + momowcext_admin.momowcext_script
                    + "\n<script type='text/javascript'>"
                        + "\n\tjQuery(document).ready(function($){"
                            + "\n\t\t$('#momo-wc-ext-mp-content').momoWcExtDisplay({"
                                + "\n\t\t\tendpoint: '" + momowcext_admin.site_url + "/wp-json/momowcext/products',"
                                + "\n\t\t\tproduct_url: '" + momowcext_admin.site_url + "',"
                                + "\n\t\t\tloading_text: '" + $loading.val() + "',"
                                + "\n\t\t\tnop: " + $number.val() + ","
                                + "\n\t\t\tview: 'normal',"
                                + "\n\t\t\ttype: 'momo-multiple-products',"
                                + "\n\t\t\tnew_window: " + momowcext_admin.new_window_option + ","
                            + "\n\t\t});"
                        + "\n\t});"
                + "\n</script>"
                + "\n<div id='momo-wc-ext-mp-content' style='height:100%; width:100%'></div>";
        $textarea.val($output);
    };
    $('body').on('change', '.trigger-mp-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaMproducts();
    });
    $('body').on('keyup', '.trigger-mp-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaMproducts();
    });
    $('body').on('click', '.momowcext-copy-clipboard', function () {
        var $section = $(this).closest('.momo-be-section');
        var $textarea = $section.find('textarea');
        $textarea.focus();
        $textarea.select();
        document.execCommand("copy");
    });

    $('#momowxext_single_product_select').select2({
        ajax: {
            url: momowcext_admin.ajaxurl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search query
                    security: momowcext_admin.momowcext_ajax_nonce,
                    action: 'momo_wcext_woo_product_list_search'
                };
            },
            processResults: function (data) {
                var options = [];
                if (data) {

                    $.each(data, function (index, text) {
                        options.push({id: text[0], text: text[1]});
                    });

                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3,
        width: 250,
        open: function (e) {
            var data = e.params.data;
            console.log(data);
        }
    });
    $('#momowxext_category_select').select2({
        ajax: {
            url: momowcext_admin.ajaxurl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search query
                    security: momowcext_admin.momowcext_ajax_nonce,
                    action: 'momo_wcext_woo_category_list_search'
                };
            },
            processResults: function (data) {
                var options = [];
                if (data) {

                    $.each(data, function (index, text) {
                        options.push({id: text[0], text: text[1]});
                    });

                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3,
        width: 250,
        open: function (e) {
            var data = e.params.data;
            console.log(data);
        }
    });
    /**
     * Change Textarea Single Product
     */
    $.fn.changeTareaSproduct = function () {
        var $section = $(this);
        var $loading = $section.find('input[name="single_product_loading_text"]');
        var $select = $section.find('select[name="momowxext_single_product_select"]');
        var $textarea = $section.find('textarea');
        var $output = momowcext_admin.jquery_script
                    + "\n" + momowcext_admin.momowcext_script
                    + "\n<script type='text/javascript'>"
                        + "\n\tjQuery(document).ready(function($){"
                            + "\n\t\t$('#momo-wc-ext-sp-content').momoWcExtDisplay({"
                                + "\n\t\t\tendpoint: '" + momowcext_admin.site_url + "/wp-json/momowcext/product',"
                                + "\n\t\t\tproduct_url: '" + momowcext_admin.site_url + "',"
                                + "\n\t\t\tproduct_id: '" + $select.val() + "',"
                                + "\n\t\t\tloading_text: '" + $loading.val() + "',"
                                + "\n\t\t\tview: 'normal',"
                                + "\n\t\t\ttype: 'momo-single-product',"
                                + "\n\t\t\tnew_window: " + momowcext_admin.new_window_option + ","
                            + "\n\t\t});"
                        + "\n\t});"
                + "\n</script>"
                + "\n<div id='momo-wc-ext-sp-content' style='height:100%; width:100%'></div>";
        $textarea.val($output);
    };
    $('body').on('change', '.trigger-sp-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaSproduct();
    });
    $('body').on('keyup', '.trigger-sp-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaSproduct();
    });

    /**
     * Change Textarea Single Product
     */
     $.fn.changeTareaCategory = function () {
        var $section = $(this);
        var $loading = $section.find('input[name="category_loading_text"]');
        var $select = $section.find('select[name="momowxext_category_select"]');
        var $number = $section.find('select[name="momowxext_category_product_count"]');
        var $textarea = $section.find('textarea');
        var $output = momowcext_admin.jquery_script
                    + "\n" + momowcext_admin.momowcext_script
                    + "\n<script type='text/javascript'>"
                        + "\n\tjQuery(document).ready(function($){"
                            + "\n\t\t$('#momo-wc-ext-cs-content').momoWcExtDisplay({"
                                + "\n\t\t\tendpoint: '" + momowcext_admin.site_url + "/wp-json/momowcext/category',"
                                + "\n\t\t\tproduct_url: '" + momowcext_admin.site_url + "',"
                                + "\n\t\t\tcategory_id: '" + $select.val() + "',"
                                + "\n\t\t\tloading_text: '" + $loading.val() + "',"
                                + "\n\t\t\tnop: " + $number.val() + ","
                                + "\n\t\t\tview: 'normal',"
                                + "\n\t\t\ttype: 'momo-category-products',"
                                + "\n\t\t\tnew_window: " + momowcext_admin.new_window_option + ","
                            + "\n\t\t});"
                        + "\n\t});"
                + "\n</script>"
                + "\n<div id='momo-wc-ext-cs-content' style='height:100%; width:100%'></div>";
        $textarea.val($output);
    };
    $('body').on('change', '.trigger-cs-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaCategory();
    });
    $('body').on('keyup', '.trigger-sc-ta-change', function () {
        var $section = $(this).closest('.momo-be-section');
        $section.changeTareaCategory();
    });
});