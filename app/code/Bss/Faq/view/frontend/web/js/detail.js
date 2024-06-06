define([
    'jquery',
    'mage/translate'
], function ($) {
    'use strict';
    return function (config) {
        function addFeedBack(type)
        {
            var BASE_URL = config.baseUrl,
                selector = null;

            if (type === 1) {
                selector = '#feedback #btn-like';
            } else if (type === 0) {
                selector = '#feedback #btn-dislike';
            }
            $(document).on('click', selector, function () {
                var formData = new FormData();

                $('#feedback').text($('#feedback #message').text()).addClass('green');

                formData.append('type', type);
                $.ajax({
                    url: BASE_URL,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    dataType: 'json',
                    success:'success'
                });
            });
        }
        addFeedBack(1);
        addFeedBack(0);
    };
});
