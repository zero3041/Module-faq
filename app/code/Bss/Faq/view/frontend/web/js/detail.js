require([
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function ($) {
    'use strict';
    $(document).ready(function () {
        function addFeedBack(type)
        {
            var BASE_URL = $('#feedback #BASE_URL').text(),
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
    });
});
