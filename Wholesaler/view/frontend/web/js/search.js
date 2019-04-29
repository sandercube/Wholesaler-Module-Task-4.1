define([
    'jquery'
], function ($) {
    $(document).ready(function () {
        $('#sku').on('input', function (ex) {
            if ($('#sku').val()) {
                $.ajax({
                    url: 'sanderwholesaler/action/search',
                    dataType: 'json',
                    type: 'POST',
                    data: $('#data').serialize(),
                    success: function (res) {
                        console.log(res);
                        $("#skulist").empty();
                        $.each(res.items, function (i, item) {
                            $("#skulist").append("<option value=" + item + ">");
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        });
    });
});
