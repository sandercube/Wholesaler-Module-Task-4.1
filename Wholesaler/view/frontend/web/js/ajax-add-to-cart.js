define([
    'jquery'
], function ($) {
    $(document).ready(function () {
        $('#data').submit(function (e) {
            var form = $('#data');
            $.ajax({
                url: form.attr('action'),
                dataType: 'json',
                type: 'POST',
                data: $('#data').serialize(),
                showLoader: true,
                success: function (res) {
                    console.log(res);
                },
                error: function (err) {
                    console.log(err);
                }
            });
            e.preventDefault();
        });
    });
});
