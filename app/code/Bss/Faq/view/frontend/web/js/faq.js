define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('bss.faq', {
        options: {
            faqCollectionSelector: '.bss-faq-collection',
            faqLoaderSelector: '.bss-faq-loader',
            groupLinkSelector: '.group-links',
            pageTypeScroll: 'scroll',
            uiAccordionContentSelector: '.ui-accordion-content',
            uiAccordionHeaderSelector: '.ui-accordion-header',
            faqAccordionSelector: '.faq-accordion',
            collapseFaqsSelector: '#collapse-faqs',
            expandFaqsSelector: '#expand-faqs'
        },

        _create: function () {
            this._bind();
        },

        _bind: function () {
            var self = this;

            self._setAccordian();

            $(this.options.faqCollectionSelector).show();
            $(this.options.faqLoaderSelector).hide();

            $(this.options.groupLinkSelector).on('click', function (event) {
                event.preventDefault();
                if (self.options.page_type === self.options.pageTypeScroll) {
                    self._scrollToGroup(this);
                }
            });

            $(this.options.collapseFaqsSelector).on('click', function (e) {
                e.preventDefault();
                $(self.options.uiAccordionContentSelector).hide(100);
                $(self.options.uiAccordionHeaderSelector).removeClass('ui-state-active');
                $(self.options.uiAccordionHeaderSelector).removeClass('ui-accordion-header-active');
            });

            $(this.options.expandFaqsSelector).on('click', function (e) {
                e.preventDefault();
                $(self.options.uiAccordionContentSelector).show(100);
                $(self.options.uiAccordionHeaderSelector).addClass('ui-state-active');
                $(self.options.uiAccordionHeaderSelector).addClass('ui-accordion-header-active');
            });
        },

        _setAccordian: function () {
            $(this.options.faqAccordionSelector).accordion({
                collapsible: true,
                heightStyle: 'content',
                active: '',
                animate: 500
            });
        },

        _scrollToGroup(data) {
            var target = $(data.getAttribute('href'));

            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        }
    });

    return $.bss.faq;
});
